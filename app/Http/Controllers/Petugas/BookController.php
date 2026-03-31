<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')
            ->withCount('loans')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('petugas.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('petugas.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'isbn' => ['nullable', 'string', 'max:20'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'pages' => ['nullable', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($validated);

        return redirect()->route('petugas.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('petugas.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'isbn' => ['nullable', 'string', 'max:20'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'pages' => ['nullable', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('cover')) {
            // Hapus cover lama
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('petugas.books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->loans()->whereIn('status', ['approved', 'borrowed'])->count() > 0) {
            return back()->with('error', 'Buku tidak bisa dihapus karena masih ada peminjaman aktif.');
        }

        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('petugas.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
