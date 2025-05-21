@extends('layouts/contentNavbarLayout')

@section('title', 'Laporan Keuangan Kas Warga')

@section('content')

<!-- Responsive Table -->
<div class="card">

  <div class="table-responsive text-nowrap card-header">
    <table class="table data-table">
      <thead>
        
      </thead>
      <tbody>
      <tr style="background-color: #f0f0f0; text-align: left; font-weight: bold;">
          <td colspan="2" >Saldo Awal</td>
          
          <td style="font-weight: bold;">Rp. {{ number_format($saldoAwal, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="5" style="background-color: #f0f0f0; text-align: left; font-weight: bold;">Pemasukan</td>
        </tr>
        @foreach ($kas_warga as $item)
        <tr>
          <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
          <td>{{ $item->title }}</td>
          <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
          
        </tr>
        <tr>
          <td colspan="2">Total</td>
          <td style="font-weight: bold;">Rp. {{ number_format($totalKas, 0, ',', '.') }}</td>
          
        </tr>
        @endforeach
        <!-- Pemisah antara pemasukan dan pengeluaran -->
        <tr>
          <td colspan="5" style="background-color: #f0f0f0; text-align: left; font-weight: bold;">Pengeluaran</td>
        </tr>
        @foreach ($pengeluaran as $item)
        <tr>
          <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
          <td>{{ $item->title }}</td>
          
          <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
          
        </tr>
        <tr>
          <td colspan="2">Total</td>
          <td style="font-weight: bold;">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot style="background-color: #f0f0f0; text-align: left; font-weight: bold;">
        <tr>
          <td colspan="2">Saldo Akhir</td>
          
          <td style="font-weight: bold;">Rp. {{ number_format($totalKas - $totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<!--/ Responsive Table -->

@endsection 