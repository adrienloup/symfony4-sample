<?php

namespace App\Controller;

use App\Entity\Jewelry;
use App\Repository\JewelryRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JewelryController extends AbstractController
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
   * @Route("/jewelry", name="jewelry.index")
   * @return Response
   */
  public function index(): Response
  {
    return $this->render('jewelry/index.html.twig', [
      'active_menu' => 'jewelry'
    ]);
  }

  /**
   * @Route("/jewelry/{slug}-{id}", name="jewelry.single", requirements={"slug": "[a-z0-9\-]*"})
   * @param Jewelry $jewelry
   * @return Response
   */
  public function single(Jewelry $jewelry, string $slug): Response
  {
    if ($jewelry->getSlug() !== $slug ) {
      return $this->redirectToRoute('jewelry.single', [
        'id' => $jewelry->getId(),
        'slug' => $jewelry->getSlug()
      ], 301);
    }
    return $this->render('jewelry/single.html.twig', [
      'jewelry' => $jewelry,
      'active_menu' => 'jewelry'
    ]);
  }

}