<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Entity\Probleme;
use App\Form\ProblemeType;
use App\Form\EditProblemeType;
use App\Repository\TacheRepository;
use App\Repository\ProblemeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/probleme')]
class ProblemeController extends AbstractController
{
    #[Route('/', name: 'app_probleme_index', methods: ['GET'])]
    public function index(ProblemeRepository $problemeRepository): Response
    {
        return $this->render('probleme/index.html.twig', [
            'problemes' => $problemeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_probleme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProblemeRepository $problemeRepository): Response
    {
        $probleme = new Probleme();
        $form = $this->createForm(ProblemeType::class, $probleme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $problemeRepository->save($probleme, true);

            return $this->redirectToRoute('app_probleme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('probleme/new.html.twig', [
            'probleme' => $probleme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_probleme_show', methods: ['GET'])]
    public function show(Probleme $probleme,Request $request): Response
    {
       
        return $this->renderForm('probleme/show.html.twig', [
            'probleme' => $probleme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_probleme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Probleme $probleme, ProblemeRepository $problemeRepository,TacheRepository $tacheRepository): Response
    {
        $form = $this->createForm(EditProblemeType::class, $probleme);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $problemeRepository->save($probleme, true);

            return $this->redirectToRoute('app_probleme_edit', ['id' => $probleme->getId()], Response::HTTP_SEE_OTHER);
        }

        //new Tache 
        $tache = new Tache();
        $tache->setProbleme($probleme);

        $formTache = $this->createFormBuilder($tache)
            ->add('statut')
            ->add('description')
            ->add('date',DateTimeType::class,[
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
               'html5' => true,
               'input'  => 'datetime',
    
               // adds a class that can be selected in JavaScript
               'attr' => ['class' => 'js-datepicker'],
               'placeholder' => 'Date', 
            ])
            ->getForm();
                
        $formTache->handleRequest($request);  
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if ($formTache->isSubmitted() && $formTache->isValid()) {
            $tache->setOwner($user);
            $tacheRepository->save($tache, true);

            return $this->redirectToRoute('app_probleme_edit', ['id' => $probleme->getId()], Response::HTTP_SEE_OTHER);
        }

        //new Tache 

        return $this->renderForm('probleme/edit.html.twig', [
            'probleme' => $probleme,
            'form' => $form,
            'formTache' => $formTache,
        ]);
    }

    #[Route('/{id}', name: 'app_probleme_delete', methods: ['POST'])]
    public function delete(Request $request, Probleme $probleme, ProblemeRepository $problemeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$probleme->getId(), $request->request->get('_token'))) {
            $problemeRepository->remove($probleme, true);
        }

        return $this->redirectToRoute('app_mission_edit', [ 'id' => $probleme->getMission()->getId()], Response::HTTP_SEE_OTHER);

    }
}
