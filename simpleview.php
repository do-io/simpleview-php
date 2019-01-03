<?php
/**
 * Run simpleview functionality
 *
 * PHP version 7.1
 *
 * @category    SimpleView_Soap
 * @package     SimpleView
 * @author      Darren Odden <darren@odden.io>
 * @file        vsc-simpleView.php
 * @copyright   2018 Darren Odden
 * @license     MIT /LICENSE
 * @version     GIT: @git_id@
 * @link        http://www.odden.io
 * @description main simpleView functionality
 */

use SimpleView\SimpleViewLibrary;
use PHPUnit\Runner\Exception;

require_once __DIR__ . '/simpleViewLibrary.php';
require_once __DIR__ . '/simpleViewFilter.php';

if (function_exists('create') === false) {
    /**
     * Create the soap connection
     *
     * @return object SimpleView SOAP connection
     */
    function create()
    {
        $config = getConfig();
        
        return new SimpleViewLibrary($config);
    }
}

if (function_exists('filterAll') === false) {
    /**
     * Undocumented function
     *
     * @return object all listings filter
     */
    function filterAll()
    {
        $simpleViewFilter = new SimpleViewFilter(
            $config->filter->fieldCategory,
            $config->filter->fieldName,
            $config->filter->filterType,
            $config->filter->filterValue
        );

        $allListings = $simpleViewFilter->filterAllListings();

        return $allListings;
    }
}

if (function_exists('svGetListings')) {
    /**
     * Undocumented function
     *
     * @param object  $connect           SOAP Connection
     * @param array   $filterAllListings filter array for all listings
     * @param integer $pageSize          page size, maximum 100
     * @param integer $pageNumber        current page
     * @param bool    $showAmenities     show ammenities; true or false
     *
     * @return object Listings
     */
    function svGetListings(
        $connect,
        $filterAllListings,
        $pageSize,
        $pageNumber,
        $showAmenities
    ) {
        return $connect->getListings(
            $pageSize,
            $pageNumber,
            $filterAllListings,
            $showAmenities
        );
    }
}

if (function_exists('getResultsNumber')) {
    /**
     * Get the number of results to process
     *
     * @param object $connect       SOAP connection
     * @param array  $filter        Array of filterAllListings
     * @param bool   $showAmenities True or False
     *
     * @return integer number of results
     */
    function getResultsNumber(
        $connect,
        $filter,
        $showAmenities
    ) {
        $initial = $connect->getListings(
            1,
            1,
            $filter,
            $showAmenities
        );

        return $initial['STATUS']['RESULTS'];
    }
}

if (function_exists('getListing') === false) {
    /**
     * Get listing from SimpleView
     *
     * @param object  $connect    SimpleView SOAP connection
     * @param integer $listId     Listing ID
     * @param integer $updateHits 0
     *
     * @return object listing
     */
    function getListing(
        $connect,
        $listId,
        $updateHits
    ) {
        return $connect->getListing($listId, $updateHits);
    }
}

if (function_exists('getListingIds') === false) {
    /**
     * Undocumented function
     *
     * @param [type] $connect
     * @param [type] $filter
     * @param [type] $pageSize
     *
     * @return void
     */
    function getListingIds($connect, $filter, $pageSize)
    {
        $resultNumber = getResultsNumber($connect, $filter, 0);

        $pages = $resultNumber % $pageSize;
        $results = array();

        for ($page = 1; $page<=$pages; $page) {
            $listings = $connect->getListings($pageSize, $page, $filter, 0);
        
            foreach ($listings["DATA"] as $listing) {
                array_push($results, $listing["LISTINGID"]);
            }
        }
        return $results;
    }
}

if (function_exists('getConfig') === false) {
    /**
     * Undocumented function
     *
     * @return object
     */
    function getConfig()
    {
        $jsonStr = file_get_contents(__DIR__ . "/simpleview.json");
        return json_decode($jsonStr);
    }
}

if (function_exists('processListings') === false) {
    /**
     * Undocumented function
     *
     * @return void
     */
    function processListings()
    {
        $connection = create();
        $filter     = filterAll();

        $config = getConfig();
        $pageSize = $config->pageSize;

        $listingIds = getListingIds($connection, $filter, $pageSize);

        foreach ($listingIds as $listingId) {
            $listing = getListing($connection, $listingId, 0);

            echo(var_dump($listing));
        }
    }
}

$config = getConfig();

$connect = create();
print var_dump($connect);

$filter = filterAll();
print var_dump($filter);

$listings = $connect->getListings(1, 1, $filter, false);
print var_dump($listings);

$listingIds = getListingIds($connect, $filter, 100);
print var_dump($listingIds);
print "\n";
