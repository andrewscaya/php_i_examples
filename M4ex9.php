<?php
// from Andrew:

$cardList = array(
		'red'    => array(1, 2, 3, 4),
		'blue'   => array(1, 2, 3, 4),
		'green'  => array(1, 2, 3, 4),
		'yellow' => array(1, 2, 3, 4)
);
foreach ($cardList as $card) {
	shuffle($card);
	echo $card[0] + $card[1];
	echo PHP_EOL;
	echo $card[2] + $card[3];
	echo PHP_EOL;
}

// from Mike:
echo "\n--------------------------------\n";

$cards = array ('red','blue','green','yellow',
		'red','blue','green','yellow',
		'red','blue','green','yellow',
		'red','blue','green','yellow');
// shuffle the deck
shuffle($cards);
// var_dump($cards);
$sum = 0;
foreach($cards as $key => $color) {
	// figure out number of card based on key
	$number = $key % 4 + 1;
	// show this card
	echo $color . ' ' . $number . PHP_EOL;
	// add to sum and display if prior sum was not nil
	if($sum != 0) {
		$sum = $sum + $number;
		echo 'Sum of the last two cards is ' . $sum . PHP_EOL;
		// reset $sum to nil
		$sum = 0;
	}
	else {
		$sum = $sum + $number;
	}
}

