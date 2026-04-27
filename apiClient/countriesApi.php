<?php
class countriesApi
{
    private $baseUrl = 'https://restcountries.com/v3.1';

    public function getDataByEndpoint($endpoint)
    {
        $fullUrl = $this->baseUrl . $endpoint;
        $response = file_get_contents($fullUrl);
        $data = json_decode($response, true);
        if($data && is_array($data)) {
            return $data;
        } else {
            return null;
        }
    }

    function getDataByCode($code)
    {
        $data = $this->getDataByEndpoint('/alpha/' . $code);
        return $data;
    }

    public function getAllCodes()
    {
        $data = $this->getDataByEndpoint('/all?fields=cca3');
        return $data;
    }

}