<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Alert;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('created_at', 'desc')->get();

        $title = 'Kategori Surat!';
        $text = "Anda yakin ingin menghapus?";
        confirmDelete($title, $text);

        return view('kategori.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        Kategori::create($request->all());

        Alert::toast('kategori berhasil ditambahkan!','success');
        return redirect()->route('kategori');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);
        
        $kategori = Kategori::findOrFail($id);

        $kategori->update($request->all());

        $kategori->save();

        Alert::toast('kategori berhasil diedit!','success');
        return redirect()->route('kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        Alert::toast('kategori berhasil dihapus!','success');
        return redirect()->route('kategori');
    }

    public function cari(Request $request)
    {
        // Ambil parameter pencarian dari request
        $cari = $request->input('cari');

        // Query untuk mencari kategori berdasarkan parameter pencarian
        $kategori = Kategori::query()
            ->when($cari, function($query, $cari) {
                return $query->where('id', 'like', "%{$cari}%")
                             ->orWhere('nama_kategori', 'like', "%{$cari}%")
                             ->orWhere('keterangan', 'like', "%{$cari}%");
            })->get();

        return view('kategori.kategori', compact('kategori'));
    }
}
