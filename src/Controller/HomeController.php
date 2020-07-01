<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'current_menu' => 'properties'
        ]);
    }
    /**
     * @Route("/page/addEtu", name="addEtudiant")
     */
    public function addstudent()
    {
        return $this->render('page/addEtudiant.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/page/listerEtu", name="listerEtudiant")
     */
    public function listerstudent()
    {
        return $this->render('page/listerstudent.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/page/addCha", name="addChambre")
     */
    public function addChambre()
    {
        return $this->render('page/addChambre.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/page/listerCha", name="listerChambre")
     */
    public function listerChambre()
    {
        return $this->render('page/listerChambre.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}