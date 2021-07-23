<?php
namespace App\function1;
class function1 {
	public function Code(string $string, array $data){
  	    $number=0;
        foreach ($data as $value ) {
          $number1=number_format(str_replace($string,'',$value));
          $number_code= (int)str_replace(',','', $number1);
          if($number_code>$number){
          	$number=$number_code;
          }
        }
        $number=$number+1;
        $number2=(string)$number;
        $string0='';
        for ($i=strlen($number2); $i <=6 ; $i++) { 
        	$string0=$string0.'0';
        }
        return $string.$string0.$number2;
	}
}