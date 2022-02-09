<?php

namespace App\Tools;

use Goutte\Client;
use Exception;

class Crawler
{
    private $client;
    public $request = null;

    function __construct() {
        $this->client = new Client();
    }

    public function loadUrl( $url )
    {
        $this->request = $this->client->request('GET', $url);
        return true;
    }

    public function getUrlTitle()
    {
        if( $this->request == null )
        {
            throw new Exception("Can retrieve the Title because the request is invalid.");
        }

        $node = $this->getNodesFromDom("h1");

        if( count($node) > 0 )
        {
            $node = $node[0];
            return $node->text();
        }
        return "";
    }

    private function getNodesFromDom( $selector )
    {
        $values = [];
        $this->request->filter($selector)->each(function ($node) use (&$values) {
            $values[] = $node;
        });
        return $values;
    }
}
