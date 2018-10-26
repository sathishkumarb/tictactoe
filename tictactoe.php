<?php
session_start();
require 'scratch.php';
print_r($_POST);
$move = null;
$pass = 1;


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["actionId"]) && !empty($_POST["actionOwner"])) {

    $move = $_POST['actionId'];
    $moveOwner = $_POST['actionOwner'];
    if (!$_SESSION['number'])
        $_SESSION['number']=1;

    if ($_SESSION['number'] <=6) {
        if ($moveOwner == 1) {
            $playerA = new playerA();
            $playerA->setMove($move);
            $playerA->setPlayer($moveOwner);
            echo $matrix = $playerA->processMove();

        }
        if ($moveOwner == 2) {
            $playerB = new playerB();
            $playerB->setMove($move);
            $playerB->setPlayer($moveOwner);
            echo $matrix = $playerB->processMove();

        }
        $_SESSION['countClick'][$_SESSION['number']]= $moveOwner ."_" .$move;
        $_SESSION['number']++;


        if ($_SESSION['number'] % 2 == 0) {
            $pass = 2;
            $passCode = 'X';
        } else {
            $pass = 1;
            $passCode = 'O';
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
    <style>
        td{
            width: 100px;
            height: 100px;
            box-sizing: border-box;
            border: #0a2b1d;
            text-align: center;
            border: 1px solid black;
        }
        table{
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
        $convertA=[];
        $convertB=[];
        for ($outer=1; $outer<=3;$outer++)
        {
            $str =str_replace(",","",$move);

            echo '<tr>';

            $convertA = (!empty($_SESSION['matrixA']) ?$_SESSION['matrixA'] : $convertA);
            if (count($convertA)) {
                $convertA = explode(",", $convertA);
//                $convertA = array_flip($convertA);
                print_r($convertA);
            }

            $convertB = (!empty($_SESSION['matrixB']) ? $_SESSION['matrixB'] : $convertB);
            if (count($convertB)) {

                $convertB = explode(",", $convertB);
//                $convertB = array_flip($convertB);
                print_r($convertB);
            }

            $eA= array_flip(array_merge($convertA,$convertB));

            for ($inc=1; $inc<=3;$inc++)
            {
                $str2 = $outer.$inc;

                if (array_key_exists($str2,$eA))
                {

                    echo 'coming';
                    if ( $str == $str2)
                    {
                        echo '<td id="' . $str2 . '" style="background-color: red;">' . $passCode . '</td>';
                    }
                    else{
                        echo '<td id="' . $str2 . '" style="background-color: grey;">' . $passCode . '</td>';
                    }
                }
                else
                {
                    echo '<td class= "move" id="' . $str2 . '" style="background-color: green;">click</td>';
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



