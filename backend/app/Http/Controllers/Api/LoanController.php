<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
class LoanController extends Controller
{
    public function index()
    {
        return response()->json(Loan::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|integer',
            'book_id' => 'required|integer',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        $loan = Loan::create($data);
        return response()->json($loan, 201);
    }

    public function show($id)
    {
        return response()->json(Loan::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update($request->all());
        return response()->json($loan);
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return response()->json(['message' => 'Loan deleted']);
    }
}