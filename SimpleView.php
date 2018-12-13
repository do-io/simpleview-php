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

    /**
     * Undocumented function
     *
     * @param [int] $listingId  the id number of the listing
     * @param [int] $updateHits text
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
     * Get the listing types
     *
     * @param [bit] $webBit a flag to get the listing types
     *
     * @return results
     */
    public function getListingTypes($webBit)
    {
        $results;

        try {
            $results = $this->_soapClient->getListingTypes(
                $this->_userName,
                $this->_password,
                $webBit
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
     * @param [type] $couponCatId category id
     * @param [type] $pageNum     page number
     * @param [type] $pageSize    number of results per page
     * @param [type] $filters     filter
     *
     * @return void
     */
    public function getCouponsByCategories($couponCatId, $pageNum, $pageSize, $filters)
    {
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
    public function getCouponsByListingId($listingId, $pageNum, $pageSize, $redeemStart, $redeemEnd, $keywords)
    {
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
