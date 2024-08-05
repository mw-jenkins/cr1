<?php

use genTree\TreeBuilderClass;
use PHPUnit\Framework\TestCase;

class TreeBuilderClassTest extends TestCase
{
    public function testBuild()
    {
        $data = [
            ['Item Name' => 'A', 'Parent' => '', 'Type' => 'Категория', 'Relation' => ''],
            ['Item Name' => 'B', 'Parent' => 'A', 'Type' => 'Категория', 'Relation' => ''],
            ['Item Name' => 'C', 'Parent' => 'A', 'Type' => 'Прямые компоненты', 'Relation' => 'D'],
            ['Item Name' => 'D', 'Parent' => '', 'Type' => 'Категория', 'Relation' => ''],
            ['Item Name' => 'E', 'Parent' => 'D', 'Type' => 'Категория', 'Relation' => ''],
        ];

        $treeBuilder = new TreeBuilderClass($data);
        $rootNode = $treeBuilder->build();

        $this->assertEquals('', $rootNode->getName());
        $this->assertCount(2, $rootNode->getChildren());

        $firstChildNode = $rootNode->getChildren()[0];
        $this->assertEquals('A', $firstChildNode->getName());
        $this->assertCount(2, $firstChildNode->getChildren());

        $secondChildNodeA = $firstChildNode->getChildren()[1];
        $this->assertEquals('C', $secondChildNodeA->getName());
        $this->assertCount(1, $secondChildNodeA->getChildren());
        $this->assertEquals('E', $secondChildNodeA->getChildren()[0]->getName());
    }
}




