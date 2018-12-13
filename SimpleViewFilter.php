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
class SimpleViewFilter extends SimpleView
{
    public $filterType;
    public $fieldCategory;
    public $filterValue;
    public $fieldName;

    /**
     * Setup filter
     *
     * @param [type] $filterType    type
     * @param [type] $fieldCategory category
     * @param [type] $filterValue   value
     * @param [type] $fieldName     name
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
