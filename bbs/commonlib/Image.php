<?php
/**
 * 处理图片
 * 
 * @author Jimhuang
 */

class Image
{
	/**
	 * 错误编码
	 * @var int
	 */
	public static $errCode = 0;

	/**
	 * 错误信息
	 * @var string
	 */
	public static $errMsg = '';
	
	/**
	 * 文件类型数组
	 */
	private static $typeArr = array( 
		1 => 'GIF',
		2 => 'JPG', 
		3 => 'PNG', 
		4 => 'SWF', 
		5 => 'PSD', 
		6 => 'BMP', 
		7 => 'TIFF', //intel byte order
		8 => 'TIFF', //motorola byte order
		9 => 'JPC',
		10 => 'JP2', 
		11 => 'JPX',
		12 => 'JB2',
		13 => 'SWC',
		14 => 'IFF',
		15 => 'WBMP',
		16 => 'XBM',
	);
	
	/**
	 * 允许的图片类型
	 */
	private static $allowedImgType = array('gif', 'jpeg', 'jpg', 'png');
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearERR()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * 压缩图片
	 *
	 * @param	array	$imageInfo
	 * @return	
	 */
	public static function generateThumbnail($imageInfo)
	{
		self::clearERR();
		
		$imageInfo	= self::initImageInfo($imageInfo);
		//设置输出文件全路径
		$pathArr	= self::setOutFilePaths($imageInfo);
		
		$inputComplete	= $pathArr['inputComplete'];
		
		$imgWidth	= $imageInfo['width'];
		$imgHeight	= $imageInfo['height'];
		$imgType	= $imageInfo['inputType'];
		if ( empty($imgWidth) || empty($imgHeight) || empty($imgType)) {
			$imgSize	= @GetImageSize( $inputComplete );
			if ($imgSize === false) {
				self::$errMsg	= 'This file is not image';
				return false;
			}
			$imgWidth  = $imgSize[0];
			$imgHeight = $imgSize[1];
			
			$imgType = strtolower(self::$typeArr[$imgSize[2]]);
		}
		
		$imgType = strtolower($imgType);
		$desiredWidth	= $imageInfo['desiredWidth'];
		$desiredHeight	= $imageInfo['desiredHeight'];
		if ( empty($desiredWidth) ) {
			self::$errMsg	= 'This desired image width is null';
			return false;
		}
		if ( empty($desiredHeight) ) {
			self::$errMsg	= 'This desired image height is null';
			return false;
		}

		if ( $imgWidth<$desiredWidth && $imgHeight<$desiredHeight ) {
			$desiredWidth	= $imgWidth;
			$desiredHeight	= $imgHeight;
		}
			
		$imageSize	= self::scaleImage(array('maxWidth'=>$desiredWidth,'maxHeight'=>$desiredHeight,'curWidth'=>$imgWidth,'curHeight'=>$imgHeight));
									   
		$thumbWidth		= $imageSize['imgWidth'];
		$thumbHeight	= $imageSize['imgHeight'];	
		
		if (!in_array($imgType, self::$allowedImgType)) {
			self::$errMsg	= 'This type image could not create thumbnail';
			return false;
		}
		
		if ( $imgType == 'gif' ){
			if ( imagetypes() & IMG_GIF ){
				$image = @imagecreatefromgif( $inputComplete );
			}
		} else if ( $imgType == 'png' ) {
			if ( imagetypes() & IMG_PNG ) {
				$image = @imagecreatefrompng( $inputComplete );
			}
		} else if (  $imgType == 'jpg' ) {
			if ( imagetypes() & IMG_JPG ) { 
				$image = @imagecreatefromjpeg( $inputComplete );
			}
		} else if (  $imgType == 'wbmp' )	{
			if ( imagetypes() & IMG_WBMP ) { 
				$image = @imagecreatefromwbmp( $inputComplete );
			}
		} else {
			self::$errMsg = 'This type image could not create thumbnail';
			return false;
		}
								
		//---------------------------------------------
		// Did we get a return from imagecreatefrom?
		//---------------------------------------------

		if (empty($image)) {
			self::$errMsg	= 'PHP GD function not support';
			return false;
		} else if ($imageInfo['gdVersion'] == 1) {
			$thumb = @imagecreate( $imageSize['imgWidth'], $imageSize['imgHeight'] );
			@imagecopyresized( $thumb, $image, 0, 0, 0, 0, $imageSize['imgWidth'], $imageSize['imgHeight'], $imgWidth, $imgHeight );
		} else {
			if ($imgType == 'gif') {
				$thumb				= @imagecreate( $imageSize['imgWidth'], $imageSize['imgHeight'] );
				$backgroundColor	= imagecolorallocatealpha($thumb, 255, 255, 255, 127);
				@imagecolortransparent($thumb, $backgroundColor);
				@imagecopyresized( $thumb, $image, 0, 0, 0, 0, $imageSize['imgWidth'], $imageSize['imgHeight'], $imgWidth, $imgHeight );
			} else {
				$thumb = @imagecreatetruecolor( $imageSize['imgWidth'], $imageSize['imgHeight'] );
				@imagecopyresampled($thumb, $image, 0, 0, 0, 0, $imageSize['imgWidth'], $imageSize['imgHeight'], $imgWidth, $imgHeight );
			}
			
					
			//-----------------------------------------------
			// Saving?
			//-----------------------------------------------
			$inputFileName	= $imageInfo['inputName'];
			$outFileName	= $imageInfo['outputName'];
			if ( empty($imageInfo['outputName']) ) {
				$outFileName	= preg_replace( "/^(.*)\..+?$/", "\\1", $inputFileName ) . '_thumb';
			}
			
			$outputDir	= $imageInfo['outputDir'];
			if(!is_dir($outputDir)) {
				if (! @mkdir($outputDir, 0777, true) ) {
					self::$errMsg = 'Cannot create thumbnail dir';
					return false;
				}
			}

			if (! is_writeable($outputDir) ) {
				@chmod( $outputDir, 0777 );
			}
			
			// modified by Peter Du
			$outImageType	= $imageInfo['outputType'];
			if ( empty($outImageType) ) {
				$outImageType	= $imgType;
			}
			
			if (in_array($outImageType, self::$allowedImgType)) {
				$functionName	= ($outImageType == 'jpg') ? 'imagejpeg' : 'image'.$outImageType;
				
				if (function_exists($functionName)) {
					@$functionName( $thumb, $outputDir."/".$outFileName.'.'.$outImageType);
					@chmod( $outputDir."/".$outFileName.'.'.$outImageType, 0777 );
					@imagedestroy( $thumb );
					@imagedestroy( $image );
					$thumbLocation	= $outputDir."/".$outFileName.'.'.$outImageType;
				}
			}
		}
		
		$imageArr	= array(
			'thumbLocation'	=> $thumbLocation,
			'thumbWidth'	=> $thumbWidth,
			'thumbHeight'	=> $thumbHeight,	
		);
		
		return $imageArr;
	}
	
	/**
	 * 在图片上加水印
	 *
	 * @param	array	$imageInfo(
	 * 						'imgUrl'	:要加logo的图片地址
	 * 						'markUrl'	:logo地址
	 * 						'refPoint'	:加logo的区域 0(左上), 1(右上), 2(右下), 3(左下)
	 * 						'xPos'		:logo的 x坐标 终点
	 * 						'yPos'		:logo的 y坐标 终点
	 * 						'squareLimit': 源图两条边不能同时小于该值
	 * 						'minLimit'	:源图两条边的最小值
	 * 						'scaleLimit':是否缩小logo(当图片的短边小于该值是按比例缩小)
	 * ) 					
	 * @return unknown
	 */
	public static function makeLogo($imageInfo)	
	{
		self::clearERR();
		
		//获取logo地址
		if ( empty($imageInfo['markUrl']) ) {
			self::$errCode	= 1001;
			self::$errMsg	= 'Empty water_mark image url';
			return false;
		}
		$markUrl = $imageInfo['markUrl'];
		
		//获取原图地址
		if ( empty($imageInfo['imgUrl']) ) {
			self::$errCode	= 1000;
			self::$errMsg	= 'Empty original image url';
			return false;
		}
		$srcImg		= $imageInfo['imgUrl'];
		//获取原图信息
		$srcImgInfo	= @getimagesize($srcImg);
		if ($srcImgInfo === false) {
			self::$errCode	= 1002;
			self::$errMsg	= 'Can not get info of original image ' . $srcImg;
			return false;
		}
		$srcImgWidth	= $srcImgInfo[0];
		$srcImgHight	= $srcImgInfo[1];
		$srcImgType		= $srcImgInfo[2];
		
		//获取对源图片大小限制
		$squareLimit	= empty($imageInfo['squareLimit']) ? '' : intval($imageInfo['squareLimit']);
		$sizeLimit		= empty($imageInfo['minLimit']) ? '' : intval($imageInfo['minLimit']);

		if ( $squareLimit || $sizeLimit ) {
			// original image is too small
			if ( ($srcImgWidth <= $squareLimit && $srcImgHight <= $squareLimit) || ($srcImgWidth <= $sizeLimit) || ($srcImgHight <= $sizeLimit) ) {
				self::$errCode	= 1003;
				self::$errMsg	= "srcImage is too small. width-{$srcImgWidth},hight-{$srcImgHight} squareLimit-{$squareLimit},sizeLimit-{$sizeLimit}";
			}
		}
		
		//获取logo图片信息
		$markImgInfo	= @getimagesize($markUrl);
		if ($markImgInfo === false) {
			self::$errCode	= 1004;
			self::$errMsg	= 'Can not get info of Logo image. logoUrl:' . $markUrl;
			return false;
		}

		$markWidth	= $markImgInfo[0];
		$markHight	= $markImgInfo[1];
		$markType	= $markImgInfo[2];

		if ( $markType != IMAGETYPE_PNG ) {
			self::$errCode	= 1005;
			self::$errMsg	= 'Type of water_mark image maybe PNG';
			return false;
		}

		//获取logo加入地点
		$refPoint	= isset($imageInfo['refPoint']) ? abs((int)$imageInfo['refPoint']) : 2;
		$refPoint	= ($refPoint > 3) ? 3 : $refPoint;
			
		//logo的坐标终点
		$xPos = (empty($imageInfo['xPos'])) ? $srcImgWidth : intval($imageInfo['xPos']);
		$yPos = (empty($imageInfo['yPos'])) ? $srcImgHight : intval($imageInfo['yPos']);
		
		//获取logo的头像标识符
		$markIMG = @imagecreatefrompng($markUrl);
		if ($markIMG === false) {
			self::$errCode	= 1006;
			self::$errMsg	= 'Can not create resource from water_mark image';
			return false;
		}

		$markImgRes		= $markIMG;
		$markXoffset	= $markWidth;
		$markYoffset	= $markHight;

		// 获取缩放临界长度
		$scaleLimit	= empty($imageInfo['scaleLimit']) ? 0 : intval($imageInfo['scaleLimit']);
		//获取源图较短边长度
		$scrSmallSize	= ($srcImgWidth > $srcImgHight) ? $srcImgHight : $srcImgWidth;

		// 缩放水印
		if ( $scrSmallSize < $scaleLimit ) {
			
			//缩放比例
			$rate = $scrSmallSize / $scaleLimit;
			
			$markDstWidth = ceil($markWidth * $rate);
			$markDstHight = ceil($markHight * $rate);
			
			$tmpMarkImg = @imagecreatetruecolor($markDstWidth, $markDstHight);
			@imagealphablending($tmpMarkImg, false);
			@imagesavealpha($tmpMarkImg, true);
			@imagecopyresampled($tmpMarkImg, $markIMG, 0, 0, 0, 0, $markDstWidth, $markDstHight, $markWidth, $markHight);
			
			if ($tmpMarkImg === false) {
				self::$errCode	= 1007;
				self::$errMsg	= 'Can not create resized image resource from water_mark image';
				return false;
			}

			$markImgRes		= $tmpMarkImg;
			$markXoffset	= $markDstWidth;
			$markYoffset	= $markDstHight;
		}

		// get original image resource
		switch ( $srcImgType )
		{
			case IMAGETYPE_GIF:
				$temSrcImg	= @imagecreatefromgif($srcImg);
				$desImg		= imagecreatetruecolor($srcImgWidth, $srcImgHight);
				@imagecopy($desImg, $temSrcImg, 0, 0, 0, 0, $srcImgWidth, $srcImgHight);
				@imagedestroy($temSrcImg);
				break;
			case IMAGETYPE_JPEG:
				$desImg	= @imagecreatefromjpeg($srcImg);
				break;
			case IMAGETYPE_PNG:
				$desImg	= @imagecreatefrompng($srcImg);
				break;
			case IMAGETYPE_WBMP:
				$desImg	= @imagecreatefromwbmp($srcImg);
				break;
			default:
				self::$errCode	= 1008;
				self::$errMsg	= 'Does not support this type of original image';
				return false;
		}

		if ($desImg === false) {
			self::$errCode	= 1009;
			self::$errMsg	= 'Can not get resource of original image';
			return false;
		}
		//获取加logo的具体坐标
		switch ($refPoint)
		{
			case 0:
				$xpos = $xPos;
				$ypos = $yPos;
				break;
			case 1:
				$xpos = $srcImgWidth - $markXoffset - $xPos;
				$ypos = $yPos;
				break;
			case 2:
				$xpos = $srcImgWidth - $markXoffset - $xPos;
				$ypos = $srcImgHight - $markYoffset - $yPos;
				break;
			case 3:
			default :
				$xpos = $xPos;
				$ypos = $srcImgHight - $markYoffset - $yPos;
				break;
		}

		// 加logo
		@imagecopy($desImg, $markImgRes, $xpos, $ypos, 0, 0, $markXoffset, $markYoffset);
		umask(0);

		$imgUrl	= $imageInfo['imgUrl'];
		switch ( $srcImgType )
		{
			case IMAGETYPE_GIF:
				$succ	= @imagegif($desImg, $imgUrl);
				break;
			case IMAGETYPE_JPEG:
				$succ	= @imagejpeg($desImg, $imgUrl);
				break;
			case IMAGETYPE_PNG:
				$succ	= @imagepng($desImg, $imgUrl);
				break;
			case IMAGETYPE_WBMP:
				$succ	= @imagewbmp($desImg, $imgUrl);
				break;
		}
		
		if ($succ === false) {
			self::$errCode	= 1010;
			self::$errMsg	= "imagepng fail. param1-{$desImg}, param2-{$imgUrl}";
			return false;
		}

		@imagedestroy($markIMG);
		@imagedestroy($markImgRes);
		@imagedestroy($srcImg);
		@imagedestroy($desImg);
		
		return $imgUrl;
}
	
	
	/**
	 * 生成文件输入全路径和输出文件目录
	 *
	 * @param	array	$imageInfo
	 * @return	array('inputComplete', 'outputDir')
	 */
	private static function setOutFilePaths($imageInfo)
	{
		$inputDir  = preg_replace( "#/$#", "", $imageInfo['inputDir'] );
		$outputDir = preg_replace( "#/$#", "", $imageInfo['outputDir'] );
		
		if ( !empty($inputDir) && !empty($imageInfo['inputName']) ){
			$inputComplete	= $inputDir.'/'.$imageInfo['inputName'];
		} else {
			$inputComplete	= $imageInfo['inputName'];
		}
		
		if ( empty($outputDir) ) {
			$outputDir	= $inputDir . '_thumb';
		}
		
		return array('inputComplete'=>$inputComplete, 'outputDir'=>$outputDir);
	}
	
	/**
	 * 初始化图片信息数组
	 *
	 * @param	array	$imageInfo
	 * @return	array	
	 */
	private static function initImageInfo($imageInfo)
	{
		$imageInit	= array(
			'width'			=> 0,	// 图片宽度
			'height'		=> 0,	// 图片高度
			'inputType'		=> '',	// 输入图片的格式
			'outputType'	=> '', 					// 输出 jpg 格式图片
			'inputDir'		=> '.',// 待压缩文件路径
			'inputName'		=> '',	// 待压缩文件名(带后缀)
			'outputDir'		=> '',	// 输出压缩文件路径
			'outputName'	=> '',	// 输出压缩文件名,(压缩文件会自动追加 .jpg)
			'gdVersion'		=> 2,
			'desiredWidth'	=> 0,
			'desiredHeight' => 0,
		);
		
		return array_merge($imageInit, $imageInfo);
	}
	
	/**
	 * 获取图片大小
	 *
	 * @param	array	$arg
	 * @return	array	$imageSize
	 */
	private static function scaleImage($arg)
	{
		$imageSize	= array(
			'imgWidth'	=> $arg['curWidth'],
			'imgHeight'	=> $arg['curHeight']
		);
		
		if ( $arg['curWidth'] > $arg['maxWidth'] ) {
			$imageSize['imgWidth']	= $arg['maxWidth'];
			$imageSize['imgHeight']	= ceil( ( $arg['curHeight'] * ( ( $arg['maxWidth'] * 100 ) / $arg['curWidth'] ) ) / 100 );
			$imageSize['curHeight']	= $imageSize['imgHeight'];
			$imageSize['curWidth']	= $imageSize['imgWidth'];
		}
		
		if ( $arg['curHeight'] > $arg['maxHeight'] ) {
			$imageSize['imgHeight']	= $arg['maxHeight'];
			$imageSize['imgWidth']	= ceil( ( $arg['curWidth'] * ( ( $arg['maxHeight'] * 100 ) / $arg['curHeight'] ) ) / 100 );
		}
		
		return $imageSize;
	}
	
}
	
	
	
	
	
	
	