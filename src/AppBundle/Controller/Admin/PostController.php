<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Post;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use AppBundle\Form\PostType;
use AppBundle\Form\EditPostType;

class PostController extends Controller
{

    /**
    * @Route("/admin/manage", name="manage")
    */

    public function listPosts(Request $request)
     {
        $posts = $this->getDoctrine()
        ->getRepository('AppBundle:Post')
        ->findAll();

        return $this->render('admin/post/manage.html.twig', array(
            'posts' => $posts
            ));
    }
    

     /**
     * @Route("/admin/create-post", name="createPost")
     */
    public function createPost(Request $request)
    {
        $post = new Post;
        
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           //get data
            $title = $form['title']->getData();
            $content = $form['content']->getData();
            $category = $form['category']->getData();
            $slug = $form['slug']->getData();
            $published = $form['published']->getData();

            $now = new\DateTime('now');

            $post->setTitle($title);
            $post->setContent($content);
            $post->setCategory($category);
            $post->setSlug($slug);
            $post->setCreateDate($now);
            $post->setPublished($published);

            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();

            $this->addFlash(
                'notice',
                'Post Created'
                );

            return $this->redirectToRoute('createPost');
        }


        return $this->render('admin/post/create.html.twig', array('form' => $form->createView()));
    }
    
  


         /**
     * @Route("/admin/edit/{id}", name="edit")
     */
     public function editPost($id, Request $request)
     {
       $post = $this->getDoctrine()
       ->getRepository('AppBundle:Post')
       ->find($id);

       $now = new\DateTime('now');

       $post->setTitle($post->getTitle());
       $post->setContent($post->getContent());
       $post->setCategory($post->getCategory());
       $post->setSlug($post->getSlug());
       $post->setCreateDate($post->getCreateDate());
       $post->setPublished($post->getPublished());
       $post->setModificationDate($now);

       $form = $this->createForm(EditPostType::class, $post);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
           //get data
        $title = $form['title']->getData();
        $content = $form['content']->getData();
        $category = $form['category']->getData();
        $slug = $form['slug']->getData();
        $createDate = $form['createDate']->getData();
        $published = $form['published']->getData();

        $now = new\DateTime('now');

        $em = $this->getDoctrine()->getManager();
        $post =$em->getRepository('AppBundle:Post')->find($id);

        $post->setTitle($title);
        $post->setContent($content);
        $post->setCategory($category);
        $post->setSlug($slug);
        $post->setCreateDate($createDate);
        $post->setPublished($published);

        

        $em->flush();

        $this->addFlash(
            'notice',
            'Post Updated'
            );

        return $this->redirectToRoute('manage');
    }
    return $this->render('admin/post/edit.html.twig', array(
        'todo' => $post,
        'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/delete/{id}", name="delete")
     */
    public function deletePost($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post =$em->getRepository('AppBundle:Post')->find($id);

        $em->remove($post);
        $em->flush();

         $this->addFlash(
            'notice',
            'Post Removed'
            );
         return $this->redirectToRoute('manage');
         
    }


}
