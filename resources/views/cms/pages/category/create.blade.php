@extends('cms.layouts.app')
@section('title', 'Input Kategori Baru')
@section('cms')
  <div class="pagetitle">
    <h1>Input Kategori Baru</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('category') }}">Data Kategori</a></li>
        <li class="breadcrumb-item active">Input Kategori Baru</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 mt-2" action="{{ route('categoryStore') }}" method="POST">
              @csrf
              <div class="col-md-12">
                <label for="nama_kategori" class="form-label fw-bold">Nama Kategori</label>
                <input type="text"
                  class="form-control @error('nama_kategori')
                                    is-invalid
                                @enderror"
                  id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}"
                  placeholder="contoh: internasional">
                @error('nama_kategori')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <a href="{{ route('category') }}" class="btn btn-sm btn-outline-secondary shadow-sm"><i
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
