<?php

namespace phprealkit\conference\Interfaces;

/**
 * This interface must be implemented with users objects in a target system
 * that provides their through UserProviderInterface.
 */
interface UserInterface
{
    public function getId(): int;
    public function getName(): string;
    public function getFields(): ?array;
}
