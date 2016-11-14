<?php 
$change="";
$abc="";

function getExtension($str) 
{
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

function uploadAvatar($imageFILE,$max_file_size,$avatarType)
{
    global $UNKNOWN_IMAGE_EXTENSION, $FILE_SIZE_LIMIT_EXCEEDED,$AVATAR_UPLOADED_SUCCESFULLY,
			$REVIEW_AVATAR,$USER_AVATAR,$CATEGORY_AVATAR,$HOME_REVIEW_AVATAR_WIDTH, $HOME_REVIEW_AVATAR_HEIGHT,$HOME_REVIEW_AVATAR_PATH,
			$ALL_REVIEW_AVATAR_WIDTH, $ALL_REVIEW_AVATAR_HEIGHT,$ALL_REVIEW_AVATAR_PATH,
			$BIG_REVIEW_AVATAR_WIDTH, $BIG_REVIEW_AVATAR_HEIGHT,$BIG_REVIEW_AVATAR_PATH,
			$HOME_USER_AVATAR_WIDTH, $HOME_USER_AVATAR_HEIGHT,$HOME_USER_AVATAR_PATH,
			$BIG_USER_AVATAR_WIDTH, $BIG_USER_AVATAR_HEIGHT,$BIG_USER_AVATAR_PATH,
			$CATEGORY_AVATAR_WIDTH, $CATEGORY_AVATAR_HEIGHT,$CATEGORY_AVATAR_PATH;
    $errors=0;
    $image =$imageFILE["name"];
    $uploadedfile = $imageFILE['tmp_name'];
    if ($image) 
    { 	
        $filename = stripslashes($imageFILE['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
       	
        if (($extension != "jpg") && ($extension != "jpeg") && 
        ($extension != "png") && ($extension != "gif")) 
        {
            return $UNKNOWN_IMAGE_EXTENSION;
            $errors=1;
        }
        else
        {
            $size=filesize($imageFILE['tmp_name']);
            
            if ($size > $max_file_size*1024)
            {
                return $FILE_SIZE_LIMIT_EXCEEDED;
                $errors=1;
            }
            if($extension=="jpg" || $extension=="jpeg" )
            {
                $uploadedfile = $imageFILE['tmp_name'];
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if($extension=="png")
            {
                $uploadedfile = $imageFILE['tmp_name'];
                $src = imagecreatefrompng($uploadedfile);
            }
            else 
            {
                $src = imagecreatefromgif($uploadedfile);
            }
            //echo $scr;
            list($width,$height)=getimagesize($uploadedfile);
			//$tmp=imagecreatetruecolor($width,$height);
            //imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
            //$filename = $path_flag.$imageFILE['name'];
            //imagejpeg($tmp,$filename,100);
            //imagedestroy($src);
            //imagedestroy($tmp);
            //$flag_add_image = AddNewImage($imageFILE['name']);
            //if ($flag_add_image != $IMAGE_REGISTERED)
            //{
            //    echo "Error adding avatar reference to database";
            //}
			$nameOfFile = time();
			$nameWithExtension = $nameOfFile.".".$extension;
			if ($avatarType == $REVIEW_AVATAR)
			{
				Crop($src,$nameOfFile,$extension,$HOME_REVIEW_AVATAR_WIDTH, $HOME_REVIEW_AVATAR_HEIGHT,$HOME_REVIEW_AVATAR_PATH,$width,$height);
				Crop($src,$nameOfFile,$extension,$ALL_REVIEW_AVATAR_WIDTH, $ALL_REVIEW_AVATAR_HEIGHT,$ALL_REVIEW_AVATAR_PATH,$width,$height);
				Crop($src,$nameOfFile,$extension,$BIG_REVIEW_AVATAR_WIDTH, $BIG_REVIEW_AVATAR_HEIGHT,$BIG_REVIEW_AVATAR_PATH,$width,$height);
				$flag=AddImageDatabaseReference($nameWithExtension);
				imagedestroy($src);
			}
			else if ($avatarType == $USER_AVATAR)
			{
				Crop($src,$nameOfFile,$extension,$HOME_USER_AVATAR_WIDTH, $HOME_USER_AVATAR_HEIGHT,$HOME_USER_AVATAR_PATH,$width,$height);
				Crop($src,$nameOfFile,$extension,$BIG_USER_AVATAR_WIDTH, $BIG_USER_AVATAR_HEIGHT,$BIG_USER_AVATAR_PATH,$width,$height);
				$flag=AddImageDatabaseReference($nameWithExtension);
				imagedestroy($src);
			}
			else if($avatarType == $CATEGORY_AVATAR)
			{
				Crop($src,$nameOfFile,$extension,$CATEGORY_AVATAR_WIDTH, $CATEGORY_AVATAR_HEIGHT,$CATEGORY_AVATAR_PATH,$width,$height);
				$flag=AddImageDatabaseReference($nameWithExtension);
				imagedestroy($src);
			}
        }
        
    }
    if (!$errors)
    {
        return $flag;
    }
}
function Crop($src,$imageSourceName,$extension,$cropWidth, $cropHeight,$path_flag,$width,$height)
{
	if (($width/$cropWidth)>($height/$cropHeight))
	{
		$newwidth = $width-($width-$cropWidth);
		$newheight = ($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
	}
	else
	{
		$newheight = $height - ($height - $cropHeight);
		$newwidth = ($width/$height)*$newheight;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
	 
	}
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$filename = $path_flag."/".$imageSourceName.".".$extension;
	imagejpeg($tmp,$filename,100);
	imagedestroy($tmp);
	
}
function AddImageDatabaseReference($imageName)
{
	$con=connect();
	$flag_add_image = AddNewImage($con,$imageName);
	$con=null;
	return $flag_add_image;
}
?>
