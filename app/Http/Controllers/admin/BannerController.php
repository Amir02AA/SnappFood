<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequesat;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::paginate(5);
        return view('admin.banner.index',compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(StoreBannerRequesat $request)
    {
        Banner::create($request->validated());
        return redirect()->route('admin.banners.index');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index');
    }
}
