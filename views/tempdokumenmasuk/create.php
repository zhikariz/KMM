<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempDokumenMasuk */

$this->title = 'Create Temp Dokumen Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Temp Dokumen Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temp-dokumen-masuk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
