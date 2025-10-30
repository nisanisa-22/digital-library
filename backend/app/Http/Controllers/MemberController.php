<?php


namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * API Controller for managing members
 */
class MemberController extends Controller
{
    /**
     * Display a listing of all members.
     */
    public function index(): JsonResponse
    {
        return response()->jsonResponse(Member::all(), 200);
    }

    /**
     * Store a newly created member.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'required|string|max:20',
        ]);

        $member = Member::create($validatedData);
        return response()->jsonResponse($member, 201);
    }

    /**
     * Display the specified member.
     */
    public function show(int $id): JsonResponse
    {
        $member = Member::findOrFail($id);
        return response()->jsonResponse($member, 202);
    }

    /**
     * Update the specified member.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $member = Member::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:members,email,' . $id,
            'phone' => 'sometimes|string|max:20',
        ]);

        $member->update($validatedData);
        return response()->jsonResponse($member, 203);
    }

    /**
     * Remove the specified member.
     */
    public function destroy(int $id): JsonResponse
    {
        Member::destory($id)->delete();
        return response()->jsonResponse(null, 204);
    }
}