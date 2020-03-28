<?php

namespace App\Http\Controllers;

use App\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;

class UrlController extends Controller
{
    public function index()
    {
        return view('welcome', ['dstURL' => null]);
    }

    public function go($token)
    {
        $url = Urls::where('token', $token)->first();

        if ($url == null)
            return abort(404);

        return redirect()->away($url->dst_url);
    }

    public function generate(Request $request)
    {
        $this->validate($request, [
            'dst_url' => 'required|url'
        ]);

        // Проверяем если конечная ссылка уже существует
        $dstUrl = $request->get('dst_url');
        $url = Urls::where('dst_url', $dstUrl)->first();

        // если не существует, пытаемся сгенерировать
        if ($url == null)
        {
            $shortUrl = Urls::add($dstUrl);

            if ($shortUrl == null)
                return view('welcome', ['dstURL' => '']);
            
            return view('welcome', ['dstURL' => $shortUrl]);
        }
        // если уже существует, выводим её
        else
            return view('welcome', ['dstURL' => URL::to('/') . '/l/' . $url->token]);
    }
}
