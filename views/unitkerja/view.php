<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\Unitkerja */

$this->title = "Detail Unit Kerja : ".$model->kode_unit_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Unit Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="unitkerja-view">
  <?php foreach (Yii::$app->session->getAllFlashes() as $message) {
      echo SweetAlert::widget([
          'options' => [
              'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
              'text' => (!empty($message['text'])) ? Html::encode($message['text']) : 'Text Not Set!',
              'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
              'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
              'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true,
          ]
      ]);
  }?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode_unit_kerja], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_unit_kerja], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_unit_kerja',
            'ket_unit_kerja',
        ],
    ]) ?>

</div>
