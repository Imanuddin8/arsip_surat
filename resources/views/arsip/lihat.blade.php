@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-12">
        <h1>Lihat Arsip Surat</h1>
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
            <table class="">
                <tr>
                    <td>Nomor</td>
                    <td>: {{$arsip->nomor}}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>: {{$arsip->kategori->nama_kategori}}</td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td>: {{$arsip->judul}}</td>
                </tr>
                <tr>
                    <td>waktu</td>
                    <td>: {{formatDate($arsip->waktu)}}</td>
                </tr>
            </table>
            <div class="mb-3">
                <p>File Surat :</p>
                <iframe src="{{ asset('storage/' . $arsip->filesurat) }}" type="application/pdf" width="100%" height="500px" ></iframe>
            </div>
            <div class="d-flex">
                <a href="{{ route('arsip') }}" class="btn btn-primary mr-2">
                    << Kembali
                </a>
                <a href="{{ route('arsip.download', $arsip->id) }}" class="btn btn-md btn-success mr-2">
                    Download
                </a>
                <a href="{{ route('arsip.edit', $arsip->id) }}" class="btn btn-md btn-warning mr-2">
                    Edit/Ganti File
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</section>

@endsection
