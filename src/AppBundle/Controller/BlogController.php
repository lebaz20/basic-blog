<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Blog;
use AppBundle\Form\BlogType;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;

/**
 * Blog controller.
 *
 * @Route("/blog")
 */
class BlogController extends Controller {

    /**
     * Lists all Blog entities.
     *
     * @Route("/", name="blog_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction() {
        $grid = $this->get('grid')->setSource(/* $source = */ new Entity('AppBundle:Blog'));

        $showRowAction = new RowAction('View', 'blog_show');
        $showRowAction->setRouteParameters(array('id'));
        $grid->addRowAction($showRowAction);
        
        $editRowAction = new RowAction('Edit', 'blog_edit');
        $editRowAction->setRouteParameters(array('id'));
        $grid->addRowAction($editRowAction);
        // Manage the grid redirection, exports and the response of the controller
        return $grid->getGridResponse('blog/index.html.twig');
    }

    /**
     * Creates a new Blog entity.
     *
     * @Route("/new", name="blog_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $blog = new Blog();
        $form = $this->createForm('AppBundle\Form\BlogType', $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog_show', array('id' => $blog->getId()));
        }

        return $this->render('blog/new.html.twig', array(
                    'blog' => $blog,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Blog entity.
     *
     * @Route("/{id}", name="blog_show")
     * @Method("GET")
     */
    public function showAction(Blog $blog) {
        $deleteForm = $this->createDeleteForm($blog);

        return $this->render('blog/show.html.twig', array(
                    'blog' => $blog,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Blog entity.
     *
     * @Route("/{id}/edit", name="blog_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Blog $blog) {
        $deleteForm = $this->createDeleteForm($blog);
        $editForm = $this->createForm('AppBundle\Form\BlogType', $blog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog_edit', array('id' => $blog->getId()));
        }

        return $this->render('blog/edit.html.twig', array(
                    'blog' => $blog,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Blog entity.
     *
     * @Route("/{id}", name="blog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Blog $blog) {
        $form = $this->createDeleteForm($blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blog);
            $em->flush();
        }

        return $this->redirectToRoute('blog_index');
    }

    /**
     * Creates a form to delete a Blog entity.
     *
     * @param Blog $blog The Blog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Blog $blog) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('blog_delete', array('id' => $blog->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
