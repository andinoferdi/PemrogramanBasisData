<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('dashboard.vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('dashboard.vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required',
            'badan_hukum' => 'required',
            'status' => 'required',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor created successfully.');
    }
public function edit($id)
{
    $vendor = Vendor::find($id); // Mencari vendor berdasarkan 'idvendor'
    return view('dashboard.vendor.edit', compact('vendor'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_vendor' => 'required',
        'badan_hukum' => 'required',
        'status' => 'required',
    ]);

    $vendor = Vendor::find($id); // Mencari vendor berdasarkan 'idvendor'
    $vendor->update($request->all());

    return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully.');
}


    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }
}
