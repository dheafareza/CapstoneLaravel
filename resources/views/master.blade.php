@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Row 1: Cards PENDAPATAN, PENGELUARAN, SISA UANG, dan KARYAWAN -->
    <div class="col-12">
      <div class="row">
        <!-- Pendapatan Card -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card info-card sales-card">
            <!-- <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start"><h6>Filter</h6></li>
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div> -->
            <div class="card custom-border-left no-shadow shadow h-100 py-2">
              <div class="card-body">
                  <h5 class="card-title">PENDAPATAN <span>| HARI INI</span></h5>
                  <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-calendar"></i>
                      </div>
                      <div class="ps-3">
                          <h6>
                              Rp. {{ number_format($pemasukan_hari_ini, 2, ',', '.') }}
                          </h6>
                      </div>
                  </div>
                  <div class="mt-4">
                      <span class="text-muted small pt-2 ps-1">&nbsp Mingguan: </span>
                      <span class="text-success small pt-1 fw-bold">Rp. {{ number_format($jumlahmasuk, 2, ',', '.') }}</span>
                  </div>
              </div>
          </div>
          <style>
              .custom-border-left {
                  border-left: 4px solid rgb(28, 200, 138); /* Warna dan lebar garis sesuai permintaan */
              }
              .no-shadow {
                  /* box-shadow: none; Hilangkan bayangan */
                  margin-bottom: 0; /* Hilangkan margin bawah */
                  padding-bottom: 0; /* Hilangkan padding bawah */
              }
          </style>
          </div>
        </div>
        <!-- End Pendapatan Card -->

        <!-- Pengeluaran Card -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card info-card revenue-card">
              <div class="card custom-border-left-2 no-shadow shadow h-100 py-2">
                  <div class="card-body">
                      <h5 class="card-title">PENGELUARAN <span>| HARI INI</span></h5>
                      <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-currency-dollar"></i>
                          </div>
                          <div class="ps-3">
                              <h6>
                                  Rp. {{ number_format($pengeluaran_hari_ini, 2, ',', '.') }}
                              </h6>
                          </div>
                      </div>
                      <div class="mt-4">
                        <span class="text-muted small pt-2 ps-1">&nbsp Mingguan:</span>
                        <span class="text-success small pt-1 fw-bold"> Rp. {{ number_format($jumlahkeluar, 2, ',', '.') }}</span>
                      </div>
                      <style>
                          .custom-border-left-2 {
                              border-left: 4px solid rgb(231, 74, 59); 
                          }
                          .no-shadow {
                              margin-bottom: 0; 
                              padding-bottom: 0; 
                          }
                      </style>
                  </div>
              </div>
          </div>
      </div>
        <!-- End Pengeluaran Card -->

        <!-- Sisa Uang Card -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card info-card customers-card">
                <div class="card custom-border-left-3 no-shadow shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">SISA UANG</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6>
                                    Rp. {{ number_format($uang, 2, ',', '.') }}
                                </h6>
                            </div>
                        </div>
                        <div class="mt-2">
                        <span class="text-muted small pt-2 ps-1"></span>
                        <span class="text-success small pt-1 fw-bold"> </span>
                            <div class="progress progress-md mr-2">
                                @php
                                    if ($uang < 1) {
                                        $warna = 'danger';
                                        $value = 0;
                                    } elseif ($uang >= 1 && $uang < 1000000) {
                                        $warna = 'warning';
                                        $value = 1;
                                    } else {
                                        $warna = 'info';
                                        $value = min(100, $uang / 10000); // Batas maksimum 100%
                                    }
                                @endphp
                                <div class="progress-bar bg-{{ $warna }} custom-progress-bar" role="progressbar" 
                                    style="width: {{ $value }}%" aria-valuenow="{{ $value }}" 
                                    aria-valuemin="0" aria-valuemax="100">
                                    <span>{{ round($value, 2) }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .custom-border-left-3 {
                        border-left: 4px solid rgb(54, 185, 204);
                    }
                    .no-shadow {
                        margin-bottom: 0;
                        padding-bottom: 0;
                    }
                    .custom-progress-bar span {
                        color: white; 
                        font-weight: 600; 
                        font-size: 1.2em;
                    }
                </style>
            </div>
        </div>
        <!-- End Sisa Uang Card -->

        <!-- Karyawan Card -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card info-card karyawan-card">
          <div class="card custom-border-left-4 no-shadow shadow h-100 py-2">
            <div class="card-body">
              <h5 class="card-title">KARYAWAN</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6-i>{{ number_format($karyawan) }}</h6-i>
                </div>
              </div>
              <div class="mt-4">
                        <span class="text-muted small pt-2 ps-1"></span>
                        <span class="text-success small pt-1 fw-bold"> </span>
              </div>
            </div>
            </div>
            <style>
              .custom-border-left-4 {
                  border-left: 4px solid rgb(78, 115, 223); 
                }
              .no-shadow {
                  margin-bottom: 0; 
                  padding-bottom: 0; 
                }
            </style>
          </div>
        </div>
        <!-- End Karyawan Card -->
      </div>
    </div>
    <!-- End Row 1 -->

    <!-- Row 2: Recent Sales and Website Traffic -->
    <div class="col-12">
      <div class="row">
        <!-- Pendapatan Minggu Ini Card -->
        <div class="col-lg-8">
          <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Pendapatan Minggu Ini</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            <!-- End Recent Sales -->

        <!-- Perbandingan -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Perbandingan <span></span></h5>
                    <div id="comparisonChart" style="min-height: 400px;" class="echart"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#comparisonChart")).setOption({
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    top: '5%',
                                    left: 'center'
                                },
                                color: ['rgb(46, 202, 106)', 'rgb(220, 53, 69)', 'rgb(54, 185, 204)'],
                                series: [{
                                    name: 'Perbandingan Keuangan',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: {
                                        show: false,
                                        position: 'center'
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                    labelLine: {
                                        show: false
                                    },
                                    data: [
                                        { value: {{ $jumlahmasuk }}, name: 'Pendapatan' },
                                        { value: {{ $jumlahkeluar }}, name: 'Pengeluaran' },
                                        { value: {{ $uang }}, name: 'Sisa Uang' }
                                    ]
                                }]
                            });
                        });
                    </script>

                </div>
            </div><!-- End Perbandingan -->
        </div>
        <!-- End Right side columns -->
      <!-- </div> -->
</section>
@endsection