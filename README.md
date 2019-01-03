# SimpleView for PHP
<!-- [![Build Status](https://api.travis-ci.org/spryker/code-sniffer.svg?branch=master)](https://travis-ci.org/spryker/code-sniffer) -->
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg)](https://php.net/)
<!-- [![License](https://poser.pugx.org/spryker/code-sniffer/license.svg)](https://packagist.org/packages/spryker/code-sniffer) -->
<!-- [![Total Downloads](https://poser.pugx.org/spryker/code-sniffer/d/total.svg)](https://packagist.org/packages/spryker/code-sniffer) -->

SimpleView API library functionality

Library built for testing using composer

This is a PHP helper library for SimpleView CRM for SOAP calls.

## You will have to provide

The config.sample.json has the basic bones for the information required to connect. 

You need to provide the following information:
```json
    "clientUserName": "xxxxxxxx",
    "clientPassword": "xxxxxxxx",
    "serviceUrl": "http://xxxxxxxx.simpleviewcrm.com/webapi/listings/soap/listings.cfc?wsdl",
```