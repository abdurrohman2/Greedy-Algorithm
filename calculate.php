<?php
/* echo "From Server".json_encode($_POST)."<br>"; */
$input = $_POST["money"];
$user = new change();	//Create query object 

/* run if value not null */
	if(preg_match_all("/\xA3?\d{1,3}?([,]\d{3}|\d)*?([.]\d{1,2})?$/", $input, $output_array) == false){
			echo "<b>Please input your Amount Correctly</b>";
		}
	else{
			$input1 = $user->clean_number($input);  //Clean Input
			if($input1 == null){
				echo "<b>Please provide + Amount</b>";
			}else{
				$co1 = number_format(($input1/100),2);
				echo "<h3>Change for £".$co1."</h3><table><thead><tr><th>Coins<th >(X)Amount <th>Remaining<tbody>";
				$user->amount($input1);	//call function Amount
			}
		}

class change{
	
	public function clean_number($input) {
		/* Test for . and £ workout pennies */
			if(strpos($input, '.') !== false){
				if(strpos($input, '£') !== false){
					$input = preg_replace('/[£]/','',$input);
					list($x, $z) = sscanf($input, '%d.%d');
					$input = ($x*100)+$z;
				}else{
					list($y, $b) = sscanf($input, '%d.%d');
					$input = ($y*100)+$b;
				}
			}
		elseif(strpos($input, '£') !== false){
			$input = preg_replace('/[^0-9]/','',$input);
			$input = $input*100;
		}
		return $input;
	}

	public function amount($input) {
		/* Using a Greedy Algorithm to workout change from coins available.*/

		$coins = array(200,100,50,20,10,5,2,1); /* Coins Available Highest first in pennies*/
		$n = count($coins);
		$loop = 0;

		while ($n--) {
				/* workout */
				$answer[$n] = $input/$coins[$n];		

				/* split */
				list($w, $d) = sscanf($answer[$n], '%d.%d'); 	
				$answer[$n] = $w;
				$remainder[$n] = $d;

				/* workout remainder */
				$total[$n] = $coins[$n] * $answer[$n];
				$remainder[$n] = $input - $total[$n];

				/* Sanity Check */
				/* echo $input." - ".$coins[$n]." x ".$answer[$n]." = ".$total[$n]." r ".$remainder[$n]."\n"; */
		}

		/* Test Best Answer */
		$min = min(array_diff($answer, array(0)));
		$key = array_search($min, $answer);

		/* add format for sterling */
		$co = number_format(($coins[$key]/100),2);
		$re = number_format(($remainder[$key]/100),2);

		/* Print Best Answer */
	  	echo "<tr><th> £".$co."<td> X ".$answer[$key]."<td> £".$re; /* answer in table row format */
		/* echo "Best Combo is - £".$co." X ".$answer[$key]." Remaining £".$re."\n <br/>"; */
		
		/*loop again if has remaining sum */
		if ($remainder[$key] == 0) {
			echo "</table>"; /* end table */
			/* end */
		}
		else
		{
			$input = $remainder[$key];
			$user = new change();	/*Create query object */
			$user->amount($input);	/* call function Amount */
			$loop++;
		}
	}
}

?>