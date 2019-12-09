<?php

namespace AppBundle\Controller;

use AppBundle\Entity\event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Event controller.
 *
 * @Route("event")
 */
class eventController extends Controller
{
    /**
     * Lists all event entities.
     *
     * @Route("/", name="event_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:event')->findAll();

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     * @Route("/new", name="event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('AppBundle\Form\eventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/{id}", name="event_show")
     * @Method("GET")
     */
    public function showAction(event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/{id}/edit", name="event_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('AppBundle\Form\eventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
   
    
        /**
     * Deletes a event entity.
     *
     * @Route("/event/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }
     

    /**
     * Creates a form to delete a event entity.
     *
     * @param event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
     /**
     * Lists all event by category.
     *
     * @Route("/filter/{eventType}", name="event_category")
     * @Method("GET")
     */
    public function filterAction($eventType)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:event')->findBy(array('eventType' => $eventType));

        return $this->render('event/index.html.twig', array(
            'events' => $events,
        ));
    }
    
    
# Versuch Filter zu machen:
    
//    public function filterAction() {
//        $form2 = $this->createFormBuilder(null)
//            ->add('filter', ChoiceType::class, array('choices'=>array('Music'=>'Music', 'Sport'=>'Sport', 'Exhibition'=>'Exhibition', 'Movie'=>'Movie', 'Theater'=>'Theater' ),'attr' => array('class'=> 'form-control', 'style'=>'margin-botton:15px')))
//        ->get Form();
//    
//    return $this->render('AppBundle:Post:SearchBar', ['form' => $form->createView()]);    
//    
//    }
    
}
