@extends('layouts/contentNavbarLayout')

@section('title', 'Slider')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Slider /</span> Data Slider
</h4>

<!-- Responsive Table -->
<div class="card">
<div class="mb-3 card-header">
  <a href="/slider/form-slider" class="btn btn-primary">Add Slider</a>
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
          <th>Title</th>
          <th>CTA URL</th>
          <th>Slider</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Created Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($slider as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{$data->title}}</td>
          <td>{{$data->cta_url ? $data->cta_url : '-' }}</td>
          <td>@if($data->filename != null || $data->filename != "") <img src="{{$data->filename}}" alt="" width="64" height="48"> @endif</td>
          <td>{{date('d-m-Y h:i', strtotime($data->start_date))}}</td>
          <td>{{date('d-m-Y h:i', strtotime($data->end_date))}}</td>
          <td>{{date('d-m-Y h:i', strtotime($data->created_at))}}</td>
          <td>
            
              <a href="/slider/edit/{{$data->id}}" class="btn btn-primary"><i class="bx bx-edit-alt me-2"></i></a> |
              <a href="/slider/delete/{{$data->id}}" class="btn btn-danger"><i class="bx bx-trash me-2"></i></a>
             
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
    pagingType: 'full_numbers'
});
</script>
@endsection
