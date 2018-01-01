<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="user-create">


    <?= $this->render('_form', [
        'model' => $model,
        'dataRole' => $dataRole,
    ]) ?>

</div>
