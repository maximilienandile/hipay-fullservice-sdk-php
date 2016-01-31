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
namespace Hipay\Fullservice\Gateway\Mapper;

use Hipay\Fullservice\Mapper\AbstractMapper;
use Hipay\Fullservice\Gateway\Model\ThreeDSecure;

/**
 * Mapper for 3D Secure Model Object
 *  
 * @package Hipay\Fullservice
 * @author Kassim Belghait <kassim@sirateck.com>
 * @copyright Copyright (c) 2016 - Hipay
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @link https://github.com/hipay/hipay-fullservice-sdk-php
 * @api
 */
class ThreeDSecureMapper extends AbstractMapper {
	
	/**
	 * @var ThreeDSecure $_modelObject Model object to populate
	 */
	protected $_modelObject;
    
    protected $_modelClassName;

    /**
     *
     * {@inheritDoc}
     *
     * @see \Hipay\Fullservice\Mapper\AbstractMapper::mapResponseToModel()
     */
    protected function mapResponseToModel()
    {
        $source = $this->_getSource();
        $eci = $source['eci'] ?: null;
        $enrollmentStatus = $source['enrollmentStatus'] ?: null;
        $enrollmentMessage = $source['enrollmentMessage'] ?: null;
        $authenticationStatus = $source['authenticationStatus'] ?: null;
        $authenticationMessage = $source['authenticationMessage'] ?: null;
        $authenticationToken = $source['authenticationToken'] ?: null;
        $xid = $source['xid'] ?: null;
        
        $this->_modelObject = new ThreeDSecure($eci, $enrollmentStatus, $enrollmentMessage, $authenticationStatus, $authenticationMessage, $authenticationToken, $xid);
        
 			
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Hipay\Fullservice\Mapper\AbstractMapper::validate()
     */
    protected function validate()
    {
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Hipay\Fullservice\Mapper\AbstractMapper::getModelClassName()
     */
    protected function getModelClassName()
    {
        return '\Hipay\Fullservice\Gateway\Model\ThreeDSecure';
    }



}