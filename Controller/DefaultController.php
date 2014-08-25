<?php

namespace FDevs\BlockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction($id)
    {
        $data = $this->get('f_devs_block.service.block')->getDataById($id);
        if (!$data) {
            throw new NotFoundHttpException(sprintf('blog with "%s" not found', $id));
        }
        $blocks = $this->container->getParameter('f_devs_block.predefined_blocks');
        $tpl = $data->getTemplateName() ?: $blocks[$id]['template'];

        return $this->render($tpl, ['data' => $data, 'block' => ['id' => $id]]);
    }
}
