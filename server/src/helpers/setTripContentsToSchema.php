<?php


function setTripContentsToSchema($schema)
{
    $ret = [];
    foreach ($schema as $key => $tripContents) {
        $tripFields = array_values($tripContents);
        $ret[] = [
            "title" => $tripFields[0],
            "paragraphs" => [
                "paragraph_1" => $tripFields[1],
                "paragraph_2" => $tripFields[2],
                "paragraph_3" => $tripFields[3],
            ]
        ];
    }

    return $ret;
}
