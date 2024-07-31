<div class="col-md-9 aos-init aos-animate" data-aos="fade-up">
  @if (session()->has('message'))
  {!! session('message') !!}
  @endif

  @if (session()->has('error'))
  <script>
    Swal.fire({
        title: "Gagal!",
        text: "{{ session('error') }}",
        icon: "error",
        showConfirmButton: true
      });
  </script>
  @endif
  <!-- ======= Single Post Content ======= -->
  @foreach ($medias as $media)
  <div class="single-post">
    <h4><a href="{{ route('home', ['kategori' => $media->category->slug]) }}" style="color: #2C65E1;" class="fw-bold">{{
        $media->category->nama_kategori }}</a></h4>
    <h1 class="mb-3 fw-bold">{{ $media->judul }}</h1>
    <div class="row my-3">
      <div class="col-md-12 d-flex justify-content-between">
        <div class="d-flex align-items-center author">
          <div class="photo"><img
              src="{{ $media->user->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . $media->user->userDetail->profil) }}"
              alt="" class="img-fluid" loading="lazy"></div>
          <div class="name">
            <h3 class="m-0 p-0 fw-bold">{{ $media->user->userDetail->nama_lengkap ?? $media->user->username }}</h3>
            <h6 class="small m-0 text-muted">{{ $media->user->role }}</h3>
          </div>
        </div>
        <div class="post-meta">
          <span>{{ $media->created_at->translatedFormat('l, d-m-Y H:i') }} <i class="bi bi-eye-fill"></i>
            {{ $media->jumlah_dibaca }}</span>
        </div>
      </div>
    </div>
    <figure class="my-4">
      <img src="{{ asset('storage/' . $media->gambar) }}" alt="" class="img-fluid rounded w-100">
    </figure>
    <article>
      {!! $media->konten !!}
    </article>
    <ul class="aside-tags list-unstyled">
      @foreach ($media->tags as $tag)
      <li><a href="#">#{{ $tag->nama_tag }}</a>
      </li>
      @endforeach
    </ul>
    <div class="d-flex justify-content-end">
      <span class="fw-bold">Bagikan:</span>
      <button onclick="copyUrl()" class="btn btn-sm btn-secondary rounded-circle ms-3">
        <i class="bi bi-copy"></i>
      </button>
      <button onclick="shareWhatsApp()" class="btn btn-sm btn-success rounded-circle ms-2">
        <i class="bi bi-whatsapp"></i>
      </button>
      <button onclick="shareTelegram()" class="btn btn-sm btn-info rounded-circle ms-2">
        <i class="bi bi-telegram"></i>
      </button>
      <button onclick="shareTwitter()" class="btn btn-sm btn-primary rounded-circle ms-2">
        <i class="bi bi-twitter"></i>
      </button>
      <button onclick="shareFacebook()" class="btn btn-sm rounded-circle ms-2 text-white"
        style="background-color: #0866FF">
        <i class="bi bi-facebook"></i>
      </button>
    </div>
  </div>

  <!-- ======= Comments ======= -->
  <div class="comments">
    <h5 class="comment-title py-4">{{ $media->comments->count() }} Komentar</h5>
    @forelse ($media->comments->reverse() as $comment)
    <div class="comment d-flex mb-4">
      <div class="flex-shrink-0">
        <div class="avatar avatar-sm rounded-circle">
          <img class="avatar-img" src="{{ asset('profil.png') }}" alt="">
        </div>
      </div>
      <div class="flex-grow-1 ms-2 ms-sm-3">
        <div class="comment-meta d-flex align-items-baseline">
          <h6 class="me-2">{{ $comment->perangkat }} <sup><a type="button" class="text-danger"
                onclick="reportComment({{ $comment->id }})"><i class="bi bi-info-circle"></i></sup></a></h6>
          <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="comment-body">
          <i>{{ $comment->komentar }}</i>
        </div>
      </div>
    </div>
    @empty
    <div class="alert alert-secondary">
      Belum ada komentar
    </div>
    @endforelse
  </div>
  <!-- End Comments -->
  <!-- ======= Comments Form ======= -->
  <div class="row justify-content-center mt-5">
    <div class="col-lg-12">
      <h5 class="comment-title">Tinggalkan Komentar</h5>
      <div class="row">
        <form action="{{ route('sendComment') }}" method="post">
          @csrf
          <input type="hidden" value="{{ $media->id }}" name="media_id">
          <input type="hidden" id="perangkat" name="perangkat">
          <div class="col-12 mb-3">
            <textarea class="form-control @error('komentar')
              is-invalid
            @enderror" id="comment-message" placeholder="Komentar..." cols="30" rows="5" name="komentar"></textarea>
            @error('komentar')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-12 mb-3">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
            <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
            @endif
          </div>
          <div class="col-12">
            <button class="btn btn-sm btn-outline-dark"><i class="bi bi-send"></i> Kirim Komentar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Comments Form -->
  @endforeach
  <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary mt-3"><i class="bi bi-arrow-left"></i>
    Kembali</a>
  <!-- End Single Post Content -->
</div>
<script>
  function copyUrl() {
    const url = window.location.href;
    navigator.clipboard.writeText(url);
    Swal.fire({
      icon: "success",
      title: "URL Berhasil Disalin",
      showConfirmButton: false,
      timer: 1500
    });
  }

  function reportComment(commentId) {
    Swal.fire({
      title: 'Laporan Komentar ini?',
      text: "Komentar yang dilaporkan akan segera kami tindak lanjuti.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Laporkan',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "{{ route('reportComment', ':commentId') }}".replace(':commentId', commentId);
      }
    })
  }

  function shareWhatsApp() {
    const url = "whatsapp://send?text=" + encodeURIComponent(window.location.href);
    window.open(url, "_blank");
  }

  function shareTelegram() {
    const url = "https://t.me/share/url?url=" + encodeURIComponent(window.location.href);
    window.open(url, "_blank");
  }

  function shareTwitter() {
    const url = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(window.location.href);
    window.open(url, "_blank");
  }

  function shareFacebook() {
    const url = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
    window.open(url, "_blank");
  }

  document.addEventListener('DOMContentLoaded', function() {
    function setPerangkat(uniqueID) {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate()).padStart(2, '0');
      const dateString = year + month + day;

      const platform = getPlatform();
      const perangkat = `${platform} ${dateString}_${uniqueID}`;

      document.getElementById('perangkat').value = perangkat;
    }

    function getPlatform() {
      const userAgent = navigator.userAgent || navigator.vendor || window.opera;

      if (/android/i.test(userAgent)) {
        return 'Android';
      }
      if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return 'iOS';
      }
      if (/Win/i.test(userAgent)) {
        return 'Windows';
      }
      if (/Mac/i.test(userAgent)) {
        return 'MacOS';
      }
      if (/Linux/i.test(userAgent)) {
        return 'Linux';
      }
      return 'Anonim';
    }

    function fetchUniqueID() {
      fetch('{{ route('setUniqueID') }}')
        .then(response => response.json())
        .then(data => {
          setPerangkat(data.uniqueID);
        });
    }

    fetchUniqueID();
  });
</script>