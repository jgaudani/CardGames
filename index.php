<?php

require_once 'AutoLoader.php';

//create playing card deck
$deck = new PlayingCardDeck();
$deck->shuffle();

//create dealer and players
$dealer = new BlackJackPlayer('Dealer','99999');
$player1 = new BlackJackPlayer('User1','500');
$player2 = new BlackJackPlayer('User2','300');
$player3 = new BlackJackPlayer('User3','400');

//prepare bets for players
$player1->setBet(25);
$player2->setBet(25);
$player3->setBet(25);

//create or fetch blackjack game
$blackJackGame = BlackJackGame::getInstance($deck);
if ($blackJackGame->isRunning() === false)
{
    //add dealer, players to the game
    $blackJackGame->addDealer($dealer);
    $blackJackGame->addPlayer($player1);
    $blackJackGame->addPlayer($player2);
    $blackJackGame->addPlayer($player3);
}

//start blackjack game
$blackJackGame->start();
//do second round of cards in game
$blackJackGame->next();
//end game and review all the players and compare with dealer
$blackJackGame->end();

//for printing the results
$playersAndDealer = array_merge(array($blackJackGame->getDealer()), $blackJackGame->getPlayers());
foreach ($playersAndDealer as $player)
{
    echo "<br>********************<br>";
    echo $player;
    if ($player->isWinner()) echo  "-<b>Winner</b>"; 
    foreach ($player->getCards() as $card)
    {
        echo $card . "<br>";
    }
    echo $player->getBalance();
}

