<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->get();
        return view('petugas.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('petugas.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:10'],
        ]);

        Category::create($validated);

        return redirect()->route('petugas.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('petugas.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $id],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:10'],
        ]);

        $category->update($validated);

        return redirect()->route('petugas.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->books()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki buku.');
        }

        $category->delete();

        return redirect()->route('petugas.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
