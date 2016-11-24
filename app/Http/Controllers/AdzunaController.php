<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

ini_set("allow_url_fopen", 1);

class AdzunaController extends Controller
{
    protected $adzuna_id;
    protected $adzuna_key;
    protected $base_site = "api.adzuna.com/v1/api/jobs/gb/";
    protected $format = "&content-type=application/json";
    private $url;

    public function __construct()
    {
        $this->adzuna_id = getenv("ADZUNA_ID");
        $this->adzuna_key = getenv("ADZUNA_KEY");
    }

    /**
     * Returns the job count for all Scottish counties.
     * If a county is specified, the count will be referred to that county.
     *
     * @param string $county
     * @return \Illuminate\Http\JsonResponse
     */
    public function countAllJobsByCounty($county = "")
    {
        $url = $this->base_site . "geodata?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= $this->getLocation($county);
        $url .= $this->format;

        return $this->getter($url);
    }

    /**
     * Returns the string containing the location where the jobs should be found.
     * If county is not specified, the default location is UK, Scotland.
     *
     * @param $county - the county
     * @return string that specifies the location
     */
    private function getLocation($county = "")
    {
        $location = "&location0=UK&location1=Scotland";
        if ($county != "") {
            $location .= "&location2=$county";
        }

        return $location;
    }

    /**
     * Performs the cURL request and returns a json.
     *
     * @param $url - the URL to get.
     * @return \Illuminate\Http\JsonResponse
     */
    private function getter($url)
    {
        $this->url = $url;

        $res = Cache::remember($url, 60, function () {
            //  Initiate curl
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL, $this->url);
            // Execute
            $result = curl_exec($ch);
            // Closing
            curl_close($ch);

            return json_decode($result, true);
        });

        return response()->json($res);
    }

    /**
     * Returns the job count for all Scottish counties.
     * If job is specified, returns the count for that specific job.
     * If a county is specified, the count will be referred to that county.
     *
     * @param string $county
     * @param string $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function countJobs($job = "", $county = "")
    {
        $url = $this->base_site . "geodata?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= $this->getLocation($county);
        $url .= $this->format;

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        return $this->getter($url);
    }

    /**
     * Returns Adzuna's job advertisement listings.
     * https://developer.adzuna.com/docs/search
     *
     * If no parameters are specified, returns the first 50 jobs in the listing.
     * If county is specified, returns the jobs listed in that county.
     * If a job is specified, returns the first 50 ads for that job.
     *
     * @param string $county - the county where the jobs are available
     * @param string $job - the job ad to look for
     * @param int $results - the number of ads to retrieve
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobs($job = "", $county = "", $results = 50)
    {
        $url = $this->base_site . "search/1?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= "&results_per_page=$results";

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        $url .= $this->getLocation($county);
        $url .= $this->format;

        return $this->getter($url);
    }


    /**
     * Returns all the jobs categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobCategories() {
        $url = $this->base_site . "categories?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key . $this->format;

        return $this->getter($url);
    }

    /**
     * Returns the top companies. If county is specified, returns all the top companies only for that county.
     *
     * @param string $county
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopCompanies($county = "") {
        $url = $this->base_site . "top_companies?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key . $this->format . $this->getLocation($county);

        return $this->getter($url);
    }

    /**
     * Returns the top companies for the selected job.
     *
     * @param $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopCompaniesByJob($job = "")
    {
        $url = $this->base_site . "categories?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key . $this->format;

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        return $this->getter($url);
    }
}
