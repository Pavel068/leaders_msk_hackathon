<?php

namespace app\helpers;

class Helper
{
    public static function callML($file_name)
    {
        $path = getcwd();
        $code = "cd $path/ml && python3 test_p.py ../uploads/$file_name > $path/../commands/data/items.json";
        shell_exec($code);
    }

    public static function writeDB()
    {
        $path = getcwd();
        shell_exec("php $path/../yii items/mass-create");
    }
}