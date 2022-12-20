<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Certificate</title>
    <!-- <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/suneditor.min.css" rel="stylesheet" /> -->

    <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">
    <link rel="stylesheet" href="{{ base_url()}}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">
    <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/fonts/MTCORSVA/font.css">
    <style>
      .fileUpload {
          position: relative;
          overflow: hidden;
      }
      .fileUpload input.upload {
          position: absolute;
          top: 0;
          right: 0;
          margin: 0;
          padding: 0;
          font-size: 20px;
          cursor: pointer;
          opacity: 0;
          filter: alpha(opacity=0);
      }
      #imgPreview, #imgPreview-update{
          /*border-radius:50%;*/
          margin-bottom: 15px;
      }
      td{
        padding: 5px 5px;
      }
      .cert {
        /*background: blue;*/
        /* {% for trah in trahs %}
            {% if trah.tra_name == canine[0].can_breed  %}
                background: url('{{base_url()}}{{trah.tra_front}}') no-repeat;
            {% endif %}
        {% endfor %} */

        background-size: contain;
        /*background-color: black;*/
      }
      .tentang_surat, .isi_surat{
        /*font-weight: bold;*/
        letter-spacing: 1px;
      }
      /*.tentang_surat h2, .tentang_surat h3, .tentang_surat p{
        font-family: 'MTCORSVA' !important;
      }*/
      .tentang_surat h2{
        margin-top: -10px;
      }
      .tentang_surat h3{
        margin-top: -5px;
        margin-bottom: -5px;
        font-size: 25px;
      }
      .tentang_surat p{
        font-size: 16px;
        line-height: 1;
      }
      .isi_surat{
        font-size: 19px;
        letter-spacing: 0px;
      }
      .kopsurat{
        text-align: right;
        padding-right: 0px;
      }

      @media print{
        .cert {
          /*background: blue;*/
          margin: 0px !important;
        }
        body{
          /* {% for trah in trahs %}
              {% if trah.tra_name == canine[0].can_breed  %}
          background: url('{{base_url()}}{{trah.tra_front}}') no-repeat no-repeat !important;
              {% endif %}
          {% endfor %} */
          /* background: url('{{base_url()}}assets/depan.jpg') no-repeat !important; */
          background-size: contain !important;
                padding: 0px !important;
                margin: 0px !important;  /* the margin on the content before printing */
      }

        .graph-image img{
            display:inline !important;
        }
        .kopsurat{
          margin-top: -40px;
        }
        .konten_surat{
          color: red !important;
        }
        .as{
            /*margin-left: 110px;*/
            color: red !important;
        }

        .as2{
            /*margin-left: 110px;*/
            color: white !important;
        }

      .dam{
          color: red !important;
        }

        .sire{
          color: red !important;
        }

        .white{
          color: white !important;
        }
    }
    /*@page narrow {size: 0mm 0mm}*/
    /*@page rotated {size: landscape}*/

    @page {
          size:  landscape;   /* auto is the initial value */
          margin: 0mm;
      }
      .tentang_surat{
        text-align: left;
        /*margin-top: 181px;*/
        margin-top: 185px;
        /*margin-top: 164px;*/
        padding-top: 30px;
        font-family: Arial, sans-serif !important;
      }


  </style>
</head>
<body>
<?php
    if (!$this->session->userdata('use_username')){
        echo '<script type="text/javascript">';
        echo 'window.location = "'.base_url().'backend/Users/login";';
        echo '</script>';
    }
?>

<!-- <?php $this->load->view('templates/header'); ?>   -->
<!-- Page Content -->

<div class="content">
  <div class="block graph-image cert">
    <!-- <div class="block-header text-center bg-gray-lighter">
      <button class="btn btn-primary btn-add-section-detail pull-right" onClick="openModal('#modal-add-section-detail', 'add')" data-toggle="tooltip" title="Cetak Pengumuman"><i class="si si-printer"></i></button>
      <h4>Pengumuman <small>Detail</small></h4>
    </div> -->
    <div class="block-content" style="background-color: black;">
        <div class="surat">
            <div class="row kopsurat">
            <u>{{certificate_number}}</u>
            </div>
            <div class="row">
              <div class="col-xs-12 tentang_surat" style="color:white;">
                  <div class="konten_surat"style="margin-left: 175px;">
                  <!-- <div  style="margin-left: 208px;" > -->
                    <img class="pull-right" style=" margin-right: 70px; margin-top: -15px;" src="{{base_url()}}uploads/canine/{{canine[0].can_photo}}" width="400px" alt="" />
                    {# {% if canine[0].can_as_count > 28 %}

                      {% if canine[0].can_icr_number != '-' %}
                        <p class="as" style="color:red; width: 310px;" >{{canine[0].can_a_s}}</p>
                          {% else %}
                        <p class="as2" style="color:white; width: 310px;" >{{canine[0].can_a_s}}</p>
                      {% endif %}


                        <!-- </p> -->
                        <p class="white" style="margin-top:-3px;">
                          {{canine[0].can_icr_number}}
                        </p>
                    {% else %} #}

                    {% if canine[0].can_icr_number != '-' %}
                        <p class="as" style="color:red;" >{{canine[0].can_a_s}}</p>
                        {% else %}
                        <p class="as2" style="color:white;" >{{canine[0].can_a_s}}</p>
                    {% endif %}


                        <!-- </p> -->
                        <p class="white" style="margin-top:34px;">
                          {{canine[0].can_icr_number}}
                        </p>
                    {# {% endif %} #}
                    <p class="white" style="margin-top: -13px;
                                            margin-bottom: 6px;">{{canine[0].can_breed}}</p>
                    <p  class="white"  >
                        {{canine[0].can_gender}}
                    </p>
                    <p class="white" style="margin-top:-12px;">
                        {{canine[0].can_color}}
                    </p>
                    <p class="white" style="margin-top:-13px;">
                        {{canine[0].can_date_of_birth|date('F')}} {{canine[0].can_date_of_birth|date('d')}}{% if canine[0].can_date_of_birth|date('d') == 1 %}st,{% elseif canine[0].can_date_of_birth|date('d') == 2 %}rd,{% elseif canine[0].can_date_of_birth|date('d') == 3 %}rd,{% else %}th,{% endif %} {{canine[0].can_date_of_birth|date('Y')}}
                    </p>
                    <br>
                    <p class="white" style="margin-top:-15px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{canine[0].can_icr_moc_number}}
                    </p>
                    {% if canine[0].sire %}
                      {% for sire in canine[0].sire %}
                        {% if sire %}

                                {% if sire.can_icr_number != '-' %}
                                        {% if sire.sire_as_count > 5 %}
                                          <p class="sire"style="margin-top: 32px; color:red; width: 310px; font-size: 12px; margin-bottom: 20px;">
                                              {{sire.can_a_s}}
                                          </p>
                                          {% else %}
                                          <!-- ini yg ditambahkan -->
                                          <p class="sire"style="margin-top: 33px; color:red; font-size: 13px; margin-bottom: 20px;">
                                              {{sire.can_a_s}}
                                          </p>
                                        {% endif %}

                                    {% else %}

                                        {% if sire.sire_as_count > 5 %}
                                          <p class="white"style="margin-top: 30px; color:red; width: 310px; font-size: 12px; margin-bottom: 20px;">
                                              {{sire.can_a_s}}
                                          </p>
                                          {% else %}
                                          <!-- ini yg ditambahkan -->
                                          <p class="white"style="margin-top: 33px; color:white; font-size: 13px; margin-bottom: 20px;">
                                              {{sire.can_a_s}}
                                          </p>
                                        {% endif %}

                                {% endif %}



                              {% if sire.can_icr_number != '-' %}
                                <p class="white" style="margin-top:-11.5px;">
                                    {{sire.can_icr_number}}
                                </p>
                              {% else %}
                                <p class="white" style="margin-top:-15px;">
                                    {{sire.can_current_reg_number}}
                                </p>
                              {% endif %}
                            {% else %}
                              <p class="white"style="margin-top: 33px; color:white;">
                                -
                              </p>
                              <p class="white" style="margin-top:-11.5px;">
                                -
                              </p>
                        {% endif %}
                      {% endfor %}
                    {% else %}
                        <p class="sire"style="margin-top: 33px; color:red">
                          -
                        </p>
                        <p class="white" style="margin-top:-11.5px;">
                          -
                        </p>
                    {% endif %}

                    {% if canine[0].dam %}
                      {% for dam in canine[0].dam %}
                        {% if dam %}

                              {% if dam.can_icr_number != '-' %}
                                      {% if dam.dam_as_count > 5 %}
                                        <p class="dam" style="margin-top: -10px; color:red; font-size: 13px; margin-bottom: 24px;">
                                            {{dam.can_a_s}}
                                        </p>
                                        {% else %}
                                        <!-- ini tes -->
                                        <p class="dam" style="margin-top:-15px;color:red; font-size: 13px; margin-bottom: 24px;">
                                            {{dam.can_a_s}}
                                        </p>
                                      {% endif %}

                                  {% else %}

                                  {% if dam.dam_as_count > 5 %}
                                    <p class="white" style="margin-top: -10px; color:white; font-size: 13px; margin-bottom: 24px;">
                                        {{dam.can_a_s}}
                                    </p>
                                    {% else %}
                                    <!-- ini tes -->
                                    <p class="white" style="margin-top:-15px;color:white; font-size: 13px; margin-bottom: 24px;">
                                        {{dam.can_a_s}}
                                    </p>
                                  {% endif %}

                              {% endif %}

                              {% if dam.can_icr_number != '-' %}
                                <p class="white" style="margin-top:-15px;">
                                  {{dam.can_icr_number}}
                              </p>
                              {% else %}
                              <p class="white" style="margin-top:-15px;">
                                  {{dam.can_current_reg_number}}
                              </p>
                              {% endif %}
                              
                            {% else %}
                              <p class="dam"style="margin-top: -15px; color:red">
                                -
                              </p>
                              <p class="white" style="margin-top:-15px;">
                                -
                              </p>
                        {% endif %}
                      {% endfor %}
                    {% else %}
                      <p class="dam"style="margin-top: -15px; color:red">
                        -
                      </p>
                      <p class="white" style="margin-top:-15px;">
                        -
                      </p>
                    {% endif %}

                    <!-- <p style="margin-top:-11px;color:red;">
                        PR.ARSENAL
                    </p>
                    <p class="sire"style="margin-top:-11px;">
                        16-D-09
                    </p> -->
                      </div>


                  <div  style="margin-top: 127px;margin-left: 45px;width: 450px;">
                    <center>
                      <h4 class="white" style="font-size: 22px;">{{canine[0].can_owner}}</h4>
                      <h5 class="white" style="font-size: 16px;">{{canine[0].can_address}}</h5>
                    </center>
                  </div>

              </div>


              <div class="col-xs-12 isi_surat">
                <!-- <br><br><br> -->


                <br class="hidden-print">
                <br class="hidden-print">
                <br class="hidden-print">
                <br class="hidden-print">

              </div>
              <div class="clearfix hidden-print"></div>
              <hr class="hidden-print hidden-print">

              <button class="btn btn-primary pull-right hidden-print" onclick="_print(this)" title="Cetak Sertifikat"><i class="si si-printer"></i>&nbsp;&nbsp;Cetak Sertifikat Depan</button>

              <a href="{{base_url()}}backend/certificate/belakang/{{canine[0].can_id}}" class="btn btn-primary btn-done pull-right hidden-print" title="cetak sertifikat Belakang" style="margin-right:10px; display:none"><i class="si si-printer"></i>&nbsp;&nbsp;Cetak Sertifikat Belakang</a>
              <div class="clearfix hidden-print"></div>
              <br class="hidden-print">
            </div>
        </div>
    </div>
<!-- Dynamic Table Full -->
  </div>
</div>

<!-- Page JS Plugins -->
<script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ base_url() }}/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>
<script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>
<script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>
<script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>
<!-- Page JS Code -->
<input type="hidden" value="{{ base_url() }}" class="base_url" />
<script src="{{ base_url() }}/assets/oneui/js/pages/adm_section_detail.js"></script>
<script type="text/javascript">
jQuery(function () {
    $('#page-container').addClass('sidebar-mini');
});
function _print(btn){
  App.initHelper('print-page');
  $('.btn-done').show();
  $(btn).hide();
}
function _chstat(scoid){
  $.post('{{base_url()}}scores/update_student_score_status/'+scoid, function(res){
    res = $.parseJSON(res);
    if (res.data == '1') {
        $.post('{{base_url()}}certificate/add/'+scoid, function(res2){
          res2 = $.parseJSON(res2);
          if (res2.data == '1') {
            alert('proses selesai');
            document.location.href = '{{base_url()}}certificate/filing';
          }else {
              alert('proses gagal silahkan ulangi lagi');
          }
        });
    }else {
        alert('proses gagal silahkan ulangi lagi');
    }
  })
}
</script>
</body>
</html>