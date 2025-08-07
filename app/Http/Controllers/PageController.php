<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('dashboard.pages.index', compact('pages'));
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
    public function store(StorePageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($page)
    {
        // dd($page);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($page)
    {
        $pages = Page::where('slug', $page)->first();
        $about = [];

        if (in_array($pages->slug, ['about', 'about'])) {
            $about = $pages->content['about'] ?? [];

            // Reindex agar mulai dari 0
            $about = array_values($about);
        }
        if (!$pages) {
            abort(404);
        }
        if ($pages->slug == 'home-jumbotron') {
            return view('dashboard.pages.home.jumbotron', compact('pages'));
        } elseif ($pages->slug == 'home-program') {
            return view('dashboard.pages.home.program', compact('pages'));
        } elseif ($pages->slug == 'home-testimoni') {
            return view('dashboard.pages.home.testimoni', compact('pages'));
        } elseif ($pages->slug == 'home-galeri') {
            return view('dashboard.pages.home.galeri', compact('pages'));
        } elseif ($pages->slug == 'about') {
            return view('dashboard.pages.about.about', compact('pages', 'about'));
        } elseif ($pages->slug == 'alumni-jumbotron') {
            return view('dashboard.pages.alumni.jumbotron', compact('pages'));
        } elseif ($pages->slug == 'alumni-sambutan') {
            return view('dashboard.pages.alumni.sambutan', compact('pages'));
        } elseif ($pages->slug == 'alumni-data') {
            return view('dashboard.pages.alumni.alumni', compact('pages'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $page)
    {
        // dd($request->all());
        // 1) Ambil model berdasarkan slug
        $pageModel = Page::where('slug', $page)->firstOrFail();

        if ($pageModel->slug == 'home-jumbotron') {

            $rules = [
                'content.tagline'    => 'required|string|max:255',
                'content.subtagline' => 'required|string|max:255',
            ];

            // 3) Tentukan section yang memiliki file upload
            $sectionsWithFiles = ['home', 'jumbotron'];
            if (in_array($pageModel->section, $sectionsWithFiles)) {
                $rules['content.logo']       = 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048';
                $rules['content.background'] = 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048';
            }

            // 4) Validasi
            $validated = $request->validate($rules);

            // 5) Ambil array file nested
            $files = $request->file('content') ?: [];

            // 6) Hapus dan unggah logo baru (jika ada)
            if (!empty($files['logo'])) {
                // hapus file lama
                if (!empty($pageModel->content['logo'])) {
                    Storage::disk('public')->delete($pageModel->content['logo']);
                }
                // simpan file baru
                $validated['content']['logo'] = $files['logo']
                    ->store('uploads/logos', 'public');
            }

            // 7) Hapus dan unggah background baru (jika ada)
            if (!empty($files['background'])) {
                // hapus file lama
                if (!empty($pageModel->content['background'])) {
                    Storage::disk('public')->delete($pageModel->content['background']);
                }
                // simpan file baru
                $validated['content']['background'] = $files['background']
                    ->store('uploads/backgrounds', 'public');
            }

            // 8) Merge content lama & baru, lalu simpan
            $old = is_array($pageModel->content)
                ? $pageModel->content
                : (json_decode($pageModel->content, true) ?: []);
            $pageModel->content = array_merge($old, $validated['content']);
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Page berhasil diperbarui!');
        } elseif ($pageModel->slug == 'home-program') {

            // dd($request->all());
            $rules = [
                'content'                => 'required|array',
                'content.*.id'               => 'required|string',
                'content.*.title'         => 'required|string|max:255',
                'content.*.description'   => 'required|string',
                'content.*.link'          => 'nullable|url',
                'content.*.icon'          => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
                'content.*.long_description' => 'nullable|string',
            ];

            $validated = $request->validate($rules);

            // Ambil data program lama
            $oldPrograms = $pageModel->content ?? [];

            // dd($oldPrograms);

            $updatedPrograms = [];

            foreach ($validated['content'] as $index => $programData) {
                $program = $programData;

                // Cek kalau ada upload icon baru
                if ($request->hasFile("content.$index.icon")) {
                    $file = $request->file("content.$index.icon");

                    // Kalau ada icon lama, hapus file lama
                    if (!empty($oldPrograms[$index]['icon'])) {
                        Storage::disk('public')->delete($oldPrograms[$index]['icon']);
                    }

                    // Upload icon baru
                    $program['icon'] = $file->store('uploads/program-icons', 'public');
                } else {
                    // Tidak upload baru, pakai icon lama (kalau ada)
                    if (!empty($oldPrograms[$index]['icon'])) {
                        $program['icon'] = $oldPrograms[$index]['icon'];
                    }
                }

                $updatedPrograms[$index] = $program;
            }

            // Update semua program yang baru
            $pageModel->content = $updatedPrograms;
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Program berhasil diperbarui!');
        } elseif ($pageModel->slug == 'home-testimoni') {

            // dd($request->all());
            $rules = [
                'content'                => 'required|array',
                'content.*.name'         => 'required|string|max:255',
                'content.*.as'         => 'required|string|max:255',
                'content.*.description'   => 'required|string',
                'content.*.icon'          => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            ];

            $validated = $request->validate($rules);

            // Ambil data program lama
            $oldTestimonis = $pageModel->content ?? [];

            // dd($oldTestimonis);

            $updatedTestimonis = [];

            foreach ($validated['content'] as $index => $TestimoniData) {
                $Testimoni = $TestimoniData;

                // Cek kalau ada upload icon baru
                if ($request->hasFile("content.$index.icon")) {
                    $file = $request->file("content.$index.icon");

                    // Kalau ada icon lama, hapus file lama
                    if (!empty($oldTestimonis[$index]['icon'])) {
                        Storage::disk('public')->delete($oldTestimonis[$index]['icon']);
                    }

                    // Upload icon baru
                    $Testimoni['icon'] = $file->store('uploads/Testimoni-image', 'public');
                } else {
                    // Tidak upload baru, pakai icon lama (kalau ada)
                    if (!empty($oldTestimonis[$index]['icon'])) {
                        $Testimoni['icon'] = $oldTestimonis[$index]['icon'];
                    }
                }

                $updatedTestimonis[$index] = $Testimoni;
            }

            // Update semua Testimoni yang baru
            $pageModel->content = $updatedTestimonis;
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Testimoni berhasil diperbarui!');
        } elseif ($pageModel->slug == 'home-galeri') {
            $rules = [
                'content' => 'required|array',
                'content.*.type' => 'required|in:image,youtube',
                'content.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
                'content.*.youtube' => 'nullable|url',
                // Validasi kondisional akan dilakukan manual di bawah
            ];

            $validated = $request->validate($rules);

            $oldItems = $pageModel->content ?? [];
            $updatedItems = [];

            foreach ($validated['content'] as $index => $item) {
                $type = $item['type'];

                // Validasi manual sesuai type
                if ($type === 'image') {
                    if ($request->hasFile("content.$index.icon")) {
                        $request->validate([
                            "content.$index.icon" => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
                        ]);
                    } elseif (empty($oldItems[$index]['icon'])) {
                        // Kalau tidak upload dan tidak ada lama, maka error
                        return back()->withErrors([
                            "content.$index.icon" => 'Gambar wajib diunggah jika belum ada sebelumnya.',
                        ])->withInput();
                    }

                    // Handle upload image
                    if ($request->hasFile("content.$index.icon")) {
                        $file = $request->file("content.$index.icon");

                        // Hapus file lama jika ada
                        if (!empty($oldItems[$index]['icon'])) {
                            Storage::disk('public')->delete($oldItems[$index]['icon']);
                        }

                        $item['icon'] = $file->store('uploads/galeri-images', 'public');
                    } else {
                        // Pakai gambar lama jika tidak upload baru
                        $item['icon'] = $oldItems[$index]['icon'] ?? null;
                    }

                    // Pastikan field YouTube kosong agar tidak nyampur
                    unset($item['youtube']);
                } elseif ($type === 'youtube') {
                    // Validasi link YouTube    
                    $request->validate([
                        "content.$index.youtube" => 'required|url',
                    ]);

                    // Simpan link YouTube
                    $item['youtube'] = $item['youtube'] ?? null;

                    // Hapus icon jika sebelumnya ada
                    if (!empty($oldItems[$index]['icon'])) {
                        Storage::disk('public')->delete($oldItems[$index]['icon']);
                    }

                    // Pastikan field icon kosong agar tidak nyampur
                    unset($item['icon']);
                }

                $updatedItems[$index] = $item;
            }

            $pageModel->content = $updatedItems;
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Galeri berhasil diperbarui!');
        } elseif ($pageModel->slug == 'about') {

            $rules = [
                'content.name'       => 'required|string|max:255',
                'content.tagline'    => 'required|string|max:255',
                'content.subtagline' => 'required|string|max:255',
                'content.about'      => 'required|array|min:1',
                'content.about.*.title'      => 'nullable|string|max:255',
                'content.about.*.description' => 'nullable|string',
            ];

            // 3) Tentukan section yang memiliki file upload
            $sectionsWithFiles = ['about'];
            if (in_array($pageModel->section, $sectionsWithFiles)) {
                $rules['content.logo']       = 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048';
                $rules['content.background'] = 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048';
            }

            // 4) Validasi
            $validated = $request->validate($rules);

            // 5) Ambil array file nested
            $files = $request->file('content') ?: [];

            // 6) Hapus dan unggah logo baru (jika ada)
            if (!empty($files['logo'])) {
                // hapus file lama
                if (!empty($pageModel->content['logo'])) {
                    Storage::disk('public')->delete($pageModel->content['logo']);
                }
                // simpan file baru
                $validated['content']['logo'] = $files['logo']
                    ->store('uploads/about', 'public');
            }

            // 7) Hapus dan unggah background baru (jika ada)
            if (!empty($files['background'])) {
                // hapus file lama
                if (!empty($pageModel->content['background'])) {
                    Storage::disk('public')->delete($pageModel->content['background']);
                }
                // simpan file baru
                $validated['content']['background'] = $files['background']
                    ->store('uploads/backgrounds', 'public');
            }

            // 8) Merge content lama & baru, lalu simpan
            $old = is_array($pageModel->content)
                ? $pageModel->content
                : (json_decode($pageModel->content, true) ?: []);
            $pageModel->content = array_merge($old, $validated['content']);
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Page berhasil diperbarui!');
        } elseif ($pageModel->slug == 'alumni-jumbotron') {
            $rules = [
                'content' => 'required|array',
                'content.*.title' => 'required|string|max:255',
                'content.*.description' => 'required|string',
                'content.*.type' => 'required|in:image,youtube',
                'content.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
                'content.*.youtube' => 'nullable|url',
                // Validasi kondisional akan dilakukan manual di bawah
            ];

            $validated = $request->validate($rules);

            $oldItems = $pageModel->content ?? [];
            $updatedItems = [];

            foreach ($validated['content'] as $index => $item) {
                $type = $item['type'];

                // Validasi manual sesuai type
                if ($type === 'image') {
                    if ($request->hasFile("content.$index.icon")) {
                        $request->validate([
                            "content.$index.icon" => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
                        ]);
                    } elseif (empty($oldItems[$index]['icon'])) {
                        // Kalau tidak upload dan tidak ada lama, maka error
                        return back()->withErrors([
                            "content.$index.icon" => 'Gambar wajib diunggah jika belum ada sebelumnya.',
                        ])->withInput();
                    }

                    // Handle upload image
                    if ($request->hasFile("content.$index.icon")) {
                        $file = $request->file("content.$index.icon");

                        // Hapus file lama jika ada
                        if (!empty($oldItems[$index]['icon'])) {
                            Storage::disk('public')->delete($oldItems[$index]['icon']);
                        }

                        $item['icon'] = $file->store('uploads/alumni-jumbotron', 'public');
                    } else {
                        // Pakai gambar lama jika tidak upload baru
                        $item['icon'] = $oldItems[$index]['icon'] ?? null;
                    }

                    // Pastikan field YouTube kosong agar tidak nyampur
                    unset($item['youtube']);
                } elseif ($type === 'youtube') {
                    // Validasi link YouTube    
                    $request->validate([
                        "content.$index.youtube" => 'required|url',
                    ]);

                    // Simpan link YouTube
                    $item['youtube'] = $item['youtube'] ?? null;

                    // Hapus icon jika sebelumnya ada
                    if (!empty($oldItems[$index]['icon'])) {
                        Storage::disk('public')->delete($oldItems[$index]['icon']);
                    }

                    // Pastikan field icon kosong agar tidak nyampur
                    unset($item['icon']);
                }

                $updatedItems[$index] = $item;
            }

            $pageModel->content = $updatedItems;
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Jumbotron Alumni berhasil diperbarui!');
        } elseif ($pageModel->slug == 'alumni-sambutan') {

            // dd($request->all());
            $rules = [
                'content'                => 'required|array',
                'content.*.name'         => 'required|string|max:255',
                'content.*.as'         => 'required|string|max:255',
                'content.*.angkatan'     => 'required|string|max:255',
                'content.*.description'   => 'required|string',
                'content.*.icon'          => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            ];

            $validated = $request->validate($rules);

            // Ambil data program lama
            $oldTestimonis = $pageModel->content ?? [];

            // dd($oldTestimonis);

            $updatedTestimonis = [];

            foreach ($validated['content'] as $index => $TestimoniData) {
                $Testimoni = $TestimoniData;

                // Cek kalau ada upload icon baru
                if ($request->hasFile("content.$index.icon")) {
                    $file = $request->file("content.$index.icon");

                    // Kalau ada icon lama, hapus file lama
                    if (!empty($oldTestimonis[$index]['icon'])) {
                        Storage::disk('public')->delete($oldTestimonis[$index]['icon']);
                    }

                    // Upload icon baru
                    $Testimoni['icon'] = $file->store('uploads/sambutan-alumni', 'public');
                } else {
                    // Tidak upload baru, pakai icon lama (kalau ada)
                    if (!empty($oldTestimonis[$index]['icon'])) {
                        $Testimoni['icon'] = $oldTestimonis[$index]['icon'];
                    }
                }

                $updatedTestimonis[$index] = $Testimoni;
            }

            // Update semua Testimoni yang baru
            $pageModel->content = $updatedTestimonis;
            $pageModel->save();

            return redirect()
                ->route('pages.edit', ['page' => $pageModel->slug])
                ->with('success', 'Sambutan alumni berhasil diperbarui!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
