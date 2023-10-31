<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OffCodes;
use Illuminate\Http\Request;

class OffCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.off.index', [
            'offs' => OffCodes::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.off.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'percent' => ['bail', 'required', 'numeric', 'min:10', 'max:80']
        ]);
        $validated['code'] = uniqid();
        OffCodes::create($validated);

        return redirect()->route('admin.off.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(OffCodes $offCode)
    {
        return view('admin.off.show', compact('offCode'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffCodes $offCode)
    {
        $offCode->delete();
        return redirect()->route('admin.off.index');
    }
}
