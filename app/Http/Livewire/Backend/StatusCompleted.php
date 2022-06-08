<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Ak1Model;

class StatusCompleted extends Component
{
    public $completed;
    public $rand_ak1;
    public $data_pemohon;
    public $status_completed_edit=false;

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->data_pemohon  = Ak1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first(['completed']);
        $this->completed = $this->data_pemohon['completed'];
    }
    public function render()
    {
        return view('livewire.backend.status-completed');
    }

    public function updateCompleted()
    {
            if(empty($this->completed)){

            }
            else{

                $data_update = [
                    'completed' => $this->completed,
                ];

                $this->Ak1Model->updateData($data_update,$this->rand_ak1);

            }
            $this->status_completed_edit = false;


    }
    public function editCompleted()
    {
         $this->status_completed_edit = true;
    }
}
