@extends('layouts/contentNavbarLayout')

@section('title', 'IPL')

@section('content')


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
          <th>Nomor Rumah</th>
          <th>Nama Suami</th>
          <th>Nama Istri</th>
          <th>No. HP Suami</th>
          <th>No. HP Istri</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($warga as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{$data->no_rumah}}</td>
          <td>{{$data->nama_suami}}</td>
          <td>{{$data->nama_istri}}</td>
          <td>{{$data->no_suami}}</td>
          <td>{{$data->no_istri}}</td>
          <td>{{$data->status}}</td>
          <td>
            
              <a href="/warga/edit/{{$data->id}}" class="btn btn-primary">Update Data</a>
             
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
