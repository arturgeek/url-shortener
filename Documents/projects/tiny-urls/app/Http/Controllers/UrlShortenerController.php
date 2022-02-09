<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\UrlHandler;
use Exception;

class UrlShortenerController extends Controller
{
    public function __construct()
    {
        $this->urlHandler = new UrlHandler();
    }

    public function index()
    {
        return view('welcome');
    }

    public function getTinyUrl(Request $request)
    {
        try{
            $tinyUrl = $this->urlHandler->processUrl( $request->get("url") );
            if( $tinyUrl === null )
            {
                throw new Exception("Something went wrong.");
            }
            return view('welcome', [
                "tinyUrl" => $tinyUrl
            ]);
        }
        catch(Exception $e)
        {
            return view('welcome', [
                "error" => $e->getMessage()
            ]);
        }
    }

    public function getTop100()
    {
        $top = $this->urlHandler->getTop100HittedUrls();
        return view('top100', [
            "top" => $top
        ]);
    }

    public function checkShortenedUrl()
    {
        $tinyUrl = $this->urlHandler->checkTinyUrl( url()->current() );
        if( $tinyUrl !== null )
        {
            redirect()->to( $tinyUrl->originalUrl )->send();
        }
        return view('welcome', [
            "error" => "The Tiny URL is not longer available."
        ]);
    }
}
