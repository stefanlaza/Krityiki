<?php
//adds new message
function SendMessage($con,$fromUser,$toUser,$text)
{
	global $TABLE_MESSAGES,$MESSAGES_ID_COLUMN, $MESSAGES_FROM_COLUMN, $MESSAGES_TO_COLUMN, $MESSAGES_TEXT_COLUMN,
	$MESSAGES_SENT_ON_COLUMN, $MESSAGES_IS_READ_COLUMN;
	
	//defining query to add comment
	$query = "INSERT INTO ".$TABLE_MESSAGES." (".$MESSAGES_ID_COLUMN.", ".$MESSAGES_FROM_COLUMN.", ".$MESSAGES_TO_COLUMN.", "
		.$MESSAGES_TEXT_COLUMN.", ".$MESSAGES_SENT_ON_COLUMN.", ".$MESSAGES_IS_READ_COLUMN.") VALUES (NULL,:fromID,:toID,:text,now(),0)";
	
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":fromID" => $fromUser,
		":toID" => $toUser,
		":text" => $text
	));
	//returning the flag
	return true;
}
//returns integer representing unread messages for user with userID
function ReturnNumberOfNewMessages($con, $userID)
{
	global $TABLE_MESSAGES,$MESSAGES_ID_COLUMN, $MESSAGES_FROM_COLUMN, $MESSAGES_TO_COLUMN, $MESSAGES_TEXT_COLUMN,
	$MESSAGES_SENT_ON_COLUMN, $MESSAGES_IS_READ_COLUMN;
	//defining query to add comment
	$query = "SELECT COUNT(*) FROM ".$TABLE_MESSAGES." WHERE ".$MESSAGES_TO_COLUMN."=:user AND ".$MESSAGES_IS_READ_COLUMN."=0";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		":user" => $userID
	));
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//returning the flag
	return $result[0];
}
//vraca result (moze da bude null ili niz)
function ReturnUsersInConversations($con,$userID)
{
	global $TABLE_MESSAGES,$MESSAGES_ID_COLUMN, $MESSAGES_FROM_COLUMN, $MESSAGES_TO_COLUMN, $MESSAGES_TEXT_COLUMN,
	$MESSAGES_SENT_ON_COLUMN, $MESSAGES_IS_READ_COLUMN;
	//defining query to add comment
	$query = "SELECT DISTINCT LEAST(".$MESSAGES_FROM_COLUMN.", ".$MESSAGES_TO_COLUMN.") AS `v1`, GREATEST(".$MESSAGES_FROM_COLUMN.
			", ".$MESSAGES_TO_COLUMN.") AS `v2` FROM ".$TABLE_MESSAGES." WHERE ".$MESSAGES_FROM_COLUMN."=:user OR "
				.$MESSAGES_TO_COLUMN."=:user1 ORDER BY ".$MESSAGES_SENT_ON_COLUMN." DESC";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':user'=>$userID,
		':user1'=>$userID
	));
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//returning the flag
	return $result;
}
//from je neko ko je slao
//to je user kome se proveravaju poruke
//vraca se broj poruka neprocitanih
function NewMessageFromUser($con,$from,$to)
{
	global $TABLE_MESSAGES,$MESSAGES_ID_COLUMN, $MESSAGES_FROM_COLUMN, $MESSAGES_TO_COLUMN, $MESSAGES_TEXT_COLUMN,
	$MESSAGES_SENT_ON_COLUMN, $MESSAGES_IS_READ_COLUMN;
	//defining query to add comment
	$query = "SELECT COUNT(*) FROM ".$TABLE_MESSAGES." WHERE ".$MESSAGES_FROM_COLUMN."=:user1 AND "
				.$MESSAGES_TO_COLUMN."=:user2 AND ".$MESSAGES_IS_READ_COLUMN."=0";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':user1'=>$from,
		':user2'=>$to
	));
	$result = $statement->fetch(PDO::FETCH_BOTH);
	//returning the flag
	return $result[0];
}
//vraca sve chatove sortirane od najstarije ka najnovije izmedju dva usera (nije bitan raspored)
function ReturnEntireConversationWithUser($con,$user1,$user2)
{
	global $TABLE_MESSAGES,$MESSAGES_ID_COLUMN, $MESSAGES_FROM_COLUMN, $MESSAGES_TO_COLUMN, $MESSAGES_TEXT_COLUMN,
	$MESSAGES_SENT_ON_COLUMN, $MESSAGES_IS_READ_COLUMN;
	//defining query to add comment
	$query = "SELECT * FROM ".$TABLE_MESSAGES." WHERE (".$MESSAGES_FROM_COLUMN."=:user1 AND "
				.$MESSAGES_TO_COLUMN."=:user2) OR (".$MESSAGES_FROM_COLUMN."=:user3 AND "
				.$MESSAGES_TO_COLUMN."=:user4) ORDER BY ".$MESSAGES_SENT_ON_COLUMN;
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':user1'=>$user1,
		':user2'=>$user2,
		':user3'=>$user2,
		':user4'=>$user1
	));
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//returning the flag
	return $result;
}
function SetConversationAsRead($con,$conversationID)
{
	global $TABLE_MESSAGES,$MESSAGES_ID_COLUMN, $MESSAGES_FROM_COLUMN, $MESSAGES_TO_COLUMN, $MESSAGES_TEXT_COLUMN,
	$MESSAGES_SENT_ON_COLUMN, $MESSAGES_IS_READ_COLUMN;
	//defining query to add comment
	$query = "UPDATE ".$TABLE_MESSAGES." SET ".$MESSAGES_IS_READ_COLUMN."=1 WHERE ".$MESSAGES_ID_COLUMN."=:id";
	//prepare query
	$statement = $con->prepare($query);
	//assign variables and run
	$statement->execute(array(
		':id'=>$conversationID
	));
	$result = $statement->fetchAll(PDO::FETCH_BOTH);
	//returning the flag
	return $result;
}
?>