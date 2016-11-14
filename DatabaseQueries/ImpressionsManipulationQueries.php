<?php
/* 
	DESCRIPTION: This function records new impression in database and increases number of likes/dislikes in review.
	WHEN TO USE: When impression should be registered.
	PARAMETERS: $con - connection to database,
				$userID - integer representing the ID of user which sent impression,
				$reviewID - integer representing the ID of review which user liked/disliked,
				$choice - $LIKE - if user liked review, $DISLIKE - if user disliked review.
	RETURNS: $IMPRESSION_ADDED - if impression was registered successfully.
	EXAMPLE: $flag = AddImpression($con,4,23,$LIKE); 
*/
function AddImpression($con,$userID, $reviewID, $choice)
{
	//global keywords
	global $TABLE_IMPRESSIONS,$IMPRESSIONS_ID_COLUMN, $IMPRESSIONS_LIKED_COLUMN, 
		$IMPRESSIONS_USER_FK_COLUMN, $IMPRESSIONS_REVIEW_FK_COLUMN, $IMPRESSION_ADDED,
		$TABLE_REVIEW, $REVIEW_ID_COLUMN,$REVIEW_LIKES_COLUMN,$REVIEW_DISLIKES_COLUMN,
		$DISLIKE;
	//defining query to insert impression
	$query = "INSERT INTO ".$TABLE_IMPRESSIONS." (".$IMPRESSIONS_ID_COLUMN.", ".$IMPRESSIONS_LIKED_COLUMN.", "
			.$IMPRESSIONS_USER_FK_COLUMN.", ".$IMPRESSIONS_REVIEW_FK_COLUMN.") VALUES (NULL,:choice,:userID,:reviewID)";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":choice" => $choice,
		":userID" => $userID,
		":reviewID" => $reviewID
	));
	//defining query to update number of likes or dislikes
	$query = "UPDATE ".$TABLE_REVIEW." SET ";
	if ($choice == $DISLIKE)
		$query.=$REVIEW_DISLIKES_COLUMN."=".$REVIEW_DISLIKES_COLUMN."+1";
	else
		$query.=$REVIEW_LIKES_COLUMN."=".$REVIEW_LIKES_COLUMN."+1";
	$query.=" WHERE ".$REVIEW_ID_COLUMN."=:reviewID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":reviewID" => $reviewID
	));
	//return flag
	return $IMPRESSION_ADDED;
}
/* 
	DESCRIPTION: This function checks if user liked/disliked review.
	WHEN TO USE: When there is a need to check if user liked/disliked review.
	PARAMETERS: $con - connection to database,
				$userID - integer representing the ID of user,
				$reviewID - integer representing the ID of review to check if user liked/disliked.
	RETURNS: null - if user didn't created impression,
			$LIKE - if user liked,
			$DISLIKE - if user disliked.
	EXAMPLE: $flag = DidUserLikedReview($con,4,23); 
*/
function DidUserLikedReview($con,$userID, $reviewID)
{
	//global keywords
	global $TABLE_IMPRESSIONS, $IMPRESSIONS_USER_FK_COLUMN, $IMPRESSIONS_REVIEW_FK_COLUMN,
		$USER_LIKED_REVIEW, $USER_DIDNT_LIKED_REVIEW,$LIKE,$DISLIKE;
	//defining query to insert impression
	$query = "SELECT * FROM ".$TABLE_IMPRESSIONS." WHERE ".$IMPRESSIONS_USER_FK_COLUMN."=:userID"
			." AND ".$IMPRESSIONS_REVIEW_FK_COLUMN."=:reviewID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID" => $userID,
		":reviewID" => $reviewID
	));
	//get result
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there are no rows returned return null
	if (count($result)==0)
	{
		return null;
	}
	//if one row returned fetch it and return it
	else 
	{
		$row = $result[0];
		if ($row[1]==$LIKE)
			return $LIKE;
		else
			return $DISLIKE;
	}
}
?>