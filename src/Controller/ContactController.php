<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Category;

class ContactController extends AbstractController
{
 
	/**
	* @Route("/contact")
	*/
	public function contact(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();

        return $this->render('contact.html.twig', [
            'categories' => $categories
        ]);
    }

    /** 
   * @Route("/sendmail") 
    */ 
    public function sendMail(Request $request, \Swift_Mailer $mailer)
    {
        $email = $request->request->get('email');
        $name = $request->request->get('name');
        $obj = $request->request->get('obj');
        $msg = $request->request->get('msg');
        $pj = $request->request->get('pj');

        $message = (new \Swift_Message($obj))
            ->setFrom($email)
            ->setTo('k.alonso@iia-lava.fr')
            ->setBody($msg)
            ->attach(\Swift_Attachment::fromPath($pj));

        $mailer->send($message);
        
        return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }

}