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
    public function show_products()
    {
        // Obtain the authenticated user's ID
        $cliente_id = Auth::user()->id;

        // Obtain the user's shopping cart
        $carrito = ShoppingCart::where('user_id', $cliente_id)->first();

        // Check if the shopping cart exists
        if (!$carrito) {
            $previousUrl = URL::previous();
            return redirect()->to($previousUrl)->with('error', 'The shopping cart does not exist.');
        }

        // Get the products in the cart
        $productos = $carrito->products;

        // Check if the cart has products
        if ($productos->isEmpty()) {
            $previousUrl = URL::previous();
            return redirect()->to($previousUrl)->with('error', 'The cart has no products.');
        }

        // Return the view with the products
        return view('carts.show', compact('productos','carrito'));
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

        // Get the user associated with the cliente_id
        $cliente = User::findOrFail($cliente_id);

        // Get the product associated with the product_id
        $product = Product::findOrFail($product_id);

        // Check if the user exists
        if ($cliente == null) {
            return redirect()->view('auth.login');
        } else {
            // Check if the product has stock
            if ($product->stock > 0) {

                // Check if the user has a shopping cart
                $carrito = ShoppingCart::where('user_id', $cliente_id)->first();

                if ($carrito == null) {
                    // Create a shopping cart for the user
                    $carrito = new ShoppingCart();
                    $carrito->user_id = $cliente_id;
                    $carrito->save();
                }

                // Check if the product is already in the shopping cart
                $productInCart = $carrito->products()->where('product_id', $product_id)->first();
                if ($productInCart != null) {
                    // If the product is already in the shopping cart, increase the quantity and the total price
                    $carrito->products()->updateExistingPivot($product_id, [
                        'quantity' => $productInCart->pivot->quantity + 1,
                        'total_price' => $productInCart->pivot->total_price + $product->price
                    ]);
                } else {
                    // If the product is not in the shopping cart, add the product to the shopping cart
                    $carrito->products()->attach($product_id, [
                        'quantity' => 1,
                        'total_price' => $product->price
                    ]);
                }

                // Update the total price and the total products in the shopping cart
                $carrito->total_price += $product->price;
                $carrito->total_products += 1;
                $carrito->save();
                // Redirect to the previous page with a success message
                $previousUrl = URL::previous();
                return redirect()->to($previousUrl)->with('success', 'Product added to cart successfully.');

            } else {
                return redirect()->route('products.show', $product_id)->with('error', 'Product out of stock.');
            }
        }
    }

    public function incrementProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $product_id = $request->input('product_id');
        $user_id = Auth::id();

        $carrito = ShoppingCart::where('user_id', $user_id)->first();
        $product = Product::findOrFail($product_id);

        if ($carrito) {
            $productInCart = $carrito->products()->where('product_id', $product_id)->first();
            if ($productInCart) {
                $newQuantity = $productInCart->pivot->quantity + 1;
                $carrito->products()->updateExistingPivot($product_id, [
                    'quantity' => $newQuantity,
                    'total_price' => $productInCart->pivot->total_price + $product->price
                ]);
                $carrito->total_price += $product->price;
                $carrito->total_products += 1;
                $carrito->save();
            }
        }

        // Return JSON response
        return response()->json(['success' => true]);
    }

    public function decreaseProduct(Request $request)
{
    try {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $product_id = $request->input('product_id');
        $user_id = Auth::id();

        $carrito = ShoppingCart::where('user_id', $user_id)->first();
        $product = Product::findOrFail($product_id);

        if ($carrito) {
            $productInCart = $carrito->products()->where('product_id', $product_id)->first();
            if ($productInCart) {
                $newQuantity = $productInCart->pivot->quantity - 1;
                if ($newQuantity > 0) {
                    $carrito->products()->updateExistingPivot($product_id, [
                        'quantity' => $newQuantity,
                        'total_price' => $productInCart->pivot->total_price - $product->price
                    ]);
                    $carrito->total_price -= $product->price;
                    $carrito->total_products -= 1;
                    $carrito->save();
                } else {
                    $carrito->products()->detach($product_id);
                    $carrito->total_price -= $product->price;
                    $carrito->total_products -= 1;
                    $carrito->save();
                }
            }
        }

        // Return success JSON response
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Return error JSON response
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    public function updateQuantityProduct(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $quantity = $request->input('quantity');
        $product_id = $request->input('product_id');
        $user_id = Auth::id();

        $carrito = ShoppingCart::where('user_id', $user_id)->first();
        $product = Product::findOrFail($product_id);

        if ($carrito) {
            $productInCart = $carrito->products()->where('product_id', $product_id)->first();
            if ($productInCart) {
                $carrito->products()->updateExistingPivot($product_id, [
                    'quantity' => $quantity,
                    'total_price' => $product->price * $quantity
                ]);

                // Recalculate total_price and total_products
                $total_price = $carrito->products->sum(function($product) {
                    return $product->pivot->total_price;
                });
                $total_products = $carrito->products->sum(function($product) {
                    return $product->pivot->quantity;
                });

                $carrito->total_price = $total_price;
                $carrito->total_products = $total_products;
                $carrito->save();
            }
        }

        // Return JSON response
        return response()->json(['success' => true]);
    }



}
