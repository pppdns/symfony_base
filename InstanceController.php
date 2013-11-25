<?php

namespace Pppdns\GeneralBundle\Controller;

use Pppdns\GeneralBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Pppdns\GeneralBundle\Entity\Instance;
use Pppdns\GeneralBundle\Form\InstanceType;

class InstanceController extends BaseController
{
    public $entityName = 'Instance';
    protected function getNewEntity() { return new Instance(); }
    protected function getNewForm() { return new InstanceType(); }



    public function getAction(Instance $entity) {
        return parent::_getAction($entity);
    }

    public function cgetAction() {
        return parent::_cgetAction();
    }

    public function postAction() {
        return parent::_postAction();
    }

    public function patchAction() {
        return parent::_patchAction();
    }

    public function putAction() {
        return parent::_putAction();
    }

    public function deleteAction(Instance $entity) {
        return parent::_deleteAction($entity);
    }

}
