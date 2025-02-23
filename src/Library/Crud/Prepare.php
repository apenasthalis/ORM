<?php

namespace Pericao\Orm\Library\Crud;

class Prepare
{
    public function prepareInsert($data, $columns): array
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {
                $finalColumns[] = $key;
                $placeholders[] = "?";
                $filteredData[] = $value;
            }
        }

        $finalColumns = implode(',',$finalColumns);
        $placeholders = implode(',', $placeholders);

        $finalData = [
            'placeHolders' => $placeholders,
            'filteredData' => $filteredData,
            'finalColumns' => $finalColumns,
        ];

        return $finalData;
    }

    public function prepareUpdate($data, $columns)
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {
                $finalColumns[] = $key;
                $placeholders[] = "$key = ?";
                $filteredData[] = $value;
            }
        }

        $finalColumns = implode(',',$finalColumns);
        $placeholders = implode(',', $placeholders);

        $finalData = [
            'placeHolders' => $placeholders,
            'filteredData' => $filteredData,
            'finalColumns' => $finalColumns,
        ];

        return $finalData;
    }
}