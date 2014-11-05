<?php

/**注册类
* Class registry
*这是一个独立的函数。如果一个请求的类不存在被实例化和设置为一个变量。则返回先前被实例化的一个变量
* This function acts as a singleton.  If the requested class does not
* exist it is instantiated and set to a static variable.  If it has
* previously been instantiated the variable is returned.
*
* @access	public
* @param	string	the class name being requested
* @param	string	the directory where the class should be found
* @param	string	the class name prefix
* @return	object
*/
if ( ! function_exists('load_class'))
{
	function &load_class($class, $directory = 'libraries', $prefix = 'CI_')
	{
		static $_classes = array();

		// Does the class exist?  If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder
		foreach (array(APPPATH, BASEPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				$name = $prefix.$class;

				if (class_exists($name) === FALSE)
				{
					require($path.$directory.'/'.$class.'.php');
				}

				break;
			}
		}

		// Is the request a class extension?  If so we load it too
		if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
		{
			$name = config_item('subclass_prefix').$class;

			if (class_exists($name) === FALSE)
			{
				require(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php');
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			// Note: We use exit() rather then show_error() in order to avoid a
			// self-referencing loop with the Excptions class
			exit('Unable to locate the specified class: '.$class.'.php');
		}

		// Keep track of what we just loaded
		is_loaded($class);

		$_classes[$class] = new $name();
		return $_classes[$class];
	}
}

// --------------------------------------------------------------------

/**
* Keeps track of which libraries have been loaded.  This function is
* called by the load_class() function above
*
* @access	public
* @return	array
*/
if ( ! function_exists('is_loaded'))
{
	function &is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class != '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}
}
