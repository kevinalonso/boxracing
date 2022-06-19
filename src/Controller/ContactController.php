<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        $destination = $this->getParameter('kernel.project_dir').'/templates/attachment';
        $extension = pathinfo($_FILES['pj']["name"], PATHINFO_EXTENSION);
        $fileName = basename($_FILES['pj']["name"], ".".$extension);

        $uploadedFile = $_FILES['pj']["tmp_name"];
        move_uploaded_file($uploadedFile, $destination."/".$request->files->get('pj')->getFilename());
        rename($destination."/".$request->files->get('pj')->getFilename(), $destination."/".$fileName.".".$extension);

        $message = (new \Swift_Message($obj))
            ->setFrom($email)
            ->setTo('k.alonso@iia-lava.fr')
            ->setBody($msg)
            ->attach(\Swift_Attachment::fromPath($destination."/".$fileName.".".$extension));

        $mailer->send($message);
        
        //Supprime le fichier une fois le mail envoyé
        unlink($destination."/".$fileName.".".$extension);
        
        return new JsonResponse(array(
            'status' => 'OK',
        ),
        200);
    }

}