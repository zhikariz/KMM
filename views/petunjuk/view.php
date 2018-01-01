<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use aryelds\sweetalert\SweetAlert;

/* @var $this yii\web\View */
/* @var $model app\models\Petunjuk */

$this->title = "Detail Petunjuk : ".$model->id_petunjuk;
$this->params['breadcrumbs'][] = ['label' => 'Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="petunjuk-view">
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
        <?= Html::a('Update', ['update', 'id' => $model->id_petunjuk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_petunjuk], [
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
            'id_petunjuk',
            'keterangan_petunjuk',
        ],
    ]) ?>

</div>
