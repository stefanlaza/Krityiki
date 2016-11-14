<?php
/* 
	DESCRIPTION: This function is used when moderator/administrator adds category, it inserts the 
		category into the database and returns flag for successful action if everything went good.
	WHEN TO USE: When moderators/administrators want to add new category.
	PARAMETERS: $con - connection to database
				$name - string representing name of the category,
				$avatarID - integer representing ID of the image into the IMAGES table,
					can be null if no image was uploaded,
				$shortDescription - string representing short description of category,
				$type - type of the category, possible choices are
					$REGULAR_CATEGORY - for regular cateogry which is always shown,
					$TOPIC_OF_THE_WEEK - for category which is topic of the week,
					$TOPIC_OF_THE_MONTH - for category which is topic of the month,
				$from - string representing date and time from which topic of the week/month is active,
						can be null for regular category,
				$to - string representing date and time until which topic of the week/month is active,
						can be null for regular category.
	RETURNS: $CATEGORY_CREATED if everything went successfully.
	EXAMPLE: $flag = CreateCategory($con,"bla",1,"neki opis", $TOPIC_OF_THE_WEEK, "2012-12-15 01:41:17", "2012-12-12 00:00:00");
*/
function CreateCategory($con,$name,$avatarID,$shortDescription, $type, $from, $to)
{
	//defining keywords
	global $TABLE_CATEGORY,$CATEGORY_ID_COLUMN, $CATEGORY_NAME_COLUMN,
		$CATEGORY_AVATAR_FK_COLUMN, $CATEGORY_SHORT_DESCRIPTION_COLUMN, 
		$CATEGORY_NUMBER_OF_REVIEWS_COLUMN, $CATEGORY_TYPE_COLUMN, $CATEGORY_FROM_COLUMN,
		$CATEGORY_TO_COLUMN, $CATEGORY_ADDED_ON,$REGULAR_CATEGORY,$CATEGORY_CREATED;
	//defining query
	$query = "INSERT INTO ".$TABLE_CATEGORY."(".$CATEGORY_ID_COLUMN.", ".$CATEGORY_NAME_COLUMN.", ".$CATEGORY_AVATAR_FK_COLUMN.", "
		.$CATEGORY_SHORT_DESCRIPTION_COLUMN.", ".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN.", ".$CATEGORY_TYPE_COLUMN.", ".$CATEGORY_FROM_COLUMN.", "
		.$CATEGORY_TO_COLUMN.", ".$CATEGORY_ADDED_ON.") VALUES (NULL,:name,:avatarFK,:shortDesc, 0, :categoryType,:categoryFrom,:categoryTo,
		now())";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":name" => $name,
		":avatarFK" => $avatarID,
		":shortDesc" => $shortDescription,
		":categoryType" => $type,
		":categoryFrom" => $from,
		":categoryTo" => $to ));
	
	//returning the flag
	return $CATEGORY_CREATED;
}
/* 
	DESCRIPTION: This function is used when moderator/administrator deletes category, it deletes the 
		category from the database and returns flag for successful action if everything went good.
	WHEN TO USE: When moderators/administrators wants to delete category.
	PARAMETERS: $con - connection to database,
				$categoryID - integer representing ID of category which needs to be deleted.
	RETURNS: $CATEGORY_DELETED if everything went successfully.
	EXAMPLE: $flag = DeleteCategory($con,3);
*/
function DeleteCategory($con,$categoryID)
{
	//defining keywords
	global $TABLE_CATEGORY,$CATEGORY_ID_COLUMN,$CATEGORY_DELETED;
	//connecting to database
	$con = connect();
	//defining query
	$query = "DELETE FROM ".$TABLE_CATEGORY." WHERE ".$CATEGORY_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":id" => $categoryID));
	
	//returning the flag
	return $CATEGORY_DELETED;
}
/* 
	DESCRIPTION: This function is used when moderator/administrator changes category, it saves 
		changes into the database and returns flag for successful action if everything went good.
	WHEN TO USE: When moderators/administrators want to save changes to the category.
	PARAMETERS: $con - connection to database,
				$categoryID - integer representing ID of category which has to be changed,
				$name - string representing name of the category,
				$avatarID - integer representing ID of the image into the IMAGES table,
					can be null if no image was uploaded,
				$shortDescription - string representing short description of category,
				$type - type of the category, possible choices are
					$REGULAR_CATEGORY - for regular cateogry which is always shown,
					$TOPIC_OF_THE_WEEK - for category which is topic of the week,
					$TOPIC_OF_THE_MONTH - for category which is topic of the month,
				$from - string representing date and time from which topic of the week/month is active,
						can be null for regular category,
				$to - string representing date and time until which topic of the week/month is active,
						can be null for regular category.
	RETURNS: $CATEGORY_UPDATED if everything went successfully.
	EXAMPLE: $flag = UpdateCategory($con,4, "kosarka", 1,"opis", $TOPIC_OF_THE_WEEK, "2012-12-15 01:41:17", "2012-12-12 00:00:00");
*/
function UpdateCategory($con,$categoryID, $name, $avatarID,$shortDescription, $type, $from, $to)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_ID_COLUMN, $CATEGORY_NAME_COLUMN,
		$CATEGORY_AVATAR_FK_COLUMN, $CATEGORY_SHORT_DESCRIPTION_COLUMN, 
		$CATEGORY_TYPE_COLUMN, $CATEGORY_FROM_COLUMN,
		$CATEGORY_TO_COLUMN, $CATEGORY_ADDED_ON,$REGULAR_CATEGORY,$CATEGORY_UPDATED;
	//defining query
	$query = "UPDATE ".$TABLE_CATEGORY." SET ".$CATEGORY_NAME_COLUMN."= :name, "
		 .$CATEGORY_AVATAR_FK_COLUMN."= :avatarFK, ".$CATEGORY_SHORT_DESCRIPTION_COLUMN."= :shortDesc, "
			.$CATEGORY_TYPE_COLUMN."=:categoryType, ".$CATEGORY_FROM_COLUMN."= :categoryFrom, ".$CATEGORY_TO_COLUMN."= :categoryTo "
			."WHERE ".$CATEGORY_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":name" => $name,
		":avatarFK" => $avatarID,
		":shortDesc" => $shortDescription,
		":categoryType" => $type,
		":categoryFrom" => $from,
		":categoryTo" => $to,
		":id" => $categoryID));
	//returning the flag
	return $CATEGORY_UPDATED;
}
/* 
	DESCRIPTION: This function is used to return categories on varies conditions.
	WHEN TO USE: When categories have to be returned.
	PARAMETERS: $con - connection to database,
				$where - string representing the condition for query,
				$limitIndex - integer which is starting index for LIMIT,
				$limitCount - integer which is number of rows to LIMIT.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnCategories($con,"categoryID = 1", 0, 10);
*/
function ReturnCategories($con,$where,$limitIndex,$limitCount)
{
	//global keywords
	global $TABLE_CATEGORY;
	//defining query
	$query = "SELECT * FROM ".$TABLE_CATEGORY." WHERE ".$where." LIMIT ".$limitIndex.",".$limitCount;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
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
	DESCRIPTION: This function is used to return active and previous topics of the month.
	WHEN TO USE: When active and previous topics of the month have to be returned.
	PARAMETERS: $con - connection to database.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnTopicsOfTheMonthForUser($con);
*/
function ReturnTopicsOfTheMonthForUser($con)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_TYPE_COLUMN,$CATEGORY_FROM_COLUMN,$CATEGORY_TO_COLUMN,
		$TOPIC_OF_THE_MONTH;
	//defining query
	$query = "SELECT * FROM ".$TABLE_CATEGORY." WHERE ".$CATEGORY_TYPE_COLUMN."=".$TOPIC_OF_THE_MONTH." AND NOW()>".$CATEGORY_FROM_COLUMN;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
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
	DESCRIPTION: This function is used to return active and previous topics of the week.
	WHEN TO USE: When active and previous topics of the week have to be returned.
	PARAMETERS: $con - connection to database.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnTopicsOfTheWeekForUser($con);
*/
function ReturnTopicsOfTheWeekForUser($con)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_TYPE_COLUMN,$CATEGORY_FROM_COLUMN,$CATEGORY_TO_COLUMN,
		$TOPIC_OF_THE_WEEK;
	//defining query
	$query = "SELECT * FROM ".$TABLE_CATEGORY." WHERE ".$CATEGORY_TYPE_COLUMN."=".$TOPIC_OF_THE_WEEK." AND NOW()>".$CATEGORY_FROM_COLUMN;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
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
	DESCRIPTION: This function is used to return active topic of the week.
	WHEN TO USE: When topic of the week has to be returned.
	PARAMETERS: $con - connection to database.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned.
	EXAMPLE: $result = ReturnActiveTopicOfTheWeek($con);
*/
function ReturnActiveTopicOfTheWeek($con)
{
	//defining keywords
	global $CATEGORY_TYPE_COLUMN,$CATEGORY_FROM_COLUMN,$CATEGORY_TO_COLUMN,
		$TOPIC_OF_THE_WEEK;
	//defining query
	$where = $CATEGORY_TYPE_COLUMN."=".$TOPIC_OF_THE_WEEK." AND NOW()<".$CATEGORY_TO_COLUMN.
		" AND NOW()>".$CATEGORY_FROM_COLUMN;
	//returning topic of the week or null
	return ReturnCategories($con,$where,0,1);
}
/* 
	DESCRIPTION: This function is used to return active topic of the month.
	WHEN TO USE: When topic of the month has to be returned.
	PARAMETERS: None.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned.
	EXAMPLE: $result = ReturnActiveTopicOfTheMonth($con);
*/
function ReturnActiveTopicOfTheMonth($con)
{
	//defining keywords
	global $CATEGORY_TYPE_COLUMN,$CATEGORY_FROM_COLUMN,$CATEGORY_TO_COLUMN,
		$TOPIC_OF_THE_MONTH;
	//defining query
	$where = $CATEGORY_TYPE_COLUMN."=".$TOPIC_OF_THE_MONTH." AND NOW()<".$CATEGORY_TO_COLUMN.
		" AND NOW()>".$CATEGORY_FROM_COLUMN;
	//returning topic of the month or null
	return ReturnCategories($con,$where,0,1);
}
/* 
	DESCRIPTION: This function is used to return range of all topics of the week sorted from now until the begining.
	WHEN TO USE: When range of all topics of the week has to be shown.
	PARAMETERS: $con - connection to database,
				$from - defines index from which to return,
				$count - how many rows are expected to return.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnRangeOfAllTopicsOfTheWeek($con,0,10);
*/
function ReturnRangeOfAllTopicsOfTheWeek($con,$from,$count)
{
	//defining keywords
	global $CATEGORY_TYPE_COLUMN,$CATEGORY_FROM_COLUMN,$CATEGORY_TO_COLUMN,
		$TOPIC_OF_THE_WEEK;
	//defining query
	$where = $CATEGORY_TYPE_COLUMN."=".$TOPIC_OF_THE_WEEK." ORDER BY ".$CATEGORY_FROM_COLUMN." DESC ";
	//returning topics of the week or null
	return ReturnCategories($con,$where,$from,$count);
}
/* 
	DESCRIPTION: This function is used to return range of all topics of the month sorted from now until the begining.
	WHEN TO USE: When range of all topics of the month has to be shown.
	PARAMETERS: $con - connection to database,
				$from - defines index from which to return,
				$count - how many rows are expected to return.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnRangeOfAllTopicsOfTheMonth($con,0,10);
*/
function ReturnRangeOfAllTopicsOfTheMonth($con,$from,$count)
{
	//defining keywords
	global $CATEGORY_TYPE_COLUMN,$CATEGORY_FROM_COLUMN,$CATEGORY_TO_COLUMN,
		$TOPIC_OF_THE_MONTH;
	//defining query
	$where = $CATEGORY_TYPE_COLUMN."=".$TOPIC_OF_THE_MONTH." ORDER BY ".$CATEGORY_FROM_COLUMN." DESC ";
	//returning topics of the month or null
	return ReturnCategories($con,$where,$from,$count);
}
/* 
	DESCRIPTION: This function is used to return most popular categories, sorted by number of reviews in it.
	WHEN TO USE: When need to retrieve most popular categories.
	PARAMETERS: $con - connection to database,
				$count - how many rows are expected to return.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnMostPopularCategories($con,5);
*/
function ReturnMostPopularCategories($con,$count)
{
	//defining keywords
	global $CATEGORY_TYPE_COLUMN, $REGULAR_CATEGORY, 
		$CATEGORY_NUMBER_OF_REVIEWS_COLUMN;
	//defining query
	$where = $CATEGORY_TYPE_COLUMN."=".$REGULAR_CATEGORY." ORDER BY ".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN." DESC ";
	
	//returning most popular categories
	return ReturnCategories($con,$where,0,$count);
}
/* 
	DESCRIPTION: This function is used to return all categories sorted by their name.
	WHEN TO USE: When need to retrieve all categories.
	PARAMETERS: $con - connection to database.
	RETURNS: NULL - if nothing was returned,
			row - if one row was returned,
			array of rows - if more than one row were returned.
	EXAMPLE: $result = ReturnAllCategories($con);
*/
function ReturnAllCategories($con)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_TYPE_COLUMN,$REGULAR_CATEGORY,$CATEGORY_NAME_COLUMN;
	//connecting to database
	$con = connect();
	//defining query
	$query = "SELECT * FROM ".$TABLE_CATEGORY." WHERE ".$CATEGORY_TYPE_COLUMN."=".$REGULAR_CATEGORY.
		" ORDER BY ".$CATEGORY_NAME_COLUMN." ASC";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
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
	DESCRIPTION: This function is used to return categories by ID.
	WHEN TO USE: When need to retrieve defined categories.
	PARAMETERS: $con - connection to database,
				$id - ID of category to return.
	RETURNS: asked category.
	EXAMPLE: $result = ReturnCategoryById($con,2);
*/
function ReturnCategoryById($con,$id)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_ID_COLUMN;
	//defining query
	$query = "SELECT * FROM ".$TABLE_CATEGORY." WHERE ".$CATEGORY_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id' => $id 
	));
	//get result
	$row = $statement->fetch(PDO::FETCH_BOTH);
	return $row;
}
/* 
	DESCRIPTION: This function is used to increase number of reviews in category by 1.
	WHEN TO USE: When new review has been added.
	PARAMETERS: $id - integer representing ID of category to update,
			$con - connection to the database.
	RETURNS: $CATEGORY_UPDATED if everything went normal.
	EXAMPLE: $flag = IncreaseNumberOfReviews($con,5);
*/
function IncreaseNumberOfReviews($con,$id)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_NUMBER_OF_REVIEWS_COLUMN,$CATEGORY_ID_COLUMN,$CATEGORY_UPDATED;
	//defining query
	$query = "UPDATE ".$TABLE_CATEGORY." SET ".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN."=".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN."+1".
		" WHERE ".$CATEGORY_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id' => $id 
	));
	//return flag
	return $CATEGORY_UPDATED;
}
/* 
	DESCRIPTION: This function is used to decrease number of reviews in category by 1.
	WHEN TO USE: When review has been deleted.
	PARAMETERS: $id - integer representing ID of category to update,
			$con - connection to the database.
	RETURNS: $CATEGORY_UPDATED if everything went normal.
	EXAMPLE: $flag = DecreaseCategoryReviews($con,5);
*/
function DecreaseCategoryReviews($con,$id)
{
	//global keywords
	global $TABLE_CATEGORY,$CATEGORY_NUMBER_OF_REVIEWS_COLUMN,$CATEGORY_ID_COLUMN,$CATEGORY_UPDATED;
	//defining query
	$query = "UPDATE ".$TABLE_CATEGORY." SET ".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN."=".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN."-1".
		" WHERE ".$CATEGORY_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id' => $id 
	));
	//return flag
	return $CATEGORY_UPDATED;
}
/* DESCRIPTION: This function counts the number of reviews per each category and updates CATEGORY table.
	WHEN TO USE: When reviews are deleted or when there is a need to count all of them again.
	PARAMETERS: $con - connection to database system.
	RETURNS: $REVIEWS_PER_CATEGORY_COUNTED - if reviews had been counted successfully.
	EXAMPLE: $flag = NumberOfReviewsPerCategory($con);
*/
function NumberOfReviewsPerCategory($con)
{
	//global keywords
	global $CATEGORY_ID_COLUMN, $CATEGORY_NAME_COLUMN, $TABLE_CATEGORY,$REVIEW_ID_COLUMN,$TABLE_REVIEW,
		$REVIEW_CATEGORY_FK_COLUMN,$CATEGORY_NUMBER_OF_REVIEWS_COLUMN,$CATEGORY_ID_INDEX,$REVIEWS_PER_CATEGORY_COUNTED;
	//defining query to select CATEGORY_ID and CATEGORY_NAME from all categories
	$query = "SELECT ".$CATEGORY_ID_COLUMN.",".$CATEGORY_NAME_COLUMN." FROM ".$TABLE_CATEGORY;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//gettin rows
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//iterating through each category
	foreach($result as $row)
	{
		//counting numbers of reviews which belong to current category
		$query = "SELECT COUNT(".$REVIEW_ID_COLUMN.") FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_CATEGORY_FK_COLUMN."=".$row[$CATEGORY_ID_INDEX];
		//prepare query
		$statement = $con->prepare($query);
		//assign variables and run
		$statement->execute();
		//getting the result
		$count_row = $statement->fetch(PDO::FETCH_BOTH);
		$count = $count_row[0];
		//updating number of reviews per category in category table
		$query = "UPDATE ".$TABLE_CATEGORY." SET ".$CATEGORY_NUMBER_OF_REVIEWS_COLUMN."=:count"
				." WHERE ".$CATEGORY_ID_COLUMN."=".$row[$CATEGORY_ID_INDEX];
		//prepare query
		$statement = $con->prepare($query);
		//assign variables and run
		$statement->execute(array(
			":count"=>$count
		));
	}
	//success!
	return $REVIEWS_PER_CATEGORY_COUNTED;
}
?>