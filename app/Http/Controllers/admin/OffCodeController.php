<?php

namespace App\Http\Controllers\admin;

use App\Classes\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Models\OffCode;
use Illuminate\Http\Request;

class OffCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        return view('admin.off.index', [
            'offs' => OffCode::paginate($paginate)
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
        $validated['code'] = uniqid('', true);
        OffCode::create($validated);

        return redirect()->route('admin.off.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(OffCode $off)
    {
        return view('admin.off.show', compact('off'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffCode $off)
    {
        $off->delete();
        return redirect()->route('admin.off.index');
    }
}
