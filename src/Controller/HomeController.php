<?php

namespace App\Controller;

use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @param JewelryRepository $repository
   * @return Response
   */
  public function index(JewelryRepository $repository): Response
  {
    $jewelry = $repository->findLatest();
    return $this->render('pages/home.html.twig', [
      'jewelry' => $jewelry,
      'active_menu' => 'home'
    ]);
  }
}