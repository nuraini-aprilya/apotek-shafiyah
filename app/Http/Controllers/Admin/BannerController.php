<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $banners = Banner::latest()->get();
            return DataTables::of($banners)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('storage/upload/banner/' . $row->image) . '" alt="Gambar 1" style="max-width:100px;">';
                })
                ->addColumn('action', 'admin.banner.include.action')
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.banner.index');
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
    public function store(StoreBannerRequest $request)
    {
        try {
            $attr = $request->validated();

            if ($request->file('image') && $request->file('image')->isValid()) {

                $filename = $request->file('image')->hashName();
                $request->file('image')->storeAs('upload/banner', $filename, 'public');

                $attr['image'] = $filename;
            }

            Banner::create($attr);

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        try {
            $path = storage_path('app/public/upload/banner/');

            if ($banner->image != null && file_exists($path . $banner->image)) {
                unlink($path . $banner->image);
            }
            $banner->delete();

            return redirect()
                ->back()
                ->with('success', __('Data Berhasil Dihapus'));
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', __($th->getMessage()));
        }
    }
}
