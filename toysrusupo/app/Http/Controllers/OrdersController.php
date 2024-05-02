<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
