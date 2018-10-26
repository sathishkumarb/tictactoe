<?php
abstract class tictactoe {
    protected $moves = null;
    abstract function setMove();
    abstract function getMove();
    public function processMove($moves){

    }

}

trait players
{
    public function processMove($moves){

    }
}

class playerA extends tictactoe {
    use players;

    public function setMove()
    {

    }

    public function getMove()
    {

    }

}

class playerB extends tictactoe {
    use players;

    public function setMove()
    {

    }

    public function getMove()
    {

    }

}

$moves = $_POST['actionId'];
$moveOwner = $_POST['actionOwner'];
if ($moveOwner ==1) {
    $playerA = new playerA();
    $playerA->setMove($moves);
    $playerA->processMove($moves);
}
else {

    $playerB = new playerB();
    $playerB->setMove($moves);
    $playerB->processMove($moves);
}

