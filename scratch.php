<?php
/*
 * author:sathish kumar.b
 * github:https://github.com/sathishkumarb
 */
abstract class tictactoe
{
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

            if (isset($_SESSION['matrixA']))
            {
                $convertA = (!empty($_SESSION['matrixA']) ? $_SESSION['matrixA'] : []);
                $convertA = explode(",", $convertA);
                $convertA = array_flip($convertA);
                if (!in_array($this->getMove(), $convertA))
                    $_SESSION['matrixA'] = $_SESSION['matrixA'] . $this->getMove() . ",";
            }
            else
            {
                $_SESSION['matrixA'] = $this->getMove() . ",";
            }
            $this->matrixA = $_SESSION['matrixA'];
            return $this->matrixA;
            //$this->tempMatrix = $this->matrixA;
        }
        if ($this->getPlayer() == 2 && $this->getMove())
        {
            if (isset($_SESSION['matrixB']))
            {
                $convertB = (!empty($_SESSION['matrixB']) ? $_SESSION['matrixB'] : []);
                $convertB = explode(",", $convertB);
                $convertB = array_flip($convertB);
                if (!in_array($this->getMove(), $convertB)) {
                    $_SESSION['matrixB'] = $_SESSION['matrixB'] . $this->getMove() . ",";
                }
            }
            else
            {
                $_SESSION['matrixB'] = $this->getMove() . ",";
            }
            $this->matrixB = $_SESSION['matrixB'];
            return $this->matrixB;
            //$this->tempMatrix = $this->matrixB;

        }

    }

}

class playerA extends tictactoe
{
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

class playerB extends tictactoe
{
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








