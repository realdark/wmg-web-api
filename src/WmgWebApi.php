<?php

#namespace realdark\WmbWebApi;

/**
 * A PHP implementation of WMG's Web API
 */
class WmgWebApi
{
    /**
     * Init class
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Fetch data
     */
    private static function fetchData($type, $name)
    {
        // URL
        $url = "https://tours-api.dsp.wmg.com/shows.json?" . $type . "=" . urlencode($name);
        
        // Get cURL resource
        $curl = curl_init();
        
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ]);
        
        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);
        
        return json_decode($resp);
    }
    
    public static function searchForArtistEvents($artist = null)
    {
        $events = self::fetchData('artist', $artist);
        
        return $events;
    }
    
    public static function searchForCountryEvents($country = null)
    {
        $events = self::fetchData('countryName', $country);
        
        return $events;
    }
    
    public static function searchForTour($tour = null)
    {
        $events = self::fetchData('tourName', $tour);
        
        return $events;
    }
}