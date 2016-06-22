<?php

namespace FDevs\BlockBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FDevs\Locale\Model\LocaleText;

class Block
{
    /**
     * @var string
     */
    protected $id;

    /** @var Collection|LocaleText[] */
    protected $content;

    /** @var Collection|LocaleText[] */
    protected $title;

    /**
     * init.
     */
    public function __construct()
    {
        $this->content = new ArrayCollection();
        $this->title = new ArrayCollection();
    }

    /**
     * get Content.
     *
     * @return LocaleText[]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * set Content.
     *
     * @param Collection|array|LocaleText[] $content
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
     * add Content.
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
     * Remove name.
     *
     * @param LocaleText $text
     */
    public function removeContent(LocaleText $text)
    {
        $this->content->removeElement($text);
    }

    /**
     * get Id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set Id.
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

    /**
     * @return Collection|\FDevs\Locale\Model\LocaleText[]
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * set Title.
     *
     * @param Collection|array|LocaleText[] $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = new ArrayCollection();
        foreach ($title as $text) {
            $this->addTitle($text);
        }

        return $this;
    }

    /**
     * add title.
     *
     * @param LocaleText $text
     *
     * @return $this
     */
    public function addTitle(LocaleText $text)
    {
        $this->title->add($text);

        return $this;
    }
}
