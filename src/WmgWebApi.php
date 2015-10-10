<?php

namespace realdark\WmgWebApi;

/**
 * A PHP implementation of WMG's Web API
 *
 * @author realdark <me@borislazarov.com> 
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
     * 
     * @param string $type Artist, tour or country name
     * @param string $name Search param
     * @param integer $page Begin fetch from this page
     * @return object
     */
    private static function fetchData($type, $name, $page = null)
    {
        // Add pages
        $page = empty($page) ? null : "&page=" . $page;
        
        // URL
        $url = "https://tours-api.dsp.wmg.com/shows.json?" . $type . "=" . urlencode($name) . $page;
        
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
    
    /**
     * Search events by artist name
     * 
     * @param string $artist Artist name
     * @return object
     */
    public static function searchForArtistEvents($artist = null)
    {
        $events = self::fetchData('artist', $artist);
        
        return $events;
    }
    
    /**
     * Search events by country name
     * 
     * @param string $country Country name
     * @return object
     */
    public static function searchForCountryEvents($country = null)
    {
        $events = self::fetchData('countryName', $country);
        
        // We check if there is more than 100 events. If they are mote than 100 fetch next page
        if ($events->total_entries > 100) {
            $totalPages = ceil($events->total_entries / 100 );
            
            for ($i = 1; $i < $totalPages; $i++) {
                $tmpEvents = self::fetchData('countryName', $country, $i + 1);
                
                foreach ($tmpEvents->shows as $event) {
                    $events->shows[] = $event;
                }
            }
        }
        
        return $events;
    }
    
    /**
     * Searh for tours by tour name
     * 
     * @param string $tour Tour name
     * @return object
     */
    public static function searchForTour($tour = null)
    {
        $events = self::fetchData('tourName', $tour);
        
        return $events;
    }
}
