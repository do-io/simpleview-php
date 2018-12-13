<?php
/**
 * SimpleView PHP Client Library
 *
 * PHP Version 7.1
 *
 * @category Library
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 */

namespace SimpleView;

// require_once __DIR__ . '/simpleViewInterface.php';

use \Exception;

/**
 * SimpleView PHP Library Class
 *
 * @category Library
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class SimpleViewLibrary implements SimpleViewInterface
{
    private $_clientUserName = '';
    private $_clientPassword = '';
    private $_serviceUrl     = '';
    private $_soapClient;

    /**
     * Construction site
     *
     * @param [type] $config configuration object
     */
    public function __construct($config)
    {
        $this->_clientUserName = $config->clientUserName;
        $this->_clientPassword = $config->clientPassword;
        $this->_serviceUrl     = $config->serviceUrl;
        $this->_soapClient     = new \SoapClient($this->serviceUrl);
    }
    
    /**
     * Get the listing types
     *
     * @param [bit] $showWeb a flag to get the listing types
     *
     * @return $results
     */
    public function getListingTypes($showWeb)
    {
        $results;

        try {
            $results = $this->_soapClient->getListingTypes(
                $this->_userName,
                $this->_password,
                $showWeb
            );
        } catch (Exception $e) {
            $results = $e;
        }

        return $results;
    }

    /**
     * Get the business listings
     *
     * @param integer $pageSize         the number of items per page
     * @param integer $pageNum          the page requested
     * @param object  $filter           filtered listings
     * @param integer $displayAmenities amenities yes(1) or no(0)
     *
     * @return $results
     */
    public function getListings($pageSize, $pageNum, $filter, $displayAmenities)
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
        } catch (Exception $e) {
            $results = $e;
        }

        return $results;
    }

    /**
     * Get the business listing
     *
     * @param integer $listingId  the id number of the listing
     * @param integer $updateHits text
     *
     * @return results
     */
    public function getListing($listingId, $updateHits)
    {
        $results;

        try {
            $results = $this->_soapClient->getListing(
                $this->_userName,
                $this->_password,
                $listingId,
                $updateHits
            );
        } catch (Exception $e) {
            $results = false;
        }

        return $results;
    }

    /**
     * Get the listing categories
     *
     * @param [type] $listingTypeId use the listing type
     *
     * @return void
     */
    public function getListingCategories($listingTypeId)
    {
        $results;

        try {
            $results = $this->soapClient->getListingCats(
                $this->clientUserName,
                $this->clientPassword,
                $listingTypeId
            );
        } catch (Exception $e) {
            $results = false;
        }

        return $results;
    }

    /**
     * Return listing subcategories
     *
     * @param [type] $listingCategoryId Category Id
     * @param [type] $listingTypeId     Type Id
     *
     * @return void
     */
    public function getListingSubCategories($listingCategoryId, $listingTypeId)
    {
        $results;
    
        try {
            $results = $this->soapClient->getListingSubCats(
                $this->clientUserName,
                $this->clientPassword,
                $listingCategoryId,
                $listingTypeId
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }

    /**
     * List the regions
     *
     * @param [type] $catId Category Id
     *
     * @return regions
     */
    public function getListingRegions($catId)
    {
        $results;
        
        try {
            $results = $this->soapClient->getListingRegions(
                $this->clientUserName,
                $this->clientPassword,
                $catId
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * List Amenities
     *
     * @return amenities
     */
    public function getListingAmenities()
    {
        $results;
        
        try {
            $results = $this->soapClient->getListingAmenities(
                $this->clientUserName,
                $this->clientPassword
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * Coupon categories
     *
     * @return void
     */
    public function getCouponCategories()
    {
        $results;
        
        try {
            $results = $this->soapClient->getCouponCats(
                $this->clientUserName,
                $this->clientPassword
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * Coupons
     *
     * @param [type] $pageNum  page number
     * @param [type] $pageSize page size
     * @param [type] $filter   filter
     *
     * @return void
     */
    public function getCoupons($pageNum, $pageSize, $filter)
    {
        $results;
        
        try {
            $results = $this->soapClient->getCoupons(
                $this->clientUserName,
                $this->clientPassword,
                $pageNum,
                $pageSize,
                $filter
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * Coupons by category id
     *
     * @param integer $couponCatId category id
     * @param integer $pageNum     page number
     * @param integer $pageSize    number of results per page
     * @param object  $filters     filter
     *
     * @return void
     */
    public function getCouponsByCategories(
        $couponCatId,
        $pageNum,
        $pageSize,
        $filters
    ) {
        $results;
        
        try {
            $results = $this->soapClient->getCouponsByCats(
                $this->clientUserName,
                $this->clientPassword,
                $couponCatId,
                $pageNum,
                $pageSize,
                $filters
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * Coupons associated to the Listing Id
     *
     * @param [type] $listingId   Listing Id
     * @param [type] $pageNum     Page number
     * @param [type] $pageSize    results per page
     * @param [type] $redeemStart coupon redemption start date
     * @param [type] $redeemEnd   coupon redemption end date
     * @param [type] $keywords    keywords
     *
     * @return void
     */
    public function getCouponsByListingId(
        $listingId,
        $pageNum,
        $pageSize,
        $redeemStart,
        $redeemEnd,
        $keywords
    ) {
        $results;
        
        try {
            $results = $this->soapClient->getCouponsByListingId(
                $this->clientUserName,
                $this->clientPassword,
                $listingId,
                $pageNum,
                $pageSize,
                $redeemStart,
                $redeemEnd,
                $keywords
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * Get the coupon
     *
     * @param [type] $couponId   coupon id
     * @param [type] $updateHits how many times used
     *
     * @return void
     */
    public function getCoupon($couponId, $updateHits)
    {
        $results;
        
        try {
            $results = $this->soapClient->getCoupon(
                $this->clientUserName,
                $this->clientPassword,
                $couponId,
                $updateHits
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
    
    /**
     * Update the hits
     *
     * @param [type] $hitTypeID hit type id
     * @param [type] $recId     record id
     * @param [type] $hitDate   hit date
     *
     * @return void
     */
    public function updateHits($hitTypeID, $recId, $hitDate)
    {
        $results;
        
        try {
            $results = $this->soapClient->updateHits(
                $this->clientUserName,
                $this->clientPassword,
                $hitTypeID,
                $recId,
                $hitDate
            );
        } catch (Exception $e) {
            $results = false;
        }
        
        return $results;
    }
}
