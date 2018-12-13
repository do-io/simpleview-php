<?php
/**
 * Filter for SimpleView
 *
 * PHP Version 7.1
 *
 * @category    SimpleView_Filter
 * @package     SimpleView
 * @author      Darren Odden <darren@odden.io>
 * @file        SimpleViewFilter.php
 * @copyright   2018 Darren Odden
 * @license     MIT /LICENSE
 * @version     GIT: <git_id>
 * @link        http://www.odden.io
 * @description main simpleView filter
 */

namespace SimpleView;

use Exception;
use SimpleView\SimpleViewLibrary;

/**
 * SimpleView Filter class
 *
 * @category SimpleViewFilter
 * @package  SimpleViewFilter
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 */
class SimpleViewFilter
{
    public $filterType;
    public $fieldCategory;
    public $filterValue;
    public $fieldName;

    /**
     * Setup filter
     *
     * @param integer $filterType    type
     * @param integer $fieldCategory category
     * @param integer $filterValue   value
     * @param string  $fieldName     name
     */
    public function __construct($filterType, $fieldCategory, $filterValue, $fieldName)
    {
        $this->filterType    = $filterType;
        $this->fieldCategory = $fieldCategory;
        $this->filterValue   = $filterValue;
        $this->fieldName     = $fieldName;
    }

    /**
     * Show all listings
     *
     * @return object
     */
    public static function filterAllListings()
    {
        $filter = new SimpleViewFilter('Listing', 'Listingid', FilterType::GREATER_THAN, 0);
        return self::generateFilter($filter);
    }
    
    /**
     * Generate filters
     *
     * @param object $filterObject create filter object
     *
     * @return object
     */
    public static function generateFilter($filterObject)
    {
        assert(is_a($filterObject, 'SimpleViewFilter'));
        
        $filter = array(
            'ANDOR' => 'OR',
            'FILTERS' => array(
                $filterObject->toArray()
            )
        );
        
        return $filter;
    }

    /**
     * Filter collection to array
     *
     * @param object $filters filters
     *
     * @return array
     */
    public static function filterCollectiontoArray($filters)
    {
        assert(self::isArrayOfFilters($filters));

        $processedArray = array();

        foreach ($filters as $filter) {
            array_push($processedArray, $filter->toArray());
        }

        return $processedArray;
    }
}
