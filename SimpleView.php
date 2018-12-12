<?php
/**
 * SimpleView Service API
 * 
 * @category   SimpleView
 * @package    SimpleView
 * @author     Darren Odden <darren@odden.io>
 * @license    MIT ./LICENSE
 * @link       www.odden.io
 */

require_once 'SimpleViewFilter';

class SimpleView
{
    private $_userName = '';
    private $_password = '';
    private $_soapClient;

    /**
     * __construct
     *
     * @param [object] $config configuration object
     */
    function __construct($config)
    {
        $this->_userName   = $config->username;
        $this->_password   = $config->password;
        $this->_soapClient = new SoapClient($config->soapurl);
    }

    // API Wrappers

    /**
     * Undocumented function
     *
     * @param integer $pageSize
     * @param integer $pageNum
     * @param object  $filter
     * @param bool   $displayAmenities
     * 
     * @return void
     */
    public function getListings($pageSize = 1, $pageNum = 1, $filter = null, $displayAmenities = null)
    {
        $results;
        $simpleViewFilter = new SimpleViewFilter();
        if ($filter === null) {
            $filter = $simpleViewFilter->filterAllListings();
        }

        if ($displayAmenities === null) {
            $displayAmenities = false;
        }

        try
        {
            $results = $this->soapClient->getListings(
                $this->userName,
                $this->password,
                $pageNum,
                $pageSize,
                $filter,
                ($displayAmenities === true) ? 1 : 0
            );
        }
        catch (Exception $ex)
        {
            $results = false;
        }

        return $results;
    }

}