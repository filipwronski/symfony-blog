<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {

    /**
     * @Route("/category/{categorySlug}", name="categories")
     */
    public function displayCategoryPosts(Request $request, $categorySlug) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                        "SELECT p "
                        . "FROM AppBundle:Post p JOIN p.category c "
                        . "WHERE c.slug = :slug"
                )->setParameter('slug', $categorySlug);
        $post = $query->getResult();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $post, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 4/* limit per page */
        );

        return $this->render('blog/index_blog.html.twig', array(
                    'post' => $post,
                    'pagination' => $pagination
        ));
    }

    public function listCategories(Request $request) {
        $categories = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findAll();

        return $categories;
    }

}
