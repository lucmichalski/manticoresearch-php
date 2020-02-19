<?php


namespace Manticoresearch;


trait Utils
{
    public static function escape($string)
    {
        $return = '';
        for ($i = 0; $i < strlen($string); ++$i) {
            $char = $string[$i];
            $ord = ord($char);
            if ($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
                $return .= $char;
            else
                $return .= '\\x' . dechex($ord);
        }
        return $return;
    }
    public static function parseSqltoArray($response)
    {
        $return =$response;

        if(isset($response['columns']) && isset($response['data']))
        {
            $return['data']=[];
            $names = array_walk($response['columns'],function(&$value,$key) {$value= array_keys($value)[0];});
            foreach($response['data'] as $property) {
                if(count($response['columns'])>2) {
                    $return['data'] [] = $property;
                }else{
                    $return['data'][$property[$response['columns'][0]]] = $property[$response['columns'][1]];
                }
            }
        }
        unset($return['columns']);
        return $return;
    }
}