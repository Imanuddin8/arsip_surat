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
            'pdf_file' => 'required|mimes:pdf|max:2048', // max 2MB
        ]);

        // Simpan file PDF ke dalam storage
        $file = $request->file('pdf_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('pdfs', $fileName, 'public');

        // Simpan informasi file ke database
        Arsip::create([
            'nomor' => $request->nomor,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'waktu' => Carbon::now(),
            'pdf_file' => $filePath
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
            'pdf_file' => 'nullable|mimes:pdf|max:2048', // file PDF tidak wajib di-update
        ]);

        $arsip = Arsip::find($id);
        // Hapus file lama jika ada
        if ($arsip->pdf_file) {
            Storage::delete('public/' . $arsip->pdf_file);
        }

        // Simpan file PDF baru ke dalam storage
        $file = $request->file('pdf_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('pdfs', $fileName, 'public');

        // Perbarui informasi file di database
        $arsip->update([
            'nomor' => $request->nomor,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'waktu' => $request->waktu,
            'pdf_file' => $filePath
        ]);

        Alert::toast('Surat berhasil diedit!','success');
        return redirect()->route('arsip');
    }

    public function download($id)
    {
        $arsip = Arsip::findOrFail($id);
        $filePath = storage_path('app/public/' . $arsip->pdf_file);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);
        // Hapus file lama jika ada
        if ($arsip->pdf_file) {
            Storage::delete('public/' . $arsip->pdf_file);
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
