<?php
/**
 * Test the SimpleView Library
 *
 * PHP Version 7.1
 *
 * @category LibraryTest
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENsE
 * @link     https://www.odden.io
 */

namespace SimpleView;

require_once __DIR__ . "/../src/simpleViewLibrary.php";

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * SimpleView Test
 *
 * @category Test
 * @package  SimpleView
 * @author   Darren Odden <darren@odden.io>
 * @license  MIT ./LICENSE
 * @link     https://www.odden.io
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class SimpleViewTest extends TestCase
{
    private $_simpleView;

    /**
     * Setup SimpleView
     *
     * @return void
     */
    public function setup()
    {
        $this->_simpleView = new SimpleViewLibrary(self::TEST_CONFIG);
    }
}
