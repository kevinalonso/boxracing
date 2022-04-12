<?php
/**
 * Class CartSubscriber
 * @package App\EventSubscriber
 *
 *  Représente le Listener écoutant l'événement 'kernel.controller'.
 *
 */
namespace App\Controller;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TwigSubscriber extends AbstractController implements EventSubscriberInterface {
 
 
    private $environment;

     
    public function __construct(Environment $environment) {
        $this->environment = $environment;
    }
 
    /**
     * Injection de la variable globale carts à Twig
     *
     * @param ControllerEvent $event
     */
    public function onKernelController(ControllerEvent $event) {

        $menu = $this->getDoctrine()->getRepository(Category::class)
            ->allCategories();
        $this->environment->addGlobal('menu', $menu);
    }
 
    /**
     *
     * @return array
     */
    public static function getSubscribedEvents(): array {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}