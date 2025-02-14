<?php

namespace App\Http\Controllers;

use App\Models\PemetaanIspa;
use Illuminate\Http\Request;

class PemetaanIspaController extends Controller
{
    public function index(Request $request)
    {
        $query = PemetaanIspa::query();
        
        if ($request->has('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }
        
        $locations = $query->paginate(10);
        return view('pages.app.list-data', [
            'type_menu' => 'data',
            'locations' => $locations
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_desa' => 'required',
            'jumlah_terkena' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required',
            'address' => 'nullable'
        ]);

        PemetaanIspa::create($validatedData);
        return redirect()->route('list.data')->with('success', 'Data berhasil disimpan');
    }

    public function getLocations()
    {
        $locations = PemetaanIspa::all();
        return response()->json($locations);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_desa' => 'required',
            'jumlah_terkena' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'marker_color' => 'required',
            'address' => 'nullable'
        ]);

        $pemetaan = PemetaanIspa::findOrFail($id);
        $pemetaan->update($validatedData);

        return redirect()->route('list.data')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pemetaan = PemetaanIspa::findOrFail($id);
        $pemetaan->delete();

        return redirect()->route('list.data')->with('success', 'Data berhasil dihapus');
    }
}