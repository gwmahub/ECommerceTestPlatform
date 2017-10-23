<?php

namespace User\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function dashboardIndexAction()
    {
        return $this->render('UserBundle:Default:dashboard_index.html.twig');
    }
}
