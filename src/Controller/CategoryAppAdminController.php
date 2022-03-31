<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryAppAdminController extends AbstractController
{
    /**
     * @Route("/admin/categories/new")
     */
    public function new(EntityManagerInterface $em) {
        $category = new Category();
        $category->setTitle("Vlees   pizza")
            ->setSlug("pizza_vlees");

            if(rand(1, 10) > 2) {
                $category->setPublisedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
            }

            $em->persist($category);
            $em->flush();

        return new Response(sprintf(
            'Hiya! New category id #%d slug: %s',
            $category->getId(),
            $category->getSlug()
        ));
    }

}