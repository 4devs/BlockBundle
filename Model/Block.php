<?php

namespace FDevs\BlockBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use FDevs\PageBundle\Model\LocaleText;
use FDevs\PageBundle\Model\Page;

class Block extends Page
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $content;

    /**
     * init
     */
    public function __construct()
    {
        parent::__construct();
        $this->content = new ArrayCollection();
    }

    /**
     * get Content
     *
     * @return LocaleText[]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * set Content
     *
     * @param LocaleText[] $content
     *
     * @return $this
     */
    public function setContent(array $content)
    {
        $this->content = new ArrayCollection();
        foreach ($content as $data) {
            $this->addContent($data);
        }

        return $this;
    }

    /**
     * add Content
     *
     * @param LocaleText $text
     *
     * @return $this
     */
    public function addContent(LocaleText $text)
    {
        $this->content[] = $text;

        return $this;
    }

    /**
     * Remove name
     *
     * @param \FDevs\PageBundle\Model\LocaleText $text
     */
    public function removeContent(LocaleText $text)
    {
        $this->content->removeElement($text);
    }

    /**
     * get Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set Id
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
