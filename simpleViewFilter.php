<?php
/**
 * Filter for SimpleView
 *
 * PHP Version 7.1
 *
 * @category    SimpleView_Filter
 * @package     SimpleViewFilter
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
     * @param integer $fieldCategory category
     * @param string  $fieldName     name
     * @param integer $filterType    type
     * @param integer $filterValue   value
     */
    public function __construct(
        $fieldCategory,
        $fieldName,
        $filterType,
        $filterValue
    ) {
        $this->fieldCategory = $fieldCategory;
        $this->fieldName     = $fieldName;
        $this->filterType    = $filterType;
        $this->filterValue   = $filterValue;
    }

    /**
     * Show all listings
     *
     * @return object
     */
    public static function filterAllListings()
    {
        $filter = new SimpleViewFilter(
            'Listing',
            'Listingid',
            'GREATER THAN',
            0
        );
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

    /**
     * Convert object to an array
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'FIELDCATEGORY' => $this->fieldCategory,
            'FIELDNAME'     => $this->fieldName,
            'FILTERTYPE'    => $this->filterType,
            'FILTERVALUE'   => $this->filterValue
        );
    }
}