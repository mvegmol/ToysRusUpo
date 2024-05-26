<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class AddressesController extends Controller
{
    protected $countries;

    public function __construct()
    {
        $this->countries = [
            'Albania', 'Andorra', 'Armenia', 'Austria', 'Azerbaijan', 'Belarus', 'Belgium', 'Bosnia and Herzegovina', 'Bulgaria',
            'Croatia', 'Cyprus', 'Czech Republic', 'Denmark', 'Estonia', 'Finland', 'France', 'Georgia', 'Germany', 'Greece',
            'Hungary', 'Iceland', 'Ireland', 'Italy', 'Kazakhstan', 'Kosovo', 'Latvia', 'Liechtenstein', 'Lithuania', 'Luxembourg',
            'Malta', 'Moldova', 'Monaco', 'Montenegro', 'Netherlands', 'North Macedonia', 'Norway', 'Poland', 'Portugal', 'Romania',
            'Russia', 'San Marino', 'Serbia', 'Slovakia', 'Slovenia', 'Spain', 'Sweden', 'Switzerland', 'Turkey', 'Ukraine', 'United Kingdom', 'Vatican City'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $addresses = Auth::user()->address;        
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {        
        return view('addresses.create', ['countries' => $this->countries]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        Address::create($validated);

        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
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
        return view('addresses.edit', [
            'address' => $address,
            'countries' => $this->countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address): RedirectResponse
    {        
        $address->update($request->validated());

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): RedirectResponse
    {
        $address->delete();
        
        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }
}
