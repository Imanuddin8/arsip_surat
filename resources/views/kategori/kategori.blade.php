@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>Kategori Surat</h1>
        <p>Berikut ini kategori yang bisa digunakan melebeli surat.<br>Kilk "Tambah" untuk menambah kategori surat.</p>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-8 col-lg-12">
      <div class="card">
        <div class="card-body">
            <div
                class="row justify-content-start align-items-center g-2 mb-4"
            >
                <div class="col-auto">
                    <a type="button" class="btn btn-primary btn-md" href="{{ route('kategori.create') }}" role="button">
                        Tambah Kategori Baru
                    </a>
                </div>
            </div>
            <div class="mb-3">
                <form action="{{ route('kategori.cari') }}" method="get">
                    <div
                        class="row justify-content-start align-items-center g-2"
                    >
                        <div class="col-3 col-lg-auto">
                            <span class="fw-bold">Cari Kategori</span>
                        </div>
                        <div class="col-6 col-lg-7">
                            <input class="form-control" type="search" placeholder="Cari kategori" name="cari" id="cari" title="cari surat" required>
                        </div>
                        <div class="col-3 col-lg-auto">
                            <button type="submit" class="btn btn-icon btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        @if(request('cari'))
                            <div class="col-auto">
                                <a href="{{ route('kategori') }}" class="btn btn-icon btn-success">
                                    <i class="fa fa-arrows-rotate"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            <table id="" class="table table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                    <th>id</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-start">
                    @if ($kategori->isEmpty())
                        <tr class="text-center">
                            <td colspan="4">
                                <span class="fw-bold">Tidak ada kategori</span>
                            </td>
                        </tr>
                    @else
                        @foreach ($kategori as $row)
                            <tr>
                                <td class="text-center">{{$row->id}}</td>
                                <td>{{$row->nama_kategori}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('kategori.edit', ['id' => $row->id])}}" class="btn btn-md btn-warning mr-2">
                                        <i class="fa fa-edit text-white" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('kategori.destroy', ['id' => $row->id]) }}" class="btn btn-danger" data-confirm-delete="true">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

</section>


@endsection
