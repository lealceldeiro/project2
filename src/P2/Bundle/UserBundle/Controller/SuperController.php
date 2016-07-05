<?php

namespace P2\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * SuperController controller.
 *
 */
class SuperController extends Controller
{
	//flashbag notices
    protected $P2_NOTICE_ERROR = 'notice_error';
    protected $P2_NOTICE_SUCCESS = 'notice_success';

    //role labels
    protected $ROLE_ADMIN = 'ROLE_ADMIN';
    protected $ROLE_CUSTOMER = 'ROLE_CUSTOMER';
    protected $ROLE_DELIVERY_MAN = 'ROLE_DELIVERY_MAN';
    protected $ROLE_DELIVERY_MANAGER = 'ROLE_DELIVERY_MANAGER';
    protected $ROLE_PRODUCT_LINE_MANAGER = 'ROLE_PRODUCT_LINE_MANAGER';
    protected $ROLE_PRODUCT_MANAGER = 'ROLE_PRODUCT_MANAGER';
    protected $ROLE_SALE_MANAGER = 'ROLE_SALE_MANAGER';
    protected $ROLE_SELLER = 'ROLE_SELLER';

    //role descriptions
    protected $ROLE_ADMIN_DESCRIP = 'Role intended to be assigned to administrators.';
    protected $ROLE_CUSTOMER_DESCRIP = 'Role intended to be assigned to customers.';
    protected $ROLE_DELIVERY_MAN_DESCRIP = 'Role intended to be assigned to delivery men.';
    protected $ROLE_DELIVERY_MANAGER_DESCRIP = 'Role intended to be assigned to delivery man managers.';
    protected $ROLE_PRODUCT_LINE_MANAGER_DESCRIP = 'Role intended to be assigned to product line managers.';
    protected $ROLE_PRODUCT_MANAGER_DESCRIP = 'Role intended to be assigned to product managers.';
    protected $ROLE_SALE_MANAGER_DESCRIP = 'Role intended to be assigned to sale managers.';
    protected $ROLE_SELLER_DESCRIP = 'Role intended to be assigned to sellers.';
}