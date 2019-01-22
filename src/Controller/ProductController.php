<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProductController {

    public function listAction()
    {
        return new Response ('<html><body>hello word</body></html>');
    }
    
}
