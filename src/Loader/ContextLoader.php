<?php

namespace Context\Loader;

use Context\Context;
use Context\Column\LiteralColumn;
use Context\Column\ReferenceColumn;
use Context\Column\ReverseReferenceColumn;
use Context\Table;
use Context\ArrayRecordSet;
use RuntimeException;


class ContextLoader
{
    public function load(array $schema)
    {
        $context = new Context();

        if (!isset($schema['tables'])) {
            throw new RuntimeException("Invalid schema array (expected a `tables` key");
        }

        // First pass: load tables and regular columns
        foreach ($schema['tables'] as $tableName => $tableData) {

            $table = new Table($tableName, $context);
            foreach ($tableData['columns'] as $columnName => $columnData) {
                $column = new LiteralColumn($columnName);
                $table->addColumn($column);
            }
            $context->addTable($table);
        }

        // Second pass: load references
        foreach ($schema['tables'] as $tableName => $tableData) {
            $table = $context->getTable($tableName);
            if (isset($tableData['references'])) {
                foreach ($tableData['references'] as $referenceName => $referenceData) {
                    $localColumnName = $referenceData['local'];
                    $remote = $referenceData['remote'];
                    $reverse = $referenceData['reverse'] ?? null;
                    $remotePart = explode('.', $remote);

                    $remoteTable = $context->getTable($remotePart[0]);
                    $remoteColumnName = $remotePart[1];

                    $reference = new ReferenceColumn(
                        $referenceName,
                        $localColumnName,
                        $remoteTable,
                        $remoteColumnName
                    );
                    $table->addColumn($reference);

                    if ($reverse) {

                        $reverseReference = new ReverseReferenceColumn(
                            $reverse,
                            $remoteColumnName,
                            $table,
                            $localColumnName
                        );
                        $remoteTable->addColumn(
                            $reverseReference
                        );

                    }
                }
            }
        }

        // Third pass: attach RecordSets


        foreach ($schema['tables'] as $tableName => $tableData) {
            $table = $context->getTable($tableName);
            $recordSet = new ArrayRecordSet($table, []);
            $table->setRecordSet($recordSet);
        }

        return $context;
    }
}
