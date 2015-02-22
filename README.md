# Greedy-Algorithm
Calculates the leased coins in total amount provided 

## Summary
- A simple web application that, when given a monetary amount, will calculate the minimum number of coins needed to make that amount using a greedy algorithm.

- The coins consist of the sterling pound and account for the common Sterling currency including £2, £1, 50p, 20p, 10p, 5p, 2p and 1p coins. (Note: that more coins can be added via the $coins Array within the amount function)

- The implementation of the code is written in PHP and has supporting HTML5/CSS2 files.
- The user interface consists of an input that accepts an 'amount' string and displays the denominations needed when the user hits 'enter'.
- Validation rules handle invalid inputs gracefully.

## Example

- 123p = 1 x £1, 1 x 20p, 1 x 2p, 1 x 1p
- £12.34 = 6 x £2, 1 x 20p, 1 x 10p, 2 x 2p

## Requirements

-Server should be running PHP5 or Greater.

## If I had more time
- Update the UI using SASS
- Provide test cases for the code using TDD methods.
- Strenghten the Validation Rules more
- Optimise the PHP Code

## Other notes
