<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Form\HebergementTacheType;
use App\Form\HebergementType;
use App\Repository\HebergementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

#[Route('/hebergement')]
class HebergementController extends AbstractController
{
    #[Route('/', name: 'app_hebergement_index', methods: ['GET'])]
    public function index(HebergementRepository $hebergementRepository): Response
    {
        
        $tab=$hebergementRepository->Bymonth(5);
        return $this->render('hebergement/index.html.twig', [
            'hebergements' => $hebergementRepository->findAll(),
            'tab' => $tab
        ]);
    }

    #[Route('/new', name: 'app_hebergement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HebergementRepository $hebergementRepository): Response
    {
        $hebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hebergementRepository->save($hebergement, true);

            return $this->redirectToRoute('app_hebergement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hebergement/new.html.twig', [
            'hebergement' => $hebergement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hebergement_show', methods: ['GET'])]
    public function show(Hebergement $hebergement): Response
    {
        return $this->render('hebergement/show.html.twig', [
            'hebergement' => $hebergement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hebergement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hebergement $hebergement, HebergementRepository $hebergementRepository): Response
    {
        $form = $this->createForm(HebergementTacheType::class, $hebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hebergement->setTache($hebergement->getTache());
            $hebergementRepository->save($hebergement, true);

            return $this->redirectToRoute('app_tache_edit', [ 'id' => $hebergement->getTache()->getId() ], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('hebergement/edit.html.twig', [
            'hebergement' => $hebergement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit/note', name: 'app_hebergement_edit_note', methods: ['GET', 'POST'])]
    public function editNote(Request $request, Hebergement $hebergement, HebergementRepository $hebergementRepository): Response
    {
        $form = $this->createForm(HebergementTacheType::class, $hebergement);
        $form->handleRequest($request);
        $session = $request->getSession();

        $data = [
            'tacheTab'=>$session->get('tacheTab'),
            'formPayAll'=>$session->get('formPayAll'),
            'page'=> 'mission',
            'year'=>$session->get('year'),
            'mission'=>$session->get('mission'),
            'month'=>$session->get('month'),
            'deplacements'=>$session->get('deplacements'),
            'totalDeplacment'=>$session->get('totalDeplacement'),
            'hebergements'=>$session->get('hebergements'),
            'reunions'=>$session->get('reunions'),
            'totalReunions'=>$session->get('totalReunions'),
            'restaurations'=>$session->get('restaurations'),
            'documents'=>$session->get('documents'),
            'totalDocuments'=>$session->get('totalDocuments'),
            'totalrestaurations'=>$session->get('totalRestaurations'),
            'forfaits'=> $session->get('forfaits'),
            'communications'=>$session->get('communications'),
            'totalCom'=>$session->get('totalCom'),
            'intervenants'=>$session->get('intervenantTab'),
            'totalIntervenants'=>$session->get('totalIntervenants'),
            'totalForfait' => $session->get('totalForfait'),
            'totalHt' => $session->get('totalHt'),
            'tva'=>$session->get('tva'),
            'ttc'=>$session->get('ttc'),
            'logo'  => $session->get('logo'),  
        ];

        if ($form->isSubmitted() && $form->isValid()) {
            $hebergement->setTache($hebergement->getTache());
            $hebergementRepository->save($hebergement, true);

            return $this->renderForm('mission/edit/notedefrais/index.html.twig',[
                'data' => $data,
            ]);

        }

        return $this->renderForm('hebergement/edit.html.twig', [
            'hebergement' => $hebergement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hebergement_delete', methods: ['POST'])]
    public function delete(Request $request, Hebergement $hebergement, HebergementRepository $hebergementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hebergement->getId(), $request->request->get('_token'))) {
            $hebergementRepository->remove($hebergement, true);
        }

        return $this->redirectToRoute('app_tache_edit', [ 'id' => $hebergement->getTache()->getId() ], Response::HTTP_SEE_OTHER);

    }
}
