<?php


include 'src/Tictactoe.php';

$game = new Tictactoe();
$data = readline("Enter the coordinate:[1-9]");
$game->playGame('move', $data);
