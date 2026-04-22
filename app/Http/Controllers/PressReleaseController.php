<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\PressRelease;
use Illuminate\Support\Facades\Storage;

class PressReleaseController extends Controller
{
    // Publik: Daftar Press Release
    public function index()
    {
        $pressReleases = PressRelease::orderBy('published_date', 'desc')->get();
        return view('artikel.artikel', compact('pressReleases'));
    }

    // Publik: Detail Press Release
    public function show($slug)
    {
        $pressRelease = PressRelease::where('slug', $slug)->firstOrFail();
        return view('artikel.show-artikel', compact('pressRelease'));
    }

    // Admin: List
    public function adminIndex()
    {
        $pressReleases = PressRelease::orderBy('published_date', 'desc')->get();
        return view('admin.artikel.index', compact('pressReleases'));
    }

    // Admin: Create Form
    public function create()
    {
        return view('admin.artikel.create');
    }

    // Admin: Store Data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published_date' => 'required|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('press_releases', 'public');
            $validated['cover_image'] = $path;
        }

        PressRelease::create($validated);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Admin: Edit Form
    public function edit($id)
    {
        $pressRelease = PressRelease::findOrFail($id);
        return view('admin.artikel.edit', compact('pressRelease'));
    }

    // Admin: Update Data
    public function update(Request $request, $id)
    {
        $pressRelease = PressRelease::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published_date' => 'required|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($pressRelease->cover_image) {
                Storage::disk('public')->delete($pressRelease->cover_image);
            }
            $path = $request->file('cover_image')->store('press_releases', 'public');
            $validated['cover_image'] = $path;
        }

        $pressRelease->update($validated);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Admin: Delete Data
    public function destroy($id)
    {
        $pressRelease = PressRelease::findOrFail($id);
        
        if ($pressRelease->cover_image) {
            Storage::disk('public')->delete($pressRelease->cover_image);
        }
        
        $pressRelease->delete();

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dihapus!');
    }
}
