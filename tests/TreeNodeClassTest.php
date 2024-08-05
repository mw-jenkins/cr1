<?php

use genTree\TreeNodeClass;
use PHPUnit\Framework\TestCase;

class TreeNodeClassTest extends TestCase
{
    public function testGetName()
    {
        $node = new TreeNodeClass('foo', 'bar');
        $this->assertEquals('foo', $node->getName());
    }

    public function testGetChildren()
    {
        $node = new TreeNodeClass('foo', 'bar');
        $child1 = new TreeNodeClass('foo1', 'foo');
        $child2 = new TreeNodeClass('foo2', 'foo');
        $node->addChild($child1);
        $node->addChild($child2);
        $this->assertEquals([$child1, $child2], $node->getChildren());
    }

    public function testSetChildren()
    {
        $node = new TreeNodeClass('foo', 'bar');
        $child1 = new TreeNodeClass('foo1', 'foo');
        $child2 = new TreeNodeClass('foo2', 'foo');
        $node->setChildren([$child1, $child2]);
        $this->assertEquals([$child1, $child2], $node->getChildren());
    }

    public function testAddChild()
    {
        $node = new TreeNodeClass('foo', 'bar');
        $child1 = new TreeNodeClass('foo1', 'foo');
        $child2 = new TreeNodeClass('foo2', 'foo');
        $node->addChild($child1);
        $node->addChild($child2);
        $this->assertEquals([$child1, $child2], $node->getChildren());
    }

    public function testToArray()
    {
        $node = new TreeNodeClass('foo', 'bar');
        $child1 = new TreeNodeClass('foo1', 'foo');
        $child2 = new TreeNodeClass('foo2', 'foo');
        $child3 = new TreeNodeClass('foo3', 'foo2');
        $node->addChild($child1);
        $node->addChild($child2);
        $child2->addChild($child3);
        $expected = [
            'itemName' => 'foo',
            'parent' => 'bar',
            'children' => [
                [
                    'itemName' => 'foo1',
                    'parent' => 'foo',
                    'children' => []
                ],
                [
                    'itemName' => 'foo2',
                    'parent' => 'foo',
                    'children' => [
                        [
                            'itemName' => 'foo3',
                            'parent' => 'foo2',
                            'children' => []
                        ]
                    ]
                ]
            ]
        ];
        $this->assertEquals($expected, $node->toArray());
    }
}