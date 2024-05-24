<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function home(Request $request): View
    {
        $search = session('search_id', null);

        if ($search !== null) {
            $request->request->set('page', 1);
        } elseif (!$request->has('page') && session()->has('last_page')) {
            $request->merge(['page' => session('last_page', 1)]);
        }

        $page = $request->input('page', 1);
        session(['last_page' => $page]);

        $perPage = Config::get('app.per_page');

        $products = Product::with('categories')
            ->when($search, function ($query) use ($search) {
                return $query->where('id', '=', $search);
            })
            ->paginate($perPage);

        foreach ($products as $product) {
            $product->category_names = $product->categories->pluck('name')->join(', ');
        }

        return view('clients.home', compact('products', 'search'));
    }


    public function index(Request $request): View
    {
        $search = session('search_id', null);

        if ($search !== null) {
            $request->request->set('page', 1);
        } elseif (!$request->has('page') && session()->has('last_page')) {
            $request->merge(['page' => session('last_page', 1)]);
        }

        $page = $request->input('page', 1);
        session(['last_page' => $page]);

        $perPage = Config::get('app.per_page');

        $products = Product::with('categories')
            ->when($search, function ($query) use ($search) {
                return $query->where('id', '=', $search);
            })
            ->paginate($perPage);

        foreach ($products as $product) {
            $product->category_names = $product->categories->pluck('name')->join(', ');
        }

        return view('products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->only('name', 'description', 'price', 'stock', 'min_age'));
        $product->categories()->sync($request->categories);

        $count = Product::count();
        $perPage = Config::get('app.per_page');
        $lastPage = ceil($count / $perPage);

        session()->forget('search_id');

        return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($productId): View
    {
        $product = Product::with('categories')->findOrFail($productId);
        $product->category_names = $product->categories->pluck('name')->join(', ');

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->only('name', 'description', 'price', 'stock', 'min_age'));
        $product->categories()->sync($request->categories);
        $search = session('search_id', null);

        if ($search == null) {
            $lastPage = session('last_page', 1);
        } else {
            $lastPage = 1;
        }

        return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->categories()->detach();
        $product->delete();
        $search = session('search_id', null);

        if ($search == null) {
            $count = Product::count();
            $perPage = Config::get('app.per_page');
            $totalPages = ceil($count / $perPage);
            $lastPage = session('last_page', 1);

            if ($lastPage > $totalPages) {
                $lastPage = $totalPages;
            }
        } else {
            $lastPage = 1;
        }

        return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request): View|RedirectResponse
    {
        $search = $request->search;

        if (empty($search)) {
            session()->forget('search_id');
            session()->forget('last_page');
            return redirect()->route('products.index');
        }

        session(['search_id' => $search]);

        $products = Product::with('categories')
            ->where('id', '=', $search)
            ->paginate();

        foreach ($products as $product) {
            $product->category_names = $product->categories->pluck('name')->join(', ');
        }

        return view('products.index', compact('products', 'search'));
    }

    public function show_client($productId): View
    {
        $product = Product::with('categories')->findOrFail($productId);
        $product->category_names = $product->categories->pluck('name')->join(', ');

        return view('clients.productDetails', compact('product'));
    }

}
