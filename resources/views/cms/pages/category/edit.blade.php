@extends('cms.layouts.app')
@section('title', 'Edit Kategori Lama')
@section('cms')
  <div class="pagetitle">
    <h1>Edit Kategori Lama</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('category') }}">Data Kategori</a></li>
        <li class="breadcrumb-item active">Edit Kategori Lama</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 mt-2" action="{{ route('updateCategory', $category->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="col-md-12">
                <label for="nama_kategori" class="form-label fw-bold">Nama Kategori</label>
                <input type="text"
                  class="form-control @error('nama_kategori')
                                    is-invalid
                                @enderror"
                  id="nama_kategori" name="nama_kategori" value="{{ $category->nama_kategori }}">
                @error('nama_kategori')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <a href="{{ route('category') }}" class="btn btn-sm btn-outline-secondary shadow-sm"><i
                    class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm"><i class="bi bi-arrow-repeat"></i>
                  Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection