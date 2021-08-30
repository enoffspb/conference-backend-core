<?php

namespace phprealkit\conference\Interfaces;

interface ConferenceInterface
{
    public function getId(): ?int;
    public function getCode(): ?string;
    public function getName(): ?string;
}
