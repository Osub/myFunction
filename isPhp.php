<?php
/**
*判断当前php版本是否符合要求
*/
if ( ! function_exists('is_php'))
{
	function is_php($version = '5.0.0')
	{
		static $_is_php;
		$version = (string)$version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}

		return $_is_php[$version];
	}
}

######
#1.version_compare(PHP_VERSION,$version)  php版本比较函数【参数1当前php版本，用常量PHP_VERSION获得，参数2是需要比较的php版本号】当前版本
更低是返回-1，相等返回0，当前版本高返回1


?>
