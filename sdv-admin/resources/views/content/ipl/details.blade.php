@extends('layouts/contentNavbarLayout')

@section('title', 'IPL - Konfirmasi')

@section('content')
<style>
    .form-labels{
        font-size: 0.85rem;
        letter-spacing: inherit;
    }
</style>


<!-- Responsive Table -->
@if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            
        </div>@endif
<div class="card">
    <div class="mb-3 card-header">
        <h4 style="color:#000000">Informasi Data</h4>
        <div class="row gy-3">
            <div class="col-md">

                <div class="mb-3">
                    <label class="form-labels">Nomor Rumah</label>
                    <p style="color:#000000; margin-top:0px;">{{$data->home_no}}</p>
                    
                </div>
                
                <div class="mb-3">
                    <label class="form-labels">Bukti Pembayaran</label> <br>
                    <img src="{{ asset('storage/' . $data->media_file) }}" alt="Image" style="width: 400px;">
                </div>
                
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <label class="form-labels">Status</label>
                    <p>{{$data->status}}</p>
                </div>
            
                <div class="mb-3">
                    <label class="form-labels">Tanggal Pembayaran</label>
                    <p>{{date('l, j F Y', strtotime($data->created_at))}}</p>
                </div>
                <div class="mb-3">
                    <label class="form-labels">Tipe Iuran</label>
                    <p>{{$data->type == 1 ? "KEAMANAN DAN KEBERSIHAN" : "KEAMANAN"}}</p>
                </div>

                <div class="mb-3">
                    <label class="form-labels">Nominal</label>
                    <p>Rp. {{number_format($data->nominal, 0, ',', '.')}}</p>
                </div>
                <div class="mb-3">
                    <label class="form-labels">Wa Suami</label> <br>
                    <a href="https://wa.me/{{$data->no_suami}}?text=Pembayaran IPL telah dikonfirmasi. Untuk melihat status cek https://wargasdv.com/ipl. Abaikan pesan ini, pesan dikirim oleh sistem." class="btn btn-outline-primary">{{$data->no_suami}}</a>
                </div>
                <div class="mb-3">
                    <label class="form-labels">Wa Istri</label> <br>
                    <a href="https://wa.me/{{$data->no_istri}}?text=Pembayaran IPL telah dikonfirmasi. Untuk melihat status cek https://wargasdv.com/ipl. Abaikan pesan ini, pesan dikirim oleh sistem." class="btn btn-outline-primary">{{$data->no_istri}}</a>
                </div>
                <div class="mb-3">
                @if($data->status != "Lunas")    
                <a href="/ipl/lunas/{{$data->id}}" style="width:200px" type="button" class="btn btn-outline-primary">
                        Konfirmasi
                    </a>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>

<!--/ Responsive Table -->

<script>
    new DataTable('#example', {
        pagingType: 'full_numbers'
    });

</script>

@endsection
