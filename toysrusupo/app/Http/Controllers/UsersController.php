<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
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


    public function profile(): View
    {
        try {

            DB::beginTransaction();

            $client_name = Auth::user()->name;


            DB::commit();

            return view('clients.profile', compact('client_name'));
        } catch (\Exception $e) {

            DB::rollback();

            throw $e;
        }
    }
    public function likeorUnlikeProduct(Request $request)
    {
        try {

            DB::beginTransaction();

            $cliente_id = Auth::user()->id;

            $client = User::findOrFail($cliente_id);

            $product_id = $request->input('product_id');

            $product = Product::findOrFail($product_id);

            $likeProduct = $client->favouriteProducts()->where('product_id', $product_id)->first();

            if ($likeProduct == null) {
                $client->favouriteProducts()->attach($product_id);
            } else {
                $client->favouriteProducts()->detach($product_id);
            }


            DB::commit();

            $previousUrl = URL::previous();
            return redirect()->to($previousUrl)->with('success', 'Like product correct');
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }
}
