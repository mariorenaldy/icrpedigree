<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Certificate</title>
  <?php $this->load->view('templates/head'); ?>
</head>
<body>
  <?php $this->load->view('templates/redirect'); ?>
    <?php $this->load->view('templates/header'); ?>
    <div class="text-danger">
        <?php		
            if ($this->session->flashdata('error')){
                echo $this->session->flashdata('error').'<br/>';
            }
        ?>
    </div>
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
            Silsilah yang ada di dalam sertifikat ini dapat diakses secara online melalui website ICRPedigree<br/>
          </div>
        </div>
        <div class="col md-4"><span class="desc">
          <ul>
            <li>Apabila Stambum hilang dapat melakukan pengajuan pembuatan stambum baru (duplikat)</li>
            <li>Anggota ICR dapat mengajukan pergantian nama kennel</li>
            <li>Anggota ICR dapat mengajukan pergantian nama, alamat kepemilikan serta update foto terbaru</li>
            <li>Syarat, ketentuan serta biaya dapat di lihat melalui web ICRPedigree <br></li>
          </ul><p><br></p><p>Catatan:</p>
          <ul>
            <li>Pihak ICR berhak melakukan pembatalan pengajuan apabila salah satu syarat dan ketentuan tidak dipenuhi</li>
            <li>Syarat dan ketentuan dapat berubah sewaktu waktu dan akan di informasikan melalui website ICRPedigree<br></li>
          </ul>
        </span></div>
        <div class="col md-4">
          <div class="notes-title mb-3">NOTES:</div>
            <ol class="p-0">
                <?php foreach ($notes AS $r){ 
                    echo '<li class="icr-note">'.$r->note_date.': '.$r->note_desc.'</li>'; 
                } ?>
            </ol>
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <button class="btn btn-primary" onclick="print()"><i class="fa fa-print"></i></button>
          <button type="button" class="btn btn-primary" onclick=view_back()>Back Certificate</button>
        </div>
      </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <?php $this->load->view('templates/script'); ?>
  <script>
    function view_back() {
      window.location = "<?= base_url(); ?>backend/Certificate/back/<?= $canine->can_id ?>";
    }
    function print() {
      w = window.open("<?= base_url(); ?>backend/Certificate/front/<?= $canine->can_id ?>/print", "_blank");
      w.print();
      w.onafterprint = function(){ 
        w.close();
      };
    }
  </script>
</body>
</html>