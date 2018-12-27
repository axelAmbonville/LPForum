<?php

namespace App\Controller;

use App\Entity\Sections;
use App\Repository\SectionsRepository;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Entity\Topics;
use App\Repository\TopicsRepository;
use App\Entity\Posts;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/view")
 */
class DisplayController extends AbstractController
{
    /**
     * @Route("/sections", name="sections_display")
     */
    public function index(SectionsRepository $sections)
    {
       $sections = $sections ->findAll();
        return $this->render('display/sections.html.twig', [
            'sections' => $sections,
        ]);
    }

    /**
     * @Route("/categories/{cat_section_id}", name="categories_display")
     */
    public function categories(SectionsRepository $sections, CategoriesRepository $categories, $cat_section_id)
    {
        $categories_finded = $categories ->findBy(array('cat_section'=>$cat_section_id));
        $section=$sections->find($cat_section_id);

        return $this->render('display/categorie.html.twig', [
            'section'=>$section,
            'categories' => $categories_finded,
        ]);
    }

    /**
     * @Route("/topics/{topics_cat_id}", name="topics_display")
     */
    public function topics(CategoriesRepository $categories, TopicsRepository $topics, $topics_cat_id)
    {
        $topics_finded = $topics ->findBy(array('topics_cat'=>$topics_cat_id));
        $categorie=$categories->find($topics_cat_id);
        return $this->render('display/topics.html.twig', [
            'categorie'=>$categorie,
            'topics' => $topics_finded,
        ]);
    }

    /**
     * @Route("/posts/{posts_topic_id}", name="posts_display")
     */
    public function posts(TopicsRepository $topics, PostsRepository $posts, $posts_topic_id)
    {
        $posts_finded = $posts ->findBy(array('posts_topic'=>$posts_topic_id));
        $topic=$topics->find($posts_topic_id);
        return $this->render('display/posts.html.twig', [
            'topic'=>$topic,
            'posts' => $posts_finded,
        ]);
    }
}
