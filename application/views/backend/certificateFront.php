<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Certificate</title>
  <?php $this->load->view('templates/head'); ?>
  <link href="<?php echo base_url(); ?>assets/css/backend-styles.css" rel="stylesheet" media='all' />
</head>
<body>
  <?php $this->load->view('templates/redirect'); ?>
  <div class="container">
    <div class="row">
      <div class="col md-4" style="font-family:Cen725c;">
        <figure class="text-center">
          <img src="<?= base_url('assets/img/icr_logo_hitam.png') ?>" class="center-block text-center" style="width: 20vw;">
        </figure>
        <h5 class="mb-3 text-center fs-3">INDONESIAN CANINE REGISTRY</h5>
        <p class="text-center">Sertifikat ini hanya diterbitkan oleh Indonesian Canine Registry. Harap membaca ketentuan dan peraturan pada sertifikat ini
        <br>Silsilah yg ada di dalam sertifikat ini dapat di akses secara online melalui website www.icrpedigree.com</p>
      </div>
      <div class="col-md-5" style="font-family: baskerville;">
        <span>Peraturan:</span>
        <ul style="list-style-type: none; padding-left: 0;">
          <li>- Apabila Stambum hilang dapat melakukan pengajuan pembuatan stambum baru (duplikat)</li>
          <li>- Angota ICR dapat mengajukan pergantian nama kennel</li>
          <li>- Anggota ICR dapat mengajukan pergantian nama, alamat kepemilikan serta update foto terbaru</li>
          <li>- Syarat, ketentuan serta biaya dapat di lihat melalui web www.icrpedigree.com</li>
        </ul>

        <span>Catatan:</span><br>
        <span>Pihak ICR berhak melakukan pembatalan pengajuan apabila salah satu syarat dan ketentuan tidak dipenuhi.</span><br>
        <span>Syarat dan ketentuan dapat berubah sewaktu waktu dan akan di informasikan melalui website www.icrpedigree.com</span>
      </div>
      <div class="col-md" style="font-family: baskerville;">
        <span>Catatan:</span><br>
      </div>
    </div>
  </div>
  <?php $this->load->view('templates/script'); ?>
</body>
</html>