<?php


namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class FinanceNewsService
{
    /**
     * @param $data
     * @return Response
     */
    public function fin_news($data)
    {
        $ticker = $data['ticker'];
        $time_from = $data['time_from'];
        $time_to = $data['time_to'];
        $apiKey = 'c05fa2748v6qo74i7nd0';
        $apiUrl = "https://finnhub.io/api/v1/company-news?symbol=".$ticker."&from=".$time_from."&to=".$time_to."&token=".$apiKey."";
        $c_request = curl_init();
        curl_setopt($c_request, CURLOPT_HEADER, 0);
        curl_setopt($c_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c_request, CURLOPT_URL, $apiUrl);
        curl_setopt($c_request, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($c_request, CURLOPT_VERBOSE, 0);
        curl_setopt($c_request, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($c_request);
        curl_close($c_request);
        $data = json_decode($response);
        return $data;
    }
}