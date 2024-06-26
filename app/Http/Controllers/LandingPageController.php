<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Demografi;
use App\Models\Geografis;
use App\Models\Lembaga;
use App\Models\PerangkatDesa;
use App\Models\StructureOrg;
use Illuminate\Http\Request;


class LandingPageController extends Controller
{
    public function demografi()
    {
        $results = Demografi::all()->groupBy(function ($item) {
            return $item->category->nama;
        })->map(function ($group) {
            return $group->groupBy(function ($item) {
                return $item->tahun;
            });
        });

        return view('landing_page.demografi', [
            'results' => $results,
        ]);
    }

    public function geografi()
    {
        $record = Geografis::first();

        return view('landing_page.geografi', [
            'record' => $record,
        ]);
    }

    public function petugas()
    {
        $results = PerangkatDesa::all();
        return view('landing_page.perangkat-desa', [
            'results' => $results,
        ]);
    }

    public function struktur()
    {
        $results = StructureOrg::where('type','kades')->first();
        // dd($results);

        return view('landing_page.struktur', [
            'result' => $results,
        ]);

    }

    public function lembaga()
    {
        $results = Lembaga::all();
        // dd($results);

        return view('landing_page.lembaga', [
            'results' => $results,
        ]);

    }

    public function landing_page()
    {
        // $article = Article::all();
        $article = Article::orderBy('event_date', 'asc')->take(3)->get();

        return view('landing_page.index', compact('article'));
    }
}
