<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;

class LinkShortener extends Controller
{
    public function index()
    {
        return view('linkShortener', [
            'shortLinks' => ShortLink::all(),
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $res = ShortLink::create([
            'origin_link' => $request->get('link'),
            'short_link' => str_random(5)
        ]);

        return ['id' => $res->id, 'shortLink' => $res->short_link];

    }

    public function redirect($link)
    {
        $foundLink = ShortLink::where('short_link', $link)->firstOrFail();
        return redirect($foundLink->origin_link);
    }
}

