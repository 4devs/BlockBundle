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

    /** @var array */
    private $predefinedBlocks = [];

    /** @var string */
    private $defaultTemplate = 'FDevsBlockBundle:Default:block.html.twig';

    /**
     * {@inheritDoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $id = $blockContext->getSetting('id');
        $data = $this->getDataById($id);
        $template = $blockContext->getTemplate();

        if ($template == $this->defaultTemplate && !empty($this->predefinedBlocks[$id])) {
            $template = $this->predefinedBlocks[$id]['template'];
        }

        return $data
            ? $this->renderResponse($template, ['data' => $data, 'block' => $blockContext->getBlock()], $response)
            : new Response('');
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(['id'])
            ->setOptional(['template'])
            ->setDefaults(['template' => $this->defaultTemplate])
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
     * set Predefined Blocks
     *
     * @param array $predefinedBlocks
     *
     * @return self
     */
    public function setPredefinedBlocks(array $predefinedBlocks = [])
    {
        $this->predefinedBlocks = $predefinedBlocks;

        return $this;
    }

    /**
     * set Default Template
     *
     * @param string $defaultTemplate
     *
     * @return self
     */
    public function setDefaultTemplate($defaultTemplate)
    {
        $this->defaultTemplate = $defaultTemplate;

        return $this;
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
