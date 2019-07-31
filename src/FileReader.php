<?php
namespace ReadUntil;

class FileReader implements ReaderInterface
{
    private $handle;
    private $text = '';

    /**
     * @param $stream
     */
    public function __construct($stream)
    {
        if (is_resource($stream) === false) {
            throw new \RuntimeException('Argument is not a valid stream');
        }
        $this->handle = $stream;
    }

    /**
     * @param string[] $delimiters
     * @return ReadResult
     */
    public function readUntil(array $delimiters): ReadResult
    {
        $delimiterCount = count($delimiters);
        for ($position = 0; $char = $this->getCharAtIndex($position); $position++) {

            for ($index = 0; $index < $delimiterCount; $index++) {
                $currentDelimiter = $delimiters[$index];

                $delimiterLength = strlen($currentDelimiter);
                for ($delimiterChar = 0; $delimiterChar < $delimiterLength; $delimiterChar++) {

                    if ($currentDelimiter[$delimiterChar] !== $this->getCharAtIndex($position + $delimiterChar)) { //if text !== delimiter
                        continue 2; //get new Delimiter
                    }
                }
                //delimiter is right
                $textExcerpt = substr($this->text, 0, $position);
                $this->text = substr($this->text, $position + $delimiterLength);
                return new ReadResult($textExcerpt, $currentDelimiter);
            }
        }
        return new ReadResult($this->text, '');
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param int $index
     * @return bool|string
     */
    private function getCharAtIndex(int $index)
    {
        if (isset($this->text[$index])) {
            return $this->text[$index];
        }
        $toRead = $index + 1 - strlen($this->text);
        $read = fread($this->handle, $toRead);
        if ($read === false) {
            return false;
        }
        $this->text .= $read;

        return $this->text[$index];
    }
}