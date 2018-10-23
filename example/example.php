<?php

require_once __DIR__ . '/common.php';

foreach ($context->getTables() as $table) {
    echo 'Table: ' . $table->getName() . PHP_EOL;
    echo '  Columns:' . PHP_EOL;
    foreach ($table->getColumns() as $column) {
        echo '  - ' . $column->getName() . PHP_EOL;
    }
    echo PHP_EOL;
}

$usersTable = $context->getTableByName('Users');
$countriesTable = $context->getTableByName('Countries');

$records = $usersTable->getRecordSet()->findWhere(['username' => 'alice']);
$alice = $records[0];

// print_r($alice);

echo $alice['displayName'] . PHP_EOL;
echo "Country display name: " . $alice['country']['displayName'] . PHP_EOL;

echo "\nFrom country:\n";
$records = $countriesTable->getRecordSet()->findWhere(['code' => 'FRA']);
$france = $records[0];

// Array based access:

echo $france['displayName'] . PHP_EOL;
foreach ($france['users'] as $user) {
    echo " - " . $user['username'] . PHP_EOL;
}

// Object based access:
echo $france->displayName . PHP_EOL;
foreach ($france->users as $user) {
    echo " - " . $user->username . PHP_EOL;
}



