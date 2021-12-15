<?php

namespace App\Tools;

/**
 * 字符串转码
 */
class MbEncode
{
	//判断字符串编码类型
	public static function checkEncode($str)
	{
		$e = mb_detect_encoding($str, array('UTF-8', 'GBK','GB2312'));
		return $e;
	}

	/**
	 * 转成gb2312
	 */
	public static function strToGb2312($str)
	{
		$e = mb_detect_encoding($str, array('UTF-8', 'GBK','GB2312'));
		return mb_convert_encoding($str, 'GB2312',$e);
	}

	/**
	 *  转成utf8
	 */
	public static function strToUtf8($str)
	{
		$e = mb_detect_encoding($str, array('UTF-8', 'GBK','GB2312'));
		return  mb_convert_encoding($str, 'UTF-8',$e);
	}
}