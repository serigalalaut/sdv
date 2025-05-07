@extends('layouts/contentNavbarLayout')

@section('title', ' Edit User')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Edit User</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit User</h5> <small class="text-muted float-end"></small>
      </div>
     
      <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
      @endif
        <form action="{{url('/update-user')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama User</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"/>
            </div>
          </div>
          
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="/user" type="submit" class="btn btn-default">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection