<?php

namespace App\Http\Controllers;
use App\Models\Arsip;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Alert;

class ArsipController extends Controller
{
    public function index()
    {
        $arsip = Arsip::orderBy('created_at', 'desc')->get();
        $kategori = Kategori::all();
        // Check if there are categories
        $cekKategori = Kategori::exists();

        $title = 'Arsip Surat!';
        $text = "Anda yakin ingin menghapus?";
        confirmDelete($title, $text);

        return view('arsip.arsip', compact('arsip', 'kategori', 'cekKategori'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('arsip.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|unique:arsip',
            'kategori_id' => 'required',
            'judul' => 'required',
            'filesurat' => 'required|mimes:pdf|max:2048', // max 2MB
        ]);

        if ($request->hasFile('filesurat')) {
            $file = $request->file('filesurat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        }

        // Simpan informasi file ke database
        Arsip::create([
            'nomor' => $request->nomor,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'waktu' => Carbon::now(),
            'filesurat' => $filePath ?? null,
        ]);

        Alert::toast('Surat berhasil ditambahkan!','success');
        return redirect()->route('arsip');
    }

    public function edit($id)
    {
        $arsip = Arsip::findOrFail($id);
        $kategori = Kategori::all();
        return view('arsip.edit', compact('kategori', 'arsip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor' => 'required|unique:arsip,nomor,'.$id,
            'kategori_id' => 'required',
            'judul' => 'required',
            'waktu' => 'required',
            'filesurat' => 'nullable|mimes:pdf|max:2048', // file PDF tidak wajib di-update
        ]);

        $arsip = Arsip::find($id);

        // Proses unggahan file
        if ($request->hasFile('filesurat')) {
            // Hapus file lama jika ada
            if ($arsip->filesurat) {
                Storage::delete('public/' . $arsip->filesurat);
            }

            // Simpan file baru
            $file = $request->file('filesurat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        }

        // Perbarui informasi file di database
        $arsip->update([
            'nomor' => $request->nomor,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'waktu' => $request->waktu,
            'filesurat' => $filePath
        ]);

        Alert::toast('Surat berhasil diedit!','success');
        return redirect()->route('arsip');
    }

    public function download($id)
    {
        $arsip = Arsip::findOrFail($id);
        $filePath = storage_path('app/public/' . $arsip->filesurat);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        $filePath = storage_path('app/public/' . $arsip->filesurat);

        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file fisik
        }

        $arsip->delete();

        Alert::toast('Surat berhasil dihapus!','success');
        return redirect()->route('arsip');
    }

    public function cari(Request $request)
    {
        // Ambil parameter pencarian dari request
        $cari = $request->input('cari');

        // Query untuk mencari kategori berdasarkan parameter pencarian
        $arsip = Arsip::query()
            ->when($cari, function($query, $cari) {
                return $query->where('judul', 'like', "%{$cari}%");
            })->get();

        return view('arsip.arsip', compact('arsip'));
    }

    public function lihat(Request $request, $id)
    {
        $arsip = Arsip::find($id);
        $kategori = Kategori::all();

        return view('arsip.lihat', compact('arsip', 'kategori'));
    }
}
