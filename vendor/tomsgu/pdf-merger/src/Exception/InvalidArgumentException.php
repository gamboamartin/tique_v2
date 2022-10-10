<?php

declare(strict_types=1);

namespace Tomsgu\PdfMerger\Exception;

/**
 * @author Tomas Jakl <tomasjakll@gmail.com>
 */
class InvalidArgumentException extends \Exception implements PdfMergerExceptionInterface
{
    public static function create(string $message)
    {
        return new self($message);
    }
}