<?php

namespace app\helpers;

use app\models\Projects;
use GuzzleHttp\Client;

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
                        'moderator_status' => 'completed',
                        'citizen_status' => 'new',
                    ], '');
                    $project->save();
                } catch (\Exception $e) {

                }
            }
        }
    }

    /**
     * @param $address
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function decodeAddress($address)
    {
        try {
            $client = new Client();
            $data = $client->request('GET', 'https://geocode-maps.yandex.ru/1.x', [
                'query' => [
                    'apikey' => $_ENV['YANDEX_API_KEY'],
                    'geocode' => $address,
                    'format' => 'json'
                ]
            ])->getBody();

            return json_decode($data, true);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}