<?php

/**
*
* includes/functions_image.php
*
* By Roberto Tonjaw. Jan 2014
*/

/**
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

function check_image_type(&$type, &$error, &$error_msg)
{
    global $adm_lang;

    switch( trim($type) )
    {
	case 'image/jpeg':
	case 'image/jpg':
	    return '.jpg';
	    break;
	case 'image/gif':
	    return '.gif';
	    break;
	case 'image/png':
	    return '.png';
	    break;
	default:
	    $error = true;
	    $error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['image_filetype'] : $adm_lang['image_filetype'];
	    break;
    }

    return false;
}


function upload_image(&$error, &$error_msg, $filename, $image_file, $image_filesize, $image_filetype, $path, $image_cat, $create_thumbnail = '0')
{
    global $config, $adm_lang, $tonjaw_root_path;

    $ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

    //
    // Validate image
    //
    // Existance
    $newfile = $path . $filename;
    //echo $newfile . ' ' . tonjaw_realpath($newfile); exit;

    if ( file_exists(@tonjaw_realpath($newfile)))
    {

	$validate = sprintf($adm_lang['image_exist'], $filename);
	//echo $validate; exit;
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $validate : $validate;

    }
    ///echo 'ra ono sing podo. aman.'; exit;
    
    // Filesize
    if ( $image_filesize == 0 || $image_filesize > $config[$image_cat . '_filesize'] )
    {
	$validate = sprintf($adm_lang['image_filesize'], round($config[$image_cat . '_filesize'] / 1024));

	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $validate : $validate;
    }

    // Filetype
    $imgtype = check_image_type($image_filetype, $error, $error_msg);

    list($width, $height) = @getimagesize($image_file);

    //echo 'width: ' . $width . '<br>height: ' . $height; exit;
    // Resolution
    if ( $width > $config[$image_cat . '_width'] || $height > $config[$image_cat . '_height'] )
    {
	$validate = sprintf($adm_lang['image_resolution'], $config[$image_cat . '_width'], $config[$image_cat . '_height']);

	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $validate : $validate;

    }

    //
    // Write to the disk
    //
    if ( !$error )
    {
	if ( @$ini_val('open_basedir') != '' )
	{
	    if ( @phpversion() < '4.0.3' )
	    {
		die('open_basedir is set and your PHP version does not allow move_uploaded_file');
	    }

	    $move_file = 'move_uploaded_file';
	}
	else
	{
	    $move_file = 'copy';
	}

	if (!is_uploaded_file($image_file))
	{
	    die('Unable to upload file');
	}

	$move_file($image_file, $newfile);

	@chmod($newfile, 0777);

	//
	//Create Thumbnail
	//
	if( $create_thumbnail )
	{

	    // Preparing function for each filetypes
	    switch ($image_filetype)
	    {
		case 'image/jpeg':
		case 'image/jpg':
		    $imagecreatefrom = 'imagecreatefromjpeg';
		    $imageoutput = 'imagejpeg';
		    break;

		case 'image/gif':
		    $imagecreatefrom = 'imagecreatefromgif';
		    $imageoutput = 'imagegif';
		    break;

		default :
		    $imagecreatefrom = 'imagecreatefrompng';
		    $imageoutput = 'imagepng';
		    break;
	    }

	    $thumbnail = $path . $config['thumbnail_path'] . $config['thumbnail_prefix'] . $filename;
	    $size = getimagesize($newfile);

	    $thumbnail_height = $size[1] * ($config['thumbnail_width'] / $size[0]);

	    $image_source = $imagecreatefrom($newfile);

	    $image_destination = imagecreatetruecolor($config['thumbnail_width'], $thumbnail_height);

	    imagecopyresampled ($image_destination, $image_source, 0, 0, 0, 0, $config['thumbnail_width'], $thumbnail_height, $size[0], $size[1]);

	    $imageoutput($image_destination, $thumbnail,100);
	    imagedestroy($image_source);
	    imagedestroy($image_destination);
	}
    }

    return $filename; // $avatar_sql;
}

function delete_image($image_filename, $path, $delete_thumbnail = '0')
{
    global  $config;

    $image_file = basename($image_filename);
    
    if ( @file_exists(@tonjaw_realpath($path . $image_file)) )
    {
	@unlink($path . $image_file);
    }

    // Delete thumbnail
    if ( $delete_thumbnail )
    {
	$image_file = $config['thumbnail_prefix'] . $image_filename;
	$image_file = basename($image_file);

	if ( @file_exists(@tonjaw_realpath($path .$config['thumbnail_path'] . $image_file)) )
	{
	    @unlink($path .$config['thumbnail_path'] . $image_file);
	}
    }

    return;
}

function getCollectionList()
{
    global $config, $tonjaw_root_path;

    $collections = array();

    // add global collections
    if ( !is_dir($tonjaw_root_path . $config['media_path']) ) return $collections;

    $dirhandle = opendir($tonjaw_root_path . $config['media_path']);

    $i = 0;
    while ( false !== ($dirname = readdir($dirhandle)) ) 
    {
	// only add non-numeric (numeric=private) dirs
	if ( ($dirname != '.') && ($dirname != '..') && is_image($dirname) )
	{
	    $collections[$i] = $dirname;
	    $i++;
	}
    }

    closedir($dirhandle);

    return $collections;

}

function get_image_header($file)
{
    $image_header = array();

    //$exif = exif_read_data($file, 'IFD0');
    $exif = @exif_read_data($file, 0, true);
    $image_header['flag'] = ($exif === false) ? false: true;

    if ($image_header['flag'])
    {
	$exif = @exif_read_data($file, 0, true);

	$date = explode(' ', $exif['EXIF']['DateTimeOriginal']);

	//$image_header['datetime'] = !$date[1] ? (empty($exif['IFD0']['DateTime']) ? $exif['FILE']['FileDateTime'] : $exif['IFD0']['DateTime']) : $exif['EXIF']['DateTimeOriginal'];
	
	if( !$date[1] )
	{
	    if ( !$exif['IFD0']['DateTime'] )
	    {
		$image_header['datetime'] = $exif['FILE']['FileDateTime'];
	    }
	    else
	    {
		$image_header['datetime'] = $exif['IFD0']['DateTime'];
	    }
	
	}
	else
	{
	    $image_header['datetime'] = $exif['EXIF']['DateTimeOriginal'];
	}


	//$image_header['datetime'] = empty($exif['EXIF']['DateTimeOriginal']) ? (empty($exif['IFD0']['DateTime']) ? $exif['FILE']['FileDateTime'] : $exif['IFD0']['DateTime']) : $exif['EXIF']['DateTimeOriginal'];

	//echo date('d m Y H:i:s', $image_header['datetime']); exit;
	$image_header['make'] = $exif['IFD0']['Make'];
	$image_header['model'] = $exif['IFD0']['Model'];
    }


    return $image_header;
}

?>