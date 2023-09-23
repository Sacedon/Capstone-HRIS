<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\User;

class EvaluationController extends Controller
{
    public function showForm()
{
    $users = User::all(); // Get a list of users to select from
    return view('evaluations.form', compact('users'));
}

public function submitEvaluation(Request $request)
{
    // Validate the form input
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id', // Ensure the selected user exists
        'criteria' => 'required',
        'comments' => 'nullable',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Create a new evaluation record
    $evaluation = new Evaluation([
        'evaluator_id' => auth()->user()->id,
        'user_id' => $validatedData['user_id'],
        'criteria' => $validatedData['criteria'],
        'comments' => $validatedData['comments'],
        'rating' => $validatedData['rating'],
    ]);

    $evaluation->save();

    return redirect()->route('evaluations.showForm')->with('success', 'Evaluation submitted successfully.');
}
}
