<?php
/*
File: /app/controllers/components/upload.php
*/
class UploadComponent extends Object
{
	//
	// This function checks an image to see if it's valid
	// Optionally fills in an array with image info like width, height, etc.
	// Returns 0 if all is well, otherwise returns a code that indicates what is wrong
	//
	function validateUploadImage( $picArray )
	{
		// check for any kind of error uploading the file
		if(
			count($picArray) < 1 ||
			!isset($picArray) ||
			$picArray['error'] != 0 ||
			$picArray['size'] < 1 ||
			$picArray['size'] > 5242880 //max file size is 5MB
		) {
			return 1;
		}

		// check that the MIME type is good
		$validMIMEtypes = array( "image/gif", "image/jpeg", "image/pjpeg", "image/png" );
		if( !in_array( $picArray['type'], $validMIMEtypes ) )
		{
			return 2;
		}

		// test the real file type by header
		$imageType = exif_imagetype( $picArray['tmp_name'] );
		$validImageTypes = array( IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG );
		if( !in_array( $imageType, $validImageTypes ) )
		{
			return 3;
		}

		// do one last even more strict test that this is a real image
		$imageinfo = getimagesize( $picArray['tmp_name'] );
		$validImageInfoType = array( 1, 2, 3);
		if(
			$imageinfo===false ||
			!in_array( $imageinfo[2], $validImageInfoType )
		) {
			return 4;
		}

		return 0;
	}

	function copyImageFile( $srcFile, $srcType, $dstFile, $srcX, $srcY, $srcWidth, $srcHeight, $dstX, $dstY, $dstWidth, $dstHeight )
	{
		// read in the source image
		$imgsrc = false;
		switch( $srcType )
		{
			case 1:
				$imgsrc = imagecreatefromgif( $srcFile );
				break;
			case 2:
				$imgsrc = imagecreatefromjpeg( $srcFile );
				break;
			case 3:
				$imgsrc = imagecreatefrompng( $srcFile );
				break;
		}

		// check for failure
		if( $imgsrc === false )
		{
			return 1;
		}

		// create a target image in memory
		if( !($imgdst = imagecreatetruecolor( $dstWidth, $dstHeight )) )
		{
			return 2;
		}
		
		/* Check if this image is PNG or GIF, then set if Transparent*/  
		//if(($srcType == 1) || ($srcType == 3))
		//{
			imagealphablending($imgdst, true);
			imagesavealpha($imgdst,true);
			$transparent = imagecolorallocate($imgdst, 255, 255, 255);
			imagefill($imgdst, 0, 0, $transparent);
 		//}
 		
		// do the copy and resize
		if( !imagecopyresampled( $imgdst, $imgsrc, $dstX, $dstY, $srcX, $srcY, $dstWidth, $dstHeight, $srcWidth, $srcHeight) )
		{
			return 3;
		}

		// save the JPEG at a fair compression setting (100 is best quality, 0 is best compression)
		switch( $srcType )
		{
			case 1:
				if( !imagejpeg( $imgdst, $dstFile, 75 ) )
				{
					return 4;
				}
				break;
			case 2:
				if( !imagegif( $imgdst, $dstFile) )
				{
					return 4;
				}
				break;
			case 3:
				if( !imagepng( $imgdst, $dstFile, 7 ) )
				{
					return 4;
				}
				break;
		}
		
		imagedestroy($imgdst);
	}
	
	function getExtension($srcType)
	{
		switch( $srcType )
		{
			case 1:
				return 'gif';
				break;
			case 2:
				return 'jpg';
				break;
			case 3:
				return 'png';
				break;
		}
		
		return false;
	}
	
	function deleteImages($srcType, $file)
	{
		switch( $srcType )
		{
			case 1:
				if(file_exists($file.'jpg'))
					unlink($file.'jpg');
				if(file_exists($file.'png'))
					unlink($file.'png');
				break;
			case 2:
				if(file_exists($file.'gif'))
					unlink($file.'gif');
				if(file_exists($file.'png'))
					unlink($file.'png');
				break;
			case 3:
				if(file_exists($file.'gif'))
					unlink($file.'gif');
				if(file_exists($file.'jpg'))
					unlink($file.'jpg');
				break;
		}
	}
}

?>