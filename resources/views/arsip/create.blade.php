@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12 text-center">
        <h1>Tambah Arsip Surat</h1>
        <div
            class="row justify-content-center align-items-center my-2"
        >
            <div class="col-12 col-lg-8 text-start">
                <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan. Catatan:</p>
                <li>Gunakan format file PDF</li>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
  <div
    class="row justify-content-center align-items-center"
  >
    <div class="col-12 col-lg-8 py-4">
        <form id="form" action="{{ route('arsip.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nomor</label>
                <input value="{{ old('nomor') }}" title="nomor surat" id="nomor" name="nomor" type="text" class="form-control" placeholder="Nomor surat" required/>
                @error('nomor')
                    <div class="text-red mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                <select title="kategori" name="kategori_id" id="kategori_id" class="form-control" id="exampleFormControlSelect1" aria-label="Default select example" required>
                    <option selected disabled>Pilih Kategori</option>
                    @foreach($kategori as $kg)
                        <option value="{{ $kg->id }}" {{ old('kategori_id') == $kg->id ? 'selected' : '' }}>
                                {{ $kg->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-red mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul</label>
                <input value="{{ old('judul') }}" title="judul surat" id="judul" name="judul" type="text" class="form-control" placeholder="Judul surat" required/>
                @error('judul')
                    <div class="text-red mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">File Surat PDF</label>
                <input type="file" name="filesurat" id="filesurat" class="form-control" required>
                @error('filesurat')
                    <div class="text-red mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <div class="mr-4">
                    <a class="btn btn-secondary" href="{{route('arsip')}}">Batal</a>
                </div>
                <div>
                    <button type="submit" name="create" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
  </div>

</div>

</section>


@endsection
