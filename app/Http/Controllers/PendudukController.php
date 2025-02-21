<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PemetaanIspa;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function getTambahDataPenduduk()
    {
        // Mengambil data desa dengan ID dan nama desa yang unik
        // Mengambil semua desa
        $desa = PemetaanIspa::all(); // Menggunakan method all() untuk mengambil semua entri

        // Mengirimkan data desa ke view dengan variabel 'desa'
        return view('pages.app.tambah-data-penduduk', compact('desa'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pemetaan_ispa_id' => 'required|exists:pemetaan_ispas,id',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string'
        ]);

        try {
            // Simpan data penduduk
            $penduduk = Penduduk::create([
                'pemetaan_ispa_id' => $request->pemetaan_ispa_id,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat
            ]);

            // Tambah jumlah_terkena di tabel PemetaanIspa
            PemetaanIspa::where('id', $request->pemetaan_ispa_id)
                ->increment('jumlah_terkena', 1);

            return redirect()->back()->with('success', 'Data penduduk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function viewPenduduk(Request $request)
    {
        $query = Penduduk::with('pemetaanIspa'); // Memastikan relasi 'pemetaanIspa' diload

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $penduduks = $query->paginate(10); // Menambahkan pagination
        $desa = PemetaanIspa::all(); // Ambil data desa untuk dropdown di modal edit

        return view('pages.app.list-data-penduduk', compact('penduduks', 'desa'));
    }

    public function edit($id)
    {
        // Mengambil data penduduk berdasarkan ID
        $penduduk = Penduduk::findOrFail($id);

        // Mengambil semua data desa untuk dropdown
        $desas = PemetaanIspa::all();

        // Mengirimkan data ke view edit
        return view('pages.app.edit-data-penduduk', compact('penduduk', 'desas'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'pemetaan_ispa_id' => 'required|exists:pemetaan_ispas,id',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string'
        ]);

        try {
            $penduduk = Penduduk::findOrFail($id);

            // Cek jika desa berubah
            if ($penduduk->pemetaan_ispa_id != $request->pemetaan_ispa_id) {
                // Kurangi jumlah_terkena di desa lama
                PemetaanIspa::where('id', $penduduk->pemetaan_ispa_id)
                    ->where('jumlah_terkena', '>', 0) // Pastikan tidak negatif
                    ->decrement('jumlah_terkena', 1);

                // Tambah jumlah_terkena di desa baru
                PemetaanIspa::where('id', $request->pemetaan_ispa_id)
                    ->increment('jumlah_terkena', 1);
            }

            // Update data penduduk
            $penduduk->update([
                'pemetaan_ispa_id' => $request->pemetaan_ispa_id,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat
            ]);

            return redirect()->route('list.data.penduduk')->with('success', 'Data penduduk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }



    public function delete($id)
    {
        try {
            $penduduk = Penduduk::findOrFail($id); // Cari data berdasarkan ID

            // Kurangi jumlah_terkena pada tabel PemetaanIspa
            PemetaanIspa::where('id', $penduduk->pemetaan_ispa_id)
                ->where('jumlah_terkena', '>', 0) // Pastikan tidak kurang dari 0
                ->decrement('jumlah_terkena', 1);

            $penduduk->delete(); // Hapus data penduduk

            return response()->json([
                'status' => 'success',
                'message' => 'Data penduduk berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
