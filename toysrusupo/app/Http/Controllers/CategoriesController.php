<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class CategoriesController extends Controller
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

        $perPage = Config::get('app.per_page');
        $categories = Category::paginate($perPage);
        return view('categories.index', compact('categories'));
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
        $category = $request->validated();        
        Category::create($category);

        $count = Category::count();
        $perPage = Config::get('app.per_page');
        $lastPage = ceil($count / $perPage);

        return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category created successfully.');
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
        $lastPage = session('last_page', 1);

        $category->update($request->validated());
        return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        $count = Category::count();
        $perPage = Config::get('app.per_page');
        $totalPages = ceil($count / $perPage);
        $lastPage = session('last_page', 1);

        if ($lastPage > $totalPages) {
            $lastPage = $totalPages;
        }

        return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category deleted successfully.');
    }

    public function search(Request $request): View|RedirectResponse
    {
        $search = $request->search;

        if (empty($search)) {
            return redirect()->route('categories.index');
        }

        $categories = Category::where('id', '=', $search)->paginate();

        return view('categories.index', compact('categories', 'search'));
    }
}
