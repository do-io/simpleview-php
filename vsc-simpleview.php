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
require_once 'library/SimpleView/SimpleView.php';

if (function_exists('vscSimpleviewCreate') === false) {
    /**
     * Create the soap connection
     * vscSimpleviewCreate
     *
     * @return void
     */
    function vscSimpleviewCreate()
    {
        $jsonStr = file_get_contents("simpleview.json");
        $config = json_decode($jsonStr);
        
        $vscConnect = new SimpleView($config);
        // echo(var_dump($vscConnect));
        $allListings = SimpleViewFilter::filterAllListings();
        
        $initial = $vscConnect->getListings(
            1,
            1,
            $allListings,
            $config->listings->showAmenities
        );
        echo(var_dump($initial));

        /*
        $results = $vscConnect->getListings(
            $config->listings->pageSize,
            $config->pageNum,
            SimpleViewFilter::filter_AllListings(),
            $config->listings->showAmenities
        );
        */
    }
}

vscSimpleviewCreate();
