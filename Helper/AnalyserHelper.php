<?php


// src/Victortestmaster/Analyser/Helper/AnalyserHelper.php
namespace App\Victortestmaster\Analyser\Helper;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Victortestmaster\Analyser\Model\AnalyserModel;

class AnalyserHelper 
{

private $model;

   public function __construct()
	{
		$this->model= new  AnalyserModel();
	}


   public function positions($param,$needle,$allpos)
    {

            $offset = 0;
            $position =0;
            $distance = 0;
            $max_distance_letter=array();

            while (($pos = strpos($param, $needle, $offset)) !== FALSE) {
                    if($position>=1)
                    {
                            $position_before = $position_before + 1;
                            $distance = $pos - $position_before;
                            if($distance>$this->model->getDistance())
                            {
                                    $this->model->setDistance($distance);
                                    $max_distance_letter = $needle;
                            }
                            $position_before = $pos;
                    }
                    else
                    {
                            $position_before = $pos;
                    }
                    $offset   = $pos + 1;
                    $allpos[] = $pos;
                    $position++;
            }

            return array("allpos"=>$allpos,"max_distance_letter"=>$max_distance_letter,"best_distance"=>$distance);

    }




   public function proccessData($param)
   {

	   $this->model->setdistance(0);
	   $model = new AnalyserModel();
	   $param_len = strlen($param);
	   $array = str_split($param);
	   $array_full = array();
	   $count = 1;


	   foreach($array as $letters)
	   {
		   $array_full = array_merge($array_full,array($count=>$letters));
	   }

	   $longest = 0;
	   $vals = array_count_values($array_full);
	   //print_r($vals);
	   $position_before = '';
	   $max_distance_letter=array();
	   $grid_total = array();
	   foreach($vals as $needle => $i)
	   {
		   $allpos = array();

		   $allpos = $this->positions($param,$needle,$allpos);

		   $allpos_array = $allpos["allpos"];
		   $grid = array("letter"              =>$needle,"qty"=>$i
				   ,"max_distance_letter"=>$allpos["max_distance_letter"]
				   ,"qty_chars"          =>$allpos["best_distance"]);
		   //echo $needle.":".$i.":before:";
		   $before = "";
		   foreach($allpos_array as $ps)
		   {
			   $key = $ps + 1;
			   if($param_len > $key)
			   {
				   $before.=$param[$key];
			   }
		   }
		   $grid = array_merge($grid,array("before"=>$before));


		   $after = "";
		   foreach($allpos_array as $ps)
		   {
			   $key = $ps - 1;
			   $after.=($key==-1)?"none":$param[$ps-1];
		   }
		   $grid = array_merge($grid,array("after"=>$after));
		   $grid_total = array_merge($grid_total,array($grid));
		   //$this->setGrid($grid,$max_distance_letter);
	   }


	   return  $grid_total; 
   }



}
