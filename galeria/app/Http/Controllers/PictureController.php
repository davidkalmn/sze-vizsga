<?php
namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Picture::where('user_id', Auth::id());

        // Filter by title
        if ($request->has('title') && !empty($request->title)) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Sort by date or title
        if ($request->has('sort_by')) {
            $sort_by = $request->sort_by;
            $sort_order = $request->sort_order ?? 'asc';
            $query->orderBy($sort_by, $sort_order);
        }

        $pictures = $query->get();

        return view('pictures.index', compact('pictures'));
    }

    public function create()
    {
        return view('pictures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'img' => 'nullable|image|max:2048', // Validate image file
        ]);

        $path = $request->file('img') ? $request->file('img')->store('pictures', 'public') : null;

        Picture::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => now(),
            'user_id' => Auth::id(),
            'img' => $path,
        ]);

        return redirect()->route('pictures.index');
    }

    public function edit(Picture $picture)
    {
        $this->authorize('update', $picture);
        return view('pictures.edit', compact('picture'));
    }

    public function update(Request $request, Picture $picture)
    {
        $this->authorize('update', $picture);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'img' => 'nullable|image|max:2048', // Validate image file
        ]);

        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($picture->img) {
                Storage::disk('public')->delete($picture->img);
            }
            $path = $request->file('img')->store('pictures', 'public');
        } else {
            $path = $picture->img;
        }

        $picture->update([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $path,
        ]);

        return redirect()->route('pictures.index');
    }

    public function destroy(Picture $picture)
    {
        $this->authorize('delete', $picture);

        if ($picture->img) {
            Storage::disk('public')->delete($picture->img);
        }

        $picture->delete();
        return redirect()->route('pictures.index');
    }
}
