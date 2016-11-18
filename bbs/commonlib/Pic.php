<?php
/**
 * 封装获取图片地址的函数
 */
		
abstract class Pic
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;
	/**
	 * 错误信息,无错误为''
	 */
	public static $errMsg = '';

	/**
	 * 清除错误信息,在每个函数的开始调用
	 */
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * 图片类型数组(o为用户头像大图; p为用户头像小图; v为用户视频图; gr为群组大图; gt为群组小图; ar为活动大图; at为活动小图;)
	 */
	private static $typeArr = array('o', 'p', 'v', 'gr', 'gt', 'ar', 'at');
	
	/**
	 * 生成用户在中转图片服务器上的图片地址(不保证图片存在)
	 * 
	 * @param	int		$index	图片标示(调用者必须先判断该参数合法， 比如为用户图片的话，要先判断$index是否为合法QQ号)
	 * @param	string	$type	图片类型(o为用户头像大图; p为用户头像小图; v为用户视频图; gr为群组大图; gt为群组小图;)
	 * @param	bool	$host	是否返回域名
	 * @param	int		$time	如果需要取用户历史照片，把时间戳通过该参数传递过来
	 * @return	string	图片 url 或者 path
	 */
	public static function genTmpPhoto($index, $type, $host = true, $time = 0)
	{
		// 确定是否需要带域名
		//$tmpPhoto = empty($host) ? '' : 'http://tu.qzone.qq.com/';
		$tmpPhoto = empty($host) ? '' : 'http://172.27.2.212/';
		
		// 确定是否为获取历史图片
		if ($time > 0) {
			$tmpPhoto .= date('Ymd', $time) . '/';
		}
		
		$tmpPhoto .= self::getPhotoPath($index, $type);
		if ($tmpPhoto === false) {
			return false;
		}
		
		return '' . $tmpPhoto;
	}

	/**
	  * 获取图片路径
	  * 
	 * @param	int		$index	图片标示(调用者必须先判断该参数合法， 比如为用户图片的话，要先判断$index是否为合法QQ号)
	 * @param	string	$type	图片类型
	  * 
	  * @return	string	若用户QQ号不正确, 返回空字符串, 否则返回图片路径
	 */
	public static function getPhotoPath($index, $type)
	{
		self::clearERR();
	
		if ( !in_array($type, self::$typeArr) ){
			self::$errCode	= 10621;
			self::$errMsg	= "input type-{$type} is illegal.";
			return false;
		}
	
		$mdstr	= md5($index);
		$lvl1	= substr($mdstr, 0, 2);
		$lvl2	= substr($mdstr, -2);
		
		$oitstr	= oi_symmetry_encrypt2($index, 'QzoneCommunity' . $type, true);
		$path	= $type . '/' . $lvl1 . '/' . $lvl2 . '/' . $oitstr . '.jpg';
	
		return $path;	
	}
	
	/**
	 * 获取图片在统一存储平台中的url
	 *
	 * @param	int	$index	图片标示（如：用户图片就是用户QQ号）
	 * @param	str	$type	图片类型
	 * @return	str $url		图片地址
	 */
	public static function getStoreUrl($index, $type)
	{
		global $_PIC_HOST;
		
		$urlPrefix	= $_PIC_HOST[array_rand($_PIC_HOST)];
		$url	= $urlPrefix . self::_storeUuid($index, $type) . '/1/2';
		
		return $url;
	}
	
	/**
	 * 获得用户在存储平台的  uuid
	 * 
	 * @param	int	$index	图片表示
	 * @param	str	$type	图片类型
	 * @return 	str	uuid
	 */
	private static function _storeUuid($index, $type)
	{
		// 加密要求并不严格，暂用该算法
		$step	= $index - 10000;
		return md5($step . $type) . $type;
	}
	
}