<?php

namespace P2\Bundle\GeneralBundle\Util;

/**
* Contains methods useful
*/
class Util
{
	
	static function getSalt($append = '')
	{	
		return $salt = time().rand(1, 9999999).$append;
	}
}