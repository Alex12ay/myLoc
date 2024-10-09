<?php

namespace App\Controller;

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
    public function index(CategoryRepository $cr, $id, Request $request,EntityManagerInterface $em ,ObjetRepository $or,EmpruntRepository $emp): Response
    {
        $categories = $cr->findAll();
        $newEmprunt = new Emprunt;
        $form = $this->createForm(EmpruntType::class, $newEmprunt);
        $form ->handleRequest($request);
        $objet = $or->find($id);

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
