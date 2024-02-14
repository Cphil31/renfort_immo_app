<?php

namespace App\Controller;

use App\Entity\Forfait;
use App\Form\ForfaitType;
use App\Form\EditForfaitType;
use App\Repository\ForfaitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/forfait')]
class ForfaitController extends AbstractController
{
    #[Route('/', name: 'app_forfait_index', methods: ['GET'])]
    public function index(ForfaitRepository $forfaitRepository): Response
    {
        return $this->render('forfait/index.html.twig', [
            'forfaits' => $forfaitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_forfait_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ForfaitRepository $forfaitRepository): Response
    {
        $forfait = new Forfait();
        $form = $this->createForm(ForfaitType::class, $forfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $forfaitRepository->save($forfait, true);

            return $this->redirectToRoute('app_forfait_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('forfait/new.html.twig', [
            'forfait' => $forfait,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_forfait_show', methods: ['GET'])]
    public function show(Forfait $forfait): Response
    {
        return $this->render('forfait/show.html.twig', [
            'forfait' => $forfait,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_forfait_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Forfait $forfait, ForfaitRepository $forfaitRepository): Response
    {
        $session = $request->getSession();
        $form = $this->createForm(EditForfaitType::class, $forfait);
        $form->handleRequest($request);
        $page = substr($request->headers->get('referer'), 23, -7);
        
               
        if ($form->isSubmitted() && $form->isValid() ) {
            $forfaitRepository->save($forfait, true);
          
            return $this->redirectToRoute('app_tache_edit',["id" => $forfait->getTache()->getId()],Response::HTTP_SEE_OTHER);  
        }


        return $this->renderForm('forfait/edit.html.twig', [
            'forfait' => $forfait,
            'form' => $form,
            'page' => $page,
            
        ]);
    }

    #[Route('/{id}/edit/note/frais', name: 'app_forfait_edit_note_frais', methods: ['GET', 'POST'])]
    public function editNoteDeFrais(Request $request, Forfait $forfait, ForfaitRepository $forfaitRepository): Response
    {
        $session = $request->getSession();
        $form = $this->createForm(EditForfaitType::class, $forfait);
        $form->handleRequest($request);
        $page = substr($request->headers->get('referer'), 23, -7);
        
               
        if ($form->isSubmitted() && $form->isValid() ) {
            $forfaitRepository->save($forfait, true);
            /*
            return $this->redirectToRoute('app_mission_note_index_edit',[
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
            ],Response::HTTP_SEE_OTHER);  
            */
            return $this->renderForm('mission/edit/notedefrais/index.html.twig', [
                
                
            ]);
        }


        return $this->renderForm('forfait/edit.html.twig', [
            'forfait' => $forfait,
            'form' => $form,
            'page' => $page,
            
        ]);
    }

   

 



    #[Route('/{id}', name: 'app_forfait_delete', methods: ['POST'])]
    public function delete(Request $request, Forfait $forfait, ForfaitRepository $forfaitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forfait->getId(), $request->request->get('_token'))) {
            $forfaitRepository->remove($forfait, true);
        }

        return $this->redirectToRoute('app_tache_edit', ['id' => $forfait->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_forfait_note_delete', methods: ['POST'])]
    public function deleteNote(Request $request, Forfait $forfait, ForfaitRepository $forfaitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forfait->getId(), $request->request->get('_token'))) {
            $forfaitRepository->remove($forfait, true);
        }
        
        return $this->redirectToRoute('app_mission_edit', ['id' => $forfait->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }
}
