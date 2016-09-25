<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;

class CategoryController extends Controller {

    /**
     * @Route("/admin/manage-category", name="manageCategory")
     */
    public function listCategories(Request $request) {
        $categories = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findAll();

        return $this->render('admin/category/manage-category.html.twig', array(
                    'categories' => $categories
        ));
    }

    /**
     * @Route("/admin/create-category", name="createCategory")
     */
    public function createCategory(Request $request) {
        $category = new Category;

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                    'notice', 'Category created'
            );
        }
        return $this->render('admin/category/create-category.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/admin/edit-category/{id}", name="editCategory")
     */
    public function editCategory($id, Request $request) {
        $category = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->find($id);

        $category->setName($category->getName());

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() & $form->isValid()) {
            
            $name = $form['name']->getData();
            
            $em = $this->getDoctrine()->getManager();
            $category = $em->getRepository('AppBundle:Category')->find($id);
            
            $category->setName($name);
            $em->flush();

            $this->addFlash(
                    'notice', 'Category edited'
            );

            return $this->redirectToRoute('manageCategory');
        }
        return $this->render('admin/post/create.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route("/admin/delete-category/{id}", name="deleteCategory")
     */
    public function deleteCategory($id) {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->find($id);
        
        $em->remove($category);
        $em->flush();
        
        $this->addFlash(
                'notice',
                'Category Removed'
                );
        return $this->redirectToRoute('manageCategory');
    }

}
