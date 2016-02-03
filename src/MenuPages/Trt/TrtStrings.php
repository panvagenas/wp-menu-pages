<?php

namespace Pan\MenuPages\Trt;

trait TrtStrings {
    public static $regexNonAlpha = '/[^a-zA-Z]/';
    public static $regexNonAlphaNum = '/[^a-zA-Z0-9]/';

    public function pregReplaceNonAlpha($subject, $replace = '_'){
        return preg_replace( self::$regexNonAlpha, $replace, $subject );
    }

    public function pregReplaceNonAlphaNum($subject, $replace = '_'){
        return preg_replace( self::$regexNonAlphaNum, $replace, $subject );
    }
}