@extends('layouts/contentNavbarLayout')

@section('title', 'IPL')

@section('content')


<!-- Responsive Table -->
<div class="col-lg-12 mb-4 order-0">
      <div class="row" id="sortable-cards">
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-success display-6"></i>
              </h2>
              <h4>Uang Masuk</h4>
              <h5>Rp. {{ number_format($total, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-success display-6"></i>
              </h2>
              <h4>Kas Wajib</h4>
              <h5>Rp. {{ number_format($total_kas_warga, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-primary display-6"></i>
              </h2>
              <h4>Uang Keamanan</h4>
              <h5>Rp. {{ number_format($total_keamanan, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card drag-item cursor-move mb-lg-0 mb-6">
          <div class="card-body text-center">
            <h2>
              <i class="icon-base bx bx-money icon-sm text-info display-6"></i>
            </h2>
            <h4>Uang Kebersihan</h4>
            <h5>Rp. {{ number_format($total_kebersihan, 0, ',', '.') }}</h5>
          </div>
        </div>
      </div>
    </div>
    <br>
<div class="card">
<div class="mb-3 card-header">
<h3 class="fw-bold py-3 mb-4">Data Pembayaran IPL Bulan {{ date('F Y')}}</h3> 
<h5><strong>{{ $total_warga }} Warga Sudah Bayar IPL</strong></h5>
<input type="month" class="form-control" id="locfilter" placeholder="Cari Data" style="width: 20%; margin-bottom: 10px;" value="{{ date('Y-m', strtotime('-1 month')) }}">
<a href="/ipl?period=" class="btn btn-primary" onclick="this.href='/ipl?period=' + document.getElementById('locfilter').value">Cari Periode Sebelumnya</a>
@if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-top:10px">
            {{ session('success') }}
        </div>
      @endif
  </div>
  <div class="table-responsive text-nowrap card-header" style="margin-top:-40px">
    <table class="table data-table" id="example">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Tanggal Transfer</th>
          <th>Nomor Rumah</th>
          <th>Metode Pembayaran</th>
          <th>Nominal</th>
          <th>Status</th>
          <th>Rapel</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($ipl as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{date('l, j F Y', strtotime($data->created_at))}}</td>
          <td>{{$data->home_no}}</td>
          <td>{{ strtoupper($data->payment_type) }}</td>
          <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
          <td>{{$data->status}}</td>
          <td>{{$data->is_rapel == 1 ? $data->rapel_periode." Bulan" : '-'}}</td>
          <td>
            
              <a href="/ipl/confirm/{{$data->id}}" class="btn btn-primary">Lebih Detail</a>
             
          </td>
        </tr>
       @endforeach
      </tbody>
    </table>
  </div>
</div>

<!--/ Responsive Table -->
<script>
  new DataTable('#example', {
    pagingType: 'full_numbers',
    pageLength: 50
});
</script>
@endsection
