<?php

namespace App\Tools;

use App\Model\Urls as ModelUrls;
use Exception;

class UrlHandler
{
    private $crawler = null;
    private $tinyUrlGenerator = null;
    private $tinyStringLength = 5;
    private $baseUrl = null;

    function __construct() {
        $this->crawler = new Crawler();
        $this->tinyUrlGenerator = new TinyUrlGenerator( $this->tinyStringLength );
        $this->baseUrl = url('/')."/";
    }

    public function processUrl( $url )
    {
        if(empty($url))
        {
            throw new Exception("No URL was supplied.");
        }

        if($this->urlIsInCorrectFormat($url) == false)
        {
            throw new Exception("URL does not have a valid format.");
        }

        $tinyUrl = $this->checkIfUrlAlreadyShortened( $url );
        if( $this->checkIfUrlAlreadyShortened( $url ) !== null )
        {
            return $tinyUrl->toArray();
        }

        if( $this->urlExists($url) )
        {
            $urlTitle = $this->crawler->getUrlTitle();
            $tinyString = $this->baseUrl.$this->tinyUrlGenerator->generateRandomString();

            return $this->createNewTinyUrl( $url, $urlTitle, $tinyString )->toArray();
        }
        return null;
    }

    public function checkTinyUrl( $tinyUrl )
    {
        $tinyUrl = ModelUrls::where('shortenedUrl', $tinyUrl )->first();
        if( $tinyUrl !== null )
        {
            $this->addAccessToTinyUrl( $tinyUrl );
        }

        return $tinyUrl;
    }

    public function getTop100HittedUrls()
    {
        return ModelUrls::where( [
            ['access', '>', '0'],
        ])->orderBy('access', 'DESC')->take(100)->get()->toArray();
    }

    private function addAccessToTinyUrl( $tinyUrl )
    {
        $tinyUrl->access++;
        $tinyUrl->save();
    }

    private function createNewTinyUrl( $url, $urlTitle, $tinyString )
    {
        $tinyUrl = ModelUrls::create([
            'originalUrl' => $url,
            'shortenedUrl' => $tinyString,
            'title' => $urlTitle,
        ]);

        return $tinyUrl;
    }

    private function checkIfUrlAlreadyShortened( $url )
    {
        $tinyUrlString = str_replace($this->baseUrl, "", $url);
        return ModelUrls::where('originalUrl', $tinyUrlString)->first();
    }

    private function urlIsInCorrectFormat($url){
        if( !filter_var($url, FILTER_VALIDATE_URL, FILTER_VALIDATE_URL) )
        {
            throw new Exception("URL invalid format.");
        }
        return true;
    }

    private function urlExists( $url )
    {
        if ( !$this->crawler->loadUrl($url) )
        {
            throw new Exception("URL does not appear to exist.");
        }
        return true;
    }
}
