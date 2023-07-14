<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\ShippingAddressRequest;
use App\Order;
use App\OrderDetail;
use App\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::content()->count()){
            return view('public.checkout-page');
        }
        abort(403, 'Cart is empty! you can not checkout');
    }

    public function pay(Request $request)
    {
        
        $input = $request->all();
        $user = Auth::user();
        $shipping_address = ShippingAddress::where('user_id', $user->id)->latest()->first();

        $order['user_id'] = $user->id;
        $order['shipping_id'] = $shipping_address->id;
        $order['total_price'] = Cart::total() + 10000;
        $order['payment_type'] = 'COD';

        
        $checkout = Order::create($order);

        $order_id = $checkout->id;

        foreach (Cart::content() as $cartItem)
        {

            $orderDetails['order_id'] = $order_id;
            $orderDetails['book_id'] = $cartItem->id;
            $orderDetails['book_name'] = $cartItem->name;
            $orderDetails['price'] = $cartItem->price;
            $orderDetails['book_quantity'] = $cartItem->qty;

            
            $details = OrderDetail::create($orderDetails);

            Cart::remove($cartItem->rowId);

            $remove_product = Book::findOrFail($orderDetails['book_id']);

            $remove_product->update([
                'quantity' => $remove_product->quantity - $orderDetails['book_quantity'],
            ]);
        }


        return redirect()->route('user.orders')
            ->with('success_message', 'Order placed successfully. Wait for confirmation.');






    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingAddressRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $shipping = ShippingAddress::create($input);

        return redirect()->route('cart.payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('public.payment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}