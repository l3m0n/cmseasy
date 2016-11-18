<?php

class settings extends table {
    private static $me;
    public static function getInstance() {
        if(!self::$me) {
            $class = new settings();
            self::$me=$class;
        }
        return self::$me;
    }
}