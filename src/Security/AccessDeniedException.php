<?php

namespace EnoffSpb\Conference\Security;

class AccessDeniedException extends \Exception
{
    protected $message = 'Access denied.';
}
