<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Entity\Qcm;
use App\Entity\Question;
use App\Form\AnswersType;
use App\Form\QcmType;
use App\Form\QuestionType;
use App\Repository\AnswersRepository;
use App\Repository\QcmRepository;
use App\Repository\QuestionRepository;
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

    #[Route('/new', name: 'app_qcm_new', methods: ['GET', 'gitPOST'])]
    public function new(Request $request, QcmRepository $qcmRepository, QuestionRepository $questionRepository, AnswersRepository $answersRepository): Response
    {
        //dd();
        $qcm = new Qcm();
        $question = new Question();
        $answers = new Answers();
        $form1 = $this->createForm(QcmType::class, $qcm);
        $form2 = $this->createForm(QuestionType::class, $question);
        $form3 = $this->createForm(AnswersType::class, $answers);
        $form1->handleRequest($request);


        if ($form1->isSubmitted() && $form1->isValid()) {
            if($this->getUser() != null)
            {
                $entityManager = $this->getDoctrine()->getManager();
                $qcm->setIdUser($this->getUser());

                $entityManager->persist($qcm);
                $entityManager->flush();
            }
            $qcmRepository->add($qcm, true);

            return $this->redirectToRoute('app_qcm_index', [], Response::HTTP_SEE_OTHER);
        }
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $questionRepository->add($question, true);

            $entityManager->persist($question);
            $entityManager->flush();


            return $this->redirectToRoute('app_qcm_index', [], Response::HTTP_SEE_OTHER);
        }

        $form3->handleRequest($request);
        if ($form3->isSubmitted() && $form3->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $answersRepository->add($answers, true);

            $entityManager->persist($question);
            $entityManager->flush();
            $answersRepository->add($answers, true);

            return $this->redirectToRoute('app_qcm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('qcm/new.html.twig', [

            'form1' => $form1,
            'form2' => $form2,
            'form3' => $form3,
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
