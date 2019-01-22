<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController{

    public function index()
    {
        return $this->render('Product/list.html.twig', ['param' => 'Hey miszczu']);
    }
    
}
