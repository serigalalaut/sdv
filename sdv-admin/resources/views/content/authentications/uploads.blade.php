@extends('layouts/blankLayout')

@section('title', 'Upload Bukti Pembayaran IPL')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/uploads')}}" class="app-brand-link gap-2">
              
              <span class="app-brand-text demo text-body fw-bolder" style="text-transform:none;">Upload Bukti <br>Pembayaran IPL</span>
            </a>
          </div>
          <!-- /Logo 
          <h4 class="mb-2">Welcome to {{config('variables.templateName')}}! 👋</h4>-->
          @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            
        </div>
      @endif
      
          <form action="{{url('/uploads')}}" class="mb-3" method="post" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
              <label for="image" class="form-label">Masukan Bukti Transfer</label>
              <input type="file" class="form-control" id="image" name="image" placeholder="Masukan gambar" required>
            </div>
            <div class="mb-3">
              <label for="type" class="form-label"> Tipe Iuran</label>
              <select class="form-control" id="type" name="type" required>
                <option value="">Pilih Tipe Iuran</option>
                <option value="1">Keamanan dan Kebersihan</option>
                <option value="2">Keamanan</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="no" class="form-label">Masukan Nomor Rumah</label>
              <input type="text" class="form-control" id="no" name="no" placeholder="Masukan Nomor Rumah" required>
            </div>
            
            <div class="mb-3">
              
              <label for="note" class="form-label">Masukan Keterangan</label>
                <textarea name="note" id="note" class="form-control" placeholder="Masukan Keterangan" required></textarea>
                
            </div>
            
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Kirim</button>
            </div>
          </form>

          <!--<p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p>-->
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
