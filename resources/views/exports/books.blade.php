@extends('exports.layout')
@section('title', 'Laporan Buku & Kategori')
@section('subtitle', 'Laporan Data Buku & Kategori')

@section('content')
    <h3 class="section-title">Data Kategori</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $i => $cat)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ Str::limit($cat->description, 80) }}</td>
                    <td>{{ $cat->books_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Data Buku</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Peminjaman</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $i => $book)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category->name ?? '-' }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ $book->loans_count }}</td>
                    <td>{{ $book->reviews_avg_rating ? number_format($book->reviews_avg_rating, 1) . ' ★' : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
