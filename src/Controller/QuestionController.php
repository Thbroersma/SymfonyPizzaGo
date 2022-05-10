<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Repository\CategoryRepository;
use App\Repository\OrderRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     **/
    public function homepage(EntityManagerInterface $em)
    {
        $slug = [
            'pizza_vlees',
            'pizza_vega',
            'pizza_vis',
        ];
        $repository = $em->getRepository(Category::class);
        /** @var Category $category */
        $categories = $repository->findAll();

        return $this->render('question/homepage.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/pizza/{id}", name="app_cat")
     **/
    public function pizza(Category $category, PizzaRepository $pizzaRepository) {

        $pizza = $pizzaRepository->findBy(['Article' => $category]);
        return $this->render('question/pizza.html.twig', [
            'id' => $category,
            'pizzas' => $pizza
        ]);

    }
    /**
     * @Route("/order/{id}", name="app_order")
     **/
    public function order(EntityManagerInterface $em, Request $request, $id) {


        $pizza = $em->getRepository(Pizza::class)->find($id);
        $order = new Order();

        $form = $this->createForm(\FormNEw::class, $order);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$data = $order->getData();
            $order=$form->getData();
            $order->setPizza($pizza);
            $order->setStatus("Uw bestelling is geplaatst");
            $em->persist($order);
            $em->flush();

            return $this->redirectToRoute("app_homePizza");
        }

        return $this->render('question/order.html.twig', [
           'orderForm' => $form->createView(),
            'pizza' => $pizza,

        ]);

    }
    /**
     * @Route("/pizzaTotal", name="app_homePizza")
     **/
    public function totalpizza(EntityManagerInterface $em/*, Pizza $pizza, OrderRepository $orderRepository*/)
    {
        /*
        public function pizza(Category $category, PizzaRepository $pizzaRepository) {

        $pizza = $pizzaRepository->findBy(['Article' => $category]);
        return $this->render('question/pizza.html.twig', [
            'id' => $category,
            'pizzas' => $pizza
        ]);*/
        /*
                $order = $orderRepository->findBy(['pizza' => $pizza]);
                */
        $repository = $em->getRepository(Order::class);
        /** @var Order $category */
        $orders = $repository->findAll();

        return $this->render('question/totalpizza.html.twig', [
            /*'id' => $pizza,*/
            'orders' => $orders
        ]);
    }
}