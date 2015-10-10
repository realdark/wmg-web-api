# Wmg Web Api
A PHP implementation of [WMG's](https://tours-api.dsp.wmg.com/) Web API.

### It includes the following
- Helper methods for all API methods:
 - Search by artists name.
 - Search by tour name.
 - Search by location.
- PSR-4 autoloading support.

### Requirements
* PHP 5.4.1 or greater.
* PHP [cURL extension](http://php.net/manual/en/book.curl.php) (Usually included with PHP).

### Installation
Add `wmg-web-api` as a dependency to your composer.json:
```
"require": {
    "realdark/wmg-web-api": "dev-master"
}
```

### Examples
Get all tours by an artist
```
$tours = WmgWebApi::searchForArtistEvents("eminem");
```
Search for tour by his name
```
$tours = WmgWebApi::searchForTour("His Name Is Eminem");
```
Get all tours by an country name
```
$tours = WmgWebApi::searchForCountryEvents("us");
```

> All responses are objects

# License
MIT license. Please see [LICENSE.md](https://github.com/realdark/wmg-web-api/blob/master/LICENSE) for more information.