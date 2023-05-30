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
          <img src="<?= base_url('assets/img/frontcertificatelogo.png') ?>" class="center-block text-center" style="width: 23vw;">
        </figure>
        <div class="icr-title mb-3 text-center">INDONESIAN CANINE REGISTRY</div>
        <div class="icr-desc text-center">
          Sertifikat ini hanya diterbitkan oleh Indonesian Canine Registry.<br/>
          Harap membaca ketentuan dan peraturan yang ada di bagian belakang sertifikat.<br/>
          Silsilah yang ada di dalam sertifikat ini dapat diakses secara online melalui website www.icrpedigree.com<br/>
        </div>
      </div>
      <div class="col md-4"><span class="desc"><?= $rules->set_rule; ?></span></div>
      <div class="col md-4">
        <div class="notes-title mb-3">NOTES:</div>
            <ol class="p-0">
                <?php foreach ($notes AS $r){ 
                    echo '<li class="icr-note">'.$r->note_date.': '.$r->note_desc.'</li>'; 
                } ?>
            </ol>
      </div>
    </div>
  </div>
  <?php $this->load->view('templates/script'); ?>
</body>
</html>