<?php

namespace App\Http\Livewire\Textos;

use App\Models\Textos;
use Livewire\Component;

class IndexComponent extends Component
{
    public $textos;

    public function mount()
    {
        $this->textos = Textos::all();
    }
    public function render()
    {
        return view('livewire.textos.index-component');
    }
}
