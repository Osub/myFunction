<?php
/**
*返回过滤转义后的html
* Returns HTML escaped variable
*
* @access	public
* @param	mixed
* @return	mixed
*/
if ( ! function_exists('html_escape'))
{
	function html_escape($var)
	{
		if (is_array($var))
		{
			return array_map('html_escape', $var);
		}
		else
		{
			return htmlspecialchars($var, ENT_QUOTES, config_item('charset'));
		}
	}
}
