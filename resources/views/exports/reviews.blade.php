@extends('exports.layout')
@section('title', 'Laporan Ulasan')
@section('subtitle', 'Laporan Data Ulasan Buku')

@section('content')
    <h3 class="section-title">Data Ulasan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $i => $review)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->book->title ?? '-' }}</td>
                    <td><span class="stars">@for($s = 1; $s <= 5; $s++){{ $s <= $review->rating ? '★' : '☆' }}@endfor</span></td>
                    <td>{{ Str::limit($review->comment, 100) ?? '-' }}</td>
                    <td>{{ $review->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
