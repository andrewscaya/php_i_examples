<?php
/**
 * Construct an array representing a standard 52 card deck
 * @return array $deck = 2 dimensional array representing a 52 card deck
 */
function getCardDeck() {
	$deck = array();
	// Add some code to represents the suites as 
	// 'C' for 'Clubs', 'S' for 'Spades', etc. 	
	for($suit_idx = 0; $suit_idx < 4; $suit_idx++) {
		$suit = ''; // ???
		// Add some code to represent the Ace as 'A',
		// Jack as 'J', etc.
		// Consider using an inner loop {
			$deck[$suit][$inner_index] = ''; // ???
		// }
	}
	return $deck;
}
