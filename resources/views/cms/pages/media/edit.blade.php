@extends('cms.layouts.app')
@section('title', 'Edit Media Lama')
@section('cms')
  <div class="pagetitle">
    <h1>Edit Media Lama</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('media') }}">Data Media</a></li>
        <li class="breadcrumb-item active">Edit Media Lama</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 mt-2" action="{{ route('reuploadMedia', $media->id) }}" enctype="multipart/form-data"
              method="POST">
              @csrf
              @method('PUT')
              <div class="col-md-12">
                <label for="judul" class="form-label fw-bold">Judul</label>
                <input type="text"
                  class="form-control @error('judul')
                                    is-invalid
                                @enderror"
                  id="judul" name="judul" value="{{ $media->judul }}">
                @error('judul')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="gambar" class="form-label fw-bold">Gambar Lama</label>
                <img src="{{ asset('storage/' . $media->gambar) }}" alt="" class="img-fluid card-img shadow-sm"
                  id="old-image">
              </div>
              <div class="col-md-8">
                <label for="gambar" class="form-label fw-bold">Gambar Baru</label>
                <input
                  class="form-control @error('gambar')
                                    is-invalid
                                @enderror"
                  type="file" id="gambar" name="gambar">
                @error('gambar')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <script>
                document.getElementById('gambar').addEventListener('change', function() {
                  const file = this.files[0];
                  if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                      document.getElementById('old-image').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                  }
                });
              </script>
              <div class="col-md-12">
                <label for="konten" class="form-label fw-bold">Konten</label>
                <textarea name="konten" id="konten"
                  class="form-control @error('konten')
                                    is-invalid
                                @enderror">{{ $media->konten }}</textarea>
                @error('konten')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="kategori" class="form-label fw-bold">Kategori</label>
                <select name="kategori"
                  class="form-control @error('kategori')
                                    is-invalid
                                @enderror">
                  <option disabled>Pilih Kategori</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $media->category->id == $category->id ? 'selected' : '' }}>
                      {{ $category->nama_kategori }}</option>
                  @endforeach
                </select>
                @error('kategori')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="Tag" class="form-label fw-bold">Tag</label>
                <select
                  class="form-select @error('tags')
                                    is-invalid
                                @enderror"
                  name="tags[]" id="tags" multiple="multiple" aria-label="multiple select example">
                  @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                      {{ in_array($tag->id, $media->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                      #{{ $tag->nama_tag }}</option>
                  @endforeach
                </select>
                @error('tags')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">Apakah ini berita penting?</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="penting" id="penting"
                    {{ $media->penting == 1 ? 'checked' : '' }}>
                  <label class="form-check-label" for="penting">
                    Ya
                  </label>
                  @error('penting')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="text-center">
                <a href="{{ route('media') }}" class="btn btn-sm btn-outline-secondary shadow-sm"><i
                    class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm" id="buttonReuload"><i class="bi bi-arrow-repeat"></i>
                  Reupload</button>
              </div>
            </form>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const reuploadButton = document.getElementById('buttonReuload');
                const form = reuploadButton.closest('form');

                form.addEventListener('submit', function() {
                  reuploadButton.disabled = true;
                  reuploadButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...';
                });
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
