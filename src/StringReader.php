<?php
namespace ReadUntil;

class StringReader implements ReaderInterface
{

    /**
     * @var string
     */
    private $text;

    public function __construct(string $handle)
    {
        $this->setHandle($handle);
    }

    /**
     * iterate over text
     *      iterate over delimiters
     *          iterate over delimiterLength to have the same String length of the text excerpt
     *          (probably replaceable with substring())
     * @param string[] $delimiters
     * @return ReadResult
     */
    public function readUntil(array $delimiters): ReadResult
    {
        $textLength = strlen($this->text);
        $delimiterCount = count($delimiters);
        for ($position = 0; $position < $textLength; $position++) {

            for ($index = 0; $index < $delimiterCount; $index++) {
                $currentDelimiter = $delimiters[$index];
                if ($currentDelimiter === '') {
                    $text = $this->text;
                    $this->text = '';
                    return new ReadResult($text, '');
                }

                $delimiterLength = strlen($currentDelimiter);
                for ($delimiterChar = 0; $delimiterChar < $delimiterLength; $delimiterChar++) {

                    if ($currentDelimiter[$delimiterChar] !== $this->text[$position + $delimiterChar]) { //if text !== delimiter
                        continue 2; //get new Delimiter
                    }
                }
                //delimiter is right
                $textExcerpt = substr($this->text, 0, $position);
                $this->text = substr($this->text, $position + $delimiterLength);
                return new ReadResult($textExcerpt, $currentDelimiter);
            }
        }
        $text = $this->text;
        $this->text = '';
        return new ReadResult($text, '');
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->text;
    }

    /**
     * @param string $handle
     * @return void
     */
    public function setHandle(string $handle)
    {
        $this->text = $handle;
    }
}