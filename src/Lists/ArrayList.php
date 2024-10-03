<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    public function push(mixed $element = null): void
    {
        if ($this->size() !== 0 && gettype($element) !== gettype($this->elements[0])) {
            throw new \InvalidArgumentException("Error: element type mismatch");
        }
        $this->elements[] = $element;
    }

    public function get(int $index): mixed
    {
        if ($this->size() === 0) {
            throw new \OutOfBoundsException("Index $index out of bounds");
        } else {
            return $this->elements[$index];
        }
    }

    public function set(int $index, mixed $element): void
    {
        if ($this->size() === 0) {
            throw new \OutOfBoundsException("Index $index out of bounds");
        } else {
            $this->elements[$index] = $element;
        }
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function includes(mixed $element): bool
    {
        return in_array($element, $this->elements);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function indexOf(mixed $element): int
    {
        if ($this->size() === 0) {
            throw new \OutOfBoundsException("Element $element not found");
        } else {
            return array_search($element, $this->elements);
        }
    }

    public function remove(int $index): void
    {
        if ($this->size() === 0) {
            throw new \OutOfBoundsException("Index $index out of bounds");
        } else {
            array_splice($this->elements, $index, 1);
        }
    }

    public function size(): int
    {
        return count($this->elements);
    }

    public function toArray(): array
    {
        return $this->elements;
    }
}
