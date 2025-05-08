@extends('layouts/contentNavbarLayout')

@section('title', 'User')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">User /</span> Data User
</h4>

<!-- Responsive Table -->
<div class="card">
  <div class="mb-3 card-header">
    <a href="/form-user" class="btn btn-primary">Add User</a>
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
          <th>Nama User</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($user as $data)
        <tr>
          <th scope="row">{{$loop->index+1}}</th>
          <td>{{$data->name}}</td>
          <td>{{$data->email}}</td>
          <td>
            
                <a href="/user/edit/{{$data->id}}" class="btn btn-primary"><i class="bx bx-edit-alt me-2"></i></a> | 
                <a href="/user/delete/{{$data->id}}" class="btn btn-danger"><i class="bx bx-trash me-2"></i> Nonaktifkan</a>
             
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
