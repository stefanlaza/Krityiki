<?php
require_once('DatabaseQueries.php');
require_once('Login.php');

$vote = $_REQUEST['vote'];
$id_of_poll = $_REQUEST['pollID'];
$con = connect();
$flag = RememberTheAnswer($con,$_SESSION['id'],$id_of_poll,$vote);
$poll = ReturnPoll($con,$id_of_poll);

if ($flag == $ANSWER_SAVED)
{
    $results = GetResultsInPercents($con,$id_of_poll);
//    for($i=0; $i < count($results); $i++)
//    {
//        echo $poll[$i+3].":".$results[$i];
//        echo "<br />";
//    }
    
    echo "<p>".$poll[1]."</p>";
            $numberOfAnswers = $poll[2];
            if ($numberOfAnswers == 2)
            {
             echo"
                    <div id='leftColumnAnswers'>
                        <div class='answer'>
                            <input name='vote' id='radio1' type='radio' disabled/><label for='radio1'>".$poll[3].":".$poll[8]."%</label>
                        </div>
                        <div class='answer' style='padding-top:15px'>
                            <input name='vote' id='radio2' type='radio' disabled/><label for='radio2'>".$poll[4].":".$poll[9]."%</label>
                        </div>
                    </div>";
            }
            else if ($numberOfAnswers == 3)
            {
                echo"
                    <div id='leftColumnAnswers'>
                        <div class='answer'>
                            <input name='vote' id='radio1' type='radio' disabled/><label for='radio1'>".$poll[3].":".$poll[8]."%</label>
                        </div>
                        <div class='answer' style='padding-top:15px'>
                            <input name='vote' id='radio2' type='radio' disabled/><label for='radio2'>".$poll[4].":".$poll[9]."%</label>
                        </div>
                    </div>";
                echo "<div id='rightColumnAnswers'>" ;
                echo "
                        <div class='answer'>
                            <input name='vote' id='radio3' type='radio' disabled/><label for='radio3'>".$poll[5].":".$poll[10]."%</label>
                        </div>  
                        </div>
                        ";
            }
            else if ($numberOfAnswers == 4)
            {
                echo"
                  <div id='leftColumnAnswers'>
                      <div class='answer'>
                          <input name='vote' id='radio1' type='radio' disabled/><label for='radio1'>".$poll[3].":".$poll[8]."%</label>
                      </div>
                      <div class='answer' style='padding-top:15px'>
                          <input name='vote' id='radio2' type='radio' disabled/><label for='radio2'>".$poll[4].":".$poll[9]."%</label>
                      </div>
                  </div>";
                echo "<div id='rightColumnAnswers'>" ;
                echo "
                        <div class='answer'>
                            <input name='vote' id='radio3' type='radio' disabled/><label for='radio3'>".$poll[5].":".$poll[10]."%</label>
                        </div>  
                        
                        ";
                echo "
                        <div class='answer' style='padding-top:15px'>
                            <input name='vote' id='radio4' type='radio' disabled/><label for='radio4'>".$poll[6].":".$poll[11]."%</label>
                        </div>
                        </div>"
                    ;
                
            }
}
else
{
    echo "Sorry, there was an error submiting your vote";
}
$con = null;
?>
