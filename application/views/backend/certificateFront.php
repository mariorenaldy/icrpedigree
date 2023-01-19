<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Certificate</title>
  <?php $this->load->view('templates/head'); ?>
</head>
<body>
  <?php $this->load->view('templates/redirect'); ?>
  <div class="marginCertificate">
    <div class="row">
      <div class="col md-4">
        <figure class="text-center">
          <img src="<?= base_url('assets/img/icr_logo_hitam.png') ?>" class="center-block text-center" style="width: 20vw;">
        </figure>
        <div class="icr-title mb-3 text-center">INDONESIAN CANINE REGISTRY</div>
        <div class="icr-desc text-center">Sertifikat ini hanya diterbitkan oleh Indonesian Canine Registry. Silsilah yang ada di dalam sertifikat ini dapat diakses secara online melalui website www.icrpedigree.com</div>
      </div>
      <div class="col md-4 baskerville"><span class="desc"><?= $rules->set_rule; ?></span></div>
      <div class="col md-4 baskerville">
        <div class="notes-title mb-3">NOTES:</div>
        <!-- <ol class="p-0" style="list-style-position: inside;">
          <li>July 4, 1969: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
          <li>20 July, 1969: Nam hendrerit nisi sed sollicitu-din pellentesque. </li>
          <li>January 4, 1996: Nunc posuere purus rhon-Cols pulvinar aliquam. </li>
          <li>August 6, 1945: Ut aliquet tristique nisi vitae volutpat. </li>
          <li>April 13, 1961: Nulls aliquet porttitor venena-tis. </li>
          <li>October 12, 1942: Donee a dui et dui fringilla consectetur id nec massa. </li>
        </ol> -->
      </div>
    </div>
  </div>
  <?php $this->load->view('templates/script'); ?>
</body>
</html>