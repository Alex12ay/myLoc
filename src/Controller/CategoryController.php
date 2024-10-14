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
   
    public function index(CategoryRepository $cr): Response
    {
        $categories = $cr->findAll();
        return $this->render('base.html.twig', [
            'categories' => $categories,
        ]);
    }
    #[Route('admin/category/add', name: 'app_category_add')]
    public function add(Request $request, EntityManagerInterface $em, CategoryRepository $cr): Response
    {

        $newCategory = new Category;
        $form = $this->createForm(CategoryType::class, $newCategory);
        $form -> handleRequest($request);
        $categories = $cr -> findAll();


        if($form -> isSubmitted() && $form->isValid())
        {
            $newCategory = $form->getData();
            $em ->persist($newCategory);
            $em->flush();
        }

        return $this->render('category/add.html.twig', [
            'formCategory' => $form,
            'categories' => $categories,
        ]);
    }
    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(CategoryRepository $cr, $id):Response
    {
        $date = date('d/m/Y');
        $category = $cr->find($id);
        $categories = $cr ->findAll();

        return $this->render('category/show.html.twig',[
            'category' => $category,
            'categories' => $categories,
<<<<<<< HEAD
            'date' => $date
=======
>>>>>>> origin/main
        ]);
    }
    
}
