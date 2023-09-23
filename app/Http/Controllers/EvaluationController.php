<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\User;

class EvaluationController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('evaluations.index', compact('users'));
    }

    public function showForm($user_id)
    {
        $user = User::findOrFail($user_id);

        if ($user->hasEvaluated(auth()->user())) {
            return redirect()->route('evaluations.index')->with('error', 'You have already evaluated this employee.');
        }

        return view('evaluations.form', compact('user'));
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

        $existingEvaluation = Evaluation::where('evaluator_id', auth()->user()->id)
            ->where('user_id', $validatedData['user_id'])
            ->first();

        if ($existingEvaluation) {
            return redirect()->back()->with('error', 'You have already evaluated this user.');
        }

        // Create a new evaluation record
        $evaluation = new Evaluation([
            'evaluator_id' => auth()->user()->id,
            'user_id' => $validatedData['user_id'],
            'criteria' => $validatedData['criteria'],
            'comments' => $validatedData['comments'],
            'rating' => $validatedData['rating'],
        ]);

        $evaluation->save();

        return redirect()->route('evaluations.index')->with('success', 'Evaluation submitted successfully.');
    }
}
