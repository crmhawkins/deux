<?php

namespace App\Http\Livewire\Textos;

use App\Models\Textos;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateComponent extends Component
{
    use LivewireAlert;

    public $titulo;
    public $texto;


    public function render()
    {
        return view('livewire.textos.create-component');
    }
    // Al hacer submit en el formulario
    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate(
            [
                'titulo'=> 'required',
                'texto'=> 'nullable',

            ],
            // Mensajes de error
            [
                'titulo.required' => 'El titulo es obligatorio.',
            ]
            );

        // Guardar datos validados
        $clienteSave = Textos::create(
            $validatedData
        );

        event(new \App\Events\LogEvent(Auth::user(), 8, $clienteSave->id));

        // Alertas de guardado exitoso
        if ($clienteSave) {
            $this->alert('success', '!Texto registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del documento!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

     // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'submit'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('texto.index');
    }
}
