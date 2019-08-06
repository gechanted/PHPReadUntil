<?php
require_once __DIR__ . '/vendor/autoload.php';

$string = 'This is a test-string ... hi';

$stringReader = new ReadUntil\StringReader($string);
$firstResult = $stringReader->readUntil(['-', 'ing']);
echo "string '". $firstResult->getText() ."' extracted by the delimiter '". $firstResult->getDelimiter(). "'" . PHP_EOL;

while (true) {
    $result = $stringReader->readUntil(['.', 'i', 'ing']);
    echo "string '". $result->getText() ."' extracted by the delimiter '". $result->getDelimiter(). "'" . PHP_EOL;
    if ( $result->getDelimiter() === '') {
        break;
    }
}