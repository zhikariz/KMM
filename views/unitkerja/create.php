<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Unitkerja */

$this->title = 'Create Unit Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Unit Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="unitkerja-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
