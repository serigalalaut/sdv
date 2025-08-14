@extends('layouts/contentNavbarLayout')

@section('title', 'IPL')

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
              <h4>Uang Masuk</h4>
              <h5>Rp. {{ number_format($total, 0, ',', '.') }}</h5>
            </div>
          </div>
        </div>
       
    </div>
    <br>
<div class="card">
<div class="mb-3 card-header">
<h5><strong>{{ $total_warga }} Warga Sudah Bayar Agustusan</strong></h5>
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
          <th>Nominal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      @foreach($agustusan as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{date('l, j F Y', strtotime($data->created_at))}}</td>
          <td>{{$data->home_no}}</td>
          <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
          <td>{{$data->status}}</td>
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
