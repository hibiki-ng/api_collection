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
    public function index(): Response
    {
        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }

    public function test(HttpClientInterface $httpClient)
    {
        $request = $httpClient->request(
            'GET',
            'https://goweather.herokuapp.com/weather/Paris');
        
        if ( $request->getStatusCode() === 200 ) {
            return $request->toArray();
            echo 'ok';
        } else {
            echo 'error';
        }
        $request->getContent();
        return $request->toArray();
    }
}
