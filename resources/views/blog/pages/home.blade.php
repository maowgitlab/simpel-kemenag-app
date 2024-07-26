@extends('blog.layouts.app')
@section('title', Request::has('cari') ? 'Cari: ' . Request::input('cari') : (Request::has('kategori') ? 'Kategori: ' .
  Request::input('kategori') : (Request::has('layanan') ? 'Layanan: Pelayanan Publik' : 'Kantor Kemenag Provinsi
  Kalimantan Selatan')))
@section('medias')
  @if (
      (Request::has('cari') && Request::input('cari') !== null) ||
          Request::has('media') ||
          Request::has('kategori') ||
          Request::has('layanan'))
    <div class="row">
      <!-- ======= Content After Search, Showing Medias, Showing Categories ======= -->
      @if (Request::has('cari'))
        @include('blog.pages.search')
      @elseif (Request::has('media'))
        @include('blog.pages.post')
      @elseif (Request::has('kategori'))
        @include('blog.pages.category')
      @elseif (Request::has('layanan'))
        @include('blog.pages.service.public-service')
      @endif

      <!-- ======= Sidebar ======= -->
      @include('blog.pages.sidebar-content')
    </div>
  @else
    <!-- ======= Default Post Content ======= -->
    <div class="row g-5">
      <div class="col-lg-4">
        @forelse ($first as $f)
          <div class="post-entry-1 lg">
            <figure class="m-0">
              <div style="position: relative; display: inline-block;">
                <a href="{{ route('home', ['media' => $f->slug]) }}">
                  <img src="{{ asset('storage/' . $f->gambar) }}" alt="" class="img-fluid rounded" loading="lazy">
                </a>
                <small class="m-0"
                  style="position: absolute; bottom: 40px; left: 10px; background-color: #2C65E1; color: white; padding: 1px 3px; border-radius: 5px;">
                  {{ $f->category->nama_kategori }}
                </small>
              </div>
            </figure>
            <div class="post-meta"><span>{{ $f->created_at->translatedFormat('l, d-m-Y H:i') . ' WITA' }}</span> <span><i
                  class="bi bi-eye-fill"></i> {{ $f->jumlah_dibaca . ' Kali' }}</span></div>
            <h3 class="fw-bold"><a href="{{ route('home', ['media' => $f->slug]) }}"
                class="hover-title">{{ $f->judul }}</a></h3>
            <article class="mb-4">{!! Str::limit(strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $f->konten)), 250, '...') !!}</article>

            <div class="d-flex align-items-center author">
              <div class="photo"><img
                  src="{{ $f->user->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . $f->user->userDetail->profil) }}"
                  alt="" class="img-fluid" loading="lazy">
              </div>
              <div class="name">
                <h3 class="m-0 p-0">{{ $f->user->userDetail->nama_lengkap ?? $f->user->username }}</h3>
              </div>
            </div>
          </div>
        @empty
          <h4 class="text-center">Segera tersedia...</h4>
        @endforelse

      </div>

      <div class="col-lg-8">
        <div class="row g-5">
          <div class="col-lg-4 border-start custom-border">
            @forelse ($second as $s)
              <div class="post-entry-1">
                <figure class="mb-0">
                  <div style="position: relative; display: inline-block;">
                    <a href="{{ route('home', ['media' => $s->slug]) }}">
                      <img src="{{ asset('storage/' . $s->gambar) }}" alt="" class="img-fluid rounded"
                        loading="lazy">
                    </a>
                    <small class="m-0"
                      style="position: absolute; bottom: 40px; left: 10px; background-color: #2C65E1; color: white; padding: 1px 3px; border-radius: 5px;">
                      {{ $s->category->nama_kategori }}
                    </small>
                  </div>
                </figure>
                <div class="post-meta"><span>{{ $s->created_at->translatedFormat('l, d-m-Y H:i') . ' WITA' }}</span>
                  <span><i class="bi bi-eye-fill"></i> {{ $s->jumlah_dibaca . ' Kali' }}</span>
                </div>
                <h5 class="fw-bold"><a href="{{ route('home', ['media' => $s->slug]) }}"
                    class="hover-title">{{ $s->judul }}</a>
                </h5>
              </div>
            @empty
              <h4 class="text-center">Segera tersedia...</h4>
            @endforelse
          </div>
          <div class="col-lg-4 border-start custom-border">
            @forelse ($third as $t)
              <div class="post-entry-1">
                <figure class="mb-0">
                  <div style="position: relative; display: inline-block;">
                    <a href="{{ route('home', ['media' => $t->slug]) }}">
                      <img src="{{ asset('storage/' . $t->gambar) }}" alt="" class="img-fluid rounded"
                        loading="lazy">
                    </a>
                    <small class="m-0"
                      style="position: absolute; bottom: 40px; left: 10px; background-color: #2C65E1; color: white; padding: 1px 3px; border-radius: 5px;">
                      {{ $t->category->nama_kategori }}
                    </small>
                  </div>
                </figure>
                <div class="post-meta"><span>{{ $t->created_at->translatedFormat('l, d-m-Y H:i') . ' WITA' }}</span>
                  <span><i class="bi bi-eye-fill"></i> {{ $t->jumlah_dibaca . ' Kali' }}</span>
                </div>
                <h5 class="fw-bold"><a href="{{ route('home', ['media' => $t->slug]) }}"
                    class="hover-title">{{ $t->judul }}</a>
                </h5>
              </div>
            @empty
              <h4 class="text-center">Segera tersedia...</h4>
            @endforelse
          </div>

          <!-- Trending Section -->
          <div class="col-lg-4">
            <div class="trending">
              <h3>Trending</h3>
              <ul class="trending-post">
                @forelse ($trendingMedias as $trending)
                  <li>
                    <a href="{{ route('home', ['media' => $trending->slug]) }}">
                      <span class="number">{{ $loop->iteration }}</span>
                      <h6 class="fw-bold ms-3"><span class="hover-title">{{ $trending->judul }}</span></h5>
                    </a>
                  </li>
                @empty
                  <h5 class="text-center">Segera tersedia...</h5>
                @endforelse
              </ul>
            </div>
          </div> <!-- End Trending Section -->
        </div>
      </div>
    </div>
  @endif
@endsection
