<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees;

class Node
{
    private mixed $element;
    private ?Node $next;

    public function __construct(mixed $element, ?Node $next = null)
    {
        $this->element = $element;
        $this->next = $next;
    }

    public function getElement(): mixed
    {
        return $this->element;
    }

    public function setElement(mixed $element): void
    {
        $this->element = $element;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }
}
