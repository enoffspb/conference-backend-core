<?php

namespace phprealkit\conference\Interfaces;

/**
 * An interface for Conference model.
 */
interface ConferenceInterface
{
    public function getId(): ?int;
    public function getCode(): ?string;
    public function getName(): ?string;
}
