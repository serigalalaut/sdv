@extends('layouts/contentNavbarLayout')

@section('title', 'Kas Warga')

@section('content')


<!-- Responsive Table -->
<div class="col-lg-12 mb-4 order-0">
      <div class="row" id="sortable-cards">
        <div class="col-lg-12 col-md-6 col-sm-6">
          <div class="card drag-item cursor-move mb-lg-0 mb-6">
            <div class="card-body text-center">
              <h2>
                <i class="icon-base bx bx-money icon-sm text-success display-6"></i>
              </h2>
              <h4>Total Kas Periode {{ date('F Y',strtotime($period))}}</h4>
              <h5>Rp. {{ number_format($total, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
        
      </div>
    <br>

<a href="/kas-warga/add" class="btn btn-primary" style="margin-bottom: 10px;">Tambah Data Kas Warga</a>
<div class="card">
<div class="mb-3 card-header">
<h3 class="fw-bold py-3 mb-4">Data Kas Warga Periode {{ date('F Y',strtotime($period))}}</h3> 
<input type="month" class="form-control" id="locfilter" placeholder="Cari Data" style="width: 20%; margin-bottom: 10px;" value="{{ date('Y-m', strtotime('-1 month')) }}">
<a href="/kas-warga?period=" class="btn btn-primary" onclick="this.href='/kas-warga?period=' + document.getElementById('locfilter').value">Cari Periode Sebelumnya</a>
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
          <th>Judul</th>
          <th>Nominal</th>
          <th>Periode</th>
        </tr>
      </thead>
      <tbody>
      @foreach($kas_warga as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{$data->title}}</td>
          <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
          <td>{{date('F Y', strtotime($data->period))}}</td>
          
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
