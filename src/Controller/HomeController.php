<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Circuits;
use App\Entity\Offre;
use App\Entity\View;
use App\Entity\Reserve;

use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager ){
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
public function index()
{
    return $this->render('home/index.html.twig');
}

    
    #[Route('/circuits', name: 'app_circuits')]
    public function circuits(): Response
    {
    
        $circuits = $this->entityManager->getRepository(Circuits::class)->findAll();

        return $this->render('home/circuits.html.twig' , [
            'circuits' =>$circuits,
        ]);
    
    }
    #[Route('/offres', name: 'app_offres')]
    public function offre(): Response
    {
    
        $offres = $this->entityManager->getRepository(Offre::class)->findAll();

        return $this->render('home/offre.html.twig' , [
            'offres' =>$offres,
        ]);
    
    }
    #[Route('/partenaire', name: 'app_partenaire')]
    public function partenaire(): Response
    {

        return $this->render('home/partenaire.html.twig');
    }
    #[Route('/views', name: 'app_views')]
    public function views(Request $request): Response
    {
        $views = []; // Initialisez la variable $views avec un tableau vide

        if ($request->getMethod() === 'POST') {
            $username = $request->request->get('username');
            $creatview = $request->request->get('creatview');
    
            $view = new View();
            $view->setUsername($username)
                 ->setCreatview($creatview);
    
            $this->entityManager->persist($view);
            $this->entityManager->flush();
        }
    
        // Récupérer toutes les vues depuis la base de données ou tout autre système de stockage
        $views = $this->entityManager->getRepository(View::class)->findAll();
    
        return $this->render('home/views.html.twig', [
            'views' => $views,
        ]);
        return $this->render('home/views.html.twig');
    }
    #[Route('/Reserve', name: 'app_Reserve')]
    public function Reserve(Request $request): Response
    {
        $reserves = []; // Initialisez la variable $views avec un tableau vide

        if ($request->getMethod() === 'POST') {
            $ville = $request->request->get('ville');
            $circuits = $request->request->get('circuits');
            $date = $request->request->get('date');

            $reserve = new reserve();
            $reserve->setville($ville)
                 ->setcircuits($circuits)
                 ->setdate($date);
    
            $this->entityManager->persist($reserve);
            $this->entityManager->flush();
        }
    
        // Récupérer toutes les vues depuis la base de données ou tout autre système de stockage
        $views = $this->entityManager->getRepository(View::class)->findAll();
    
        return $this->render('home/reserves.html.twig', [
            'reserves' => $views,
        ]);
        return $this->render('home/reserves.html.twig');
    }
}
