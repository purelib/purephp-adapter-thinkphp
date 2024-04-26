<?php

namespace purephp\adapter\thinkphp\psr7;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @property-read int $statusCode
 * @property-read string $reasonPhrase
 * @property-read array $headers
 * @property-read StreamInterface $body
 */
class ResponseAdapter implements ResponseInterface
{
    protected $adaptee;
    public function __construct($adaptee)
    {
        // namespace think
        $this->adaptee = $adaptee;
    }

    // 被适配者
    public function adaptee()
    {
        return $this->adaptee;
    }

    public function getProtocolVersion(): string
    {
        // TODO
        return '1.1';
    }

    public function withProtocolVersion($version): MessageInterface
    {
        // TODO
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->adaptee->getCode();
    }

    // todo
    // 获得状态码有关的短语
    public function getReasonPhrase(): string
    {
        return '';
    }

    public function getHeaders(): array
    {
        return $this->adaptee->getHeader();
    }

    public function hasHeader($name): bool
    {
        return $this->adaptee->getHeader($name) !== null;
    }

    public function getHeader($name): array
    {
        return $this->adaptee->getHeader($name);
    }

    public function getHeaderLine($name): string
    {
        return $this->adaptee->getHeader($name);
    }

    public function getBody(): StreamInterface
    {
        return Utils::streamFor($this->adaptee->getContent());
    }

    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        $this->adaptee->code($code);
        return $this;
    }

    public function withHeader($name, $value): ResponseInterface
    {
        $this->adaptee->header([$name => $value]);
        return $this;
    }

    public function withAddedHeader($name, $value): ResponseInterface
    {
        $this->adaptee->header([$name => $value]);
        return $this;
    }

    public function withoutHeader($name): ResponseInterface
    {
        $this->adaptee->header([$name => null]);
        return $this;
    }

    public function withBody(StreamInterface $body): ResponseInterface
    {
        $this->adaptee->content($body);
        return $this;
    }
}
