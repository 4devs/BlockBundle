<?php

namespace FDevs\BlockBundle\Tests\Model;

use FDevs\BlockBundle\Model\Block;
use FDevs\PageBundle\Model\LocaleText;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlockTest extends WebTestCase
{

    public function testContent()
    {
        $model = $this->createModel();
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $model->getContent());
        $this->assertCount(0, $model->getContent());

        $text = new LocaleText();
        $model->addContent($text);
        $this->assertCount(1, $model->getContent());
        $this->assertInstanceOf('\FDevs\PageBundle\Model\LocaleText', $model->getContent()->first());
        $this->assertEquals($text, $model->getContent()->first());

    }

    private function createModel()
    {
        return new Block();
    }
}