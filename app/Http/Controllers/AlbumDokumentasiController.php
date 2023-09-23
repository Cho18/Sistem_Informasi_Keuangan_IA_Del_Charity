<?php

namespace App\Http\Controllers;

use App\Exports\AlbumDokumentasiExport;
use App\Exports\GalleryExport;
use App\Http\Requests\GalleryRequest;
use App\Models\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AlbumDokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = gallery::orderBy('date', 'desc')
        ->paginate(9);

        return view('publik.album.index', compact([
            'gallery',
        ]));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $gallery = gallery::orderBy('date', 'desc')
            ->get();


        return view('album_dokumentasi.index', compact([
            'gallery',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album_dokumentasi.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $originalFileName;
            $filePath = $file->storeAs('gallery', $fileName);
            $validatedData['images'] = $filePath;
        }              

        gallery::create($validatedData);
        
        return redirect('/album_dokumentasi')
            ->with('success', 'Album dokumentasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(gallery $gallery, $id)
    {
        $gl = gallery::findOrfail($id);

        return view('album_dokumentasi.edit', compact([
            'gl',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('images')) {
            if ($request->oldImage) {
                Storage::delete('gallery/' . $request->oldImage);
            }
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $originalFileName;
            $filePath = $file->storeAs('gallery', $fileName);
            $validatedData['images'] = $filePath;
        }        

        $gl = gallery::findOrFail($id);

        $gl->update($validatedData);

        return redirect('/album_dokumentasi')
            ->with('update', 'Album dokumentasi berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(gallery $gallery, $id)
    {
        $gallery = gallery::findorfail($id);
        $gallery->delete();

        return redirect('/album_dokumentasi')
            ->with('delete', 'Album dokumentasi berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $gallery = gallery::select(
            'id', 
            'images', 
            'description',
            'date',
        )
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('description', 'like', '%' . $searchTerm . '%')
                ->orWhere('date', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('date', 'asc')
        ->get();

        return Excel::download(new AlbumDokumentasiExport($gallery), 'Daftar Album Dokumentasi.xlsx');
    }
}
