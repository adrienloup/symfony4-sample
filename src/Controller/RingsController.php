<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RingsController extends AbstractController
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
   * @Route("/jewelry/rings", name="client.rings.index")
   * @return Response
   */
  public function index(): Response
  {
    $repository = $this->repository->findAll();
    return $this->render('client/rings/index.html.twig', [
      'active_menu' => 'rings'
    ]);
  }
}