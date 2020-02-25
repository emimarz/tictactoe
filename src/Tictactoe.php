<?php


class Tictactoe
{
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

		//TODO: refactor winner checking in a separate method
		if ($this->isOver() != "Tie")
			echo "Congratulations player " . $this->isOver() . ", you've won the game!".PHP_EOL;
		else if ($this->isOver() == "Tie")
			echo "Whoops! Looks like you've had a tie game. Want to try again?".PHP_EOL;
	}


	public function move($data)
	{

		if ($this->isOver())
			return;

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

		//top row
		if ($this->board[0][0] != ' ' && $this->board[0][0] == $this->board[0][1] && $this->board[0][1] == $this->board[0][2])
			return $this->board[0][0];

		//middle row
		if ($this->board[1][0] != ' ' && $this->board[1][0] == $this->board[1][1] && $this->board[1][1] == $this->board[1][2])
			return $this->board[1][0];

		//bottom row
		if ($this->board[2][0] != ' ' && $this->board[2][0] == $this->board[2][1] && $this->board[2][1] == $this->board[2][2])
			return $this->board[2][0];

		//first column
		if ($this->board[0][0] != ' ' && $this->board[0][0] == $this->board[1][0] && $this->board[1][0] == $this->board[2][0])
			return $this->board[0][0];

		//second column
		if ($this->board[0][1] != ' ' && $this->board[0][1] == $this->board[1][1] && $this->board[1][1] == $this->board[2][1])
			return $this->board[0][1];

		//third column
		if ($this->board[0][2] != ' ' && $this->board[0][2] == $this->board[1][2] && $this->board[1][2] == $this->board[2][2])
			return $this->board[0][2];

		//diagonal 1
		if ($this->board[0][0] != ' ' && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2])
			return $this->board[0][0];

		//diagonal 2
		if ($this->board[0][2] != ' ' && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0])
			return $this->board[0][2];

		if ($this->totalMoves >= 9)
			return "Tie";
	}

	private function convertDataToCoordinates($data)
	{
		switch ($data) {
		    case 1:
		        return [0,0];
		        break;
			case 2:
				return [0,1];
		        break;
			case 3:
				return [0,2];
		        break;
			case 4:
				return [1,0];
		        break;
			case 5:
				return [1,1];
		        break;
			case 6:
				return [1,2];
		        break;
			case 7:
				return [2,0];
		        break;
			case 8:
				return [2,1];
		        break;
			case 9:
				return [2,2];
		        break;
		}
	}
}