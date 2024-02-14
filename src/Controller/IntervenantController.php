<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Entity\Intervenant;
use App\Form\IntervenantType;
use App\Form\NewIntervenantTacheType;
use App\Form\EditIntervenantTacheType;
use App\Form\IntervenantEditProduitType;
use App\Repository\IntervenantRepository;
use App\Repository\TacheRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/intervenant')]
class IntervenantController extends AbstractController
{
    #[Route('/', name: 'app_intervenant_index', methods: ['GET'])]
    public function index(IntervenantRepository $intervenantRepository): Response
    {
        return $this->render('intervenant/index.html.twig', [
            'intervenants' => $intervenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_intervenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, IntervenantRepository $intervenantRepository): Response
    {
        $intervenant = new Intervenant();
        $form = $this->createForm(IntervenantType::class, $intervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intervenantRepository->save($intervenant, true);

            return $this->redirectToRoute('app_intervenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervenant/new.html.twig', [
            'intervenant' => $intervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intervenant_show', methods: ['GET'])]
    public function show(Intervenant $intervenant): Response
    {
        return $this->render('intervenant/show.html.twig', [
            'intervenant' => $intervenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_intervenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Intervenant $intervenant, IntervenantRepository $intervenantRepository): Response
    {

       
        if($intervenant->getTache())
        {
            $form = $this->createForm(NewIntervenantTacheType::class, $intervenant);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $intervenant->setTache($intervenant->getTache());
                $intervenantRepository->save($intervenant, true);
    
                return $this->redirectToRoute('app_tache_edit', ['id' => $intervenant->getTache()->getId()], Response::HTTP_SEE_OTHER);
            }


        }
        else
        {
           
        }



        return $this->renderForm('intervenant/edit.html.twig', [
            'intervenant' => $intervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit/pdf', name: 'app_fiche_intervenant_pdf', methods: ['GET', 'POST'])]
    public function pdf (Request $request, Intervenant $intervenant,TacheRepository $tacheRepository) {

        $form = $this->createForm(NewIntervenantTacheType::class, $intervenant);
        $form->handleRequest($request);
        
        
        /*
        $html = $this->renderView('intervenant/edit/fichePdf.html.twig', [
            'intervenant'=> $intervenant,
            'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'),
            
        ]);
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html) ;
        
        // Set the base path for the PDF
        $dompdf->setBasePath($this->getParameter('kernel.project_dir') . '/public');
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
        $dompdf->stream("Fiche intervenant de "." Tâche : ".$intervenant->getTache()->getDescription() , ["Attachment" => false ]);
        */

        return $this->renderForm('intervenant/edit/fichePdf.html.twig', [
            'intervenant'=> $intervenant,
            'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'),
            //'form'=>$form,
        ]);
        
    }
    
    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    #[Route('/{id}', name: 'app_intervenant_delete', methods: ['POST'])]
    public function delete(Request $request, Intervenant $intervenant, IntervenantRepository $intervenantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervenant->getId(), $request->request->get('_token'))) {
            $intervenantRepository->remove($intervenant, true);
        }
       
        return $this->redirectToRoute('app_tache_edit', ['id' => $intervenant->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }
}
