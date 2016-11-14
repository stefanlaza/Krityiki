<?php
/* 
	DESCRIPTION: This function records new review in database.
	WHEN TO USE: When review is added.
	PARAMETERS: $con - connection to database,
				$userID - integer representing the ID of user which added the review,
				$name - string representing the name of the added review,
				$shortDesc - string representing the short description,
				$text - string representing review,
				$avatarID - ID of image which is connected with review,
				$type - $REGULAR_REVIEW if it is regular review,
						$LETTER_OF_COMMITTEE if it is letter of committee.
				$approved - 1 if review is approved or if it is letter of committee, or 0 if not.
				$category - ID of category in which review belongs.
	RETURNS: $REVIEW_CREATED - if review was created successfully.
	EXAMPLE: $flag = AddNewReview($con, 14, "Name of review", "short desc", "text text text", 1, $REGULAR_REVIEW, 1, 1); 
*/
function AddNewReview($con,$userID, $name, $shortDesc, $text, $avatarID, $type, $approved, $category)
{
	//global keywords
	global $TABLE_REVIEW, $REVIEW_ID_COLUMN, $REVIEW_USER_FK_COLUMN, $REVIEW_NAME_COLUMN,
		$REVIEW_SHORT_DESCRIPTION_COLUMN, $REVIEW_BODY_COLUMN, $REVIEW_AVATAR_FK_COLUMN,
		$REVIEW_LIKES_COLUMN, $REVIEW_DISLIKES_COLUMN, $REVIEW_TYPE_COLUMN, 
		$REVIEW_APPROVED_COLUMN, $REVIEW_POSTED_ON_COLUMN, $REVIEW_CATEGORY_FK_COLUMN,$REVIEW_CREATED;
	//define query to insert review
	$query = "INSERT INTO ".$TABLE_REVIEW." (".$REVIEW_ID_COLUMN.", ".$REVIEW_USER_FK_COLUMN.", ".$REVIEW_NAME_COLUMN.", "
		.$REVIEW_SHORT_DESCRIPTION_COLUMN." , ".$REVIEW_BODY_COLUMN.", ".$REVIEW_AVATAR_FK_COLUMN.", "
		.$REVIEW_LIKES_COLUMN.", ".$REVIEW_DISLIKES_COLUMN.", ".$REVIEW_TYPE_COLUMN.", "
		.$REVIEW_APPROVED_COLUMN.", ".$REVIEW_POSTED_ON_COLUMN.", ".$REVIEW_CATEGORY_FK_COLUMN.") 
		VALUES (NULL,:userID, :name, :shortDesc, :text, :avatarID, 0, 0, :type, :approved, now(), :categoryID)";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID" => $userID,
		":name" => $name,
		":shortDesc" => $shortDesc,
		":text" => $text,
		"avatarID" => $avatarID,
		":type" => $type,
		":approved" => $approved,
		":categoryID" => $category));
	
	//if review is approved increase number of reviews in category
	if ($approved==1)
	{
		IncreaseNumberOfReviews($con,$category);
		IncreaseNumberOfUsersReviews($con,$userID);
	}
	//returning the flag
	return $REVIEW_CREATED;
}
/* 
	DESCRIPTION: This function returns review by ID from database.
	WHEN TO USE: When review has to be shown.
	PARAMETERS: $con - connection to database,
				$reviewID - integer representing the ID of review which has to be returned.
	RETURNS: entire row representing the review.
	EXAMPLE: $review = ReturnReviewById($con,3);
*/
function ReturnReviewById($con,$reviewID)
{
	
	//global keywords
	global $TABLE_REVIEW, $REVIEW_ID_COLUMN;
	//define query to select review
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_ID_COLUMN."=:id LIMIT 1";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":id" => $reviewID
	));
	//getting row
	$row = $statement->fetch(PDO::FETCH_BOTH);
	//returning the result
	return $row;
}
/* 
	DESCRIPTION: This function returns review by its popularity, based on number of likes
		and difference of number of likes and dislikes.
	WHEN TO USE: When most popular review has to be shown.
	PARAMETERS: $con - connection to database.
	RETURNS: entire row representing the review.
	EXAMPLE: $review = ReturnMostPopularReview($con);
*/
function ReturnMostPopularReview($con)
{
	//global keywords
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN,$REVIEW_LIKES_COLUMN,
		$REVIEW_DISLIKES_COLUMN,$REGULAR_REVIEW,$REVIEW_TYPE_COLUMN;
	//define query to select review
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE (".$REVIEW_APPROVED_COLUMN."=1 AND ".$REVIEW_TYPE_COLUMN."="
			.$REGULAR_REVIEW.") ORDER BY ".$REVIEW_LIKES_COLUMN." DESC, (".$REVIEW_LIKES_COLUMN."-".$REVIEW_DISLIKES_COLUMN.") DESC  LIMIT 1";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//getting row
	$row = $statement->fetch(PDO::FETCH_BOTH);
	//returning the result
	return $row;
}
/* 
	DESCRIPTION: This function returns reviews from specified category sorted from newest to oldest.
	WHEN TO USE: When its needed to show all reviews from category.
	PARAMETERS: $con - connection to database,
				$categoryID - integer representing category ID whos reviews are listed,
				$from - index from which to return reviews,
				$count - how much reviews maximally to return.
	RETURNS: NULL - if category has no reviews,
			review - if one reviews is in category,
			array of reviews - if more than one review is in category.
	EXAMPLE: $review = ReturnReviewsFromCategory($con,1,0,2);
*/
function ReturnReviewsFromCategory($con,$categoryID,$from,$count)
{
	//global keywords
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN,$REGULAR_REVIEW,$REVIEW_TYPE_COLUMN,
		$REVIEW_POSTED_ON_COLUMN,$REVIEW_CATEGORY_FK_COLUMN;
	//define query to select review
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ".
			$REVIEW_CATEGORY_FK_COLUMN."=:categoryID  AND ".$REVIEW_TYPE_COLUMN."="
			.$REGULAR_REVIEW." ORDER BY ".$REVIEW_POSTED_ON_COLUMN." DESC LIMIT :from,:to";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":categoryID" => $categoryID,
		":from" => $from,
		":to" => $count
	));
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there are no reviews return null
	if (count($result)==0)
	{
		return null;
	}
	//if one return row
	else if (count($result)==1)
	{
		$row = $result[0];
		return $row;
	}
	//otherwise return array
	else
	{
		//returning the result
		return $result;
	}
}
/* 
	DESCRIPTION: This function returns number of reviews in category.
	WHEN TO USE: When its needed to count reviews.
	PARAMETERS: $con - connection to database,
				$categoryID - id of category.
	RETURNS: number of reviews in category.
	EXAMPLE: $count = ReturnNumberOfReviewsFromCategory($con, 1);
*/
function ReturnNumberOfReviewsFromCategory($con, $categoryID)
{
	//global keywords
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN,$REGULAR_REVIEW,$REVIEW_TYPE_COLUMN,
		$REVIEW_POSTED_ON_COLUMN,$REVIEW_CATEGORY_FK_COLUMN;
	//define query to select review
	$query = "SELECT COUNT(*) FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ".
			$REVIEW_CATEGORY_FK_COLUMN."=:categoryID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":categoryID" => $categoryID
	));
	//getting row
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//returning result
	return $result[0];
}
/* 
	DESCRIPTION: This function returns two latest reviews.
	WHEN TO USE: When its needed to show two latest reviews.
	PARAMETERS: $con - connection to database.
	RETURNS: array of reviews - if more than one review is in category.
	EXAMPLE: $reviews = ReturnTwoLatestReviews($con);
*/
function ReturnTwoLatestReviews($con)
{
	//global keywords
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN,$REGULAR_REVIEW,$REVIEW_TYPE_COLUMN,
		$REVIEW_POSTED_ON_COLUMN;
	//define query to select reviews
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ".$REVIEW_TYPE_COLUMN."=".$REGULAR_REVIEW
			." ORDER BY ".$REVIEW_POSTED_ON_COLUMN." DESC LIMIT 2";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//returning the result
	return $result;
}
/* 
	DESCRIPTION: This function returns reviews which contain words which user searched for.
	WHEN TO USE: When needed to search all reviews based on a condition.
	PARAMETERS: $con - connection to database,
				$condition - string representing the condition to search for.
				If condition has more than one word it should be used as 'word1%word2%word3',
				this way it returns reviews which contain words in defined order.
	RETURNS: null - if no reviews contain search condition,
			 reveiw - if there is only one review which satisfies condition,
			 array - if more more than one review contains condition.
	EXAMPLE: $reviews = ReturnSearchOfReviews($con,"word"); OR
			 $reviews = ReturnSearchOfReviews($con,"word1%word2%word3");
*/
function ReturnSearchOfReviews($con,$condition)
{
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN,$REVIEW_NAME_COLUMN,
		$REVIEW_SHORT_DESCRIPTION_COLUMN, $REVIEW_BODY_COLUMN;
	//define query to select reviews
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ((".$REVIEW_NAME_COLUMN." LIKE :con1) OR "
			."(".$REVIEW_SHORT_DESCRIPTION_COLUMN." LIKE :con2) OR (".$REVIEW_BODY_COLUMN." LIKE :con3))";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":con1" => '%'.$condition.'%',
		":con2" => '%'.$condition.'%',
		":con3" => '%'.$condition.'%'
	));
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if no rows returned return null
	if (count($result)==0)
	{
		return null;
	}
	//if one row selected return it
	else if (count($result)==1)
	{
		$row = $result[0];
		return $row;
	}
	//else return all rows
	else
	{
		return $result;
	}
}
/* 
	DESCRIPTION: This function returns reviews which contain words which user searched for and
		are in defined category.
	WHEN TO USE: When needed to search reviews based on a condition and category.
	PARAMETERS: $con - connection to database,
				$condition - string representing the condition to search for.
					If condition has more than one word it should be used as 'word1%word2%word3',
					this way it returns reviews which contain words in defined order,
				$categoryID - integer representing ID of category to search in.
	RETURNS: null - if no reviews contain search condition,
			 reveiw - if there is only one review which satisfies condition,
			 array - if more more than one review contains condition.
	EXAMPLE: $reviews = ReturnSearchOfReviewsFromCategory($con,"word",1); OR
			 $reviews = ReturnSearchOfReviewsFromCategory($con,"word1%word2%word3",1);
*/
function ReturnSearchOfReviewsFromCategory($con,$condition,$categoryID)
{
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN,$REVIEW_NAME_COLUMN,
		$REVIEW_SHORT_DESCRIPTION_COLUMN, $REVIEW_BODY_COLUMN,$REVIEW_CATEGORY_FK_COLUMN;
	
	//define query to select reviews
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ".$REVIEW_CATEGORY_FK_COLUMN."=:categoryID".
			" AND ((".$REVIEW_NAME_COLUMN." LIKE :con1) OR"
			."(".$REVIEW_SHORT_DESCRIPTION_COLUMN." LIKE :con2) OR (".$REVIEW_BODY_COLUMN." LIKE :con3))";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":categoryID" => $categoryID,
		":con1" => '%'.$condition.'%',
		":con2" => '%'.$condition.'%',
		":con3" => '%'.$condition.'%'
	));
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if no rows returned return null
	if (count($result)==0)
	{
		return null;
	}
	//if one row selected return it
	else if (count($result)==1)
	{
		$row = $result[0];
		return $row;
	}
	//else return all rows
	else
	{
		return $result;
	}
}
/* 
	DESCRIPTION: This function returns user's reviews.
	WHEN TO USE: When needed to select all users reviews.
	PARAMETERS: $con - connection to database,
				$userID - integer representing users ID.
	RETURNS: null - if no reviews are found,
			 reveiw - if there is only one review,
			 array - if more more than one review.
	EXAMPLE: $reviews = ReturnUsersReviews($con,2);
*/
function ReturnUsersReviews($con, $userID)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_USER_FK_COLUMN, $REVIEW_APPROVED_COLUMN;
	//define query to select reviews
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ".$REVIEW_USER_FK_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID" => $userID
	));
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if no rows returned return null
	if (count($result)==0)
	{
		return null;
	}
	//if one row selected return it
	else if (count($result)==1)
	{
		$row = $result[0];
		return $row;
	}
	//else return all rows
	else
	{
		return $result;
	}
}
/* 
	DESCRIPTION: This function returns number of user's reviews.
	WHEN TO USE: When needed to count all users reviews.
	PARAMETERS: $con - connection to database,
				$userID - integer representing users ID.
	RETURNS: integer representing number of reviews.
	EXAMPLE: $reviews = ReturnCountUsersReviews($con,2);
*/
function ReturnCountUsersReviews($con, $userID)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_USER_FK_COLUMN, $REVIEW_APPROVED_COLUMN;
	//define query to select reviews
	$query = "SELECT COUNT(*) FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=1 AND ".$REVIEW_USER_FK_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID" => $userID
	));
	//getting row
	$result = $statement->fetch(PDO::FETCH_BOTH);
	return $result[0];
}
/* 
	DESCRIPTION: This function updates reviews.
	WHEN TO USE: When needed to save changes to review.
	PARAMETERS: $con - connection to database,
				$reviewID - integer representing ID of review to update,
				$name - string representing name of the review,
				$shortDescription - string representing short description,
				$reviewBody - string representing review,
				$avatarID - ID of image stored in IMAGES table, can be null,
				$type - $REGULAR_REVIEW if review is regular,
					$LETTER_OF_COMMITTEE - if it is letter of committee,
				$categoryID - ID of category of the review.
	RETURNS: REVIEW_UPDATED if everything went well.
	EXAMPLE: $flag = UpdateReview($con,6,"newName","changes","newText",null,0,1);
*/
function UpdateReview($con,$reviewID,$name,$shortDescription,$reviewBody,$avatarID,$type,$categoryID)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_NAME_COLUMN, $REVIEW_SHORT_DESCRIPTION_COLUMN, 
		$REVIEW_BODY_COLUMN, $REVIEW_AVATAR_FK_COLUMN, $REVIEW_TYPE_COLUMN, 
		$REVIEW_CATEGORY_FK_COLUMN, $REVIEW_ID_COLUMN,$REVIEW_UPDATED;
	//define query to update review
	$query = "UPDATE ".$TABLE_REVIEW." SET ".$REVIEW_NAME_COLUMN."=:name,".$REVIEW_SHORT_DESCRIPTION_COLUMN."=:shortDesc,"
		.$REVIEW_BODY_COLUMN."=:reviewBody, ".$REVIEW_AVATAR_FK_COLUMN."=:avatarID, ".$REVIEW_TYPE_COLUMN."=:type,"
		.$REVIEW_CATEGORY_FK_COLUMN."=:categoryID WHERE ".$REVIEW_ID_COLUMN."=:reviewID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":name" => $name,
		":shortDesc" => $shortDescription,
		":reviewBody" => $reviewBody,
		":avatarID" => $avatarID,
		":type" => $type,
		":categoryID" =>$categoryID,
		":reviewID" => $reviewID
	));
	return $REVIEW_UPDATED;
}
/* 
	DESCRIPTION: This function approves review, allows it to be shown to users and increases
		number of reviews in category.
	WHEN TO USE: When administrator/moderator approves it.
	PARAMETERS: $con - connection to database,
				$reviewID - integer representing ID of review to update,
				$categoryID - ID of category of the review,
				$userID - ID of user which wrote review.
	RETURNS: $REVIEW_UPDATED if everything went well.
	EXAMPLE: $flag = ApproveReview($con,0,1,3);
*/
function ApproveReview($con, $reviewID,$categoryID,$userID)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_ID_COLUMN,$REVIEW_APPROVED_COLUMN, $REVIEW_UPDATED;
	//define query to update review
	$query = "UPDATE ".$TABLE_REVIEW." SET ".$REVIEW_APPROVED_COLUMN."=1 WHERE ".$REVIEW_ID_COLUMN."=:reviewID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":reviewID" => $reviewID
	));
	//increaes number of reviews in category
	IncreaseNumberOfReviews($con,$categoryID);
	//increase number of reviews in users statistics
	IncreaseNumberOfUsersReviews($con,$userID);
	return $REVIEW_UPDATED;
}
/* 
	DESCRIPTION: This function declines review and deletes it from database.
	WHEN TO USE: When review should be deleted.
	PARAMETERS: $reviewID - integer representing ID of review to update.
	RETURNS: $REVIEW_DELETED if everything went well.
	EXAMPLE: $flag = DeclineReview($con,1);
*/
function DeclineReview($con,$reviewID)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_ID_COLUMN,$REVIEW_APPROVED_COLUMN, $REVIEW_DELETED;
	//define query to delete review
	$query = "DELETE FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_ID_COLUMN."=:reviewID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":reviewID" => $reviewID
	));
	return $REVIEW_DELETED;
}
/* 
	DESCRIPTION: This function deletes review from database.
	WHEN TO USE: When review should be deleted.
	PARAMETERS: $con - connect to database,
				$reviewID - integer representing ID of review to delete,
				$userID - integer representing ID of user who wrote it,
				$categoryID - integer representing ID of category to which it belongs.
	RETURNS: $REVIEW_DELETED if everything went well.
	EXAMPLE: $flag = DeleteReview($con,1,1,2);
*/
function DeleteReview($con,$reviewID,$userID,$categoryID)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_ID_COLUMN,$REVIEW_APPROVED_COLUMN, $REVIEW_DELETED;
	//define query to delete review
	$query = "DELETE FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_ID_COLUMN."=:reviewID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":reviewID" => $reviewID
	));
	//decrease number of reviews in category
	DecreaseCategoryReviews($con,$categoryID);
	//decrease number of users reviews
	DecreaseUsersReviews($con,$userID);
	return $REVIEW_DELETED;
}
/* 
	DESCRIPTION: This function return unapproved reviews.
	WHEN TO USE: When unapproved reviews should be listed or counted.
	PARAMETERS: $con - connection to database.
	RETURNS: null - if no reviews are found,
			 reveiw - if there is only one review,
			 array - if more more than one review.
	EXAMPLE: $reviews = ReturnUnapprovedReviews($con);
*/
function ReturnUnapprovedReviews($con)
{
	//defining global keywords
	global $TABLE_REVIEW,$REVIEW_APPROVED_COLUMN, $REVIEW_DELETED;
	//define query to select unapproved reviews
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_APPROVED_COLUMN."=0";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if no rows returned return null
	if (count($result)==0)
	{
		return null;
	}
	//if one row selected return it
	else if (count($result)==1)
	{
		$row = $result[0];
		return $row;
	}
	//else return all rows
	else
	{
		return $result;
	}
}
/* 
	DESCRIPTION: This function returns latest letter of committee.
	WHEN TO USE: When active letter of committee has to be returned.
	PARAMETERS: $con - connection to database.
	RETURNS: null - if there is active letter of committee,
			review - if there is review of letter of committee type.
	EXAMPLE: $review = ReturnLetterOfCommittee($con);
*/
function ReturnLetterOfCommittee($con)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_TYPE_COLUMN, $LETTER_OF_COMMITTEE, $REVIEW_POSTED_ON_COLUMN;
	//$define query to select letter of committee
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_TYPE_COLUMN."=".$LETTER_OF_COMMITTEE
			." ORDER BY ".$REVIEW_POSTED_ON_COLUMN." DESC LIMIT 1";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there is none return null
	if (count($result)==0)
		return null;
	//else return row
	else
	{
		$row = $result[0];
		return $row;
	}
}
/* 
	DESCRIPTION: This function returns all letters of committee ordered from newest to oldest.
	WHEN TO USE: When all letters of committee has to be returned.
	PARAMETERS: $con - connection to database
				$from - starting index to limit,
				$count - number of elements to return.
	RETURNS: null - if there is none letter of committee,
			array of reviews - if there are reviews of letter of committee type.
	EXAMPLE: $review = ReturnAllLettersOfCommittee($con);
*/
function ReturnAllLettersOfCommittee($con,$from,$count)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_TYPE_COLUMN, $LETTER_OF_COMMITTEE, $REVIEW_POSTED_ON_COLUMN;
	//$define query to select all letters of committee
	$query = "SELECT * FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_TYPE_COLUMN."=".$LETTER_OF_COMMITTEE
			." ORDER BY ".$REVIEW_POSTED_ON_COLUMN." DESC LIMIT :from, :to";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":from"=>$from,
		":to" =>$count
	));
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there is none return null
	if (count($result)==0)
		return null;
	//else return array
	else
	{
		return $result;
	}
}
/* 
	DESCRIPTION: This function returns number of letters of committee.
	WHEN TO USE: When number of letters of committee has to be returned.
	PARAMETERS: $con - connection to database.
	RETURNS: integer.
	EXAMPLE: $review = ReturnCountLettersOfCommittee($con);
*/
function ReturnCountLettersOfCommittee($con)
{
	//defining global keywords
	global $TABLE_REVIEW, $REVIEW_TYPE_COLUMN, $LETTER_OF_COMMITTEE, $REVIEW_POSTED_ON_COLUMN;
	//$define query to select all letters of committee
	$query = "SELECT COUNT(*) FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_TYPE_COLUMN."=".$LETTER_OF_COMMITTEE;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//getting row
	$result = $statement->fetch(PDO::FETCH_BOTH);
	return $result[0];
}
?>