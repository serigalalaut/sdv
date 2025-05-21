@extends('layouts/contentNavbarLayout')

@section('title', 'Pengeluaran')

@section('content')


<!-- Responsive Table -->
<div class="card">

  <div class="table-responsive text-nowrap card-header" style="margin-top:-40px">
    <table class="table data-table">
      <thead>
        <tr class="text-nowrap">
          
          <th>Tanggal Transaksi</th>
          <th>Judul</th>
          <th>Nominal</th>
          <th>Periode</th>
          <th>Bukti Pengeluaran</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      
      </tbody>
    </table>
  </div>
</div>

<!--/ Responsive Table -->

@endsection
