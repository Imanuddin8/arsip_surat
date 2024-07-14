@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12 text-center">
        <h1>Edit Kategori Surat</h1>
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
    <div class="col-12 col-lg-8">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                <input value="{{ $kategori->nama_kategori }}" title="nama kategori" id="nama_kategori" name="nama_kategori" type="text" class="form-control" placeholder="Nama kategori" required/>
                @error('nama_kategori')
                    <div class="text-red mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                <textarea title="keterangan" name="keterangan" id="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $kategori->keterangan }}</textarea>
                @error('keterangan')
                    <div class="text-red mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <div class="mr-4">
                    <a class="btn btn-secondary" href="{{route('kategori')}}">Batal</a>
                </div>
                <div>
                    <button type="submit" name="create" class="btn btn-warning">Edit</button>
                </div>
            </div>
        </form>
    </div>
  </div>

</div>

</section>


@endsection
