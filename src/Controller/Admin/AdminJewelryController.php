<?php

namespace App\Controller\Admin;

use App\Entity\Jewelry;
use App\Repository\JewelryRepository;
use App\Form\JewelryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminJewelryController extends AbstractController
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
   * @Route("/admin", name="admin.jewelry.index")
   * @return Response
   */
  public function index()
  {
    // $jewelry = $repository->finAll();
    $jewelry = $this->repository->findAll();
    return $this->render('admin/jewelry/index.html.twig', compact('jewelry'));
  }

  /**
   * @Route("/admin/jewelry/new", name="admin.jewelry.new")
   * @return Response
   */
  public function new(Request $request)
  {
    $jewelry = new Jewelry();
    $form = $this->createForm(JewelryType::class, $jewelry);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($jewelry);
      $this->em->flush();
      $this->addFlash('success', 'Your ad is good');
      return $this->redirectToRoute('admin.jewelry.index');
    }

    return $this->render('admin/jewelry/new.html.twig', [
      'jewelry' => $jewelry,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/jewelry/{id}", name="admin.jewelry.edit", methods="GET|POST")
   * @param Jewelry $jewelry
   * @return Response
   */
  public function edit(Jewelry $jewelry, Request $request)
  {
    $form = $this->createForm(JewelryType::class, $jewelry);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->flush();
      $this->addFlash('success', 'Your change is good');
      return $this->redirectToRoute('admin.jewelry.index');
    }

    return $this->render('admin/jewelry/edit.html.twig', [
      'jewelry' => $jewelry,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/jewelry/{id}", name="admin.jewelry.delete", methods="DELETE")
   * @param Jewelry $jewelry
   * @return Response
   */
  public function delete(Jewelry $jewelry, Request $request)
  {
    if ($this->isCsrfTokenValid('delete' . $jewelry->getId(), $request->get('_token'))) {
      $this->em->remove($jewelry);
      $this->em->flush();
      $this->addFlash('success', 'Your removal is good');
    }
    return $this->redirectToRoute('admin.jewelry.index');
  }
}