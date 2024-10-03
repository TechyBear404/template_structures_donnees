<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

use Opmvpc\StructuresDonnees\Node;

class LinkedList implements ListInterface
{
    protected Node $head;
    protected int $size;

    public function __construct()
    {
        $this->head = new Node(null);
        $this->size = 0;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function push(mixed $element): void
    {
        if ($this->head->getElement() === null) {
            $this->head->setElement($element);
            $this->size++;
            return;
        } else {
            $currentNode = $this->head;
            while ($currentNode->getNext() !== null) {
                $currentNode = $currentNode->getNext();
            }
            $currentNode->setNext(new Node($element));
            $this->size++;
        }
    }

    public function get(int $index): mixed
    {
        $currentNode = $this->head;
        $currentIndex = 0;

        while ($currentNode !== null) {
            if ($currentIndex === $index) {
                return $currentNode->getElement();
            } else {
                $currentNode = $currentNode->getNext();
                $currentIndex++;
                $this->size++;
            }
        }
    }

    public function set(int $index, mixed $element): void {}

    public function clear(): void {}

    public function includes(mixed $element): bool {}

    public function isEmpty(): bool {}

    public function indexOf(mixed $element): int {}

    public function remove(int $index): void
    {
        $currentNode = $this->head;
        $currentIndex = 0;

        while ($currentNode !== null) {
            if ($currentIndex === $index - 1) {
                $previousNode = $currentNode;
                $toDeleteNode = $currentNode->getNext();
                $nextNode = $toDeleteNode->getNext();

                $previousNode->setNext($nextNode);
            } else {
                $currentNode = $currentNode->getNext();
                $currentIndex++;
                $this->size++;
            }
        }
    }

    public function size(): int
    {
        return $this->size;
    }

    public function toArray(): array {}
}
