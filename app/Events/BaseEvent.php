<?php

namespace App\Events;
use App\Contracts\AppEvent;

abstract class BaseEvent implements AppEvent
{
    public int $id = -1;
    public string $name = 'Base Event';
    public string $level = 'debug';
    public array $context = [];
    public bool $shouldLog = true;
    public bool $shouldExternalLog = true;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLevel(): string
    {
        if (!in_array($this->level, ['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'])) {
            return 'debug';
        }

        return strtolower($this->level);
    }

    private function getBaseContext(): array
    {
        $sessionId = session()->getId();
        $requestId = session()->get('request_id');

        $context = [
            'timestamp' => now()->toISOString(),
            'app' => [
                'name' => config('app.name'),
                'version' => config('app.version'),
                'environment' => app()->environment(),
                'hostname' => gethostname(),
            ],
            'session' => [
                'id' => $sessionId,
            ],
            'request' => [
                'id' => $requestId,
                'ip' => request()->ip(),
                'method' => request()->method(),
                'url' => request()->fullUrl(),
                'host' => request()->host(),
                'scheme' => request()->getScheme(),
                'locale' => request()->getLocale(),
                'user_agent' => request()->headers->get('User-Agent'),
                'referer' => request()->headers->get('referer'),
            ],
            'event' => [
                'id' => $this->id,
                'type' => static::class,
                'level' => $this->level,
                'name' => $this->name,
            ],
        ];

        if (auth()->check()) {
            $context['causer'] = [
                'id' => auth()->id(),
                'name' => auth()->user()?->name,
                'email' => auth()->user()?->email,
                'role' => auth()->user()?->role?->value,
            ];
        }

        return $context;
    }

    protected function getContext(): array
    {
        return $this->context;
    }

    public function getFullContext(): array
    {
        $subject = $this->getSubject();

        $context = array_merge($this->getBaseContext(), $this->getContext());

        if ($subject) {
            $context['subject'] = [
                'id' => $subject?->id ?? null,
                'type' => is_object($subject) ? get_class($subject) : null,
            ];
        }

        return $context;
    }

    public function shouldLog(): bool
    {
        return $this->shouldLog;
    }

    public function shouldExternalLog(): bool
    {
        return $this->shouldExternalLog;
    }

}
