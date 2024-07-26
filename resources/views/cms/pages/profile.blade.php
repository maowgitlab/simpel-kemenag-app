@extends('cms.layouts.app')
@section('title', 'Profil')
@section('cms')
  @if (session()->has('message'))
    {!! session('message') !!}
  @endif
  @if ($errors->any())
    <script>
      Swal.fire({
        title: "Gagal!",
        text: "Silahkan periksa pesan kesalahan pada Form Edit Profil atau Form ganti password.",
        icon: "error",
        showConfirmButton: true
      });
    </script>
  @endif
  <div class="pagetitle">
    <h1>Profil</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profil</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img
              src="{{ auth()->user()->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . auth()->user()->userDetail->profil) }}"
              alt="Profile" class="rounded-circle" width="100px" height="100px">
            <div class="my-3 text-center">
              <h5 class="fw-bold">{{ auth()->user()->userDetail->nama_lengkap ?? auth()->user()->username }}</h5>
              <span class="text-muted">{{ auth()->user()->userDetail->pekerjaan ?? '-' }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                  aria-selected="true" role="tab">Overview</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false"
                  role="tab" tabindex="-1">Edit Profile</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                  aria-selected="false" tabindex="-1" role="tab">Ganti Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                {{-- <form action="{{ route('verifyEmail') }}" method="post">
                  @csrf
                  <input type="hidden" name="email" value="{{ auth()->user()->userDetail->email }}" id="">
                  <button type="submit">Kirim kode</button>
                </form> --}}
                <h5 class="card-title border-bottom border-1">Tentang Saya</h5>
                <p class="small fst-italic">{{ auth()->user()->userDetail->tentang ?? '-' }}</p>

                <h5 class="card-title border-bottom border-1">Detail Profil</h5>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold ">Nama Lengkap</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->nama_lengkap ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Kantor</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->perusahaan ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Pekerjaan</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->pekerjaan ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Kota</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->kota ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Alamat</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->alamat ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">No HP</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->no_hp ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Email</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->userDetail->email ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Terakhir Login</div>
                  <div class="col-lg-9 col-md-8">{{ date('Y-m-d H:i:s', auth()->user()->terakhir_login) ?? '-' }}</div>
                </div>

                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 label fw-bold">Total Login</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->total_login ?? '-' }} Kali  </div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                <!-- Profile Edit Form -->
                <form method="POST" action="{{ route('profileUpdate', $user->userDetail->id) }}"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Gambar
                      Profil</label>
                    <div class="col-md-8 col-lg-9">
                      <img
                        src="{{ auth()->user()->userDetail->profil == 'profil.png' ? asset('profil.png') : asset('storage/' . auth()->user()->userDetail->profil) }}"
                        alt="Profile" id="profileImage" class="rounded" width="100px" height="100px">
                      <div class="pt-2">
                        <label for="fileInput" class="btn btn-primary btn-sm" title="Upload new profile image">
                          <i class="bi bi-upload"></i>
                        </label>
                        <input type="file" id="fileInput" name="profil"
                          class="@error('profil')
                                            is-invalid
                                        @enderror"
                          style="display: none;">
                        @if (auth()->user()->userDetail->profil != 'profil.png')
                          <a href="{{ route('removeProfile', $user->userDetail->id) }}"
                            class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                        @endif
                        @error('profil')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <script>
                      document.getElementById('fileInput').addEventListener('change', function() {
                        const file = this.files[0];
                        if (file) {
                          const reader = new FileReader();
                          reader.onload = function(e) {
                            document.getElementById('profileImage').src = e.target.result;
                          }
                          reader.readAsDataURL(file);
                        }
                      });
                    </script>
                  </div>


                  <div class="row mb-3">
                    <label for="nama_lengkap" class="col-md-4 col-lg-3 col-form-label">Nama
                      lengkap</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nama_lengkap" type="text"
                        class="form-control @error('nama_lengkap')
                                        is-invalid
                                    @enderror"
                        id="nama_lengkap" value="{{ old('nama_lengkap') ?? auth()->user()->userDetail->nama_lengkap }}">
                      @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="tentang" class="col-md-4 col-lg-3 col-form-label">Tentang</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="tentang"
                        class="form-control @error('tentang')
                                        is-invalid
                                    @enderror"
                        id="tentang" style="height: 100px">{{ old('tentang') ?? auth()->user()->userDetail->tentang }}</textarea>
                      @error('tentang')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="perusahaan" class="col-md-4 col-lg-3 col-form-label">Kantor / Pendidikan</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="perusahaan" type="text"
                        class="form-control @error('perusahaan')
                                        is-invalid
                                    @enderror"
                        id="perusahaan" value="{{ old('perusahaan') ?? auth()->user()->userDetail->perusahaan }}">
                      @error('perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="pekerjaan" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="pekerjaan" type="text"
                        class="form-control @error('pekerjaan')
                                        is-invalid
                                    @enderror"
                        id="pekerjaan" value="{{ old('pekerjaan') ?? auth()->user()->userDetail->pekerjaan }}">
                      @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="kota" class="col-md-4 col-lg-3 col-form-label">Kota</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="kota" type="text"
                        class="form-control @error('kota')
                                        is-invalid
                                    @enderror"
                        id="kota" value="{{ old('kota') ?? auth()->user()->userDetail->kota }}">
                      @error('kota')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="alamat" type="text"
                        class="form-control @error('alamat')
                                        is-invalid
                                    @enderror"
                        id="alamat" value="{{ old('alamat') ?? auth()->user()->userDetail->alamat }}">
                      @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">No
                      Handphone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="no_hp" type="text"
                        class="form-control @error('no_hp')
                                        is-invalid
                                    @enderror"
                        id="no_hp" value="{{ old('no_hp') ?? auth()->user()->userDetail->no_hp }}">
                      @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email"
                        class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                        id="email" value="{{ old('email') ?? auth()->user()->userDetail->email }}">
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bu bi-save"></i>
                      Simpan Perubahan</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                <!-- Change Password Form -->
                <form method="POST" action="{{ route('changePassword', $user->id) }}">
                  @csrf
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password
                      Sekarang</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="currentpassword" type="password"
                        class="form-control @error('currentpassword')
                                        is-invalid
                                    @enderror"
                        id="currentPassword">
                      @error('currentpassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Password
                      Baru</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password"
                        class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                        id="password">
                      @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Ulangi
                      password baru</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password_confirmation" type="password"
                        class="form-control @error('password_confirmation')
                                        is-invalid
                                    @enderror"
                        id="password_confirmation">
                      @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-check-circle"></i> Ganti
                      Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
