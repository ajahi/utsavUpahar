<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Livewire\Attributes\On;

class NavCart extends Component
{
    public $cartItems, $cartItemCount;

    public function mount()
    {
        $this->cartItems = Cart::content()->toArray();
        $this->cartItemCount = Cart::content()->count();
    }
    #[On('update-cart')]
    public function updateCartData()
    {
        $this->cartItemCount = Cart::content()->count();
        $this->cartItems = Cart::content()->toArray();
    }
    public function render()
    {
        return view('livewire.nav-cart', ['items' => $this->cartItems]);
    }

    public function removeCartItem($rowId)
    {
        Cart::remove($rowId);
        $this->cartItems = Cart::content()->toArray();
        $this->cartItemCount = Cart::content()->count();
        // You may emit an event or perform other actions after removing an item
    }

    public function clearCart()
    {
        Cart::destroy();
        $this->cartItems = Cart::content()->toArray();
        $this->cartItemCount = Cart::content()->count();
        // You may emit an event or perform other actions after clearing the cart
    }
}
