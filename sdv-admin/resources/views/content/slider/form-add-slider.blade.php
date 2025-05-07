@extends('layouts/contentNavbarLayout')

@section('title', ' Add Slider')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Slider/</span> Add Slider</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Slider</h5> <small class="text-muted float-end"></small>
      </div>
      
      <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            
        </div>
      @endif
        <form action="{{url('/slider/add-slider')}}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="title" placeholder="Title Slider" />
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">CTA URL</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-company" name="cta_url" placeholder="CTA URL" />
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Start Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="basic-default-company" name="start_date" placeholder="Start Date" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">End Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="basic-default-company" name="end_date" placeholder="End Date" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Enabled</label>
            <div class="col-sm-10">
              <input type="radio" class="" name="enabled" value="true" checked/> enabled
              <input type="radio" class="" name="enabled" value="false" /> disabled
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Image Slider</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="image" id="selectImage">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message"></label>
            <div class="col-sm-10">
            <img id="preview" src="#" alt="your image" class="mt-3" style="display:none;"/>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="/slider" type="submit" class="btn btn-default">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = selectImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection