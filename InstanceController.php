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

}
