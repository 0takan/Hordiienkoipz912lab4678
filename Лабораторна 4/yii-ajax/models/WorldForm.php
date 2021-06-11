<?php


namespace app\models;


use yii\base\Model;

class WorldForm extends Model
{
    public $continent_id = 0;
    public $country_id = 0;
    public $region_id = 0;
    public $city_id = 0;

    public function rules()
    {
        return [
            [['country_id', 'continent_id', 'region_id', 'city_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'continent_id' => "Continent",
            'country_id' => "Country",
            'region_id' => "Region",
            'city_id' => "City",
        ];
    }
}