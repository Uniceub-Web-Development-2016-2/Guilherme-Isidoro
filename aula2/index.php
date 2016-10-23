<?php

class Math
{

	private $num_1;
	private $num_2;

	
	public function __construct($num_1, $num_2)
	{
		$this->num_1 = $num_1;
		$this->num_2 = $num_2;
	}	
	
	public function sumAttributes() 
	{
		return $this->num_1 + $this->num_2;
	}

	public function sum($num_1, $num_2) 
	{
		if($num_1 < 0 || $num_2 < 0)
			return "Can not sum motherfuckers";
		return $num_1 + $num_2;
	}

	public function sumAll($numbersArray)
	{
		$sum = 0;
		
		foreach($numbersArray as $number)
		{
			$sum = $sum + $number;
		} 
		
		return $sum;
	}

}


$math = new Math(5,7);
//echo $math->sumAttributes();
//echo "</br>";
//echo $math->sum(2,7);
$array = array(3, 4, 7, -9, 5, 4, 1, 23);
echo $math->sumAll($array);






























