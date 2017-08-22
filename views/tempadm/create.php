<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempAdm */

$this->title = 'Create Temp Adm';
$this->params['breadcrumbs'][] = ['label' => 'Temp Adms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="temp-adm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
