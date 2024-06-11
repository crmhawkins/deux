<?php

namespace App\Http\Livewire\Textos;

use App\Models\Textos;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditComponent extends Component
{
    use LivewireAlert;
    public $identificador;
    public $titulo;
    public $texto;

    public function mount()
    {
        $documento = Textos::find($this->identificador);
        $this->titulo = $documento->titulo;
        $this->texto = $documento->texto;
    }

    public function render()
    {
        return view('livewire.textos.edit-component');
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        return redirect()->route('texto.index');
    }
    //Funcion que actualiza el texto
    public function update()
    {
        // Validación de datos
        $this->validate([
            'titulo'=> 'nullable',
            'texto'=> 'nullable',
        ],
            // Mensajes de error
            [
                'titulo.required' => 'El titulo es obligatorio.',
            ]);

        // Encuentra el identificador
        $texto = Textos::find($this->identificador);

        // Guardar datos validados
        $pacienteSave = $texto->update([
            'titulo' => $this->titulo,
            'texto'=>$this->texto,
        ]);
        event(new \App\Events\LogEvent(Auth::user(), 9, $texto->id));

        if ($pacienteSave) {
            $this->alert('success', '!Texto actualizado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del texto!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }

        session()->flash('message', 'Texto actualizado correctamente.');

        $this->emit('eventUpdated');
    }

    // Eliminación
    public function destroy(){

        $this->alert('warning', '¿Seguro que desea borrar el texto? No hay vuelta atrás', [
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

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'update',
            'destroy',
            'confirmDelete'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $texto = Textos::find($this->identificador);
        event(new \App\Events\LogEvent(Auth::user(), 10, $texto->id));
        $texto->delete();
        return redirect()->route('texto.index');

    }
}
