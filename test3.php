<?php

if ($HTTP_RAW_POST_DATA)
{   
    //create an xml parser and attempt to read it outputting errors if any
    $xml_parser=xml_parser_create();
    if(!xml_parse_into_struct($xml_parser, $HTTP_RAW_POST_DATA, $vals, $index))
        var_dump(array("ERROR"=>sprintf("XML error: %s at line %d",xml_error_string(xml_get_error_code($xml_parser)),xml_get_current_line_number($xml_parser))));
}



?>