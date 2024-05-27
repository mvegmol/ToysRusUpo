<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        try {
            DB::beginTransaction();

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

            $favorites = [];
            if (Auth::check()) {
                $favorites = Auth::user()->favouriteProducts->pluck('id')->toArray();
            }


            DB::commit();

            return view('clients.home', compact('products', 'search', 'favorites'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function toys(Request $request): View
    {
        $perPage = Config::get('app.toys_per_page');
        $products = Product::with('categories')->paginate($perPage);

        $favorites = [];
        if (Auth::check()) {
            $favorites = Auth::user()->favouriteProducts->pluck('id')->toArray();
        }

        $categories = Category::all();

        return view('products.toys', compact('products', 'favorites', 'categories'));
    }

    public function categoryToys(Request $request, $id): View
    {
        $category = Category::with('products')->findOrFail($id);
        $perPage = Config::get('app.per_page');
        $products = $category->products()->paginate($perPage);

        $favorites = [];
        if (Auth::check()) {
            $favorites = Auth::user()->favouriteProducts->pluck('id')->toArray();
        }

        $categories = Category::all();

        return view('products.toys', compact('category', 'products', 'favorites', 'categories'));
    }

    public function index(Request $request): View
    {
        try {
            DB::beginTransaction();

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

            DB::commit();

            return view('products.index', compact('products', 'search'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        try {
            DB::beginTransaction();

            $categories = Category::all();

            DB::commit();

            return view('products.create', compact('categories'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $product = Product::create($request->only('name', 'description', 'price', 'stock', 'min_age'));
            $product->categories()->sync($request->categories);

            $count = Product::count();
            $perPage = Config::get('app.per_page');
            $lastPage = ceil($count / $perPage);

            session()->forget('search_id');

            DB::commit();

            return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($productId): View
    {
        try {
            DB::beginTransaction();

            $product = Product::with('categories')->findOrFail($productId);
            $product->category_names = $product->categories->pluck('name')->join(', ');

            DB::commit();

            return view('products.show', compact('product'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(Product $product): View
    {
        try {
            DB::beginTransaction();

            $categories = Category::all();

            DB::commit();

            return view('products.edit', compact('product', 'categories'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $product->update($request->only('name', 'description', 'price', 'stock', 'min_age'));
            $product->categories()->sync($request->categories);
            $search = session('search_id', null);

            if ($search == null) {
                $lastPage = session('last_page', 1);
            } else {
                $lastPage = 1;
            }

            DB::commit();

            return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        try {
            DB::beginTransaction();

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

            DB::commit();

            return redirect()->route('products.index', ['page' => $lastPage])->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request): View|RedirectResponse
    {
        try {
            DB::beginTransaction();

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

            DB::commit();

            return view('products.index', compact('products', 'search'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show_client($productId): View
    {
        try {
            DB::beginTransaction();



            $product = Product::with('categories')->findOrFail($productId);
            $product->category_names = $product->categories->pluck('name')->join(', ');

            DB::commit();

            return view('clients.productDetails', compact('product'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }
    public function productsLike()
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        try {

            DB::beginTransaction();


            $cliente_id = Auth::user()->id;

            $client = User::findOrFail($cliente_id);

            $products = $client->favouriteProducts()->paginate(16);

            $categories = Category::all();
            $favorites = [];
            $favorites = Auth::user()->favouriteProducts->pluck('id')->toArray();

            DB::commit();

            return view('products.favourite', compact('products', 'favorites', 'categories'));

        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }

    public function categoryToysFavourite(Request $request, $id): View
    {
        try {
            DB::beginTransaction();
            $category = Category::with('products')->findOrFail($id);

            $cliente_id = Auth::user()->id;
            $client = User::findOrFail($cliente_id);

            $products = $client->favouriteProducts()
                            ->whereHas('categories', function($query) use ($id) {
                                $query->where('categories.id', $id);
                            })
                            ->paginate(16);

            $favorites = Auth::user()->favouriteProducts->pluck('id')->toArray();

            $categories = Category::all();

            DB::commit();

            return view('products.favourite', compact('category', 'products', 'favorites', 'categories'));


        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function productsMoreLike()
    {
        try {
            DB::beginTransaction();

            $query = Product::orderByFavorites();

            $products = $query->paginate(8);

            // Cargar relaciones para cada producto
            $products->load('categories');

            foreach ($products as $product) {
                $product->category_names = $product->categories->pluck('name')->join(', ');

            }

            DB::commit();

            return view('products.favourite_ad', compact('products'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


}
