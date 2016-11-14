function getImpression(user,review,action)
{
    if(window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById(review).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","impressionsHandler.php?userID="+user+"&reviewID="+review+"&action="+action,true);
    xmlhttp.send();
}
function getImpressionFromAllReviews(user,review,action)
{
	if(window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById(review).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","impressionsHandler.php?userID="+user+"&reviewID="+review+"&action="+action+"&page=1",true);
    xmlhttp.send();
}
function getImpressionFromReviewPage(user,review,action,role)
{
	if(window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("showReviewStatistics").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","impressionsHandler.php?userID="+user+"&reviewID="+review+"&action="+action+"&page=2&role="+role,true);
    xmlhttp.send();
}
function getVote(voteValue,pollIDValue)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("questionContent").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","poll_voteHandler.php?vote="+voteValue+"&pollID="+pollIDValue,true);
xmlhttp.send();
}