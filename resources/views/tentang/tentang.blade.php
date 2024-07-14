@extends('layouts.main')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h1>Tentang Saya</h1>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-lg-7">
      <div class="card">
        <div class="card-body">
            <div
                class="row g-3"
            >
                <div class="col-12 col-lg-3">
                    <img src="{{ asset('dist/img/2131740036.jpeg')}}" alt="profile" class="rounded img-thumbnail">
                </div>
                <div class="col-12 col-lg-9">
                    <table class="fw-bold">
                        <tr>
                            <td colspan="2">Web ini dibuat oleh:</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: Imanuddin</td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>: D3 Teknologi Informasi PSDKU Lumajang</td>
                        </tr>
                        <tr>
                            <td>Nim</td>
                            <td>: 2131740036</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>: 14 Juli 2024</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
  </div>
</div>

</section>


@endsection
