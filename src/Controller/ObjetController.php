<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\CategoryRepository;
use App\Repository\ObjetRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ObjetController extends AbstractController
{
    #[Route('/objets', name: 'app_objets')]
    public function index(ObjetRepository $or, CategoryRepository $cr): Response

    {
        $date = date('d/m/Y');
        $categories = $cr->findAll();
        $objets = $or->findAll();
        return $this->render('objet/index.html.twig', [
            'objets' => $objets,
            'categories' => $categories,
            'date' => $date
        ]);
    }
    #[Route('/objets/add', name: 'app_objets_add')]
    public function add(Request $request, 
    SluggerInterface $slugger,
    EntityManagerInterface $entityManager,
    CategoryRepository $cr,
    #[Autowire('%kernel.project_dir%/public/uploads/')] string $uploadDirectory): Response
    {
        $newObjet = new Objet;
        $form = $this->createForm(ObjetType::class, $newObjet);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile */
            $thumbnail = $form->get('thumbnail')->getData();
            if($thumbnail){
                $originalFileName = pathinfo($thumbnail->getClientOriginalName(),PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFileName);
                $newFileName = $safeFilename.'-'.uniqid().'.'.$thumbnail->guessExtension();

                try{
                    $thumbnail->move($uploadDirectory, $newFileName);
                }catch(FileException $e){

                }
                $newObjet->setThumbnail($newFileName);
            }

            
            $newObjet = $form->getData();
            $newObjet -> setOwner($this->getUser());
            $entityManager -> persist($newObjet);
            $entityManager ->flush();

            return $this->redirectToRoute('app_objets');
        }
        $categories = $cr->findAll();
        return $this->render('objet/add.html.twig', [
            'formObjet' => $form,
            'categories' => $categories,
        ]);
        
    
    }
    #[Route('/objets/show/{id}', name: 'app_objet_show')]
    public function show(ObjetRepository $or, $id, CategoryRepository $cr): Response

    {
<<<<<<< HEAD
        $date = date('d/m/Y');
=======
>>>>>>> origin/main
        $categories = $cr ->findAll();
        $objet = $or->find($id);
        return $this->render('objet/show.html.twig', [
            'objet' => $objet,
            'categories' => $categories,
<<<<<<< HEAD
            'date' => $date
=======
>>>>>>> origin/main
        ]);
    }

    #[Route('/objets/show/{id}/update', name: 'app_objet_update')]
public function update(Objet $objet, EntityManagerInterface $entityManager, CategoryRepository $cr, SluggerInterface $slugger, Request $request, #[Autowire('%kernel.project_dir%/public/uploads/')] string $uploadDirectory): Response
{
    
    $form = $this->createForm(ObjetType::class, $objet);
    $form->handleRequest($request);

    
    if ($form->isSubmitted() && $form->isValid()) {
        
        /** @var UploadedFile $thumbnail */
        $thumbnail = $form->get('thumbnail')->getData();

        if ($thumbnail) {
            
            $originalFileName = pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFileName);
            $newFileName = $safeFilename . '-' . uniqid() . '.' . $thumbnail->guessExtension();

            
            try {
                $thumbnail->move($uploadDirectory, $newFileName);
            } catch (FileException $e) {
                
                $this->addFlash('error', 'Erreur lors du téléchargement de l\'image. Veuillez réessayer.');
                return $this->redirectToRoute('app_objet_update', ['id' => $objet->getId()]);
            }

            
            $objet->setThumbnail($newFileName);
        }

        
        $objet->setOwner($this->getUser());

        
        $entityManager->persist($objet);
        $entityManager->flush();

        
        $this->addFlash('success', 'L\'objet a été modifié avec succès.');
        return $this->redirectToRoute('app_objets');
    }

    
    $categories = $cr->findAll();

    
    return $this->render('objet/update.html.twig', [
        'formObjet' => $form->createView(),
        'categories' => $categories,
    ]);
    }

    #[Route('/objets/show/{id}/delete', name: 'app_objet_delete')]
    public function delete(ObjetRepository $or, $id ,EntityManagerInterface $em): Response
    {
        $objet = $or->find($id);
        $em ->remove($objet);
        $em->flush();
        return $this->redirectToRoute('app_objets'); 
    }


}
