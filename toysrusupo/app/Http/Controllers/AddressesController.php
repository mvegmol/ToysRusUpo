<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $addresses = Auth::user()->address;

            DB::commit();

            return view('addresses.index', compact('addresses'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to fetch addresses.');
        }
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
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $validated['user_id'] = Auth::id();
            Address::create($validated);

            DB::commit();

            return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create address.');
        }
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
    public function edit(Address $address): View|RedirectResponse
{
    try {
        DB::beginTransaction();

        $view = view('addresses.edit', [
            'address' => $address,
            'countries' => $this->countries
        ]);

        DB::commit();

        return $view;
    } catch (\Exception $e) {
        DB::rollBack();
        return view('error')->with('message', 'Failed to load address for editing.');
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $address->update($request->validated());

            DB::commit();

            return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update address.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $address->delete();

            DB::commit();

            return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('addresses.index')->with('error', 'Failed to delete address.');
        }
    }
}
