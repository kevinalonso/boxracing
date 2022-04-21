<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailAnnouncementController extends AbstractController
{
	/**
	* @Route("/announcement/{id}")
	*/
	public function announcement(int $id): Response
    {

        $announcement = $this->getDoctrine()->getRepository(Announcement::class)
            ->getAnnouncementById($id);

        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();
      
    	return $this->render('detail.html.twig', [
            'announcement' => $announcement,
            'categories' => $categories
        ]);
    }
}