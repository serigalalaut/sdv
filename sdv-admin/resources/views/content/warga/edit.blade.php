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

                <form action="{{ route('warga-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                <div class="mb-3">
                    <label class="form-labels">Nomor Rumah</label>
                    <input type="text" class="form-control" name="no_rumah" value="{{$data->no_rumah}}">
                    
                </div>
                
                <div class="mb-3">
                    <label class="form-labels">Nama Suami</label> 
                    <input type="text" class="form-control" name="nama_suami" value="{{$data->nama_suami}}">
                </div>

                <div class="mb-3">
                    <label class="form-labels">Nama Istri</label> 
                    <input type="text" class="form-control" name="nama_istri" value="{{$data->nama_istri}}">
                </div>

                <div class="mb-3">
                    <label class="form-labels">No. HP Suami</label> 
                    <input type="text" class="form-control" name="no_suami" value="{{$data->no_suami}}">
                </div>

                <div class="mb-3">  
                    <label class="form-labels">No. HP Istri</label> 
                    <input type="text" class="form-control" name="no_istri" value="{{$data->no_istri}}">
                </div>
                
                <div class="mb-3">
                    <label class="form-labels">Status</label>
                    <select class="form-control" name="status">
                        <option value="">Pilih Status</option>
                        <option value="milik sendiri" {{ $data->status == 'milik sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                        <option value="kontrak" {{ $data->status == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                        <option value="kosong" {{ $data->status == 'kosong' ? 'selected' : '' }}>Kosong</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-labels">No KTP</label>
                    <input type="text" class="form-control" name="no_ktp" value="{{$data->no_ktp}}">
                </div>

                <div class="mb-3">
                    <label class="form-labels">No KK</label>
                    <input type="text" class="form-control" name="no_kk" value="{{$data->no_kk}}">
                </div>

                <div class="mb-3">
                    <label class="form-labels">Alamat KTP</label>
                    <textarea class="form-control" name="alamat_ktp" id="alamat_ktp" rows="3">{{$data->alamat_ktp}}</textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
                </form>
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
