<?php
/* 
	DESCRIPTION: This function creates new poll in database.
	WHEN TO USE: When moderators want to create new poll.
	PARAMETERS: $con - connection to database,
				$question - string representing the question which will be used for the poll,
				$answers - array of strings, each of them representing possible answers,
				$expiration_time - datetime paramet which defines when does poll expires.
	RETURNS: $POLL_CREATED - if poll was created successfully.
	EXAMPLE: $flag = CreatePoll($con,"Do you like the design?",array("Yes","No","Satisfied"),"2012-12-15 01:51:58"); 
*/
function CreatePoll($con,$question,$answers,$expiration_time)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_ID_COLUMN,$QUESTION_TEXT_COLUMN,$QUESTION_NUMBER_OF_ANSWERS_COLUMN,$QUESTION_ANSWER1_COLUMN,
		$QUESTION_ANSWER2_COLUMN,$QUESTION_ANSWER3_COLUMN,$QUESTION_ANSWER4_COLUMN,$QUESTION_EXPIRATION_TIME_COLUMN,$QUESTION_RESULT1_COLUMN,
		$QUESTION_RESULT2_COLUMN,$QUESTION_RESULT3_COLUMN,$QUESTION_RESULT4_COLUMN,$POLL_CREATED;
	//define query to insert poll
	$query = "INSERT INTO ".$TABLE_QUESTION."(".$QUESTION_ID_COLUMN.", ".$QUESTION_TEXT_COLUMN.", ".$QUESTION_NUMBER_OF_ANSWERS_COLUMN.", "
		.$QUESTION_ANSWER1_COLUMN.", ".$QUESTION_ANSWER2_COLUMN.", ".$QUESTION_ANSWER3_COLUMN.", ".$QUESTION_ANSWER4_COLUMN.", "
		.$QUESTION_EXPIRATION_TIME_COLUMN.", ".$QUESTION_RESULT1_COLUMN.", ".$QUESTION_RESULT2_COLUMN.", ".$QUESTION_RESULT3_COLUMN.", "
		.$QUESTION_RESULT4_COLUMN.") VALUES (NULL,:question,:answers, :answer0, :answer1, :answer2, :answer3,
		:expiration_time, 0, 0, :num3, :num4)";
	$num3 = null;
	$num4 = null;
	$answer2 = null;
	$answer3 = null;
	// if there are 4 questions
	if (count($answers)>3)
	{
		$num3 = 0;
		$num4 = 0;
		$answer2 = $answers[2];
		$answer3 = $answers[3];
	}
	//if there are 3 questions
	else if (count($answers)>2)
	{
		$num3 = 0;
		$answer2 = $answers[2];
	}
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":question" => $question,
		":answers" => count($answers),
		":answer0" => $answers[0],
		":answer1" => $answers[1],
		":answer2" => $answer2,
		":answer3" => $answer3,
		":expiration_time" => $expiration_time,
		":num3" => $num3,
		":num4" => $num4
	));
	//returning the flag
	return $POLL_CREATED;
}
/* 
	DESCRIPTION: This function deletes poll using his ID to find him.
	WHEN TO USE: When moderators want to delete poll.
	PARAMETERS: $con - connection to database,
				$questionID - ID of poll to delete.
	RETURNS: $POLL_DELETED when poll is deleted successfully.
	EXAMPLE: $flag = DeletePoll($con,1); 
*/
function DeletePoll($con,$questionID)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_ID_COLUMN,$POLL_DELETED;
	//define queries
	$query = "DELETE FROM ".$TABLE_QUESTION." WHERE ".$QUESTION_ID_COLUMN."=:questionID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":questionID" => $questionID
	));
	//returning null otherwise
	return $POLL_DELETED;
}
/* 
	DESCRIPTION: This function returns all polls which will be shown in future.
	WHEN TO USE: When moderators want to see all polls.
	PARAMETERS: $con - connection to database.
	RETURNS: array through which is needed to iterate,
		or null if there are no polls.
	EXAMPLE: $polls = ReturnAllFuturePolls($con); 
*/
function ReturnAllFuturePolls($con)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_ID_COLUMN, $QUESTION_EXPIRATION_TIME_COLUMN;
	//define queries
	$query = "SELECT * FROM ".$TABLE_QUESTION." WHERE ".$QUESTION_EXPIRATION_TIME_COLUMN.">now() ORDER BY ".$QUESTION_EXPIRATION_TIME_COLUMN." ASC";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there are polls return them
	if (count($result)>0)
	{
		return $result;
	}
	//returning null otherwise
	return null;
}
/* 
	DESCRIPTION: This function returns all polls which were shown.
	WHEN TO USE: When previous polls have to be listed.
	PARAMETERS: $con - connection to database,
				$from - starting index from which to return,
				$count - number of polls to return.
	RETURNS: array through which is needed to iterate,
		or null if there are no polls.
	EXAMPLE: $polls = ReturnAllPreviousPolls($con,0,8); 
*/
function ReturnAllPreviousPolls($con,$from,$count)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_ID_COLUMN, $QUESTION_EXPIRATION_TIME_COLUMN;
	//define queries
	$query = "SELECT * FROM ".$TABLE_QUESTION." WHERE ".$QUESTION_EXPIRATION_TIME_COLUMN."<now() ORDER BY ".$QUESTION_EXPIRATION_TIME_COLUMN.
		" DESC LIMIT :from, :to";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':from'=>$from,
		':to'=>$count
	));
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there are polls return them
	if (count($result)>0)
	{
		return $result;
	}
	//returning null otherwise
	return null;
}
/* 
	DESCRIPTION: This function returns number of all polls which were shown.
	WHEN TO USE: When number of previous polls have to be listed.
	PARAMETERS: $con - connection to database.
	RETURNS: integer.
	EXAMPLE: $polls = ReturnCountPreviousPolls($con,0,8); 
*/
function ReturnCountPreviousPolls($con)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_ID_COLUMN, $QUESTION_EXPIRATION_TIME_COLUMN;
	//define queries
	$query = "SELECT COUNT(*) FROM ".$TABLE_QUESTION." WHERE ".$QUESTION_EXPIRATION_TIME_COLUMN."<now() ORDER BY ".$QUESTION_EXPIRATION_TIME_COLUMN.
		" DESC";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//if there are polls return them
	return $result[0];
}
/* 
	DESCRIPTION: This function returns poll from database.
	WHEN TO USE: When there is a need to return specified poll.
	PARAMETERS: $con - connection to database,
				$pollID - integer representing poll's ID.
	RETURNS: array representing the entire poll.
	EXAMPLE: $poll = ReturnPoll($con,2); 
*/
function ReturnPoll($con,$pollID)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_ID_COLUMN;
	//define queries
	$query = "SELECT * FROM ".$TABLE_QUESTION." WHERE ".$QUESTION_ID_COLUMN."=:pollID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":pollID" => $pollID
	));
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//returning poll
	return $result;
}
/* 
	DESCRIPTION: This function returns active poll for today.
	WHEN TO USE: When user needs to see current poll.
	PARAMETERS: $con - connection to database.
	RETURNS: array which represents poll or $POLL_DOESNT_EXIST if there is none.
	EXAMPLE: $poll = ReturnActivePoll($con); 
*/
function ReturnActivePoll($con)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_EXPIRATION_TIME_COLUMN,$POLL_DOESNT_EXIST;
	//define queries
	$query = "SELECT * FROM ".$TABLE_QUESTION." WHERE DATE_SUB(CONCAT(".$QUESTION_EXPIRATION_TIME_COLUMN.", ' 00:00:00'), INTERVAL 1 DAY)<NOW() AND ".$QUESTION_EXPIRATION_TIME_COLUMN.">now() ORDER BY ".$QUESTION_EXPIRATION_TIME_COLUMN." ASC LIMIT 1";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//if there is any rows
	if (count($result)>0)
	{
		$row = $result[0];
	}
	else
	{
		return $POLL_DOESNT_EXIST;
	}	
	//returning poll
	return $row;
}
/* 
	DESCRIPTION: This function edits the poll.
	WHEN TO USE: When moderator needs to change the poll.
	PARAMETERS: $con - connection to database,
				$pollID - integer representing poll's ID,
				$questionText - string representing new question,
				$answer - array of strings representing answers,
				$exp_time - TimeDate which represents until when is poll opened.
	RETURNS: $POLL_UPDATED if changes are saved successfully.
	EXAMPLE: $flag = ChangePoll($con,3,"Do you like this?",array("Yes","No","Hm, its ok"),"2012-12-15 01:51:58"); 
*/
function ChangePoll($con,$pollID,$questionText,$answer,$exp_time)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_TEXT_COLUMN,$QUESTION_NUMBER_OF_ANSWERS_COLUMN,$QUESTION_ANSWER1_COLUMN, 
		$QUESTION_ANSWER2_COLUMN, $QUESTION_ANSWER3_COLUMN, $QUESTION_ANSWER4_COLUMN, $QUESTION_EXPIRATION_TIME_COLUMN,
		$QUESTION_ID_COLUMN, $QUESTION_RESULT3_COLUMN,$QUESTION_RESULT4_COLUMN,$POLL_UPDATED;
	//define queries
	$query = "UPDATE ".$TABLE_QUESTION." SET ".$QUESTION_TEXT_COLUMN."=:questionText,".$QUESTION_NUMBER_OF_ANSWERS_COLUMN."=:answers, "
			.$QUESTION_ANSWER1_COLUMN."=:answer0,".$QUESTION_ANSWER2_COLUMN."=:answer1,".$QUESTION_ANSWER3_COLUMN."=:answer2, "
			.$QUESTION_ANSWER4_COLUMN."=:answer3,".$QUESTION_EXPIRATION_TIME_COLUMN."=:exp_time, "
			.$QUESTION_RESULT3_COLUMN."=:num2, ".$QUESTION_RESULT4_COLUMN."=:num3 WHERE ".$QUESTION_ID_COLUMN."=:pollID";
	$answer2 = null;
	$answer3 = null;
	$num2 = null;
	$num3 = null;
	if (count($answer)>3)
	{
		$answer2 = $answer[2];
		$answer3 = $answer[3];
		$num2 = 0;
		$num3 = 0;
	}
	else
	if (count($answer)>2)
	{
		$answer2 = $answer[2];
		$num2 = 0;
	}
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":questionText" => $questionText,
		":answers" => count($answer),
		":answer0" => $answer[0],
		":answer1" => $answer[1],
		":answer2" => $answer2,
		":answer3" => $answer3,
		":exp_time" => $exp_time,
		":num2" => $num2,
		":num3" => $num3,
		":pollID" => $pollID
	));
	//return flag
	return $POLL_UPDATED;
}
/* 
	DESCRIPTION: This function saves the users answer for the question of the day and
			calculates the voting results in percents.
	WHEN TO USE: When user votes for the questaion of the day.
	PARAMETERS: $con - connection to database,
				$userID - integer representing user's ID,
				$questionID - integer representing question's ID,
				$answer - integer representing which answer was chosen 1-4.
	RETURNS: $ANSWER_SAVED if vote was saved successfully.
	EXAMPLE: $flag = RememberTheAnswer($con,3,15,2); 
*/
function RememberTheAnswer($con,$userID,$questionID,$answer)
{
	//defining keywords
	global $TABLE_ANSWER,$ANSWER_ID_COLUMN, $ANSWER_QUESTION_FK_COLUMN, $ANSWER_USER_FK_COLUMN, $ANSWER_COLUMN,
		$QUESTION_RESULT1_COLUMN,$QUESTION_RESULT2_COLUMN,$QUESTION_RESULT3_COLUMN,$QUESTION_RESULT4_COLUMN,
		$TABLE_QUESTION,$QUESTION_ID_COLUMN,$ANSWER_SAVED;
	//define query to insert vote to the table
	$query = "INSERT INTO ".$TABLE_ANSWER." (".$ANSWER_ID_COLUMN.", ".$ANSWER_QUESTION_FK_COLUMN.", ".$ANSWER_USER_FK_COLUMN
		.", ".$ANSWER_COLUMN.") VALUES (NULL,:questionID,:userID,:answer)";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":questionID" => $questionID,
		":userID" => $userID,
		":answer" => $answer
	)); 
	//counting all votes for the question
	$query = "SELECT ".$ANSWER_ID_COLUMN." FROM ".$TABLE_ANSWER." WHERE ".$ANSWER_QUESTION_FK_COLUMN."=:questionID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":questionID" => $questionID
	)); 
	//getting row
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	if (count($result)>0)
	{
		$row = $result[0];
		$count = count($result);
	}
	else
	{
		$count = 1;
	}
	echo "<script>alert('".$count."');</script>";
	//updating the results for each possible answer in percents
	$query = "UPDATE ".$TABLE_QUESTION." SET "
			.$QUESTION_RESULT1_COLUMN."= cast(100*((SELECT COUNT(".$ANSWER_ID_COLUMN.") FROM ".$TABLE_ANSWER." 
				WHERE ".$ANSWER_QUESTION_FK_COLUMN."=:questionID1 AND ".$ANSWER_COLUMN."=1)/".$count.") as decimal (10,2)), "
			.$QUESTION_RESULT2_COLUMN."= cast(100*((SELECT COUNT(".$ANSWER_ID_COLUMN.") FROM ".$TABLE_ANSWER." 
				WHERE ".$ANSWER_QUESTION_FK_COLUMN."=:questionID2 AND ".$ANSWER_COLUMN."=2)/".$count.") as decimal (10,2)), "
			.$QUESTION_RESULT3_COLUMN."= cast(100*((SELECT COUNT(".$ANSWER_ID_COLUMN.") FROM ".$TABLE_ANSWER." 
				WHERE ".$ANSWER_QUESTION_FK_COLUMN."=:questionID3 AND ".$ANSWER_COLUMN."=3)/".$count.") as decimal (10,2)), "
			.$QUESTION_RESULT4_COLUMN."= cast(100*((SELECT COUNT(".$ANSWER_ID_COLUMN.") FROM ".$TABLE_ANSWER
			." WHERE ".$ANSWER_QUESTION_FK_COLUMN."=:questionID4 AND ".$ANSWER_COLUMN."=4)/".$count.") as decimal (10,2))
			WHERE ".$QUESTION_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":questionID1" => $questionID,
		":questionID2" => $questionID,
		":questionID3" => $questionID,
		":questionID4" => $questionID,
		":id" => $questionID
	)); 
	//return flag
	return $ANSWER_SAVED;
}
/* 
	DESCRIPTION: This function checks if user voted for the question of the day.
	WHEN TO USE: When there is a need to check if user voted or not.
	PARAMETERS: $con - connection to database,
				$userID - integer representing user's ID,
				$questionID - integer representing question's ID.
	RETURNS: $USER_VOTED if user voted, $USER_DIDNT_VOTED otherwise.
	EXAMPLE: $flag = DidUserVoted($con,3,15); 
*/
function DidUserVoted($con,$userID,$questionID)
{
	//defining keywords
	global $TABLE_ANSWER,$ANSWER_ID_COLUMN, $ANSWER_QUESTION_FK_COLUMN, 
		$ANSWER_USER_FK_COLUMN, $USER_VOTED, $USER_DIDNT_VOTED;
	//define query to check if user voted on this question
	$query = "SELECT * FROM ".$TABLE_ANSWER." WHERE "
			.$ANSWER_QUESTION_FK_COLUMN."=:questionID AND ".$ANSWER_USER_FK_COLUMN."=:userID";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":questionID" => $questionID,
		":userID" => $userID
	)); 
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	if (count($result)>0)
	{
		//user voted
		return $USER_VOTED;
	}
	//otherwise user didn't voted
	return $USER_DIDNT_VOTED;
}
/* 
	DESCRIPTION: This function returns voting results in percents.
	WHEN TO USE: When there is a need to get voting results.
	PARAMETERS: $con - connection to database,
				$questionID - integer representing question's ID.
	RETURNS: array of doubles, representing voting results.
	EXAMPLE: $results = GetResultsInPercents($con,5); 
*/
function GetResultsInPercents($con,$questionID)
{
	//defining keywords
	global $TABLE_QUESTION,$QUESTION_RESULT1_COLUMN, $QUESTION_RESULT2_COLUMN, 
		$QUESTION_RESULT3_COLUMN, $QUESTION_RESULT4_COLUMN, $QUESTION_ID_COLUMN;
	//define query to get voting results
	$query = "SELECT ".$QUESTION_RESULT1_COLUMN.",".$QUESTION_RESULT2_COLUMN.","
			.$QUESTION_RESULT3_COLUMN.",".$QUESTION_RESULT4_COLUMN." FROM ".$TABLE_QUESTION." WHERE ".$QUESTION_ID_COLUMN."=:id";
	///prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":id" => $questionID
	)); 
	//getting the result
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	$row = $result[0];
	return $row;
}
?>