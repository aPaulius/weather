<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction() 
	{

		$json = file_get_contents('https://api.forecast.io/forecast/49ae888acf33e60575c75ba7fb098150/54.696523,25.277824');
		if(!empty($json))
		{
			$obj = json_decode($json);
			$currentWeatherF = $obj->currently->temperature;
			$currentWeatherC = round(($currentWeatherF - 32) * (5/9)) . ' degrees Celcius outside of NFQ.';
			return new Response($currentWeatherC);
		}
		else
		{
			$json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat=54&lon=25&APPID=ea92b70fa0fc7b419e02bf24c698bf85');
			$obj = json_decode($json);
			$currentWeatherK = $obj->main->temp;
			$currentWeatherC = round($currentWeatherK - 273.15) . ' degrees Celcius outside of NFQ.';
			return new Response($currentWeatherC);
		}
	}
}
