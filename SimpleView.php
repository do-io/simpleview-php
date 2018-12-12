<?php
/**
 * SimpleView Soap package
 * 
 * PHP Version 7.2
 * 
 * @category    SimpleView_Soap
 * @package     SimpleView
 * @author      Darren Odden <darren@odden.io>
 * @file        simpleView.php
 * @copyright   2018 Darren Odden
 * @license     MIT /LICENSE
 * @version     Release: @package_version@
 * @link        http://www.odden.io
 * @description main simpleView soap connector
 */

require_once "SimpleViewFilter";

class SimpleView
{

    private $_userName;
    private $_password;
    private $_soapClient;

    /**
     * __construct
     *
     * Setup the soap client
     *
     * @param [string] $config object to simpleview config object
     */
    function __construct($config) 
    {
        $this->_userName = $config->username;
        $this->_password = $config->password;
        $this->_soapClient = new SoapClient($config->soapurl);
    }

    // API Wrappers 

    /**
     * Get listings from Simpleview
     *
     * @param [type] $pageSize         how many items should return
     * @param [type] $pageNum          what page
     * @param [type] $filter           how should this be filtered
     * @param [type] $displayAmenities display the amenities
     * 
     * @return false on fail
     */
    public function getListings($pageSize, $pageNum, $filter, $displayAmenities)
    {
        $results;
        
        try 
        {
            $results = $this->_soapClient->getListings(
                $this->_userName,
                $this->_password,
                $pageNum, 
                $pageSize,
                $filter,
                $this->convertBoolToInt($displayAmenities)
            );
        }
        catch (Exception $ex)
        {
            $results = false;
        }
        
        return $results;
    }


}