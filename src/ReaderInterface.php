<?php
namespace ReadUntil;

interface ReaderInterface
{
    /**
     * @param string[] $delimiters
     * @return ReadResult
     */
     public function readUntil(array $delimiters): ReadResult;

    /**
     * @return mixed
     */
     public function getHandle();
}