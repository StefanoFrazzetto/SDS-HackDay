<?php

namespace App\Http\Controllers;

ini_set("allow_url_fopen", 1);

class AdzunaController extends Controller
{
    protected $adzuna_id;
    protected $adzuna_key;
    protected $website = "api.adzuna.com/v1/api/jobs/gb/";
    protected $format = "&content-type=application/json";

    public function __construct()
    {
        $this->adzuna_id = getenv("ADZUNA_ID");
        $this->adzuna_key = getenv("ADZUNA_KEY");
    }

    private function getter($url) {
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

    /**
     * You don't need to know.
     *
     * @param $county
     * @return string
     */
    private function getLocation($county) {
        $location = "&location0=UK&location1=Scotland";
        if (isset($county) && $county != "") {
            $location .= "&location2=$county";
        }

        return $location;
    }

    /**
     * Returns the job count for all Scottish counties.
     * If job is specified, returns the count for that specific job.
     *
     * @param string $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function countJobs($job = "")
    {
        $url = $this->website . "geodata?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= "&location0=UK&location1=Scotland&content-type=application/json";

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        return $this->getter($url);
    }


    public function countJobsCounty($county = "", $job = "") {
        $url = $this->website . "geodata?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= $this->getLocation($county);
        $url .= $this->format;

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        return $this->getter($url);
    }

    public function getJobsByCounty($county, $job = "", $results = 50) {
        $url = $this->website . "search/1?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key;
        $url .= $this->getLocation($county);
        $url .= "&results_per_page=$results";
        $url .= $this->format;

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        if ($job != "") {
            $url .= "&what=" . urlencode($job);
        }

        return $this->getter($url);
    }

    public function getJobsByCity($city, $job) {

    }

    /**
     * Returns all the jobs categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobCategories() {
        $url = $this->website . "categories?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key . $this->format;

        return $this->getter($url);
    }

    /**
     * Returns the top companies. If county is specified, returns all the top companies only for that county.
     *
     * @param string $county
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopCompanies($county = "") {
        $url = $this->website . "top_companies?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key . $this->format . $this->getLocation($county);

        return $this->getter($url);
    }

    /**
     * Returns the top companies for the selected job.
     *
     * @param $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopCompaniesByJob($job) {
        $url = $this->website . "categories?app_id=" . $this->adzuna_id . "&app_key=" . $this->adzuna_key . $this->format;

        return $this->getter($url);
    }
}
