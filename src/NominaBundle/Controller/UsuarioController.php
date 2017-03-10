<?php

namespace NominaBundle\Controller;

use NominaBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller {

    /**
     * Lists all usuario entities ordenandolos ascendentemente por nombre
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('NominaBundle:Usuario')->findBy([], ['usuName' => 'ASC']);

        return $this->render('NominaBundle:Usuario:index.html.twig', array(
                    'usuarios' => $usuarios,
        ));
    }

    /**
     * Creates a new usuario entity.
     */
    public function newAction(Request $request) {
        $usuario = new Usuario();
        $form = $this->createForm('NominaBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);
        /*
         * caundo se realiza el submit se validan datos para almacenarlos
         */
        if ($form->isSubmitted() && $form->isValid()) {

            $salary = str_replace(',', '', $usuario->getUsuSalary());
            $usuario->setUsuSalary($salary);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush($usuario);

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('NominaBundle:Usuario:new.html.twig', array(
                    'usuario' => $usuario,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usuario entity.
     *
     */
    public function showAction(Usuario $usuario) {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('NominaBundle:Usuario:show.html.twig', array(
                    'usuario' => $usuario,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuario entity.
     */
    public function editAction(Request $request, Usuario $usuario) {
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('NominaBundle\Form\UsuarioType', $usuario);
        $editForm->handleRequest($request);

        /*
         * validacion de los datos para editarlos
         */
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $salary = str_replace(',', '', $usuario->getUsuSalary());
            $usuario->setUsuSalary($salary);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('NominaBundle:Usuario:edit.html.twig', array(
                    'usuario' => $usuario,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuario entity.
     */
    public function deleteAction(Request $request, Usuario $usuario) {
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }

    /**
     * Eliminar registro de la base de datos mediante ajax
     * @param Request $request
     */
    public function deleteUserAction(Request $request) {
        $data = $request->request->getIterator()->getArrayCopy();

        /*
         * encontrar al usuario del ID entregado
         */
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('NominaBundle:Usuario')->find($data['idUser']);

        $response = ['msn' => '__OK__', 'result' => 'Usuario eliminado exitosamente'];

        /*
         * Eliminar el usuario si se llega a encontar
         */
        if (empty($usuario)) {
            $response = ['msn' => '__KO__', 'result' => 'Usuario eliminado exitosamente'];
        } else {
            $em->remove($usuario);
            $em->flush();
        }

        /*
         * retornar un json como respuesta
         */
        $r = new Response(json_encode($response));
        $r->headers->set('Content-Type', 'application/json');
        return $r;
    }

    /**
     * mostrar el listado de la nomina que se ha de pagar
     * de acuerdo al sueldo del usuario
     * @return type
     */
    public function showNominaAction() {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('NominaBundle:Usuario')->findBy([], ['usuName' => 'ASC']);

        return $this->render('NominaBundle:Usuario:nomina.html.twig', array(
                    'usuario' => $usuario,
        ));
    }

    /**
     * Creates a form to delete a usuario entity.
     *
     * @param Usuario $usuario The usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('usuario_delete', array('id' => $usuario->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
