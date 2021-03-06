<?php

declare(strict_types=1);

namespace App\Backoffice\Users\Application\Command;

class DeleteUser
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
