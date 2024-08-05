<?php

namespace genTree;

class TreeNodeClass
{
    public string $itemName;
    public ?string $parent;
    public array $children;

    public function __construct(string $itemName, ?string $parent)
    {
        $this->itemName = $itemName;
        $this->parent = $parent === '' ? null : $parent;
        $this->children = [];
    }

    public function getName(): ?string
    {
        return $this->itemName;
    }

    public function addChild(self $child)
    {
        $this->children[] = $child;
    }

    public function setChildren(array $child)
    {
        $this->children = $child;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function toArray(): array
    {
        $result = [
            'itemName' => $this->itemName,
            'parent' => $this->parent,
            'children' => [],
        ];

        foreach ($this->children as $child) {
            $result['children'][] = $child->toArray();
        }

        return $result;
    }
}