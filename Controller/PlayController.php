<?php


// src/Victortestmaster/Analyser/Controller/PlayController.php
namespace App\Victortestmaster\Analyser\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Victortestmaster\Analyser\Helper\AnalyserHelper;
use App\Victortestmaster\Analyser\Model\AnalyserModel;


class PlayController extends controller
{

   
    /**
     * @Route("/analyser/play/", name="app_analyser_play")
     */
    public function play()
    {
	return new Response($this->analytics());
    }



    public function analytics()
    {
	    $new = new AnalyserHelper();
	    $model = new AnalyserModel();
	    if((!isset($_REQUEST["text"]) || ($_REQUEST["text"]=="")))
		{

           return $this->render('analyser/start.html.twig', ["results"=>"","message"=>"Please insert a word"]);

		}
	    $param = $_REQUEST["text"];
	    $results = $model->setGrid($new->proccessData($param));
            return $this->render('analyser/start.html.twig', ['results' => $results,"message"=>"results: \n"]);
	//var_dump($this->getCharsData($grid_total,"o"));
    } 




}



