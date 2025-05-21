@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="row" id="sortable-cards">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-success display-6"></i>
              </h2>
              <h4>Sisa Saldo Kas Bulan {{ date('F Y') }}</h4>
              <h5>Rp. {{ number_format($kas_warga-$pengeluaran, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-primary display-6"></i>
              </h2>
              <h4>Pembayaran IPL Bulan {{ date('F Y',strtotime(env('period'))) }}</h4>
              <h5>Rp. {{ number_format($pemasukan, 0, ',', '.') }} dari {{$total_warga}} KK</h5>
            </div>
          </div>
        </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card drag-item cursor-move mb-lg-0 mb-6">
          <div class="card-body text-center">
            <h2>
              <i class="icon-base bx bx-money icon-sm text-info display-6"></i>
            </h2>
            <h4>Pengeluaran Bulan {{ date('F Y') }}</h4>
            <h5>Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</h5>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          
          <div class="card-body">
            <h5 class="card-title text-primary">Selamat datang {{auth()->user()->name}} 🎉</h5>
            <p class="mb-4">selamat beraktifitas, semoga harimu menyenangkan.</p>

          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transactions -->
</div>
@endsection
