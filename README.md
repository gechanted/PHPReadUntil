

This Component searches the through the text until a delimiter is found and 
returns the searched text until the delimiter and the delimiter. 
Then you can change the delimiters, and search through the next part or 
get the rest of of the text back

Installation



Usage
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

output: 

string 'This is a test' extracted by the delimiter '-'
string 'str' extracted by the delimiter 'i'
string 'ng ' extracted by the delimiter '.'
string '' extracted by the delimiter '.'
string '' extracted by the delimiter '.'
string ' h' extracted by the delimiter 'i'
string '' extracted by the delimiter ''


