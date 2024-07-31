@if (session()->has('message'))
{!! session('message') !!}
@endif
<div class="col-md-9">
  <h3 class="category-title">Pelayanan Publik</h3>
  <div class="row mb-2">
    <label for="jenis_layanan" class="col-sm-2 col-form-label fw-bold">Jenis Layanan</label>
    <div class="col-sm-12">
      <select name="jenis_layanan" id="jenis_layanan" class="form-select">
        <option disabled selected>Pilih Jenis Layanan</option>
        <option value="status_layanan">Periksa Status Layanan</option>
        <option value="permohonan_baru">Buat Permohonan Pelayanan Baru</option>
      </select>
      <a href="{{ route('home', ['layanan' => 'pelayanan-publik']) }}" class="btn btn-sm btn-outline-secondary mt-2"
        id="reset_button"><i class="bi bi-arrow-clockwise"></i> Reset</a>
    </div>
  </div>
  <div class="card shadow-sm mb-3 d-none" id="status_layanan_card">
    <div class="card-header fw-bold">
      Periksa Status Layanan
    </div>
    <div class="card-body">
      <form action="{{ route('serviceStatus') }}" method="post" class="mb-3">
        @csrf
        <div class="row mb-2">
          <label for="email_status" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="email" name="email_status" class="form-control @error('email_status')
                  is-invalid
                @enderror" id="email_status" autocomplete="off" placeholder="Masukkan Email Valid"
                value="{{ session()->has('serviceApplicants') ? session('serviceApplicants')[0]->email : '' }}">
              <button type="submit" class="btn btn-outline-secondary input-group-text" id="buttonStatus"><i
                  class="bi bi-send"></i>
                Kirim</button>
              @error('email_status')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
      </form>
      @if (session()->has('serviceApplicants') && session('serviceApplicants')->isNotEmpty())
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Layanan</th>
              <th>Kategori Layanan</th>
              <th>Layanan</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach (session('serviceApplicants') as $serviceApplicant)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td><a href="#" class="hover-title" id="detail_permohonan" data-bs-toggle="modal"
                  data-bs-target="#staticBackdrop" data-kode="{{ $serviceApplicant->kode_layanan }}"><u>{{
                    $serviceApplicant->kode_layanan }}</u></a>
              </td>
              <td>{{ $serviceApplicant->list->judul }}</td>
              <td>{{ $serviceApplicant->service->judul }}</td>
              <td>{{ $serviceApplicant->nama }}</td>
              <td>{{ $serviceApplicant->email }}</td>
              <td>{{ $serviceApplicant->status }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>
  <div class="card shadow-sm mb-3 d-none" id="permohonan_baru_card">
    <div class="card-header fw-bold">
      Buat Permohonan Pelayanan Baru
    </div>
    <div class="card-body">
      <form action="{{ route('createNewApplicant') }}" method="POST" enctype="multipart/form-data" id="applicantForm">
        @csrf
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="kategori_layanan" class="form-label fw-bold">Kategori Layanan</label>
            <select class="form-select @error('kategori_layanan')
              is-invalid
            @enderror" id="kategori_layanan" name="kategori_layanan" data-old="{{ old('kategori_layanan') }}">
              <option selected disabled>Pilih Kategori Layanan</option>
              @foreach ($listServices as $listService)
              <option value="{{ $listService->id }}" {{ old('kategori_layanan')==$listService->id ? 'selected' : ''
                }}>{{ $listService->judul }}
              </option>
              @endforeach
            </select>
            @error('kategori_layanan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="layanan" class="form-label fw-bold">Layanan</label>
            <select class="form-select @error('layanan')
              is-invalid
            @enderror" id="layanan" name="layanan" data-old="{{ old('layanan') }}" data-placeholder="Pilih Layanan">
              <option selected disabled>Pilih Layanan</option>
            </select>
            @error('layanan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3 d-none" id="file_pendukung">
          <label for="file_pendukung" class="form-label fw-bold d-block">File Pendukung</label>
          <div class="col-md-3 mx-auto col-4 text-center" id="file_sop">
            <a href="#" target="_blank"><img src="{{ asset('download.png') }}" alt="" class="img-fluid"
                width="80px"></a>
            <div>File SOP</div>
          </div>
          <div class="col-md-3 mx-auto col-4 text-center" id="file_permohonan">
            <a href="#" target="_blank"><img src="{{ asset('download.png') }}" alt="" class="img-fluid"
                width="80px"></a>
            <div>File Permohonan</div>
          </div>
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label fw-bold">Nama</label>
          <input type="text" class="form-control @error('nama')
            is-invalid
          @enderror" id="nama" name="nama" value="{{ old('nama') }}">
          @error('nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Email</label>
          <input type="email" class="form-control @error('email')
            is-invalid
          @enderror" id="email" name="email" value="{{ old('email') }}">
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label fw-bold">Pesan</label>
          <textarea class="form-control @error('pesan')
            is-invalid
          @enderror" name="pesan" id="pesan" rows="5">{{ old('pesan') }}</textarea>
          @error('pesan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3 d-none" id="file_persyaratan_container">
          <label for="file_persyaratan" class="form-label fw-bold">File Persyaratan <sup class="text-danger">PDF |
              Maks. 1 MB*</sup></label>
          <input type="file" class="form-control @error('file_persyaratan') is-invalid @enderror" id="file_persyaratan"
            name="file_persyaratan">
          @error('file_persyaratan')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <input type="hidden" id="is_file_persyaratan_required" name="is_file_persyaratan_required" value="0">
        <button type="submit" id="buttonSend" class="btn btn-sm btn-outline-secondary"><i class="bi bi-send"></i>
          Kirim</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detail Layanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Kode Layanan</th>
            <td id="modalKodeLayanan"></td>
          </tr>
          <tr>
            <th>Kategori Layanan</th>
            <td id="modalListId"></td>
          </tr>
          <tr>
            <th>Layanan</th>
            <td id="modalServiceId"></td>
          </tr>
          <tr>
            <th>Nama</th>
            <td id="modalNama"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td id="modalEmail"></td>
          </tr>
          <tr>
            <th>Pesan</th>
            <td id="modalPesan"></td>
          </tr>
          <tr>
            <th>Diproses Oleh</th>
            <td id="modalDiprosesOleh"></td>
          </tr>
          <tr>
            <th>File Persyaratan</th>
            <td id="modalFilePersyaratan"></td>
          </tr>
          <tr>
            <th>Status</th>
            <td id="modalStatus"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const buttonSend = document.getElementById('buttonSend');
    const form = buttonSend.closest('form');

    form.addEventListener('submit', function() {
      buttonSend.disabled = true;
      buttonSend.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const buttonStatus = document.getElementById('buttonStatus');
    const form = buttonStatus.closest('form');

    form.addEventListener('submit', function() {
      buttonStatus.disabled = true;
      buttonStatus.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';
    });
  });
</script>