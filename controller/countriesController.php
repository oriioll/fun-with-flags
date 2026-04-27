<?php
require_once __DIR__ . '/../apiClient/countriesApi.php';
require_once __DIR__ . '/../model/Pais.php';
class countriesController
{
    private countriesApi $countriesApi;

    public function __construct(countriesApi $countriesApi)
    {
        $this->countriesApi = $countriesApi;
    }

    public function getCountryOfTheDay()
    {
        $allCodes = $this->countriesApi->getAllCodes();
        if (!$allCodes || !is_array($allCodes) || count($allCodes) === 0) {
            error_log("No country codes available");
            return null;
        }
        $countryIndex = random_int(0, count($allCodes) - 1);
        $countryCode = $allCodes[$countryIndex]['cca3'];
        return $this->countriesApi->getDataByCode($countryCode);
    }

    public function getCountryByCCA($code)
    {
        return $this->countriesApi->getDataByCode($code);
    }

    public function getRandomCountry()
    {
        $allCodes = $this->countriesApi->getAllCodes();
        if (!$allCodes || !is_array($allCodes) || count($allCodes) === 0) {
            error_log("No country codes available");
            return null;
        }
        $countryIndex = random_int(0, count($allCodes) - 1);
        $countryCode = $allCodes[$countryIndex]['cca3'];
        return $this->countriesApi->getDataByCode($countryCode);
    }

    public function getRandomCountryName()
    {
        $countryData = $this->getRandomCountry();
        $countryName = $countryData[0]['translations']['spa']['common'];
        return $countryName;
    }

    public function getGamesCountries()
    {
        $country = $this->getRandomCountry();
        $countriesArr = [new Pais('d', '3', false, true), new Pais('d', '2', false, true), new Pais('d', '2', false, true)];
        $randomIdx = random_int(0, 2);
        $countriesArr[$randomIdx] = new Pais($country[0]['cca3'], $country[0]['translations']['spa']['common'], true, false);
        $i = true;
        $reps = 0;
        while ($i == true) {
            $random = random_int(0, 2);
            $randomCountry = $this->getRandomCountry();
            if ($random != $randomIdx && $randomCountry[0]['cca3'] != $country[0]['cca3'] && $countriesArr[$random]->esTest == true) {
                $reps++;
                $countriesArr[$random] = new Pais($randomCountry[0]['cca3'], $randomCountry[0]['translations']['spa']['common'], false, false);
            }
            if ($reps == 2) {
                $i = false;
            }
        }
        return $countriesArr;
    }
}