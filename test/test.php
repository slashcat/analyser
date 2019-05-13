<?php
/**
 * Created by Victor Albala.
 */


namespace App\Victortestmaster\Analyser\test;

use PHPUnit\Framework\TestCase;
use App\Victortestmaster\Analyser\Model\AnalyserModel;
use App\Victortestmaster\Analyser\Helper\AnalyserHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnalyserTests extends TestCase
{

    public function testBeforechars()
    {
	$analyser_model  = new AnalyserModel();
	$analyser_helper = new AnalyserHelper();
        $text = 'football vs soccer';
        $letter = 'b';
	$result = $analyser_model->getCharsData($text,$letter);
        $this->assertTrue($result["before"] == "a");
    }




    public function testAftercharsNone()
    {
        $analyser_model  = new AnalyserModel();
        $analyser_helper = new AnalyserHelper();
        $text = 'football vs soccer';
        $letter = 'f';
        $result = $analyser_model->getCharsData($text,$letter);
        $this->assertTrue($result["after"] == "none");
    }


    public function testAfterchars()
    {
        $analyser_model  = new AnalyserModel();
        $analyser_helper = new AnalyserHelper();
        $text = 'football vs soccer';
        $letter = 'r';
        $result = $analyser_model->getCharsData($text,$letter);
        $this->assertTrue($result["after"] == "e");
    }


    public function testMaxDistance()
    {
	$analyser_model  = new AnalyserModel();
        $text = 'football vs soccerf';
        $letter = 'f';
	$result = $analyser_model->getCharsData($text,$letter);
        $this->assertTrue($result["qty_chars"] +1  == 18);
    }


    public function testQtyChars()
    {
        $analyser_model  = new AnalyserModel();
        $text = 'football vs soccerf';
        $letter = 'o';
        $result = $analyser_model->getCharsData($text,$letter);
        $this->assertTrue($result["qty"]  == 3);
    }


}
