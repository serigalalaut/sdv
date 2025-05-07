@extends('layouts/contentNavbarLayout')

@section('title', 'IPL')

@section('content')


<!-- Responsive Table -->
<div class="card">
<div class="mb-3 card-header">
<h3 class="fw-bold py-3 mb-4">Data Pembayaran IPL Bulan {{ date('F Y')}}</h3>
<h5 class="fw-bold py-3 mb-4" style="margin-top:-30px">Total Uang Masuk : Rp. {{ number_format($total, 0, ',', '.') }}</h5>
<h5 class="fw-bold py-3 mb-4" style="margin-top:-30px">Total Tambahan Uang Keamanan : Rp. {{ number_format($total_keamanan, 0, ',', '.') }}</h5>
<h5 class="fw-bold py-3 mb-4" style="margin-top:-30px">Total Tambahan Uang Kebersihan : Rp. {{ number_format($total_kebersihan, 0, ',', '.') }}</h5>
<h5 class="fw-bold py-3 mb-4" style="margin-top:-30px">Total Kas Wajib : Rp. {{ number_format($total_kas_warga, 0, ',', '.') }}</h5>
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
          <th>Tipe Iuran</th>
          <th>Nominal</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($ipl as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{date('l, j F Y', strtotime($data->created_at))}}</td>
          <td>{{$data->home_no}}</td>
          <td>{{$data->type == 1 ? "KEAMANAN DAN KEBERSIHAN" : "KEAMANAN"}}</td>
          <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
          <td>{{$data->status}}</td>
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
