<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    // DEPRECATION WARNING: $this->getDoctrine() 
    // ----------------------------------------
    // Instead of using those shortcuts, inject the related services in the constructor
    // or the controller methods.
    // Recover from: https://symfony.com/blog/new-in-symfony-5-4-controller-changes
    public function __construct(ManagerRegistry $doctrine) {}

    /**
     * @Route("/product", name="create_product", methods="post")
     */
    public function createProduct(Request $request):Response{

        $data = $request->getContent();
        $content = json_decode($data);
        $product_stdClass = $content->product;

        // syfony version < v5: $em = $this->getDoctrine()->getManager();
        $em = $this->doctrine->getManager();
                
        $product = new Product();
        $product->setName($product_stdClass->name);
        $product->setPrice($product_stdClass->price);
        $product->setDescription("Ergonomic and stylish!");

        $em->persist($product);
        $em->flush();

        $result = [
            'name'=>$product->getName(),
            'price'=>$product->getPrice()
        ];
        return $this->json([
           $result
        ]);
    }

    /**
     * @Route("/product", name="product", methods="get")
     */
    public function index(): Response
    {
        $products =  $this->doctrine->getRepository(Product::class)->findAll();

        $data = [];

        foreach ($products as $product){
            $tmp =[
               "name" =>  $product->getName(),
                "price" => $product->getPrice(),
                "description" => $product->getDescription()
            ];
            $data[] = $tmp;
        }

        return $this->json([
            'message' => 'Welcome to the jungle!',
            'products' => $data,
        ]);
    }


    /**
     * @Route("/product/{id}", name="product-id", methods="get", requirements={"id": "\d+"})
     */
    public function findById($id){

        $product = $this->doctrine->getRepository(Product::class)->find($id);

        $data = [
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "description" => $product->getDescription()
        ];

        return $this->json([
            $data
        ]);
    }

    /**
     * @Route("/product/{name}", name="product-name", methods="get")
     */
    public function findByName($name){

        $products = $this->doctrine->getRepository(Product::class)->findBy([
            "name" => $name
        ]);

        $result =  [];
       foreach ($products as $product){
            $data = [
                "name" => $product->getName(),
                "price" => $product->getPrice(),
                "description" => $product->getDescription()
            ];
           $result[] =$data;
        }

        return $this->json([
            $result
        ]);
    }


    /**
     * @Route("/product/{id}", name="product-update", methods="put")
     */
    public function productUpdate($id, Request $request){

        // syfony version < v5: $em = $this->getDoctrine()->getManager();
        $em = $this->doctrine->getManager();

        $data = $request->getContent();
        $content = json_decode($data);
        $product_stdClass = $content->product;

        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $product->setName($product_stdClass->name);
        $product->setPrice($product_stdClass->price);
        $product->setDescription($product_stdClass->description);

        $em->flush();

        return $this->json([
            "message" => "Product update",
            $product_stdClass
        ]);
    }

    /**
     * @Route("/product/{id}", name="product-delete", methods="delete")
     */
    public function productDelete($id){

        $em = $this->doctrine->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $em->remove($product);
        $em->flush();

        return $this->json([
            "message" =>"Product deleted"
        ]);
    }






























}
