<?php

namespace FDevs\BlockBundle\Sonata\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class BlockAdmin extends Admin
{
    /** @var array */
    private $predefinedBlocks = [];

    /**
     * set Predefined Blocks
     *
     * @param array $blocks
     *
     * @return $this
     */
    public function setPredefinedBlocks(array $blocks = [])
    {
        $this->predefinedBlocks = $blocks;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $options = [];
        $formMapper->with('form.group_block_content', ['translation_domain' => 'FDevsBlockBundle']);

        if ($subject->getId()) {
            $options['read_only'] = true;
            $formMapper->add('id', 'text', $options);
        } else {
            $options['choices'] = $this->getChoices();
            $formMapper->add('id', 'choice', $options);
        }

        $formMapper
            ->add('title', 'trans_text')
            ->add('content', 'trans_textarea', ['type' => 'ckeditor'])
            ->end();

    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('delete');
        if (!count($this->getChoices())) {
            $collection->remove('create');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('id');
    }

    /**
     * get Choices
     *
     * @return array
     */
    private function getChoices()
    {
        $data = $this->getModelManager()->findBy($this->getClass());
        $exist = [];
        foreach ($data as $value) {
            $id = $value->getId();
            if (isset($this->predefinedBlocks[$id])) {
                $exist[$id] = true;
            }
        }

        $choices = array_map(
            function ($val) {
                return $this->trans($val['label']);
            },
            $this->predefinedBlocks
        );

        return array_diff_key($choices, $exist);
    }
}
