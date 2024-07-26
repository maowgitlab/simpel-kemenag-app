<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('kemenag_logo.png') }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/cms/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/cms/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/cms/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Sweet Alert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


  <!-- Calendar -->
  <link rel="stylesheet" href="{{ asset('vendor/cms/css/jsCalendar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/cms/css/jsCalendar.micro.min.css') }}">
  <script src="{{ asset('vendor/cms/js/jsCalendar.min.js') }}"></script>

  <!-- Template Main CSS File -->
  <link href="{{ asset('vendor/cms/css/style.css') }}" rel="stylesheet">

  <style>
    #saveChanges:disabled {
      cursor: not-allowed;
      opacity: 0.65;
    }
  </style>


  <!-- =======================================================
    * Template Name: NiceAdmin
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('kemenag_logo.png') }}" alt="">
        <span class="d-none d-lg-block">SIMPel Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" id="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img
              src="{{ auth()->user()->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . auth()->user()->userDetail->profil) }}"
              alt="Profile" class="rounded-circle">
            <span
              class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->userDetail->nama_lengkap == null ? auth()->user()->username : auth()->user()->userDetail->nama_lengkap }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
                {{ auth()->user()->userDetail->nama_lengkap == null ? auth()->user()->username : auth()->user()->userDetail->nama_lengkap }}
              </h6>
              <span>{{ auth()->user()->userDetail->pekerjaan == null ? '-' : auth()->user()->userDetail->pekerjaan }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan Akun</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Master</li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeis('media') || request()->routeIs('createMedia') || request()->routeIs('editMedia') || request()->routeIs('category') || request()->routeIs('createCategory') || request()->routeIs('editCategory') || request()->routeIs('tag') || request()->routeIs('createTag') || request()->routeIs('editTag') || request()->routeIs('comment') ? '' : 'collapsed' }}"
          data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-collection"></i><span>Media</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav1"
          class="nav-content {{ request()->routeis('media') || request()->routeIs('createMedia') || request()->routeIs('editMedia') || request()->routeIs('category') || request()->routeIs('createCategory') || request()->routeIs('editCategory') || request()->routeIs('tag') || request()->routeIs('createTag') || request()->routeIs('editTag') || request()->routeIs('comment') ? '' : 'collapse' }}"
          data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('media') }}"
              class="{{ request()->routeis('media') || request()->routeIs('editMedia') || request()->routeIs('createMedia') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Data Media</span>
            </a>
          </li>
          @if (auth()->user()->role == 'admin')
            <li>
              <a href="{{ route('category') }}"
                class="{{ request()->routeis('category') || request()->routeIs('editCategory') || request()->routeIs('createCategory') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Kategori</span>
              </a>
            </li>
            <li>
              <a href="{{ route('comment') }}" class="{{ request()->routeis('comment') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Komentar Spam</span>
              </a>
            </li>
          @endif
          <li>
            <a href="{{ route('tag') }}"
              class="{{ request()->routeis('tag') || request()->routeIs('editTag') || request()->routeIs('createTag') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Tagar</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      @if (auth()->user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link {{ request()->routeis('user') || request()->routeIs('createUser') || request()->routeIs('editUser') ? '' : 'collapsed' }}"
            data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
            <i class="bi bi-people"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav4"
            class="nav-content {{ request()->routeis('user') || request()->routeIs('createUser') || request()->routeIs('editUser') ? '' : 'collapse' }}"
            data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('user') }}"
                class="{{ request()->routeis('user') || request()->routeIs('editUser') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Data User</span>
              </a>
            </li>
            <li>
              <a href="{{ route('createUser') }}" class="{{ request()->routeIs('createUser') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Input User Baru</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      @endif

      @if (auth()->user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link {{ request()->routeis('listService') || request()->routeIs('createListService') || request()->routeIs('editListService') || request()->routeIs('service') || request()->routeIs('createService') || request()->routeIs('editService') || request()->routeIs('inbox') ? '' : 'collapsed' }}"
            data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-bookmark"></i><span>Pelayanan</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav5"
            class="nav-content {{ request()->routeis('listService') || request()->routeIs('createListService') || request()->routeIs('editListService') || request()->routeIs('service') || request()->routeIs('createService') || request()->routeIs('editService') || request()->routeIs('inbox') ? '' : 'collapse' }}"
            data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('inbox') }}" class="{{ request()->routeIs('inbox') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Kotak Masuk</span>
              </a>
              <a href="{{ route('listService') }}"
                class="{{ request()->routeis('listService') || request()->routeIs('editListService') || request()->routeIs('createListService') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Kategori Pelayanan</span>
              </a>
              <a href="{{ route('service') }}"
                class="{{ request()->routeIs('service') || request()->routeIs('editService') || request()->routeIs('createService') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Data Pelayanan</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      @endif

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Feedback Pengguna</span>
        </a>
      </li> --}}

      <li class="nav-heading">Lainnya</li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile') ? '' : 'collapsed' }}" href="{{ route('profile') }}">
          <i class="bi bi-gear"></i>
          <span>Pengaturan Akun</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('logout') ? '' : 'collapsed' }}" href="{{ route('logout') }}">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </li>

      @if (auth()->user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link {{ request()->routeis('allMedia') || request()->routeIs('mediaByCategory') || request()->routeIs('mediaByTime') || request()->routeIs('popularMedia') || request()->routeIs('mostMediaCategory') || request()->routeIs('serviceIn') || request()->routeIs('serviceByCategory') || request()->routeIs('serviceStatuses') ? '' : 'collapsed' }}"
            data-bs-target="#components-nav6" data-bs-toggle="collapse" href="#">
            <i class="bi bi-printer"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav6"
            class="nav-content {{ request()->routeis('allMedia') || request()->routeIs('mediaByCategory') || request()->routeIs('mediaByTime') || request()->routeIs('popularMedia') || request()->routeIs('mostMediaCategory') || request()->routeIs('serviceIn') || request()->routeIs('serviceByCategory') || request()->routeIs('serviceStatuses') ? '' : 'collapse' }}"
            data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('allMedia') }}" class="{{ request()->routeIs('allMedia') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Semua Media</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mediaByCategory') }}"
                class="{{ request()->routeIs('mediaByCategory') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Media Berdasarkan Kategori</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mediaByTime') }}" class="{{ request()->routeIs('mediaByTime') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Media Rentang Waktu</span>
              </a>
            </li>
            <li>
              <a href="{{ route('popularMedia') }}"
                class="{{ request()->routeIs('popularMedia') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Media Paling Populer</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mostMediaCategory') }}"
                class="{{ request()->routeIs('mostMediaCategory') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Kategori Media Terbanyak</span>
              </a>
            </li>
            {{-- <li>
          <a href="#" class="">
            <i class="bi bi-circle"></i><span>Feedback Pengguna Aplikasi</span>
          </a>
        </li> --}}
            <li>
              <a href="{{ route('serviceIn') }}" class="{{ request()->routeIs('serviceIn') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Pelayanan Masuk</span>
              </a>
            </li>
            <li>
              <a href="{{ route('serviceByCategory') }}"
                class="{{ request()->routeIs('serviceByCategory') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Pelayanan Berdasarkan Kategori</span>
              </a>
            </li>
            <li>
              <a href="{{ route('serviceStatuses') }}"
                class="{{ request()->routeIs('serviceStatuses') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Status Pelayanan</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      @endif
    </ul>

  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">

    @yield('cms')

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Readonly {{ date('Y') }}</span></strong>. All Rights Reserved
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('vendor/cms/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/cms/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('vendor/cms/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- TinyMCE -->
  <script src="{{ asset('vendor/cms/vendor/tinymce/tinymce.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('vendor/cms/js/main.js') }}"></script>

  <!-- Custom Script -->
  {{-- perbaiki tag --}}
  <script>
    $('#tags').select2({
      theme: 'bootstrap-5',
      placeholder: 'Pilih Tag'
    });
    $('#categoryID').select2({
      theme: 'bootstrap-5'
    });
    $(document).on('click', '.hover-title', function() {
      var kodeLayanan = $(this).data('kode');

      // Clear existing modal content
      $('#modalKodeLayanan').text('');
      $('#modalListId').text('');
      $('#modalServiceId').text('');
      $('#modalNama').text('');
      $('#modalEmail').text('');
      $('#modalPesan').text('');
      $('#modalDiprosesOleh').val('');
      $('#modalFilePersyaratan').text('');
      $('#modalStatus').val('');

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
          $('#modalDiprosesOleh').val(response.diproses_oleh);
          if (response.file_persyaratan) {
            var fileLink = '<a href="/storage/' + response.file_persyaratan +
              '" class="hover-title" target="_blank"><i class="bi bi-eye"></i> Lihat File Persyaratan</a>';
            $('#modalFilePersyaratan').html(fileLink);
          } else {
            $('#modalFilePersyaratan').text('-');
          }
          $('#modalStatus').val(response.status);
        }
      });
    });

    $('#saveChanges').on('click', function() {
      var kodeLayanan = $('#modalKodeLayanan').text();
      var diprosesOleh = $('#modalDiprosesOleh').val();
      var status = $('#modalStatus').val();

      // Disable buttons and show loading spinner
      $('#saveChanges').attr('disabled', true);
      $('#closeButton').attr('disabled', true);
      $('#buttonText').addClass('d-none');
      $('#loadingSpinner').removeClass('d-none');

      $.ajax({
        url: '/update-permohonan',
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          kode_layanan: kodeLayanan,
          diproses_oleh: diprosesOleh,
          status: status
        },
        success: function(response) {
          // Kirim email setelah status diperbarui
          $.ajax({
            url: '/kirim-status-email',
            method: 'POST',
            data: {
              _token: '{{ csrf_token() }}',
              kode_layanan: kodeLayanan
            },
            success: function() {
              // Delay for better UX to wait for email sending completion
              setTimeout(function() {
                Swal.fire({
                  title: 'Berhasil!',
                  text: 'Permohonan layanan ' + kodeLayanan + ' telah diperbarui.',
                  icon: 'success'
                }).then(() => {
                  $('#staticBackdrop').modal('hide');
                  window.location.reload();
                });
              }, 2000); // Delay for 2 seconds
            },
            error: function(response) {
              Swal.fire('Gagal!', 'Gagal mengirim email.', 'error');
            },
            complete: function() {
              // Re-enable the buttons and hide the loading spinner
              setTimeout(function() {
                $('#saveChanges').attr('disabled', false);
                $('#closeButton').attr('disabled', false);
                $('#buttonText').removeClass('d-none');
                $('#loadingSpinner').addClass('d-none');
              }, 2000); // Synchronize the loading spinner with the Swal alert
            }
          });
        },
        error: function(response) {
          Swal.fire('Gagal!', 'Gagal memperbarui data', 'error');
          // Re-enable the buttons and hide the loading spinner in case of error
          setTimeout(function() {
            $('#saveChanges').attr('disabled', false);
            $('#closeButton').attr('disabled', false);
            $('#buttonText').removeClass('d-none');
            $('#loadingSpinner').addClass('d-none');
          }, 2000); // Synchronize the loading spinner with the Swal alert
        }
      });
    });
  </script>

</body>

</html>
  