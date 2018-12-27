<?php
/**
 * Created by PhpStorm.
 * User: axela
 * Date: 21/11/2018
 * Time: 08:23
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\SectionsRepository;



class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(SectionsRepository $sections)
    {
        $sections = $sections->findAll();
        return $this->render('public/home.html.twig', array('sections'=>$sections));
    }
}