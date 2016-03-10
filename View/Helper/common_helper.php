<?php  
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    function  image_upload($upload_name,$newFileName,$path,$width,$height)
	{
		$CI =& get_instance();
		$ext = explode('.',$newFileName);
		$file_extension='.'.$ext[count($ext)-1];
		$final_ext=$ext[count($ext)-1];
		if(in_array($final_ext,array('jpg','jpeg','gif','png','JPG','Jpg','Png','PNG','Jpeg','JPEG','Gif','GIF')))
		{
			$config['file_name'] = $newFileName;
			$config['allowed_types'] = '*';
			$config['upload_path'] = $path;
			$config['max_size'] = '0';
			$config['max_width'] = '0';
			$config['max_height'] = '0';
			$CI->load->library('upload',$config);
			if (!$CI->upload->do_upload($upload_name))
			{
				return 'file';
			}
			//$CI->upload->clear();
			return $newFileName;
		}
		else
		{
		   return 'file';
		}
	}
	
	
	function image_resize($path,$new_path,$width,$height)
	{
		list($img_width,$img_height)=getimagesize($path);
		$ratio = $img_width/$img_height;
		$targ_ratio = $width/$height;
		if ($targ_ratio >= $ratio){
			//too tall. orginal image has less width than container
			$hard_value='width';
		} else {
			//too wide. orginal image has max width than container
			$hard_value='height';
		}
		$CI =& get_instance();		
		$CI->load->library('image_lib');
		$configThumb = array();  
		$configThumb['image_library']   = 'gd2';  
		$configThumb['create_thumb']    = TRUE;
		$configThumb['source_image']    = $path;  
		$configThumb['new_image']       = $new_path;  
		$configThumb['maintain_ratio']  = TRUE;
		$configThumb['width']           = $width; 
		$configThumb['height']          = $height;
		$configThumb['master_dim']      = $hard_value;
		$configThumb['thumb_marker']    = "";
		$CI->image_lib->initialize($configThumb);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
		return true;
		
	}
	function image_crop($path,$new_path,$width,$height)
	{
		$CI =& get_instance();
		$CI->load->library('image_lib');
		list($img_width,$img_height)=getimagesize($path);
		$crop_y=0;
		$crop_x=0;
		if($img_height>$height)
		{
			$crop_y=$img_height-$height;
			$crop_y=floor($crop_y/2);
		}
		if($img_width>$width)
		{
			$crop_x=$img_height-$height;
			$crop_x=floor($crop_x/2);
		}
		$configThumb = array();  
		$configThumb['image_library']   = 'gd2';  //gd2,imagemagick
		$configThumb['create_thumb']    = TRUE;
		$configThumb['source_image']    = $path;  
		$configThumb['new_image']       = $new_path;  
		$configThumb['maintain_ratio']  = false;
		$configThumb['width']           = $width; 
		$configThumb['height']          = $height;
		$configThumb['x_axis']			= $crop_x;
		$configThumb['y_axis']			= $crop_y;
		$configThumb['thumb_marker']    = "";
		$CI->image_lib->initialize($configThumb);
		$CI->image_lib->crop();
		$CI->image_lib->clear();
		return true;
		
	}
	
		function subdirpath ($id)
		{
 		      $id .= '';
 		      $f0 = ''; $f1=''; $_s = '';
 		  if (strlen($id)<=2) {
 			     $f0 = substr($id,0,2);
 		  };
 		  if (strlen($id)>2) {
 			    $f0 = substr($id,0,2);
 			    $f1 = substr($id,2,2);
 		  }
 		 
 		  if ($f1!='') {
 			    $_s = $f0 . '/' . $f1 . '/';
 		  } else {
 			    $_s = $f0 . '/';
 		  }
 	
 		  return $_s;
 	}
	
	
	function datapath()
	{
		$CI = & get_instance();
		return $CI->config->item('DATAPATH');
	}

	
	