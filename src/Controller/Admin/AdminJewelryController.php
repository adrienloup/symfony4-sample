<?php

namespace App\Controller\Admin;

use App\Repository\JewelryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminJewelryController extends AbstractController
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
   * @Route("/admin", name="admin.jewelry.index")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function index()
  {
    $jewelry = $this->repository->finAll();
    return $this->render('admin/jewelry/index.html.twig', compact('jewelry'));
  }

  /**
   * @Route("/admin/{id}", name="admin.jewelry.edit")
   */
  public function edit(JewelryRepository $repository)
  {
    return $this->render('admin/jewelry/edit.html.twig', compact('jewelry'));
  }

}