<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class alchyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $alchy = [
            ['author' => 'Alchy One',
             'message' => "inventory makes it easy to manage your stock levels, track product details, and streamline your operations.",
             'time' => '5 minutes ago'
            ],
            ['author' => 'Alchy Two',
             'message' => "With our user-friendly interface, you can effortlessly add, update, and monitor your inventory in real-time.",
             'time' => '10 minutes ago'
            ],
            ['author' => 'Alchy Three',
             'message' => "Stay organized and make informed decisions with our comprehensive reporting and analytics features.",
             'time' => '15 minutes ago'
            ]
        ];
            return view('home', ['alchy' => $alchy]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
