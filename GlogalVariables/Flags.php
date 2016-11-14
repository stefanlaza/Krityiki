<?php
//flag to use when user doesnt exist in database
$USER_DOESNT_EXIST = 0;
//flag to use when username exists in database
$USERNAME_EXISTS  = 1;
//flag to use when email exists in database
$EMAIL_EXISTS = 2;
//flag to use when registration was successfull
$REGISTRATION_SUCCESSFULL = 3;
//flag to use when user's changes were stored successfully
$USER_EDITED_SUCCESSFULL = 4;
//flag to use when deleting the records from database successfully
$RECORDS_DELETED = 5;
//flag to use when reviews had been counted per category
$REVIEWS_PER_CATEGORY_COUNTED = 6;
//flags to use when working with users role
$ROLE_REGULAR_USER = 0;
$ROLE_MODERATOR = 1;
$ROLE_ADMINISTRATOR = 2;
//flag to use when poll was created successfull
$POLL_CREATED = 7;
//flag to use when poll doesnt exists
$POLL_DOESNT_EXIST = 8;
//flag to use when poll was updated
$POLL_UPDATED = 9; 
//flag to use when poll is deleted
$POLL_DELETED = 10;
//flag to use when user answers the question of the day
$ANSWER_SAVED = 11;
//flags to use when checking if user voted on the question of the day
$USER_VOTED = 12;
$USER_DIDNT_VOTED = 13;
//flag to use when image is added in database
$IMAGE_REGISTERED = 14;
//flag to use when moderator/administrator creates category
$CATEGORY_CREATED = 15;
//flag to use when moderator/administrator deletes category
$CATEGORY_DELETED = 16;
//flag to use when moderator/administrator updates category
$CATEGORY_UPDATED = 17;
//flag to use when working with category types
$REGULAR_CATEGORY = 0;
$TOPIC_OF_THE_WEEK = 1;
$TOPIC_OF_THE_MONTH = 2;
//flag to use when working with review types
$REGULAR_REVIEW = 0;
$LETTER_OF_COMMITTEE = 1;
//flag to use when review has been created
$REVIEW_CREATED = 18;
//flag to use when review has been updated
$REVIEW_UPDATED = 19;
//flag to use when review has been deleted
$REVIEW_DELETED = 20;
//flag to use when user liked/disliked review
$IMPRESSION_ADDED = 21;
//flag to use for LIKE action
$DISLIKE = 0;
$LIKE = 1;
//flag to use when checking if user liked review
$USER_LIKED_REVIEW = 22;
//flag to use when checking if user didn't made an impression on review
$USER_DIDNT_LIKED_REVIEW = 23;
//flag to use when comment has been created
$COMMENT_CREATED = 24;
//flag to use when comment has been deleted
$COMMENT_DELETED = 25;
//flag to use when comment has been changed
$COMMENT_UPDATED = 26;
//flags to use when describing type of comment
$COMMENT_ON_REVIEW = 0;
$COMMENT_ON_QUESTION = 1;
//flag representing image for dislike button
$DISLIKE_TAG = "<img src='images/gui/dislike.png' alt='dislike'/>";
//flag representing image for like button
$LIKE_TAG = "<img src='images/gui/like.png' alt='like'/>";
$UNKNOWN_IMAGE_EXTENSION = 27;
$FILE_SIZE_LIMIT_EXCEEDED = 28;
$AVATAR_UPLOADED_SUCCESFULLY = 29;
$REVIEW_AVATAR = 30;
$USER_AVATAR = 31;
$CATEGORY_AVATAR = 32;
$HOME_REVIEW_AVATAR_WIDTH = 183; 
$HOME_REVIEW_AVATAR_HEIGHT = 67;
$HOME_REVIEW_AVATAR_PATH = "images/thumbnail_review_avatars";
$ALL_REVIEW_AVATAR_WIDTH = 103;
$ALL_REVIEW_AVATAR_HEIGHT = 103;
$ALL_REVIEW_AVATAR_PATH = "images/all_reviews_avatars";
$BIG_REVIEW_AVATAR_WIDTH = 579;
$BIG_REVIEW_AVATAR_HEIGHT = 190;
$BIG_REVIEW_AVATAR_PATH = "images/review_avatars";
$HOME_USER_AVATAR_WIDTH = 62;
$HOME_USER_AVATAR_HEIGHT = 62;
$HOME_USER_AVATAR_PATH = "images/user_avatars_thumbs";
$BIG_USER_AVATAR_WIDTH = 243;
$BIG_USER_AVATAR_HEIGHT = 243;
$BIG_USER_AVATAR_PATH = "images/user_avatars";
$CATEGORY_AVATAR_WIDTH = 200;
$CATEGORY_AVATAR_HEIGHT = 251;
$CATEGORY_AVATAR_PATH = "images/category_avatars";
$FILE_SIZE_LIMIT = 10240;
?>