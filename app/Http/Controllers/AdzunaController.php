<?php

namespace App\Http\Controllers;

class AdzunaControler extends Controller
{
    protected $adzuna_id;
    protected $adzuna_key;

    public function __construct()
    {
        $this->adzuna_id = getenv("ADZUNA_ID");
        $this->adzuna_key = getenv("ADZUNA_KEY");
    }

    public function get($key) {
        $url = urlencode("http://api.adzuna.com/v1/api/jobs/gb/categories?app_id=$this->adzuna_id&app_key=$this->adzuna_key&&content-type=application/json");
        $json = json_decode(file_get_contents($url), true);
        return response()->json(['data' => $json]);
    }
}
