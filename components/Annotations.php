<?php

namespace app\components;


class Annotations
{
    public function getFullName()
    {
        $reflector = new \ReflectionMethod($this, 'getFullName');
        preg_match_all('~@template "(.*)"~U', $reflector->getDocComment(), $matches);
        $template = $matches[1][0];
        preg_match_all('~\$(\w+)\b~U', $template, $matches);
        $tokens = $matches[0];
        $fields = $matches[1];
        $replaces = [];
        foreach ($fields as $k => $field) {
            if (!empty($this->$field)) {
                $replaces[$tokens[$k]] = $this->$field;
            }
        }
        return count($replaces) === count($fields) ? strtr($template, $replaces) : $this->email;

    }

}