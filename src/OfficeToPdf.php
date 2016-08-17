<?php

namespace O2Pdf;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class OfficeToPdf
{
    protected static $endpoint = 'https://docs.google.com/viewer';
    protected $url;
    protected $pdf;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getPdfUrl()
    {
        $client = new Client();
        $query = [
            'url' => $this->url,
        ];
        try {
            $response = $client->request('GET', static::$endpoint, compact('query'));
            if ($response->getStatusCode() == '200') {
                $body = $response->getBody();
                $content = $body->getContents();
                $results = collect(explode(',', $content))->filter(function ($item) {
                    return strpos($item, '\u003d"');
                })->first();
                $url = str_replace(['\u003d"', '"'], '', $results);
                return $url ? $url.'=?download=true' : null;
            }
        } catch (TransferException $e) {
            return null;
        }
    }
}
