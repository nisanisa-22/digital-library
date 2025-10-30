<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    public function index()
    {
        return response()->json(Publisher::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $publisher = Publisher::create($data);
        return response()->json($publisher, 201);
    }

    public function show($id)
    {
        $publisher = Publisher::findOrFail($id);
        return response()->json($publisher, 200);
    }

    public function update(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $publisher->update($data);
        return response()->json($publisher, 200);
    }

    public function destroy($id)
    {
        Publisher::destroy($id);
        return response()->json(['message' => 'Publisher berhasil dihapus'], 200);
    }
}