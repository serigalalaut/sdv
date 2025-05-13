@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Data Pengeluaran')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan Keuangan/</span> Tambah Data Pengeluaran</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Data Pengeluaran</h5> <small class="text-muted float-end"></small>
      </div>
     
      <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
      @endif
        <form action="{{url('/laporan-pengeluaran/add')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Bukti Pengeluaran</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="bukti_pengeluaran" name="bukti_pengeluaran" placeholder="Bukti Pengeluaran"  required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pengeluaran</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" placeholder="Nama Pengeluaran" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Transaksi</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="transaction_date" name="transaction_date" placeholder="Tanggal Transaksi" required/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nominal</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal" required/>
            </div>
          </div>
         
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Keterangan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" />
            </div>
          </div>
          
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="/laporan-pengeluaran" type="submit" class="btn btn-default">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection