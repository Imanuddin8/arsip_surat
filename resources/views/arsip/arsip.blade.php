@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>Arsip Surat</h1>
        <p>Berikut ini surat-surat yang telah terbit dan diarsipkan.<br>Kilk "Lihat" pada kolom aksi untuk menampilkan surat.</p>
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
            <div class="mb-4">
                @if($cekKategori)
                    <a type="button" class="btn btn-primary btn-md" href="{{ route('arsip.create') }}" role="button">
                        Arsipkan Surat
                    </a>
                @else
                    <button type="button" class="btn btn-primary btn-md" disabled title="Tolong tambahkan kategori terlebih dahulu.">
                        Arsipkan Surat
                    </button>
                    <p class="text-danger">Tolong tambahkan kategori terlebih dahulu.</p>
                @endif
            </div>
            <div class="mb-4">
                <form action="{{ route('arsip.cari') }}" method="get">
                    <div
                        class="row justify-content-start align-items-center g-3"
                    >
                        <div class="col-3 col-lg-auto">
                            <span class="fw-bold">Cari Surat</span>
                        </div>
                        <div class="col-6 col-lg-auto">
                            <input size="50" class="form-control" type="search" placeholder="Cari judul surat" name="cari" id="cari" title="cari judul surat">
                        </div>
                        <div class="col-3 col-lg-auto">
                            <button type="submit" class="btn btn-icon btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        @if(request('cari'))
                            <div class="col-auto">
                                <a href="{{ route('arsip') }}" class="btn btn-icon btn-success">
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
                  <th>No Surat</th>
                  <th>Kategori</th>
                  <th>Judul</th>
                  <th>Waktu Pengarsipan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody class="text-start">
                    @if ($arsip->isEmpty())
                        <tr class="text-center">
                            <td colspan="5">
                                <span class="fw-bold">Tidak ada arsip surat</span>
                            </td>
                        </tr>
                    @else
                        @foreach ($arsip as $row)
                            <tr>
                                <td>{{$row->nomor}}</td>
                                <td>{{$row->kategori->nama_kategori}}</td>
                                <td>{{$row->judul}}</td>
                                <td>{{formatDate($row->waktu)}}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('arsip.download', $row->id) }}" class="btn btn-md btn-success mr-2">
                                        <i class="fa-solid fa-download text-white"></i>
                                    </a>
                                    <a href="{{ route('arsip.destroy', ['id' => $row->id]) }}" class="btn btn-danger mr-2" data-confirm-delete="true">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('arsip.lihat', $row->id) }}" class="btn btn-md btn-info mr-2 px-3">
                                        <i class="fa fa-info text-white" aria-hidden="true"></i>
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
