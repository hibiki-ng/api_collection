<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather", name="app_weather")
     */
    public function index(HttpClientInterface $httpClient):Response
    {
        $request = $httpClient->request(
            'GET',
            'https://goweather.herokuapp.com/weather/Paris');
        
        if ( $request->getStatusCode() === 200 ) {
            $content = $request->toArray();

            $temp = $content["temperature"];
            $weather = $content["description"];
            $meteo;
            if ($weather == "Sunny") {
                $meteo = "Soleil";
            }
            else {
                $meteo = "Moins beau temps";
            }
        } else {
            echo 'error';
        }

        return $this->render('weather/index.html.twig', array(
            'temp' => $temp,
            'meteo' => $meteo
        ));
    }
}
