<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Navegation;

class Panel extends Component
{
    public $navegations, $id_link, $name, $link, $status;
    public $modal = 0;

    public function render()
    {
        $this->navegations = Navegation::all();
        return view('livewire.panel');
    }

    public function create()
    {
        $this->cleanfields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
    }

    public function cleanfields()
    {
        $this->name = '';
        $this->link = '';
        $this->status = '';
    }

    public function edit($id)
    {
        $nav = Navegation::findOrFail($id);
        $this->id_link = $id;
        $this->name = $nav->name;
        $this->link = $nav->link;
        $this->status = $nav->status;
        $this->openModal();
    }

    public function save()
    {
        Navegation::updateOrCreate(
            ['id' => $this->id_link],
            [
                'name' => $this->name,
                'link' => $this->link,
                'status' => $this->status
            ]
        );

        session()->flash(
            'message',
            $this->id_link ?  'Update successfully!' : 'Saved successfully'
        );

        $this->closeModal();
        $this->cleanfields();
    }
}
