<?php
    require_once('DatabaseQueries.php');
	$con = connect();
    AddImpression($con,$_REQUEST['userID'],$_REQUEST['reviewID'],$_REQUEST['action']);
    $review = ReturnReviewById($con,$_REQUEST['reviewID']);
    if($_REQUEST['action'] == $LIKE)
    {
		if (!isset($_REQUEST['page']))
			echo "
				  <div class='likes'>
					<span>".$review[6]."</span>
					<img src='images/gui/like_blue.png' alt='like'/>
				  </div>
				  <div class='dislikes'>
					<span>".$review[7]."</span>
					<img src='images/gui/dislike.png' alt='dislike'/>
				  </div>
				";
		else
		if ($_REQUEST['page']==1)
		{
			$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
			echo "
				<div class='reviewRowLike'>
					<spanstyle='padding-right:4px;'>".$review[6]."</span>
					<img src='images/gui/like_blue.png' alt='like review' />
				</div>
				<div class='reviewRowDisike'>
					<img src='images/gui/dislike.png' style='float:left; padding-left:23px' alt='dislike review' />
					<span style='float:left; padding-left:5px'>".$review[7]."</span>
				</div>
				<div class='reviewRowComments'>
					<span>".$num_of_comments."</span>
				</div>
			";
		}
		else if ($_REQUEST['page']==2)
		{
			$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
			echo "<span class='showReviewLikeNumber'>".$review[6]."</span>
				<img class='showReviewLike' src='images/gui/like_blue.png' alt='like' />
				<img class='showReviewDislike' src='images/gui/dislike.png' alt='dislike' />
				<span class='showReviewDislikeNumber'>".$review[7]."</span>";
				if ($_REQUEST['role']!=0)
					echo "<img class='showReviewDelete' style='cursor:pointer' onclick='deleteReviewConfirmation(".$review[0].",\"index.php\");' src='images/gui/delete_icon.png' alt='delete' />
					<span style='cursor:pointer' onclick='deleteReviewConfirmation(".$review[0].",\"index.php\");' class='showReviewDeleteText'>Delete</span>";
			echo "<span class='showReviewNumberOfComments'>".$num_of_comments." comments</span>";
		}
    }
    else if ($_REQUEST['action'] == $DISLIKE)
    {
		if (!isset($_REQUEST['page']))
			echo "
				  <div class='likes'>
					<span>".$review[6]."</span>
					<img src='images/gui/like.png' alt='like'/>
				  </div>
				  <div class='dislikes'>
					<span>".$review[7]."</span>
					<img src='images/gui/dislike_red.png' alt='dislike'/>
				  </div>
				";
		else if ($_REQUEST['page']==1)
		{
			$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
			echo "
				<div class='reviewRowLike'>
					<spanstyle='padding-right:4px;'>".$review[6]."</span>
					<img src='images/gui/like.png' alt='like review' />
				</div>
				<div class='reviewRowDisike'>
					<img src='images/gui/dislike_red.png' style='float:left; padding-left:23px' alt='dislike review' />
					<span style='float:left; padding-left:5px'>".$review[7]."</span>
				</div>
				<div class='reviewRowComments'>
					<span>".$num_of_comments."</span>
				</div>
			";
		}
		else if ($_REQUEST['page']==2)
		{
			$num_of_comments = CountCommentsForReview($con,$review[0],$COMMENT_ON_REVIEW);
			echo "<span class='showReviewLikeNumber'>".$review[6]."</span>
				<img class='showReviewLike' src='images/gui/like.png' alt='like' />
				<img class='showReviewDislike' src='images/gui/dislike_red.png' alt='dislike' />
				<span class='showReviewDislikeNumber'>".$review[7]."</span>";
				if ($_REQUEST['role']!=0)
			echo "<img class='showReviewDelete' style='cursor:pointer' onclick='deleteReviewConfirmation(".$review[0].",\"index.php\");' src='images/gui/delete_icon.png' alt='delete' />
					<span style='cursor:pointer' onclick='deleteReviewConfirmation(".$review[0].",\"index.php\");' class='showReviewDeleteText'>Delete</span>";
			echo "<span class='showReviewNumberOfComments'>".$num_of_comments." comments</span>";
		}
    }
	$con = null;
?>
