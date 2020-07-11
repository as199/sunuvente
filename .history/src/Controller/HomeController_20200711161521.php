<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Etudiant;
use App\Entity\Recherche;
use App\Form\ChambreType;
use App\Form\EtudiantSearchType;
use App\Form\EtudiantType;
use App\Form\RechercheType;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
            'current_menu' => 'properties'
        ]);
    }
    /**
     * @Route("/page/addEtu", name="addEtudiant")
     */
    public function addstudent(Etudiant $etudiant = null, Request $request, ManagerRegistry $manager)
    {

        $etudiant = new Etudiant();


        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matricules = $etudiant->coupe($etudiant->getNom(), $etudiant->getPrenom());
            $etudiant->setMatricule($matricules);
            if ($etudiant->getType() == "boursiernonloger") {
                $etudiant->setChambre(null);
            }

            if ($etudiant->getType() == "nonboursier") {
                $etudiant->setChambre(null);
                $etudiant->setMontantBourse(0);
            }

            $managers = $manager->getManager();
            $managers->persist($etudiant);
            $managers->flush();
            return $this->json([
                'code' => 200,
                'message' => 'ajouter avec succé'
            ]);
        }
        return $this->render('page/addEtudiant.html.twig', [
            'controller_name' => 'HomeController',
            'formEtudiant' => $form->createView()
        ]);
    }

    /**
     * @Route("/page/listerEtu", name="listerEtudiant")
     */
    public function listerstudent(EtudiantRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $search = new Recherche();
        $form = $this->createForm(EtudiantSearchType::class, $search);
        $form->handleRequest($request);
        $etudiants =  $paginator->paginate(
            $repo->findEtudiant($search),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('page/listerstudent.html.twig', [
            'controller_name' => 'HomeController',
            'etudiants' => $etudiants,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/page/matricule/{id}", name="student_show")
     */
    public function show(Etudiant $etudiant)
    {
        return $this->render('page/showEtudiant.html.twig', [
            'controller_name' => 'HomeController',
            'etudiant' => $etudiant
        ]);
    }

    /**
     * @Route("/page/addCha", name="addChambre")
     */
    public function addChambre(Chambre $chambre = null, Request $request, ManagerRegistry $manager)
    {
        if (!$chambre) {
            $chambre = new Chambre();
        }


        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $managers = $manager->getManager();
            $managers->persist($chambre);
            $managers->flush();
            // return $this->redirectToRoute('listerChambre');
            return $this->json([
                'code' => 200,
                'message' => 'ajouter avec succé'
            ]);
        }
        return $this->render('page/addChambre.html.twig', [
            'controller_name' => 'HomeController',
            'formChambre' => $form->createView()
        ]);
    }

    /**
     * @Route("/page/listerCha", name="listerChambre")
     */
    public function listerChambre(Request $request, ChambreRepository $repo, PaginatorInterface $paginator)
    {

        $chambres = $paginator->paginate(
            $repo->getChambre(),
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('page/listerChambre.html.twig', [
            'controller_name' => 'HomeController',
            'chambres' => $chambres
        ]);
    }

    /**
     * @Route("/page/id/{id}", name="chambre_show", methods="GET|POST")
     */
    public function edit(Chambre $chambre, Request $request, ManagerRegistry $manager)
    {

        $id = $chambre->getId();
        $form = $this->createForm(ChambreType::class, $chambre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $managers = $manager->getManager();
            $managers->persist($chambre);
            $managers->flush();
            $this->addFlash('success', 'Modification réussie avec success');
            return $this->redirectToRoute('listerChambre');
        }
        return $this->render('page/editChambre.html.twig', [
            'controller_name' => 'HomeController',
            'chambre' => $form->createView(),
            'id' => $id
        ]);
    }

    /**
     * @Route("/page/id/{id}", name="chambre_delete", methods="DELETE")
     */
    public function delete(Chambre $chambre, Request $request, ManagerRegistry $manager)
    {
        if ($this->isCsrfTokenValid('delete' . $chambre->getId(), $request->get('_token'))) {
            $managers = $manager->getManager();
            $managers->remove($chambre);
            $managers->flush();
            if (!$chambre->getId()) {
                return $this->json([
                    'code' => 200,
                    'message' => 'ajouter avec succé'
                ]);
            }
        }
    }
}
