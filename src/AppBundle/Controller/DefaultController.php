<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
    * @Route("/blog", name="blog")
    */

    public function ListBloglogAction(Request $request)
    {
        $posts = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findAll();


        return $this->render('blog/index_blog.html.twig', array(
            'posts' => $posts
            ));
    }

    /**
     * @Route("/blog/details/{id}", name="post_details")
     */
    public function detailsAction($id)
    {
        $post = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->find($id);

        
        return $this->render('blog/details.html.twig', array(
            'post' => $post
            ));
    }

}
