<?php

namespace App\Controller;

use App\Entity\Qcm;
use App\Form\QcmType;
use App\Repository\QcmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/qcm')]
class QcmController extends AbstractController
{
    #[Route('/', name: 'app_qcm_index', methods: ['GET'])]
    public function index(QcmRepository $qcmRepository): Response
    {
        return $this->render('qcm/index.html.twig', [
            'qcms' => $qcmRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_qcm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QcmRepository $qcmRepository): Response
    {
        //dd();
        $qcm = new Qcm();
        $form = $this->createForm(QcmType::class, $qcm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($this->getUser() != null)
            {
                $qcm->setIdUser($this->getUser());
            }
            $qcmRepository->add($qcm, true);

            return $this->redirectToRoute('app_qcm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('qcm/new.html.twig', [
            'qcm' => $qcm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_qcm_show', methods: ['GET'])]
    public function show(Qcm $qcm): Response
    {
        return $this->render('qcm/show.html.twig', [
            'qcm' => $qcm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_qcm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Qcm $qcm, QcmRepository $qcmRepository): Response
    {
        $form = $this->createForm(QcmType::class, $qcm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $qcmRepository->add($qcm, true);

            return $this->redirectToRoute('app_qcm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('qcm/edit.html.twig', [
            'qcm' => $qcm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_qcm_delete', methods: ['POST'])]
    public function delete(Request $request, Qcm $qcm, QcmRepository $qcmRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qcm->getId(), $request->request->get('_token'))) {
            $qcmRepository->remove($qcm, true);
        }

        return $this->redirectToRoute('app_qcm_index', [], Response::HTTP_SEE_OTHER);
    }
}
