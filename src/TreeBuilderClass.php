<?php

namespace genTree;

class TreeBuilderClass
{
    public array $data;
    public TreeNodeClass $root;

    public function __construct($data)
    {
        $this->data = $data;
        $this->root = new TreeNodeClass("", "");
    }

    public function build(): TreeNodeClass
    {
        $nodes = [];

        // Create nodes
        foreach ($this->data as $row) {
            $node = new TreeNodeClass($row['Item Name'], $row['Parent']);
            $nodes[$node->getName()] = $node;
        }

        // Link nodes
        foreach ($this->data as $row) {
            $node = $nodes[$row['Item Name']];
            $parentName = $row['Parent'];

            if (empty($parentName)) {
                $parent = $this->root;
            } else {
                $parent = $nodes[$parentName];
            }
            $parent->addChild($node);
        }

        // Add direct components nodes
        foreach ($this->data as $row) {
            if ($row['Type'] == 'Прямые компоненты' && !empty($row['Relation'])) {
                $node = $nodes[$row['Item Name']];
                $relation = $nodes[$row['Relation']];
                $node->setChildren($relation->getChildren());
            }
        }

        return $this->root;
    }
}