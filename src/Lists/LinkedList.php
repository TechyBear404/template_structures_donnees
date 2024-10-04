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
        $currentNode = $this->head;

        if ($currentNode->getElement() === null) {
            $this->head->setElement($element);
            $this->size++;
            return;
        } else {
            if (gettype($currentNode->getElement()) !== gettype($element)) {
                throw new \InvalidArgumentException("Error: element type mismatch");
            }

            while ($currentNode->getNext() !== null) {
                $currentNode = $currentNode->getNext();
            }

            $newNode = new Node($element);
            $currentNode->setNext($newNode);
            $this->size++;
        }
    }

    public function get(int $index): mixed
    {
        $currentNode = $this->head;
        $currentIndex = 0;

        if ($index < 0 || $index >= $this->size) {
            throw new \OutOfRangeException("Index out of bounds");
        }

        while ($currentIndex !== $index) {
            $currentNode = $currentNode->getNext();
            $currentIndex++;
        }
        return $currentNode->getElement();
    }

    public function set(int $index, mixed $element): void {}

    public function clear(): void
    {
        $this->head = new Node(null);
        $this->size = 0;
    }

    public function includes(mixed $element): bool
    {
        $currentNode = $this->head;

        while ($currentNode->getNext() !== null) {
            if ($currentNode->getElement() === $element) {
                return true;
            }
            $currentNode = $currentNode->getNext();
            $this->size++;
        }
        return false;
    }

    public function isEmpty(): bool
    {
        if ($this->size === 0) {
            return true;
        }
        return false;
    }

    public function indexOf(mixed $element): int
    {
        $currentNode = $this->head;
        $currentIndex = 0;

        while ($currentNode->getNext() !== null) {
            if ($currentNode->getElement() === $element) {
                return  $currentIndex;
            }
            $currentNode = $currentNode->getNext();
            $currentIndex++;
        }
        throw new \OutOfBoundsException("Element $element not found");
    }

    public function remove(int $index): void
    {
        $currentNode = $this->head;
        $currentIndex = 0;


        if ($index < 0 || $index >= $this->size) {
            throw new \OutOfRangeException("Index out of bounds");
        }

        if ($index === 0) {
            $currentNode = $currentNode->getNext();
        } else {
            while ($currentIndex < $index) {
                $previousNode = $currentNode;
                $currentNode = $currentNode->getNext();
                $currentIndex++;
            }

            $previousNode->setNext($currentNode->getNext());
        }

        $this->size--;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function toArray(): array
    {
        $newArray = [];

        $currentNode = $this->head;
        $currentIndex = 0;

        while ($currentNode !== null) {
            $newArray[] = $currentNode->getElement();
            $currentNode = $currentNode->getNext();
            $currentIndex++;
        }
        return $newArray;
    }
}
