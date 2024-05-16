<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    /**Function to add product to shopping cart */
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $cliente_id = Auth::user()->id;
        //Get he user associated with the client_id
        $cliente =User::findOrFail($cliente_id);
        //Get the product associated with the product_id
        $product = Product::findOrFail($product_id);

        //Check if the user exist
        if($cliente == null){
            return redirect()->view('auth.login');
        }else{
            //Check if the product have stock
            if($product->stock > 0){
                //Update the stock of the product
                $product -> stock -= 1;
                $product -> save();
                $carrito = ShoppingCart::where('user_id', $cliente_id)->first();
                 //Chek if the user have a shopping cart
                if($carrito == null){
                    //Create a shopping cart for the user
                    $carrito = new ShoppingCart();
                    $carrito->user_id = $cliente_id;
                    $carrito->save();
                }

                //The client exits,the product has stock and the client has a shopping cart
                //Check if the product is already in the shopping cart
                $productInCart = $carrito->products->where('product_id', $product_id)->first();
                if($productInCart != null){
                    //if the product is already in the shopping cart, increase the quantity and the total price
                    $productInCart->products->updateExistingPivot($product_id, ['quantity' => $productInCart->pivot->quantity + 1,'total_price' => $productInCart->pivot->total_price + $product->price]);
                    //Update the total price and the total products in the shopping cart
                    $carrito->total_price += $product->price;
                    $carrito->total_products += 1;
                    //Redirect to the previous page with a success message
                    $previousUrl = URL::previous();
                    return redirect()->to($previousUrl)->with('success', 'Product added to cart successfully.');

                }else{
                    //if the product is not in the shopping cart, add the product to the shopping cart
                    $carrito->products()->attach($product_id, ['quantity' => 1, 'total_price' => $product->price]);
                    //Update the total price and the total products in the shopping cart
                    $carrito->total_price += $product->price;
                    $carrito->total_products += 1;
                    //Redirect to the previous page with a success message
                    $previousUrl = URL::previous();
                    return redirect()->to($previousUrl)->with('success', 'Product added to cart successfully.');
                }

            }else{
                return redirect()->route('products.show', $product_id)->with('error', 'Product out of stock.');
            }



        }


    }

    public function incrementProduct(Request $request){
        $product_id = $request->input('product_id');
        $cliente_id = Auth::user()->id;
        //Get he user associated with the client_id
        $cliente =User::findOrFail($cliente_id);
        //Get the product associated with the product_id
        $product = Product::findOrFail($product_id);
        //Get the shopping cart of the user
        $carrito = ShoppingCart::where('user_id', $cliente_id)->first();
        //Check if the product is in the shopping cart
        $productInCart = $carrito->products()->where('product_id', $product_id)->first();
        if ($productInCart != null) {
            //Increment the quantity of the product in the shopping cart
            $newQuantity = $productInCart->pivot->quantity + 1;
            // Update the quantity and the total price of the product in the shopping cart
            $carrito->products->updateExistingPivot($product_id, ['quantity' => $newQuantity,'total_price' => $productInCart->pivot->total_price + $product->price]);
            // Update the total price of the shopping cart
            $carrito->total_price += $product->price;
            // Update the total products in the shopping cart
            $carrito->total_products += 1;
            //Save the changes
            $carrito->save();
            //Update the stock of the product
            $product -> stock += 1;
            $product -> save();
            //Redirect to the shopping cart with a success message
            return redirect()->route('carrito.index')->with('success', 'Producto incrementado en el carrito exitosamente.');
        } else {
            return redirect()->route('carrito.index')->with('error', 'El producto no está en el carrito de compras.');
        }

    }

    public function decreaseProduct(Request $request){
        $product_id = $request->input('product_id');
        $cliente_id = Auth::user()->id;
        //Get he user associated with the client_id
        $cliente =User::findOrFail($cliente_id);
        //Get the product associated with the product_id
        $product = Product::findOrFail($product_id);
        //Get the shopping cart of the user
        $carrito = ShoppingCart::where('user_id', $cliente_id)->first();
        //Check if the product is in the shopping cart
        $productInCart = $carrito->products()->where('product_id', $product_id)->first();
        if ($productInCart != null) {
            //Increment the quantity of the product in the shopping cart
            $newQuantity = $productInCart->pivot->quantity - 1;
            // Update the quantity and the total price of the product in the shopping cart
            $carrito->products->updateExistingPivot($product_id, ['quantity' => $newQuantity,'total_price' => $productInCart->pivot->total_price - $product->price]);
            // Update the total price of the shopping cart
            $carrito->total_price -= $product->price;
            // Update the total products in the shopping cart
            $carrito->total_products -= 1;
            //Save the changes
            $carrito->save();
            //Update the stock of the product
            $product -> stock += 1;
            $product -> save();

            //Redirect to the shopping cart with a success message
            return redirect()->route('carrito.index')->with('success', 'Producto incrementado en el carrito exitosamente.');
        } else {
            return redirect()->route('carrito.index')->with('error', 'El producto no está en el carrito de compras.');
        }

    }


}
