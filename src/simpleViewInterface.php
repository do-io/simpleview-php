<?php
/**
 * SimpleView Interface
 *
 * PHP Version 7.1
 *
 * @category Interface
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 */

namespace SimpleView;

/**
 * Interface SimpleViewInterface
 *
 * @category Interface
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 */
interface SimpleViewInterface
{

    /**
     * Set the soap connection
     *
     * @param object $config configuration object
     *
     * @return void
     */
    public function setConfig($config);

    /**
     * Set the Listing Type
     *
     * @param string $type listing type to focus on
     *
     * @return void
     */
    public function setListType($type);

    /**
     * Set the filter
     *
     * @return void
     */
    public function getFilter();

    /**
     * Get the Listings
     *
     * @return void
     */
    public function getListings();
}
