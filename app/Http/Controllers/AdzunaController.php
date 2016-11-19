<?php

namespace App\Http\Controllers;

ini_set("allow_url_fopen", 1);

class AdzunaController extends Controller
{
    protected $adzuna_id;
    protected $adzuna_key;

    public function __construct()
    {
        $this->adzuna_id = getenv("ADZUNA_ID");
        $this->adzuna_key = getenv("ADZUNA_KEY");
    }

    public function getAll()
    {
        $url = "api.adzuna.com/v1/api/jobs/gb/geodata?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= "&location0=UK&location1=Scotland&content-type=application/json";

        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        return response()->json(json_decode($result, true));
    }

    public function getCounty($county) {
        $url = "api.adzuna.com/v1/api/jobs/gb/geodata?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= "&location0=UK&location1=Scotland&location2=$county&content-type=application/json";

        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        return response()->json(json_decode($result, true));
    }
}
