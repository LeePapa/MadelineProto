<?php

declare(strict_types=1);

namespace danog\MadelineProto\Ipc;

use danog\MadelineProto\RPCErrorException;
use RuntimeException;
use Throwable;
use TypeError;

use function Amp\Parallel\Context\flattenThrowableBacktrace as ContextFlattenThrowableBacktrace;

final class ExitFailure
{
    private string $type;

    private string $message;

    private int|string $code;

    /** @var array<string> */
    private array $trace;

    private ?string $tlTrace = null;

    private ?self $previous = null;

    private ?string $localized = null;

    public function __construct(Throwable $exception)
    {
        $this->type = $exception::class;
        $this->message = $exception->getMessage();
        $this->code = $exception->getCode();
        $this->trace = ContextFlattenThrowableBacktrace($exception);
        if (\method_exists($exception, 'getTLTrace')) {
            $this->tlTrace = $exception->getTLTrace();
        }

        if ($exception instanceof RPCErrorException) {
            $this->localized = $exception->getLocalization();
        }

        if ($previous = $exception->getPrevious()) {
            $this->previous = new self($previous);
        }
    }

    public function getException(): object
    {
        $previous = $this->previous ? $this->previous->getException() : null;

        try {
            $exception = new $this->type($this->message, $this->code, $previous);
        } catch (TypeError) {
            $exception = new RuntimeException($this->message, $this->code, $previous);
        }

        if ($this->tlTrace) {
            $exception->setTLTrace($this->tlTrace);
        }
        if ($this->localized) {
            $exception->setLocalization($this->localized);
        }
        return $exception;
    }
}
