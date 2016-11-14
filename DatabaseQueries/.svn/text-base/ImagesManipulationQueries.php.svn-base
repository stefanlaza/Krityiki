<?php
/* 
	DESCRIPTION: This function records new image in database.
	WHEN TO USE: When image is uploaded.
	PARAMETERS: $con - connection to database
				$imageName - string representing the URL to the image.
	RETURNS: ID of image if image was registered successfully.
	EXAMPLE: $flag = AddNewImage($con,"myimage.jpg"); 
*/
function AddNewImage($con,$imageName)
{
	//global keywords
	global $TABLE_IMAGES,$IMAGES_URL_COLUMN,$IMAGES_ID_COLUMN,
	$IMAGE_REGISTERED;
	//define query to insert image
	$query = "INSERT INTO ".$TABLE_IMAGES."(".$IMAGES_ID_COLUMN.", ".$IMAGES_URL_COLUMN.") 
			VALUES (NULL,:imageName)";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":imageName" => $imageName
	));
	//returning the flag
	return $con->lastInsertId();
}
/* 
	DESCRIPTION: This function returns existing image from database.
	WHEN TO USE: When image has to be shown.
	PARAMETERS: $con - connection to database,
				$imageID - integer representing the ID of image.
	RETURNS: null - if no image was found, 
			entire row from database.
	EXAMPLE: $image = ReturnImage($con,3); 
*/
function ReturnImage($con,$imageID)
{
	//global keywords
	global $TABLE_IMAGES,$IMAGES_URL_COLUMN,$IMAGES_ID_COLUMN;
	//define query to get the image
	$query = "SELECT * FROM".$TABLE_IMAGES." WHERE ".$IMAGES_ID_COLUMN."=:imageID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":imageID" => $imageID
	));
	//getting row
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//returning the row
	return $result;
}
?>