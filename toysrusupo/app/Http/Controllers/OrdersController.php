<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        if(!$request->has('page') && session()->has('last_page')){
            $request->merge(['page' => session('last_page', 1)]);
        }
        $page = $request->input('page', 1);
        session(['last_page' => $page]);

        $orders = Order::paginate(5);
        return view('orders.index', compact('orders'));

    }
    /**
     * Display a paginated listing of orders for a specific user.
     */
    public function ordersByUser(Request $request):View
    {
        $user_id = $request->route('user_id');
        if(!$request->has('page') && session()->has('last_page')){
            $request->merge(['page' => session('last_page', 1)]);
        }
        $page = $request->input('page', 1);
        session(['last_page' => $page]);

        $orders = Order::where('user_id', $user_id)->paginate(5);
        return view('orders.index', compact('orders'));

    }

    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $status = $request->status;

        if($status == 'pending'){
            $order->status = 'accepted';
        }elseif($status == 'accepted'){
            $order->status = 'in progress';
        }elseif($status == 'in progress'){
            $order->status = 'delivered';
        }
        return redirect()->route('orders.show', $order->id)->with('success', 'Order status updated successfully.');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$user_id)
    {
        //php artisan make:request AddressRequest
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function buy(Request $request)
    {

        $address_id = $request->input('selected_address_id');

        $direcciones = collect(Auth::user()->address);


        $address = $direcciones->firstWhere('id', $address_id);



        $cliente_id = Auth::user()->id;

        // Obtain the user's shopping cart
        $carrito = ShoppingCart::where('user_id', $cliente_id)->first();

        $productos = $carrito->products;

        //Creamos un order
        $order = new Order();

        $order ->user_id = $cliente_id;
        if($carrito->total_price<50)
        {
            $order ->total_price = ($carrito->total_price)+5;
        }else{
            $order ->total_price = $carrito->total_price;
        }


        $order->address = "Direction: {$address->direction}, City: {$address->city}, Province: {$address->province}, ZIP Code: {$address->zip_code}, Country: {$address->country}, Full Name: {$address->full_name}, Phone Number: {$address->phone_number}";

        $order->status= 'pending';

        $order->created_at = now();


        $order->save();

        $productos = $carrito->products;

        foreach($productos as $p){
            //dd($productos);
            $order->products()->attach($p->id,
            [
                'quantity' => $p->pivot->quantity,
                'price' => $p->pivot->total_price
            ]
            );
            $p->stock = $p->pivot->quantity;
            $p->save();
        }



        $carrito->delete();

        return redirect()->route('welcome.index');

    }
}
