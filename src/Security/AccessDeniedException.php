<?php

namespace phprealkit\conference\Security;

class AccessDeniedException extends \Exception
{
    protected $message = 'Access denied.';
}
