<?php
/**
 * SimpleView Service API
 *
 * PHP Version 7.1
 *
 * @category SimpleView
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     www.odden.io
 */

/**
 * SimpleView Class that controls the api requests
 *
 * @category SimpleView
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 */
class SimpleView
{
    private $userName = '';
    private $password = '';
    private $soapClient;

    /**
     * __construct
     *
     * @param [object] $config configuration object
     */
    public function __construct($config)
    {
        $this->userName   = $config->username;
        $this->password   = $config->password;
        $this->soapClient = new SoapClient($config->soapurl);
    }

    /**
     * Undocumented function
     *
     * @param integer $pageSize         the number of items per page
     * @param integer $pageNum          the page requested
     * @param object  $filter           filtered listings
     * @param bool    $displayAmenities amenities yes or no
     *
     * @return void
     */
    public function getListings($pageSize = 1, $pageNum = 1, $filter = [], $displayAmenities = null)
    {
        $results;

        if ($displayAmenities === null) {
            $displayAmenities = false;
        }

        try {
            $results = $this->soapClient->getListings(
                $this->userName,
                $this->password,
                $pageNum,
                $pageSize,
                $filter,
                ($displayAmenities === true) ? 1 : 0
            );
        } catch (Exception $ex) {
            $results = false;
        }

        return $results;
    }
}
