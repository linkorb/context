<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;


// Load schema from a yaml file as an array
$yaml = file_get_contents(__DIR__ . '/schema.yaml');
$schemaArray = Yaml::parse($yaml);

// Load context based on schema
$contextLoader = new Context\Loader\ContextLoader();
$context = $contextLoader->load($schemaArray);


// Load data from a random yaml file as an array
$yaml = file_get_contents(__DIR__ . '/data.yaml');
$dataArray = Yaml::parse($yaml);

// Load data into the tables
$context->getTableByName('Users')
    ->getRecordSet()
    ->loadFromArray($dataArray['Users']);

$context->getTableByName('Countries')
    ->getRecordSet()
    ->loadFromArray($dataArray['Countries']);


