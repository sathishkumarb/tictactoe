<?php
/*
 * author: sathish kumar.b
 * github: https://github.com/sathishkumarb
 * created : 27/10/2018
 */
//to start the session
if (!isset($_SESSION)) {
    session_start();
}

require 'tictactoe.php';

$move = null;
$pass = 1;
$state = 0;

//conditional check to validation move and player
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["actionId"]) && !empty($_POST["actionOwner"]))
{
    $move = $_POST['actionId'];
    $moveOwner = $_POST['actionOwner'];

    if (!isset($_SESSION['number'])) $_SESSION['number']=1;

    if ($_SESSION['number'] <=9) // no of attempts user do 9
    {
        if ($moveOwner == 1)
        {
            $playerA = new playerA();
            $playerA->setMove($move);
            $playerA->setPlayer($moveOwner);
            $matrix = $playerA->processMove();

            $state = $playerA->validateMoveState();
        }
        if ($moveOwner == 2)
        {
            $playerB = new playerB();
            $playerB->setMove($move);
            $playerB->setPlayer($moveOwner);
            $matrix = $playerB->processMove();

            $state = $playerB->validateMoveState();
        }

        $_SESSION['userCellClicks'][$_SESSION['number']]= $moveOwner ."_" .$move;
        $_SESSION['number']++;

        if ($_SESSION['number'] % 2 == 0) // differentiating the user clicks
        {
            $pass = 2;
        }
        else
        {
            $pass = 1;
        }
    }
}
// clear session cahe and post data upon reaching termianl state
if ($_SERVER["REQUEST_METHOD"] == "POST" && $state > 0 )
{
    session_destroy();
    unset($_POST);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript">
            var inc = 0;

            $( "#target" ).submit(function( event ) {
                alert( "Handler for .submit() called." );
                event.preventDefault();
            });

            $(document).on('click', '.move', function () {

                var one = $( "#one" ).val()  + this.id;
                var two = $( "#two" ).val()  + this.id;
                $( "#actionId" ).val(this.id);
                //$( "#actionOwner" ).val(owner);

                $( "#one" ).val(one);
                $( "#two" ).val(two);
                $( "#target" ).submit();

            });

            $(document).on('click', '#restart', function () {
                window.open('/tictactoe/');
            });

        </script>
        <style type="text/css">
            #wrapper{
                padding-top:150px;
                width:100%;
                text-align:center;
            }
            #center{
                display:inline-block;
                *display:inline;/* IE*/
                *zoom:1;/* IE*/
                background:yellow;
                overflow:hidden;
                text-align:left;
            }
            #flashmessage{
                display:inline-block;
                *display:inline;/* IE*/
                *zoom:1;/* IE*/
                background:yellow;
                overflow:hidden;
                text-align:center;
                font-size: x-large;
            }
            td {
                width: 100px;
                height: 100px;
                box-sizing: border-box;
                border: #0a2b1d;
                text-align: center;
                border: 1px solid black;
            }
            table {
                width: 300px;
                height: 300px;
                borderollapse: collapse;
                border: 1px solid black;
                border-spacing: 0;
            }
        </style>
        <meta charset="UTF-8">
        <title>Tic Tac Toe - Sathish</title>
    </head>
    <body>
    <?php
    if ($state)
    {
        switch ($state) {
            case 1:
                $message= "Player <b>X</b> won";
                break;
            case 2:
                $message= "Player <b>0</b> won";
                break;
            case 3:
                $message= "Game draw";
                break;
        }
        echo '<div id="flashmessage" style="background-color: #00b3ff;color: #9ae60e; height: 40px; width: 100%;">'.$message.'</div>';
    }
    else
    {
        switch ($pass) {
            case 1:
                $message= "Player <b>X</b> turn";
                break;
            case 2:
                $message= "Player <b>O</b> turn";
                break;
        }
        echo '<div id="flashmessage" style="background-color: #00b3ff;color: #144082; height: 40px; width: 100%;">' .$message.'</div>';
    }
    ?>
    <div id="wrapper">

        <div id="center">
            <form id="target" name="target" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table style="border:1px solid; border-collapse: collapse;">
                <?php
                $convertA =[];
                $convertB =[];
                if (!$state) $class = "move"; else $class ='';
                //generate row 3
                for ($outer=1; $outer<=3; $outer++)
                {
                    $clickedcellStr =str_replace(",","",$move);

                    echo '<tr>';

                    if (isset($_SESSION['matrixA']))
                    {
                        $convertA = (!empty($_SESSION['matrixA']) ? rtrim($_SESSION['matrixA'], ", ") : $convertA);
                        $convertA = explode(",", $convertA);

                    }

                    if (isset($_SESSION['matrixB']))
                    {
                        $convertB = (!empty($_SESSION['matrixB']) ? rtrim($_SESSION['matrixB'], ", ") : $convertB);
                        $convertB = explode(",", $convertB);

                    }

                    $mergedArrVar = array_flip(array_merge($convertA,$convertB));

                    //generate cells 3

                    for ($inc=1; $inc<=3;$inc++)
                    {
                        $cellString = $outer.$inc;

                        if (isset($_SESSION['userCellClicks']) && !empty($_SESSION['userCellClicks']))
                        {

                            foreach ($_SESSION['userCellClicks'] as $userClick)
                            {
                                $userClickLog = explode("_", $userClick);

                                //mtahc clicked session stored cells to block the cells

                                if ($userClickLog[1] == $cellString)
                                {
                                    if ($userClickLog[0] == 1)
                                    {
                                        $passCode = 'X';
                                        $colorString = '#6e6e6e';
                                    }
                                    else if ($userClickLog[0] == 2)
                                    {
                                        $passCode = 'O';
                                        $colorString = '#ff553c';
                                    }
                                }

                            }
                        }

                        if (array_key_exists($cellString,$mergedArrVar)) // validating and blocking out cell clicks
                        {
                            if ( $clickedcellStr == $cellString)
                            {
                                echo '<td id="' . $cellString . '" style="background-color: '.$colorString.';">' . $passCode . '</td>';
                            }
                            else
                            {
                                echo '<td id="' . $cellString . '" style="background-color: '.$colorString.';">' . $passCode . '</td>';
                            }
                        }
                        else
                        {
                            echo '<td class= '.$class.' id="' . $cellString . '" style="background-color: #f9fe2a;">click</td>';
                        }
                    }
                    echo '</tr>';
                }
                ?>
                <input type="hidden" id="one" name="one" value="" />
                <input type="hidden" id="two" name="two" value="" />
                <input type="hidden" id="actionId" name="actionId" value="" />
                <input type="hidden" id="actionOwner" name="actionOwner" value="<?=$pass?>" />
                <?php
                //refresh to start game upon terminal state
                if ($state)
                {

                    echo '<input type="button" id="restart" id="restart" value="restart" />';
                }
                ?>
            </table>
        </form>
        </div>
    </div>
    <div style="font-size: small; padding-top: 200px;">--by Sathish Kumar.b</div>
    </body>
</html>



