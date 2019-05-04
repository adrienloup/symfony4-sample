<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenController extends AbstractController
{
  /**
   * @var JewelryRepository
   */
  private $repository;

  public function __construct(JewelryRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * @Route("/men", name="men")
   * @return Response
   */
  public function index(): Response
  {
    $repository = $this->repository->findAll();
    dump($repository);
    return $this->render('pages/men.html.twig', [
      'active_menu' => 'men'
    ]);
  }

}