<?php
require_once("GlogalVariables/DatabaseKeywords.php");
require_once("GlogalVariables/Flags.php");
require_once("DatabaseQueries/UserManipulationQueries.php");
require_once("DatabaseQueries/PollManipulationQueries.php");
require_once("DatabaseQueries/ImagesManipulationQueries.php");
require_once("DatabaseQueries/CategoryManipulationQueries.php");
require_once("DatabaseQueries/ReviewManipulationQueries.php");
require_once("DatabaseQueries/ImpressionsManipulationQueries.php");
require_once("DatabaseQueries/CommentsManipulationQueries.php");
require_once("DatabaseQueries/MessagesManipulationQueries.php");
/* 
	DESCRIPTION: This function creates and returns connection to database.
	WHEN TO USE: When connection to database is needed make the call.
	PARAMETERS: None.
	RETURNS: Connection to database.
	EXAMPLE: $connection_variable = connect(); 
*/
function connect()
{
	// using global keywords
	global $DATABASE_NAME,$DATABASE_SERVER,$DATABASE_USERNAME,$DATABASE_PASSWORD;
	//connect to database with username and password otherwise stop the connection
	try {
		$con = new PDO("mysql:host=".$DATABASE_SERVER.";dbname=".$DATABASE_NAME, $DATABASE_USERNAME, $DATABASE_PASSWORD);
		//enableing error messages
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//set encoding to support cyrilic
		$con->exec("set names utf8");
		//return connection
		return $con;
	} 
	catch(PDOException $e)
	{
		//print error
		echo 'ERROR: ' . $e->getMessage();
		//return null
		return null;
	}
}
?>