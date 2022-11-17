<?php

namespace app\commands;

use app\helpers\Helper;
use app\models\Projects;
use yii\console\Controller;
use yii\console\ExitCode;

class ProjectsController extends Controller
{
    /**
     * @param $address
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getCoordinates($address): array
    {
        try {
            $data = Helper::decodeAddress('Москва ' . $address);
            $coordinates = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            $coords = explode(' ', $coordinates);
            return [
                'lat' => $coords[0],
                'lng' => $coords[1]
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function actionCompleteCoordinates(): int
    {
        $projects = Projects::find()
            ->andWhere(['IS NOT', 'location_text', null])
            ->andWhere(['latitude' => null])
            ->andWhere(['longitude' => null])
            ->all();

        foreach ($projects as $project) {
            try {
                $coordinates = $this->getCoordinates($project->location_text);
                $project->latitude = $coordinates['lat'];
                $project->longitude = $coordinates['lng'];
                $project->save();

                var_dump($project->location_text . ' coordinates saved');
            } catch (\Exception $e) {

            }
        }

        return ExitCode::OK;
    }
}