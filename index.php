<?php

use App\Emagia\Character\Beast;
use App\Emagia\Character\Generic;
use App\Emagia\Character\Orderus;
use App\Emagia\DataReader\DataReaderFactory;
use App\Emagia\DataReader\DataReaderType;
use App\Emagia\Game;

define('DS', DIRECTORY_SEPARATOR);

define('CHARACTERS_MAP_TEMPLATE', __DIR__.DS.'fixtures'.DS.'character.json');
define('STORY', __DIR__.DS.'fixtures'.DS.'story');

require_once __DIR__ . DS . 'vendor' . DS . 'autoload.php';

system('clear');
$readerFactory = new DataReaderFactory();

try {
    $story = file_get_contents(STORY);
    echo $story.PHP_EOL;

    if (is_readable(CHARACTERS_MAP_TEMPLATE) && is_file(CHARACTERS_MAP_TEMPLATE)) {
        $json = file_get_contents(CHARACTERS_MAP_TEMPLATE);
        $reader = $readerFactory->createReader(DataReaderType::JSON);
        $data = $reader->convertFromString($json);

        $orderus = Orderus::loadCharacter(Orderus::class, $data['orderus']);
        $beast = Beast::loadCharacter(Beast::class, $data['beast']);

        $game = new Game($orderus, $beast);

        $game->fight();
        
    }
} catch (\Exception $exception) {
    echo $exception->getMessage();
}
