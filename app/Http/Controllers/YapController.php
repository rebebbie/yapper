<?php

namespace App\Http\Controllers;

use App\Models\Yap;
use Illuminate\Http\Request;

class YapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yaps = Yap::with('user')
            ->latest()
            ->take(50)
            ->get();
        return view('home', ['yaps'=>$yaps]);
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
        // validate request
        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:255',
                'min:5',
            ],
        ],[
            'message.required' => 'Yap is empty!',
            'message.min' => 'Yaps must be longer than 5 characters.',
            'message.max' => 'Yaps must be 255 characters or less.', 
        ]);

        // create the yap
        \App\Models\Yap::create([
            'message' => $validated['message'],
            'user_id' => null,
        ]);

        return redirect('/')->with('success', 'Yapped successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Yap $yap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Yap $yap)
    {
        //
        return view('yaps.edit', compact('yap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Yap $yap)
    {
        // authentication
        // if($request->user()->cannot('update',$yap)){
        //     abort(404);
        // }

        // validates updated text
        $validated = $request->validate([
            'message' => 'required|string|max:255|min:5'
        ]);

        // updates the yap
        $yap->update($validated);

        return redirect('/')->with('success', 'Yap has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yap $yap)
    {
        $yap->delete();

        return redirect('/')->with('success', 'Yap has been deleted!');
    }
}
