<?php

namespace Empiricus\Infra\Shared\PrimaryKey;

use Empiricus\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Ramsey\Uuid\Uuid;

class UUIDCreator implements PrimaryKeyCreatorInterface
{
    public function create(): string
    {
        return Uuid::uuid4();
    }
}
