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

require_once __DIR__ . '/simpleViewLibrary.php';
require_once __DIR__ . '/simpleViewFilter.php';

if (function_exists('vscSimpleviewCreate') === false) {
    /**
     * Create the soap connection
     * vscSimpleviewCreate
     *
     * @return object SimpleView SOAP connection
     */
    function vscSimpleviewCreate()
    {
        $jsonStr = file_get_contents(__DIR__ . "/simpleview.json");
        $config = json_decode($jsonStr);
        
        return new SimpleViewLibrary($config);
    }
}

if (function_exists('simpleviewFilterAll') === false) {
    /**
     * Undocumented function
     *
     * @return object all listings filter
     */
    function simpleviewFilterAll()
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

if (function_exists('simpleviewGetListings')) {
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
    function simpleviewGetListings(
        $connect,
        $filterAllListings,
        $pageSize,
        $pageNumber,
        $showAmenities
    ) {
        return $connect->getPageListings(
            $pageSize,
            $pageNumber,
            $filterAllListings,
            $showAmenities
        );
    }
}

if (function_exists('simpleviewGetResultsNumber')) {
    /**
     * Undocumented function
     *
     * @param object $connect       SOAP connection
     * @param array  $filter        Array of filterAllListings
     * @param bool   $showAmenities True or False
     *
     * @return integer number of results
     */
    function simpleviewGetResultsNumber(
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

    /**
     * Undocumented function
     *
     * @param object  $connect    SimpleView SOAP connection
     * @param integer $listId     Listing ID
     * @param integer $updateHits 0
     *
     * @return void
     */
    function simpleviewGetListing(
        $connect,
        $listId,
        $updateHits
    ) {
        return $connect->getListing($listId, $updateHits);
    }
}
