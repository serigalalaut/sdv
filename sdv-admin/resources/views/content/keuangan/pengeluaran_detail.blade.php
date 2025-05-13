@extends('layouts/contentNavbarLayout')

@section('title', 'Laporan Pengeluaran - Detail')

@section('content')
<style>
    .form-labels{
        font-size: 0.85rem;
        letter-spacing: inherit;
    }
</style>


<!-- Responsive Table -->

<div class="card">
    <div class="mb-3 card-header">
        <h4 style="color:#000000">Informasi Data</h4>
        <div class="row gy-3">
            <div class="col-md">

                <div class="mb-3">
                    <label class="form-labels">Nama Pengeluaran</label>
                    <p style="color:#000000; margin-top:0px;">{{$data->title}}</p>
                    
                </div>
                
                <div class="mb-3">
                    <label class="form-labels">Bukti Pengeluaran</label> <br>
                    <img src="{{ asset('storage/' . $data->media_file) }}" alt="Image" style="width: 400px; height: 300px;">
                </div>
                
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <label class="form-labels">Tanggal Transaksi</label>
                    <p>{{date('l, j F Y', strtotime($data->transaction_date))}}</p>
                </div>
            
                <div class="mb-3">
                    <label class="form-labels">Periode Pengeluaran</label>
                    <p>{{date('F Y', strtotime($data->period))}}</p>
                </div>
                <div class="mb-3">
                    <label class="form-labels">Keterangan</label>
                    <p>{{$data->note}}</p>
                </div>

                <div class="mb-3">
                    <label class="form-labels">Nominal</label>
                    <p>Rp. {{number_format($data->nominal, 0, ',', '.')}}</p>
                </div>
                <div class="mb-3">
                    <label class="form-labels"></label>
                    <p style="color:#000000; margin-top:0px;"></p>
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
