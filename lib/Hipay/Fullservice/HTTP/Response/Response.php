<?php
/*
 * Hipay fullservice SDK
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @copyright      Copyright (c) 2016 - Hipay
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 *
 */
namespace Hipay\Fullservice\HTTP\Response;

use Hipay\Fullservice\HTTP\Response\AbstractResponse;

/**
 * Simple Object Response Data
 * 
 * @package Hipay\Fullservice
 * @author Kassim Belghait <kassim@sirateck.com>
 * @copyright Copyright (c) 2016 - Hipay
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @link https://github.com/hipay/hipay-fullservice-sdk-php
 */
class Response extends AbstractResponse {
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Hipay\Fullservice\HTTP\Response\AbstractResponse::__construct()
     */
    public function __construct($body, $statusCode, array $headers){
        parent::__construct($body, $statusCode, $headers);
    }
}