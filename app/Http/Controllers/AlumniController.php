<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Imports\AlumniImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnis = Alumni::select('id', 'nama', 'nis', 'sex', 'tahun_lulus', 'kelas', 'status', 'bin')->get();
        return view('dashboard.pages.alumni.alumni', compact('alumnis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:alumni,nis',
            'sex' => 'required|string|max:1',
            'tahun_lulus' => 'required|numeric',
            'kelas' => 'required|string',
            'status' => 'required|string',
            'bin' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('foto');

        // Handle file upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('alumni_fotos', 'public');
            $data['foto'] = $path;
        }

        $alumni = Alumni::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data alumni berhasil disimpan!',
            'alumni' => $alumni->fresh() // Mengembalikan data yang baru dibuat
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:alumni,nis,' . $id,
            'sex' => 'required|string|max:1',
            'tahun_lulus' => 'required|numeric',
            'kelas' => 'required|string',
            'status' => 'required|string',
            'bin' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $alumni = Alumni::findOrFail($id);
        $data = $request->except('foto');

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }

            $path = $request->file('foto')->store('alumni_fotos', 'public');
            $data['foto'] = $path;
        }

        $alumni->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data alumni berhasil diperbarui!',
            'alumni' => $alumni->fresh() // Mengembalikan data terbaru
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumni = Alumni::find($id);
        
        if($alumni) {
            $alumni->delete();
            return redirect()->back()->with('success', 'Data alumni berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan!');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new AlumniImport, $request->file('file'));
            return back()->with('success', 'Data alumni berhasil diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
