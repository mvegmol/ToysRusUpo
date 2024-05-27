<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InformativeEmail;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $cliente_id = Auth::user()->id;
            DB::beginTransaction();

            try {
                // Check if the user is an admin
                if (Auth::user()->rol === 'admin') {
                    $query = Order::query();
                } else {
                    // If not an admin, retrieve only user's orders
                    $query = Order::where('user_id', $cliente_id);
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
                        $query->where('created_at', '>=', now()->startOfWeek());
                        break;
                }

                if ($request->has('new_order_data')) {
                    $orderData = $request->input('new_order_data');
                    Order::create($orderData); // This is just an example
                }

                DB::commit();

                $orders = $query->paginate(5);
                return view('orders.index', compact('orders'));

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred while processing your request.');
            }

        } else {

            return view('auth.login');
        }
    }
    /**
     * Display a paginated listing of orders for a specific user.
     */
    public function ordersByUser(Request $request)
    {
        try{
            if(!Auth::check()){
                return redirect()->route('login');
            }

            DB::beginTransaction();
            $user_id = $request->route('user_id');
            if(!$request->has('page') && session()->has('last_page')){
                $request->merge(['page' => session('last_page', 1)]);
            }
            $page = $request->input('page', 1);
            session(['last_page' => $page]);

            $orders = Order::where('user_id', $user_id)->paginate(5);
            DB::commit();
            return view('orders.index', compact('orders'));
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your request.');

        }
    }

    public function updateStatus(Request $request)
    {
        try{
            DB::beginTransaction();
            $order = Order::findOrFail($request->id);
            $status = $request->status;

            if($status == 'pending'){
                $order->status = 'accepted';
            }elseif($status == 'accepted'){
                $order->status = 'in progress';
            }elseif($status == 'in progress'){
                $order->status = 'delivered';
            }
            DB::commit();
            return redirect()->route('orders.show', $order->id)->with('success', 'Order status updated successfully.');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
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
        if (Auth::check()) {
            try{

                DB::beginTransaction();

                $order = Order::findOrFail($id);
                $user = $order->user;
                $previousOrdersCount = $user->orders->count();
                // Obtener productos paginados con sus categorías
                $products = $order->products()->with('categories')->get();
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

                DB::commit();
                return view('orders.show', compact('order', 'user', 'previousOrdersCount','products','shipping','subtotal'));

            }catch(\Exception $e){

                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred while processing your request.');
            }
        }
        else {
            return view('auth.login');
        }
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
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }


            DB::beginTransaction();
            $cliente_id = Auth::user()->id;
            // Obtain the user's shopping cart
            $carrito = ShoppingCart::where('user_id', $cliente_id)->first();

            $productos = $carrito->products;

            $address_id = $request->input('selected_address_id');

            $direcciones = collect(Auth::user()->address);


            $address = $direcciones->firstWhere('id', $address_id);

            //Creamos un order
            $order = new Order();

            $order->user_id = $cliente_id;
            if ($carrito->total_price < 50) {
                $order->total_price = ($carrito->total_price) + 5;
            } else {
                $order->total_price = $carrito->total_price;
            }

            $order->address = "Direction: {$address->direction}, City: {$address->city}, Province: {$address->province}, ZIP Code: {$address->zip_code}, Country: {$address->country}, Full Name: {$address->full_name}, Phone Number: {$address->phone_number}";

            $order->status = 'pending';

            $order->created_at = now();


            $order->save();

            $productos = $carrito->products;

            foreach ($productos as $p) {
                //dd($productos);
                $order->products()->attach(
                    $p->id,
                    [
                        'quantity' => $p->pivot->quantity,
                        'price' => $p->pivot->total_price
                    ]
                );
                $p->stock = $p->pivot->quantity;
                $p->save();
            }

            $carrito->delete();
            Mail::to(Auth::user()->email)->send(new InformativeEmail($order,$productos,Auth::user()->email));
            DB::commit();

            return redirect()->route('welcome.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

}
