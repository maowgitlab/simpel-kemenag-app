<div class="col-md-3">
  <div class="aside-block">

    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular"
          type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending"
          type="button" role="tab" aria-controls="pills-trending" aria-selected="false"
          tabindex="-1">Trending</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest"
          type="button" role="tab" aria-controls="pills-latest" aria-selected="false"
          tabindex="-1">Latest</button>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

      <!-- Popular -->
      <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
        @forelse ($popularMedias as $media)
          <div class="post-entry-1 border-bottom">
            <div class="post-meta"><span class="date"><u><a
                    href="{{ route('home', ['media' => $media->slug]) }}">{{ $media->category->nama_kategori }}</a></u></span>
              <span>{{ $media->created_at->translatedFormat('l, d F Y') }}</span>
            </div>
            <h2 class="mb-2 fw-bold"><a href="{{ route('home', ['media' => $media->slug]) }}"
                class="hover-title">{{ $media->judul }}</a>
            </h2>
          </div>
        @empty
          <span class="text-center">Media Belum Tersedia</span>
        @endforelse
      </div>
      <!-- End Popular -->

      <!-- Trending -->
      <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
        @forelse ($trendingMedias as $media)
          <div class="post-entry-1 border-bottom">
            <div class="post-meta"><span class="date"><u><a
                    href="{{ route('home', ['media' => $media->slug]) }}">{{ $media->category->nama_kategori }}</u></a></span>
              <span>{{ $media->created_at->translatedFormat('l, d F Y') }}</span>
            </div>
            <h2 class="mb-2 fw-bold"><a href="{{ route('home', ['media' => $media->slug]) }}"
                class="hover-title">{{ $media->judul }}</a>
            </h2>
          </div>
        @empty
          <span class="text-center">Media Belum Tersedia</span>
        @endforelse
      </div>
      <!-- End Trending -->

      <!-- Latest -->
      <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
        @forelse ($latestMedias as $media)
          <div class="post-entry-1 border-bottom">
            <div class="post-meta"><span class="date"><u><a
                    href="{{ route('home', ['media' => $media->slug]) }}">{{ $media->category->nama_kategori }}</u></a></span>
              <span>{{ $media->created_at->translatedFormat('l, d F Y') }}</span>
            </div>
            <h2 class="mb-2 fw-bold"><a href="{{ route('home', ['media' => $media->slug]) }}"
                class="hover-title">{{ $media->judul }}</a></h2>
          </div>
        @empty
          <span class="text-center">Media Belum Tersedia</span>
        @endforelse
      </div>
      <!-- End Latest -->

    </div>
  </div>

  {{-- <div class="aside-block">
    <h3 class="aside-title">Video</h3>
    <div class="video-post">
      <div class="ratio ratio-16x9 my-3">
        <iframe width="560" height="315" class="rounded" src="https://www.youtube.com/embed/QIjKijhv1OU?si=rewkeHGcggJuc3lW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </div><!-- End Video --> --}}

  <div class="aside-block">
    <h3 class="aside-title">Kategori</h3>
    <ul class="aside-links list-unstyled">
      @forelse ($categories as $category)
        <li><a href="{{ route('home', ['kategori' => $category->slug]) }}"><i class="bi bi-chevron-right"></i>
            {{ $category->nama_kategori }}</a></li>
      @empty
        <li>Kategori Tidak Tersedia</li>
      @endforelse
    </ul>
  </div><!-- End Categories -->

  {{-- <div class="aside-block">
        <h3 class="aside-title">Tag Populer</h3>
        <ul class="aside-tags list-unstyled">
            @if ($tags->count() === 0)
            <li class="text-center">Tag tidak tersedia</li>
            @else
            @foreach ($tags->take(10) as $tag)
            <li><a href="#">{{ $tag->nama_tag }}</a></li>
            @endforeach
            @endif
        </ul>
    </div><!-- End Tags --> --}}
</div>
