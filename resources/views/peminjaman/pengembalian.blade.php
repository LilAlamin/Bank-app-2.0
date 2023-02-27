@extends('layout.main')

@section('container')
<table class="table table-hovered table-bordered ">
    <tr class="table table-dark">
        <th>Nama Nasabah</th>
        <th>Jumlah Pinjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Denda / Bunga</th>
        <th>Total Yang Harus Dikembalikan</th>
    </tr>
@if (count($data)==0)
    <tr>
        <td colspan="6">
            Data Tidak Ditemukan
        </td>
    </tr>
@endif

    @foreach ($data as $dat)
        <tr>
            <td>{{ $dat->nama_nasabah }}</td>
            <td>{{ $dat->jumlah_pinjam }}</td>
            <td>{{ $dat->tanggal_pinjam }}</td>
            <td>{{ $dat->tanggal_kembali }}</td>
            <td>Rp {{ $dat->denda }}</td>
            <td>Rp {{ $dat->total }}</td>
        </tr>
    @endforeach
</table>
<h6>*Denda Per Hari Rp.15000</h6>
@endsection

<style>
    tr:nth-child(even) {
  background-color: #f0ec25e8;
}
</style>