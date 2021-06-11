<?php


namespace app\controllers;


use app\models\City;
use app\models\CityLanguage;
use app\models\Continent;
use app\models\Country;
use app\models\Region;
use app\models\RegionLanguage;
use app\models\WorldForm;
use Yii;
use yii\web\Controller;

class PjaxController extends Controller
{
    public function actionWorldForm()
    {
        $model = new WorldForm();
        $continents = Continent::find()->asArray()->all();
        $continent = null;
        $countries = null;
        $regions = null;
        $cities = null;
        $weather = null;

        if (Yii::$app->request->isPjax) {
            $model->load(Yii::$app->request->post());
            $continent = Continent::find()->where(['continent_id' => $model->continent_id])->one();
            $countries = Country::find()->where(['continent_id' => $model->continent_id])->all();
            $country = Country::find()->where(['country_id' => $model->country_id])->one();
            $regionsTmp = Region::find()->select('region_id')->where(['country_id' => $model->country_id])->all();
            $regions = RegionLanguage::find()->where(['region_id' => $regionsTmp, 'language' => 'en'])->all();
            $region = RegionLanguage::find()->where(['region_id' => $model->region_id])->one();
            $regionTmp = Region::find()->where(['region_id' => $model->region_id])->one();
            $citiesTmp = City::find()->select('city_id')->where(['region_id' => $model->region_id])->all();
            $cities = CityLanguage::find()->where(['city_id' => $citiesTmp, 'language' => 'en'])->all();
            $city = CityLanguage::find()->where(['city_id' => $model->city_id])->one();
            $cityTmp = City::find()->where(['city_id' => $model->city_id])->one();
        }
        if (!empty($city)) {
            $apiKey = "61a81032525321582a46b6580a7f69f4";
            $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city->name_language . "&units=metric&appid=" . $apiKey;

            $contents = file_get_contents($url);
            $contents1 = utf8_encode($contents);
            $weather = json_decode($contents1);
        }
        return $this->render('world-form', [
            'model' => $model,
            'continents' => $continents,
            'continent' => $continent,
            'countries' => $countries,
            'country' => $country,
            'regions' => $regions,
            'region' => $region,
            'regionTmp' => $regionTmp,
            'cities' => $cities,
            'city' => $city,
            'cityTmp' => $cityTmp,
            'weather' => $weather
        ]);
    }
}