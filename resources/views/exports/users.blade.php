@extends('exports.layout')
@section('title', 'Laporan User, Admin & Petugas')
@section('subtitle', 'Laporan Data User, Admin & Petugas')

@section('content')
    <h3 class="section-title">Data User, Admin & Petugas</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
                @php
                    $roleBadge = match($user->role) {
                        'admin' => 'badge-error',
                        'petugas' => 'badge-info',
                        default => 'badge-default',
                    };
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge {{ $roleBadge }}">{{ ucfirst($user->role) }}</span></td>
                    <td><span class="badge {{ $user->is_active ? 'badge-success' : 'badge-warning' }}">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
