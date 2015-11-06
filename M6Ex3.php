<?php
// Solution to M6Ex3
/**
 * Construct an array representing a standard 52 card deck
 *
 * @return array An array representing a 52 card deck
 */
function getCardDeck() {

	$deck = array();
	
	for($suit_idx = 0; $suit_idx < 4; $suit_idx++) {
		
		switch($suit_idx) {
			case 0:
				$suit = 'C';
				break;
			case 1:
				$suit = 'S';
				break;
			case 2:
				$suit = 'D';
				break;
			case 3:
				$suit = 'H';
				break;
		}
		
		for($card_idx = 1; $card_idx <= 13; $card_idx++) {
			
			if(($card_idx <= 10) && ($card_idx > 1)) {
				$deck[$suit][$card_idx] = $card_idx;
			} else {
				switch($card_idx) {
					case 1:
						$deck[$suit][$card_idx] = 'A';
						break;
					case 11:
						$deck[$suit][$card_idx] = 'J';
						break;
					case 12:
						$deck[$suit][$card_idx] = 'Q';
						break;
					case 13:
						$deck[$suit][$card_idx] = 'K';
						break; 
				}
			}
		}
	}
	
	return $deck;
}
