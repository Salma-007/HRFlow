<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Department;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('department')->get();
        return view('posts.index', compact('posts'));
    }    

    public function create()
    {
        $departments = Department::all(); 
        return view('posts.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        Post::create([
            'name' => $request->name,
            'departments_id' => $request->department_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::with('department')->find($id);
        return view('posts.show', compact('post'));
    }
    

    public function edit(Post $post)
    {
        $departments = Department::all(); // Récupère tous les départements
        return view('posts.edit', compact('post', 'departments'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $post->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
