<?php

use PHPUnit\Framework\TestCase;

include 'src/Tictactoe.php';

class TicTacToeTest extends TestCase
{
    public function testConvertData()
    {
        $game = new Tictactoe();
        $this->assertEquals([0,0], $game->convertDataToCoordinates(1));
        $this->assertEquals([0,1], $game->convertDataToCoordinates(2));
        $this->assertEquals([0,2], $game->convertDataToCoordinates(3));
        $this->assertEquals([1,0], $game->convertDataToCoordinates(4));
        $this->assertEquals([1,1], $game->convertDataToCoordinates(5));
        $this->assertEquals([1,2], $game->convertDataToCoordinates(6));
        $this->assertEquals([2,0], $game->convertDataToCoordinates(7));
        $this->assertEquals([2,1], $game->convertDataToCoordinates(8));
        $this->assertEquals([2,2], $game->convertDataToCoordinates(9));
    }

    public function testIsOverNotFinish()
    {
        $game = new Tictactoe();
        $game->board = [
            [' ',' ',' '],
            [' ',' ',' '],
            [' ',' ',' ']
        ];
        $this->assertEquals(false, $game->isOver(), 'incomplete games');
        $game->board = [
            ['X',' ',' '],
            [' ','O',' '],
            [' ',' ',' ']
        ];
        $this->assertEquals(false, $game->isOver(), 'incomplete games');
    }

    public function testIsOverWinRow()
    {
        $game = new Tictactoe();
        $game->board = [
            ['X','X','X'],
            [' ','O','O'],
            [' ',' ',' ']
        ];
        $this->assertEquals('X', $game->isOver(), 'O win top row');
        $game->board = [
            ['O','O','O'],
            [' ','X','X'],
            [' ',' ',' ']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win top row');
        $game->board = [
            ['X','X',' '],
            ['O','O','O'],
            [' ',' ','X']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win mid row');
        $game->board = [
            ['O','O',' '],
            ['X','X','X'],
            [' ',' ','O']
        ];
        $this->assertEquals('X', $game->isOver(), 'X win mid row');
        $game->board = [
            [' ',' ',' '],
            [' ','O','O'],
            ['X','X','X'],
        ];
        $this->assertEquals('X', $game->isOver(), 'X win bottom row');
        $game->board = [
            ['X','X',' '],
            [' ',' ','X'],
            ['O','O','O'],
        ];
        $this->assertEquals('O', $game->isOver(), 'O win bottom row');
    }

    public function testIsOverWinCol()
    {
        $game = new Tictactoe();
        $game->board = [
            ['X',' ',' '],
            ['X','O','O'],
            ['X',' ',' ']
        ];
        $this->assertEquals('X', $game->isOver(), 'X win left col');
        $game->board = [
            ['O','X',' '],
            ['O','X','O'],
            ['O',' ','X']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win left col');
        $game->board = [
            [' ','X',' '],
            ['O','X','O'],
            [' ','X',' ']
        ];
        $this->assertEquals('X', $game->isOver(), 'X win mid col');
        $game->board = [
            ['X','O',' '],
            [' ','O','O'],
            ['X','O','X']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win mid col');
        $game->board = [
            [' ',' ','X'],
            ['O','O','X'],
            [' ',' ','X']
        ];
        $this->assertEquals('X', $game->isOver(), 'X win right col');
        $game->board = [
            ['X',' ','O'],
            [' ','X','O'],
            ['X',' ','O']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win right col');
    }


    public function testIsOverWinDiagRight()
    {
        $game = new Tictactoe();
        $game->board = [
            ['X',' ',' '],
            ['O','X','O'],
            [' ',' ','X']
        ];
        $this->assertEquals('X', $game->isOver(), 'X win right diagonal');
        $game->board = [
            ['O','X',' '],
            ['X','O','X'],
            [' ',' ','O']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win right diagonal');
    }

    public function testIsOverWinDiagLeft()
    {
        $game = new Tictactoe();
        $game->board = [
            [' ',' ','X'],
            ['O','X','O'],
            ['X',' ',' ']
        ];
        $this->assertEquals('X', $game->isOver(), 'X win left diagonal');
        $game->board = [
            [' ','X','O'],
            ['X','O','X'],
            ['O',' ',' ']
        ];
        $this->assertEquals('O', $game->isOver(), 'O win left diagonal');
    }

    public function testTieGame()
    {
        $game = new Tictactoe();
        $game->totalMoves=9;
        $this->assertEquals('Tie', $game->isOver(), 'Tie game');
    }
}
