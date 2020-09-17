<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GuzzleController extends Controller
{
    public function index()
    {
        /*$client = new Client([
            'headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']
        ]); 

        $response = $client->request('POST', '', [
            'json' => ['code' => '',],
        ]);*/

        /*$client = new Client([([
            'base_url' => 'https://blockchain.info/ticker'    
        ])]);

        $response = $client->request('GET');

        
        $data = $response->getBody();
        $data = json_decode($decode);
        dd($data);*/

        $bitcoinInfo = $this->getCryptoCurrencyInformation("bitcoin");

        $litecoinInfo = $this->getCryptoCurrencyInformation("litecoin");

        return view('welcome', ['bitcoin' => $bitcoinInfo, 'litecoin' => $litecoinInfo]);
    }

    private function getCryptoCurrencyInformation($currencyId, $convertCurrency = "USD")
    {
        $client = new Client(); 

        $requestURL = "https://api.coinmarketcap.com/v1/ticker/$currencyId/?convert=$convertCurrency";

        $singleCurrencyRequest = $client->request('GET', $requestURL);

        $body = json_decode($singleCurrencyRequest->getBody(), true)[0];

        if(array_key_exists("error", $body))
        {
            throw $this->createNotFoundException(sprintf('Currnecy Information Request Error: $s', $body["error"]));
        }

        return $body;
    }
    
}
