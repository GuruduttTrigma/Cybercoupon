<?php 


class tool {
	
	public static function src ($params) {
		$file_name   = $params['file_name'];
		$file_index  = $params['file_index'];
		$file_entity = $params['file_entity'];
		 
		$s  = self::subdir ($file_index);
		$p = $file_entity . '/' . $s . $file_name;
		return $p; 
	}
	
 	public static function upload ($params) {
 		$field_name  = $params['field_name'];
 		$field_index = $params['field_index'];
 		$upload_path = $params['upload_path'];
 		$file_name   = $params['file_name'];
      $cnt = $params['cnt'];
 		if (!isset ($_FILES[$field_name])) return false;
 		$entry = $_FILES[$field_name];
 		if (!is_dir($upload_path)) mkdir ($upload_path, 0777, true);
 		$sub = self::subdir($field_index);
 		if (!is_dir($upload_path.$sub)) mkdir ($upload_path.$sub, 0777, true);
 		if (!file_exists($entry['tmp_name'])) return false;
 		$r = copy ($entry['tmp_name'], $upload_path . $sub . $file_name);
 		return $r;
 	}
 	
 	public static function subdir ($s) {
 		$s .= '';
 		$f0 = ''; $f1=''; $_s = '';
 		if (strlen($s)<=2) {
 			$f0 = substr($s,0,2);
 		};
 		 
 		if (strlen($s)>2) {
 			$f0 = substr($s,0,2);
 			$f1 = substr($s,2,2);
 		}
 		 
 		if ($f1!='') {
 			$_s = $f0 . '/' . $f1 . '/';
 		} else {
 			$_s = $f0 . '/';
 		}
 	
 		return $_s;
 	}
 	
 	public static function request($k) {
       $v = $_GET[$k]; if (!isset($v)) $v = $_POST[$v]; // prefered GET, if not POST 
       return $v;  		
 	}
 	
 	public static function escape ($f) {
 		$f = str_replace ("..","",$f); // for security
 		return $f;
 	}
 	
 	public static function file_type ($s) {
 		$e = self::ext($s);
 		$im_type = array('jpg','jpeg','gif','png','JPG','Jpg','Png','PNG','Jpeg','JPEG','Gif','GIF');
 		if (in_array($e,$im_type)) return 'image';
 		return 'file';
 	}
 	public static function other_file_type ($s) {
 		$e = self::ext($s);
 		$im_type = array('thing','stl','dxf','svg','ai','cdr','pdf','tiff','eps','ps','sch','brd','doc','zip');
 		if (in_array($e,$im_type)) return 'other_file';
 		return 'invalid';
 	} 	
 	
 	public static function ext ($s) {
 		$_s = explode (".",$s);
 		if (!is_array($_s)) return '';
 		$ext = $_s[count($_s)-1];
 		$ext = strtolower($ext);
 		return $ext;
 	}
 	
 	public static function httpheader ($fname) {
 		if ($length=='') $length=filesize ($fname);
 		$type = self::ext ($fname);
 		 
 		switch( strtolower ($type) ){
 			case "pdf": $ctype="application/pdf";                break;
 			case "exe": $ctype="application/octet-stream";       break;
 			case "zip": $ctype="application/zip";                break;
 			case "doc": $ctype="application/msword";             break;
 			case "xls": $ctype="application/vnd.ms-excel";       break;
 			case "ppt": $ctype="application/vnd.ms-powerpoint";  break;
 			case "gif": $ctype="image/gif";                      break;
 			case "png": $ctype="image/png";                      break;
 			case "jpg": $ctype="image/jpg";                      break;
 			case "htm": $ctype="application";                    break;
 			case "txt": $ctype="application";                    break;
 			case "swf": $ctype="application/x-shockwave-flash";  break;
 			default:    $ctype="application/force-download";
 		};
 	
 		
 		header ("Content-Disposition: inline; filename=".basename($fname).";" );
 		header ("Content-type: $ctype; name=\"". basename($fname) . "\"");
 		header ("Content-Transfer-Encoding: binary");
 		header ("Content-Length: $length");
 		header ("Content-Description: Generated Data" );
 	    
 		return true;
 	}
 	
 	
 }
 