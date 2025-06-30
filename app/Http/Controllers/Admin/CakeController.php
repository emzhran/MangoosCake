<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cake;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'nama_kue' => 'required|string|max:255',
            'harga_kue' => 'required|numeric|min:0',
            'gambar_kue' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // 2. Proses upload file gambar
        $path = null;
        if ($request->hasFile('gambar_kue')) {
            // Simpan gambar ke folder 'public/kue' dan dapatkan path-nya
            // Laravel akan otomatis membuat folder 'kue' jika belum ada
            $path = $request->file('gambar_kue')->store('public/kue');
        }

        // 3. Simpan data ke database, termasuk path gambar
        Cake::create([
            'nama_kue' => $request->nama_kue,
            'harga_kue' => $request->harga_kue,
            'gambar_kue' => $path, 
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.datakue.index')
                        ->with('success', 'Kue baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cake $cake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cake $cake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cake $cake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cake $cake)
    {
        //
    }
}
