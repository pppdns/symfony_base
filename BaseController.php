<?php

namespace Pppdns\GeneralBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;

abstract class BaseController extends FOSRestController implements ClassResourceInterface {

    protected $em;
    protected $repository;
    protected $bundleName = "PppdnsGeneralBundle";
    public    $entityName;


    // CREATE
    public function postAction() {
        $entity = $this->getNewEntity();
        return $this->saveAction($entity);
    }

    // READ
    public function getAction($id) {
        $entity = $this->getRepository()->find($id);
        return $this->handleView($this->view($entity));
    }

    // READ
    public function cgetAction() {
        $entities = $this->getRepository()->findAll();
        return $this->handleView($this->view($entities));
    }

    // UPDATE
    public function patchAction($id) {
        $entity = $this->getRepository()->find($id);
        return $this->saveAction($entity);
    }

    // UPDATE
    public function putAction($id) {
        $entity = $this->getRepository()->find($id);
        return $this->saveAction($entity);
    }

    // DELETE
    public function deleteAction($id) {
        $entity = $this->getRepository()->find($id);
        $this->getEm()->remove($entity);
        $this->getEm()->flush();
        return $this->handleView($this->view(null, 204));
    }

    // ------------------------------------------------------


    protected function saveAction($entity) {
        $view = $this->view();
        $form = $this->createForm($this->getNewForm(), $entity);

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();
            $view->setData($entity);
        }
        else {
            $view->setData($form->getErrors());
//            $view->setData($this->get('validator')->validate($entity));
            $view->setStatusCode(400);
        }
        return $this->handleView($view);
    }

    protected function getRepository() {
        return $this->getDoctrine()->getRepository($this->bundleName.':'.$this->getEntityName());
    }
    protected function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        }
        return $this->em;
    }
    protected function getEntityName() {
        return $this->entityName;
    }

    abstract protected function getNewEntity();
    abstract protected function getNewForm();

    public static function freeSession() {
        //We free session lock as no more session modifications will happen in the next actions !
        $session = $this->getRequest()->getSession();
        $session->save();
        session_write_close();
    }
}
