<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the client ID
            $cliente_id = Auth::user()->id;

            // Check if the user is an admin
            if (Auth::user()->rol === 'admin') {
                $query = Order::query();
            } else {
                // If not an admin, retrieve only user's orders
                $query = Order::where('user_id', $cliente_id);
            }
        } else {
            // If not authenticated, redirect to the previous page
            return redirect()->back();
        }

        if (!$request->has('page') && session()->has('last_page')) {
            $request->merge(['page' => session('last_page', 1)]);
        }

        $page = $request->input('page', 1);
        session(['last_page' => $page]);

        // Get filter parameters
        $orderType = $request->input('order_type', 'all');
        $duration = $request->input('duration', 'this_week');

        if ($orderType !== 'all') {
            $query->where('status', $orderType);
        }

        switch ($duration) {
            case 'this_month':
                $query->where('created_at', '>=', now()->startOfMonth());
                break;
            case 'last_3_months':
                $query->where('created_at', '>=', now()->subMonths(3));
                break;
            case 'last_6_months':
                $query->where('created_at', '>=', now()->subMonths(6));
                break;
            case 'this_year':
                $query->where('created_at', '>=', now()->startOfYear());
                break;
            default:
                // Default is this week
                $query->where('created_at', '>=', now()->startOfWeek());
                break;
        }

        $orders = $query->paginate(5);
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
    public function show(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $user = $order->user;
        $previousOrdersCount = $user->orders->count();

        // Obtener el número de página actual
        $page = $request->input('page', session('last_page', 1));

        // Guardar el número de página actual en la sesión
        session(['last_page' => $page]);

        // Obtener productos paginados con sus categorías
        $products = $order->products()->with('categories')->paginate(3);
        //dd($products);
        // Añadir nombres de categorías a los productos
        $products->each(function ($product) {
            $product->category_names = $product->categories->pluck('name')->implode(', ');
        });
        if(($order->total_price-5)<50)
        {
            $shipping = "$5";
            $subtotal = $order->total_price-5;

        }else{
            $shipping = "Free Shipping";
            $subtotal = $order->total_price;
        }

        return view('orders.show', compact('order', 'user', 'previousOrdersCount', 'products','shipping','subtotal'));
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

    public function buy()
    {
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

        $order->address = "Sin Dirección todavía";

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
