@extends('exports.layout')
@section('title', 'Laporan Peminjaman & Pengembalian')
@section('subtitle', 'Laporan Data Peminjaman & Pengembalian')

@section('content')
    <h3 class="section-title">Data Peminjaman & Pengembalian</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Disetujui</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $i => $loan)
                @php
                    $badgeClass = match($loan->status) {
                        'pending' => 'badge-warning',
                        'approved' => 'badge-info',
                        'rejected' => 'badge-error',
                        'borrowed' => 'badge-primary',
                        'return_pending' => 'badge-warning',
                        'returned' => 'badge-success',
                        default => 'badge-default',
                    };
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->book->title ?? '-' }}</td>
                    <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                    <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                    <td>{{ $loan->return_date ? $loan->return_date->format('d/m/Y') : '-' }}</td>
                    <td><span class="badge {{ $badgeClass }}">{{ $loan->status_label }}</span></td>
                    <td>{{ $loan->approver->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
