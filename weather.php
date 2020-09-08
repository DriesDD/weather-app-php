
<?php 
function fyshuffle ($arr, $n) 
{ 
	//From last to first...
	for($i = $n - 1; $i >= 0; $i--) 
	{ 
		// Pick a remaining element...
		$j = rand(0, $i+1); 

        // And swap it with the current element.
		$tmp = $arr[$i]; 
		$arr[$i] = $arr[$j]; 
		$arr[$j] = $tmp; 
	} 
	for($i = 0; $i < $n; $i++) 
	echo $arr[$i]." "; 
}

?> 
