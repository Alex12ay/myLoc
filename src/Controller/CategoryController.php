<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    #[Route('/category/add', name: 'app_category_add')]
    public function add(Request $request, EntityManagerInterface $em,): Response
    {

        $newCategory = new Category;
        $form = $this->createForm(CategoryType::class, $newCategory);
        $form -> handleRequest($request);

        if($form -> isSubmitted() && $form->isValid())
        {
            $newCategory = $form->getData();
            $em ->persist($newCategory);
            $em->flush();
        }

        return $this->render('category/add.html.twig', [
            'formCategory' => $form,
        ]);
    }
    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(CategoryRepository $cr, $id):Response
    {
        $category = $cr->find($id);

        return $this->render('category/show.html.twig',[
            'category' => $category,
        ]);
    }
    
}
