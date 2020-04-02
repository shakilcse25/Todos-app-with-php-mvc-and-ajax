<?php
namespace Todos\Config;
class Database
{
    private static $bdd = null;

    public function __construct() {
        $this->getBdd();
    }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new \PDO("mysql:host=localhost;dbname=todos", 'root', '');
        }
        return self::$bdd;
    }
}
?>