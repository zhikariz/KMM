<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Halaman Web Tidak Ditemukan !!!
    </p>
    <p>
        Silahkan Kontak Administrator Mengenai Kesalahan Ini !!! <br>Terimakasih
    </p>

</div>
