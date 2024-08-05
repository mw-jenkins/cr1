<?php

require_once __DIR__ . '/vendor/autoload.php';

use genTree\CsvReaderClass;
use genTree\TreeBuilderClass;
use genTree\JSONWriterClass;

$csv = $argv[1];
$json = $argv[2];

if(!empty($csv) && !empty($json)) {
    genTree($csv, $json);
} else {
    echo "parameters are incorrect";
}

function genTree($csv, $json)
{
    try {
        $csvReader = new CsvReaderClass($csv);
        $treeBuilder = new TreeBuilderClass($csvReader->read());
        $jsonWriter = new JSONWriterClass($json);
        if ($jsonWriter->write($treeBuilder->build()->toArray()['children'])) {
            echo "$json file successfully generated!";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
