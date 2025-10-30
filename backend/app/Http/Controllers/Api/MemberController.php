<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(Member::all(), 200);
    }

    public function store(Request $request)
    
{
    return response()->json([
        'getContent' => $request->getContent(),   // apa isi raw body
        'all'        => $request->all(),          // apa yang diparse oleh Laravel
    ], 200);
}


    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member, 200);
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:members,email' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        $member->update($data);
        return response()->json($member, 200);
    }

    public function destroy($id)
    {
        Member::destroy($id);
        return response()->json(['message' => 'Member berhasil dihapus'], 200);
    }
}