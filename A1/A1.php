<?php
	echo "<p>---Variables---</p>";
	define("name", "Lachlan");
	echo "<p>My name is ".name."</p>";
	$number = 1;
	echo "<p>A number is: ".$number."</p>";
	$number += 2;
	echo "<p>Adding 2 will make it: ".$number."</p>";
	
	echo "<p>---Arrays---</p>";
	$names = array
	(
		"Lachlan0",
		"Lachlan1",
		"Lachlan2",
		"Lachlan3",
	);
	echo "<p>Third element: ".$names[2]."</p>";
	echo "<p>Total elements: ".count($names)."</p>";
	$names[2] = "Matthews";
	echo "<p>Edited third element: ".$names[2]."</p>";
	
	echo "<p>---Logic---</p>";
	if ($names[0] == name)
		echo "<p>Element 0 is equal to ".name."</p>";
	else
		echo "<p>Element 0 is not equal to: ".name."</p>";
	switch ($number)
	{
		case 0:
			echo "<p>Element 0 is equal to ".$names[0]."</p>";
			break;
		case 1:
			echo "<p>Element 1 is equal to ".$names[1]."</p>";
			break;
		case 2:
			echo "<p>Element 2 is equal to ".$names[2]."</p>";
			break;
		case 3:
			echo "<p>Element 3 is equal to ".$names[3]."</p>";
			break;
		default:
			echo "<p>No element</p>";
			break;
	}
	
	echo "<p>---Loops---</p>";
	echo "<p>While loop:</p>";
	$count = 0;
	while ($count < count($names))
	{
		if ($count != 1)
			echo "<p>Element ".$count." is not equal to Lachlan1</p>";
		else
			echo "<p>Element ".$count." is equal to Lachlan1</p>";
		$count++;
	}
	echo "<p>For loop:</p>";
	for ($i = 0; $i < count($names); $i++)
	{
		if ($i != 1)
			echo "<p>Element ".$i." is not equal to Lachlan1</p>";
		else
			echo "<p>Element ".$i." is equal to Lachlan1</p>";
	}
	
	echo "<p>---Functions---</p>";
	function func($num1, $num2)
	{
		return $num1 + $num2;
	}
	$sum = func(1, 2);
	echo "<p>Sum = ".$sum."</p>";
?>