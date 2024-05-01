<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        if (!$request->has('page') && session()->has('last_page')) {
            $request->merge(['page' => session('last_page', 1)]);
        }

        $page = $request->input('page', 1);
        session(['last_page' => $page]);

        $products = Product::paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $product = $request->validated();        
        Product::create($product);

        $count = Product::count();
        $perPage = Config::get('app.per_page');
        $lastPage = ceil($count / $perPage);

        return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $lastPage = session('last_page', 1);

        $product->update($request->validated());
        return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        $count = Product::count();
        $perPage = Config::get('app.per_page');
        $totalPages = ceil($count / $perPage);
        $lastPage = session('last_page', 1);

        if ($lastPage > $totalPages) {
            $lastPage = $totalPages;
        }

        return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request): View|RedirectResponse
    {
        $search = $request->search;

        if (empty($search)) {
            return redirect()->route('products.index');
        }

        $products = Product::where('id', '=', $search)->paginate();

        return view('products.index', compact('products', 'search'));
    }
}
