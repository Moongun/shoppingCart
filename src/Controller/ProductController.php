<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Form\ProductType;

class ProductController extends AbstractController {

    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $products = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('Product/index.html.twig', ['products' => $products ]);
    }
    
    public function create(Request $request)
    {
        $product = new Product();
        
        $form = $this->createForm(ProductType::class, $product);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            
            try {
                $entityManager->persist($product);
                $entityManager->flush();    
            } catch (Exception $ex) {
                throw $ex->message();
            }
            return $this->redirectToRoute('product_index');
        }

        return $this->render('Product/edit.html.twig', ['form' => $form->createView()]);
    }
    
    public function edit(Request $request, $id) 
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
        
        if(!$product) {
            throw $this->createNotFoundException("Not found product with id: $id");
        }
        
        $form = $this->createForm(ProductType::class, $product);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            
            try {
                $entityManager->persist($product);
                $entityManager->flush();    
            } catch (Exception $ex) {
                throw $ex->message();
            }
            return $this->redirectToRoute('product_index');
        }
        
        return $this->render('Product/edit.html.twig', ['form' => $form->createView()]);
    }
    
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(Product::class)->find($id);

        if(!$product) {
            throw $this->createNotFoundException("Not found product with id: $id");
        }
        
        $entityManager->remove($product);
        $entityManager->flush();
        
        $this->redirectToRoute('product_index', []);
    }
}
