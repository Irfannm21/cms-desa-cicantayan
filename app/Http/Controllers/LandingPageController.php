<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\ProfileDesas;
use App\Models\Article;
use App\Models\Jabatan;
use App\Models\Demografi;
use Illuminate\Http\Request;
use App\Models\PerangkatDesa;


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

    public function landing_page()
    {
        $currentDateTime = Carbon::now();
        $data = ProfileDesas::first();

        $slide = Article::all()->take(3);
        $news = Article::where('type', 'Berita')
            ->orderBy('created_at', 'desc')
            ->get();

        $maxTextLength = 10;

        $article = Article::where(function ($query) use ($currentDateTime) {
            $query->where('event_date', '>', $currentDateTime->toDateString())
                ->orWhere(function ($query) use ($currentDateTime) {
                    $query->where('event_date', '>=', $currentDateTime->toDateString())
                        ->where('event_time', '>=', $currentDateTime->toTimeString());
                });
        })
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc')
            ->take(3)
            ->get();

        // dd($article);
        $staffWithPositions = PerangkatDesa::with('position')->orderBy('created_at', 'asc')->get();

        return view('landing_page.index', compact('article', 'staffWithPositions', 'slide', 'data', 'maxTextLength', 'news'));
    }
}
