<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="app_home_page")
     */
    public function index(string $siteName)
    {
        return $this->render('home_page/index.html.twig', [
            'site_name' => $siteName,
        ]);
    }
}
