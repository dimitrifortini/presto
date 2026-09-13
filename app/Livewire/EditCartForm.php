<?php

namespace App\Livewire;

use Livewire\Component;

class EditCartForm extends Component
{
    public $cart;

    public function plus()
    {
        $this->cart->increment('quantity');
    }

    public function minus()
    {
        if ($this->cart->quantity > 1) {
            $this->cart->decrement('quantity');
        } else {
            $this->cart->delete();
            return redirect()->route("cart.index");
        }
    }

    public function render()
    {
        return view('livewire.edit-cart-form');
    }
}