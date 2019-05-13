<?php


// src/Victortestmaster/Analyser/Controller/StartController.php
namespace App\Victortestmaster\Analyser\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function SebastianBergmann\ObjectGraph\object_graph_dump;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StartController extends controller
{
    /**
     * @Route("/analyser/start/", name="app_analyser_start")
     */
    public function start()
    {
	    return $this->render('analyser/welcome.html.twig');
    }

}



