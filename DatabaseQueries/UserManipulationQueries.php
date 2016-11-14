<?php
/* 
	DESCRIPTION: Function resets the password for user if user exists. 
			If user is not registered it will return $USER_DOESNT_EXIST, otherwise 
			it will return new password.
	WHEN TO USE: When there is a need to reset users password.
	PARAMETERS: $con - established connection to database,
				$email - string containing email which will be checked.
	RETURNS: $USER_DOESNT_EXIST - if email is not found in database,
			string representing new password.
	EXAMPLE: $flag = ResetPassword($con,"email@server.com"); 
*/	
function ResetPassword($con,$email)
{
	//using global keywords
	global $TABLE_USER,$USER_PASSWORD_COLUMN, $USER_USER_ID_COLUMN,$USER_USERNAME_COLUMN,$USER_EMAIL_COLUMN,$USER_DOESNT_EXIST,$USERNAME_EXISTS, $EMAIL_EXISTS;
	//defining query
	$query = "SELECT * FROM ".$TABLE_USER." WHERE (".$USER_EMAIL_COLUMN."=:email)";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":email" =>$email
	));
	//getting row
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//if there is none=
	if ($result==null)
		return $USER_DOESNT_EXIST;
	else
	{
		//Generate a RANDOM MD5 Hash for a password
		$random_password=md5(uniqid(rand()));
 
		//Take the first 8 digits and use them as the password we intend to email the user
		$emailpassword=substr($random_password, 0, 8);
 
		//else counting users with provided username
		$query = "UPDATE ".$TABLE_USER." SET ".$USER_PASSWORD_COLUMN."=:newPassword WHERE ".$USER_USER_ID_COLUMN."=:userID";
		//prepare query
		$statement = $con->prepare($query);
		//assign variables and run
		$statement->execute(array(
			":newPassword"=>md5($emailpassword),
			":userID"=>$result[0]
		));
		//getting row
		$result = $statement->fetch(PDO::FETCH_BOTH);
		return $emailpassword;
	}
}
/* 
	DESCRIPTION: Function checks if user is already registered with username and/or password. 
			If user is not registered it will return $USER_DOESNT_EXIST, if username exists
			it will return $USERNAME_EXISTS, if email exists it will return $EMAIL_EXISTS.
	WHEN TO USE: When there is a need to check if username or email already exist in database.
	PARAMETERS: $con - established connection to database,
				$username - string containing username which will be checked,
				$email - string containing email which will be checked,
				$userID - integer representing the ID of user which shouldn't be taken in observation.
	RETURNS: $USER_DOESNT_EXIST - if username and email are not found in database,
			$USERNAME_EXISTS - if username has been found in database,
			$EMAIL_EXISTS - if email has been found in database.
	EXAMPLE: $flag = CheckIfUserExists($con,"username","email@server.com"); 
*/	
function CheckIfUserExists($con,$username,$email,$userID)
{
	//using global keywords
	global $TABLE_USER,$USER_USER_ID_COLUMN,$USER_USERNAME_COLUMN,$USER_EMAIL_COLUMN,$USER_DOESNT_EXIST,$USERNAME_EXISTS, $EMAIL_EXISTS;
	//defining query for counting records which contain username or password and are different from sent ID
	$query = "SELECT COUNT(*) FROM ".$TABLE_USER." WHERE (".$USER_USERNAME_COLUMN."=:username OR ".$USER_EMAIL_COLUMN."=:email)
				AND ".$USER_USER_ID_COLUMN."<>:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":username"=>$username,
		":email" =>$email,
		":userID"=>$userID
	));
	//getting row
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//if there is none return null
	if ($result[0]==0)
		return $USER_DOESNT_EXIST;
	else
	{
		//else counting users with provided username
		$query = "SELECT COUNT(*) FROM ".$TABLE_USER." WHERE ".$USER_USERNAME_COLUMN."=:username AND ".$USER_USER_ID_COLUMN."<>:userID";
		//prepare query
		$statement = $con->prepare($query);
		//assign variables and run
		$statement->execute(array(
			":username"=>$username,
			":userID"=>$userID
		));
		//getting row
		$result = $statement->fetch(PDO::FETCH_BOTH);
		//if there are no records for username match, then email exists
		if ($result[0]==0)
			return $EMAIL_EXISTS;
		else
			//else username exists
			return $USERNAME_EXISTS;
	}
}

/* 
	DESCRIPTION: Function tries to register user to database, if the username or email are not already stored in in.
		If username is stored function will return $USERNAME_EXISTS, if email is stored function will return $EMAIL_EXISTS.
		If none of them are stored then the function will try to create new record in database and if it succeeds 
		$REGISTRATION_SUCCESSFULL will be returned.
	WHEN TO USE: When user should be registered to database.
	PARAMETERS: $con - connection to database,
				$username - string containing the username,
				$password - string containing the password,
				$email - string containing the email,
				$citizenship - string containing citizenship,
				$gender - boolean representing the user's gender TRUE for male, FALSE for female,
				$additionalInfo - string containing additional users information, can be null,
				$age - integer representing users age,
				$email_visible - boolean representing if user wants others to see his email address.
	RETURNS: $USERNAME_EXISTS - if username has been found in database,
			$EMAIL_EXISTS - if email has been found in database,
			$REGISTRATION_SUCCESSFULL - if user has been registered to database.
	EXAMPLE: $flag = RegisterUser($con,"username","password","email@server.com","italian",TRUE,null,23,FALSE);
*/
function RegisterUser($con,$username,$password,$email,$citizenship,$gender,$additionalInfo,$age,$email_visible)
{
	//defining keywords
	global $REGISTRATION_SUCCESSFULL,$USER_DOESNT_EXIST,$TABLE_USER,$USER_USER_ID_COLUMN,
	$USER_USERNAME_COLUMN, $USER_PASSWORD_COLUMN, $USER_EMAIL_COLUMN, $USER_CITIZENSHIP_COLUMN, 
	$USER_GENDER_COLUMN, $USER_ROLE_COLUMN, $USER_ADDITIONAL_INFO_COLUMN, $USER_COMMENTS_NUMBER_COLUMN, 
	$USER_REVIEWS_NUMBER_COLUMN, $USER_AVATAR_FK_COLUMN, $USER_REGISTRATION_TIME_COLUMN, $USER_AGE_COLUMN, $USER_EMAIL_VISIBLE_COLUMN,$ROLE_REGULAR_USER;
	//checking if username or email are already stored in database
	$flag = CheckIfUserExists($con,$username,$email,0);
	//if user is not found in database proceed to registration
	if ($flag==$USER_DOESNT_EXIST)
	{
		//defining query
		$query = "INSERT INTO ".$TABLE_USER. "(".$USER_USER_ID_COLUMN.", ".$USER_USERNAME_COLUMN.", ".$USER_PASSWORD_COLUMN.", "
			.$USER_EMAIL_COLUMN.", ".$USER_CITIZENSHIP_COLUMN.", ".$USER_GENDER_COLUMN.", ".$USER_ROLE_COLUMN.", "
			.$USER_ADDITIONAL_INFO_COLUMN.", ".$USER_COMMENTS_NUMBER_COLUMN.", ".$USER_REVIEWS_NUMBER_COLUMN.", "
			.$USER_AVATAR_FK_COLUMN.", ".$USER_REGISTRATION_TIME_COLUMN.", ".$USER_AGE_COLUMN.", "
			.$USER_EMAIL_VISIBLE_COLUMN.") VALUES (NULL,:username,:password,:email,:citizenship,:gender,".$ROLE_REGULAR_USER.","
			.":additionalInfo, 0, 0, null, now(), :age, :email_visible)";
		//prepare query
		$statement = $con->prepare($query);
		//assign variables and run
		$statement->execute(array(
			":username"=>$username,
			":password" =>md5($password),
			":email"=>$email,
			":citizenship"=>$citizenship,
			":gender"=>$gender,
			":additionalInfo"=>$additionalInfo,
			":age"=>$age,
			":email_visible"=>$email_visible
		));
		//returning the flag
		return $REGISTRATION_SUCCESSFULL;
	}
	else
	{
		//returning the received flag
		return $flag;
	}
}
/* 
	DESCRIPTION: Function tries to save changes to existing user. If the username/email which user/moderator/admin choose for user
				already exists in some other record, the corresponding flag will be returned, otherwise changes will be saved.
	WHEN TO USE: When user/moderator/administrator want to change basic information about user.
	PARAMETERS: $con - connection to database,
				$userID - ID of the user,
				$username - string containing the username,
				$password - string containing the password,
				$email - string containing the email,
				$citizenship - string containing citizenship,
				$gender - boolean representing the user's gender TRUE for male, FALSE for female,
				$additionalInfo - string containing additional users information, can be null,
				$avatarID_FK - integer representing ID of image, which is his avatar,
				$age - integer representing users age,
				$email_visible - boolean representing if user wants others to see his email address.
	RETURNS: $USERNAME_EXISTS - if username has been found in database in some other record,
			$EMAIL_EXISTS - if email has been found in database in some other record,
			$USER_EDITED_SUCCESSFULL - if changes have been saved to database.
	EXAMPLE: $flag = EditUsersInformation($con,18,"username","password","email@server.com","italian",TRUE,null,1,23,FALSE);
*/
function EditUsersInformation($con,$userID,$username,$password,$email,$citizenship,$gender,$additionalInfo,$avatarID_FK,$age,$email_visible)
{
	//defining keywords
	global $REGISTRATION_SUCCESSFULL,$USER_DOESNT_EXIST,$TABLE_USER,$USER_USER_ID_COLUMN,
	$USER_USERNAME_COLUMN, $USER_PASSWORD_COLUMN, $USER_EMAIL_COLUMN, $USER_CITIZENSHIP_COLUMN, 
	$USER_GENDER_COLUMN, $USER_ROLE_COLUMN, $USER_ADDITIONAL_INFO_COLUMN, $USER_COMMENTS_NUMBER_COLUMN, 
	$USER_REVIEWS_NUMBER_COLUMN, $USER_AVATAR_FK_COLUMN, $USER_REGISTRATION_TIME_COLUMN, $USER_AGE_COLUMN, $USER_EMAIL_VISIBLE_COLUMN,
	$USER_EDITED_SUCCESSFULL;
	//checking if username or email are already stored in database in some other record
	$flag = CheckIfUserExists($con,$username,$email,$userID);
	//if user is not found in database proceed to registration
	if ($flag==$USER_DOESNT_EXIST)
	{
		//defining query
		$query = "UPDATE ".$TABLE_USER. " SET ".$USER_USERNAME_COLUMN."=:username, ".$USER_PASSWORD_COLUMN."=:password, "
			.$USER_EMAIL_COLUMN."=:email, ".$USER_CITIZENSHIP_COLUMN."=:citizenship, ".$USER_GENDER_COLUMN."=:gender, "
			.$USER_ADDITIONAL_INFO_COLUMN."=:additionalInfo, ".$USER_AVATAR_FK_COLUMN."= :avatarID, "
			.$USER_AGE_COLUMN."=:age, ".$USER_EMAIL_VISIBLE_COLUMN."= :email_visible WHERE ".$USER_USER_ID_COLUMN."= :userID";
		//echo $query;
		//prepare query
		$statement = $con->prepare($query);
		$a = array(
			":username"=>$username,
			":password" =>md5($password),
			":email"=>$email,
			":citizenship"=>$citizenship,
			":gender"=>$gender,
			":additionalInfo"=>$additionalInfo,
			":avatarID"=>$avatarID_FK,
			":age"=>$age,
			":email_visible"=>$email_visible,
			":userID"=>$userID);
		//assign variables and run
		$statement->execute($a);
		
		//returning the flag
		return $USER_EDITED_SUCCESSFULL;
	}
	else
	{
		//returning the received flag
		return $flag;
	}
}
/* 
	DESCRIPTION: Function tries to save changes to existing user. If the username/email which user/moderator/admin choose for user
				already exists in some other record, the corresponding flag will be returned, otherwise changes will be saved.
	WHEN TO USE: When user/moderator/administrator want to change basic information about user.
	PARAMETERS: $con - connection to database,
				$userID - ID of the user,
				$username - string containing the username,
				$email - string containing the email,
				$citizenship - string containing citizenship,
				$gender - boolean representing the user's gender TRUE for male, FALSE for female,
				$additionalInfo - string containing additional users information, can be null,
				$avatarID_FK - integer representing ID of image, which is his avatar,
				$age - integer representing users age,
				$email_visible - boolean representing if user wants others to see his email address.
	RETURNS: $USERNAME_EXISTS - if username has been found in database in some other record,
			$EMAIL_EXISTS - if email has been found in database in some other record,
			$USER_EDITED_SUCCESSFULL - if changes have been saved to database.
	EXAMPLE: $flag = EditUsersInformationWithoutPassword($con,18,"username","email@server.com","italian",TRUE,null,1,23,FALSE);
*/
function EditUsersInformationWithoutPassword($con,$userID,$username,$email,$citizenship,$gender,$additionalInfo,$avatarID_FK,$age,$email_visible)
{
	//defining keywords
	global $REGISTRATION_SUCCESSFULL,$USER_DOESNT_EXIST,$TABLE_USER,$USER_USER_ID_COLUMN,
	$USER_USERNAME_COLUMN, $USER_PASSWORD_COLUMN, $USER_EMAIL_COLUMN, $USER_CITIZENSHIP_COLUMN, 
	$USER_GENDER_COLUMN, $USER_ROLE_COLUMN, $USER_ADDITIONAL_INFO_COLUMN, $USER_COMMENTS_NUMBER_COLUMN, 
	$USER_REVIEWS_NUMBER_COLUMN, $USER_AVATAR_FK_COLUMN, $USER_REGISTRATION_TIME_COLUMN, $USER_AGE_COLUMN, $USER_EMAIL_VISIBLE_COLUMN,
	$USER_EDITED_SUCCESSFULL;
	//checking if username or email are already stored in database in some other record
	$flag = CheckIfUserExists($con,$username,$email,$userID);
	//if user is not found in database proceed to registration
	if ($flag==$USER_DOESNT_EXIST)
	{
		//defining query
		$query = "UPDATE ".$TABLE_USER. " SET ".$USER_USERNAME_COLUMN."=:username, ".$USER_EMAIL_COLUMN."=:email, "
			.$USER_CITIZENSHIP_COLUMN."=:citizenship, ".$USER_GENDER_COLUMN."=:gender, "
			.$USER_ADDITIONAL_INFO_COLUMN."=:additionalInfo, ".$USER_AVATAR_FK_COLUMN."= :avatarID, "
			.$USER_AGE_COLUMN."=:age, ".$USER_EMAIL_VISIBLE_COLUMN."= :email_visible WHERE ".$USER_USER_ID_COLUMN."= :userID";
		//echo $query;
		//prepare query
		$statement = $con->prepare($query);
		$a = array(
			":username"=>$username,
			":email"=>$email,
			":citizenship"=>$citizenship,
			":gender"=>$gender,
			":additionalInfo"=>$additionalInfo,
			":avatarID"=>$avatarID_FK,
			":age"=>$age,
			":email_visible"=>$email_visible,
			":userID"=>$userID);
		//assign variables and run
		$statement->execute($a);
		
		//returning the flag
		return $USER_EDITED_SUCCESSFULL;
	}
	else
	{
		//returning the received flag
		return $flag;
	}
}
/* DESCRIPTION: This function deletes user from database, and also can be used to delete user and all his comments and reviews.
		When user is deleted automatically all user foreign keys in "answers","comments","reviews" are set to NULL 
		but in "impressions" table records are deleted where user is foreign key! If comments are set to be deleted, then
		everything will happen like in previous case, just this time all comments where this user is foreign key will be deleted.
		If reviews are set to be deleted, then all comments which belong to users reviews are going to be deleted, all his reviews
		are going to be deleted just as user, and all impressions which belong to this reviews.
		Also after deletion, categories are being counted for number of reviews per category.
	WHEN TO USE: When user needs to be deleted, with (but not necessary) his reviews and/or comments.
	PARAMETERS: $con - connection to database,
				$userID - ID of the user to be deleted,
				$allComments - boolean which should be set to TRUE to delete all users comments,
				$allReviews - boolean which should be set to TRUE to delete all users reviews.
	RETURNS: $RECORDS_DELETED - if user has been deleted successfully.
	EXAMPLE: $flag = DeleteUser($con,12,false,true);
*/
function DeleteUser($con,$userID, $allComments,$allReviews)
{
	//defining keywords
	global $TABLE_USER,$USER_USER_ID_COLUMN,$RECORDS_DELETED,$TABLE_REVIEW,$REVIEW_USER_FK_COLUMN
		,$TABLE_COMMENTS,$COMMENT_USER_FK_COLUMN;
	//if comments are not chosen to be deleted
	if (!$allComments)
	{
		//if reviews are not chosen to be deleted
		if (!$allReviews)
		{
			//define query to delete only user
			$query = "DELETE FROM ".$TABLE_USER." WHERE ".$USER_USER_ID_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//returning the flag
			return $RECORDS_DELETED;
		}
		else
		{
			//if reviews are chosen to be deleted
			//define query to delete users reviews
			$query = "DELETE FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_USER_FK_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//define query to delete user
			$query = "DELETE FROM ".$TABLE_USER." WHERE ".$USER_USER_ID_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//counting reviews in each category
			$flag = NumberOfReviewsPerCategory($con);
			//returning the flag
			return $RECORDS_DELETED;
		}
	}
	else
	{
		//if comments are chosen to be deleted
		if (!$allReviews)
		{
			//if reviews are not chosen to be deleted
			//define query to delete users comments
			$query = "DELETE FROM ".$TABLE_COMMENTS." WHERE ".$COMMENT_USER_FK_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//define query to delete user
			$query = "DELETE FROM ".$TABLE_USER." WHERE ".$USER_USER_ID_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//returning the flag
			return $RECORDS_DELETED;
		}
		else
		{
			//if both reviews and comments had been chosen to be deleted
			//define query to delete users comments
			$query = "DELETE FROM ".$TABLE_COMMENTS." WHERE ".$COMMENT_USER_FK_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//define query to delete users reviews
			$query = "DELETE FROM ".$TABLE_REVIEW." WHERE ".$REVIEW_USER_FK_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//define query to delete user
			$query = "DELETE FROM ".$TABLE_USER." WHERE ".$USER_USER_ID_COLUMN."=:userID";
			//prepare query
			$statement = $con->prepare($query);
			//assign variables and run
			$statement->execute(array(
				":userID"=>$userID
			));
			//counting reviews in each category
			$flag = NumberOfReviewsPerCategory($con);
			//returning the flag
			return $RECORDS_DELETED;			
			
		}
	}
}
/* DESCRIPTION: This function returns an array with data about user extracted from database using user ID as condition.
	WHEN TO USE: When there is a need to extract informations about user.
	PARAMETERS: $con - connection to database,
				$userID - integer representing user ID whos informations are needed.
	RETURNS: entire row from database represented as an array.
	EXAMPLE: $user = ReturnUser($con,$userID);
*/
function ReturnUser($con,$userID)
{
	//global keywords
	global $TABLE_USER,$USER_USER_ID_COLUMN;
	//defining query to select CATEGORY_ID and CATEGORY_NAME from all categories
	$query = "SELECT * FROM ".$TABLE_USER." WHERE ".$USER_USER_ID_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID"=>$userID
	));
	//getting the result
	$row = $statement->fetch(PDO::FETCH_BOTH);
	//returning an array
	return $row;
}
/* DESCRIPTION: This function changes users role from current to regular, moderator or administrator role.
	WHEN TO USE: When users role is changed.
	PARAMETERS: $con - connection to database,
				$userID - integer representing user ID whos role status changed,
				$newRole - new role: $$ROLE_REGULAR_USER, $ROLE_MODERATOR or $ROLE_ADMINISTRATOR
	RETURNS: $USER_EDITED_SUCCESSFULL if function was successfull.
	EXAMPLE: $flag = ChangeUserRole($con,12,$ROLE_MODERATOR);
*/
function ChangeUserRole($con,$userID, $newRole)
{
	//global keywords
	global $TABLE_USER,$USER_USER_ID_COLUMN, $USER_ROLE_COLUMN,$USER_EDITED_SUCCESSFULL;
	//connecting to database
	$con = connect();
	//defining query to update user to new role
	$query = "UPDATE ".$TABLE_USER." SET ".$USER_ROLE_COLUMN."=:newRole WHERE ".$USER_USER_ID_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":newRole"=>$newRole,
		":userID"=>$userID
	));
	//return flag
	return $USER_EDITED_SUCCESSFULL;
}
/* DESCRIPTION: This function checks if user exists based on the username and password he provided.
	WHEN TO USE: When you need to login user.
	PARAMETERS: $con - connection to database,
				$username - string representing username which user typed,
				$password - string representing password which user typed.
	RETURNS: $USER_DOESNT_EXIST if username and password don't match,
			or returns array representing a user.
	EXAMPLE: $user = CheckCredentials($con,"username","password");
*/
function CheckCredentials($con,$username,$password)
{
	//keywords
	global $TABLE_USER,$USER_DOESNT_EXIST,$USER_USER_ID_COLUMN,$USER_USERNAME_COLUMN,$USER_PASSWORD_COLUMN;
	//defining query to select user with provided username and password
	$query = "SELECT * FROM ".$TABLE_USER." WHERE ".$USER_USERNAME_COLUMN."=:username AND ".$USER_PASSWORD_COLUMN.
		"=:password";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":username"=>$username,
		":password"=>md5($password)
	));
	//getting the result
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there are no users with that info
	if (count($result)==0)
	{
		//return a flag
		return $USER_DOESNT_EXIST;
	}
	//else getting the result
	$row = $result[0];
	//returning an array
	return $row;
}
/*  DESCRIPTION: This function increases number of users reviews.
	WHEN TO USE: When users review is accepted.
	PARAMETERS: $con - connection to database,
				$userID - integer representing ID of user.
	RETURNS: $USER_EDITED_SUCCESSFULL if everything went well.
	EXAMPLE: $flag = IncreaseNumberOfUsersReviews($con,2);
*/
function IncreaseNumberOfUsersReviews($con,$userID)
{
	//keywords
	global $TABLE_USER,$USER_REVIEWS_NUMBER_COLUMN,$USER_USER_ID_COLUMN,$USER_EDITED_SUCCESSFULL;
	//defining query
	$query = "UPDATE ".$TABLE_USER." SET ".$USER_REVIEWS_NUMBER_COLUMN."=".$USER_REVIEWS_NUMBER_COLUMN."+1 WHERE "
		.$USER_USER_ID_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID"=>$userID
	));
	//returning flag
	return $USER_EDITED_SUCCESSFULL;
}
/*  DESCRIPTION: This function decreases number of users reviews.
	WHEN TO USE: When users review is deleted.
	PARAMETERS: $con - connection to database,
				$userID - integer representing ID of user.
	RETURNS: $USER_EDITED_SUCCESSFULL if everything went well.
	EXAMPLE: $flag = DecreaseUsersReviews($con,2);
*/
function DecreaseUsersReviews($con,$userID)
{
	//keywords
	global $TABLE_USER,$USER_REVIEWS_NUMBER_COLUMN,$USER_USER_ID_COLUMN,$USER_EDITED_SUCCESSFULL;
	//defining query
	$query = "UPDATE ".$TABLE_USER." SET ".$USER_REVIEWS_NUMBER_COLUMN."=".$USER_REVIEWS_NUMBER_COLUMN."-1 WHERE "
		.$USER_USER_ID_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID"=>$userID
	));
	//returning flag
	return $USER_EDITED_SUCCESSFULL;
}
/*  DESCRIPTION: This function increases number of users comments.
	WHEN TO USE: When user posts a comment.
	PARAMETERS: $con - connection to database,
				$userID - integer representing ID of user.
	RETURNS: $USER_EDITED_SUCCESSFULL if everything went well.
	EXAMPLE: $flag = IncreaseNumberOfUsersComments($con,2);
*/
function IncreaseNumberOfUsersComments($con,$userID)
{
	//keywords
	global $TABLE_USER,$USER_COMMENTS_NUMBER_COLUMN,$USER_USER_ID_COLUMN,$USER_EDITED_SUCCESSFULL;
	//defining query
	$query = "UPDATE ".$TABLE_USER." SET ".$USER_COMMENTS_NUMBER_COLUMN."=".$USER_COMMENTS_NUMBER_COLUMN."+1 WHERE "
		.$USER_USER_ID_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID"=>$userID
	));
	//returning results
	return $USER_EDITED_SUCCESSFULL;
}
/*  DESCRIPTION: This function decreases number of users comments.
	WHEN TO USE: When users comment is deleted.
	PARAMETERS: $con - connection to database,
				$userID - integer representing ID of user.
	RETURNS: $USER_EDITED_SUCCESSFULL if everything went well.
	EXAMPLE: $flag = DecreaseUsersComments($con,2);
*/
function DecreaseUsersComments($con,$userID)
{
	//keywords
	global $TABLE_USER,$USER_COMMENTS_NUMBER_COLUMN,$USER_USER_ID_COLUMN,$USER_EDITED_SUCCESSFULL;
	//defining query
	$query = "UPDATE ".$TABLE_USER." SET ".$USER_COMMENTS_NUMBER_COLUMN."=".$USER_COMMENTS_NUMBER_COLUMN."-1 WHERE "
		.$USER_USER_ID_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":userID"=>$userID
	));
	//returning results
	return $USER_EDITED_SUCCESSFULL;
}
function ReturnAllUsers($con,$from,$count)
{
	//global keywords
	global $TABLE_USER,$USER_USERNAME_COLUMN;
	//defining query to select CATEGORY_ID and CATEGORY_NAME from all categories
	$query = "SELECT * FROM ".$TABLE_USER." ORDER BY ".$USER_USERNAME_COLUMN." LIMIT :from,:to";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":from"=>$from,
		":to"=>$count
	));
	//getting the result
	$row = $statement->fetchAll(PDO::FETCH_BOTH);
	//returning an array
	return $row;
}
function ReturnCountOfAllUsers($con)
{
	//global keywords
	global $TABLE_USER,$USER_USERNAME_COLUMN;
	//defining query to select CATEGORY_ID and CATEGORY_NAME from all categories
	$query = "SELECT COUNT(*) FROM ".$TABLE_USER;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	//getting the result
	$row = $statement->fetch(PDO::FETCH_BOTH);
	//returning an array
	return $row[0];
}
function ReturnSearchUsers($con,$condition)
{
	global $TABLE_USER,$USER_USERNAME_COLUMN;
	//defining query to select CATEGORY_ID and CATEGORY_NAME from all categories
	$query = "SELECT * FROM ".$TABLE_USER." WHERE ".$USER_USERNAME_COLUMN." LIKE :con";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":con" => '%'.$condition.'%'));
	//getting the result
	$row = $statement->fetchAll(PDO::FETCH_BOTH);
	//returning an array
	return $row;
}
?>