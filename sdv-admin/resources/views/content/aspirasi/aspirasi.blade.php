@extends('layouts/contentNavbarLayout')

@section('title', 'Aspirasi')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Aspirasi /</span> Data Aspirasi
</h4>

<!-- Responsive Table -->
<div class="card">
<div class="mb-3 card-header">
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
          <th>Aspirasi Warga</th>
          <th>Tanggal</th>
          
        </tr>
      </thead>
      <tbody>
      @foreach($aspirasi as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td style="white-space: pre-wrap; word-wrap: break-word;">{{$data->aspirasi}}</td>
          <td>{{date('d-m-Y h:i', strtotime($data->created_at))}}</td>
          
        </tr>
       @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Responsive Table -->
<script>
  new DataTable('#example', {
    pagingType: 'full_numbers'
});
</script>
@endsection
