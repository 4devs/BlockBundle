<?php

namespace FDevs\BlockBundle\Sonata\Block\Service;

use Doctrine\Common\Persistence\ManagerRegistry;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlockService extends BaseBlockService
{
    /** @var \Doctrine\Common\Persistence\ObjectManager */
    private $manager;
    /** @var  string */
    private $className;

    /**
     * {@inheritDoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $data = $this->getDataById($blockContext->getSetting('id'));

        return $data ? $this->renderResponse(
            $blockContext->getTemplate(),
            ['data' => $data, 'block' => $blockContext->getBlock()],
            $response
        ) : new Response('');
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(['id'])
            ->setOptional(['template'])
            ->setDefaults(['template' => 'FDevsBlockBundle:Default:block.html.twig'])
            ->setAllowedTypes(['id' => 'string', 'template' => 'string']);
    }

    /**
     * get Block Data by Id
     *
     * @param $id
     *
     * @return \FDevs\BlockBundle\Model\Block|null
     */
    public function getDataById($id)
    {
        return $this->manager->getRepository($this->className)->find($id);
    }

    /**
     * set Object Manager
     *
     * @param ManagerRegistry $manager
     * @param string          $className
     *
     * @return $this
     */
    public function setObjectManager(ManagerRegistry $manager, $className)
    {
        $this->manager = $manager;
        $this->className = $className;

        return $this;
    }
}
