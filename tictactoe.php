<?php
session_start();
require 'scratch.php';
print_r($_POST);
$move = null;
$pass = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["actionId"]) && !empty($_POST["actionOwner"]))
{
    $move = $_POST['actionId'];
    $moveOwner = $_POST['actionOwner'];

    if (!$_SESSION['number']) $_SESSION['number']=1;

    if ($_SESSION['number'] <=9) // no of attempts user do 9
    {
        if ($moveOwner == 1)
        {
            $playerA = new playerA();
            $playerA->setMove($move);
            $playerA->setPlayer($moveOwner);
            echo $matrix = $playerA->processMove();
        }
        if ($moveOwner == 2)
        {
            $playerB = new playerB();
            $playerB->setMove($move);
            $playerB->setPlayer($moveOwner);
            echo $matrix = $playerB->processMove();
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
print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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

        </script>
        <style type="text/css">
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
        <title>Tic Tac Toe</title>
    </head>
    <body>
        <form id="target" name="target" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table style="border:1px solid; borderollapse: collapse;">
                <?php
                $convertA =[];
                $convertB =[];
                for ($outer=1; $outer<=3; $outer++)
                {
                    $clickedcellStr =str_replace(",","",$move);

                    echo '<tr>';

                    if (isset($_SESSION['matrixA']))
                    {
                        $convertA = (!empty($_SESSION['matrixA']) ? rtrim($_SESSION['matrixA'], ", ") : $convertA);
                        $convertA = explode(",", $convertA);
                        if (count($convertA) > 0)
                        {
                            print_r($convertA);
                        }
                    }

                    if (isset($_SESSION['matrixB']))
                    {
                        $convertB = (!empty($_SESSION['matrixB']) ? rtrim($_SESSION['matrixB'], ", ") : $convertB);
                        $convertB = explode(",", $convertB);
                        if (count($convertB) > 0)
                        {
                            print_r($convertB);
                        }
                    }

                    $mergedArrVar = array_flip(array_merge($convertA,$convertB));

                    for ($inc=1; $inc<=3;$inc++)
                    {
                        $cellString = $outer.$inc;

                        if (isset($_SESSION['userCellClicks']) && !empty($_SESSION['userCellClicks']))
                        {

                            foreach ($_SESSION['userCellClicks'] as $userClick)
                            {
                                $userClickLog = explode("_", $userClick);

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
                            echo '<td class= "move" id="' . $cellString . '" style="background-color: #f9fe2a;">click</td>';
                        }
                    }
                    echo '</tr>';
                }
                ?>
                <input type="hidden" id="one" name="one" value="" />
                <input type="hidden" id="two" name="two" value="" />
                <input type="text" id="actionId" name="actionId" value="" />
                <input type="text" id="actionOwner" name="actionOwner" value="<?=$pass?>" />
            </table>
        </form>
    </body>
</html>



