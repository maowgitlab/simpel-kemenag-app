<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{ asset('kemenag_logo.png') }}" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lora:ital,wght@0,400..700;1,400..700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/blog/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/blog/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/blog/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/blog/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/blog/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

  <!-- Template Main CSS Files -->
  <link href="{{ asset('vendor/blog/css/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/blog/css/main.css') }}" rel="stylesheet">
  <!-- Sweet Alert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/@betahuhn/feedback-js/dist/feedback-js.min.js" data-feedback-opts='{ 
      "id": "feedback", 
      "endpoint": "{{ route('feedback') }}", 
      "emailField": true,
      "inputPlaceholder": "Ketikan feedback disini...",
      "emailPlaceholder": "Alamat Email",
      "title": "Feedback Aplikasi",
      "failedTitle": "Oops, terjadi kesalahan",
      "failedMessage": "Jika masalah masih berlanjut, silahkan coba lagi.",
      "submitText": "Kirim",
      "backText": "Kembali",
      "success": "Terkirim!",
      "contactText": "Hubungi Saya",
      "contactLink": "mailto:robianoor@gmail.com",
      "typeMessage": "Feedback apa yang ingin disampaikan?",
      "position": "left",
      "primary": "green",
      "background": "white",
      "color": "black",
      "events": true,
      "types": {
        "general": {
          "text": "Feedback Umum",
          "icon": "😁"
        },
        "idea": {
          "text": "Saya punya saran",
          "icon": "💡"
        },
        "bug": {
          "text": "Saya menemukan bug",
          "icon": "🐞"
        }
      }
    }'>
  </script>

  <script>
    window.addEventListener('feedback-submit', (event) => {
        const email = event.detail.email;
        const pesan = event.detail.message;
        if (email == "" || pesan == "") {
          alert("Email dan pesan wajib diisi.");
        }
    })
  </script>

  <style>
    .pagination>li>a,
    .pagination>li>span {
      color: rgb(33, 37, 41);
    }

    .pagination>.active>a,
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span,
    .pagination>.active>span:focus,
    .pagination>.active>span:hover {
      background-color: rgb(33, 37, 41);
      border-color: rgb(33, 37, 41);
    }
  </style>

  <!-- =======================================================
  * Template Name: ZenBlog
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('kemenag_logo.png') }}" alt="kemenag_logo">
        <h1 class="mt-2"><small class="d-block" style="font-size: 16px"><i class="bi bi-feather"></i>
            SIMPel</small>Kemenag Kalsel</h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="/"><span class="hover-nav">Beranda</span></a></li>
          <li class="dropdown"><a href="#"><span>Media</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              @forelse ($categories as $category)
              <li><a href="{{ route('home', ['kategori' => $category->slug]) }}"><span class="hover-nav">{{
                    $category->nama_kategori }}</span></a>
              </li>
              @empty
              <li class="text-center">Media belum tersedia.</li>
              @endforelse
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Layanan</span> <i
                class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="{{ route('home', ['layanan' => 'pelayanan-publik']) }}"><span class="hover-nav">Pelayanan
                    Publik</span></a></li>
              {{-- <li><a href="#">Feedback Aplikasi</a></li> --}}
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2 d-none d-md-inline"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2 d-none d-md-inline"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2 d-none d-md-inline"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="{{ route('home') }}" method="GET" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Cari..." class="form-control" name="cari">
            <button class="btn js-search-close" type="button"><span class="bi-x"></span></button>
          </form>
        </div>
        <!-- End Search Form -->
      </div>
    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    @if (
    (!Request::has('cari') || (Request::has('cari') && !Request::input('cari'))) &&
    !Request::has('media') &&
    !Request::has('kategori') &&
    !Request::has('layanan'))
    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts rounded">
              <div class="swiper-wrapper">
                @forelse ($importantMedias as $important)
                <div class="swiper-slide">
                  <div class="img-bg d-flex align-items-end"
                    style="background-image: url({{ asset('storage/' . $important->gambar) }});">
                    <div class="img-bg-inner">
                      <h2 class="fw-bold"><a href="{{ route('home', ['media' => $important->slug]) }}"
                          class="text-white">{{ $important->judul }}</a></h2>
                      <span class="badge" style="background-color: #2C65E1;">{{ $important->category->nama_kategori
                        }}</span>
                      <p>{!! Str::limit(strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $important->konten)), 200,
                        '...') !!}</p>
                    </div>
                  </div>
                </div>
                @empty
                <h1 class="mx-auto">Belum Ada media Penting Nih</h1>
                @endforelse

              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Hero Slider Section -->
    @endif

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container"
        data-aos="{{ Request::has('cari') || Request::has('kategori') || Request::has('layanan') ? '' : 'fade-up' }}">
        @yield('medias')
      </div>
    </section>
    <!-- End Post Grid Section -->

    @if (
    (!Request::has('cari') || (Request::has('cari') && !Request::input('cari'))) &&
    !Request::has('media') &&
    !Request::has('kategori'))
    @if ($trendingCategoriesOne && $trendingCategoriesOne->medias && count($trendingCategoriesOne->medias) >= 10)
    @php
    // Untuk Trending Kategori Pertama 10 Data Post
    $mediaTrendingCategoriesOne = $trendingCategoriesOne->medias;
    @endphp
    <!-- ======= Trending Category One ======= -->
    <section class="category-section">
      <div class="container" data-aos="fade-up">

        <div class="section-header d-flex justify-content-between align-items-center mb-5">
          <h3 class="fw-bold">{{ $trendingCategoriesOne->nama_kategori }}</h3>
          <div><a href="{{ route('home', ['kategori' => $trendingCategoriesOne->slug]) }}" class="more">LIHAT
              SEMUA {{ $trendingCategoriesOne->nama_kategori }} <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-9">
            <div class="d-lg-flex post-entry-2">
              <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[0]->slug]) }}"
                class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                <figure class="m-0">
                  <img src="{{ asset('storage/' . $mediaTrendingCategoriesOne[0]->gambar) }}" alt=""
                    class="img-fluid rounded" loading="lazy">
                </figure>
              </a>
              <div>
                <div class="post-meta"><span class="badge" style="background-color: #2C65E1;"><a
                      href="{{ route('home', ['kategori' => $mediaTrendingCategoriesOne[0]->category->slug]) }}"
                      class="text-white">{{ $trendingCategoriesOne->nama_kategori }}</a></span>
                  <span class="mx-1">&bullet;</span>
                  <span>{{ $mediaTrendingCategoriesOne[0]->created_at->translatedFormat('l, d F Y H:i') . ' ' }} |
                    <i class="bi bi-eye-fill"></i>
                    {{ $mediaTrendingCategoriesOne[0]->jumlah_dibaca . ' Kali' }}</span>
                </div>
                <h3 class="fw-bold"><a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[0]->slug]) }}"
                    class="hover-title">{{ $mediaTrendingCategoriesOne[0]->judul }}</a>
                </h3>
                <article class="mb-4">{!! Str::limit(
                  strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $mediaTrendingCategoriesOne[0]->konten)),
                  200,
                  '...',
                  ) !!}</article>
                <div class="d-flex align-items-center author">
                  <div class="photo"><img
                      src="{{ $mediaTrendingCategoriesOne[0]->user->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . $mediaTrendingCategoriesOne[0]->user->userDetail->profil) }}"
                      alt="" class="img-fluid" loading="lazy"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">
                      {{ $mediaTrendingCategoriesOne[0]->user->userDetail->nama_lengkap ??
                      $mediaTrendingCategoriesOne[0]->user->username }}
                    </h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <div class="post-entry-1 border-bottom">
                  <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[1]->slug]) }}">
                    <figure class="m-0">
                      <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[1]->slug]) }}"> <img
                          src="{{ asset('storage/' . $mediaTrendingCategoriesOne[1]->gambar) }}" alt=""
                          class="img-fluid rounded" loading="lazy">
                        <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[1]->slug]) }}">
                    </figure>
                  </a>
                  <div class="post-meta"><span class="badge" style="background-color: #2C65E1;"><a
                        href="{{ route('home', ['kategori' => $mediaTrendingCategoriesOne[1]->category->slug]) }}"
                        class="text-white">{{ $trendingCategoriesOne->nama_kategori }}</a></span>
                    <span class="mx-1">&bullet;</span>
                    <span>{{ $mediaTrendingCategoriesOne[1]->created_at->translatedFormat('l, d F Y H:i') . ' ' }}
                      | <i class="bi bi-eye-fill"></i>
                      {{ $mediaTrendingCategoriesOne[1]->jumlah_dibaca . ' Kali' }}</span>
                  </div>
                  <h5 class="mb-2 fw-bold"><a
                      href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[1]->slug]) }}"
                      class="hover-title">{{ $mediaTrendingCategoriesOne[1]->judul }}</a>
                  </h5>
                  <span class="author mb-3 d-block">{{ $mediaTrendingCategoriesOne[1]->user->userDetail->nama_lengkap ??
                    $mediaTrendingCategoriesOne[1]->user->username }}</span>
                  <article class="mb-4">
                    {!! Str::limit(
                    strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $mediaTrendingCategoriesOne[1]->konten)),
                    200,
                    '...',
                    ) !!}</article>
                </div>

                <div class="post-entry-1">
                  <div class="post-meta"><span class="badge" style="background-color: #2C65E1;"><a
                        href="{{ route('home', ['kategori' => $mediaTrendingCategoriesOne[2]->category->slug]) }}"
                        class="text-white">{{ $trendingCategoriesOne->nama_kategori }}</a></span>
                    <span class="mx-1">&bullet;</span>
                    <span>{{ $mediaTrendingCategoriesOne[2]->created_at->translatedFormat('l, d F Y H:i') . ' ' }}
                      | <i class="bi bi-eye-fill"></i>
                      {{ $mediaTrendingCategoriesOne[2]->jumlah_dibaca . ' Kali' }}</span>
                  </div>
                  <h5 class="mb-2 fw-bold"><a
                      href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[2]->slug]) }}"
                      class="hover-title">{{ $mediaTrendingCategoriesOne[2]->judul }}</a>
                  </h5>
                  <span class="author mb-3 d-block">{{ $mediaTrendingCategoriesOne[2]->user->userDetail->nama_lengkap ??
                    $mediaTrendingCategoriesOne[2]->user->username }}</span>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="post-entry-1">
                  <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[3]->slug]) }}">
                    <figure class="m-0">
                      <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[3]->slug]) }}"> <img
                          src="{{ asset('storage/' . $mediaTrendingCategoriesOne[3]->gambar) }}" alt=""
                          class="img-fluid rounded" loading="lazy">
                        <a href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[3]->slug]) }}">
                    </figure>
                  </a>
                  <div class="post-meta"><span class="badge" style="background-color: #2C65E1;"><a
                        href="{{ route('home', ['kategori' => $mediaTrendingCategoriesOne[3]->category->slug]) }}"
                        class="text-white">{{ $trendingCategoriesOne->nama_kategori }}</a></span>
                    <span class="mx-1">&bullet;</span>
                    <span>{{ $mediaTrendingCategoriesOne[3]->created_at->translatedFormat('l, d F Y H:i') . ' ' }}
                      | <i class="bi bi-eye-fill"></i>
                      {{ $mediaTrendingCategoriesOne[3]->jumlah_dibaca . ' Kali' }}</span>
                  </div>
                  <h5 class="mb-2 fw-bold"><a
                      href="{{ route('home', ['media' => $mediaTrendingCategoriesOne[3]->slug]) }}"
                      class="hover-title">{{ $mediaTrendingCategoriesOne[3]->judul }}</a>
                  </h5>
                  <span class="author mb-3 d-block">{{ $mediaTrendingCategoriesOne[3]->user->userDetail->nama_lengkap ??
                    $mediaTrendingCategoriesOne[3]->user->username }}</span>
                  <article class="mb-4">
                    {!! Str::limit(
                    strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $mediaTrendingCategoriesOne[3]->konten)),
                    200,
                    '...',
                    ) !!}</article>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            @foreach ($mediaTrendingCategoriesOne as $index => $media)
            @if ($index >= 4 && $index <= 9) <div class="post-entry-1 border-bottom">
              <div class="post-meta"><span class="badge" style="background-color: #2C65E1;"><a
                    href="{{ route('home', ['kategori' => $media->category->slug]) }}" class="text-white">{{
                    $trendingCategoriesOne->nama_kategori }}</a></span>
                <span class="mx-1">&bullet;</span>
                <span>{{ $media->created_at->translatedFormat('l, d F Y H:i') . ' ' }} |
                  <i class="bi bi-eye-fill"></i> {{ $media->jumlah_dibaca . ' Kali' }}</span>
              </div>
              <h5 class="mb-2 fw-bold"><a href="{{ route('home', ['media' => $media->slug]) }}" class="hover-title">{{
                  $media->judul }}</a>
              </h5>
              <span class="author mb-3 d-block">{{ $media->user->userDetail->nama_lengkap ?? $media->user->username
                }}</span>
          </div>
          @endif
          @endforeach
        </div>
      </div>
      </div>
    </section>
    <!-- End Trending Category One -->
    @endif
    @endif
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">Tentang Website ini</h3>
            <p>Selamat datang di website Penelitian Saya! Ini adalah website yang saya buat untuk penelitian
              skripsi saya. Website ini dirancang untuk mendukung berbagai kegiatan dan kebutuhan
              informasi di lingkungan Kementerian Agama Kalimantan Selatan. Melalui website ini, pengguna
              dapat mengakses Media Elektronik terupdate, serta beragam konten terkait lainnya dengan mudah dan cepat.
              Terima kasih telah mengunjungi website ini, semoga bermanfaat!</p>
            {{-- <p><a href="about.html" class="footer-link-more">Learn More</a></p> --}}
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigasi</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Beranda</a></li>
              <li><a href="{{ route('home', ['layanan' => 'pelayanan-publik']) }}"><i class="bi bi-chevron-right"></i>
                  Pelayanan Publik</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Media</h3>
            <ul class="footer-links list-unstyled">
              @forelse ($categories as $category)
              <li><a href="{{ route('home', ['kategori' => $category->slug]) }}"><i class="bi bi-chevron-right"></i> {{
                  $category->nama_kategori }}</a>
              </li>
              @empty
              <li>Media Tidak Tersedia</li>
              @endforelse
            </ul>
          </div>

          <div class="col-lg-4">
            <h3 class="footer-heading">Postingan Terbaru</h3>

            <ul class="footer-links footer-blog-entry list-unstyled">
              @forelse ($latestMedias->take(4) as $media)
              <li>
                <a href="{{ route('home', ['media' => $media->slug]) }}" class="d-flex align-items-center">
                  <img src="{{ asset('storage/' . $media->gambar) }}" alt="" class="img-fluid me-2 rounded"
                    loading="lazy" style="height: 40px;">
                  <div>
                    <div class="post-meta"><span class="date"><u><strong>{{ $media->category->nama_kategori
                            }}</u></strong></span>
                      <span class="mx-1">&bullet;</span>
                      <span>{{ $media->created_at->translatedFormat('l, d F Y H:i') . ' ' }}
                    </div>
                    <span class="small fw-bold">{{ $media->judul }}</span>
                  </div>
                </a>
              </li>
              @empty
              <li>Belum ada postigan</li>
              @endforelse
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <h3 class="footer-heading">Alamat</h3>
            <div class="mb-3">
              <ul class="footer-links list-unstyled">
                <li><i class="bi bi-geo-alt"></i> Jl. D. I. Panjaitan No.19, Antasan Besar, Kec. Banjarmasin Tengah,
                  Kota Banjarmasin, Kalimantan Selatan 70123</li>
                <li><i class="bi bi-envelope"></i> <a href="mailto:UqyvO@example.com"
                    class="footer-link-more">kanwilkalsel@kemenag.go.id</a></li>
              </ul>
            </div>
            <iframe class="rounded" style="width: 100%; height: 350px;"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d694.0309630218421!2d114.59032847374154!3d-3.31609165038758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423c0e9adc917%3A0x17814b82b6a467f5!2sKanwil%20Kementerian%20Agama%20Provinsi%20Kalimantan%20Selatan!5e0!3m2!1sen!2sid!4v1678236992116!5m2!1sen!2sid"
              allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ReadOnly {{ date('Y') }}</span></strong>. All Rights Reserved
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('vendor/blog/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/blog/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/blog/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ asset('vendor/blog/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('vendor/blog/js/main.js') }}"></script>
  <script>
    $(document).on('click', '#detail_permohonan', function() {
      var kodeLayanan = $(this).data('kode');

      // Clear existing modal content
      $('#modalKodeLayanan').text('');
      $('#modalListId').text('');
      $('#modalServiceId').text('');
      $('#modalNama').text('');
      $('#modalEmail').text('');
      $('#modalPesan').text('');
      $('#modalDiprosesOleh').text('');
      $('#modalFilePersyaratan').text('');
      $('#modalStatus').text('');

      // Fetch new data and update modal
      $.ajax({
        url: '/detail-permohonan',
        method: 'GET',
        data: {
          kode_layanan: kodeLayanan
        },
        success: function(response) {
          $('#modalKodeLayanan').text(response.kode_layanan);
          $('#modalListId').text(response.list.judul); // Assuming response includes the relationship
          $('#modalServiceId').text(response.service.judul); // Assuming response includes the relationship
          $('#modalNama').text(response.nama);
          $('#modalEmail').text(response.email);
          $('#modalPesan').text(response.pesan);
          $('#modalDiprosesOleh').text(response.diproses_oleh);
          if (response.file_persyaratan) {
            var fileLink = '<a href="/storage/' + response.file_persyaratan +
              '" class="hover-title" target="_blank"><i class="bi bi-eye"></i> Lihat File Persyaratan</a>';
            $('#modalFilePersyaratan').html(fileLink);
          } else {
            $('#modalFilePersyaratan').text('-');
          }
          $('#modalStatus').text(response.status);
        }
      });
    });

    $('#kategori_layanan').select2({
      theme: 'bootstrap-5',
    });
    $('#layanan').select2({
      theme: 'bootstrap-5',
    });

    var oldKategoriLayanan = $('#kategori_layanan').data('old');
    var oldLayanan = $('#layanan').data('old');
    if (oldKategoriLayanan) {
      $('#kategori_layanan').val(oldKategoriLayanan);
    }

    $('#kategori_layanan').on('change', function() {
      var categoryId = $(this).val();

      $('#layanan').empty();
      $('#layanan').append('<option selected disabled>' + $('#layanan').data('placeholder') + '</option>');
      $('#file_sop').addClass('d-none');
      $('#file_permohonan').addClass('d-none');
      $('#file_pendukung').addClass('d-none');
      $('#file_persyaratan_container').addClass('d-none');
      $('#is_file_persyaratan_required').val('0');

      if (categoryId) {
        $.ajax({
          url: '/pelayanan/' + categoryId,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            $.each(data, function(key, value) {
              $('#layanan').append('<option value="' + value.id + '">' + value.judul + '</option>');
            });

            if (oldLayanan) {
              $('#layanan').val(oldLayanan);
              $('#layanan').trigger('change');
            }
          }
        });
      }
    });

    if (oldKategoriLayanan) {
      $('#kategori_layanan').trigger('change');
    }

    $('#layanan').on('change', function() {
      var serviceId = $(this).val();
      if (serviceId) {
        $.ajax({
          url: '/file-layanan/' + serviceId,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            var hasFileSop = false;
            var hasFilePermohonan = false;

            if (data.file_sop) {
              $('#file_sop a').attr('href', '/storage/' + data.file_sop);
              $('#file_sop').removeClass('d-none');
              hasFileSop = true;
            } else {
              $('#file_sop').addClass('d-none');
            }

            if (data.file_permohonan) {
              $('#file_permohonan a').attr('href', '/storage/' + data.file_permohonan);
              $('#file_permohonan').removeClass('d-none');
              hasFilePermohonan = true;
            } else {
              $('#file_permohonan').addClass('d-none');
            }

            if (hasFileSop || hasFilePermohonan) {
              $('#file_pendukung').removeClass('d-none');
              $('#file_persyaratan_container').removeClass('d-none');
              $('#is_file_persyaratan_required').val('1');
            } else {
              $('#file_pendukung').addClass('d-none');
              $('#file_persyaratan_container').addClass('d-none');
              $('#is_file_persyaratan_required').val('0');
            }
          }
        });
      }
    });

    function showHideCards() {
      var selectedServiceType = $('#jenis_layanan').val();
      if (selectedServiceType === 'status_layanan') {
        $('#status_layanan_card').removeClass('d-none');
        $('#permohonan_baru_card').addClass('d-none');
      } else if (selectedServiceType === 'permohonan_baru') {
        $('#permohonan_baru_card').removeClass('d-none');
        $('#status_layanan_card').addClass('d-none');
      } else {
        $('#status_layanan_card').addClass('d-none');
        $('#permohonan_baru_card').addClass('d-none');
      }
      sessionStorage.setItem('selectedServiceType', selectedServiceType);
    }

    $('#jenis_layanan').on('change', function() {
      showHideCards();
    });
    var savedServiceType = sessionStorage.getItem('selectedServiceType');
    if (savedServiceType) {
      $('#jenis_layanan').val(savedServiceType);
      showHideCards();
    }

    $('#reset_button').on('click', function() {
      $('#jenis_layanan').val('Pilih Jenis Layanan');
      $('#status_layanan_card').addClass('d-none');
      $('#permohonan_baru_card').addClass('d-none');
      sessionStorage.removeItem('selectedServiceType');
    });
  </script>

</body>

</html>