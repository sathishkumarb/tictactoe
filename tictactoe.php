<?php
require 'scratch.php';
if (isset($_POST)) {

    print_r($_POST);

    $move = $_POST['actionId'];
    $moveOwner = $_POST['actionOwner'];
    if ($moveOwner == 1) {
        $playerA = new playerA();
        $playerA->setMove($move);
        $playerA->setPlayer($moveOwner);
        echo $matrix = $playerA->processMove();
        //print_r(explode(",",$matrix));
//    print_r($matrix);
        exit;
    }
    if ($moveOwner == 2) {
        $playerB = new playerB();
        $playerB->setMove($move);
        $playerB->setPlayer($moveOwner);
        echo $matrix = $playerB->processMove();
        //print_r(explode(",",$matrix));
//    print_r($matrix);
        exit;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        var inc = 0;
        $(document).on('click', '.move', function () {
            inc = inc +1;
            var owner = 1;
            if (inc % 2 == 1)
            {
                var owner = 1;
            }
            else
            {
                var owner = 2;
            }
            var vl = $( "#one" ).val()  + this.id;
            var v2 = $( "#two" ).val()  + this.id;
            $( "#actionId" ).val(this.id);
            $( "#actionOwner" ).val(owner);
            $( "#one" ).val(vl);
            $( "#two" ).val(vl);
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
<form id="target" method="POST" action="http://127.0.0.1/tictactoe/scratch.php">
    <table style="border:1px solid; borderollapse: collapse;">
    <tr>
        <td class="move" id="11">click</td>
        <td class="move" id="12">click</td>
        <td class="move" id="13">click</td>
    </tr>
    <tr>
        <td class="move" id="21">click</td>
        <td class="move" id="22">click</td>
        <td class="move" id="23">click</td>
    </tr>
    <tr>
        <td class="move" id="31">click</td>
        <td class="move" id="32">click</td>
        <td class="move" id="33">click</td>
    </tr>
    <input type="hidden" id="one" value="" />
    <input type="hidden" id="two" value="" />
    <input type="hidden" id="actionId" value="" />
    <input type="hidden" id="actionOwner" value="" />
</table>
</form>
</body>
</html>


