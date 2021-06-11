<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = "World"
?>
<?php Pjax::begin([
    'id' => 'world-form-container'
]); ?>
<?php $form = ActiveForm::begin([
    'options' => ['data' => ['pjax' => true],],
    'id' => 'world-form',
]);
?>
<div class="container">
    <div class="row text-center">
        <div class="col-12 col-md-6">


            <?= $form->field($model, 'continent_id')->dropDownList(ArrayHelper::map($continents, 'continent_id', 'name'), [
                'id' => 'field-continent-id',
                'onchange' => '$("#world-form").submit()',
                'prompt' => '--Select a continent--',
            ]) ?>
            <?php if (!empty($countries))
                echo $form->field($model, 'country_id')->dropDownList(ArrayHelper::map($countries, 'country_id', 'name'), [
                    'id' => 'field-country-id',
                    'onchange' => '$("#world-form").submit()',
                    'prompt' => '--Select a country--'
                ]) ?>
            <?php if (!empty($regions) && !empty($countries) && $continent->continent_id === $country->continent_id)
                echo $form->field($model, 'region_id')->dropDownList(ArrayHelper::map($regions, 'region_id', 'name_language'), [
                    'id' => 'field-region_id',
                    'onchange' => '$("#world-form").submit()',
                    'prompt' => '--Select a region--'
                ]) ?>

            <?php if (!empty($cities) && !empty($regions) && !empty($countries) && $continent->continent_id === $country->continent_id)
                echo $form->field($model, 'city_id')->dropDownList(ArrayHelper::map($cities, 'city_id', 'name_language'), [
                    'id' => 'field-city_id',
                    'onchange' => '$("#world-form").submit()',
                    'prompt' => '--Select a city--'
                ]) ?>


        </div>
        <div class="col-12 col-md-6">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="col">Continent</th>
                    <td><?= $continent->name ?></td>
                </tr>
                <tr>
                    <th scope="col">Description</th>
                    <td><?= $continent->description ?></td>
                </tr>
                <?php if (!empty($country) && $continent->continent_id === $country->continent_id): ?>

                    <tr>
                        <th scope="col">Country</th>
                        <td><?= $country->name ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($region) && $regionTmp->country_id === $country->country_id && $continent->continent_id === $country->continent_id): ?>
                    <tr>
                        <th scope="col">Region</th>
                        <td><?= $region->name_language ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($cities) && $cityTmp->region_id === $region->region_id && !empty($regions) && $continent->continent_id === $country->continent_id): ?>
                    <tr>
                        <th scope="col">City</th>
                        <td><?= $city->name_language ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php if (!empty($cities) && $cityTmp->region_id === $region->region_id && !empty($regions) && $continent->continent_id === $country->continent_id): ?>
    <section class="mt-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1>Weather in <?= $weather->name ?></h1>
                    <?= Html::img('http://openweathermap.org/img/w/' . $weather->weather[0]->icon . ".png") ?>
                    <table class="table table-dark table-striped">
                        <tr>
                            <th>Pressure</th>
                            <td><?= $weather->main->pressure ?></td>
                        </tr>
                        <tr>
                            <th>Humidity</th>
                            <td><?= $weather->main->humidity ?>%</td>
                        </tr>
                        <tr>
                            <th>Temperature</th>
                            <td><?= $weather->main->temp ?>°C</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
