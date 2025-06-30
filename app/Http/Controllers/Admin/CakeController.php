<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CakeController extends Controller
{
    /**
     * Menampilkan daftar semua kue.
     */
    public function index()
    {
        $cakes = Cake::latest()->paginate(10);
        return view('admin.cakes.index', compact('cakes'));
    }

    /**
     * Menampilkan form untuk membuat kue baru.
     */
    public function create()
    {
        return view('admin.cakes.create');
    }

    /**
     * Menyimpan kue baru ke database. (CREATE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kue' => 'required|string|max:255',
            'harga_kue' => 'required|numeric|min:0',
            'gambar_kue' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan gambar ke folder 'kue' di dalam disk 'public'
        // Ini akan menyimpan file fisik di: storage/app/public/kue
        $path = $request->file('gambar_kue')->store('kue', 'public');

        Cake::create([
            'nama_kue' => $request->nama_kue,
            'harga_kue' => $request->harga_kue,
            'gambar_kue' => $path, // Path yang tersimpan sekarang adalah 'kue/namafile.jpg'
        ]);

        return redirect()->route('admin.datakue.index')
                         ->with('success', 'Kue baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kue.
     */
    public function edit(Cake $datakue)
    {
        return view('admin.cakes.edit', ['cake' => $datakue]);
    }

    /**
     * Memperbarui data kue di database. (UPDATE)
     */
    public function update(Request $request, Cake $datakue)
    {
        $request->validate([
            'nama_kue' => 'required|string|max:255',
            'harga_kue' => 'required|numeric|min:0',
            'gambar_kue' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $datakue->gambar_kue;

        if ($request->hasFile('gambar_kue')) {
            // Hapus gambar lama dari disk 'public'
            if ($datakue->gambar_kue) {
                Storage::disk('public')->delete($datakue->gambar_kue);
            }
            // Upload gambar baru ke disk 'public'
            $path = $request->file('gambar_kue')->store('kue', 'public');
        }

        $datakue->update([
            'nama_kue' => $request->nama_kue,
            'harga_kue' => $request->harga_kue,
            'gambar_kue' => $path,
        ]);

        return redirect()->route('admin.datakue.index')
                         ->with('success', 'Data kue berhasil diperbarui.');
    }

    /**
     * Menghapus data kue dari database. (DELETE)
     */
    public function destroy(Cake $datakue)
    {
        // Hapus file gambar dari disk 'public'
        if ($datakue->gambar_kue) {
            Storage::disk('public')->delete($datakue->gambar_kue);
        }

        $datakue->delete();

        return redirect()->route('admin.datakue.index')
                         ->with('success', 'Kue berhasil dihapus.');
    }
}
