<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SarmatesController extends AbstractController
{
    #[Route('/', name: 'app_sarmates')]
    public function index(NewsRepository $repo): Response
    {
        // récupération des news
        $news = $repo->findAll();
        // dd($news);
        // affichage de news
        return $this->render('sarmates/index.html.twig', compact('news'));
    }

        #[Route('/new/{id}', name: 'app_show')]
    public function show($id, NewsRepository $repo): Response 
    {
        // je récupère le poste
        $news = $repo->find($id);
        //je passe à la vue
        return $this->render('sarmates/show.html.twig', compact('news'));
    }
        #[Route('news/delete/{id}', name :'app_delete', methods: ['GET', 'DELETE'])]
        public function delete(int $id, NewsRepository $repo, EntityManagerInterface $em): Response
        {
            $news = $repo->find($id);
            $em->remove($news);
            $em->flush();
            return $this->redirectToRoute('app_sarmates');
        }
}
