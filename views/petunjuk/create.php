<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Petunjuk */

$this->title = 'Create Petunjuk';
$this->params['breadcrumbs'][] = ['label' => 'Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="petunjuk-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
