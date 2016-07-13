<?php

namespace P2\Bundle\GeneralBundle\Util;

/**
* Contains useful methods
*/
class Util
{
	
	static function getSalt($append = '')
	{	
		return $salt = time().rand(1, 9999999).$append;
	}
}