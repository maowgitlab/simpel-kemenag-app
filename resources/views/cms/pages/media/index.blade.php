@extends('cms.layouts.app')
@section('title', 'Data Media')
@section('cms')
  @if (session()->has('message'))
    {!! session('message') !!}
  @endif
  <div class="pagetitle">
    <h1>Data Media</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Media</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <a href="{{ route('createMedia') }}" class="shadow-sm btn btn-sm btn-primary mb-3"><i class="bi bi-plus-circle"></i>
          Input Media Baru</a>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive-lg my-3">
              <table class="table table-hover" id="post-table">
                <thead>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Gambar</th>
                    <th>Judul</th>
                    <th>Slug</th>
                    <th>Konten</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Penting</th>
                    <th class="text-center">Dibaca</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medias as $media)
                    <tr>
                      <td class="align-middle text-center">{{ $loop->iteration }}</td>
                      <td class="align-middle text-center"><img src="{{ asset('storage/' . $media->gambar) }}"
                          alt="" width="80px" height="60px" class="rounded">
                        @foreach ($media->tags as $tag)
                          <div class="text-primary fw-bold" style="font-size: 12px">
                            #{{ $tag->nama_tag }}</div>
                        @endforeach
                      </td>
                      <td class="align-middle">{{ Str::limit($media->judul, 50, '...') }}</td>
                      <td class="align-middle">{{ Str::limit($media->slug, 50, '...') }}</td>
                      <td class="align-middle">{!! Str::limit(strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $media->konten)), 50, '...') !!}</td>
                      <td class="align-middle text-center"><small
                          class="fw-bold text-primary">{{ $media->category->nama_kategori }}</small>
                      </td>
                      <td class="align-middle text-center"><small
                          class="fw-bold">{{ $media->penting == 1 ? 'Ya' : 'Tidak' }}</small></td>
                      <td class="align-middle text-center"><small class="fw-bold text-muted"><i class="bi bi-eye"></i>
                          {{ $media->jumlah_dibaca }}</small></td>
                      <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <form action="{{ route('deleteMedia', $media->id) }}" method="post"
                            id="delete-media-form-{{ $media->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger"
                              onclick="confirmDelete({{ $media->id }})"><i class="bi bi-trash"></i></button>
                          </form>
                          <a href="{{ route('editMedia', $media->slug) }}" class="btn btn-sm btn-warning"><i
                              class="bi bi-pencil"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <script>
                function confirmDelete(mediaId) {
                  Swal.fire({
                    title: 'Hapus media ini?',
                    text: "Data tidak bisa dipulihkan kembali jika dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      document.getElementById('delete-media-form-' + mediaId).submit();
                    }
                  })
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
