<?php

namespace App\Http\Controllers;

use App\Models\alchy;
use Illuminate\Http\Request;

class alchyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // sample data to pass to the view

        // $alchy = [
        //     ['author' => 'Alchy One',
        //      'message' => "inventory makes it easy to manage your stock levels, track product details, and streamline your operations.",
        //      'time' => '5 minutes ago'
        //     ],
        //     ['author' => 'Alchy Two',
        //      'message' => "With our user-friendly interface, you can effortlessly add, update, and monitor your inventory in real-time.",
        //      'time' => '10 minutes ago'
        //     ],
        //     ['author' => 'Alchy Three',
        //      'message' => "Stay organized and make informed decisions with our comprehensive reporting and analytics features.",
        //      'time' => '15 minutes ago'
        //     ]
        // ];
        
        $alchies = alchy::with('user')
                    ->latest()
                    ->take(20)
                    ->get();
    return view('home', ['alchies' => $alchies]);
}

public function latest(Request $request)
{
    $alchies = alchy::with('user')->latest()->take(20)->get();

    return response()->json($alchies);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(alchy $alchy)
    {
        $this->authorize('update', $alchy);

        return view('alchy.edit', compact('alchy'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        auth()->user()->alchies()->create($validated);

        return redirect('/')->with('success', 'Your alchy has been posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, alchy $alchy)
    {
        $this->authorize('update', $alchy);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $alchy->update($validated);

        return redirect('/')->with('success', 'Alchy updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(alchy $alchy)
    {
        $this->authorize('delete', $alchy);

        $alchy->delete();

        return redirect('/')->with('success', 'Alchy deleted!');
    }
}
