<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author = Author::create($data);
        return response()->json($author, 201);
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author, 200);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($data);
        return response()->json($author, 200);
    }

    public function destroy($id)
    {
        Author::destroy($id);
        return response()->json(['message' => 'Author berhasil dihapus'], 200);
    }
}