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
    public $fieldName;
    public $fieldCategory;
    public $filterValue;
    public $filterType;

    /**
     * Setup filter
     *
     * @param [type] $fieldCategory category
     * @param [type] $fieldName     name
     * @param [type] $filterType    type
     * @param [type] $filterValue   value
     */
    public function __construct($fieldCategory, $fieldName, $filterType, $filterValue)
    {
        $this->fieldCategory = $fieldCategory;
        $this->fieldName     = $fieldName;
        $this->filterType    = $filterType;
        $this->filterValue   = $filterValue;
    }

    /**
     * Show all listings
     *
     * @return void
     */
    public static function filterAllListings()
    {
        $filter = new SimpleViewFilter('Listing', 'Listingid', FilterType::GREATER_THAN, 0);
        return self::generatefilter($filter);
    }
    
    /**
     * Generate filters
     *
     * @param [type] $filterObject create filter object
     *
     * @return void
     */
    public static function generatefilter($filterObject)
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
     * @param [type] $filters filters
     *
     * @return void
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
