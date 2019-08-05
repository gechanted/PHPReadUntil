<?php
namespace ReadUntil;

class ReadResult
{
    /**
     * @var string
     */
    public $text;
    /**
     * @var string
     */
    public $delimiter;

    public function __construct(string $text, string $delimiter)
    {
        $this->text = $text;
        $this->delimiter = $delimiter;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getDelimiter(): string
    {
        return $this->delimiter;
    }
}