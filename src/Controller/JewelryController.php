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
   * @Route("/", name="jewelry.index")
   * @param JewelryRepository $repository
   * @return Response
   */
  public function index(JewelryRepository $repository): Response
  {
    // $jewelry = $repository->findLatest();
    $lastest = $repository->findLatest();
    $all = $repository->findAll();
    $sale = $repository->findBySale();
    $necklaces = $repository->findByCategory('necklaces');
    $earrings = $repository->findByCategory('earrings');
    $bracelets = $repository->findByCategory('bracelets');

    // $jewelry = $repository->findByCategory('jewelry');
    //$jewelry = $this->repository->findOneBy(['category' => 'watch']);
    //dump($jewelry);
    // $category = $repository->getCategory();
    // dump($category);
    // 'category' => $jewelry->getCategory()
    
    return $this->render('client/jewelry/index.html.twig', [
      'lastest' => $lastest,
      'all' => $all,
      'sale' => $sale,
      'necklaces' => $necklaces,
      'earrings' => $earrings,
      'bracelets' => $bracelets,
      'active_menu' => 'jewelry'
    ]);
  }

  /**
   * @Route("/jewelry/{category}/{slug}-{id}", name="client.jewelry.single", requirements={"slug": "[a-z0-9\-]*"})
   * @param Jewelry $jewelry
   * @return Response
   */
  public function single(Jewelry $jewelry, string $slug): Response
  {
    if ($jewelry->getSlug() !== $slug ) {
      return $this->redirectToRoute('client.jewelry.single', [
        'id' => $jewelry->getId(),
        'slug' => $jewelry->getSlug(),
        'category' => $jewelry->getCategory()
      ], 301);
    }
    return $this->render('client/jewelry/single.html.twig', [
      'jewelry' => $jewelry
    ]);
  }

  // /**
  //  * @Route("/jewelry/bracelets/{slug}-{id}", name="client.jewelry.single", requirements={"slug": "[a-z0-9\-]*"})
  //  * @param Jewelry $jewelry
  //  * @return Response
  //  */
  // public function single(Jewelry $jewelry, string $slug): Response
  // {
  //   if ($jewelry->getSlug() !== $slug ) {
  //     return $this->redirectToRoute('client.jewelry.single', [
  //       'id' => $jewelry->getId(),
  //       'slug' => $jewelry->getSlug()
  //     ], 301);
  //   }
  //   return $this->render('client/jewelry/single.html.twig', [
  //     'jewelry' => $jewelry,
  //     'active_menu' => 'bracelets'
  //   ]);
  // }
}