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
     * @return void
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
     * @return void
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
     * @param [type] $connect           SOAP Connection
     * @param [type] $filterAllListings filter array for all listings
     * @param [type] $pageSize          page size, maximum 100
     * @param [type] $pageNumber        current page
     * @param [type] $showAmenities     show ammenities; true or false
     *
     * @return void
     */
    function simpleviewGetListings(
        $connect,
        $filterAllListings,
        $pageSize,
        $pageNumber,
        $showAmenities
    ) {
        $connect->getPageListings(
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
     * @param object $connect           SOAP connection
     * @param array  $filterAllListings Array of filterAllListings
     * @param bool   $showAmenities     True or False
     *
     * @return void
     */
    function simpleviewGetResultsNumber(
        $connect,
        $filterAllListings,
        $showAmenities
    ) {
        $initial = $connect->getListings(
            1,
            1,
            $filterAllListings,
            $showAmenities
        );

        return $initial['STATUS']['RESULTS'];
    }
}
