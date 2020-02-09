<?php
namespace common\models\enums;

class UserRoles{
	const SUBSCRIBER = 1;
	const SUPER_ADMIN = 2;
	
	public static $roles = [
		self::SUBSCRIBER => 'Subscriber',
		self::SUPER_ADMIN => 'Super Admin',
	];
	
	public static $roleConstants = [
		self::SUBSCRIBER => self::SUBSCRIBER,
		self::SUPER_ADMIN => self::SUPER_ADMIN,
	];
}
?>