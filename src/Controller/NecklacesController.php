<?php

namespace App\Controller;

use App\Entity\Jewelry;
use App\Repository\JewelryRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NecklacesController extends AbstractController
{
  /**
   * @var JewelryRepository
   */
  private $repository;

  /**
   * @var ObjectManager
   */
  private $em;

  public function __construct(JewelryRepository $repository, ObjectManager $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/jewelry/necklaces", name="client.necklaces.index")
   * @param JewelryRepository $repository
   * @return Response
   */
  public function index(JewelryRepository $repository): Response
  {
    $necklaces = $repository->findByCategory('necklaces');
    return $this->render('client/necklaces/index.html.twig', [
      'necklaces' => $necklaces,
      'active_menu' => 'necklaces'
    ]);
  }
}