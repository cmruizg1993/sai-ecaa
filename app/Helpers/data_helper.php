<?php

function dataTransform($dataMap, $modelData){
    $data = [];
    foreach ($modelData as $model){
        $item = [];
        foreach ($dataMap as $key => $value){
            $item["$key"] = $model["$value"];
        }
        array_push($data, $item);
    }
    return $data;
}