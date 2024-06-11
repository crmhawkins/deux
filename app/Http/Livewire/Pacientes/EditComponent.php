<?php

namespace App\Http\Livewire\Pacientes;

use App\Models\Documentos;
use Livewire\Component;
use App\Models\Paciente;
use App\Models\Textos;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;
    public $nombre;
    public $apellido;
    public $dni;
    public $email;
    public $telefono;
    public $direccion;
    public $documentos;
    public $textos;
    public $texto_id;
    public $textoSeleccionado;
    public $tituloSeleccionado;
    public $firma;


    public function mount()
    {
        $paciente = Paciente::find($this->identificador);
        $this->nombre = $paciente->nombre;
        $this->apellido = $paciente->apellido;
        $this->email = $paciente->email;
        $this->dni = $paciente->dni;
        $this->telefono = $paciente->telefono;
        $this->direccion = $paciente->direccion;
        $this->documentos = $paciente->documentos()->get();
        $this->textos= Textos::all();
        $this->textoSeleccionado = '';
        $this->firma = '';
    }

    public function updatedTextoId($value){
        $this->textoSeleccionado = $this->textos->find($value)->texto;
        $this->tituloSeleccionado = $this->textos->find($value)->titulo;
    }
    public function render()
    {
        return view('livewire.pacientes.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        // Validación de datos
        $this->validate([
            'nombre'=> 'nullable',
            'apellido'=> 'nullable',
            "email"=> 'nullable',
            "telefono"=> 'nullable',
            "dni"=> 'nullable',
            "direccion"=> 'nullable',
        ],
            // Mensajes de error
            [
                'nombre.required' => 'El nombre es obligatorio.',
            ]);

        // Encuentra el identificador
        $paciente = Paciente::find($this->identificador);

        // Guardar datos validados
        $pacienteSave = $paciente->update([
            'nombre' => $this->nombre,
            'apellido'=>$this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'dni' => $this->dni,
            "direccion"=> $this->direccion,

        ]);
        event(new \App\Events\LogEvent(Auth::user(), 9, $paciente->id));

        if ($pacienteSave) {
            $this->alert('success', 'Paciente actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del paciente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }

        session()->flash('message', 'paciente actualizado correctamente.');

        $this->emit('eventUpdated');
    }

      // Eliminación
    public function destroy(){
        $this->alert('warning', '¿Seguro que desea borrar el paciente? No hay vuelta atrás', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmDelete',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }

    public function confirmDeleteDoc($id)
    {
        $document = Documentos::find($id);
        $document->delete();
        $this->refresh();
    }
    public function refresh()
    {
        $this->dispatchBrowserEvent('refresh-page');
    }

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'update',
            'destroy',
            'confirmDelete',
            'saveSignature',
            'confirmDeleteDoc',
            'refresh'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('pacientes.index');

    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $cliente = Paciente::find($this->identificador);
        event(new \App\Events\LogEvent(Auth::user(), 10, $cliente->id));
        $cliente->delete();
        return redirect()->route('pacientes.index');
    }
    public function descargar($id)
    {
        $documento = Documentos::find($id);
        $paciente = Paciente::find($this->identificador);
        $dia = Carbon::parse($documento->create_at)->day;
        $mes = Carbon::parse($documento->create_at)->locale('es')->translatedFormat('F');
        $año = Carbon::parse($documento->create_at)->year;
        $datos =  ['paciente' => $paciente,  'documento' => $documento,'dia' => $dia,'mes' => $mes,'año' => $año];

        $pdf = Pdf::loadView('livewire.pacientes.pdf-component', $datos)->setPaper('a4', 'vertical')->output();
        return response()->streamDownload(
            fn () => print($pdf),
            'Consentimiento'.$paciente->nombre.'_'.$paciente->apellido.'_'.Carbon::parse($documento->create_at)->format('dd-mm-yyyy').'.pdf'
        );

    }

    public function saveSignature($data)
    {        // Procesa la imagen recibida y guárdala o haz lo que necesites con ella
        $this->firma = $data;

        // Aquí puedes guardar la firma en la base de datos o realizar otras acciones
        // Ejemplo: guardar en un archivo
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);
        $timestamp = now()->timestamp;
        $uniqueId = Str::uuid();
        $imageName = 'firma_' . $this->identificador . '_' . $timestamp . '_' . $uniqueId . '.png';

        Storage::disk('public')->put('assets/firma/'.$imageName, base64_decode($image));

        // Asocia la imagen guardada con el paciente si es necesario
        $documento = Documentos::create([
            'texto'  => $this->textoSeleccionado,
            'paciente_id'=> $this->identificador,
            'titulo' => $this->tituloSeleccionado,
            'firma'  => $imageName,

        ]);


        if ($documento) {
            $this->alert('success', 'Documento firmado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'refresh',
                'confirmButtonText' => 'OK',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido firma la documentacion!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }
}
