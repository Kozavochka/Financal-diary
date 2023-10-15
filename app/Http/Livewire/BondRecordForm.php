<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BondRecordForm extends Component
{
    public $name;
    public $price;

    protected $rules = [
        'name' => 'required | string',
        'price' => 'required | integer',
    ];

    public function submitForm()//Автоматически перехватывает параметры
    {
        dd($this->name, $this->price);
    }

    public function render()
    {
        return view('livewire.bond-record-form');
    }
}
