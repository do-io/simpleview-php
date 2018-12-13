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
 */
class SimpleViewLibrary implements SimpleViewInterface
{
    private $clientUserName = '';
    private $clientPassword = '';
    private $serviceUrl     = '';
    private $soapClient;

    /**
     * Construction site
     *
     * @param [type] $config configuration object
     */
    public function __construct($config)
    {
        $this->clientUserName = $config->clientUserName;
        $this->clientPassword = $config->clientPassword;
        $this->serviceUrl     = $config->serviceUrl;
        $this->soapClient     = new \SoapClient($this->serviceUrl);
    }
}
