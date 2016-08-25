<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Document\Game;
use AppBundle\Form\GameType;

class DefaultController extends Controller
{
    /**
     * Returns the DocumentManager
     *
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $dm = $this->getDocumentManager();

        $documents = $dm->getRepository('AppBundle:Game')->findAll();
        
        $test = $documents;
        // replace this example code with whatever you need
        return $this->render
        (
            'default/index.html.twig', 
            array
            (
                'test' => $test,
            )
        );
    }
}
