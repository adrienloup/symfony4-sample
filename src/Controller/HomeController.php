<?php

namespace App\Controller;

use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/home", name="home")
   * @param JewelryRepository $repository
   * @return Response
   */
  public function index(JewelryRepository $repository): Response
  {
    $jewelry = $repository->findLatest();
    $jewelry2 = $repository->findAll();

    return $this->render('pages/home.html.twig', [
      'jewelry' => $jewelry,
      'jewelry2' => $jewelry2,
      'active_menu' => 'home'
    ]);
  }
}