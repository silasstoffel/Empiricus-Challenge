<?php

namespace Empiricus\Domain\Shared\PrimaryKey;

interface PrimaryKeyCreatorInterface
{
    public function create(): string;
}
