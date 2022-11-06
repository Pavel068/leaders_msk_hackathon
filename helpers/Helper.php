<?php

namespace app\helpers;

use app\models\Projects;

class Helper
{
    public static function callML($file_name)
    {
        $path = getcwd();
        $code = "cd $path/commands && python3 parser.py $path/web/uploads/$file_name > $path/commands/data/items.json";
        shell_exec($code);
    }

    public static function writeData()
    {
        $data = json_decode(json_decode(file_get_contents(__DIR__ . '/../commands/data/items.json'), true), true);

        if (isset($data['tasks'])) {
            foreach ($data['tasks'] as $task) {
                try {
                    $project = new Projects();
                    $project->load([
                        'name' => $task,
                        'description' => '',
                        'price' => isset($data['price']) && isset($data['price']['Итого по локальной смете: ']) ? floatval($data['price']['Итого по локальной смете: ']) : null,
                        'location_text' => isset($data['address']) && isset($data['address'][0]) ? $data['address'][0] : null,
                        'moderator_status' => Status::MODERATOR_PROJECT_STATUS['completed'],
                        'citizen_status' => null,
                    ], '');
                    $project->save();
                } catch (\Exception $e) {

                }
            }
        }
    }
}