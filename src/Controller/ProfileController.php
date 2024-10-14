<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\EmpruntRepository;
use App\Repository\ObjetRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(CategoryRepository $cr, EmpruntRepository $er): Response
    {
        $owner = $this-> getUser();
        $objets = $owner->getObjets();
        $categories =$cr->findAll();
        $date = date('d/m/Y');
<<<<<<< HEAD
        $pointClient = $owner -> getNbPoint();
=======
>>>>>>> origin/main
          
        
        
        return $this->render('profile/index.html.twig', [
            'categories' => $categories ,
            'objets' => $objets,
            'date' => $date,
<<<<<<< HEAD
            'pointClient' => $pointClient,
=======
>>>>>>> origin/main
        ]);
    }
}
