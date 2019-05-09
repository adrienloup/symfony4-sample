<?php

namespace App\Controller;

use App\Entity\Jewelry;
use App\Repository\JewelryRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BraceletsController extends AbstractController
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
   * @Route("/jewelry/bracelets", name="client.bracelets.index")
   * @param JewelryRepository $repository
   * @return Response
   */
  public function index(JewelryRepository $repository): Response
  {
    $bracelets = $repository->findByCategory('bracelets');
    return $this->render('client/bracelets/index.html.twig', [
      'bracelets' => $bracelets,
      'active_menu' => 'bracelets'
    ]);
  }

  /**
   * @Route("/jewelry/bracelets/{slug}-{id}", name="client.jewelry.single", requirements={"slug": "[a-z0-9\-]*"})
   * @param Jewelry $jewelry
   * @return Response
   */
  public function single(Jewelry $jewelry, string $slug): Response
  {
    if ($jewelry->getSlug() !== $slug ) {
      return $this->redirectToRoute('client.jewelry.single', [
        'id' => $jewelry->getId(),
        'slug' => $jewelry->getSlug()
      ], 301);
    }
    return $this->render('client/jewelry/single.html.twig', [
      'jewelry' => $jewelry,
      'active_menu' => 'bracelets'
    ]);
  }
}