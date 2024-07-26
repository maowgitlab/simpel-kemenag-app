@extends('cms.layouts.app')
@section('title', 'Dashboard')
@section('cms')
  @if (session()->has('message'))
    {!! session('message') !!}
  @endif
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Post Card -->
          <div class="col-12 col-md-4">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Media</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-collection"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $recentActivities->count() }}</h6>
                    <span style="font-size: 10px"><a href="{{ route('media') }}" class="hover-title"
                        style="color: #012970">Selengkapnya</a></span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Category Card -->
          <div class="col-6 col-md-4">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Kategori</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-card-list"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalCategories }}</h6>
                    @if (auth()->user()->role == 'admin')
                      <span style="font-size: 10px"><a href="{{ route('category') }}" class="hover-title"
                          style="color: #012970">Selengkapnya</a></span>
                    @endif
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- User Card -->
          <div class="col-6 col-md-4">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">User</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalUsers }}</h6>
                    @if (auth()->user()->role == 'admin')
                      <span style="font-size: 10px"><a href="{{ route('user') }}" class="hover-title"
                          style="color: #012970">Selengkapnya</a></span>
                    @endif
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <!-- Complaint Card -->
          <div class="col-md">

            <div class="card info-card complaint-card">
              <div class="card-body">
                <h5 class="card-title">Pelayanan</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal-bookmark"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalServiceApplicant }}</h6>
                    @if (auth()->user()->role == 'admin')
                      <span style="font-size: 10px"><a href="{{ route('inbox') }}" class="hover-title"
                          style="color: #012970">Selengkapnya</a></span>
                    @endif
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Complaint Card -->

          <!-- Feedback Card -->
          {{-- <div class="col-6 col-md-6">

            <div class="card info-card feedback-card">
              <div class="card-body">
                <h5 class="card-title">Feedback</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <div class="ps-3">
                    <h6>99</h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Feedback Card --> --}}

          <div class="col-md-12">
            <div class="card">

              <div class="card-body">
                <h5 class="card-title">#Hastag <span>/ Hari ini <sup class="text-danger">Opsional</sup></span></h5>
                <form class="row g-3 mt-2" action="{{ route('tagStore') }}" method="POST">
                  @csrf
                  <div class="col-md-12">
                    <input type="text"
                      class="form-control @error('nama_tag')
                                        is-invalid
                                    @enderror"
                      id="nama_tag" name="nama_tag" value="{{ old('nama_tag') }}"
                      placeholder="contoh: kemenagKalsel, tanpa #">
                    @error('nama_tag')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm"><i class="bi bi-upload"></i>
                      Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Reports -->
          <div class="col-12">
            <div class="card">

              <div class="card-body">
                <h5 class="card-title">Media Populer <span>/ Bulan ini</span></h5>

                <!-- Chart -->
                <div class="col-md-12">
                  <canvas id="popularMedia"></canvas>
                </div>
            
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('popularMedia').getContext('2d');
                    const chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: Array.from({
                          length: @json($popularMedias->count())
                        }, (_, i) => i + 1),
                        datasets: [{
                          label: 'Media Populer',
                          data: @json($popularMedias->pluck('jumlah_dibaca')),
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true,
                            ticks: {
                              callback: function(value) {
                                return Number.isInteger(value) ? value :
                                  '';
                              }
                            }
                          }
                        },
                        plugins: {
                          tooltip: {
                            callbacks: {
                              title: function(context) {
                                var index = context[0].dataIndex;
                                return @json($popularMedias->pluck('judul'))[index];
                              },
                              label: function(context) {
                                return 'Jumlah Dibaca: ' + context.raw;
                              }
                            }
                          }
                        },
                        animation: {
                          duration: 3000, // Durasi animasi dalam milidetik
                          easing: 'easeInOutExpo', // Tipe easing animasi
                        }
                      }
                    });
                  });
                </script>
                <!-- End Line Chart -->

              </div>
            </div>
          </div><!-- End Reports -->

          <div class="col-12">
            <!-- News & Updates Post -->
            <div class="card">

              <div class="card-body pb-0">
                <h5 class="card-title">Media Terupdate <span>| Hari ini</span></h5>

                <div class="news">

                  @forelse ($recentActivities->take(5) as $post)
                    <div class="post-item clearfix">
                      <img src="{{ asset('storage/' . $post->gambar) }}" alt="">
                      <h4><a href="#">{{ $post->judul }}</a></h4>
                      <p>{!! Str::limit(strip_tags(str_replace('PROJECT-KU.MY.ID -', '"', $post->konten)), 100, '...') !!}</p>
                    </div>
                  @empty
                    <div class="mb-4 text-center"><i class="bi bi-collection me-1"></i>
                      Belum ada Media Hari ini.</div>
                  @endforelse

                </div><!-- End sidebar recent posts-->

              </div>
            </div><!-- End News & Updates -->
          </div>

        </div>
      </div>
      <!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">
        <!-- Category Chart -->
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">Kategori Populer <span>| Bulan ini</span></h5>

            <canvas id="popularCategories"></canvas>

            <script>
              document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('popularCategories').getContext('2d');
                var chart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: @json($popularCategories->pluck('nama_kategori')),
                    datasets: [{
                      label: 'Jumlah Postingan',
                      data: @json($popularCategories->pluck('medias_count')),
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                      ],
                      borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: true,
                    animation: {
                      duration: 3000,
                      animateScale: true
                    }
                  }
                });
              });
            </script>

          </div>
        </div><!-- End Budget Report -->

        <!-- Recent Activity -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Aktivitas Terbaru <span>| Hari ini</span></h5>

            <div class="activity">

              @forelse ($recentActivities as $postActivity)
                <div class="activity-item d-flex">
                  <div class="activite-label">{{ $postActivity->created_at->DiffForHumans() }}</div>
                  <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                  <div class="activity-content">
                    <strong>{{ $postActivity->user->username }}</strong> Baru saja mengupload Media.
                  </div>
                </div>
              @empty
                <div class="text-center">Belum Ada Aktivitas.</div>
              @endforelse

            </div>

          </div>
        </div><!-- End Recent Activity -->

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kalender </span></h5>
            <div class="auto-jsCalendar classic-theme micro-theme justify-content-center d-flex" data-zero-fill="true"
              data-month-format="MMM" data-day-format="DDD">
            </div>
          </div>
        </div>

      </div>
      <!-- End Right side columns -->

    </div>
  </section>
@endsection