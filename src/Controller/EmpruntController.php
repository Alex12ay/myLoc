<?php

namespace App\Controller;

<<<<<<< HEAD
use App\Entity\Category;
=======
>>>>>>> origin/main
use App\Entity\Emprunt;
use App\Form\EmpruntType;
use App\Repository\CategoryRepository;
use App\Repository\EmpruntRepository;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt/{id}', name: 'app_emprunt')]
<<<<<<< HEAD
    public function index(CategoryRepository $cr, $id, Request $request, EntityManagerInterface $em, ObjetRepository $or, EmpruntRepository $emp): Response
=======
    public function index(CategoryRepository $cr, $id, Request $request,EntityManagerInterface $em ,ObjetRepository $or,EmpruntRepository $emp): Response
>>>>>>> origin/main
    {
        $categories = $cr->findAll();
        $newEmprunt = new Emprunt;
        $form = $this->createForm(EmpruntType::class, $newEmprunt);
        $form ->handleRequest($request);
        $objet = $or->find($id);
<<<<<<< HEAD
        $nomObjet =$objet ->getName();
        $catObjet = $objet->getCategory();
        $pointEmp = $catObjet->getNbPoint();
        $owner = $objet -> getOwner();
        $client = $this->getUser();
        $pointClient = $client->getNbPoint();


        if ($form ->isSubmitted() && $form ->isValid()){
            $newEmprunt = $form->getData();
            $newEmprunt -> setUser($client);
            $DateStart = $newEmprunt->getDateStart();
            $DateEnd = $newEmprunt->getDateEnd();
            $newEmprunt ->setObjet($objet);  
           
            $newEmprunt ->setPoint($pointEmp);  
            $pointAdd = $pointEmp + ($owner -> getNbPoint());
            $owner ->setNbPoint($pointAdd); 
            if ($pointClient >= $pointEmp){
                $client -> subtractPoints($pointEmp);      
                
                $emprunt = $emp->findEmprunts($objet, $DateStart, $DateEnd);
          
                if ($emprunt){
                    $this->addFlash('error', 'Cet objet est déjà réservé pour ces dates.');
                    return $this->redirectToRoute('app_emprunt',["id"=>$id]);
                    
                }else{
                    $em ->persist($newEmprunt);
                    $em->flush(); 
                    return $this->redirectToRoute('app_objets');          
                }
            }else{
                $this->addFlash('error', 'Pas assez de points');
                return $this->redirectToRoute('app_emprunt',["id"=>$id]);
            }
        }
       
        return $this->render('emprunt/index.html.twig', [
            'categories' => $categories,
            'formEmprunt' => $form,
            'pointClient' => $pointClient,
            'pointCategorie' => $pointEmp,
            'objet' => $nomObjet,
            
        ]);
    }
}
=======

        if ($form ->isSubmitted() && $form ->isValid()){
            $newEmprunt = $form->getData();
            $newEmprunt -> setUser($this->getUser());
            $newEmprunt ->setObjet($objet);
            
            $em ->persist($newEmprunt);
            $em->flush();            
        }
        return $this->render('emprunt/index.html.twig', [
            'categories' => $categories,
            'formEmprunt' => $form,
        ]);
    }
}
>>>>>>> origin/main
