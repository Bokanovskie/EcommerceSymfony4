<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    public function dashboardAction(Request $request)
    {
        return $this->render('/admin/dashboard.html.twig');
    }
}