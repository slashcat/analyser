<?php


// src/Victortestmaster/Analyser/Model/AnalyserModel.php
namespace App\Victortestmaster\Analyser\Model;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Victortestmaster\Analyser\Helper\AnalyserHelper;

class AnalyserModel 
{

   private $distance;

        /**
         *
         * You get the information for specific letter
         *
         * @param    string
         *
         */


   public function getCharsData($text, $letter)
   {
	   $analyser_helper  = new AnalyserHelper();
	   $result = $analyser_helper->proccessData($text);
	   foreach($result as $res)
	   {
		   if($res["letter"] == $letter)
		   {
			   return $res;
		   }
	   }
   }



/** SETTERS AND GETTERS **/

        /**
         *
         * Setting all the info
         *
         * @param    array
         *
         */



	public function setGrid($grid)
	{
		$return='';
		foreach($grid as $row)
		{
			//var_dump($row["max_distance_letter"]);  
			$last = ($row['letter']==$row['max_distance_letter'])?" max-distance: ".$row['qty_chars']." chars ":"";
			$return.=$row['letter']." : ".$row['qty']." : before:".$row['before']." after:".$row['after'].$last." \r";
		}
		return $return;

	}



        public function setDistance($param)
		{
			$this->distance = $param;
		}


        public function getDistance()
                {
                       return  $this->distance;
                }



}



