function CheckForUsername(user)
{
	var regex = /^[\w\u0400-\u04FF]*$/;
	var hasAlphaNumericOnly = regex.test(user);
	return hasAlphaNumericOnly;
}
function CheckForPassword(user)
{
	var regex = /^[\w\u0400-\u04FF]*$/;
	var hasAlphaNumericOnly = regex.test(user);
	return hasAlphaNumericOnly;
}
function CheckForNumbers(user)
{
	var regex = /^[0-9]*$/;
	var hasAlphaNumericOnly = regex.test(user);
	return hasAlphaNumericOnly;
}
function CheckForCitizenship(user)
{
	var regex = /^[\w\u0400-\u04FF]*$/;
	var hasAlphaNumericOnly = regex.test(user);
	return hasAlphaNumericOnly;
}
function loginvalidation()
{
	
	var sub = document.getElementById("username").value;
	var pass = document.getElementById("password").value;
	
	var hasOnlyLetters = CheckForUsername(sub);
	
	
	if (hasOnlyLetters) 
	{
		
		
		if ((sub.length >3 && sub.length < 14) &&  (pass.length > 3 && pass.length < 30))
		{
			return true;
		
		}
		else
		{
			document.getElementById("wrongpass").innerHTML = "Username or password is not valid!";
			document.getElementById("wrongpass").style.display = "block";
			return false;
		}
	}
	else
		{
			document.getElementById("wrongpass").innerHTML = "Username or password is not valid!";
			document.getElementById("wrongpass").style.display = "block";
			return false;
		}
	
	
}

function registerformvalidation()
{
	
	var username = document.getElementById("username").value;
	var pass = document.getElementById("password").value;
	var age = document.getElementById("age").value;
	var passrepete = document.getElementById("repetepassword").value;
	var citizenship = document.getElementById("citizenship").value;
	var bio = document.getElementById("bio").value;
	var email = document.getElementById("email").value;
	
	
	var username_hasOnlyLetters = CheckForUsername(username);
	var passwordcheck = CheckForPassword(pass);
	var agecheck = CheckForNumbers(age);
	var citizenshipcheck = CheckForUsername(citizenship);
	var biocheck = CheckForUsername(bio);
	
	var username_validated = true;
	var password_validated = true;
	var passrepete_validated = true;
	var age_validated = true;
	var citizenship_validated = true;
	var bio_validated = true;
	var email_validated = true;
	
	if (!username_hasOnlyLetters || !(username.length >3)  || !(username.length < 14)) 
	{
		document.getElementById('wrongusernamewarning').innerHTML = "Username must be less than 14 characters and can contain only letters, numbers, underscores and dots.";
		document.getElementById('wrongusernamewarning').style.display = 'block';
		username_validated = false;
	}
	else
	{
		document.getElementById('wrongusernamewarning').style.display = 'none';
	}
	if (!(pass.length > 3) || !(pass.length < 30))
	{
		document.getElementById('wrongpasswarning').innerHTML = "Password can't be longer than 30 characters";
		document.getElementById('wrongpasswarning').style.display = 'block';
		password_validated = false;	
	}
	else
	{
		document.getElementById('wrongpasswarning').style.display = 'none';
	}
	if(!agecheck && age.length>0)
	{
		document.getElementById("agewarning").innerHTML = "Only numbers are allowed";
		document.getElementById("agewarning").style.display = 'block';
		age_validated = false;
	}
	else
	{
		document.getElementById('agewarning').style.display = 'none';
	}
	if(!(pass == passrepete))
	{
		document.getElementById("wrongpasswarningrepete").innerHTML = "Password must match";
		document.getElementById("wrongpasswarningrepete").style.display = 'block';
		passrepete_validated = false;
	}
	else
	{
		document.getElementById('wrongpasswarningrepete').style.display = 'none';
	}
	if(!(citizenship.length < 50))
	{
		document.getElementById("citizenshipwarning").innerHTML = "Must be less than 50 characters";
		document.getElementById("citizenshipwarning").style.display = 'block';
		citizenship_validated = false;	
	}
	else
	{
		document.getElementById('citizenshipwarning').style.display = 'none';
	}
	if(!(bio.length < 500))
	{
		document.getElementById("biowarning").innerHTML = "Must be less than 500 characters";
		document.getElementById("biowarning").style.display = 'block';
		bio_validated = false;
	}
	else
	{
		document.getElementById('biowarning').style.display = 'none';
	}
	if(!(email.length > 0) || !(email.length < 255))
	{
		document.getElementById("emailwarning").innerHTML = "Must be real email adress!";
		document.getElementById("emailwarning").style.display = 'block';
		email_validated = false;
		
	}
	else
	{
		document.getElementById('emailwarning').style.display = 'none';
	}
	if (username_validated && password_validated && age_validated && passrepete_validated && citizenship_validated && bio_validated && email_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}

}

function kontaktform()
{
	var name = document.getElementById("contactFormInputName").value;
	var email = document.getElementById("contactFormInputEmail").value;
	var subject = document.getElementById("contactFormInputSubject").value;
	var message = document.getElementById("contactFormInputMessage").value;
	
	var name_validated = true;
	var email_validated = true;
	var subject_validated = true;
	var contactFormInputMessage_validated = true;
	
	if(!(name.length > 0) )
	{
		document.getElementById("wrongNameWarning").innerHTML = "You have to enter your name";
		document.getElementById('wrongNameWarning').style.display = 'block';
		name_validated = false;
		
	}
	else
	{
		document.getElementById('wrongNameWarning').style.display = 'none';
	}
	if(!(email.length > 0) )
	{
		document.getElementById("wrongEmailWarning").innerHTML = "You have to enter your email";
		document.getElementById('wrongEmailWarning').style.display = 'block';
		email_validated = false;
		
	}
	else
	{
		document.getElementById('wrongEmailWarning').style.display = 'none';
	}
	if(!(subject.length > 0) )
	{
		document.getElementById("wrongSubjectWarning").innerHTML = "You have to enter subject of email";
		document.getElementById('wrongSubjectWarning').style.display = 'block';
		subject_validated = false;
		
	}
	else
	{
		document.getElementById('wrongSubjectWarning').style.display = 'none';
	}
	if(!(message.length > 0) )
	{
		document.getElementById("wrongMessageWarning").innerHTML = "You have to enter the message";
		document.getElementById('wrongMessageWarning').style.display = 'block';
		contactFormInputMessage_validated = false;
		
	}
	else
	{
		document.getElementById('wrongMessageWarning').style.display = 'none';
	}
	if (name_validated && contactFormInputMessage_validated && subject_validated && email_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}
function komment()
{
	var komment = document.getElementById("submitCommentBody").value;
	
	var komment_validated = true;
	
	
	if(!(komment.length > 0) )
	{
		komment_validated = false;
		
	}
	
	if (komment_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}
function editprofile()
{
	
	var pass = document.getElementById("editProfilePassword").value;
	var passrepete = document.getElementById("editProfilePasswordAgain").value;
	var citizenship = document.getElementById("editProfileCitizenship").value;
	var email = document.getElementById("editProfileEmail").value;
	var bio = document.getElementById("editProfileBio").value;
	var age = document.getElementById("editProfileAge").value;
	
	var passwordcheck = CheckForPassword(pass);
	var agecheck = CheckForNumbers(age);
	var citizenshipcheck = CheckForUsername(citizenship);
	var biocheck = CheckForUsername(bio);
	
	var password_validated = true;
	var passrepete_validated = true;
	var age_validated = true;
	var citizenship_validated = true;
	var bio_validated = true;
	var email_validated = true;
	
	if (pass.length>0 && (!(pass.length > 3) || !(pass.length < 30)))
	{
		document.getElementById('wrongPasswordWarning').innerHTML = "Password can be between 3 and 20 characters";
		document.getElementById('wrongPasswordWarning').style.display = 'block';
		password_validated = false;	
	}
	else
	{
		document.getElementById('wrongPasswordWarning').style.display = 'none';
	}
	if(!(pass == passrepete))
	{
		document.getElementById("wrongPasswordAgainWarning").innerHTML = "Password must match";
		document.getElementById("wrongPasswordAgainWarning").style.display = 'block';
		passrepete_validated = false;
	}
	else
	{
		document.getElementById('wrongPasswordAgainWarning').style.display = 'none';
	}
	if(!(citizenship.length < 50))
	{
		document.getElementById("wrongCitizenshipWarning").innerHTML = "Must be less than 50 characters";
		document.getElementById("wrongCitizenshipWarning").style.display = 'block';
		citizenship_validated = false;	
	}
	else
	{
		document.getElementById('wrongCitizenshipWarning').style.display = 'none';
	}
	if(!(bio.length < 500))
	{
		document.getElementById("wrongBioWarning").innerHTML = "Must be less than 500 characters";
		document.getElementById("wrongBioWarning").style.display = 'block';
		bio_validated = false;
	}
	else
	{
		document.getElementById('wrongBioWarning').style.display = 'none';
	}
	if(!agecheck && age.length>0)
	{
		document.getElementById("wrongAgeWarning").innerHTML = "Age can contain only numbers";
		document.getElementById("wrongAgeWarning").style.display = 'block';
		age_validated = false;
	}
	else
	{
		document.getElementById('wrongAgeWarning').style.display = 'none';
	}
	if(!(age < 100))
	{
		document.getElementById("wrongAgeWarning").innerHTML = "Please enter your real age";
		document.getElementById("wrongAgeWarning").style.display = 'block';
		age_validated = false;
	}
	else
	{
		document.getElementById('wrongAgeWarning').style.display = 'none';
	}
	if (!(email.length > 0) || !(email.length < 255))
	{
		document.getElementById("wrongEmailWarning").innerHTML = "Please enter real email";
		document.getElementById("wrongEmailWarning").style.display = 'block';
		email_validated = false;
	}
	else
	{
		document.getElementById('wrongEmailWarning').style.display = 'none';
	}
	if (password_validated && age_validated && passrepete_validated && citizenship_validated && bio_validated && email_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}

}
function messages()
{
	var message = document.getElementById("sendMessageText").value;
	
	var message_validated = true;
	
	
	if(!(message.length > 0) )
	{
		message_validated = false;
		
	}
	
	if (message_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}
function addreview()
{
	var name = document.getElementById("addReviewNameInput").value;
	var body = document.getElementById("addReviewBodyInput").value;
	
	var name_validated = true;
	var body_validated = true;
	
	
	if(!(name.length > 4) || !(name.length <84))
	{
		document.getElementById("wrongNameWarning").innerHTML = "Name length can be between 4 and 84 characters";
		document.getElementById("wrongNameWarning").style.display = 'block';
		name_validated = false;
	}
	else
	{
		document.getElementById("wrongNameWarning").innerHTML = "Required field";
	}
	if(!(body.length > 200) || !(body.length < 10000))
	{
		document.getElementById("wrongTextWarning").innerHTML = "Text length can be between 200 and 10000 characters";
		document.getElementById("wrongTextWarning").style.display = 'block';
		body_validated = false;
	}
	else
	{
		document.getElementById("wrongTextWarning").innerHTML = "Required field";
	}
	if (name_validated && body_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}
function letterofcommittee()
{
	
	var body = document.getElementById("addReviewBodyInput").value;
	
	
	var body_validated = true;
	
	if(!(body.length > 50) || !(body.length < 10000))
	{
		document.getElementById("wrongTextWarning").innerHTML = "Text length can be between 50 and 10000 characters";
		document.getElementById("wrongTextWarning").style.display = 'block';
		body_validated = false;
	}
	else
	{
		document.getElementById("wrongTextWarning").innerHTML = "Required field";
	}
	if (body_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}
function forgotemail()
{
	var email = document.getElementById("addReviewNameInput").value;
	
	var email_validated = true;
	
	
	if(!(email.length > 0) )
	{
		document.getElementById("wrongEmailWarning").innerHTML = "You have to enter you email adress";
		document.getElementById("wrongEmailWarning").style.display = 'block';
		email_validated = false;
		
	}
	else
	{
		document.getElementById("wrongEmailWarning").innerHTML = "Required field";
	}
	if (email_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function addcategory()
{
	
	var name = document.getElementById("addReviewNameInput").value;
	
	var name_validated = true;
	
	
	if(!(name.length > 4) || !(name.length < 37))
	{
		document.getElementById("wrongNameWarning").innerHTML = "Name length can be between 4 and 37 characters";
		document.getElementById("wrongNameWarning").style.display = 'block';
		name_validated = false;
		
	}
	else
	{
		document.getElementById("wrongNameWarning").innerHTML = "Required field";
	}
	if (name_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}
function questionoftheday()
{
	
	var question = document.getElementById("addQuestionText").value;
	var answer1 = document.getElementById("addAnswer1").value;
	var answer2 = document.getElementById("addAnswer2").value;
	var answer3 = document.getElementById("addAnswer3").value;
	var answer4 = document.getElementById("addAnswer4").value;
	
	var question_validated = true;
	var answer1_validated = true;
	var answer2_validated = true;
	var answer3_validated = true;
	var answer4_validated = true;
	
	if (!(question.length > 4) || !(question.length < 100))
	{
		document.getElementById('wrongQuestionText').innerHTML = "Question can be between 4 and 37 characters";
		document.getElementById('wrongQuestionText').style.display = 'block';
		question_validated = false;	
	}
	else
	{
		document.getElementById('wrongQuestionText').innerHTML = "Required field";
	}
	if(!(answer1.length > 5) || !(answer1.length < 50))
	{
		document.getElementById("wrongAnswer1").innerHTML = "Answer can be between 5 and 50 characters";
		document.getElementById("wrongAnswer1").style.display = 'block';
		answer1_validated = false;
	}
	else
	{
		document.getElementById('wrongAnswer1').innerHTML = "Required field";
	}
	if(!(answer2.length > 5) || !(answer2.length < 50))
	{
		document.getElementById("wrongAnswer2").innerHTML = "Answer can be between 5 and 50 characters";
		document.getElementById("wrongAnswer2").style.display = 'block';
		answer2_validated = false;
	}
	else
	{
		document.getElementById('wrongAnswer2').innerHTML = "Required field";
	}
	if(answer3.length>0 && (!(answer3.length > 5) || !(answer3.length < 50)))
	{
		document.getElementById("wrongAnswer3").innerHTML = "Answer can be between 5 and 50 characters";
		document.getElementById("wrongAnswer3").style.display = 'block';
		answer3_validated = false;
	}
	else
	{
		document.getElementById('wrongAnswer3').innerHTML = "Optional field";
	}
	if(answer4.length>0 && (!(answer4.length > 5) || !(answer4.length < 50)))
	{
		document.getElementById("wrongAnswer4").innerHTML = "Answer can be between 5 and 50 characters";
		document.getElementById("wrongAnswer4").style.display = 'block';
		answer4_validated = false;
	}
	else
	{
		document.getElementById('wrongAnswer4').innerHTML = "Optional field";
	}
	if (question_validated && answer1_validated && answer2_validated && answer3_validated && answer4_validated)
	{
		return true;	
	}
	else
	{
		return false;	
	}

}


