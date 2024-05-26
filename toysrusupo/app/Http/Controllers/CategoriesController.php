<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryProductRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        try {
            DB::beginTransaction();

            if ($request->clear_search) {
                session()->forget('search_id');
                session()->forget('last_page');
                session()->forget('categories_last_page');
            }

            $search = session('search_id', null);

            if ($search !== null) {
                $request->request->set('page', 1);
            } elseif (!$request->has('page') && session()->has('last_page')) {
                $request->merge(['page' => session('last_page', 1)]);
            }

            $page = $request->input('page', 1);
            session(['last_page' => $page]);

            $perPage = Config::get('app.per_page');

            $categories = Category::when($search, function ($query) use ($search) {
                return $query->where('id', '=', $search);
            })->paginate($perPage);

            DB::commit();

            return view('categories.index', compact('categories', 'search'));
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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $category = $request->validated();
            Category::create($category);

            $count = Category::count();
            $perPage = Config::get('app.per_page');
            $lastPage = ceil($count / $perPage);

            session()->forget('search_id');

            DB::commit();

            return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $category->update($request->validated());
            $search = session('search_id', null);

            if ($search == null) {
                $lastPage = session('last_page', 1);
            } else {
                $lastPage = 1;
            }

            DB::commit();

            return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $category->delete();
            $search = session('search_id', null);

            if ($search == null) {
                $count = Category::count();
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

            return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category deleted successfully.');
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
                    DB::commit();
                return redirect()->route('categories.index');
            }

            session(['search_id' => $search]);

            $categories = Category::where('id', '=', $search)->paginate();

            DB::commit();

            return view('categories.index', compact('categories', 'search'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function showProducts(Request $request, $id): View
    {
        try {
            DB::beginTransaction();

            $category = Category::with('products')->findOrFail($id);

            if ($request->has('prevPage')) {
                session(['categories_last_page' => $request->prevPage]);
            }

            $search = session('search_id', null);

            if ($search !== null || $request->has('resetPage')) {
                $request->request->set('page', 1);
            } elseif (!$request->has('page') && session()->has('last_page')) {
                $request->merge(['page' => session('last_page', 1)]);
            }

            $page = $request->input('page', 1);
            session(['last_page' => $page]);

            $perPage = Config::get('app.per_page');

            $products = $category->products()->paginate($perPage);

            DB::commit();

            return view('categories.show_products', ['category' => $category, 'products' => $products]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function detachProduct(Category $category, Product $product)
    {
        try {
            DB::beginTransaction();

            $category->products()->detach($product->id);

            $search = session('search_id', null);

            if ($search == null) {
                $count = $category->products()->count();
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

            return redirect()->route('categories.products', ['category' => $category->id, 'page' => $lastPage])
                ->with('success', 'Product has been successfully detached from the category.');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function searchInCategory(Request $request, Category $category): View|RedirectResponse
    {
        try {
            DB::beginTransaction();

            $search = $request->search;

            if (empty($search)) {
                session()->forget('search_id');
                session()->forget('last_page');
                return redirect()->route('categories.products', $category->id);
            }

            session(['search_id' => $search]);

            $products = $category->products()
                ->where('products.id', '=', $search)
                ->paginate();

            DB::commit();

            return view('categories.show_products', [
                'category' => $category,
                'products' => $products,
                'search' => $search
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function addProductForm(Category $category): View
    {
        return view('categories.add-product-form', compact('category'));
    }

    public function addProduct(CategoryProductRequest $request, Category $category): RedirectResponse
    {
        try {
            DB::beginTransaction();

            Log::info("Mipe");

            $validated = $request->validated();
            $product = Product::find($validated['id']);

            $category->products()->attach($product->id);

            DB::commit();

            $count = $category->products()->count();
            $perPage = Config::get('app.per_page');
            $lastPage = ceil($count / $perPage);

            session()->forget('search_id');

            return redirect()->route('categories.products', ['category' => $category->id, 'page' => $lastPage])->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to add product.');
        }
    }
}
