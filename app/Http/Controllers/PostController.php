<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'author' => 'required|min:3|max:100',
            'content' => 'required|min:10',

            'image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        for ($i = 1; $i <= 4; $i++) {

            if ($request->hasFile("image_$i")) {

                $validated["image_$i"] =
                    $request->file("image_$i")->store('posts', 'public');
            }
        }

        Post::create($validated);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil ditambahkan.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'author' => 'required|min:3|max:100',
            'content' => 'required|min:10',

            'image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        for ($i = 1; $i <= 4; $i++) {

            if ($request->hasFile("image_$i")) {

                if ($post->{"image_$i"}) {
                    Storage::disk('public')
                        ->delete($post->{"image_$i"});
                }

                $validated["image_$i"] =
                    $request->file("image_$i")->store('posts', 'public');
            }
        }

        $post->update($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        for ($i = 1; $i <= 4; $i++) {

            if ($post->{"image_$i"}) {

                Storage::disk('public')
                    ->delete($post->{"image_$i"});
            }
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}