<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Document\Game;
use AppBundle\Form\GameType;

/**
 * Game controller.
 *
 * @Route("/admin/game")
 */
class GameController extends Controller
{
    /**
     * Lists all Game documents.
     *
     * @Route("/", name="game")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $dm = $this->getDocumentManager();

        $documents = $dm->getRepository('AppBundle:Game')->findAll();

        return array('documents' => $documents);
    }

    /**
     * Displays a form to create a new Game document.
     *
     * @Route("/new", name="game_new")
     * @Template()
     *
     * @return array
     */
    public function newAction()
    {
        $document = new Game();
        $form = $this->createForm('AppBundle\Form\GameType', $document);

        return array(
            'document' => $document,
            'form'     => $form->createView()
        );
    }

    /**
     * Creates a new Game document.
     *
     * @Route("/create", name="game_create")
     * @Method("POST")
     * @Template("AppBundle:Game:new.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function createAction(Request $request)
    {
        $document = new Game();
        $form     = $this->createForm('AppBundle\Form\GameType', $document);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('game_show', array('id' => $document->getId())));
        }

        return array(
            'document' => $document,
            'form'     => $form->createView()
        );
    }

    /**
     * Finds and displays a Game document.
     *
     * @Route("/{id}/show", name="game_show")
     * @Template()
     *
     * @param string $id The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function showAction($id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('AppBundle:Game')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Game document.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Game document.
     *
     * @Route("/{id}/edit", name="game_edit")
     * @Template()
     *
     * @param string $id The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function editAction($id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('AppBundle:Game')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Game document.');
        }

        $editForm = $this->createForm('AppBundle\Form\GameType', $document);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Game document.
     *
     * @Route("/{id}/update", name="game_update")
     * @Method("POST")
     * @Template("AppBundle:Game:edit.html.twig")
     *
     * @param Request $request The request object
     * @param string $id       The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function updateAction(Request $request, $id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('AppBundle:Game')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Game document.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm('AppBundle\Form\GameType', $document);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('game_edit', array('id' => $id)));
        }

        return array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Game document.
     *
     * @Route("/{id}/delete", name="game_delete")
     * @Method("POST")
     *
     * @param Request $request The request object
     * @param string $id       The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $document = $dm->getRepository('AppBundle:Game')->find($id);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Game document.');
            }

            $dm->remove($document);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('game'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', HiddenType::class)
            ->getForm()
        ;
    }

    /**
     * Returns the DocumentManager
     *
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
