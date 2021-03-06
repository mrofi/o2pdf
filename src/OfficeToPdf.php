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
                $results = array_filter(explode(',', $content), function ($item) {
                    return strpos($item, '\u003d"');
                });
                $urls = array_shift($results);
                $url = str_replace(['\u003d"', '"'], '', $urls);
                return $url ? $url.'=?download=true' : null;
            }
        } catch (TransferException $e) {
            return null;
        }
    }
}
