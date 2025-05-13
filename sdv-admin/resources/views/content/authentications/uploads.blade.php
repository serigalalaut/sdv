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
              <label for="type" class="form-label"> Pilih Iuran</label>
              <select class="form-control" id="type" name="type" required>
                <option value="">Pilih Iuran</option>
                <option value="1">Keamanan dan Kebersihan</option>
                <option value="2">Buka & Sahur</option>
                <option value="3">THR</option>
              </select>
            </div>
            @if($type == "")
            <div class="mb-3">
              <label for="type" class="form-label"> Pilih Pembayaran</label>
              <select class="form-control" id="type" name="payment_type" required>
                <option value="">Pilih Pembayaran</option>
                <option value="dana">Dana</option>
                <option value="gopay">Gopay</option>
                <option value="bca">BCA</option>
                <option value="bsi">BSI</option>
                <option value="cod">Bayar Cash</option>
              </select>
            </div>
            @else
            <div class="mb-3">
              <label for="type" class="form-label"> Pilih Pembayaran</label>
              <select class="form-control" id="type" name="payment_type" required>
                <option value="">Pilih Pembayaran</option>
                <option value="dana" {{ $type == 'dana' ? 'selected' : '' }}>Dana</option>
                <option value="gopay" {{ $type == 'gopay' ? 'selected' : '' }}>Gopay</option>
                <option value="bca" {{ $type == 'bca' ? 'selected' : '' }}>BCA</option>
                <option value="bsi" {{ $type == 'bsi' ? 'selected' : '' }}>BSI</option>
              </select>
            </div>
            @endif
            <div class="mb-3">
              <label for="no" class="form-label">Masukan Blok dan Nomor Rumah</label>
              <input type="text" class="form-control" id="no" name="no" placeholder="Contoh: B1-1" required>
            </div>
            
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit" style="background-color:#fecf39;border-color:#fecf39">Kirim</button>
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
