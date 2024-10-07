<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SignalController extends Controller
{

    // OGDYJADT5QSD7I7PFIQBG7UG4A34RCUK
    private $apiKey = 'cr8jf6hr01qmmifqm72gcr8jf6hr01qmmifqm730'; // Sua chave da API

    public function index()
    {
        $symbol = 'AAPL'; // Substitua pelo símbolo desejado
        $minuteData = $this->fetchMinuteData($symbol);

        // Analisar dados
        $signal = $this->generateSignal($minuteData);

        return view('sinais.signals', compact('minuteData', 'signal'));
    }

    private function fetchMinuteData($symbol)
    {
        $url = "https://finnhub.io/api/v1/stock/candle?symbol=$symbol&resolution=1&from=" . (time() - 3600) . "&to=" . time() . "&token={$this->apiKey}";

        $response = Http::get($url);
        $data = $response->json();

        // Verificar e mostrar a resposta da API
        if (isset($data['error'])) {
            dd($data['error']);
        }

        return $data;
    }

    private function calculateSMA($prices, $period)
    {
        $sma = [];
        for ($i = 0; $i <= count($prices) - $period; $i++) {
            $sma[] = array_sum(array_slice($prices, $i, $period)) / $period;
        }
        return $sma;
    }

    private function generateSignal($minuteData)
    {
        $prices = $minuteData['c'] ?? []; // Use o operador de coalescência nula para evitar erros se a chave não existir

        if (empty($prices)) {
            return 'No Data';
        }

        $shortPeriod = 5; // 5 minutos
        $longPeriod = 15; // 15 minutos

        $shortSMA = $this->calculateSMA($prices, $shortPeriod);
        $longSMA = $this->calculateSMA($prices, $longPeriod);

        $lastShortSMA = end($shortSMA);
        $lastLongSMA = end($longSMA);

        if ($lastShortSMA > $lastLongSMA) {
            return 'BUY';
        } elseif ($lastShortSMA < $lastLongSMA) {
            return 'SELL';
        } else {
            return 'HOLD';
        }
    }
}
