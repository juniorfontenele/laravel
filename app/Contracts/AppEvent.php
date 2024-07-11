<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $level
 * @property array $context
 * @property bool $shouldLog
 * @property bool $shouldExternalLog
 */
interface AppEvent
{
    public function getId(): int;

    public function getName(): string;

    public function getLevel(): string;

    public function getSubject(): ?Model;

    public function getFullContext(): array;

    public function shouldLog(): bool;

    public function shouldExternalLog(): bool;
}
