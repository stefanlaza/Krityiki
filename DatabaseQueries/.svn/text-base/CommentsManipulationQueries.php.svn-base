<?php
/* 
	DESCRIPTION: This function is used when adds comment, it records it and increases the counter
		of users comments column in USER table.
	WHEN TO USE: When there is a need to save comment.
	PARAMETERS: $con - connection  to database,
				$userID - integer representing ID of user,
				$reviewID - integer representing ID of review on which user
					is commenting, should be null if its comment on question of the day
				$comment - string representing comment,
				$type - type of the comment, possible choices are
					$COMMENT_ON_REVIEW - for comments posted on reviews,
					$COMMENT_ON_QUESTION - for comment posted on question of the day,
				$questionID - integer representing ID of question of the day on which
					user posted comment, should be null if its comment on the review
	RETURNS: $COMMENT_CREATED if everything went successfully.
	EXAMPLE: $flag = AddNewComment($con, 14,null,"komentar na review",$COMMENT_ON_QUESTION,4);
*/
function AddNewComment($con,$userID,$reviewID,$comment,$type,$questionID)
{
	//global keywords
	global $TABLE_COMMENTS,$COMMENT_ID_COLUMN, $COMMENT_USER_FK_COLUMN, 
		$COMMENT_REVIEW_FK_COLUMN, $COMMENT_BODY_COLUMN, $COMMENT_COMMENTED_ON,
		$COMMENT_TYPE_COLUMN,$COMMENT_QUESTION_ID_COLUMN,$COMMENT_CREATED,
		$COMMENT_ON_REVIEW;
	//defining query to add comment
	$query = "INSERT INTO ".$TABLE_COMMENTS."(".$COMMENT_ID_COLUMN.", ".$COMMENT_USER_FK_COLUMN.", ".$COMMENT_REVIEW_FK_COLUMN.", "
		.$COMMENT_BODY_COLUMN.", ".$COMMENT_COMMENTED_ON.", ".$COMMENT_TYPE_COLUMN.", "
		.$COMMENT_QUESTION_ID_COLUMN.") VALUES (NULL,:userID,:reviewFK,:comment,now(),:type,:questionID)";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID" => $userID,
		":reviewFK" => $reviewID,
		":comment" => $comment,
		":type" => $type,
		":questionID" => $questionID ));
	//increase number of users comments
	IncreaseNumberOfUsersComments($con,$userID);
	//returning the flag
	return $COMMENT_CREATED;
}
/* 
	DESCRIPTION: This function is used when all comments of some review or
		question of the day should be listed and sorted from oldest to newest.
	WHEN TO USE: When there is a need to return all comments of a review/question of the day sorted.
	PARAMETERS: $con - connection to database
				$id - integer representing ID of review/question of the day,
				$type - type of the comment, possible choices are
					$COMMENT_ON_REVIEW - for comments on reviews,
					$COMMENT_ON_QUESTION - for comment on question of the day.
	RETURNS: null - if there are no comments,
			comment - if there is only one comment,
			array of comments - if there is more than one comment.
	EXAMPLE: $comments = SelectCommentsForReview($con,14,$COMMENT_ON_QUESTION);
*/
function SelectCommentsForReview($con,$id,$type)
{
	//global keywords
	global $TABLE_COMMENTS, $COMMENT_REVIEW_FK_COLUMN, $COMMENT_COMMENTED_ON,
		$COMMENT_TYPE_COLUMN,$COMMENT_QUESTION_ID_COLUMN,$COMMENT_ON_REVIEW;
	//defining query to select comments
	$query = "SELECT * FROM ".$TABLE_COMMENTS." WHERE ";
	//if comment is for review
	if ($type==$COMMENT_ON_REVIEW)
	{
		$query.=$COMMENT_REVIEW_FK_COLUMN."=:id";
	}
	//if comment is for question of the day
	else
	{	
		$query.=$COMMENT_QUESTION_ID_COLUMN."=:id";
	}
	$query.=" ORDER BY ".$COMMENT_COMMENTED_ON." ASC";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id' => $id
	));
	//get result
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there are no rows returned return null
	if (count($result)==0)
	{
		return null;
	}
	//if one row returned fetch it and return it
	else if (count($result)==1)
	{
		$row = $result[0];
		return $row;
	}
	//if more than one row returned, return them all
	else
	{
		return $result;
	}
}
/* 
	DESCRIPTION: This function is used when comment is deleted.
	WHEN TO USE: When there is a need to delete comment.
	PARAMETERS: $con - connection to database,
				$commentID - integer representing ID of comment,
				$userID - integer representing ID of user whos comment is.
	RETURNS: COMMENT_DELETED - if everything went well.
	EXAMPLE: $flag = DeleteComment($con,14,1);
*/
function DeleteComment($con,$commentID,$userID)
{
	//global keywords
	global $TABLE_COMMENTS, $COMMENT_ID_COLUMN, $COMMENT_DELETED;
	//defining query to select comments
	$query = "DELETE FROM ".$TABLE_COMMENTS." WHERE ".$COMMENT_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id' => $commentID
	));
	//decrease users comments
	DecreaseUsersComments($con,$userID);
	//return flag
	return $COMMENT_DELETED;
}
/* 
	DESCRIPTION: This function is used when number of comments for review/question of the day has to be found.
	WHEN TO USE: When there is a need to count comments for a review/question of the day.
	PARAMETERS: $con - connection to database,
				$id - integer representing ID of review,
				$type - type of the comment, possible choices are
					$COMMENT_ON_REVIEW - for comments on reviews,
					$COMMENT_ON_QUESTION - for comment on question of the day.
	RETURNS: integer declaring number of comments in review/question of the day.
	EXAMPLE: $count = CountCommentsForReview($con,14,1);
*/
function CountCommentsForReview($con,$id,$type)
{
	//global keywords
	global $TABLE_COMMENTS, $COMMENT_REVIEW_FK_COLUMN, $COMMENT_COMMENTED_ON,
		$COMMENT_TYPE_COLUMN,$COMMENT_QUESTION_ID_COLUMN,$COMMENT_ON_REVIEW;
	//defining query to select comments
	$query = "SELECT COUNT(*) FROM ".$TABLE_COMMENTS." WHERE ";
	if ($type==$COMMENT_ON_REVIEW)
	{
		$query.=$COMMENT_REVIEW_FK_COLUMN."=:id";
	}
	else
	{
		$query.=$COMMENT_QUESTION_ID_COLUMN."=:id";
	}
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id' => $id
	));
	//gettin rows
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//get result
	$count = $result[0];
	//return number of rows
	return $count;
}
/* 
	DESCRIPTION: This function is used when comment has been edited.
	WHEN TO USE: When there is a need to edit comment.
	PARAMETERS: $con - connection to database,
				$commentID - integer representing ID of comment,
				$$body - string representing text of comment.
	RETURNS: $COMMENT_UPDATED if everything went well.
	EXAMPLE: $flag = UpdateComment($con, "changes",1);
*/
function UpdateComment($con,$body,$commentID)
{
	//global keywords
	global $TABLE_COMMENTS, $COMMENT_BODY_COLUMN, $COMMENT_ID_COLUMN, $COMMENT_UPDATED;
	//defining query to select comments
	$query = "UPDATE ".$TABLE_COMMENTS." SET ".$COMMENT_BODY_COLUMN."=:body WHERE "
			.$COMMENT_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':body' => $body,
		':id' => $commentID
	));
	//return flag
	return $COMMENT_UPDATED;
}
?>