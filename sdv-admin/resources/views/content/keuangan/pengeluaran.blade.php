@extends('layouts/contentNavbarLayout')

@section('title', 'Pengeluaran')

@section('content')


<!-- Responsive Table -->
<div class="col-lg-12 mb-4 order-0">
      <div class="row" id="sortable-cards">
        <div class="col-lg-12 col-md-6 col-sm-12">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-success display-6"></i>
              </h2>
              <h4>Total Pengeluaran Periode {{ date('F Y',strtotime($period)) }}</h4>
              <h5>Rp. {{ number_format($total, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
    </div>
    </div>
    <br>

<a href="/laporan-pengeluaran/add" class="btn btn-primary" style="margin-bottom: 10px;">Tambah Data Pengeluaran</a>
<br>
<div class="card">
<div class="mb-3 card-header">
<h3 class="fw-bold py-3 mb-4">Data Pengeluaran Periode {{ date('F Y',strtotime($period)) }}</h3> 
<input type="month" class="form-control" id="locfilter" placeholder="Cari Data" style="width: 20%; margin-bottom: 10px;" value="{{ date('Y-m', strtotime('-1 month')) }}">
<a href="/laporan-pengeluaran?period=" class="btn btn-primary" onclick="this.href='/laporan-pengeluaran?period=' + document.getElementById('locfilter').value">Cari Periode Sebelumnya</a>
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
          <th>Tanggal Transaksi</th>
          <th>Judul</th>
          <th>Nominal</th>
          <th>Periode</th>
          <th>Bukti Pengeluaran</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($pengeluaran as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{date('l, j F Y', strtotime($data->transaction_date))}}</td>
          <td>{{$data->title}}</td>
          <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
          <td>{{date('F Y', strtotime($data->period))}}</td>
          <td>
            <img src="{{ asset('storage/'.$data->media_file) }}" alt="Bukti Pengeluaran" style="width: 100px; height: 100px;">
          </td>
          <td>
            
              <a href="/laporan-pengeluaran/details/{{$data->id}}" class="btn btn-primary">Lebih Detail</a>
             
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
