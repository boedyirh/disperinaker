<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class Pikaday extends Component
{

    public $tgl_lahir;

    public $rules = [
        'tgl_lahir'  => 'required|date'
    ];

    public function render()
    {
        return view('livewire.pikaday');
    }


}
