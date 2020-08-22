<?php

namespace App\Http\Controllers;

use App\Models\Posts\Post;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private const COUNT_SHOW_ARTICLES = 6;

    public function show()
    {
        $articles = (new Post())
            ->select(DB::raw('id, name, image, RIGHT(description, 20) as description'))
            ->orderByDesc("created_at")
            ->limit(self::COUNT_SHOW_ARTICLES)
            ->get()
        ;

        return view('index.show', ['articles' => $articles]);
    }
}
