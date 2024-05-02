<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //
        if(!$request->has('page') && session()->has('last_page')) {
            $request->merge(['page' => session('last_page', 1)]);
        }
        $page = $request->input('page', 1);
        session(['last_page' => $page]);
        $addresses = Address::paginate(5);
        return view('addresses.index', compact('addresses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('addresses.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request): RedirectResponse
    {

        $address = $request->validated();
        Address::create($address);
        $count = Address::count();
        $perPage = Config::get('app.per_page');
        $lastPage = ceil($count / $perPage);

        return redirect()->route('addresses.index', ['page' => $lastPage])->with('success', 'Address created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address): View
    {
        //
        return view('addresses.show', compact('address'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address): View
    {
        return view('addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request,Address $address): RedirectResponse
    {
        $lastPage = session('last_page', 1);
        $address->update($request->validated());

        return redirect()->route('addresses.index', ['page' => $lastPage])->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): RedirectResponse
    {
        $address->delete();
        $count = Address::count();
        $perPage = Config::get('app.per_page');
        $totalPages = ceil($count / $perPage);
        $lastPage = ceil($count / $perPage);
        if ($lastPage > $totalPages) {
            $lastPage = $totalPages;
        }
        return redirect()->route('addresses.index', ['page' => $lastPage])->with('success', 'Address deleted successfully.');
    }
}
