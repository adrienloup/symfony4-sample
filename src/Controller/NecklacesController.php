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
    $all = $repository->findAll();
    return $this->render('client/necklaces/index.html.twig', [
      'all' => $all,
      'active_menu' => 'necklaces'
    ]);
  }

  /**
   * @Route("/jewelry/necklaces/{slug}-{id}", name="client.necklaces.single", requirements={"slug": "[a-z0-9\-]*"})
   * @param Jewelry $jewelry
   * @return Response
   */
  public function single(Jewelry $jewelry, string $slug): Response
  {
    if ($jewelry->getSlug() !== $slug ) {
      return $this->redirectToRoute('client.necklaces.single', [
        'id' => $jewelry->getId(),
        'slug' => $jewelry->getSlug()
      ], 301);
    }
    return $this->render('client/necklaces/single.html.twig', [
      'jewelry' => $jewelry,
      'active_menu' => 'necklaces'
    ]);
  }
}