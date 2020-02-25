<?php


class Tictactoe
{
    const WIDTH = 3;
    const HEIGHT = 3;
	var $player = "X";            //whose turn is
	var $board = array();        //the tic tac toe board
	var $totalMoves = 0;        //how many moves have been made so far

	public function __construct()
	{

		//we start with player X
		$this->player = "X";

		//we start with 0 moves
		$this->totalMoves = 0;

		$this->board = [[' ',' ',' '],[' ',' ',' '],[' ',' ',' ']];
	}

	function playGame($action,$data)
	{

		switch ($action) {
		    case 'move':
		    	if (!$this->isOver()){
				    $this->move($data);
			    }

		        break;

			case 'new_game':
				$this->newGame();


		}
		//display the game
		$this->displayGame();
		if (!$this->isOver()){
			$data = readline('Enter the coordinate:[1-9]');
			$this->playGame('move', $data);
		} else {
			exit;
		}

	}

	/**
	 * Purpose: display the game interface
	 * Preconditions: none
	 * Postconditions: start a game or keep playing the current game
	 **/
	function displayGame()
	{


		for ($x = 0; $x < 3; $x++)
		{
			echo '|---|---|---|'.PHP_EOL;
			echo '|';
			for ($y = 0; $y < 3; $y++)
			{
				echo " ".$this->board[$x][$y]." ";
				echo '|';
			}
			echo PHP_EOL;


		}
		echo '|---|---|---|'.PHP_EOL;
		echo "It's player {$this->player}'s turn.".PHP_EOL;
		echo "Type 1 to 9 to place the chip on the board.".PHP_EOL;

		$result = $this->isOver();

		if($result!==false){
            if ($result === "Tie"){
                echo "Whoops! Looks like you've had a tie game. Want to try again?".PHP_EOL;
            } else {
                echo "Congratulations player " . $result . ", you've won the game!".PHP_EOL;
            }
        }
	}


	public function move($data)
	{

		$data = $this->convertDataToCoordinates($data);

		//update the board in that position with the player's X or O
		$this->board[$data[0]][$data[1]] = $this->player;

		//change the turn to the next player
		if ($this->player == "X")
			$this->player = "O";
		else
			$this->player = "X";

		$this->totalMoves++;

	}


	public function isOver()
	{
	    $col = 0;
	    $row = 0;
	    $found = false;
	    while (!$found && $row < self::HEIGHT) {
            if($this->checkRow($row)) {
                $found = $this->board[$row][0];
            }
            $row++;
        }

        while (!$found && $col < self::WIDTH) {
            if($this->checkColumn($col)) {
                $found = $this->board[0][$col];
            }
            $col++;
        }

        if (!$found){
            $found = $this->checkDiagonalRight();
            if ($found!==false) {
                $found = $this->board[0][0];
            }
        }

        if(!$found){
            $found = $this->checkDiagonalLeft();
            if ($found!==false) {
                $found = $this->board[0][self::WIDTH-1];
            }
        }

        if ($this->totalMoves >= 9) {
            $found = "Tie";
        }

        return $found;
	}

	private function isCellEmpty($x, $y) {
	    return $this->board[$x][$y] == ' ';
    }

	private function checkRow($row) {
	    $col = 1;
	    $return = !$this->isCellEmpty($row, $col-1);
	    while(($col < self::WIDTH) && $return) {
            $return = ($this->board[$row][$col-1] == $this->board[$row][$col]);
            $col++;
        }
	    return $return;
    }

    private function checkColumn($col) {
        $row = 1;
        $return = !$this->isCellEmpty($row-1, $col);
        while(($row < self::HEIGHT) && $return) {
            $return = ($this->board[$row-1][$col] == $this->board[$row][$col]);
            $row++;
        }
        return $return;
    }

    private function checkDiagonalRight() {
        $row = 1;
        $col = 1;
        $return = !$this->isCellEmpty(0, 0);
        while(($row < self::HEIGHT) && $return) {
            $return = ($this->board[$row-1][$col-1] == $this->board[$row][$col]);
            $row++;
            $col++;
        }
        return $return;
    }

    private function checkDiagonalLeft() {
        $row = 1;
        $col = self::WIDTH - 1;
        $return = !$this->isCellEmpty($row-1, $col);
        while(($row < self::HEIGHT) && $return) {
            $return = ($this->board[$row-1][$col] == $this->board[$row][$col-1]);
            $row++;
            $col--;
        }
        return $return;
    }

    public function convertDataToCoordinates($data)
	{
	    return [
            intdiv($data - 1, self::WIDTH),
            ($data - 1) % self::WIDTH
        ];
	}
}