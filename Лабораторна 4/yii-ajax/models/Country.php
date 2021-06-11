<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $country_id
 * @property string $code Two-letter country code (ISO 3166-1 alpha-2)
 * @property string $name English country name
 * @property string $official_name Official English country name
 * @property string $iso3 Three-letter country code (ISO 3166-1 alpha-3)
 * @property int $number Three-digit country number (ISO 3166-1 numeric)
 * @property string $currency
 * @property string $capital
 * @property int $area
 * @property int $continent_id
 * @property string $coords
 * @property int $display_order
 *
 * @property Continent $continent
 * @property Region[] $regions
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'official_name', 'iso3', 'number', 'currency', 'capital', 'area', 'continent_id', 'coords'], 'required'],
            [['number', 'area', 'continent_id', 'display_order'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 64],
            [['official_name', 'currency', 'capital'], 'string', 'max' => 128],
            [['iso3'], 'string', 'max' => 3],
            [['coords'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['continent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Continent::className(), 'targetAttribute' => ['continent_id' => 'continent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'code' => 'Code',
            'name' => 'Name',
            'official_name' => 'Official Name',
            'iso3' => 'Iso3',
            'number' => 'Number',
            'currency' => 'Currency',
            'capital' => 'Capital',
            'area' => 'Area',
            'continent_id' => 'Continent ID',
            'coords' => 'Coords',
            'display_order' => 'Display Order',
        ];
    }

    /**
     * Gets query for [[Continent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContinent()
    {
        return $this->hasOne(Continent::className(), ['continent_id' => 'continent_id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['country_id' => 'country_id']);
    }
}
