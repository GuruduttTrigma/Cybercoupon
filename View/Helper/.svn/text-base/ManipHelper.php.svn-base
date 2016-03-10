<?php 

class ManipHelper extends AppHelper {

	public static function &load ($fname) {
		$im = new Imagick($fname);
		return $im;
	}

	public static function &size ($fname, &$im='') {
		if ($im=='') $im = new Imagick ($fname);
		$size = $im->getImageGeometry ();
		$im->destroy ();
		return $size;
	}

	/**
	 * @Param w width of cut
	 * @Param h high cutout
	 * @Param x coord left. sup. horiz.
	 * @Param y coord left. sup. vert.
	 */
	public static function &crop (&$im, $w, $h, $x=0, $y=0) {
		$im->cropImage ($w, $h, $x, $y);
		return $im;
	}

	public static function &resize (&$im, $w, $h) {
		if ($w=='' || $h=='') return $im;
		$im->resizeImage ($w, $h, Imagick::FILTER_LANCZOS,1);
		$im->unsharpMaskImage(2 , 0.5 , 1 , 0.5);
		$im->normalizeImage();
		$im->enhanceImage ();
		return $im;
	}

	/**
	 * Resize and rounded corners, "iconizes" image.
	 */
	public static function &icon (&$im, $w, $h, $r) {
		$im->thumbnailImage($w, $h);
		$im->roundCorners ($r);
		return $im;
	}

	public static function cropThumbnail (&$im, $w, $h) {
		$geo = $im->getImageGeometry();
		$im->setCompression(Imagick::COMPRESSION_LZW);

		if(($geo['width']/$w) < ($geo['height']/$h))  {
			$im->cropImage($geo['width'], floor($h*$geo['width']/$w), 0, (($geo['height']-($h*$geo['width']/$w))/2));

		} else {
			$im->cropImage(ceil($w*$geo['height']/$h), $geo['height'], (($geo['width']-($w*$geo['height']/$h))/2), 0);
		}

		$im->ThumbnailImage($w,$h,true);
	}


	/**
	 * Cut an image, clipping data are relative to a size of
	 * Image rw, rh.
	 * @Param fname location of the image file
	 * @Param w width of cut
	 * @Param h high cutout
	 * @Param x coord. left
	 * @Param y coord. sup
	 * @Param rw relative width of the image
	 * @Param high rh on image
	 */
	public static function &crop_relative (&$im, $w, $h, $x, $y, $rw, $rh) {
		try {
			if ($w<=0 || $h<=0) return false;
			if ($w==$rw && $h==$rh) return self::crop ($im, $w, $h, $x, $y);
			$size = $im->getImageGeometry ();
			$sw = $size['width'];
			$sh = $size['height'];
				
			$dw = ($sw/$rw) * $w;
			$dh = ($sh/$rh) * $h;
				
			$dx  = ($sw/$rw) * $x;
			$dy  = ($sh/$rh) * $y;

			$im->cropImage ($dw, $dh, $dx, $dy);

			return $im;
		} catch (Exception $e) {
			return false;
		}
	}

    /*
	public static function save (&$im, $fname) {
		
		$ext = tool::ext ($fname);
		switch ($ext) {
			case 'jpg': case 'jpeg': $im->setImageFormat('jpeg');
			case 'gif': $im->setImageFormat('gif');
			case 'png': $im->setImageFormat('png');
			default:
				return false;
		}
		
		return $im->writeImage ($fname);
	}
	*/
	
	public static function show (&$im, $mime=null, $fname='') {
		$ext = 'unknow';
		if ($fname=='') $fname='img';

		if ($mime=='')  $mime = 'image/jpeg';
		switch ($mime) {
			case 'image/jpeg': case 'jpeg': case 'jpg': $ext='.jpg'; break;
			case 'image/gif':  case 'gif':  $ext='.gif'; break;
			case 'image/png':  case 'png':  $ext='.png'; break;
			default:            $ext='.jpg'; break;
		}

		header ("Content-type: $mime");
		header ("Content-Transfer-Encoding: binary");
		header ("Content-Description: Generated Data" );
		echo $im;
	}


	public static function save    (&$im, $outfile) {
		$p = dirname ($outfile);
		if (!is_dir($p)) return false;
		return file_put_contents ($outfile, $im);
	}


}

