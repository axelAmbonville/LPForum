<?php

namespace App\Controller;

use App\Entity\Sections;
use App\Form\SectionsType;
use App\Repository\SectionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sections")
 */
class SectionsController extends AbstractController
{
    /**
     * @Route("/", name="sections_index", methods="GET")
     */
    public function index(SectionsRepository $sectionsRepository): Response
    {
        return $this->render('sections/index.html.twig', ['sections' => $sectionsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="sections_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $section = new Sections();
        $form = $this->createForm(SectionsType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $datetime = new \DateTime('now');

            $section->setSecDatetime($datetime);
            $em->persist($section);
            $em->flush();

            return $this->redirectToRoute('sections_index');
        }

        return $this->render('sections/new.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sections_show", methods="GET")
     */
    public function show(Sections $section): Response
    {
        return $this->render('sections/show.html.twig', ['section' => $section]);
    }

    /**
     * @Route("/{id}/edit", name="sections_edit", methods="GET|POST")
     */
    public function edit(Request $request, Sections $section): Response
    {
        $form = $this->createForm(SectionsType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sections_index', ['id' => $section->getId()]);
        }

        return $this->render('sections/edit.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sections_delete", methods="DELETE")
     */
    public function delete(Request $request, Sections $section): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($section);
            $em->flush();
        }

        return $this->redirectToRoute('sections_index');
    }
}
