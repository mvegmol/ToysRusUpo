<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show_products()
    {
        try {
            // Iniciar la transacción
            DB::beginTransaction();

            // Obtener el ID del usuario autenticado
            $cliente_id = Auth::user()->id;

            // Obtener el carrito de compras del usuario
            $carrito = ShoppingCart::where('user_id', $cliente_id)->first();

            // Verificar si el carrito de compras existe
            if (!$carrito) {
                $previousUrl = URL::previous();
                return redirect()->to($previousUrl)->with('error', 'El carrito de compras no existe.');
            }

            // Obtener los productos en el carrito
            $productos = $carrito->products()->paginate(3);

            // Verificar si el carrito tiene productos
            if ($productos->isEmpty()) {
                $previousUrl = URL::previous();
                return redirect()->to($previousUrl)->with('error', 'El carrito no tiene productos.');
            }

            // Commit la transacción si todo está bien
            DB::commit();

            // Devolver la vista con los productos
            return view('carts.show', compact('productos', 'carrito'));
        } catch (\Exception $e) {
            // Rollback la transacción en caso de excepción
            DB::rollback();
            // Manejar la excepción o re-lanzarla
            throw $e;
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
        try {
            // Iniciar la transacción
            DB::beginTransaction();

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

                    // Commit la transacción
                    DB::commit();

                    // Redirect to the previous page with a success message
                    $previousUrl = URL::previous();
                    return redirect()->to($previousUrl)->with('success', 'Product added to cart successfully.');
                } else {
                    return redirect()->route('products.show', $product_id)->with('error', 'Product out of stock.');
                }
            }
        } catch (\Exception $e) {
            // Rollback la transacción en caso de excepción
            DB::rollback();
            // Manejar la excepción o re-lanzarla
            throw $e;
        }
    }

    public function incrementProduct(Request $request)
    {
        try {
            // Iniciar la transacción
            DB::beginTransaction();

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

                    if ($product->stock >= $newQuantity) {
                        $carrito->products()->updateExistingPivot($product_id, [
                            'quantity' => $newQuantity,
                            'total_price' => $productInCart->pivot->total_price + $product->price
                        ]);
                        $carrito->total_price += $product->price;
                        $carrito->total_products += 1;
                        $carrito->save();
                    } else {
                        // Rollback la transacción
                        DB::rollback();
                        return response()->json(['error' => true, 'message' => 'No hay suficiente cantidad disponible'], 400);
                    }
                }
            }

            // Commit la transacción
            DB::commit();

            // Return JSON response
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Rollback la transacción en caso de excepción
            DB::rollback();
            // Manejar la excepción o re-lanzarla
            throw $e;
        }
    }

    public function decreaseProduct(Request $request)
    {
        try {

            DB::beginTransaction();

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


            DB::commit();


            return response()->json(['success' => true]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateQuantityProduct(Request $request)
    {
        try {

            DB::beginTransaction();

            $request->validate([
                'quantity' => 'required|integer|min:1',
                'product_id' => 'required|integer|exists:products,id'
            ]);

            $quantity = $request->input('quantity');
            $product_id = $request->input('product_id');
            $user_id = Auth::id();

            $carrito = ShoppingCart::where('user_id', $user_id)->first();
            $product = Product::findOrFail($product_id);

            if ($product->stock >= $quantity) {
                if ($carrito) {
                    $productInCart = $carrito->products()->where('product_id', $product_id)->first();
                    if ($productInCart) {
                        $carrito->products()->updateExistingPivot($product_id, [
                            'quantity' => $quantity,
                            'total_price' => $product->price * $quantity
                        ]);

                        // Recalculate total_price and total_products
                        $total_price = $carrito->products->sum(function ($product) {
                            return $product->pivot->total_price;
                        });
                        $total_products = $carrito->products->sum(function ($product) {
                            return $product->pivot->quantity;
                        });

                        $carrito->total_price = $total_price;
                        $carrito->total_products = $total_products;
                        $carrito->save();
                    }
                }
            } else {

                DB::rollback();
                return response()->json(['error' => false, 'message' => 'No hay suficiente cantidad disponible'], 400);
            }


            DB::commit();


            return response()->json(['success' => true]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteProductCart(Request $request)
    {
        try {

            DB::beginTransaction();


            $request->validate([
                'product_id' => 'required|integer|exists:products,id'
            ]);

            // Obtener el ID del producto y el ID del usuario
            $product_id = $request->input('product_id');
            $user_id = Auth::id();

            // Encontrar el carrito del usuario
            $carrito = ShoppingCart::where('user_id', $user_id)->first();

            // Verificar que el carrito exista
            if (!$carrito) {
                // Rollback la transacción
                DB::rollback();
                return redirect()->route('welcome.index')->with('error', 'Carrito no encontrado');
            }

            // Verificar que el producto esté en el carrito
            $product = $carrito->products()->where('product_id', $product_id)->first();

            if (!$product) {
                // Rollback la transacción
                DB::rollback();
                return redirect()->back()->with('error', 'Producto no encontrado en el carrito');
            }

            // Obtener la cantidad del producto en el carrito
            $quantity = $product->pivot->quantity;

            // Eliminar el producto del carrito
            $carrito->products()->detach($product_id);

            // Actualizar el precio total del carrito
            $carrito->total_price -= $product->price * $quantity;

            // Actualizar la cantidad total de productos en el carrito
            $carrito->total_products -= $quantity;

            // Guardar los cambios en el carrito
            $carrito->save();


            DB::commit();

            // Verificar si quedan productos en el carrito
            if ($carrito->products()->count() == 0) {
                // Si el carrito está vacío, redirigir a la página de bienvenida
                return redirect()->route('welcome.index')->with('success', 'Producto eliminado del carrito. El carrito está vacío.');
            }

            // Redirigir a la URL previa si aún hay productos en el carrito

            return redirect()->route('carts.show_products')->with('error', 'Producto eliminado del carrito.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function checkout()
    {
        try {

            DB::beginTransaction();

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


            DB::commit();

            // Return the view with the products
            return view('carts.checkout', compact('productos', 'carrito'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
