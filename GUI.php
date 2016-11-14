<?php
require_once('DatabaseQueries.php');
require_once('Login.php');
require_once("PostsHandler.php");
function PrintAboutUsColumn()
{
	echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>About us</span>
					</div>
					<div id='userAreaContent' class='content'>
						<div id='aboutUsIdea'>
							<div class='aboutUsHeader greyGradient' id='aboutUsHeader1'>
								<span>Миссия и Идея</span>
							</div>
							<div class='aboutUsText'>
								<p class='aboutUsTextParagraph'><i>Истина питается критикой (Г.В. Плеханов)</i></p><br />
								<p class='aboutUsTextParagraph'>О чем Вы говорите со своими друзьями, когда собираетесь вместе? Как жизнь? Что нового? Мы делимся впечатлениями о том, где  были, что видели, где нам хорошо и где плохо.</p><br />
								<p class='aboutUsTextParagraph'>Нас окружает замечательный мир, но он не идеален. Многие из нас стремятся сделать этот мир лучше. Развитие - это движение вперед. В каком направлении двигаетесь Вы? </p><br />
								<p class='aboutUsTextParagraph'>Создатели этого проекта представляют открытую площадку для обсуждения самых различных тем, за исключением погоды и политики, а также перемывания костей конкретных людей.</p><br />
								<p class='aboutUsTextParagraph'>Здесь Вы можете раскритиковать не только о прочитанную книгу, увиденный фильм, купленный товар, проведенный отдых, но и автодорожное устройство Вашего города, инвестиционную стратегию Вашего сберегательного фонда, белковую диету или же просто поделиться мнением о вопросах мироздания.</p><br />
								<p class='aboutUsTextParagraph'>Мы предлагаем перенести  разрозненные дискуссии из сетей, мессаджеров и т.п. на единую площадку, где можно всесторонне изучить имеющейся опыт по заданной теме и написать свои комментарии.</p><br />
								<p class='aboutUsTextParagraph'>Расскажите о том, что Вы думаете. Поделитесь Вашими мыслями и идеями. Напишите рецензию, комментарий и вступите в наше дискуссионное братство! Конструктивная критика приветсвуется. :)</p>
							</div>
							<div class='aboutUsHeader greyGradient' id='aboutUsHeader2'>
								<span>Устав и правила</span>
							</div>
							<div class='aboutUsText'>
								<p class='aboutUsTextParagraph'>text text text</p>
							</div>
							<div class='aboutUsHeader greyGradient' id='aboutUsHeader3'>
								<span>Creative Commitee</span>
							</div>
							<div class='aboutUsText'>
								<p class='aboutUsTextParagraph'>text text text</p>
							</div>
							<div class='aboutUsHeader greyGradient'id='aboutUsHeader4'>
								<span>How to post a review</span>
							</div>
							<div class='aboutUsText'>
								<p class='aboutUsTextParagraph'>text text text</p>
							</div>
							<div class='aboutUsHeader greyGradient' id='aboutUsHeader5'>
								<span>Контакты</span>
							</div>
							<div class='aboutUsText'>
								<form method='post' action='' onsubmit='return kontaktform();'>
								<div id='contactForm'>";
									if (isset($_POST['contactButton']))
									echo "<center><span>You submitted email successfully!</span></center>";
									echo "<div id='contactFormLeft'>
										<p class='contactFormText'>Name:</p>
										<p class='contactFormText'>E-mail:</p>
										<p class='contactFormText'>Subject:</p>
										<p class='contactFormText'>Message:</p>
									</div>
									<div id='contactFormRight'>
										<input type='text' value='' id='contactFormInputName' style='float:left'/>
										<div class='registerWarning' style='text-align:left; float:left; width:100px; margin-top:5px; margin-left:20px; margin-bottom: 0px;'>
											<span id='wrongNameWarning' style='display:none'>
											</span>
										</div>
										<input type='text' value='' id='contactFormInputEmail' style='float:left'/>
										<div class='registerWarning' style='text-align:left; float:left; width:100px; margin-top:5px; margin-left:20px; margin-bottom: 0px;'>
											<span id='wrongEmailWarning' style='display:none'>
											
											</span>
										</div>
										<input type='text' value='' id='contactFormInputSubject' style='float:left' />
										<div class='registerWarning' style='text-align:left; float:left; width:100px; margin-top:5px; margin-left:20px; margin-bottom: 0px;'>
											<span id='wrongSubjectWarning' style='display:none'>
											
											</span>
										</div>
										<textarea rows='5' maxlength='5000' id='contactFormInputMessage'></textarea>
										<div class='registerWarning' style='text-align:left; float:left; width:100px; margin-top:-10px; margin-left:20px; margin-bottom: 0px;'>
											<span id='wrongMessageWarning' style='display:none' >
											
											</span>
										</div>
										<button type='submit' name='contactButton' id='contactFormSubmit'></button>
									</div>
									
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>";
}
function PrintLogoAndMenu()
{
	echo "<div id='menu'><span>Обо всем, кроме погоды, политики, не переходя на личности</span></div>
			<div id='buttons'>
			<a href='#' data-dropdown='#dropdown-1'>
			<div id='menubutton1'>
				<span>О проекте</span>
				<img src='images/gui/red_arrow.png' alt='red_arrow1' />
				<div id='dropdown-1' class='dropdown-menu'>
					<ul>
						<li><a href='aboutUs.php#aboutUsHeader1'>Idea</a></li>
						<li><a href='aboutUs.php#aboutUsHeader2'>Rules and agreement</a></li>
						<li><a href='aboutUs.php#aboutUsHeader3'>Creative Commitee</a></li>
						<li><a href='aboutUs.php#aboutUsHeader4'>How to post a review</a></li>
						<li><a href='aboutUs.php#aboutUsHeader5'>Contacts</a></li>
					</ul>
				</div>
			</div>
			</a>
			<a href='#' data-dropdown='#dropdown-2'>
			<div id='menubutton2'>
				<span>Категории</span>
				<img src='images/gui/red_arrow.png' alt='red_arrow1' />
				<div id='dropdown-2' class='dropdown-menu has-scroll'>
					<ul>";
	$con = connect();
	$allCategories = ReturnAllCategories($con);
	if ($allCategories!=null)
		if (!is_array($allCategories[0]))
			$allCategories = array($allCategories);
	if ($allCategories!=null)
		foreach ($allCategories as $category)
			echo "<li><a href='viewCategory.php?categoryID=".$category[0]."'>".$category[1]."</a></li>";
	echo "		</ul>
				</div>
			</div>
			</a>
			<a href='#' data-dropdown='#dropdown-3'>
			<div id='menubutton3'>
				<span>Архив</span>
				<img src='images/gui/red_arrow.png' alt='red_arrow1' />
				<div id='dropdown-3' class='dropdown-menu'>
					<ul>
						<li><a href='viewLetters.php'>Letter of management committee</a></li>
						<li><a href='viewQuestions.php'>Question of the day</a></li>
						<li><a href='viewAllCategories.php?topicsOfTheMonth=1'>Topic of the month</a></li>
						<li><a href='viewAllCategories.php?topicsOfTheWeek=1'>Topic of the week</a></li>
					</ul>
				</div>
			</div>
			</a>
			<div id='menusearch'>
			<img src='images/gui/search_icon.png' alt='searchicon' />
				<span>Поиск:</span>
				<form method='post' action='search.php'>
				<input type='text' name='search_box' class='searchbox' data-dropdown='#dropdown-s'
					onkeydown='if (event.keyCode == 13) { this.form.submit(); return false; }'/>
				<div id='dropdown-s' class='dropdown-menu has-scroll'>
					<ul>
						<li><a href='#1'><input name='category_to_search' type='radio' checked value='0'/>All</a></li>";
	if ($allCategories!=null)
		foreach ($allCategories as $category)
			echo "<li><a href='#1'><input type='radio' name='category_to_search' value='".$category[0]."'/>".$category[1]."</a></li>";
	echo 			"</ul>
				</div>
				</form>
			</div>
		</div>";
	$con = null;
}
function PrintFirstColumn($con)
{
	echo "<div id='firstcolumn'>";
	if (!isset($_SESSION['id']))
	{
		PrintLoginForm($con);
	}
	else
	{
		PrintLoggedUserForm($con);
	}
	PrintMostPopularCategories($con);
	echo "</div>";
}
function PrintSecondColumn($con)
{
	echo "<div id='secondcolumn'>";
	PrintTopics($con);
	echo "		<div id='leftSubColumn'>";
	PrintMostPopularReview($con);				
	echo "	</div>";
	echo "		<div id='rightSubColumn'>";
	PrintQuestionOfTheDay($con);
	PrintLatestReviews($con);			
	echo "		</div>
			</div>";
}

function PrintLoginForm($con)
{
	echo "	<form method='post' action='' onsubmit='return loginvalidation();'>
			<div id='loginBox' class='shadow borderRadius'>
				<div id='loginHeader' class='gradientHeader blueStripe'>
					<span>Войти</span>
				</div>
				<div id='loginContent' class='content'>
					<input type='text' name='username' placeholder='Логин:' id='username' style='height:28px'/>
					<input type='password' name='password' placeholder='Пароль:' id='password' style='height:28px' />";
	if (isset($_SESSION['msg']['login-err']))
	{
		echo "		<span id='wrongpass' style='font-size:12px; color:red;'>".$_SESSION['msg']['login-err']."</span>";
		unset($_SESSION['msg']['login-err']);
	}
	else
		echo "		<span id='wrongpass' style='font-size:12px; color:red; display:none'></span>";
	echo "			<div id='remember'>
					<input name='rememberMe' id='remember_me' type='checkbox' checked />
					<label for='remember_me'>Запомнить</label>
				</div>
				<button name='login' id='login'></button>
			</div>
			<a href='register.php' style='text-decoration:none'>
			<div id='registration' class='greyGradient'>
				<span>Зарегестрироваться</span>
			</div>
			</a>
			<a href='forgotPassword.php' style='text-decoration:none; color:#000000'>
			<div id='forgotPassword' class='content' >
				<span>Вспомнить пароль?</span>
			</div>
			</a>
		</div>
		</form>";
}
function PrintLoggedUserForm($con)
{
	global $ROLE_ADMINISTRATOR, $ROLE_MODERATOR, $HOME_USER_AVATAR_PATH;
    $user = ReturnUser($con,$_SESSION['id']);
    echo "<div id='loginBox' class='shadow borderRadius'>  
			<div id='loginHeader' class='gradientHeader blueStripe'>
                    <img src='images/gui/login.png' alt='lock' />
                    <span>Профиль</span>
            </div>
            <div id='profileContent' class='content'>
                <div id='profileFirstRow'>
                    <div id='profileThumb'>";
	$profilePicture = "noimage.png";
	if ($user[10]!=null)
	{
		$image = ReturnImage($con,$user[10]);
		$profilePicture = $image[1];
	}
	$number_of_messages = ReturnNumberOfNewMessages($con, $user[0]);
    echo "	          <img src='".$HOME_USER_AVATAR_PATH."/".$profilePicture."' />
                    </div>
                    <div id='welcome_text'>
                        <p class='blackText'>Добро пожаловать!</p>
                        <img src='images/gui/smiley.png' alt='smiley' />
                        <span class='greyText'>И снова здравствуйте!</span>
                    </div>
                </div>
                <div class='profileOptionsRow'>
                    <img src='images/gui/profile.png' alt='profile' />
                    <a href='userProfile.php' class='greyText'>Профиль</a>
                </div>
                <div class='profileOptionsRow' style='height:16px'>
                    <img src='images/gui/messages.png' alt='messages'/>
                    <a href='messages.php' class='greyText'>Сообщения";
	if ($number_of_messages>0)
		echo " (".$number_of_messages.")";
				echo "</a>
                </div>
                <div class='profileOptionsRow'>
                    <img src='images/gui/home.png' alt='home'>
                    <a href='index.php' class='greyText'>На главную страницу</a>
                </div>";
                
    if ($user[6] == $ROLE_ADMINISTRATOR || $user[6] == $ROLE_MODERATOR)
    {
        echo "
                <div class='profileOptionsRow'>
                    <img src='images/gui/cpanel.png' alt='control panel' />
                    <a href='controlPanel.php?section=1' class='greyText'>Контрольная панель</a>
                </div>";
    }
    echo "
                <div class='profileOptionsRow'>
                    <img src='images/gui/postreview.png' alt='post review' />
                    <a href='postReview.php' class='greyText'>Разместить рецензию</a>
                </div>
            </div>
            <a href='".$_SERVER['PHP_SELF']."?logout=1' style='text-decoration:none; color:#000000'>
            <div class='comments' >
                <img src='images/gui/logout.png'  alt='log out' id='logoutImage'/>
                <span style='font-size:14px; margin:0px; padding:0px; float:left; color:#000000'>Выйти</span>
            </div>
            </a>
		</div>";
}
function PrintMostPopularCategories($con)
{
	echo "<div id='categoriesBox' class='shadow borderRadius'>
					<div id='categoriesHeader' class='gradientHeader redStripe'>
						<span>Популярные категории</span>
					</div>
					<div id='categoriesContent' class='content'>";
	$result_most_popular = ReturnMostPopularCategories($con,5);
	if ($result_most_popular!=null)
		if (!is_array($result_most_popular[0]))
			$result_most_popular = array($result_most_popular);
    $i = 1;
	if ($result_most_popular!=null)
	{
	foreach ($result_most_popular as $row_most_popular)
	{
		echo "			<a href='viewCategory.php?categoryID=".$row_most_popular[0]."'>
							<div class='outer' ";
		if ($i == 5)
        {
        echo "style='height:67px' ";
        }
		echo "				>
								<div class='popularCategory' ";
		if ($i == 5)
        {
        echo "style='height:67px' ";
        }
		echo "					>
									<p><img src='images/gui/pin.png' alt='pin' />
									".$row_most_popular[1]."</p>
								</div>
							</div>
						</a>";
		$i++;
	}
	}
	echo "			</div>
					<a href='viewAllCategories.php'>
					<div class='comments'>
						<div id='seemore'>
							<img src='images/gui/see_more.png' alt='' />
						</div>
					</div>
					</a>
				</div>";
}
function PrintTopics($con)
{
	echo "<div id='topicsBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Темы</span>
					</div>
					<div id='topicsContent' class='content'>";
	PrintTopicOfTheMonth($con);
	PrintTopicOfTheWeek($con);
						
						
	echo "			</div>
				</div>";
}
function PrintTopicOfTheMonth($con)
{
	$result = ReturnActiveTopicOfTheMonth($con);
	echo "<div id='topicOfTheMonth'>
							<div class='topicName'>
								<span>Тема </span><span style='padding-left: 0px; color:#920303'>месяца:</span>";
	if ($result != null)
		echo "  					<a href='viewCategory.php?categoryID=".$result[0]."'>
									<span class='topicText'>".$result[1]."</span></a>
								</div>
								<div class='topicReviews'>
									<span>".$result[4]."</span>
								</div>";
	else
        echo "  				<span class='topicText'>There is no topic at the moment</span>
								</div>
								<div class='topicReviews'>
									<span>0</span>
								</div>";
	echo "</div>";
}
function PrintTopicOfTheWeek($con)
{
	$result = ReturnActiveTopicOfTheWeek($con);
	echo "<div id='topicOfTheWeek'>
							<div class='topicName'>
								<span>Тема </span><span style='padding-left: 0px; color:#920303'>недели:</span>";
	if ($result != null)
    {
        echo "  				<a href='viewCategory.php?categoryID=".$result[0]."'>
								<span class='topicText'>".$result[1]."</span></a>
							</div>
							<div class='topicReviews'>
								<span>".$result[4]."</span>
							</div>";
    }
    else
    {
        echo "  				<span class='topicText'>There is no topic at the moment</span>
							</div>
							<div class='topicReviews'>
								<span>0</span>
							</div>";
    }
								
	echo "					</div>";
}
function PrintMostPopularReview($con)
{
	global $HOME_REVIEW_AVATAR_PATH,$DISLIKE_TAG,$LIKE_TAG,$LIKE,$DISLIKE,$COMMENT_ON_REVIEW;
	echo "<div id='mostPopularReviewBox' class='shadow borderRadius'>
						<div id='mostPopularReviewHeader' class='gradientHeader redStripe' style='line-height:25px'>
							<span>Самая популярная рецензия</span>
						</div>
						<div id='mostPopularReviewContent' class='content'>";
	$review = ReturnMostPopularReview($con);
    if ($review != null)
	{
		$commentsNO = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
		$user = ReturnUser($con,$review[1]);
        $dtime = new DateTime($review[10]);
        $postedON = $dtime->format("d.m.Y");
		$image = array();
		if ($user != null)
		{
			$username=$user[1];
		}
		else
		{
			$username="Deleted user";
		}
        if ($review[5] != null)
        {
            $image = ReturnImage($con,$review[5]); 
        }
        else 
        {
            $image[1] = 'noImage.jpg';
        }
        $category = ReturnCategoryById($con,$review[11]);
		if ($category !=null)
		{
			$categoryname = $category[1];
		}
		else
		{
			$categoryname = "unknown category";
		}
        if (isset($_SESSION['id']))
        {
            $flag = DidUserLikedReview($con,$_SESSION['id'],$review[0]);
        }
		echo "			<a href='showReview.php?id=".$review[0]."'><img src='".$HOME_REVIEW_AVATAR_PATH."/".$image[1]."' alt='review image' class='reviewImage' /></a>
						<div class='mostPopularReviewName'>
								<a href='showReview.php?id=".$review[0]."' style='color:#000000;' ><p><b>".$review[2]."</b></p></a>
							<p>by ";
								
		if ($username == "Deleted user" && $categoryname == "unknown category")
		{
			echo $username." in ".$categoryname;
		}
		else if($username != "Deleted user" && $categoryname == "unknown category")
		{
			echo "<a href='userProfile.php?id=".$user[0]."'>".$username."</a> in ".$categoryname."</a>";
		}
		else if ($username == "Deleted user" && $categoryname != "unknown category")
		{
			echo $username." in <a href='viewCategory.php?categoryID=".$category[0]."'>".$categoryname."</a>";
		}
		else
		{
			echo "<a href='userProfile.php?id=".$user[0]."'>".$username."</a> in <a href='viewCategory.php?categoryID=".$category[0]."'>".$categoryname."</a>";
		}
								
		echo"					,</p>
								<p>on ".$postedON."</p>
						</div>
						<div id='mostPopularReviewShortDesc'>
							<p>".$review[3]."</p>
						</div>
						<div class='impressions' id = '".$review[0]."'>
							<div class='likes'>
								<span>".$review[6]."</span>";
		if (!isset($_SESSION['id']))
		{
		   echo $LIKE_TAG;
		}
		else 
		{
			if ($flag === $LIKE)
			{
				echo "<img src='images/gui/like_blue.png' alt='like' />";
			}
			else if ($flag === $DISLIKE)
			{
			   echo "<img src='images/gui/like.png' alt='like' />";
			}
			else if (is_null($flag))
			{
				echo "<a href='javascript:void(0);' 
						onclick='getImpression(".$_SESSION['id'].",".$review[0].",".$LIKE.");
						return false;'>
						<img src='images/gui/like.png' alt='like' />
					  </a> ";
			}
		}
        echo	"</div>
				<div class='dislikes'>
					<span>".$review[7]."</span>";
		if (!isset($_SESSION['id']))
		{
			echo $DISLIKE_TAG;
		}
		else 
		{
		   if ($flag === $DISLIKE)
		   {
				echo "<img src='images/gui/dislike_red.png' alt='like' />";
		   }
		   else if ($flag === $LIKE)
		   {
			   echo "<img src='images/gui/dislike.png' alt='like' />";
		   }
		   else if (is_null($flag))
		   {
				echo "<a href='javascript:void(0);' 
						onclick='getImpression(".$_SESSION['id'].",".$review[0].",".$DISLIKE.");
						return false;'>
						<img src='images/gui/dislike.png' alt='dislike' />
					  </a> ";
			}
		}
                    
        echo	"</div>
				</div>
			</div>
		<div class='comments'>
                    <span>".$commentsNO." комментариев</span>
		</div>";
	}
	else 
    {
        echo "
            <img src='images/gui/noImage.jpg' alt='review image' class='reviewImage' />
                <div class='mostPopularReviewName'>
                <p><b>Empty</b></p>
                </div>
                <div id='mostPopularReviewShortDesc'>
                        <p>There are no reviews posted at the time</p>
                </div>
        </div>
        <div class='comments'>
               
        </div>";        
    }
	echo "</div>";
}
function PrintQuestionOfTheDay($con)
{
	global $POLL_DOESNT_EXIST,$USER_VOTED,$USER_DIDNT_VOTED,$COMMENT_ON_QUESTION;
	$poll = ReturnActivePoll($con);
	if ($poll!=$POLL_DOESNT_EXIST)
		$id = $poll[0];
	else
		$id = null;
	echo "<div id='questionBox' class='shadow borderRadius'>";
						if ($id!=null)
						echo "<a href='showQuestion.php?id=".$id."' style='cursor:pointer'>";
						echo "<div id='questionHeader' class='gradientHeader redStripe'>
							<span>Вопрос дня</span>
						</div>";
						if ($id!=null)
						echo "</a>";
						echo "<div id='questionContent' class='content'>";
    
	if ($poll != $POLL_DOESNT_EXIST)
    {
		$results = GetResultsInPercents($con,$poll[0]);
		if (isset($_SESSION['id']))
			$flag = DidUserVoted($con,$_SESSION['id'],$poll[0]);
		else
			$flag = null;
        $commentsNO = CountCommentsForReview($con,$poll[0],$COMMENT_ON_QUESTION);
		echo "<p>".$poll[1]."</p>";
		$numberOfAnswers = $poll[2];
		echo"	<div id='leftColumnAnswers'>
					<div class='answer'>
						<input name='vote' id='radio1' type='radio'";
		if (!isset($_SESSION['id']) || $flag!=$USER_DIDNT_VOTED)
			echo " disabled /><label for='radio1'>".$poll[3].":".$poll[8]."%</label>";
		else
			echo " value='1' onclick='getVote(this.value,".$poll[0].")'/><label for='radio1'>".$poll[3]."</label>";
		echo "	</div>
				<div class='answer' style='padding-top:15px'>
					<input name='vote' id='radio2' type='radio'";
		if (!isset($_SESSION['id']) || $flag!=$USER_DIDNT_VOTED)
			echo " disabled /><label for='radio2'>".$poll[4].":".$poll[9]."%</label>";
		else
			echo " value='2' onclick='getVote(this.value,".$poll[0].")'/><label for='radio1'>".$poll[4]."</label>";
		echo "</div>";
		echo "</div>";
		if ($numberOfAnswers > 2)
		{
			echo "<div id='rightColumnAnswers'>" ;
			echo "<div class='answer'>
					<input name='vote' id='radio3' type='radio'";
			if (!isset($_SESSION['id']) || $flag!=$USER_DIDNT_VOTED)
				echo " disabled /><label for='radio3'>".$poll[5].":".$poll[10]."%</label>";
			else
				echo "value='3' onclick='getVote(this.value,".$poll[0].")'/><label for='radio1'>".$poll[5]."</label>";
			echo "</div>";
			if ($numberOfAnswers>3)
			{
				echo "	<div class='answer' style='padding-top:15px'>
                            <input name='vote' id='radio4' type='radio' ";
				if (!isset($_SESSION['id']) || $flag!=$USER_DIDNT_VOTED)
					echo " disabled /><label for='radio4'>".$poll[6].":".$poll[11]."%</label>";
				else
					echo "value='4' onclick='getVote(this.value,".$poll[0].")'/><label for='radio1'>".$poll[6]."</label>";
				echo " </div>";
			}
		echo "</div>";
		}
	}
	else
	{
		echo "<p>There are no active polls at the moment</p>";
	}
	echo "</div>";
	if ($poll!=$POLL_DOESNT_EXIST)
		echo "<a href='showQuestion.php?id=".$poll[0]."' style='cursor:pointer'>
			<div class='comments'>
				<span>".$commentsNO." комментариев</span>
			 </div>
			 </a>";
	else
		echo "<div class='comments'>     
            </div>";
	echo "</div>";
}
function PrintLatestReviews($con)
{
	global $COMMENT_ON_REVIEW;
    $reviews = ReturnTwoLatestReviews($con);
	echo "<div id='latestReviewsBox' class='shadow borderRadius'>
			<div id='latestReviewsHeader' class='gradientHeader redStripe'>
				<span>Новые рецензии</span>
			</div>
			<div id='latestReviewsContent' class='content'>";
	$commentsNO_1 = -1;
	$commentsNO_2 = -1;
	if (count($reviews) > 0)
    {
         $i = 1;
         foreach ($reviews as $row)
         {
             if ($i == 1)
             {
                echo "<div id='firstLatestReview'>";
                echo printOneOfTwoLatestReviews($con,$row);
                echo "</div>";
                $commentsNO_1 = CountCommentsForReview($con,$row[0],$COMMENT_ON_REVIEW);
             }
             else 
             {
                echo "<div id='secondLatestReview'>";
                echo printOneOfTwoLatestReviews($con,$row);
                echo "</div>";
                $commentsNO_2 = CountCommentsForReview($con,$row[0],$COMMENT_ON_REVIEW);
             }
            $i++;
         }

    }

	         
	echo "
			</div>
	   <div class='comments'>
			   <div style='width:50%; float:left'>
					   
					   <div class='comments' style='border-top:none'>";
	if ($commentsNO_1 != -1)
		echo "<span>".$commentsNO_1." комментариев</span>";
	echo "</div>      
		  </div>
		  <div style='width:50%; float:left'>
			<div class='comments' style='border-top:none'>";
	if ($commentsNO_2 != -1)
		echo " <span>".$commentsNO_2." комментариев</span>";
	echo "</div>
		  </div>
		  </div>
		 ";
	echo "	</div>";
}
function printOneOfTwoLatestReviews($con,$rowParameter)
{
    global $HOME_REVIEW_AVATAR_PATH,$DISLIKE_TAG,$LIKE_TAG,$LIKE,$DISLIKE;
    $user = ReturnUser($con,$rowParameter[1]);
    $dtime = new DateTime($rowParameter[10]);
    $postedON = $dtime->format("d.m.Y");
    $image = null;
	if ($user != null)
	{
		$username=$user[1];
	}
	else
	{
		$username="Deleted user";
	}    
    if ($rowParameter[5] != null)
    {
        $image = ReturnImage($con,$rowParameter[5]); 
    }
    $category = ReturnCategoryById($con,$rowParameter[11]);
	if ($category !=null)
	{
		$categoryname = $category[1];
	}
	else
	{
		$categoryname = "unknown category";
	}
    if ($image != null)
    {
        $imagePath = $HOME_REVIEW_AVATAR_PATH."/".$image[1];
    }
    else
    {
        $imagePath = $HOME_REVIEW_AVATAR_PATH."/noImage.jpg";
    }
    if (isset($_SESSION['id']))
    {
        $flag = DidUserLikedReview($con,$_SESSION['id'],$rowParameter[0]);
    }
    echo "
        <a href='showReview.php?id=".$rowParameter[0]."'><img src='".$imagePath."' alt='review image' class='reviewImage' /></a>
        <div class='mostPopularReviewName' style='padding-top:40px'>
            <a href='showReview.php?id=".$rowParameter[0]."' style='color:#000000' ><p><b>".$rowParameter[2]."</b></p></a>
			<p>by ";
	if ($username == "Deleted user" && $categoryname == "unknown category")
	{
		echo $username." in ".$categoryname;
	}
	else if($username != "Deleted user" && $categoryname == "unknown category")
	{
		echo "<a href='userProfile.php?id=".$user[0]."'>".$username."</a> in ".$categoryname."</a>";
	}
	else if ($username == "Deleted user" && $categoryname != "unknown category")
	{
		echo $username." in <a href='viewCategory.php?categoryID=".$category[0]."'>".$categoryname."</a>";
	}
	else
	{
		echo "<a href='userProfile.php?id=".$user[0]."'>".$username."</a> in <a href='viewCategory.php?categoryID=".$category[0]."'>".$categoryname."</a>";
	}
	echo"	,</p>
            <p>on ".$postedON."</p>
        </div>
        <div class='impressions' id = '".$rowParameter[0]."'>
            <div class='likes'>
                <span>".$rowParameter[6]."</span>";
                if (!isset($_SESSION['id']))
                {
                    echo $LIKE_TAG;
                }
                else
                {
                   if ($flag === $LIKE)
                   {

                       echo "<img src='images/gui/like_blue.png' alt='like' />";
                   }
                   else if ($flag === $DISLIKE)
                   {
                        echo "<img src='images/gui/like.png' alt='like' />";
                   }
                   else if (is_null($flag))
                    {

//                            echo "<img src='images/gui/like.png' alt='like' 
//                                onclick = 'getImpression(".$_SESSION['id'].",".$review[0].",".$LIKE.");'/>";
                         echo "<a href='javascript:void(0);' 
                                 onclick='getImpression(".$_SESSION['id'].",".$rowParameter[0].",".$LIKE.");
                                 return false;'>
                                 <img src='images/gui/like.png' alt='like' />
                               </a> ";
                    }
                }
     echo " 
        </div>
            <div class='dislikes'>
                <span>".$rowParameter[7]."</span>";
                if (!isset($_SESSION['id']))
                {
                    echo $DISLIKE_TAG;
                }
                else
                {
                    if ($flag === $DISLIKE)
                       {
                           
                           echo "<img src='images/gui/dislike_red.png' alt='like' />";
                       }
                       else if ($flag === $LIKE)
                       {
                           echo "<img src='images/gui/dislike.png' alt='like' />";
                       }
                       else if (is_null($flag))
                       {
                           
//                            echo "<img src='images/gui/like.png' alt='like' 
//                                onclick = 'getImpression(".$_SESSION['id'].",".$review[0].",".$LIKE.");'/>";
                            echo "<a href='javascript:void(0);' 
                                    onclick='getImpression(".$_SESSION['id'].",".$rowParameter[0].",".$DISLIKE.");
                                    return false;'>
                                    <img src='images/gui/dislike.png' alt='dislike' />
                                  </a> ";
                       }
                }
     echo "
                </div>
        </div>
         ";
}

function PrintThirdColumn($con)
{
	echo "<div id='thirdcolumn'>";	
	PrintLetterOfCommittee($con);
	PrintRules();			
echo "</div>";
}
function PrintLetterOfCommittee($con)
{
	global $DISLIKE_TAG,$LIKE_TAG,$LIKE,$DISLIKE,$COMMENT_ON_REVIEW;
	echo "<div id='letterBox' class='shadow borderRadius'>
			<div id='letterContent' class='content'>";
	$result = ReturnLetterOfCommittee($con);
    $dtime = new DateTime($result[10]);
    $postedON = $dtime->format("d.m.Y");
	if ($result != null)
	{
		$link = "showReview.php?id=".$result[0];
		$commentsNO = CountCommentsForReview($con,$result[0],$COMMENT_ON_REVIEW);
		if (strlen($result[4])> 348)
		{
			$temp_body = substr($result[4],0,348).'...';
		}
		else
		{
			$temp_body = $result[4];
		}
		if (isset($_SESSION['id']))
        {
            $flag = DidUserLikedReview($con,$_SESSION['id'],$result[0]);
        }
		echo "<div id='LetterOfCommitteeName'>";
        echo "  <a href='".$link."' style='color:#000000' ><p><b>".$result[2]."</b></p></a>
                <p>on ".$postedON."</p>
            </div>
            <div id='letterDesc'>
                <p>".$temp_body."</p>
            </div>
            <div class='impressions' id = '".$result[0]."'>
                <div class='likes'>
                    <span>".$result[6]."</span>";
                    if (!isset($_SESSION['id']))
                    {
                        echo $LIKE_TAG;
                    }
                    else 
                    {
                       if ($flag === $LIKE)
                       {
                           
                           echo "<img src='images/gui/like_blue.png' alt='like' />";
                       }
                       else if ($flag === $DISLIKE)
                       {
                           echo "<img src='images/gui/like.png' alt='like' />";
                       }
                       else if (is_null($flag))
                       {
							echo "<a href='javascript:void(0);' 
                                    onclick='getImpression(".$_SESSION['id'].",".$result[0].",".$LIKE.");
                                    return false;'>
                                    <img src='images/gui/like.png' alt='like' />
                                  </a> ";
                       }
                    }
        echo "</div>
				<div class='dislikes'>
                <span>".$result[7]."</span>";
                if (!isset($_SESSION['id']))
                {
                    echo $DISLIKE_TAG;
                }
                else 
                {
                    if ($flag === $DISLIKE)
                       {
                           
                           echo "<img src='images/gui/dislike_red.png' alt='like' />";
                       }
                       else if ($flag === $LIKE)
                       {
                           echo "<img src='images/gui/dislike.png' alt='like' />";
                       }
                       else if (is_null($flag))
                       {
							echo "<a href='javascript:void(0);' 
                                    onclick='getImpression(".$_SESSION['id'].",".$result[0].",".$DISLIKE.");
                                    return false;'>
                                    <img src='images/gui/dislike.png' alt='dislike' />
                                  </a> ";
                       }
                }
        echo "	</div>
			</div>
            </div>
            
            <div class='comments'>
                <span>".$commentsNO." комментариев</span>
            </div>
            
            ";
	}
	else 
    {
       echo "
			<div id='LetterOfCommitteeName'>
                <b>Empty</b></p>
            </div>
            <div id='letterDesc'>
                <p>There is no topic at the moment</p>
            </div>
            <div class='impressions'>
                <div class='likes'>	
				</div>
				<div class='dislikes'>
				</div>
			</div>
            </div>
            
            <div class='comments'>
                
            </div>
            "; 
    }
	echo "</div>";
}
function PrintRules()
{
	echo "
	<div id='rulesBox' class='shadow borderRadius'>
	<div id='rulesHeader' class='gradientHeader redStripe'>
		<span>Правила проекта</span>
	</div>
	<div id='rulesContent' class='content'>
		<div id='rulesDesc'>
				<p>Lorem ipsum dolor sit amet, ea est fugit omnium indoctum, ad zril nobis docendi ius. Ne eirmod gubergren sea, vel ex eirmod persequeris, at modus ceteros feugait eam. Tibique iudicabit cum in. Errem nonumes ceteros eu qui.</p>
		</div>
	</div>
	</div>";
}
//prebaci kod milanaa
function PrintSecondCategoriesColumn($con)
{
	if (isset($_GET['topicsOfTheMonth']))
	{
		$categories = ReturnTopicsOfTheMonthForUser($con);
	}
	else if (isset($_GET['topicsOfTheWeek']))
	{
		$categories = ReturnTopicsOfTheWeekForUser($con);
	}
	else
	{
		$categories = ReturnAllCategories($con);
	}
	echo "<div id='secondcolumn'>";
		
	if ($categories!=null)
	{
		if (is_array($categories[0]))
			foreach ($categories as $category)
				PrintCategory($con,$category);
		else
			PrintCategory($con,$categories);
	}
	else
		echo "<p>This section is currently empty.</p>";
	echo "</div>";
}
function PrintCategory($con,$category)
{
	$image = null;
	if ($category[2]!=null)
		$image = ReturnImage($con,$category[2]);
	echo "<div class='categoryBox shadow borderRadius'>
				<a href='viewCategory.php?categoryID=".$category[0]."' style='text-decoration:none'>
				<div class='categoryContent content' ";
					if ($category[2]==null)
						echo "style='background: url(\"images/gui/logo.png\") no-repeat;'>";
					else
						echo "style='background: url(\"images/category_avatars/".$image[1]." \") no-repeat;'>";
	echo 		"</div>
				<div class='categoryNameShortDescContent'>
					<p class='categoryNameParagraph'>".$category[1]."</p>
				</div>
				</a>
				<div class='comments'>
					<span>".$category[4]." reviews</span>
				</div>
			</div>";
}
function PrintSecondQuestionsColumn($con)
{
	if (!isset($_GET['categoryFrom']))
	{
		$from = 0;
	}
	else
	{
		$from = $_GET['categoryFrom'];
	}
	echo "<div id='secondcolumn'>
			<div id='userAreaBox' class='shadow borderRadius'>
				<div id='topicsHeader' class='gradientHeader redStripe'>
					<span>Questions of the day</span>
				</div>
				<div id='userAreaContent' class='content'>";
	$reviews = ReturnAllPreviousPolls($con,$from,8);
	$num_of_reviews = ReturnCountPreviousPolls($con);
	if ($reviews!=null)
	{
		if (is_array($reviews[0]))
		{
			foreach($reviews as $review)
				PrintPoll($con,$review);
		}
		else
		{
			PrintPoll($con,$reviews);
		}
	}
	else
		echo "<p style='margin:0px; padding:0px; padding-top:100px'>This section is currently empty.</p>";
	echo "		</div>
			</div>";
	PrintPageNumbersQuestion($num_of_reviews,$from);		
	echo "	</div>";

}
function PrintSecondLettersColumn($con)
{
	
	if (!isset($_GET['categoryFrom']))
	{
		$from = 0;
	}
	else
	{
		$from = $_GET['categoryFrom'];
	}
	echo "<div id='secondcolumn'>
			<div id='userAreaBox' class='shadow borderRadius'>
				<div id='topicsHeader' class='gradientHeader redStripe'>
					<span>Reviews in category</span>
				</div>
				<div id='userAreaContent' class='content'>";
	$reviews = ReturnAllLettersOfCommittee($con,$from,8);
	$num_of_reviews = ReturnCountLettersOfCommittee($con);
	if ($reviews!=null)
	{
		if (is_array($reviews[0]))
		{
			foreach($reviews as $review)
				PrintReview($con,$review);
		}
		else
		{
			PrintReview($con,$reviews);
		}
	}
	else
		echo "<p style='margin:0px; padding:0px; padding-top:100px'>This section is currently empty.</p>";
	echo "		</div>
			</div>";
	PrintPageNumbersLetter($num_of_reviews,$from);		
	echo "	</div>";

}
function PrintSecondReviewsColumn($con)
{
	if (isset($_GET['categoryID']))
	{
		$category = $_GET['categoryID'];
		if (!isset($_GET['categoryFrom']))
		{
			$from = 0;
		}
		else
		{
			$from = $_GET['categoryFrom'];
		}
		echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Reviews in category</span>
					</div>
					<div id='userAreaContent' class='content'>";
		$reviews = ReturnReviewsFromCategory($con,$category,$from,8);
		$num_of_reviews = ReturnNumberOfReviewsFromCategory($con, $category);
		if ($reviews!=null)
		{
			if (is_array($reviews[0]))
			{
				foreach($reviews as $review)
					PrintReview($con,$review);
			}
			else
			{
				PrintReview($con,$reviews);
			}
		}
		else
			echo "<p style='margin:0px; padding:0px; padding-top:100px'>This section is currently empty.</p>";
		echo "		</div>
				</div>";
		PrintPageNumbers($num_of_reviews,$from,$category);		
		echo "	</div>";
	}
}
function PrintPageNumbersQuestion($n,$from)
{
	if ($n>8)
	{
		
		echo "<div id='reviewsPagesNumbers'>";
		if ($from>0)
				echo "<a href='viewQuestions.php?categoryFrom=".($from-8)."'>
						<div class='reviewPageNumber'>
							<span><<</span>
						</div>
					</a>";
		if ((intval($n/8)+1)<7)
		{
					for($i=0;$i<(intval($n/8)+1);$i++) 
					{
					echo "<a href='viewQuestions.php?categoryFrom=".($i*8)."'>
						<div class='reviewPageNumber'>";
						if ($i*8==$from)
							echo "<span style='font-weight:bold; color:#920303'>".($i+1)."</span>";
						else
							echo "<span>".($i+1)."</span>";
					echo "</div>
						</a>";
					}
		}
		else
		{
			if ($from+48<=$n)
				$to = intval($from/8)+7;
			else
				$to = intval($n/8)+2;
			for($i=(intval($from/8)+1);$i<$to;$i++) 
			{
			echo "<a href='viewQuestions.php?categoryFrom=".(($i-1)*8)."'>
				<div class='reviewPageNumber'>";
				if (($i-1)*8==$from)
					echo "<span style='font-weight:bold; color:#920303'>".$i."</span>";
				else
					echo "<span>".$i."</span>";
			echo "</div>
				</a>";
			}
			if ($from+8<$n)
				echo "<span class='threeDots'>...</span>";
		}
		if ($from+8<$n)
			echo "<a href='viewQuestions.php?categoryFrom=".($from+8)."'>
						<div class='reviewPageNumber'>
							<span>>></span>
						</div>
					</a>";
		echo "	</div>";
	}
}
function PrintPageNumbersLetter($n,$from)
{
	if ($n>8)
	{
		
		echo "<div id='reviewsPagesNumbers'>";
		if ($from>0)
				echo "<a href='viewLetters.php?categoryFrom=".($from-8)."'>
						<div class='reviewPageNumber'>
							<span><<</span>
						</div>
					</a>";
		if ((intval($n/8)+1)<7)
		{
					for($i=0;$i<(intval($n/8)+1);$i++) 
					{
					echo "<a href='viewLetters.php?categoryFrom=".($i*8)."'>
						<div class='reviewPageNumber'>";
						if ($i*8==$from)
							echo "<span style='font-weight:bold; color:#920303'>".($i+1)."</span>";
						else
							echo "<span>".($i+1)."</span>";
					echo "</div>
						</a>";
					}
		}
		else
		{
			if ($from+48<=$n)
				$to = intval($from/8)+7;
			else
				$to = intval($n/8)+2;
			for($i=(intval($from/8)+1);$i<$to;$i++) 
			{
			echo "<a href='viewLetters.php?categoryFrom=".(($i-1)*8)."'>
				<div class='reviewPageNumber'>";
				if (($i-1)*8==$from)
					echo "<span style='font-weight:bold; color:#920303'>".$i."</span>";
				else
					echo "<span>".$i."</span>";
			echo "</div>
				</a>";
			}
			if ($from+8<$n)
				echo "<span class='threeDots'>...</span>";
		}
		if ($from+8<$n)
			echo "<a href='viewLetters.php?categoryFrom=".($from+8)."'>
						<div class='reviewPageNumber'>
							<span>>></span>
						</div>
					</a>";
		echo "	</div>";
	}
}
function PrintPageNumbers($n,$from,$category)
{
	if ($n>8)
	{
		
		echo "<div id='reviewsPagesNumbers'>";
		if ($from>0)
				echo "<a href='viewCategory.php?categoryID=".$category."&categoryFrom=".($from-8)."'>
						<div class='reviewPageNumber'>
							<span><<</span>
						</div>
					</a>";
		if ((intval($n/8)+1)<7)
		{
					for($i=0;$i<(intval($n/8)+1);$i++) 
					{
					echo "<a href='viewCategory.php?categoryID=".$category."&categoryFrom=".($i*8)."'>
						<div class='reviewPageNumber'>";
						if ($i*8==$from)
							echo "<span style='font-weight:bold; color:#920303'>".($i+1)."</span>";
						else
							echo "<span>".($i+1)."</span>";
					echo "</div>
						</a>";
					}
		}
		else
		{
			if ($from+48<=$n)
				$to = intval($from/8)+7;
			else
				$to = intval($n/8)+2;
			for($i=(intval($from/8)+1);$i<$to;$i++) 
			{
			echo "<a href='viewCategory.php?categoryID=".$category."&categoryFrom=".(($i-1)*8)."'>
				<div class='reviewPageNumber'>";
				if (($i-1)*8==$from)
					echo "<span style='font-weight:bold; color:#920303'>".$i."</span>";
				else
					echo "<span>".$i."</span>";
			echo "</div>
				</a>";
			}
			if ($from+8<$n)
				echo "<span class='threeDots'>...</span>";
		}
		if ($from+8<$n)
			echo "<a href='viewCategory.php?categoryID=".$category."&categoryFrom=".($from+8)."'>
						<div class='reviewPageNumber'>
							<span>>></span>
						</div>
					</a>";
		echo "	</div>";
	}
}
function PrintPoll($con,$poll)
{
	global $COMMENT_ON_QUESTION;
	$dtime = new DateTime($poll[7]);
	$postedON = $dtime->format("d.m.Y");
	echo "<div class='reviewRow'>
			<div class='reviewRowInfo'>
				<div class='reviewInformation'>
					<a href='showQuestion.php?id=".$poll[0]."' style='padding-left:20px' class='reviewInformationName'>".$poll[1]."</a>
					<p style='color:#000000; margin:0px padding:0px; padding-top:5px; padding-left:20px;'>Active on ".$postedON."</p>";
	$num_of_answers = $poll[2];
	$num_of_comments = CountCommentsForReview($con,$poll[0],$COMMENT_ON_QUESTION);
	for ($i=0;$i<$num_of_answers;$i++)
		echo "<p style='margin:0px; padding:0px; padding-top:5px; padding-left:20px;' >".$poll[3+$i]." - ".$poll[8+$i]."% of users vote</p>";
	echo "	</div>";
	echo "</div>
			<div class='reviewRowStatistics' >
			<div class='reviewRowComments' style='margin-top:50px'>
					<span>".$num_of_comments."</span>
				</div>
			</div>
		</div>";
				
}
function PrintReview($con,$review)
{

	global $COMMENT_ON_REVIEW,$LIKE_TAG, $LIKE, $DISLIKE;
	$image_path = 'images/all_reviews_avatars/review_no_image.png';
	if ($review[5]!=null)
	{
		$image = ReturnImage($con,$review[5]);
		$image_path = "images/all_reviews_avatars/".$image[1];
	}
	$user = null;
	$username = 'Deleted user';
	if ($review[1]!=null)
	{
		$user = ReturnUser($con,$review[1]);
		$username = $user[1];
	}
	$dtime = new DateTime($review[10]);
	$postedON = $dtime->format("d.m.Y");
	if (isset($_SESSION['id']))
	{
		$flag = DidUserLikedReview($con,$_SESSION['id'],$review[0]);
	}
	$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
	echo "<div class='reviewRow'>
			<div class='reviewRowInfo'>
				<div class='reviewRowImage'>
					<a href='showReview.php?id=".$review[0]."'>
					<img src='".$image_path."' alt='review image' />
					</a>
				</div>
				<div class='reviewInformation'>
					<a href='showReview.php?id=".$review[0]."' class='reviewInformationName'>".$review[2]."</a>
					<p><i>";
	if ($review[1]!=null)
		echo "<a href='userProfile.php?id=".$review[1]."'>".$username."</a>";
	else
		echo $username;
	echo 			" on ".$postedON."</i></p>
					<p style='color:#757575'>".$review[3]."</p>
				</div>
			</div>
			<div class='reviewRowStatistics' id=".$review[0].">
				<div class='reviewRowLike'>
					<span style='padding-right:4px;'>".$review[6]."</span>";
	if (!isset($_SESSION['id']))
	{
		echo "<img src='images/gui/like.png' alt='like review' />";
	}
	else 
	{
	   if ($flag === $LIKE)
	   {
		   
		   echo "<img src='images/gui/like_blue.png' alt='like' />";
	   }
	   else if ($flag === $DISLIKE)
	   {
		   echo "<img src='images/gui/like.png' alt='like' />";
	   }
	   else if (is_null($flag))
	   {
			echo "<a href='javascript:void(0);' 
					onclick='getImpressionFromAllReviews(".$_SESSION['id'].",".$review[0].",".$LIKE.");
					return false;'>
					<img src='images/gui/like.png' alt='like' />
				  </a> ";
	   }
	}
	echo "		</div>
				<div class='reviewRowDisike'>";
	if (!isset($_SESSION['id']))
	{
		echo "<img src='images/gui/dislike.png' style='float:left; padding-left:23px' alt='dislike review' />";
	}
	else 
	{
		if ($flag === $DISLIKE)
		   {
			   
			   echo "<img src='images/gui/dislike_red.png' style='float:left; padding-left:23px' alt='like' />";
		   }
		   else if ($flag === $LIKE)
		   {
			   echo "<img src='images/gui/dislike.png' style='float:left; padding-left:23px' alt='like' />";
		   }
		   else if (is_null($flag))
		   {
				echo "<a href='javascript:void(0);' 
						onclick='getImpressionFromAllReviews(".$_SESSION['id'].",".$review[0].",".$DISLIKE.");
						return false;'>
						<img src='images/gui/dislike.png' style='float:left; padding-left:23px' alt='dislike' />
					  </a> ";
		   }
	}
	echo "<span style='float:left; padding-left:5px'>".$review[7]."</span>
				</div>
				<div class='reviewRowComments'>
					<span>".$num_of_comments."</span>
				</div>
			</div>
		</div>";
}
function PrintFirstColumnRegistration()
{
	echo"
			<div id='firstcolumnRegistration'>
				<div id='registerBox' class='shadow borderRadius'>
					<div id='registerHeader' class='gradientHeader blueStripe'>
						<span>Зарегестрироваться</span>
					</div>
					<form method='post' action='' onsubmit='return registerformvalidation();'>
					<div id='registerContent' class='content'>
						
						<div class='registerSubcolumn'>
							<div class='registerElementRow'>
								<span>Логин:</span>
								
								<input type='text' id='username' name='userName' placeholder='Логин:' value='' class='registerTextInput' required='required'/>
								<img src='images/gui/asteriks.png' />
							</div>
							<div class='registerWarning'>
								<p id='wrongusernamewarning'>";
								if(isset($_SESSION['msg']['username-err']))
								{
									echo $_SESSION['msg']['username-err'];
									unset($_SESSION['msg']['username-err']);
								}
	echo"						</p>
							</div>
							<div class='registerElementRow'>
								<span>Email:</span>
								<input type='text' id='email' name='email' placeholder='Email:' value='' class='registerTextInput' required='required'/>
								<img src='images/gui/asteriks.png' />
							</div>
							<div class='registerWarning'>
								<p id='emailwarning'>";
								if(isset($_SESSION['msg']['email-err']))
								{
									echo $_SESSION['msg']['email-err'];
									unset($_SESSION['msg']['email-err']);
								}
	echo"						</p>
							</div>
							<div class='registerElementRow'>
								<span>Age:</span>
								
								<input type='text' name='age' id='age' placeholder='Age:' value='' class='registerTextInput' style='margin-right:22px'/>
							</div>
							<div class='registerWarning'>
								<p id='agewarning'></p>
							</div>
							<div class='registerElementRow'>
								<span>Sex:</span>
								<input type='radio' name='sex' value='1' checked style='margin-left:19px' />
								<span style='padding-right:170px;'>Male</span>
							</div>
							<div class='registerElementRow'>
								<input type='radio'name='sex' value='0'/>
								<span style='padding-right:152px;'>Female</span>
							</div>
							<div class='registerElementRow'>
								<input type='checkbox'name='showMailToOtherUsers' value='1'/>
								<span style='padding-right:10px;'>Other users can see my email address</span>
							</div>
							<div class='registerElementRow'>
								<input type='checkbox' required='required'/>
								<span style='padding-right:18px;' >I agree with Rules and Terms of Uses</span>
							</div>
							<div class='registerWarning'>
								<p></p>
							</div>
							<div class='registerElementRow'>";
								
									require_once('recaptchalib.php');
									$publickey = '6LfAadoSAAAAAA4Edduang0Rgm8UEUaJIA69ywsz'; // you got this from the signup page
									echo recaptcha_get_html($publickey);
								
	echo"							
							</div>
							<div class='registerWarning'>
							<p>";
							if(isset($_SESSION['msg']['captcha-err']))
							{
								echo $_SESSION['msg']['captcha-err'];
								unset($_SESSION['msg']['captcha-err']);
							}	
	echo"					</p>
							</div>
						</div>
						<div class='registerSubcolumn'>
							<div class='registerElementRow'>
								<span>Password:</span>
								
								<input type='password' id='password' name='password' placeholder='Password:' value='' class='registerTextInput' required='required'/>
								<img src='images/gui/asteriks.png' />
							</div>
							<div class='registerWarning'>
								<p id='wrongpasswarning'></p>
							</div>
							<div class='registerElementRow'>
								<span>Repeat password:</span>
								
								<input type='password' id='repetepassword' name='repeated_password' placeholder='Repeat password:' value='' class='registerTextInput' required='required'/>
								<img src='images/gui/asteriks.png' />
							</div>
							<div class='registerWarning'>
								<p id='wrongpasswarningrepete'></p>
							</div>
							<div class='registerElementRow'>
								<span>Citizenship:</span>
								<input type='text' id='citizenship' name='citizenship' placeholder='Citizenship:' value='' class='registerTextInput' style='margin-right:22px'/>
							</div>
							<div class='registerWarning'>
								<p id='citizenshipwarning'></p>
							</div>
							<div class='registerElementRow' style='vertical-align: top;'>
								<span style='float:left; margin-top:15px;'>Bio:</span>
								<textarea rows='10' columns='50' id='bio' name='additionalInformation' placeholder='Bio:' value='' class='registerTextArea'></textarea>
							</div>
							<div class='registerWarning'>
								<p id='biowarning'></p>
							</div>
							<div class='registerElementRow' style='margin-right:22px;'>
								<button type='submit' name='userRegistrationFormSumbited' class='registerTextInput'></button>
							</div>
							<div class='registerElementRow' style='margin-right:80px; padding-top:10px;'>
								<img src='images/gui/asteriks.png' style='float:left;' />
								<span style='font-size:12px; padding-left:3px;'>required fields</span>
							</div>
						</div>
						
					</div>
					</form>
				</div>
				
			</div>";

}
function printSecondColumnUserProfile($con)
{
	global $ROLE_REGULAR_USER,$ROLE_MODERATOR,$ROLE_ADMINISTRATOR,$BIG_USER_AVATAR_PATH;
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		if (!isset($_GET['id']))
		{
			$user = ReturnUser($con,$_SESSION['id']);
		}
		else
		{
			$user = ReturnUser($con,$_GET['id']);
		}
		if ($user != null)
		{
			if ($user[5]==1)
			{
				$sex="Male";
			}
			else
			{
				$sex="Female";
			}
			if ($user[6] == $ROLE_REGULAR_USER)
			{
				$role = "[USER]";
			}
			else if($user[6] == $ROLE_MODERATOR)
			{
				$role = "[MODERATOR]";
			}
			else if( $user[6] == $ROLE_ADMINISTRATOR)
			{
				$role = "[ADMINISTRATOR]";
			}
			echo "
				<div id='secondcolumn'>
					<div id='userAreaBox' class='shadow borderRadius'>
						<div id='topicsHeader' class='gradientHeader blueStripe'>
							<img src='images/gui/profile_white.png' alt='profile white' />
							<span>User area</span>
						</div>
						<div id='userAreaContent' class='content'>
							<div id='userAreaFirstRow'>
								<div id='userAreaProfilePicture'>";
									if($user[10] == null)
									{
										echo "<img src='".$BIG_USER_AVATAR_PATH."/noimage.png' alt='default image' />";
									}
									else
									{
										$image=ReturnImage($con,$user[10]);
										echo "<img src='".$BIG_USER_AVATAR_PATH."/".$image[1]."' alt='default image' />";
									}
			echo"			</div>
								<div id='userAreaActions'>
									<p><b>".$user[1]."   ".$role."</b></p>
									<div class='userAreaActionRow'>
										<span>Number of reviews: </span><a href='viewCategory.php?userID=".$user[0]."' class='greyText' >".$user[9]."</a>
									</div>
									<div class='userAreaActionRow' style='padding-bottom:20px;'>
										<span>Number of comments: </span>".$user[8]."
									</div>";
			if (!isset($_GET['id']) || $_GET['id'] == $_SESSION['id'] || $_SESSION['role']==$ROLE_ADMINISTRATOR || ($_SESSION['role']==$ROLE_MODERATOR && $user[6]!=$ROLE_ADMINISTRATOR))
			{
					echo"			<div class='userAreaActionRow'>
										<img src='images/gui/edit_icon.png' alt='edit profile' />
										<a href='editProfile.php?userID=".$user[0]."' class='greyText' >Edit profile</a>
									</div>";
			}
			
			if (isset($_GET['id']) && $_GET['id'] != $_SESSION['id'] && ($_SESSION['role']==$ROLE_ADMINISTRATOR || ($_SESSION['role']==$ROLE_MODERATOR && $user[6]!=$ROLE_ADMINISTRATOR)))
			{
				echo"				<div class='userAreaActionRow'>
											<img src='images/gui/delete_user.png' alt='delete user' style='cursor:pointer' onclick='confirmDelete(".$user[0].",\"editProfile.php\")'/><span class='greyText' style='cursor:pointer' onclick='confirmDelete(".$user[0].",\"editProfile.php\")'>Delete user</span>"
										."</div>";
			}
			
			if (isset($_GET['id']))
			{
				if ($_GET['id'] != $_SESSION['id'])
				{
					if ($_SESSION['role'] == $ROLE_ADMINISTRATOR)
					{
						if ($user[6] == $ROLE_REGULAR_USER)
						{
							echo"			<div class='userAreaActionRow'>
												<img src='images/gui/privileges.png' alt='promote user' />
												<a href='?userIdToPromoteToModerator=".$_GET['id']."' class='greyText' >Promote to moderator</a>
											</div>";
						}
					}
				}
			}
			if (isset($_GET['id']))
			{
				if ($_GET['id'] != $_SESSION['id'])
				{
					if ($_SESSION['role'] == $ROLE_ADMINISTRATOR)
					{
						if ($user[6] == $ROLE_MODERATOR)
						{
							echo"			<div class='userAreaActionRow'>
												<img src='images/gui/privileges.png' alt='denote user' />
												<a href='?moderatorIdToPromoteToAdmin=".$_GET['id']."' class='greyText' >Promote to administrator</a>
											</div>";
							echo"			<div class='userAreaActionRow'>
												<img src='images/gui/privileges.png' alt='denote user' />
												<a href='?moderatorIdToDenoteToUser=".$_GET['id']."' class='greyText' >Denote to user</a>
											</div>";
						}
					}
				}
			}
			if (isset($_GET['id']))
			{
				if ($_GET['id'] != $_SESSION['id'])
				{
					if ($_SESSION['role'] == $ROLE_ADMINISTRATOR)
					{
						if ($user[6] == $ROLE_ADMINISTRATOR)
						{
							echo"			<div class='userAreaActionRow'>
												<img src='images/gui/privileges.png' alt='denote user' />
												<a href='?adminIdToDenoteToModerator=".$_GET['id']."' class='greyText' >Denote to moderator</a>
											</div>";
						}
					}
				}
			}

			if (isset($_GET['id']))
			{
				if ($_SESSION['id'] != $_GET['id'])
				{	
					echo"					<div class='userAreaActionRow'>
											<img src='images/gui/messages.png' alt='send message' />
											<a href='conversation.php?id=".$_GET['id']."' class='greyText' >Send message to user</a>
											</div>";
				}
			}		
			echo"						
								</div>
							</div>";
							
			if(!isset($_GET['id']) || $user[13] == 1)
			{
				echo"		<div class='userAreaInformationRow'>
								<div class='userAreaInformationRowLeft'>
									<span><b>E-mail:</b></span>
								</div>
								<div class='userAreaInformationRowRight'>
									<span style='padding-left:5px'>".$user[3]."</span>
								</div>
							</div>";
			}				
			echo"			<div class='userAreaInformationRow'>
								<div class='userAreaInformationRowLeft'>
									<span><b>Citizenship:</b></span>
								</div>
								<div class='userAreaInformationRowRight'>
									<span style='padding-left:5px'>".$user[4]."</span>
								</div>
							</div>
							<div class='userAreaInformationRow'>
								<div class='userAreaInformationRowLeft'>
									<span><b>Age:</b></span>
								</div>
								<div class='userAreaInformationRowRight'>
									<span style='padding-left:5px'>".$user[12]."</span>
								</div>	
							</div>
							<div class='userAreaInformationRow'>
								<div class='userAreaInformationRowLeft'>
									<span><b>Sex:</b></span>
								</div>
								<div class='userAreaInformationRowRight'>
									<span style='padding-left:5px'>".$sex."</span>
								</div>	
							</div>
							<div class='userAreaInformationRow' style='height:100px'>
								<div class='userAreaInformationRowLeft'>
									<span><b>Bio:</b></span>
								</div>
								<div class='userAreaInformationRowRight' style='width:410px; height:137px; text-align:justify'>
									<span style='line-height:15px; float:left; padding-top:10px; font-size:14px; padding-left:5px'>"
									.$user[7].
									"</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			";
		}
		else
		{
			header("Location: index.php");
		}
	}
}
function printSecondColumnEditUserProfile($con)
{
	global $ROLE_REGULAR_USER,$ROLE_MODERATOR,$ROLE_ADMINISTRATOR,$BIG_USER_AVATAR_PATH;
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		$user = ReturnUser($con,$_GET['userID']);
		if ($user!=null)
		{
			$old_email = $user[3];
			$old_citizenship = $user[4];
			if ($user[13]==1)
			{
				$old_visible_email = "checked";
			}
			else
			{
				$old_visible_email = "";
			}
			$old_age = $user[12];
			$old_bio = $user[7];
			if ($user[5] == 1)
			{
				$old_sex_male = "checked";
				$old_sex_female = "";
			}
			else
			{
				$old_sex_female = "checked";
				$old_sex_male = "";
			}
				if ($user[6] == $ROLE_REGULAR_USER)
				{
					$role = "[USER]";
				}
				else if($user[6] == $ROLE_MODERATOR)
				{
					$role = "[MODERATOR]";
				}
				else if( $user[6] == $ROLE_ADMINISTRATOR)
				{
					$role = "[ADMINISTRATOR]";
				}
				if($_SESSION['id']==$_GET['userID'] || $_SESSION['role']==$ROLE_ADMINISTRATOR || ($_SESSION['role']==$ROLE_MODERATOR && $user[6]!=$ROLE_ADMINISTRATOR)) 
				{				
				
				echo "
					<div id='secondcolumn'>
					<form ACTION='' METHOD='POST' onsubmit='return editprofile();' enctype='multipart/form-data'>
					<input type='hidden' name='idOfUserToEdit' value='".$_GET['userID']."'/>
					<input type='hidden' name='usernameOfUserToEdit' value='".$user[1]."'/>
					<input type='hidden' name='oldImageId' value='".intval($user[10])."'/>
							<div id='userAreaBox' class='shadow borderRadius'>
								<div id='topicsHeader' class='gradientHeader blueStripe'>
									<img src='images/gui/profile_white.png' alt='profile white' />
									<span>User area</span>
								</div>
								<div id='userAreaContent' class='content'>
									<div id='userAreaFirstRow'>
										<div id='userAreaProfilePicture'>";
										if($user[10] == null)
										{
											echo "<img src='".$BIG_USER_AVATAR_PATH."/noimage.png' alt='default image' />";
										}
										else
										{
											$image=ReturnImage($con,$user[10]);
											echo "<img src='".$BIG_USER_AVATAR_PATH."/".$image[1]."' alt='default image' />";
										}
			echo"						</div>
										<div id='userAreaActions'>";
										if (isset($_GET['id']) && $_GET['id']!=$_SESSION['id'] && ($_SESSION['role']==$ROLE_ADMINISTRATOR || ($_SESSION['role']==$ROLE_MODERATOR && $user[6]!=$ROLE_ADMINISTRATOR)))
										{
											echo "	<div class='userAreaActionRow'>
												<p><b>".$user[1]."  ".$role."</b></p>
													<img src='images/gui/delete_user.png' alt='delete user'  style='cursor:pointer' onclick='confirmDelete(".$user[0].",\"".$_SERVER['PHP_SELF']."\")'/><span class='greyText'  style='cursor:pointer' onclick='confirmDelete(".$user[0].",\"".$_SERVER['PHP_SELF']."\")'>Delete user</span>"
												."</div>";
										}
										else
										{
											echo "	<div class='userAreaActionRow'>
												<p><b>".$user[1]."  ".$role."</b></p>
												</div>";
										}
									echo"	</div>
									</div>
									
									<div style='height:36px; margin-bottom:20px; text-align:left; padding-left:55px'>
										<input size='25' name='avatar' type='file'/>
									</div>
									<br />
									"
									;
									//<div style='height:36px; margin-bottom:20px;'>
									//	<button id='changePhotoButton' type='submit'>
									//	</button>
									//</div>
									
						echo"		<div class='userAreaInformationRow'>
										<div class='userAreaInformationRowLeft'>
											<span>Change password:</span>
										</div>
										<div class='userAreaInformationRowRight' style='width:427px'>
											<input type='password' style='float:left' name='edit_pass' id='editProfilePassword' class='editProfileTextInput' value='' />
											<div class='registerWarning' style='width:100px; float:left; line-height:12px'>
												<span id='wrongPasswordWarning' style='display:none'>Password can be between 3 and 20 characters.</span>
											</div>
										</div>
									</div>
									<div class='userAreaInformationRow'>
										<div class='userAreaInformationRowLeft'>
											<span>Insert it again:</span>
										</div>
										<div class='userAreaInformationRowRight' style='width:427px'>
											<input type='password' style='float:left'  id='editProfilePasswordAgain' class='editProfileTextInput' value='' />
											<div class='registerWarning' style='width:100px; float:left; line-height:12px'>
												<span id='wrongPasswordAgainWarning'  style='display:none'>Password can be between 3 and 20 characters.</span>
											</div>
										</div>
									</div>
									<div class='userAreaInformationRow' style='height:56px'>
										<div class='userAreaInformationRowLeft'>
											<span>E-mail:</span>
										</div>
										<div class='userAreaInformationRowRight' >
											<input type='email' name='edit_email' id='editProfileEmail' class='editProfileTextInput' value='".$old_email."' />
											<input type='checkbox' name='edit_showMailToUsers' ".$old_visible_email." value='Yes'/>
											<span style='font-size:12px'>Visible to others?</span>
										</div>
										<div class='registerWarning' style='width:100%; text-align:center; float:left; line-height:12px'>
												<span id='wrongEmailWarning'></span>
										</div>
									</div>
									<div class='userAreaInformationRow'>
										<div class='userAreaInformationRowLeft'>
											<span>Citizenship:</span>
										</div>
										<div class='userAreaInformationRowRight' style='width:427px'>
											<input type='text' style='float:left'  id='editProfileCitizenship' name='edit_citizenship' class='editProfileTextInput' value='".$old_citizenship."' />
											<div class='registerWarning' style='width:100px; float:left; line-height:12px'>
												<span id='wrongCitizenshipWarning' style='display:none'></span>
											</div>
										</div>
									</div>
									<div class='userAreaInformationRow'>
										<div class='userAreaInformationRowLeft'>
											<span>Age:</span>
										</div>
										<div class='userAreaInformationRowRight' style='width:427px'>
											<input type='text' id='editProfileAge' name='edit_age' class='editProfileTextInput' value='".$old_age."' style='float:left; width:100px;'/>
											<span style='float:left'>Sex:</span>
											<input style='float:left; margin-top:10px;' name='edit_sex' type='radio' ".$old_sex_male." value='male'/>
											<span style='float:left'> Male</span>
											<input style='float:left; margin-top:10px;' name='edit_sex' type='radio' ".$old_sex_female." value='female'/>
											<span style='float:left'>Female</span>
											<div class='registerWarning' style='width:100px; float:left; margin-left:30px; line-height:12px'>
												<span id='wrongAgeWarning'  style='display:none'>Password can be between 3 and 20 characters.</span>
											</div>
										</div>
									</div>
									<div class='userAreaInformationRow' style='height:120px'>
										<div class='userAreaInformationRowLeft'>
											<span>Bio:</span>
										</div>
										<div class='userAreaInformationRowRight' style='width:427px'>
											<textarea name='edit_addinfo'  id='editProfileBio' maxlength='500' rows='10'>".$old_bio."</textarea>
										</div>
										<div class='registerWarning' style='width:100%; margin-left:50px; float:left; line-height:12px'>
												<span id='wrongBioWarning' style='display:none'>Password can be between 3 and 20 characters.</span>
										</div>
									</div>
									<div class='userAreaInformationRow' style='padding-top:20px; padding-bottom:20px;'>
										<button id='saveChangesButton' name='saveChangesButton' type='submit'>
										</button>
										<button id='cancelChangesButton' name='cancelChangesButton' type='button' onclick=\"location.href='userProfile.php?id=".$_GET['userID']."' \">
										</button>
									</div>
								</div>
							</div>
					</form>
						</div>
					";
				}
			else
			{
				header("Location: index.php");
			}
		}
		else
		{
			header("Location: index.php");
		}
	}
}
function printSecondColumnPostReview($con)
{
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		$categories=ReturnAllCategories($con);
		if ($categories!=null)
			if (!is_array($categories[0]))
				$categories = array($categories);
		$topic_of_the_week = ReturnActiveTopicOfTheWeek($con);
		$topic_of_the_month = ReturnActiveTopicOfTheMonth($con);
		echo"
		<div id='secondcolumn'>
					<div id='userAreaBox' class='shadow borderRadius'>
						<div id='topicsHeader' class='gradientHeader redStripe'>
							<span>Add review</span>
						</div>";
			if (!isset($_POST['addReviewSubmit']))
			{
			echo	"<form ACTION='' METHOD='POST' onsubmit='return addreview();' enctype='multipart/form-data'>
						<div id='userAreaContent' class='content'>
							<div id='addReviewText'>
								<p id='addReviewName'>Name of review:</p>
								<p id='addReviewBody'>Review text:</p>
								<p id='addReviewCateogry'>Category:</p>
								<p id='addReviewImage'>Image:</p>
							</div>
							<div id='addReviewInputs'>
								<input type='text' name='addReviewNameInput' id='addReviewNameInput' value='' />
								<div class='registerWarning'>
									<span id='wrongNameWarning'>
									Required field.
									</span>
								</div>
								<textarea name='addReviewBodyInput' id='addReviewBodyInput' value=''></textarea>
								<div class='registerWarning'>
									<span id='wrongTextWarning'>
									Required field.
									</span>
								</div>
								<select name='addReviewCategoryInput' id='addReviewCategoryInput'>";
									if ($topic_of_the_month != null)
									{
										echo" <option value='".$topic_of_the_month[0]."'>TOPIC OF THE MONTH:".$topic_of_the_month[1]."</option>";
									}
									if ($topic_of_the_week !=null)
									{
										echo" <option value='".$topic_of_the_week[0]."'>TOPIC OF THE WEEK:".$topic_of_the_week[1]."</option>";
									}
									foreach ($categories as $category)
									{
										echo" <option value='".$category[0]."'>".$category[1]."</option>";
									}
			echo"				</select>
								<span id='addReviewImageInput'><input name='addReviewImageInput' type='file'/></span>
							</div>
							<button type='submit' id='addReviewSubmit' name='addReviewSubmit'></button>
						</div>
					</form>";
			}
			else
				{
					echo "<p style='margin:0px; padding:0px; margin-top:50px'>Review submited succesfully</p>";
				}
		echo"		</div>
				</div>
		";
	}	
}
function printListOfAllUsers($con)
{
	echo "				<div id='controlPanelUserSearchArea'>
							<form method='post' action=''>
							<input type='text' placeholder='Search' name='searchUsers' onkeydown='if (event.keyCode==13) {
							this.form.submit(); return false; }'/>
							<div id='controlPanelUserSearchIcon'  onclick='this.form.submit(); return false;'>
							</div>
							</form>
						</div>";
	
	if (!isset($_GET['categoryFrom']))
	{
		$from = 0;
	}
	else
	{
		$from = $_GET['categoryFrom'];
	}
	if (!isset($_POST['searchUsers']))
	{
		$reviews = ReturnAllUsers($con,$from,15);
		$num_of_reviews = ReturnCountOfAllUsers($con);
		if ($reviews!=null)
		{
			if (is_array($reviews[0]))
			{
				foreach($reviews as $review)
					PrintUser($con,$review);
			}
			else
			{
				PrintUser($con,$reviews);
			}
		}
		else
			echo "<p style='margin:0px; padding:0px; padding-top:100px'>There are no users.</p>";
	}
	else
	{
		
		$words = $_POST['searchUsers'];
		$word = explode(" ", $words);
		$n = count($word);
		
		$entire_string = $word[0];
		for($i=1; $i<$n;$i++)
			$entire_string .= "%".$word[$i];
		$reviews = ReturnSearchUsers($con,$entire_string);
		$count = 0;
		if ($reviews!=null)
		{
			$count++;
			if (!is_array($reviews[0]))
				PrintUser($con,$reviews);
			else
				foreach($reviews as $review)
					PrintUser($con,$review);
		}
		if ($n>1)
				foreach ($word as $w)
				{
					$reviews = ReturnSearchUsers($con,$w);
					if ($reviews!=null)
					{
						$count++;
						if (!is_array($reviews[0]))
							PrintUser($con,$reviews);
						else
							foreach($reviews as $review)
								PrintUser($con,$review);
					}
				}
	}
}
function PrintPageNumbersUsers($n,$from)
{
	if ($n>15)
	{
		
		echo "<div id='reviewsPagesNumbers'>";
		if ($from>0)
				echo "<a href='controlPanel.php?section=4&categoryFrom=".($from-15)."'>
						<div class='reviewPageNumber'>
							<span><<</span>
						</div>
					</a>";
		if ((intval($n/15)+1)<7)
		{
					for($i=0;$i<(intval($n/15)+1);$i++) 
					{
					echo "<a href='controlPanel.php?section=4&categoryFrom=".($i*15)."'>
						<div class='reviewPageNumber'>";
						if ($i*15==$from)
							echo "<span style='font-weight:bold; color:#920303'>".($i+1)."</span>";
						else
							echo "<span>".($i+1)."</span>";
					echo "</div>
						</a>";
					}
		}
		else
		{
			if ($from+90<=$n)
				$to = intval($from/15)+7;
			else
				$to = intval($n/15)+2;
			for($i=(intval($from/15)+1);$i<$to;$i++) 
			{
			echo "<a href='controlPanel.php?section=4&categoryFrom=".(($i-1)*15)."'>
				<div class='reviewPageNumber'>";
				if (($i-1)*15==$from)
					echo "<span style='font-weight:bold; color:#920303'>".$i."</span>";
				else
					echo "<span>".$i."</span>";
			echo "</div>
				</a>";
			}
			if ($from+15<$n)
				echo "<span class='threeDots'>...</span>";
		}
		if ($from+15<$n)
			echo "<a href='controlPanel.php?section=4&categoryFrom=".($from+15)."'>
						<div class='reviewPageNumber'>
							<span>>></span>
						</div>
					</a>";
		echo "	</div>";
	}
}
function PrintUser($con,$user)
{
	global $HOME_USER_AVATAR_PATH;
	$image_path = "noimage.png";
	if ($user[10]!=null)
	{
		$image = ReturnImage($con,$user[10]);
		$image_path = $image[1];
	}
	echo "<div class='controlPanelUserBox shadowSmall'";
	if (isset($_POST['searchUsers'])) 
		echo " style='background:#F4F4F4' ";
	echo "						>
							<div class='controlPanelUserImage'>
								<a href='userProfile.php?id=".$user[0]."'>
								<img src='".$HOME_USER_AVATAR_PATH."/".$image_path."' alt='user image' /></a>
							</div>
							<div class='controlPanelUsername'>
								<a href='userProfile.php?id=".$user[0]."'><span>".$user[1]."</span></a>
							</div>
						</div>";
}
function printAddCategory($con)
{
	global $CATEGORY_AVATAR_PATH;
	$list=ReturnAllCategories($con);
	$categories = null;
	if ($list!=null)
		if (!is_array($list[0]))
			$categories = array($list);
		else
			$categories = $list;
		
	echo"
						<a href='postCategory.php'>
						<div class='categoryBoxNewAdmin shadow dottedBorderRadius'>
							<img src='images/gui/addCategory.png' alt='click to add category' />
							<p>Click to add category</p>
						</div>
						</a>";
	if ($categories!=null)
		foreach ($categories as $category)
		{
			if ($category[2]!=null)
				$image = ReturnImage($con,$category[2]);
			else
				$image = null;
			if ($image != null)
			{
				$imageName = $image[1];
			}
			else
			{
				$imageName = "noImage.png";
			}
			echo"		<div class='categoryBoxAdmin shadow borderRadius'>
							<div class='categoryContent content' style='background: url(\"".$CATEGORY_AVATAR_PATH."/".$imageName."\") no-repeat center; min-height:251px'>
							</div>
							<div class='categoryNameShortDescContent'>
								<p class='categoryNameParagraph'>".$category[1]."</p>
							</div>
							<div class='comments'>
								<a href='editCategory.php?idOfCategory=".$category[0]."'>
								<div class='categoryBoxEditLeft'>
									<img src='images/gui/categoryEdit.png' alt='edit category' />
									<span>Edit</span>
								</div>
								</a>
								
								<div class='categoryBoxEditRight' style='cursor:pointer' onclick='confirmDeleteCateogry(".$category[0].",\"".$_SERVER['PHP_SELF']."\")'>
									<img src='images/gui/categoryDelete.png' alt='delete category' />
									<span>Delete</span>
								</div>
								
							</div>
						</div>";
		}
}
function PrintSecondColumnControlPanel($con)
{
	global $ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		if ($_SESSION['role'] != $ROLE_REGULAR_USER)
		{
			$name = $_GET['section'];
			echo "
					<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'"; if ($name==1 || isset($_POST['searchUsers']) || $name==6 || $name==7) {echo "style='min-height:0px'";}echo">
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<img src='images/gui/wheel.png' alt='control panel' />
								<span>Control panel</span>
							</div>
							<div id='userAreaContent' class='content'"; if ($name==1 || isset($_POST['searchUsers']) || $name==6 || $name==7) {echo "style='min-height:0px'";} echo">
								<div id='controlPanelActions'>
									<div class='controlPanelActionsRow'>
										<a href='controlPanel.php?section=1'>
										<div class='controlPanelActionButton "; if($name==1) echo "activeCategory"; 
										echo"'>
											<span>Categories</span>
										</div>
										</a>
										<a href='controlPanel.php?section=2'>
										<div class='controlPanelActionButton "; if($name==2) echo "activeCategory"; 
										echo"'>
											<span>Pending Reviews</span>
										</div>
										</a>
										<a href='controlPanel.php?section=3'>
										<div class='controlPanelActionButton "; if($name==3) echo "activeCategory"; 
										echo"'>
											<span>Questions of the day</span>
										</div>
										</a>
										<a href='controlPanel.php?section=4'>
										<div class='controlPanelActionButton "; if($name==4) echo "activeCategory"; 
										echo"' style='border-right: none; width:154px'>
											<span>Users</span>
										</div>
										</a>
									</div>
									<div class='controlPanelActionsRow'>
										<a href='controlPanel.php?section=5'>
										<div class='controlPanelActionButton "; if($name==5) echo "activeCategory"; 
										echo"'>
											<span>Letters of committee</span>
										</div>
										</a>
										<a href='controlPanel.php?section=6'>
										<div class='controlPanelActionButton "; if($name==6) echo "activeCategory"; 
										echo"'>
											<span>Topics of the week</span>
										</div>
										</a>
										<a href='controlPanel.php?section=7'>
										<div class='controlPanelActionButton "; if($name==7) echo "activeCategory"; 
										echo"'>
											<span>Topics of the month</span>
										</div>
										</a>
										<div class='controlPanelActionButton' style='border-right: none; width:154px'>
											<span></span>
										</div>
									</div>
								</div>";
						if ($name == 1)
						{
							printAddCategory($con);
						}
						else if ($name == 4)
						{
							
							printListOfAllUsers($con);
							
						}
						else if ($name == 6)
						{
							printAddTopicOfTheWeek($con);
						}
						else if ($name == 7)
						{
							printAddTopicOfTheMonth($con);
						}
						else if ($name == 5) 
						{
							printAddLetterOfCommitee($con);
						}
						else if ($name == 2)
						{
							printPendingReviews($con);
						}
						else if ($name == 3)
						{
							printAddQuestionOfTheDay($con);
						}
				echo" 		</div>
						</div>";
				if ($name==4 && !isset($_POST['searchUsers']))
				{
					$num_of_reviews = ReturnCountOfAllUsers($con);
					if (!isset($_GET['categoryFrom']))
					{
							$from = 0;
					}
					else
					{
						$from = $_GET['categoryFrom'];
					}
					PrintPageNumbersUsers($num_of_reviews,$from);
				}	
			echo"		</div>
				";
		}
		else
		{
			header("Location: index.php");
		}
	}
}

function printSecondColumnPostCategory($con)
{
	global $ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']) || ($_SESSION['role'] == $ROLE_REGULAR_USER))
	{
		header("Location: index.php");
	}
	else
	{
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Add category</span>
							</div>";
				if (!isset($_POST['addCategorySubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return addcategory();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText'>
									<p id='addReviewName'>Name of category:</p>
									<p id='addReviewImage'>Image:</p>
								</div>
								<div id='addReviewInputs'>
									<input type='text' name='addCategoryNameInput' id='addReviewNameInput' value='' />
									<div class='registerWarning'>
										<span id='wrongNameWarning'>
										Required field.
										</span>
									</div>
									<span id='addReviewImageInput'><input name='addCategoryImageInput' type='file'/></span>
								</div>
								<button type='submit' id='addReviewSubmit' name='addCategorySubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Category submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
	}	
}
function printSecondColumnEditCategory($con)
{
	global $CATEGORY_AVATAR_PATH,$ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']) || ($_SESSION['role'] == $ROLE_REGULAR_USER))
	{
		header("Location: index.php");
	}
	else
	{
			$category = ReturnCategoryById($con,$_GET['idOfCategory']);
			if ($category[2]!=null)
				$image = ReturnImage($con,$category[2]);
			else
				$image = null;
			if ($image != null)
			{
				$imageName = $image[1];
			}
			else
			{
				$imageName = "noImage.png";
			}
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Edit category</span>
							</div>";
				if (!isset($_POST['editCategorySubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return addcategory();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText' style='padding-top:264px'>
									<p id='addReviewImage'>Image:</p>
									<p id='addReviewName'  style='padding-top:70px'>Name of category:</p>
								</div>
								<div id='addReviewInputs' style='padding-top:20px'>
									<div style='background:url(\"".$CATEGORY_AVATAR_PATH."/".$imageName."\") no-repeat center; min-height:251px'>
									</div>
									
									<span id='addReviewImageInput'><input name='editCategoryImageInput' type='file'/></span>
									<input type='hidden' name='idOfCategoryToEdit' value='".$category[0]."'/>
									<input type='hidden' name='oldAvatarID' value='".intval($category[2])."'/>
									<input type='text' name='editCategoryNameInput' id='addReviewNameInput' value='".$category[1]."' />
									<div class='registerWarning'>
										<span id='wrongNameWarning'>
										Required field.
										</span>
									</div>
								</div>
								<button type='submit' id='addReviewSubmit' name='editCategorySubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Category submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
	}	
}
function PrintUserReviewsSecondColumn($con)
{
	echo "<div id='secondcolumn'>
			<div id='userAreaBox' class='shadow borderRadius'>
				<div id='topicsHeader' class='gradientHeader redStripe'>
					<span>User's reviews</span>
				</div>
				<div id='userAreaContent' class='content'>";
	$reviews = ReturnUsersReviews($con,$_GET['userID']);
	$num_of_reviews = ReturnCountUsersReviews($con,$_GET['userID']);
	if ($num_of_reviews!=0)
	{
		if (!is_array($reviews[0]))
					PrintReview($con,$reviews);
				else
					foreach($reviews as $review)
						PrintReview($con,$review);
	}
	else
	{
		echo "<p style='margin:0px; padding:0px; padding-top:100px'>There are no results matching your query.</p>";
	}
	echo "		</div>
				</div>";
	echo "	</div>";
}
function PrintSearchSecondColumn($con)
{
	if (isset($_POST['search_box']) && isset($_POST['category_to_search']))
	{
		$words = $_POST['search_box'];
		$word = explode(" ", $words);
		$n = count($word);
		
		$entire_string = $word[0];
		for($i=1; $i<$n;$i++)
			$entire_string .= "%".$word[$i];
		if (!isset($_GET['categoryFrom']))
		{
			$from = 0;
		}
		else
		{
			$from = $_GET['categoryFrom'];
		}
		
		echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Search for review</span>
					</div>
					<div id='userAreaContent' class='content'>";
		if ($_POST['category_to_search']==0)
		{
			$count = 0;
			$reviews = ReturnSearchOfReviews($con,$entire_string);
			if ($reviews!=null)
			{
				$count++;
				if (!is_array($reviews[0]))
					PrintReview($con,$reviews);
				else
					foreach($reviews as $review)
						PrintReview($con,$review);
			}
			if ($n>1)
				foreach ($word as $w)
				{
					$reviews = ReturnSearchOfReviews($con,$w);
					if ($reviews!=null)
					{
						$count++;
						if (!is_array($reviews[0]))
							PrintReview($con,$reviews);
						else
							foreach($reviews as $review)
								PrintReview($con,$review);
					}
				}
			if ($count==0)
				echo "<p style='margin:0px; padding:0px; padding-top:100px'>There are no results matching your query.</p>";
		}
		else
		{
			$count = 0;
			$reviews = ReturnSearchOfReviewsFromCategory($con,$entire_string,$_POST['category_to_search']);
			if ($reviews!=null)
			{
				$count++;
				if (!is_array($reviews[0]))
					PrintReview($con,$reviews);
				else
					foreach($reviews as $review)
						PrintReview($con,$review);
			};
			if ($n>1)
				foreach ($word as $w)
				{
					$reviews = ReturnSearchOfReviewsFromCategory($con,$w,$_POST['category_to_search']);
					if ($reviews!=null)
					{
						$count++;
						if (!is_array($reviews[0]))
							PrintReview($con,$reviews);
						else
							foreach($reviews as $review)
								PrintReview($con,$review);
					}
				}
			if ($count==0)
				echo "<p style='margin:0px; padding:0px; padding-top:100px'>There are no results matching your query.</p>";
		}
		echo "		</div>
				</div>";
		echo "	</div>";
	}
	else
	{
		echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Search for review</span>
					</div>
					<div id='userAreaContent' class='content'>";
		echo "<p style='margin:0px; padding:0px; padding-top:100px'>There are no results matching your query.</p>";	
		echo "		</div>
				</div>";
		echo "	</div>";
	}
}
function PrintSecondQuestionViewColumn($con)
{
	global $BIG_REVIEW_AVATAR_PATH,$ROLE_REGULAR_USER,$COMMENT_ON_QUESTION,$LIKE,$DISLIKE,$HOME_USER_AVATAR_PATH;
	if (isset($_GET['id']))
	{
		$questionID = intval($_GET['id']);
		$review = ReturnPoll($con,$questionID);
		
		if (isset($_SESSION['id']))
		{
			$current_user = ReturnUser($con,$_SESSION['id']);
			if ($current_user[10]!=null)
			{
				$current_user_image = ReturnImage($con,$current_user[10]);
				$current_user_image_path = $current_user_image[1];
			}
			else
				$current_user_image_path = 'noimage.png';
		}
		
		$dtime = new DateTime($review[7]);
		$postedON = $dtime->format("d.m.Y");
		
		$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_QUESTION);
		$allComments = SelectCommentsForReview($con,$review[0],$COMMENT_ON_QUESTION);
		if ($allComments == null)
			$comments = null;
		else if (!is_array($allComments[0]))
			$comments = array($allComments);
		else
			$comments = $allComments;
		echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Question of the day</span>
					</div>
					<div id='userAreaContent' class='content'>
						<div id='showReviewTopPart' style='height:100px'>
							
							<div id='showReviewNameAuthor' style='padding-top:20px; height:80px'>
								<p id='showReviewName'>".$review[1]."</p>
								<p style='font-size:12px; margin-top:10px'>Ended on ".$postedON."</p>";
		
		echo "				</div>
						</div>
						<div id='showReviewText'>
						<p id='showReviewTextParagraph' style='line-height:25px'>";
		$num_answers = $review[2];
		for($i=0;$i<$num_answers;$i++)
			echo $review[3+$i]." - ".$review[8+$i]."% of users voted for.<br />";
		echo "</p> 
						</div>
						<div id='showReviewStatistics'>";
		
		if (isset($_SESSION['id']) && $_SESSION['role']!=$ROLE_REGULAR_USER)
			echo "			<img class='showReviewDelete' style='padding-left:30px; cursor:pointer' onclick='deleteQuestionConfirmation(".$questionID.",\"index.php\");' src='images/gui/delete_icon.png' alt='delete' />
							<span style='cursor:pointer' onclick='deleteQuestionConfirmation(".$questionID.",\"index.php\");' class='showReviewDeleteText'>Delete</span>";
			echo "			<span class='showReviewNumberOfComments'>".$num_of_comments." comments</span>
						</div>
						<div id='showReviewStatisticsDecoration'></div>";
		if (isset($_SESSION['id']))
			echo "		<form method='post'  onsubmit='return komment();' action=\"\">
						<div id='showReviewAddComment'>
							<input type='hidden' name='submitCommentUserId' value='".$_SESSION['id']."' />
							<input type='hidden' name='submitCommentReviewId' value='".$review[0]."' />
							<img src='".$HOME_USER_AVATAR_PATH."/".$current_user_image_path."' alt='user icon' />
							<textarea rows='4' maxlength='500' name='submitCommentBody' id='submitCommentBody'></textarea>
							<button type='submit' name='submitCommentToQuestion' id='submitCommentToReview'></button>
						</div>
						</form>";
		$i = 0;
		if ($comments != null)
			foreach ($comments as $comment)
			{
				$comment_user = ReturnUser($con,$comment[1]);
				$dtime = new DateTime($comment[4]);
				$postedON = $dtime->format("d.m.Y");
				if ($comment_user[10]!=null)
				{
					$comment_user_image = ReturnImage($con,$comment_user[10]);
					$comment_user_image_path = $comment_user_image[1];
				}
				else
					$comment_user_image_path = 'noimage.png';	
				if ($i==0 && !isset($_SESSION['id']))
				{
					echo "		<div class='showReviewComment' style='border-top:none;'>
									<a href='userProfile.php?id=".$comment[1]."'>
									<img src='".$HOME_USER_AVATAR_PATH."/".$comment_user_image_path."' alt='user icon' />
									</a>
									<div class='showReviewCommentTextPart'>
										<a href='userProfile.php?id=".$comment[1]."'>
										<span>".$comment_user[1]."</span></a><span><i> - Posted on ".$postedON.".</i></span>
										<p>".$comment[3]."</p>
									</div>
								</div>";
					$i++;
				}
				else
					echo "		<div class='showReviewComment'>
									<a href='userProfile.php?id=".$comment[1]."'>
									<img src='".$HOME_USER_AVATAR_PATH."/".$comment_user_image_path."' alt='user icon' />
									</a>
									<div class='showReviewCommentTextPart'>
										<a href='userProfile.php?id=".$comment[1]."'>
										<span>".$comment_user[1]."</span></a><span><i> - Posted on ".$postedON.".</i></span>
										<p>".$comment[3]."</p>
									</div>
								</div>";
			}
		echo "		</div>
				</div>
			</div>";
	}
}
function PrintShowReviewSecondColumn($con)
{
	global $BIG_REVIEW_AVATAR_PATH,$ROLE_REGULAR_USER,$COMMENT_ON_REVIEW,$LIKE,$DISLIKE,$HOME_USER_AVATAR_PATH;
	if (isset($_GET['id']))
	{
		$reviewID = intval($_GET['id']);
		$review = ReturnReviewById($con,$reviewID);
		$image_path = 'review_big_no_image.png';
		if ($review[5]!=null)
		{
			$image = ReturnImage($con,$review[5]);
			$image_path = $image[1];
		}
		if (isset($_SESSION['id']))
		{
			$current_user = ReturnUser($con,$_SESSION['id']);
			if ($current_user[10]!=null)
			{
				$current_user_image = ReturnImage($con,$current_user[10]);
				$current_user_image_path = $current_user_image[1];
			}
			else
				$current_user_image_path = 'noimage.png';
		}
		$username = 'Deleted user';
		if ($review[1]!=null)
		{
			$user = ReturnUser($con,$review[1]);
			$username = $user[1];
		}
		$dtime = new DateTime($review[10]);
		$postedON = $dtime->format("d.m.Y");
		if (isset($_SESSION['id']))
		{
			$flag = DidUserLikedReview($con,$_SESSION['id'],$review[0]);
		}
		$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
		$allComments = SelectCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
		if ($allComments == null)
			$comments = null;
		else if (!is_array($allComments[0]))
			$comments = array($allComments);
		else
			$comments = $allComments;
		echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Review</span>
					</div>
					<div id='userAreaContent' class='content'>
						<div id='showReviewTopPart'>
							<div id='showReviewImage'>
								<img src='".$BIG_REVIEW_AVATAR_PATH."/".$image_path."' alt='review image' />
							</div>
							<div id='showReviewNameAuthor'>
								<p id='showReviewName'>".$review[2]."</p>";
		if ($review[1]!=null)
			echo "<p id='showReviewAuthor'><a href='userProfile.php?id=".$user[0]."'>".$username."</a>, on ".$postedON."</p>";
		else
			echo "<p id='showReviewAuthor'>".$username.", on ".$postedON."</p>";
		echo "				</div>
						</div>
						<div id='showReviewText'>
							<p id='showReviewTextParagraph'>".$review[4]."</p> 
						</div>
						<div id='showReviewStatistics'>
							<span class='showReviewLikeNumber'>".$review[6]."</span>";
		if (!isset($_SESSION['id']))
		{
			echo "<img class='showReviewLike' src='images/gui/like.png' alt='like review' />";
		}
		else 
		{
		   if ($flag === $LIKE)
		   {
			   
			   echo "<img  class='showReviewLike' src='images/gui/like_blue.png' alt='like' />";
		   }
		   else if ($flag === $DISLIKE)
		   {
			   echo "<img class='showReviewLike' src='images/gui/like.png' alt='like' />";
		   }
		   else if (is_null($flag))
		   {
				echo "<a href='javascript:void(0);' 
						onclick='getImpressionFromReviewPage(".$_SESSION['id'].",".$review[0].",".$LIKE.",".$_SESSION['role'].");
						return false;'>
						<img class='showReviewLike' src='images/gui/like.png' alt='like' />
					  </a> ";
		   }
		}
		if (!isset($_SESSION['id']))
		{
			echo "<img class='showReviewDislike' src='images/gui/dislike.png' alt='dislike review' />";
		}
		else 
		{
			if ($flag === $DISLIKE)
			   {
				   
				   echo "<img class='showReviewDislike' src='images/gui/dislike_red.png' alt='like' />";
			   }
			   else if ($flag === $LIKE)
			   {
				   echo "<img class='showReviewDislike' src='images/gui/dislike.png' alt='like' />";
			   }
			   else if (is_null($flag))
			   {
					echo "<a href='javascript:void(0);' 
							onclick='getImpressionFromReviewPage(".$_SESSION['id'].",".$review[0].",".$DISLIKE.",".$_SESSION['role'].");
							return false;'>
							<img class='showReviewDislike' src='images/gui/dislike.png' alt='dislike' />
						  </a> ";
			   }
		}
		echo "				<span class='showReviewDislikeNumber'>".$review[7]."</span>";
		if (isset($_SESSION['id']) && $_SESSION['role']!=$ROLE_REGULAR_USER)
			echo "			<img class='showReviewDelete' style='cursor:pointer' onclick='deleteReviewConfirmation(".$reviewID.",\"index.php\");' src='images/gui/delete_icon.png' alt='delete' />
							<span style='cursor:pointer' onclick='deleteReviewConfirmation(".$reviewID.",\"index.php\");' class='showReviewDeleteText'>Delete</span>";
			echo "			<span class='showReviewNumberOfComments'>".$num_of_comments." comments</span>
						</div>
						<div id='showReviewStatisticsDecoration'></div>";
		if (isset($_SESSION['id']))
			echo "		<form method='post' onsubmit='return komment();' action=''>
						<div id='showReviewAddComment'>
							<input type='hidden' name='submitCommentUserId' value='".$_SESSION['id']."' />
							<input type='hidden' name='submitCommentReviewId' value='".$review[0]."' />
							<img src='".$HOME_USER_AVATAR_PATH."/".$current_user_image_path."' alt='user icon' />
							<textarea rows='4' maxlength='500' name='submitCommentBody' id='submitCommentBody'></textarea>
							<button type='submit' name='submitCommentToReview' id='submitCommentToReview'></button>
						</div>
						</form>";
		$i = 0;
		if ($comments != null)
			foreach ($comments as $comment)
			{
				$comment_user = ReturnUser($con,$comment[1]);
				$dtime = new DateTime($comment[4]);
				$postedON = $dtime->format("d.m.Y");
				if ($comment_user[10]!=null)
				{
					$comment_user_image = ReturnImage($con,$comment_user[10]);
					$comment_user_image_path = $comment_user_image[1];
				}
				else
					$comment_user_image_path = 'noimage.png';	
				if ($i==0 && !isset($_SESSION['id']))
				{
					echo "		<div class='showReviewComment' style='border-top:none;'>
									<a href='userProfile.php?id=".$comment[1]."'>
									<img src='".$HOME_USER_AVATAR_PATH."/".$comment_user_image_path."' alt='user icon' />
									</a>
									<div class='showReviewCommentTextPart'>
										<a href='userProfile.php?id=".$comment[1]."'>
										<span>".$comment_user[1]."</span></a><span><i> - Posted on ".$postedON.".</i></span>
										<p>".$comment[3]."</p>
									</div>
								</div>";
					$i++;
				}
				else
					echo "		<div class='showReviewComment'>
									<a href='userProfile.php?id=".$comment[1]."'>
									<img src='".$HOME_USER_AVATAR_PATH."/".$comment_user_image_path."' alt='user icon' />
									</a>
									<div class='showReviewCommentTextPart'>
										<a href='userProfile.php?id=".$comment[1]."'>
										<span>".$comment_user[1]."</span></a><span><i> - Posted on ".$postedON.".</i></span>
										<p>".$comment[3]."</p>
									</div>
								</div>";
			}
		echo "		</div>
				</div>
			</div>";
	}
}
function PrintSecondForgotPasswordColumn($con)
{
	global $USER_DOESNT_EXIST;
	echo "<div id='secondcolumn'>
			<div id='userAreaBox' class='shadow borderRadius'>
				<div id='topicsHeader' class='gradientHeader redStripe'>
					<span>Retrieve password</span>
				</div>
				<div id='userAreaContent' class='content'>";
				
	if (!isset($_POST['resetPassword']))
	{
			echo "<form action='' method='post' onsubmit='return forgotemail();'>
				<div id='addReviewText'>
					<p id='addReviewName'>Email:</p>
				</div>
				<div id='addReviewInputs'>
					<input name='forgotPasswordEmail' type='text' id='addReviewNameInput' value='' />
					<div class='registerWarning'>
						<p id='wrongEmailWarning'  style='margin-left:0px'>Required field</p>
					</div>
				</div>
				<button type='submit' name='resetPassword' id='addReviewSubmit'></button>
			</form>";
	}
	else
	{
		$email = $_POST['forgotPasswordEmail'];
		$flag = ResetPassword($con,$email);
		if ($flag==$USER_DOESNT_EXIST)
		{
			echo "<form action='' method='post'>
				<div id='addReviewText'>
					<p id='addReviewName'>Email:</p>
				</div>
				<div id='addReviewInputs'>
					<input name='forgotPasswordEmail' type='text' id='addReviewNameInput' value='' />
					<div class='registerWarning'>
						<p id='wrongEmailWarning'  style='margin-left:0px'>Email doesnt exist in database.</p>
					</div>
				</div>
				<button type='submit' name='resetPassword' id='addReviewSubmit'></button>
			</form>";
		}
		else
		{
			echo "<p style='margin:0px; padding:0px; padding-top:60px'>Your new password is: ".$flag."</p>";
		}
	}
	echo "		</div>
				</div>
			</div>";
}
function printSecondColumnConversation($con)
{
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		$logged_user = ReturnUser($con,$_SESSION['id']);
		$other_user = ReturnUser($con,$_GET['id']);
		
		$conversation = ReturnEntireConversationWithUser($con,$logged_user[0],$other_user[0]);
		echo "<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Conversation</span>
					</div>
					<div id='userAreaContent' class='content' style='position:relative'>";
		if ($conversation!=null)
		{
			echo "	<div class='conversationMessage' id='conversationMessage' style='overflow-y:auto; max-height:573px; border-bottom:none'>";
			foreach($conversation as $conver)
			{
				if (!isset($_REQUEST['submitComment']) && $_GET['read']==0)
					SetConversationAsRead($con,$conver[0]);
				echo	"
								<div class='conversationWrapper'>
									<div class='conversationFrom'>
										<p class='inboxConversationFrom'><a href='userProfile.php?id=";
				
				if ($conver[1]==$other_user[0])
				{
					echo $other_user[0]."'>";
					echo $other_user[1]." ";
				}
				else
				{
					echo $logged_user[0]."'>";
					echo $logged_user[1]." ";
				}
										echo "</a><i> - Posted on ".$conver[4]."</i></p>
										<p class='inboxConversationBody'>".$conver[3]."</p>
									</div>
								</div>";
								
				
			}
			echo "			</div>";
			echo"			<form method='post' action='' onsubmit='return messages();'>
							<div id='replyMessage'>
								<input type='hidden' value='".$logged_user[0]."' name='loggedUser' />
								<input type='hidden' value='".$other_user[0]."' name='otherUser' />
								<textarea rows='4' maxlength='2000' name='commentText' id='sendMessageText'></textarea>
								<button name='submitComment' type='submit' value=''></button>
							</div>
							</form>";

		}
		else
		{
			echo 
				"<p style='margin:0px; padding:0px; padding-top:20px'>This conversation is empty.</p>";
			echo"			<form method='post' action=''>
							<div id='replyMessage'>
								<input type='hidden' value='".$logged_user[0]."' name='loggedUser' />
								<input type='hidden' value='".$other_user[0]."' name='otherUser' />
								<textarea rows='4' maxlength='2000' name='commentText'></textarea>
								<button name='submitComment' type='submit' value=''></button>
							</div>
							</form>";
		}
		echo "		</div>
				</div>
			</div>";
	}
}
function printSecondColumnInbox($con)
{
	global $HOME_USER_AVATAR_PATH;
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		$conversations = ReturnUsersInConversations($con,$_SESSION['id']);
		
		echo "
			<div id='secondcolumn'>
				<div id='userAreaBox' class='shadow borderRadius'>
					<div id='topicsHeader' class='gradientHeader redStripe'>
						<span>Messages</span>
					</div>
					<div id='userAreaContent' class='content'>";
		if ($conversations!=null)
		{	
			$with = array();
			$without = array();
			foreach ($conversations  as $conversation)
			{
				if ($conversation[0]==$_SESSION['id'])
				{
					$count = NewMessageFromUser($con,$conversation[1],$conversation[0]);
					if ($count>0)
						array_push($with,$conversation);
					else
						array_push($without,$conversation);
				}
				else
				{
					$count = NewMessageFromUser($con,$conversation[0],$conversation[1]);
					if ($count>0)
						array_push($with,$conversation);
					else
						array_push($without,$conversation);
				}	
			}
			foreach ($with as $conversation)
			{
				$image_path = 'noimage.png';
				if ($conversation[0]==$_SESSION['id'])
				{
					$user = ReturnUser($con,$conversation[1]);
				}
				else
				{
					$user = ReturnUser($con,$conversation[0]);
				}
				if ($user[10]!=null)
				{
					$image = ReturnImage($con,$user[10]);
					$image_path = $image[1];
				}
				echo"
						<div class='inboxMessage'>
								<a style='cursor:pointer;' href='conversation.php?id=".$user[0]."&read=0'>
								<div class='inboxMessageUserPicture' style='background:url(\"".$HOME_USER_AVATAR_PATH."/".$image_path."\") no-repeat center;
									width:62px; height:62px;'></div></a>
								<div class='inboxMessageFrom'>
									<a style='cursor:pointer;' href='conversation.php?id=".$user[0]."&read=0'><p class='inboxMessageFromUser' style='padding-left:20px; margin-top:10px;'>Conversation with: ".$user[1]."</p></a>
								</div>";
				echo "	<img class='inboxMessageNewMessage' src='images/gui/new_message.png' alt='new message' />";
				echo"	</div>";
			}
			foreach ($without as $conversation)
			{
				$image_path = 'noimage.png';
				if ($conversation[0]==$_SESSION['id'])
				{
					$user = ReturnUser($con,$conversation[1]);
				}
				else
				{
					$user = ReturnUser($con,$conversation[0]);
				}
				if ($user[10]!=null)
				{
					$image = ReturnImage($con,$user[10]);
					$image_path = $image[1];
				}
				echo"
						<div class='inboxMessage'>
								<a style='cursor:pointer;' href='conversation.php?id=".$user[0]."&read=1'>
								<div class='inboxMessageUserPicture' style='background:url(\"".$HOME_USER_AVATAR_PATH."/".$image_path."\") no-repeat center;
									width:62px; height:62px;'></div></a>
								<div class='inboxMessageFrom'>
									<a style='cursor:pointer;' href='conversation.php?id=".$user[0]."&read=1'><p class='inboxMessageFromUser' style='padding-left:20px; margin-top:10px;'>Conversation with: ".$user[1]."</p></a>
								</div>";
				echo"	</div>";
			}
		}
		else
			echo "<p style='margin:0px; padding:0px; padding-top:20px'>You don't have any messages.</p>";
		echo "		</div>
				</div>
			</div>
		";
	}
}
function printAddTopicOfTheWeek($con)
{
	global $CATEGORY_AVATAR_PATH;
	//$list=ReturnAllCategories($con);
	$list = ReturnRangeOfAllTopicsOfTheWeek($con,0,2000);
	$categories = null;
	if ($list!=null)
		if (!is_array($list[0]))
			$categories = array($list);
		else
			$categories = $list;
		
	echo"
						<a href='postTopicOfTheWeek.php'>
						<div class='categoryBoxNewAdmin shadow dottedBorderRadius' style='min-height:0px'>
							<img src='images/gui/addCategory.png' alt='click to add category' />
							<p>Click to add category</p>
						</div>
						</a>";
		
	if ($categories!=null)
		foreach ($categories as $category)
		{
			if ($category[2]!=null)
				$image = ReturnImage($con,$category[2]);
			else
				$image = null;
			if ($image != null)
			{
				$imageName = $image[1];
			}
			else
			{
				$imageName = "noImage.png";
			}
			echo"		<div class='categoryBoxAdmin shadow borderRadius'>
							<div class='categoryContent content' style='background: url(\"".$CATEGORY_AVATAR_PATH."/".$imageName."\") no-repeat center; min-height:251px'>
							</div>
							<div class='categoryNameShortDescContent'>
								<p class='categoryNameParagraph'>".$category[1]."</p>
							</div>
							<div class='comments'>
								<a href='editTopicOfTheWeek.php?idOfCategory=".$category[0]."'>
								<div class='categoryBoxEditLeft'>
									<img src='images/gui/categoryEdit.png' alt='edit category' />
									<span>Edit</span>
								</div>
								</a>
								
								<div class='categoryBoxEditRight' style='cursor:pointer' onclick='confirmDeleteTopicOfTheWeek(".$category[0].",\"".$_SERVER['PHP_SELF']."\")'>
									<img src='images/gui/categoryDelete.png' alt='delete category' />
									<span>Delete</span>
								</div>
								
							</div>
						</div>";
		}
		
}
function printSecondColumnPostTopicOfTheWeek($con)
{
	global $ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']) || ($_SESSION['role'] == $ROLE_REGULAR_USER))
	{
		header("Location: index.php");
	}
	else
	{
			$timezone = "Europe/Moscow";
			date_default_timezone_set($timezone);
			$today = date("Y-m-d");
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Add topic of the week</span>
							</div>";
				if (!isset($_POST['addTopicOfTheWeekSubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return addcategory();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText'>
									<p id='addReviewName'>Name of category:</p>
									<p id='addReviewName' style='padding-top:47px'>From:</p>
									<p id='addReviewName' style='padding-top:40px'>To:</p>
									<p id='addReviewImage' style='padding-top:50px'>Image:</p>
								</div>
								<div id='addReviewInputs'>
									<input type='text' name='addCategoryNameInput' id='addReviewNameInput' value='' />
									<div class='registerWarning'>
										<span id='wrongNameWarning'>
										Required field.
										</span>
									</div>
									<input type='date' name='fromDate' style='margin-top:35px' value='".$today."' required/>
									<input type='date' name='toDate' style='margin-top:35px' value='".$today."' required/>	
									<span id='addReviewImageInput' style='padding-left:65px'><input name='addCategoryImageInput' type='file'/></span>
								</div>
								<button type='submit' id='addReviewSubmit' name='addTopicOfTheWeekSubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Topic of the week submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
	}	
}
function printAddTopicOfTheMonth($con)
{
	global $CATEGORY_AVATAR_PATH;
	//$list=ReturnAllCategories($con);
	$list = ReturnRangeOfAllTopicsOfTheMonth($con,0,2000);
	$categories = null;
	if ($list!=null)
		if (!is_array($list[0]))
			$categories = array($list);
		else
			$categories = $list;
		
	echo"
						<a href='postTopicOfTheMonth.php'>
						<div class='categoryBoxNewAdmin shadow dottedBorderRadius' style='min-height:0px'>
							<img src='images/gui/addCategory.png' alt='click to add category' />
							<p>Click to add category</p>
						</div>
						</a>";
		
	if ($categories!=null)
		foreach ($categories as $category)
		{
			if ($category[2]!=null)
				$image = ReturnImage($con,$category[2]);
			else
				$image = null;
			if ($image != null)
			{
				$imageName = $image[1];
			}
			else
			{
				$imageName = "noImage.png";
			}
			echo"		<div class='categoryBoxAdmin shadow borderRadius'>
							<div class='categoryContent content' style='background: url(\"".$CATEGORY_AVATAR_PATH."/".$imageName."\") no-repeat center; min-height:251px'>
							</div>
							<div class='categoryNameShortDescContent'>
								<p class='categoryNameParagraph'>".$category[1]."</p>
							</div>
							<div class='comments'>
								<a href='editTopicOfTheMonth.php?idOfCategory=".$category[0]."'>
								<div class='categoryBoxEditLeft'>
									<img src='images/gui/categoryEdit.png' alt='edit category' />
									<span>Edit</span>
								</div>
								</a>
								
								<div class='categoryBoxEditRight' style='cursor:pointer' onclick='confirmDeleteTopicOfTheMonth(".$category[0].",\"".$_SERVER['PHP_SELF']."\")'>
									<img src='images/gui/categoryDelete.png' alt='delete category' />
									<span>Delete</span>
								</div>
								
							</div>
						</div>";
		}
		
}
function printSecondColumnPostTopicOfTheMonth($con)
{
	global $ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']) || ($_SESSION['role'] == $ROLE_REGULAR_USER))
	{
		header("Location: index.php");
	}
	else
	{
			$timezone = "Europe/Moscow";
			date_default_timezone_set($timezone);
			$today = date("Y-m-d");
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Add topic of the week</span>
							</div>";
				if (!isset($_POST['addTopicOfTheMonthSubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return addcategory();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText'>
									<p id='addReviewName'>Name of category:</p>
									<p id='addReviewName' style='padding-top:47px'>From:</p>
									<p id='addReviewName' style='padding-top:40px'>To:</p>
									<p id='addReviewImage' style='padding-top:50px'>Image:</p>
								</div>
								<div id='addReviewInputs'>
									<input type='text' name='addCategoryNameInput' id='addReviewNameInput' value='' />
									<div class='registerWarning'>
										<span id='wrongNameWarning'>
										Required field.
										</span>
									</div>
									<input type='date' name='fromDate' style='margin-top:35px' value='".$today."' required/>
									<input type='date' name='toDate' style='margin-top:35px' value='".$today."' required/>	
									<span id='addReviewImageInput' style='padding-left:65px'><input name='addCategoryImageInput' type='file'/></span>
								</div>
								<button type='submit' id='addReviewSubmit' name='addTopicOfTheMonthSubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Topic of the month submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
	}	
}
function printSecondColumnEditTopicOfTheMonth($con)
{
	global $CATEGORY_AVATAR_PATH,$ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']) || ($_SESSION['role'] == $ROLE_REGULAR_USER))
	{
		header("Location: index.php");
	}
	else
	{
			$category = ReturnCategoryById($con,$_GET['idOfCategory']);
			if ($category[2]!=null)
				$image = ReturnImage($con,$category[2]);
			else
				$image = null;
			if ($image != null)
			{
				$imageName = $image[1];
			}
			else
			{
				$imageName = "noImage.png";
			}
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Edit topic of the month</span>
							</div>";
				if (!isset($_POST['editTopicOfTheMonthSubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return addcategory();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText' style='padding-top:264px'>
									<p id='addReviewImage'>Image:</p>
									<p id='addReviewName'  style='padding-top:70px'>Name of category:</p>
								</div>
								<div id='addReviewInputs' style='padding-top:20px'>
									<div style='background:url(\"".$CATEGORY_AVATAR_PATH."/".$imageName."\") no-repeat center; min-height:251px'>
									</div>
									
									<span id='addReviewImageInput'><input name='editCategoryImageInput' type='file'/></span>
									<input type='hidden' name='idOfCategoryToEdit' value='".$category[0]."'/>
									<input type='hidden' name='oldAvatarID' value='".intval($category[2])."'/>
									<input type='text' name='editCategoryNameInput' id='addReviewNameInput' value='".$category[1]."' />
									<div class='registerWarning'>
										<span id='wrongNameWarning'>
										Required field.
										</span>
									</div>
									<input type='date' name='editFromDate' style='margin-top:35px' value='".date('Y-m-d', strtotime($category[6]))."' required/>
									<input type='date' name='editToDate' style='margin-top:35px' value='".date('Y-m-d', strtotime($category[7]))."' required/>	
								</div>
								<button type='submit' id='addReviewSubmit' name='editTopicOfTheMonthSubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Category submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
	}	
}
function printSecondColumnEditTopicOfTheWeek($con)
{
	global $CATEGORY_AVATAR_PATH,$ROLE_REGULAR_USER;
	if (!isset($_SESSION['id']) || ($_SESSION['role'] == $ROLE_REGULAR_USER))
	{
		header("Location: index.php");
	}
	else
	{
			$category = ReturnCategoryById($con,$_GET['idOfCategory']);
			if ($category[2]!=null)
				$image = ReturnImage($con,$category[2]);
			else
				$image = null;
			if ($image != null)
			{
				$imageName = $image[1];
			}
			else
			{
				$imageName = "noImage.png";
			}
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Edit topic of the month</span>
							</div>";
				if (!isset($_POST['editTopicOfTheWeekSubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return addcategory();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText' style='padding-top:264px'>
									<p id='addReviewImage'>Image:</p>
									<p id='addReviewName'  style='padding-top:70px'>Name of category:</p>
								</div>
								<div id='addReviewInputs' style='padding-top:20px'>
									<div style='background:url(\"".$CATEGORY_AVATAR_PATH."/".$imageName."\") no-repeat center; min-height:251px'>
									</div>
									
									<span id='addReviewImageInput'><input name='editCategoryImageInput' type='file'/></span>
									<input type='hidden' name='idOfCategoryToEdit' value='".$category[0]."'/>
									<input type='hidden' name='oldAvatarID' value='".intval($category[2])."'/>
									<input type='text' name='editCategoryNameInput' id='addReviewNameInput' value='".$category[1]."' />
									<div class='registerWarning'>
										<span id='wrongNameWarning'>
										Required field.
										</span>
									</div>
									<input type='date' name='editFromDate' style='margin-top:35px' value='".date('Y-m-d', strtotime($category[6]))."' required/>
									<input type='date' name='editToDate' style='margin-top:35px' value='".date('Y-m-d', strtotime($category[7]))."' required/>	
								</div>
								<button type='submit' id='addReviewSubmit' name='editTopicOfTheWeekSubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Category submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
	}	
}
function printAddLetterOfCommitee($con)
{
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		$categories=ReturnAllCategories($con);
		$topic_of_the_month = ReturnActiveTopicOfTheWeek($con);
		$topic_of_the_week = ReturnActiveTopicOfTheMonth($con);
		echo"
		<div id='secondcolumn'>
					";
						
			if (!isset($_POST['addLetterSubmit']))
			{
			echo	"<form ACTION='' METHOD='POST' onsubmit='return letterofcommittee();' enctype='multipart/form-data'>
							<p style='padding:0px; margin:0px; margin-top:30px;'>Add letter of commitee</p>
							<div id='addReviewText'>
								<p id='addReviewBody'>Review text:</p>
							</div>
							<div id='addReviewInputs'>
								<textarea name='addReviewBodyInput' id='addReviewBodyInput' value=''></textarea>
								<div class='registerWarning'>
									<span id='wrongTextWarning'>
									Required field.
									</span>
								</div>
							</div>
							<button type='submit' id='addReviewSubmit' name='addLetterSubmit'></button>
						
					</form>";
			}
			else
				{
					echo "<p style='margin:0px; padding:0px; margin-top:50px'>Letter of committee submited succesfully</p>";
				}
		echo"		
				</div>
		";
	}
}
function printPendingReviews($con)
{
		$reviews = ReturnUnapprovedReviews($con);
		if ($reviews!=null)
		{
			if (is_array($reviews[0]))
			{
				foreach($reviews as $review)
					PrintUnapprovedReview($con,$review);
			}
			else
			{
				PrintUnapprovedReview($con,$reviews);
			}
		}
		else
			echo "<p style='margin:0px; padding:0px; padding-top:100px'>This section is currently empty.</p>";
		
}
function PrintUnapprovedReview($con,$review)
{

	global $COMMENT_ON_REVIEW,$LIKE_TAG, $LIKE, $DISLIKE;
	$image_path = 'images/all_reviews_avatars/review_no_image.png';
	if ($review[5]!=null)
	{
		$image = ReturnImage($con,$review[5]);
		$image_path = "images/all_reviews_avatars/".$image[1];
	}
	$user = null;
	$username = 'Deleted user';
	if ($review[1]!=null)
	{
		$user = ReturnUser($con,$review[1]);
		$username = $user[1];
	}
	$dtime = new DateTime($review[10]);
	$postedON = $dtime->format("d.m.Y");
	if (isset($_SESSION['id']))
	{
		$flag = DidUserLikedReview($con,$_SESSION['id'],$review[0]);
	}
	$num_of_comments = 0;
	echo "<div class='reviewRow'>
			<div class='reviewRowInfo'>
				<div class='reviewRowImage'>
					<a href='approveReview.php?id=".$review[0]."'>
					<img src='".$image_path."' alt='review image' />
					</a>
				</div>
				<div class='reviewInformation'>
					<a href='approveReview.php?id=".$review[0]."' class='reviewInformationName'>".$review[2]."</a>
					<p><i>";
	if ($review[1]!=null)
		echo "<a href='userProfile.php?id=".$review[1]."'>".$username."</a>";
	else
		echo $username;
	echo 			" on ".$postedON."</i></p>
					<p style='color:#757575'>".$review[3]."</p>
				</div>
			</div>
			<div class='reviewRowStatistics' id=".$review[0].">
				<div class='reviewRowComments'>
					<span>".$num_of_comments."</span>
				</div>
			</div>
		</div>";
}
function printSecondColumnAproveReview($con)
{
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		$idOfReview = $_GET['id'];
		$review = ReturnReviewById($con, $idOfReview);
		$categories=ReturnAllCategories($con);
		$topic_of_the_month = ReturnActiveTopicOfTheWeek($con);
		$topic_of_the_week = ReturnActiveTopicOfTheMonth($con);
		$image_path = 'images/review_avatars/review_big_no_image.png';
		$text = $review[4];
		$text = str_replace('<br />', PHP_EOL, $text);
		$imageID = 0;
		if ($review[5]!=null)
		{
			$image = ReturnImage($con,$review[5]);
			$imageID = $image[0];
			$image_path = "images/review_avatars/".$image[1];
		}
		echo"
		<div id='secondcolumn'>
					<div id='userAreaBox' class='shadow borderRadius'>
						<div id='topicsHeader' class='gradientHeader redStripe'>
							<span>Add review</span>
						</div>";
			if (!isset($_POST['aproveReviewSubmit']) && !isset($_POST['declineReviewSubmit']))
			{
			echo	"<form ACTION='' METHOD='POST' onsubmit='return addreview();' enctype='multipart/form-data'>
						<input type='hidden' name='idOfReview' value='".$review[0]."' />
						<input type='hidden' name='oldAvatarID' value='".$imageID."' />
						<input type='hidden' name='userID' value='".$review[1]."' />
						<div id='userAreaContent' class='content'>
							<div style='width:579px; height:190px; margin:auto auto; padding-top:25px'>
							<img src='".$image_path."'/>
							</div>
							<div id='addReviewText'>
								<p id='addReviewName'>Name of review:</p>
								<p id='addReviewBody'>Review text:</p>
								<p id='addReviewCateogry'>Category:</p>
								<p id='addReviewImage'>Image:</p>
							</div>
							<div id='addReviewInputs'>
								<input type='text' name='addReviewNameInput' id='addReviewNameInput' value='".$review[2]."' />
								<div class='registerWarning'>
									<span id='wrongNameWarning'>
									Required field.
									</span>
								</div>
								<textarea name='addReviewBodyInput' id='addReviewBodyInput'>".$text."</textarea>
								<div class='registerWarning'>
									<span id='wrongTextWarning'>
									Required field.
									</span>
								</div>
								<select name='addReviewCategoryInput' id='addReviewCategoryInput'>";
									if ($topic_of_the_month != null)
									{
										echo" <option value='".$topic_of_the_month[0]."'"; 
										
										if($topic_of_the_month[0] == $review[11])
										echo " selected";
										echo" >TOPIC OF THE MONTH:".$topic_of_the_month[1]."</option>";
									}
									if ($topic_of_the_week !=null)
									{
										echo" <option value='".$topic_of_the_week[0]."'"; 
										
										if($topic_of_the_week[0] == $review[11])
										echo " selected";
										echo" >TOPIC OF THE WEEK:".$topic_of_the_week[1]."</option>";
									}
									foreach ($categories as $category)
									{
										echo" <option value='".$category[0]."'"; 
										
										if($category[0] == $review[11])
										echo " selected";
										echo" >".$category[1]."</option>";
									}
			echo"				</select>
								<span id='addReviewImageInput'><input name='addReviewImageInput' type='file'/></span>
							</div>
							<button type='submit' id='addReviewSubmit' name='aproveReviewSubmit' style='margin-bottom:20px'></button>
							<button type='submit' id='addReviewSubmit' name='declineReviewSubmit' style='margin-bottom:20px'></button>
						</div>
					</form>";
			}
			else
				{
					header("Location: controlPanel.php?section=2");
				}
		echo"		</div>
				</div>
		";
	}	
}
function printAddQuestionOfTheDay($con)
{

	$reviews = ReturnAllFuturePolls($con);
	echo "<a href='editPoll.php'><div class='reviewRow' style='background:white'>
			<p style='margin:0px; padding:0px'>Click to add question of the day</p>
		</div></a>";
	if ($reviews!=null)
	{
		if (is_array($reviews[0]))
		{
			foreach($reviews as $review)
				PrintFuturePoll($con,$review);
		}
		else
		{
			PrintFuturePoll($con,$reviews);
		}
	}
}
function PrintFuturePoll($con,$poll)
{
	global $COMMENT_ON_QUESTION;
	$dtime = new DateTime($poll[7]);
	$postedON = $dtime->format("d.m.Y");
	
	$postedON= date("d.m.Y", strtotime('-1 day', strtotime($postedON)));
	echo "<div class='reviewRow'>
			<div class='reviewRowInfo'>
				<div class='reviewInformation' style='padding-top:5px'>
					<p style='padding-left:20px; font-size:16px; color:black' class='reviewInformationName'>".$poll[1]."</p>
					<p style='color:#000000; margin:0px padding:0px; padding-top:5px; padding-left:20px;'>Active on ".$postedON."</p>";
	$num_of_answers = $poll[2];
	$num_of_comments = CountCommentsForReview($con,$poll[0],$COMMENT_ON_QUESTION);
	for ($i=0;$i<$num_of_answers;$i++)
		echo "<p style='margin:0px; padding:0px; padding-top:5px; padding-left:20px;' >".$poll[3+$i]."</p>";
	echo "	</div>";
	echo "</div>
			<div class='reviewRowStatistics' style='height:0%; padding-top:40px; font-size:16px'>
				<a href='editPoll.php?id=".$poll[0]."'>Edit</a>
				<br /><br /> 
				<a href='editPoll.php?deleteID=".$poll[0]."'>Delete</a>
			</div>
		</div>";
				
}
function printSecondColumnEditPoll($con)
{
	if (!isset($_SESSION['id']))
	{
		header("Location: index.php");
	}
	else
	{
		
		if (isset($_GET['id']))
		{
			$poll = ReturnPoll($con,$_GET['id']);
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Add poll</span>
							</div>";
				if (!isset($_POST['editPollSubmit']))
				{
				echo	"<form ACTION='' METHOD='POST'  onsubmit='return questionoftheday();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText'>
									<p id='addReviewName'>Question:</p>
									<p id='addReviewName' style='padding-top:65px'>Answer 1:</p>
									<p id='addReviewName' style='padding-top:67px'>Answer 2:</p>
									<p id='addReviewName' style='padding-top:65px'>Answer 3:</p>
									<p id='addReviewName' style='padding-top:62px'>Answer 4:</p>
									<p id='addReviewName' style='padding-top:65px'>Exparation time:</p>
								</div>
								<div id='addReviewInputs'>
									<input type='text' name='addCategoryNameInput' id='addQuestionText' class='addReviewNameInput1' value='".$poll[1]."' />
									<div class='registerWarning'>
										<span id='wrongQuestionText'>
										Required field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer1Input' id='addAnswer1' class='addReviewNameInput1' value='".$poll[3]."' />
									<div class='registerWarning'>
										<span id='wrongAnswer1'>
										Required field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer2Input' id='addAnswer2' class='addReviewNameInput1' value='".$poll[4]."' />
									<div class='registerWarning'>
										<span id='wrongAnswer2'>
										Required field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer3Input' id='addAnswer3' class='addReviewNameInput1' value='".$poll[5]."' />
									<div class='registerWarning'>
										<span id='wrongAnswer3'>
										Optional field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer4Input' id='addAnswer4' class='addReviewNameInput1' value='".$poll[6]."' />
									<div class='registerWarning'>
										<span id='wrongAnswer4'>
										Optional field.
										</span>
									</div>
									<input type='date' name='expDate' style='margin-top:55px' value='".date("Y-m-d",strtotime($poll[7]))."' required/>
								</div>
								<button type='submit' id='addReviewSubmit' name='editPollSubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Poll submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
		}
		else if(isset($_GET['deleteID']))
		{
			DeletePoll($con,$_GET['deleteID']);
			header("Location: controlPanel.php?section=3");
		}
		else
		{
			$today = date("Y-m-d");
			echo"
			<div id='secondcolumn'>
						<div id='userAreaBox' class='shadow borderRadius'>
							<div id='topicsHeader' class='gradientHeader redStripe'>
								<span>Add poll</span>
							</div>";
				if (!isset($_POST['addPollSubmit']))
				{
				echo	"<form ACTION='' METHOD='POST' onsubmit='return questionoftheday();' enctype='multipart/form-data'>
							<div id='userAreaContent' class='content'>
								<div id='addReviewText'>
									<p id='addReviewName'>Question:</p>
									<p id='addReviewName' style='padding-top:65px'>Answer 1:</p>
									<p id='addReviewName' style='padding-top:67px'>Answer 2:</p>
									<p id='addReviewName' style='padding-top:65px'>Answer 3:</p>
									<p id='addReviewName' style='padding-top:62px'>Answer 4:</p>
									<p id='addReviewName' style='padding-top:65px'>Exparation time:</p>
								</div>
								<div id='addReviewInputs'>
									<input type='text' name='addCategoryNameInput' id='addQuestionText' class='addReviewNameInput1' value='' />
									<div class='registerWarning'>
										<span id='wrongQuestionText'>
										Required field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer1Input' id='addAnswer1' class='addReviewNameInput1' value='' />
									<div class='registerWarning'>
										<span id='wrongAnswer1'>
										Required field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer2Input' id='addAnswer2' class='addReviewNameInput1' value='' />
									<div class='registerWarning'>
										<span id='wrongAnswer2'>
										Required field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer3Input' id='addAnswer3' class='addReviewNameInput1' value='' />
									<div class='registerWarning'>
										<span id='wrongAnswer3'>
										Optional field.
										</span>
									</div>
									<input type='text' name='addCategoryAnswer4Input' id='addAnswer4' class='addReviewNameInput1' value='' />
									<div class='registerWarning'>
										<span id='wrongAnswer4'>
										Optional field.
										</span>
									</div>
									<input type='date' name='expDate' style='margin-top:55px' value='".$today."' required/>
								</div>
								<button type='submit' id='addReviewSubmit' name='addPollSubmit'></button>
							</div>
						</form>";
				}
				else
					{
						echo "<p style='margin:0px; padding:0px; margin-top:50px'>Poll submited succesfully</p>";
					}
			echo"		</div>
					</div>
			";
		}
		
	}
}
?>