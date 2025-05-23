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
                <!--<option value="dana">Dana</option>
                <option value="gopay">Gopay</option>-->
                <option value="jago">Bank Jago</option>
                <option value="cod">Bayar Cash</option>
              </select>
            </div>
            @else
            <div class="mb-3">
              <label for="type" class="form-label"> Pilih Pembayaran</label>
              <select class="form-control" id="type" name="payment_type" required>
                <option value="">Pilih Pembayaran</option>
                <option value="jago" {{ $type == 'jago' ? 'selected' : '' }}>Bank Jago</option>
                <option value="cod" {{ $type == 'cod' ? 'selected' : '' }}>Bayar Cash</option>
              </select>
            </div>
            @endif
            <div class="mb-3">
              <label for="no" class="form-label">Masukan Blok dan Nomor Rumah</label>
              <input type="text" class="form-control typeahead" id="no" name="no" placeholder="Contoh: B1-1" required>
            </div>

            <div class="mb-3">
              <label for="no" class="form-label">Pembayaran Rapel ? </label>
              <br>
              <input type="radio" class="form-check-input" id="is_rapel" name="is_rapel" value="1" onclick="SelectHandler(this)" required>
              <label for="is_rapel" class="form-check-label">Ya</label>
              <br>
              <input type="radio" class="form-check-input" id="is_rapel" name="is_rapel" value="0" checked onclick="SelectHandler(this)" required>
              <label for="is_rapel" class="form-check-label">Tidak</label>
            </div>
            <div id="rapel_periode" class="mb-3" style="display:none;">
              <label for="no" class="form-label">Pilih Periode Rapel</label>
              <select class="form-control" name="rapel_periode">
                <option value="2">2 Bulan</option>
                <option value="3">3 Bulan</option>
                <option value="4">4 Bulan</option>
                <option value="5">5 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="7">7 Bulan</option>
                <option value="8">8 Bulan</option>
                <option value="9">9 Bulan</option>
                <option value="10">10 Bulan</option>
                <option value="11">11 Bulan</option>
                <option value="12">12 Bulan</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="no" class="form-label">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit" style="background-color:#fecf39;border-color:#fecf39">Kirim</button>
              
              <a href="{{url('https://wargasdv.com/ipl')}}" class="btn btn-info d-grid w-100" style="margin-top:10px;">Kembali</a>
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
<link rel="stylesheet" href="{{ asset('assets/css/typeahead.css') }}" />
<script src="{{ asset('assets/js/typeahead.js') }}"></script> 

<script>
  var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substrRegex;
        matches = [];
        substrRegex = new RegExp(q, "i");
        $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
            matches.push(str);
        }
        });

        cb(matches);
    };
    };

    var states = {!! json_encode($komplek) !!};
    $(".typeahead").typeahead({
        highlight: true,
        minLength: 1
    },
    {
        name: "states",
        source: substringMatcher(states)
    });

    function SelectHandler(select){
        if(select.value == '1'){
            $("#rapel_periode").show();
            
        }else{
            $("#rapel_periode").hide();
        }
    }

</script>
@endsection
