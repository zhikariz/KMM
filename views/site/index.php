<?php

/* @var $this yii\web\View */

$this->title = 'Sistem Informasi Dokumen Bank Indonesia';
use yii\bootstrap\Carousel;
$this->params['data'] = $dataJenisDokumen;
$this->params['data2'] = $dataSifatDokumen;
?>
<div class="site-index">


    <div class="body-content">

        <div class="jumbotron" style="background-color:white;">
        <div class="container text-center">
                <p><b>  Petunjuk Penggunaaan Sistem Informasi Dokumen </b></p>
                    <img src="https://www.kubik.co.id/wp-content/uploads/2016/07/Bank-Indonesia.png" width="400px" heigh="400px"/>

    </div>
        </div>
        <div class="col-sm-12 text-left">
          <p style="color:red"> Peraturan !!<br>Dilarang Merefresh Browser menggunakan tombol F5 atau tombol Refresh Browser Setelah Melakukan Proses Input maupun Edit<br>Karena dapat menyebabkan double input maupun double Edit dan menyebabkan Sampah Di Database</p>
          <p style="color:red;"><b> Administrator </b></p>
          <ol>
            <li>Administrator mempunyai fungsi global atau menyeluruh yang dapat mengakses seluruh dokumen dan memanajemen kebutuhan dari dokumen</li>
            <li>Kebutuhan dari dokumen Administratif adalah Satuan Kerja , Unit Kerja , dan Tim</li>
            <li>Kebutuhan dari dokumen Surat Jalan adalah Satuan Kerja</li>
            <li>Kebutuhan dari dokumen Nota Debet adalah Satuan Kerja dan Satker Pusat</li>
            <li>Kebutuhan dari dokumen Masuk adalah Pejabat , Unit Kerja dan Petunjuk Disposisi </li>
            <li>Jika Administrator Mengedit salah satu dokumen maka Administrator lain harus menyetujui pengeditan dokumen tersebut</li>
            <li>Administrator tidak dapat menyetujui dokumen yang di input oleh operator maupun administrator lain.</li>
            <li>Administrator dapat menyetujui pengeditan dokumen dari operator maupun administrator lain</li>

          </ol>
          <p style="color:green;"><b> Operator</b> </p>
          <ol>
            <li>Operator hanya dapat menginput dokumen dan mengedit dokumen</li>
            <li>Dalam proses pengeditan dokumen dibutuhkan Administrator untuk menyetujui supaya dokumen yang diedit bisa terganti dengan data yang baru</li>
          </ol>
          <p style="color:blue;"><b> Approval </b></p>
          <ol>
            <li>Approval hanya dapat melihat dokumen masuk dan dokumen keluar</li>
            <li>Di dokumen keluar Approval bisa menyetujui dokumen yang nama pengesahnya sama dengan nama Approval tersebut</li>
          </ol>
        </div>



    </div>
</div>
