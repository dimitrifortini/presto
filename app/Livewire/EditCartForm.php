<?php

namespace App\Livewire;

use Livewire\Component;

class EditCartForm extends Component
{
    public $cart;

    public function plus()
    {   
        if (auth()->id()!== $this->cart->user->id) {
            abort(403);
        }
        $this->cart->increment('quantity');
        $this->dispatch("cart-updated");
    }

    public function minus()
    {
        if (auth()->id()!== $this->cart->user->id) {
            abort(403);
        }
        if ($this->cart->quantity > 1) {
            $this->cart->decrement('quantity');
            $this->dispatch("cart-updated");
        } else {
            $this->cart->delete();
            $this->dispatch("cart-updated");
            return redirect()->route("cart.index");
        }
    }

    public function render()
    {
        return view('livewire.edit-cart-form');
    }
}
