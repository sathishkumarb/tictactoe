<?php
abstract class tictactoe {
    protected $move = null;
    protected $player = null;
    protected $successmatrix = [
        1=>[11,12,13],
        2=>[21,22,23],
        3=>[31,22,23],
        4=>[11,21,31],
        5=>[12,22,32],
        6=>[13,23,33],
        7=>[11,22,33],
        8=>[13,22,31],
    ];

    protected $matrixA = "";

    protected $matrixB = "";

    protected $matrixarrayA = [

    ];

    protected $matrixarrayB = [

    ];

    protected $tempMatrix = [

    ];

    abstract function setMove($move);
    abstract function getMove();

    abstract function setPlayer($player);
    abstract function getPlayer();

}

trait players
{
    public function processMove()
    {

        if ($this->getPlayer() == 1 && $this->getMove())
        {


            if (isset($_SESSION['matrixA'])) {
                $this->matrixA = $_SESSION['matrixA'] . $this->getMove() . "A,";
            }
            else{
                $this->matrixA = $this->getMove(). "A,";
            }
            //$this->matrixA = array_push($this->matrixA, $this->getMove());

//            setCookie("matrixA", $this->matrixA, NULL, NULL, NULL, NULL, TRUE);
            //echo $this->matrixA;
            return $this->matrixA;
            //$this->tempMatrix = $this->matrixA;
        }
        if ($this->getPlayer() ==  2 && $this->getMove())
        {
            if (isset($_SESSION['matrixB'])) {
                $this->matrixB = $_SESSION['matrixB'] . $this->getMove() . "B,";
            }
            else{
                $this->matrixB = $this->getMove(). "B,";
            }
//$this->matrixB = array_push($this->matrixB, $this->getMove());

//            setCookie("matrixB", $this->matrixB, NULL, NULL, NULL, NULL, TRUE);
            //echo $this->matrixB;
            return $this->matrixB;
            //$this->tempMatrix = $this->matrixB;

        }



    }
}

class playerA extends tictactoe {
    use players;

    public function setMove($move)
    {
        $this->move = $move;
    }

    public function getMove()
    {
        return $this->move;
    }

    public function setPlayer($player)
    {
        $this->player = $player;
    }

    public function getPlayer()
    {
        return $this->player;
    }

}

class playerB extends tictactoe {
    use players;

    public function setMove($move)
    {
        $this->move = $move;
    }

    public function getMove()
    {
        return $this->move;
    }

    public function setPlayer($player)
    {
        $this->player = $player;
    }

    public function getPlayer()
    {
        return $this->player;
    }

}






