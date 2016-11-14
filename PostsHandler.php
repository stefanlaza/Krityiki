<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////            ADDING AND UPDATING QUESTION OF THE DAY              ///////////////////////////
///////////////////////////            ADDING AND UPDATING QUESTION OF THE DAY              ///////////////////////////
///////////////////////////            ADDING AND UPDATING QUESTION OF THE DAY              ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once('DatabaseQueries.php');
require_once('recaptchalib.php');
require_once('AvatarUpload.php');


/* if moderator/administrator wants to add new question of the day this block of code will execute */
if (isset($_POST['addQuestionOfTheDay']))
{
	//getting variables which are sent through POST
	$question = $_POST['questionText'];
	$answer1 = $_POST['answer1'];
	$answer2 = $_POST['answer2'];
	$answer3 = $_POST['answer3'];
	$answer4 = $_POST['answer4'];
	//converting date to datetime
	$date = date('Y-m-d H:i:s',strtotime('+1 day', strtotime($_POST['dateToShow'])));
	//getting current date and time
	$now =  date('Y-m-d H:i:s',strtotime('now'));
	//if text of question is not empty
	if (strlen($question)>0)
	{
		//and first answer is not empty
		if (strlen($answer1)>0)
		{
			//and third
			if (strlen($answer2)>0)
			{
				//there are 2 answers so far, and they are obligatory
				$num_of_answers = 2;
				//if there is third answer
				if (strlen($answer3)>0)
				{
					//increase counter
					$num_of_answers++;
				}
				//if there is fourth answer
				if (strlen($answer4)>0)
				{
					//increase counter
					$num_of_answers++;
				}
				//if chosen date is in future we can proceed
				if ($date > $now)
				{
					//creating array of answers
					if ($num_of_answers==2)
						$answers = array($answer1,$answer2);
					else if ($num_of_answers==3)
						$answers = array($answer1,$answer2,$answer3);
					else
						$answers = array($answer1,$answer2,$answer3,$answer4);
					//defining action which is currently used
					if (isset($_POST['action']))
						$action = 'update';
					else
						$action = 'add';
					if ($action=='add')
						//try to create poll
						$flag = CreatePoll($question,$answers,$date); 
					else
						$flag = ChangePoll($_POST['questionID'],$question,$answers,$date);
					//show notification if it was created or not
					ShowAddingPollNotification($flag);
				}
				else
				{
					//datetime is empty, notify user
					ShowAddingPollError(array($question,$answer1,$answer2,$answer3,$answer4),$action);
				}
			}
			else
			{
				//second answer is empty, notify user
				ShowAddingPollError(array($question,$answer1),$action);
			}
		}
		else
		{
			//first answer is empty, notify user
			ShowAddingPollError(array($question),$action);
		}
	}
	else
	{
		//question is empty, notify user
		ShowAddingPollError(null,$action);
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////          DELETE OR UPDATE QUESTION OF THE DAY COMMAND           ///////////////////////////
///////////////////////////          DELETE OR UPDATE QUESTION OF THE DAY COMMAND           ///////////////////////////
///////////////////////////          DELETE OR UPDATE QUESTION OF THE DAY COMMAND           ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['questionID']) && isset($_GET['action']))
{
	//taking questionID and action
	$id = $_GET['questionID'];
	$action = $_GET['action'];
	
	//if action is delete
	if ($action == "delete")
	{
		//delete poll
		$flag = DeletePoll($id);
		//show message
		ShowDeletePostNotification($flag);
	}
	//if action is edit
	else if ($action == "edit")
	{
		//return poll to edit
		$poll = ReturnPoll($id);
		//checking NULLABLE answers
		if ($poll[5]==null)
			$poll[5]='';
		if ($poll[6]==null)
			$poll[6]='';
		//show update form
		ShowAddPoll($poll[1],$poll[3],$poll[4],$poll[5],$poll[6],$poll[7],"update",$id);
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////          REGISTER USER COMMAND                                  ///////////////////////////
///////////////////////////          REGISTER USER COMMAND                                  ///////////////////////////
///////////////////////////          REGISTER USER COMMAND                                  ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//if user submit register form/////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['userRegistrationFormSumbited']))
{
    $privatekey = "6LfAadoSAAAAAGRq2-ipQeNc4zyhdX56B2qQWX8e";
    $resp = recaptcha_check_answer ($privatekey,
                            $_SERVER["REMOTE_ADDR"],
                            $_POST["recaptcha_challenge_field"],
                            $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) 
    {
       $err[] = 'Captcha is not valid!';
	   $_SESSION['msg']['captcha-err'] = implode('<br />',$err);
	   //header("Location: register.php");
    }
    else 
    {
		$con=connect();
		if(isset($_POST['showMailToOtherUsers']) && 
			$_POST['showMailToOtherUsers'] == '1')
		{
			$visible = 1;
		}
		else
			$visible = 0;
        $flag = RegisterUser($con,$_POST["userName"],
                      $_POST["password"],
                      $_POST["email"],
                      $_POST["citizenship"],
                      $_POST["sex"],
                      $_POST["additionalInformation"],
                      $_POST["age"],
                      $visible);
		if ($flag == $USERNAME_EXISTS)
		{
			$err[]='Username already exists!';
			$_SESSION['msg']['username-err'] = implode('<br />',$err);
		}
		else if ($flag == $EMAIL_EXISTS)
		{
			$err[]='Email already exists!';
			$_SESSION['msg']['email-err'] = implode('<br />',$err);
		}
		else
		{
			session_name('kritikyi');
			session_set_cookie_params(2*7*24*60*60);
			session_start();
			$user = CheckCredentials($con,$_POST['userName'],$_POST['password']);
			if ($user!=$USER_DOESNT_EXIST)
			{
				$_SESSION['id']=$user[0];
				$_SESSION['username'] = $user[1];
				$_SESSION['role']=$user[6];
				$_SESSION['rememberMe']=(int)1;
				
				setcookie('cookieRememberMe',(int)1);
			}
			header("Location: index.php");
			$con=null;
			exit;
		}
		$con=null;
    }
}
if (isset($_GET['deleteUserID']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$flag=DeleteUser($con,$_GET['deleteUserID'],false,false);
	$con=null;
	header("Location: index.php");
}
if (isset($_POST['saveChangesButton']))
{
	$con=connect();
	if(isset($_POST['edit_showMailToUsers']) && $_POST['edit_showMailToUsers'] == 'Yes')
	{
		$show = 1;
	}	
	else
	{
		$show = 0;
	}
	if ($_POST["edit_sex"] == "male")
	{
		$sex = 1;
	}
	else
	{
		$sex = 0;
	}
	$ret_flag = null;
	if ((isset($_FILES["avatar"]["size"]) && 
    ($_FILES["avatar"]["size"] > 0)))
	{
		$ret_flag = uploadAvatar($_FILES['avatar'],$FILE_SIZE_LIMIT,$USER_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	if($ret_flag == null)
	{
		$ret_flag = $_POST['oldImageId'];
		if ($ret_flag == 0)
		{
			$ret_flag = null;
		}
	}
	if ($_POST["edit_pass"] != null)
	{
		$flag_edit_info = EditUsersInformation($con,$_POST["idOfUserToEdit"],$_POST["usernameOfUserToEdit"],
													 $_POST["edit_pass"],$_POST["edit_email"],
													 $_POST["edit_citizenship"],$sex,
													 $_POST["edit_addinfo"],$ret_flag,$_POST["edit_age"],$show);
	}
	else
	{
		$flag_edit_info = EditUsersInformationWithoutPassword($con,$_POST["idOfUserToEdit"],$_POST["usernameOfUserToEdit"],
													 $_POST["edit_email"],
													 $_POST["edit_citizenship"],$sex,
													 $_POST["edit_addinfo"],$ret_flag,$_POST["edit_age"],$show);
	}
    $con=null;													
	header("Location: userProfile.php?id=".$_POST["idOfUserToEdit"]);
}
if(isset($_POST['cancelChangesButton']))
{
	header("Location: userProfile.php?id=".$_POST["idOfUserToEdit"]);
}
if(isset($_GET['userIdToPromoteToModerator']) && isset($_SESSION['id']) && $_SESSION['role'] == $ROLE_ADMINISTRATOR)
{

	$con=connect();
	$flag = ChangeUserRole($con,$_GET['userIdToPromoteToModerator'],$ROLE_MODERATOR);
	$con=null;
	header("Location: userProfile.php?id=".$_GET['userIdToPromoteToModerator']);
}
if(isset($_GET['moderatorIdToDenoteToUser']) && isset($_SESSION['id']) && $_SESSION['role'] == $ROLE_ADMINISTRATOR)
{
	$con=connect();
	$flag = ChangeUserRole($con,$_GET['moderatorIdToDenoteToUser'],$ROLE_USER);
	$con=null;
	header("Location: userProfile.php?id=".$_GET['moderatorIdToDenoteToUser']);
}
if(isset($_GET['adminIdToDenoteToModerator']) && isset($_SESSION['id']) && $_SESSION['role'] == $ROLE_ADMINISTRATOR)
{
	$con=connect();
	$flag = ChangeUserRole($con,$_GET['adminIdToDenoteToModerator'],$ROLE_MODERATOR);
	$con=null;
	header("Location: userProfile.php?id=".$_GET['adminIdToDenoteToModerator']);
}
if(isset($_GET['moderatorIdToPromoteToAdmin']) && isset($_SESSION['id']) && $_SESSION['role'] == $ROLE_ADMINISTRATOR)
{
	$con=connect();
	$flag = ChangeUserRole($con,$_GET['moderatorIdToPromoteToAdmin'],$ROLE_ADMINISTRATOR);
	$con=null;
	header("Location: userProfile.php?id=".$_GET['moderatorIdToPromoteToAdmin']);
}
if(isset($_POST['addReviewSubmit']))
{
	$con=connect();
	$reviewName=$_POST['addReviewNameInput'];
	$reviewBody=$_POST['addReviewBodyInput'];
	$reviewToCategory=$_POST['addReviewCategoryInput'];
	$reviewIMAGE=$_FILES['addReviewImageInput'];
	if (strlen($reviewBody)> 197)
	{
		$reviewShortDesc = substr($reviewBody,0,197).'...';
	}
	else
	{
		$reviewShortDesc = $reviewBody;
	}
	$reviewBody = str_replace(PHP_EOL, '<br />', $reviewBody);
		
	if ($_SESSION['role'] != $ROLE_REGULAR_USER)
	{
		$role = 1;
	}
	else 
	{
		$role = 0;
	}
	$ret_flag = null;
	if ((isset($_FILES["addReviewImageInput"]["size"]) && 
    ($_FILES["addReviewImageInput"]["size"] > 0)))
	
	{
		$ret_flag = uploadAvatar($reviewIMAGE,$FILE_SIZE_LIMIT,$REVIEW_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	
	$flag = AddNewReview($con,$_SESSION['id'], $reviewName, $reviewShortDesc, $reviewBody, $ret_flag, $REGULAR_REVIEW, $role, $reviewToCategory);
	$con=null;
	//header("Location: index.php");
}
if (isset($_POST['aproveReviewSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$reviewName=$_POST['addReviewNameInput'];
	$reviewBody=$_POST['addReviewBodyInput'];
	$reviewToCategory=$_POST['addReviewCategoryInput'];
	$reviewIMAGE=$_FILES['addReviewImageInput'];
	if (strlen($reviewBody)> 197)
	{
		$reviewShortDesc = substr($reviewBody,0,197).'...';
	}
	else
	{
		$reviewShortDesc = $reviewBody;
	}
	$reviewBody = str_replace(PHP_EOL, '<br />', $reviewBody);
		
	$role = 0;
	if ($_POST['oldAvatarID']!=0)
		$ret_flag = $_POST['oldAvatarID'];
	else
		$ret_flag = null;
	if ((isset($_FILES["addReviewImageInput"]["size"]) && 
    ($_FILES["addReviewImageInput"]["size"] > 0)))
	
	{
		$ret_flag = uploadAvatar($reviewIMAGE,$FILE_SIZE_LIMIT,$REVIEW_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	
	UpdateReview($con,$_POST['idOfReview'],$reviewName,$reviewShortDesc,$reviewBody,$ret_flag,$REGULAR_REVIEW,$reviewToCategory);
	ApproveReview($con, $_POST['idOfReview'],$reviewToCategory,$_POST['userID']);
	SendMessage($con,$_SESSION['id'],$_POST['userID'],"Congratulations, your review \"".$reviewName."\" has been accepted!");
	$con=null;
}
if(isset($_POST['declineReviewSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$reviewName=$_POST['addReviewNameInput'];
	DeclineReview($con,$_POST['idOfReview']);
	SendMessage($con,$_SESSION['id'],$_POST['userID'],"We are sorry, your review \"".$reviewName."\" has been declined! Please do not stop on this, try again :)");
	$con = null;
}
if(isset($_POST['addCategorySubmit'])  && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$categoryName=$_POST['addCategoryNameInput'];
	$categoryIMAGE=$_FILES['addCategoryImageInput'];
	$categoryShortDesc = "aaaa";
	$ret_flag = null;
	if ($categoryIMAGE!=null)
	{
		$ret_flag = uploadAvatar($categoryIMAGE,$FILE_SIZE_LIMIT,$CATEGORY_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	$flag = CreateCategory($con,$categoryName,$ret_flag,$categoryShortDesc, $REGULAR_CATEGORY, null, null);
	//$flag = AddNewReview($con,$_SESSION['id'], $reviewName, $reviewShortDesc, $reviewBody, $ret_flag, $REGULAR_REVIEW, $role, $reviewToCategory);
	$con=null;
	header("Location: controlPanel.php?section=1");
}
if (isset($_GET['deleteCategoryID']) && isset($_SESSION['id']) && $_SESSION['role']!=$ROLE_REGULAR_USER)
{
	$con=connect();
	$flag=DeleteCategory($con,$_GET['deleteCategoryID']);
	$con=null;
	header("Location: controlPanel.php?section=1");
}
if (isset($_GET['deleteTopicOfTheWeekID']) && isset($_SESSION['id']) && $_SESSION['role']!=$ROLE_REGULAR_USER)
{
	$con=connect();
	$flag=DeleteCategory($con,$_GET['deleteTopicOfTheWeekID']);
	$con=null;
	header("Location: controlPanel.php?section=6");
}
if (isset($_GET['deleteTopicOfTheMonthID']) && isset($_SESSION['id']) && $_SESSION['role']!=$ROLE_REGULAR_USER)
{
	$con=connect();
	$flag=DeleteCategory($con,$_GET['deleteTopicOfTheMonthID']);
	$con=null;
	header("Location: controlPanel.php?section=7");
}
if(isset($_POST['editCategorySubmit'])  && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$categoryID = $_POST['idOfCategoryToEdit'];
	$categoryName=$_POST['editCategoryNameInput'];
	$categoryIMAGE=$_FILES['editCategoryImageInput'];
	$categoryShortDesc = "aaaa";
	$ret_flag = null;
	if ((isset($_FILES["editCategoryImageInput"]["size"]) && 
    ($_FILES["editCategoryImageInput"]["size"] > 0)))
	{
		$ret_flag = uploadAvatar($categoryIMAGE,$FILE_SIZE_LIMIT,$CATEGORY_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	if($ret_flag == null)
	{
		$ret_flag = $_POST['oldAvatarID'];
		if ($ret_flag == 0)
		{
			$ret_flag = null;
		}
			
	}
	$flag =	UpdateCategory($con,$categoryID, $categoryName, $ret_flag,$categoryShortDesc, $REGULAR_CATEGORY, null, null);
	//$flag = CreateCategory($con,$categoryName,$ret_flag,$categoryShortDesc, $REGULAR_CATEGORY, null, null);
	//$flag = AddNewReview($con,$_SESSION['id'], $reviewName, $reviewShortDesc, $reviewBody, $ret_flag, $REGULAR_REVIEW, $role, $reviewToCategory);
	$con=null;
	header("Location: controlPanel.php?section=1");
}
if(isset($_POST['addTopicOfTheWeekSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$categoryName=$_POST['addCategoryNameInput'];
	$categoryIMAGE=$_FILES['addCategoryImageInput'];
	$fromDate = $_POST['fromDate']; 
	$toDate = $_POST['toDate'];
	$categoryShortDesc = "aaaa";
	$ret_flag = null;
	if ($categoryIMAGE!=null)
	{
		$ret_flag = uploadAvatar($categoryIMAGE,$FILE_SIZE_LIMIT,$CATEGORY_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	$flag = CreateCategory($con,$categoryName,$ret_flag,$categoryShortDesc, $TOPIC_OF_THE_WEEK, $fromDate, $toDate);
	//$flag = AddNewReview($con,$_SESSION['id'], $reviewName, $reviewShortDesc, $reviewBody, $ret_flag, $REGULAR_REVIEW, $role, $reviewToCategory);
	$con=null;
	header("Location: controlPanel.php?section=6");
}
if(isset($_POST['addTopicOfTheMonthSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$categoryName=$_POST['addCategoryNameInput'];
	$categoryIMAGE=$_FILES['addCategoryImageInput'];
	$fromDate = $_POST['fromDate']; 
	$toDate = $_POST['toDate'];
	$categoryShortDesc = "aaaa";
	$ret_flag = null;
	if ($categoryIMAGE!=null)
	{
		$ret_flag = uploadAvatar($categoryIMAGE,$FILE_SIZE_LIMIT,$CATEGORY_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	$flag = CreateCategory($con,$categoryName,$ret_flag,$categoryShortDesc, $TOPIC_OF_THE_MONTH, $fromDate, $toDate);
	//$flag = AddNewReview($con,$_SESSION['id'], $reviewName, $reviewShortDesc, $reviewBody, $ret_flag, $REGULAR_REVIEW, $role, $reviewToCategory);
	$con=null;
	header("Location: controlPanel.php?section=7");
}
if(isset($_POST['editTopicOfTheMonthSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$categoryID = $_POST['idOfCategoryToEdit'];
	$categoryName=$_POST['editCategoryNameInput'];
	$categoryIMAGE=$_FILES['editCategoryImageInput'];
	$categoryShortDesc = "aaaa";
	$fromDate = $_POST['editFromDate']; 
	$toDate = $_POST['editToDate'];
	$ret_flag = null;
	if ((isset($_FILES["editCategoryImageInput"]["size"]) && 
    ($_FILES["editCategoryImageInput"]["size"] > 0)))
	{
		$ret_flag = uploadAvatar($categoryIMAGE,$FILE_SIZE_LIMIT,$CATEGORY_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	if($ret_flag == null)
	{
		$ret_flag = $_POST['oldAvatarID'];
		if ($ret_flag == 0)
		{
			$ret_flag = null;
		}
			
	}
	$flag =	UpdateCategory($con,$categoryID, $categoryName, $ret_flag,$categoryShortDesc, $TOPIC_OF_THE_MONTH, $fromDate, $toDate);
	$con=null;
	header("Location: controlPanel.php?section=7");
}
if(isset($_POST['editTopicOfTheWeekSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$categoryID = $_POST['idOfCategoryToEdit'];
	$categoryName=$_POST['editCategoryNameInput'];
	$categoryIMAGE=$_FILES['editCategoryImageInput'];
	$categoryShortDesc = "aaaa";
	$fromDate = $_POST['editFromDate']; 
	$toDate = $_POST['editToDate'];
	$ret_flag = null;
	if ((isset($_FILES["editCategoryImageInput"]["size"]) && 
    ($_FILES["editCategoryImageInput"]["size"] > 0)))
	{
		$ret_flag = uploadAvatar($categoryIMAGE,$FILE_SIZE_LIMIT,$CATEGORY_AVATAR);
		if ($ret_flag == $UNKNOWN_IMAGE_EXTENSION)
		{
			echo "Unknown image extension";
		}
		else if ($ret_flag == $FILE_SIZE_LIMIT_EXCEEDED)
		{
			echo "File size limit exceeded";

		}
		                                                 
	}
	if($ret_flag == null)
	{
		$ret_flag = $_POST['oldAvatarID'];
		if ($ret_flag == 0)
		{
			$ret_flag = null;
		}
			
	}
	$flag =	UpdateCategory($con,$categoryID, $categoryName, $ret_flag,$categoryShortDesc, $TOPIC_OF_THE_WEEK, $fromDate, $toDate);
	$con=null;
	header("Location: controlPanel.php?section=6");
}
if(isset($_POST['addLetterSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	global $LETTER_OF_COMMITTEE;
	$con=connect();
	$reviewBody=$_POST['addReviewBodyInput'];
	if (strlen($reviewBody)> 197)
	{
		$reviewShortDesc = substr($reviewBody,0,197).'...';
	}
	else
	{
		$reviewShortDesc = $reviewBody;
	}
	$reviewBody = str_replace(PHP_EOL, '<br />', $reviewBody);
	
	$flag = AddNewReview($con,$_SESSION['id'], "Letter of creative commitee1", $reviewShortDesc, $reviewBody, null, $LETTER_OF_COMMITTEE, 1, null);
	$con=null;
	//header("Location: index.php");
}
if(isset($_POST['addPollSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$pollName=$_POST['addCategoryNameInput'];
	$pollAnswer1=$_POST['addCategoryAnswer1Input'];
	$pollAnswer2=$_POST['addCategoryAnswer2Input'];
	$pollAnswer3=$_POST['addCategoryAnswer3Input'];
	$pollAnswer4=$_POST['addCategoryAnswer4Input'];
	if (!empty($_POST['addCategoryAnswer3Input']))
		if (!empty($_POST['addCategoryAnswer4Input']))
			$answers = array($pollAnswer1,$pollAnswer2,$pollAnswer3,$pollAnswer4);
		else
			$answers = array($pollAnswer1,$pollAnswer2,$pollAnswer3);
	else
		$answers = array($pollAnswer1,$pollAnswer2);
	$pollExpDate=$_POST['expDate'];

	$flag = CreatePoll($con,$pollName,$answers,$pollExpDate); 
	$con=null;
	header("Location: controlPanel.php?section=3");
}
if (isset($_POST['editPollSubmit']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con=connect();
	$pollName=$_POST['addCategoryNameInput'];
	$pollAnswer1=$_POST['addCategoryAnswer1Input'];
	$pollAnswer2=$_POST['addCategoryAnswer2Input'];
	$pollAnswer3=$_POST['addCategoryAnswer3Input'];
	$pollAnswer4=$_POST['addCategoryAnswer4Input'];
	if (!empty($_POST['addCategoryAnswer3Input']))
		if (!empty($_POST['addCategoryAnswer4Input']))
			$answers = array($pollAnswer1,$pollAnswer2,$pollAnswer3,$pollAnswer4);
		else
			$answers = array($pollAnswer1,$pollAnswer2,$pollAnswer3);
	else
		$answers = array($pollAnswer1,$pollAnswer2);
	$pollExpDate=$_POST['expDate'];

	$flag = ChangePoll($con,$_GET['id'],$pollName,$answers,$pollExpDate); 
	//$flag = CreateCategory($con,$categoryName,$ret_flag,$categoryShortDesc, $REGULAR_CATEGORY, null, null);
	//$flag = AddNewReview($con,$_SESSION['id'], $reviewName, $reviewShortDesc, $reviewBody, $ret_flag, $REGULAR_REVIEW, $role, $reviewToCategory);

	$con=null;
	header("Location: controlPanel.php?section=3");
}
if(isset($_GET['deleteReviewID']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con = connect();
	$review = ReturnReviewById($con,$_GET['deleteReviewID']);
	$flag = DeleteReview($con,$review[0],$review[1],$review[11]);
	$con = null;
}
if(isset($_GET['deleteQuestionID']) && isset($_SESSION['id']) && $_SESSION['role'] != $ROLE_REGULAR_USER)
{
	$con = connect();
	$flag = DeletePoll($con,$_GET['deleteQuestionID']);
	$con = null;
}
if(isset($_POST['submitCommentToReview']))
{
	$con = connect();
	$flag = AddNewComment($con, $_POST['submitCommentUserId'],$_POST['submitCommentReviewId'],$_POST['submitCommentBody'],$COMMENT_ON_REVIEW,null);
	$con = null;
}
if(isset($_POST['submitCommentToQuestion']))
{
	$con = connect();
	$flag = AddNewComment($con, $_POST['submitCommentUserId'],null,$_POST['submitCommentBody'],$COMMENT_ON_QUESTION,$_POST['submitCommentReviewId']);
	$con = null;
}
if(isset($_POST['submitComment']))
{
	$con = connect();
	SendMessage($con,$_POST['loggedUser'],$_POST['otherUser'],$_POST['commentText']);
	$con = null;
}
?>