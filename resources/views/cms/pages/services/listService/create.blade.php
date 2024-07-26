@extends('cms.layouts.app')
@section('title', 'Input Kategori Pelayanan Baru')
@section('cms')
  <div class="pagetitle">
    <h1>Input Kategori Pelayanan Baru</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('listService') }}">Kategori Pelayanan</a></li>
        <li class="breadcrumb-item active">Input Kategori Pelayanan Baru</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 mt-2" action="{{ route('listServiceStore') }}" method="POST">
              @csrf
              <div class="col-md-12">
                <label for="judul" class="form-label fw-bold">Judul Kategori Pelayanan</label>
                <input type="text"
                  class="form-control @error('judul')
                                    is-invalid
                                @enderror"
                  id="judul" name="judul" value="{{ old('judul') }}" placeholder="contoh: Kepegawaian">
                @error('judul')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <a href="{{ route('listService') }}" class="btn btn-sm btn-outline-secondary shadow-sm"><i
                    class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm"><i class="bi bi-upload"></i>
                  Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
