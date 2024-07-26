<div class="col-md-9">
  <h3 class="category-title">Hasil Pencarian: {{ Request::input('cari') }}</h3>
  @forelse ($medias as $media)
    <div class="post-entry-2 d-lg-flex half border-bottom pb-3">
      <a href="{{ route('home', ['media' => $media->slug]) }}" class="me-4 thumbnail">
        <figure class="m-0"><img src="{{ asset('storage/' . $media->gambar) }}" alt="" class="img-fluid rounded"
            loading="lazy"></figure>
      </a>
      <div class="mt-3 mt-lg-0">
        <div class="post-meta mt-3 mt-sm-0 mt-lg-0"><span class="date"><u><a
                href="{{ route('home', ['kategori' => $media->category->slug]) }}">{{ $media->category->nama_kategori }}</a></u></span>
          <span>{{ $media->created_at->translatedFormat('l, d F Y H:i') . ' WITA' }}</span> | <span><i
              class="bi bi-eye-fill"></i>
            {{ $media->jumlah_dibaca . ' Kali' }}</span>
        </div>
        <h3 class="fw-bold"><a href="{{ route('home', ['media' => $media->slug]) }}"
            class="hover-title">{{ $media->judul }}</a>
        </h3>
        <article class="mb-4">{!! Str::limit(strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $media->konten)), 150, '...') !!}</article>
        <div class="d-flex align-items-center author">
          <div class="photo"><img
              src="{{ $media->user->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . $media->user->userDetail->profil) }}"
              alt="" class="img-fluid"></div>
          <div class="name">
            <h3 class="m-0 p-0">{{ $media->user->userDetail->nama_lengkap ?? $media->user->username }}</h3>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-secondary">
      Hasil Pencarian Tidak Ditemukan.
    </div>
  @endforelse

  {{ $medias->links('vendor.pagination.custom') }}

</div>
