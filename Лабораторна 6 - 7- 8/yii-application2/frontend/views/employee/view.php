<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */
$this->title = 'Employee profile';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Employee profile ' . $model->first_name . ' ' . $model->last_name;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1 class="text-center"><?= Html::encode('Employee profile ' . $model->first_name . ' ' . $model->last_name) ?></h1>
    <div class="row">
        <div class="col-sm-6 text-center">
            <?php
            if (!$model->image) {
                echo Html::img('images/employee/employee_placeholder.png');
            } else {
                echo Html::img('images/employee/' . $model->image);
            }
            ?>
            <div class="mt-3">
                <?= Html::a('Edit picture', ['update-image', 'id' => $model->employee_id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'first_name',
                    'last_name',
                    'email:email',
                    'department.department_name',
                ],
            ]) ?>

            <p>
                <?= Html::a('Edit profile', ['update', 'id' => $model->employee_id], ['class' => 'btn btn-primary']) ?>

            </p>
        </div>
    </div>
</div>


