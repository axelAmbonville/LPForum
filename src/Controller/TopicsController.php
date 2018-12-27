<?php

namespace App\Controller;

use App\Entity\Topics;
use App\Form\TopicsType;
use App\Repository\TopicsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/topics")
 */
class TopicsController extends AbstractController
{
    /**
     * @Route("/", name="topics_index", methods="GET")
     */
    public function index(TopicsRepository $topicsRepository): Response
    {
        return $this->render('topics/index.html.twig', ['topics' => $topicsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="topics_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $topic = new Topics();
        $form = $this->createForm(TopicsType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $datetime = new \DateTime('now');

            $topic->setTopicDatetime($datetime);
            $em->persist($topic);
            $em->flush();

            return $this->redirectToRoute('topics_index');
        }

        return $this->render('topics/new.html.twig', [
            'topic' => $topic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="topics_show", methods="GET")
     */
    public function show(Topics $topic): Response
    {
        return $this->render('topics/show.html.twig', ['topic' => $topic]);
    }

    /**
     * @Route("/{id}/edit", name="topics_edit", methods="GET|POST")
     */
    public function edit(Request $request, Topics $topic): Response
    {
        $form = $this->createForm(TopicsType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('topics_index', ['id' => $topic->getId()]);
        }

        return $this->render('topics/edit.html.twig', [
            'topic' => $topic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="topics_delete", methods="DELETE")
     */
    public function delete(Request $request, Topics $topic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$topic->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($topic);
            $em->flush();
        }

        return $this->redirectToRoute('topics_index');
    }
}
