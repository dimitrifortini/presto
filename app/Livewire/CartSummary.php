<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Cart;

class CartSummary extends Component
{
    public $carts;
    public $total;
    #[On('cart-updated')]

    public function mount()
    {
        $this->loadCart();
    }

     public function loadCart()
    {
        $this->carts = Cart::where('user_id', auth()->id())->get();

        $this->total = $this->sumPrice();
    }
    
    public function sumPrice(){
        $carts= Cart::where("user_id",auth()->id())->get();
        $total=0;
        foreach ($carts as $cart) {
            $quantity=$cart->article->price*$cart->quantity;
            $total+=$quantity;
        }
        return $total;
    } 

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
