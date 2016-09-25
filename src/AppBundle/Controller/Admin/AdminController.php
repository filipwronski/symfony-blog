<?php
namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller {

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request) {
        return $this->render('admin/index_admin.html.twig');
    }

}
