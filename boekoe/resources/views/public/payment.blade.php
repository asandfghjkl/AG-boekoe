@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="payment-area">
            <h4 class="my-4 bg-dark p-3 text-white">Make your payment</h4>

            <div class="cart-summary my-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Order summary</h4>
                    </div>
                    <div class="card-body">
                        <p>Total products = {{Cart::content()->count()}}</p>
                        <p>Product Cost = Rp{{Cart::total()}}</p>
                        <p>Shipping cost = Rp10000</p>
                        <p><strong>Total cost = Rp{{Cart::total() + 10000}}</strong></p>
                    </div>
                </div>
            </div>

            <div class="bg-light p-3 my-4">
                <form action="{{route('cart.checkout')}}" method="post">
                    @csrf
                    <button tipe="submit" class="btn btn-success btn-sm"><strong>Proceed to Payment</strong></button>
                </form>
            </div>
        </div>
    </div>
@endsection
