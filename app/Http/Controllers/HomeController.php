<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jumbotron = Page::where('slug', 'home-jumbotron')->first();
        $program = Page::where('slug', 'home-program')->first();
        $testimoni = Page::where('slug', 'home-testimoni')->first();
        $galeri = Page::where('slug', 'home-galeri')->first();
        return view('webpages.home', compact('jumbotron', 'program', 'testimoni', 'galeri'));
    }

    public function about()
    {
        $about = Page::where('slug', 'about')->first();
        return view('webpages.about', compact('about'));
    }

    public function contact()
    {
        return view('webpages.contact');
    }
    public function alumni()
    {
        $jumbotron = Page::where('slug', 'alumni-jumbotron')->first();
        $alumnis = Page::where('slug', 'alumni-sambutan')->first();

        $alumni = Alumni::select('id', 'nama', 'nis', 'tahun_lulus', 'kelas', 'status')
            ->orderBy('tahun_lulus', 'desc')
            ->get();

        $uniqueYears = Alumni::select('tahun_lulus')
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('tahun_lulus');

        // logger()->info('Alumni Data:', $alumni->toArray());

        return view('webpages.alumni', compact('jumbotron', 'alumnis', 'alumni', 'uniqueYears'));
    }

    public function showProgram($id)
    {
        $page = Page::where('slug', 'home-program')->first();

        if (!$page || !is_array($page->content)) {
            abort(404, 'Program tidak ditemukan');
        }

        // Cari program dengan id yang sesuai di dalam array content
        $program = collect($page->content)->firstWhere('id', $id);

        if (!$program) {
            abort(404, 'Program tidak ditemukan');
        }

        return view('webpages.partials.home.showProgram', compact('program'));
    }

    // public function portfolio()
    // {
    //     return view('portfolio');
    // }
    // public function testimonials()
    // {
    //     return view('testimonials');
    // }
    // public function blog()
    // {
    //     return view('blog');
    // }
}
