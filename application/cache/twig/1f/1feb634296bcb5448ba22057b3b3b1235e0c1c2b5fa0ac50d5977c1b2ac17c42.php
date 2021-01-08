<?php

/* backend/profile.twig */
class __TwigTemplate_97c45ba61a38e5753aaa05f4d6d049ef3ce89f7eec2f710b26d30a3020e5b2cc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/profile.twig", 1);
        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'body' => array($this, 'block_body'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "template/backend.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_styles($context, array $blocks = array())
    {
        // line 4
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.css\" >
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/css/bootstrap-editable.css\" >
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

    .fileUpload input.uploadBG {
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
        /*margin-bottom: 15px;*/
    }
</style>
";
    }

    // line 46
    public function block_body($context, array $blocks = array())
    {
        // line 47
        echo "<div class=\"content wrap-breadcrum\" style=\"margin-top:-10px\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 50
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"link-effect\">Dashboard</a></li>
            <li>Profil</li>
        </ol>
    </div>
</div>

<!-- Main Container -->
<div class=\"content content-boxed\">
    <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"block\">
            <div class=\"block-content block-content-full\" style=\"text-align:justify !important;\">

            <div class=\"row\">
            <div class=\"col-md-1\"></div>
                <div class=\"col-md-8\">
                   <table class=\"table\">
                      <tr>
                        <th colspan=\"3\">
                            <center>
                                Profil Perusahaan
                            </center>
                        </th>
                      </tr>
                        <tr>
                          <th colspan=\"3\">
                            Identitas Perusahaan
                          </th>
                        </tr>

                        <tr>
                            <td width=\"30%\">Nama Perusahaan</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"prof_company_name\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"Nama Perusahaan\" class=\"editable editable-click\">";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_company_name", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Review</td>
                            <td>:</td>
                            <td>
                              <a id=\"prof_review\" href=\"#\" data-type=\"textarea\" data-pk=\"1\" data-title=\"Review\" class=\"editable editable-click\">";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_review", array()), "html", null, true);
        echo "</a>

                            </td>
                        </tr>

                        <tr>
                            <td>Deskripsi Perusahaan</td>
                            <td>:</td>
                            <td>
                                <a id=\"prof_desc\" href=\"#\" data-type=\"textarea\" data-pk=\"1\" data-title=\"Deskripsi\" class=\"editable editable-click\">";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_desc", array()), "html", null, true);
        echo "</a>
                              </td>
                        </tr>

                        <!-- <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_status", array()), "html", null, true);
        echo "</td>
                        </tr> -->

                    </table>

                    <form class=\"form-update-bg js-form1 validation form-horizontal\" action=\"";
        // line 112
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/profile/update_background/";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_id", array()), "html", null, true);
        echo "\" method=\"post\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                            ";
        // line 115
        if ($this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_background", array())) {
            // line 116
            echo "                                <img id=\"imgPreview-bg\" width=\"100%\" src=\"../";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_background", array()), "html", null, true);
            echo "\">
                            ";
        } else {
            // line 118
            echo "                                <img id=\"imgPreview-bg\" width=\"100%\" src=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\">
                            ";
        }
        // line 120
        echo "                              <div class=\"fileUpload btn btn-default btn-flat btn-block\" style=\"width:100%\">
                                  <span>Ubah Background Beranda</span>
                                  <input type=\"file\" class=\"uploadBG\" name=\"ImageFile\" id=\"imageInput\" required/>
                                  <input type=\"hidden\" class=\"\" name=\"srcDataCrop-bg\" id=\"srcDataCrop-bg\"/>
                              </div>
                              <!-- <small class=\"text-muted\">Rasio 2:3</small> -->
                            </div>
                        </div>
                      </form>

                </div>
                <div class=\"col-md-2 \">
                      <form class=\"form-update-logo js-form1 validation form-horizontal\" action=\"";
        // line 132
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/profile/update_logo/";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_id", array()), "html", null, true);
        echo "\" method=\"post\">
                          <div class=\"form-group\">
                              <div class=\"col-xs-12\">
                              ";
        // line 135
        if ($this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_logo", array())) {
            // line 136
            echo "                                  <img id=\"imgPreview\" width=\"90%\" src=\"../";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_logo", array()), "html", null, true);
            echo "\">
                              ";
        } else {
            // line 138
            echo "                                  <img id=\"imgPreview\" width=\"90%\" src=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/avatar1.jpg\">
                              ";
        }
        // line 140
        echo "                                <!-- <div class=\"fileUpload btn btn-default btn-flat btn-block\" style=\"width:90%\">
                                    <span>Ubah Logo</span>
                                    <input type=\"file\" class=\"upload\" name=\"ImageFile\" id=\"imageInput\" required/>
                                    <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\"/>

                                </div> -->

                              </div>
                          </div>
                        </form>

                </div>
                <div class=\"col-md-1\"></div>
            </div>
            </div></div>
        </div>
    </div>

</div>

<!-- Modal croper -->
<div class=\"modal fade\" id=\"cropper-modal\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" >
  <div class=\"modal-dialog modal-dialog-popout modal-dialog-top\">
    <div class=\"modal-content\">
        <div class=\"block block-themed block-transparent remove-margin-b\">
            <div class=\"block-header bg-primary-dark\">
                <ul class=\"block-options\">
                    <li>
                        <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                    </li>
                </ul>
                <h3 class=\"block-title\">Image Cropper</h3>
            </div>
            <div class=\"block-content\">
                <div id=\"cropper-wrap-img\">
                    <img width=\"100%\" src=\"";
        // line 175
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/default.png\" alt=\"Picture\">
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default pull-left\">Close</button>
            <button type=\"button\" class=\"btn btn-primary btn-crop\">Crop</button>
        </div>
    </div>
  </div>
</div>

<div class=\"modal fade\" id=\"cropper-modalBG\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" >
  <div class=\"modal-dialog modal-dialog-popout modal-dialog-top\">
    <div class=\"modal-content\">
        <div class=\"block block-themed block-transparent remove-margin-b\">
            <div class=\"block-header bg-primary-dark\">
                <ul class=\"block-options\">
                    <li>
                        <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                    </li>
                </ul>
                <h3 class=\"block-title\">Image Cropper</h3>
            </div>
            <div class=\"block-content\">
                <div id=\"cropper-wrap-img\">
                    <img width=\"100%\" src=\"";
        // line 201
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/default.png\" alt=\"Picture\">
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default pull-left\">Close</button>
            <button type=\"button\" class=\"btn btn-primary btn-cropBG\">Crop</button>
        </div>
    </div>
  </div>
</div>

<input type=\"hidden\" value=\"";
        // line 213
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"";
        // line 214
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_id", array()), "html", null, true);
        echo "\" class=\"studentId\" />
";
    }

    // line 217
    public function block_scripts($context, array $blocks = array())
    {
        // line 218
        echo "
<script src=\"";
        // line 219
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 220
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 221
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 222
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 223
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 224
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<!-- Page JS Code -->
<script src=\"";
        // line 226
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 227
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js\"></script>
<script src=\"";
        // line 228
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/base_forms_wizard.js\"></script>
<script src=\"";
        // line 229
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.min.js\"></script>
<!-- <script src=\"";
        // line 230
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/prof_password.js\"></script> -->

<script src=\"";
        // line 232
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/bootstrap-editable.js\"></script>
<script src=\"";
        // line 233
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/adm_profile.js\"></script>
<script>
    jQuery(function () {
        \$('#birthdate-add-student').datetimepicker({
            format: 'YYYY-MM-DD',
            showTodayButton: true,
            showClose: true,
            icons: {
                time: 'si si-clock',
                date: 'si si-calendar',
                up: 'si si-arrow-up',
                down: 'si si-arrow-down',
                previous: 'si si-arrow-left',
                next: 'si si-arrow-right',
                today: 'si si-size-actual',
                clear: 'si si-trash',
                close: 'si si-close'
            }
        });
        \$('#birthdate-update-student').datetimepicker({
            format: 'YYYY-MM-DD',
            showTodayButton: true,
            showClose: true,
            icons: {
                time: 'si si-clock',
                date: 'si si-calendar',
                up: 'si si-arrow-up',
                down: 'si si-arrow-down',
                previous: 'si si-arrow-left',
                next: 'si si-arrow-right',
                today: 'si si-size-actual',
                clear: 'si si-trash',
                close: 'si si-close'
            }
        });
    });


    // Logo
    \$('input.upload').on('change', function(e) {
        if (this.files && this.files[0].name.match(/\\.(jpg|jpeg|png|JPG|JPEG|PNG)\$/)) {
            var image = \$('#cropper-wrap-img > img'), cropBoxData, canvasData;
            var reader = new FileReader();
            reader.onload = function(e) {
                image.attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
            \$('#cropper-modal').modal('show');
        }else {
            alert('file not supported');
        }
    });

    \$('#cropper-modal').on('shown.bs.modal', function() {
        var image = \$('#cropper-wrap-img > img'), cropBoxData, canvasData;
        image.cropper({
            aspectRatio: 1 / 1,
            autoCropArea: 0.5,
            cropBoxResizable: true,
            checkImageOrigin: true,
            responsive: true,
            built: function() {
                // Strict mode: set crop box data first
                image.cropper('setCropBoxData', cropBoxData);
                image.cropper('setCanvasData', canvasData);
            },
        });
    });


    \$('.btn-crop').on('click', function(e) {
        var imgb64 = \$('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');
        \$('img#imgPreview').attr('src', imgb64);
        \$('#srcDataCrop').val(imgb64);
        \$('img#imgPreview-update').attr('src', imgb64);
        \$('#srcDataCrop-update').val(imgb64);
        var data = \$('.form-update-logo').serialize();
        var action = \$('.form-update-logo').attr('action');
        \$.ajax({
            url: action,
            method: 'POST',
            data: data,
            timeout: 10000,
            success: function(res) {
                res = \$.parseJSON(res);
                if (res.data == '1') {
                    swal({
                      title: \"Success\",
                      text: \"logo berhasil diubah!!\",
                      type: \"success\",
                      // showCancelButton: true,
                      confirmButtonColor: \"#3498DB\",
                      confirmButtonText: \"Ok\",
                      // cancelButtonText: \"Tetap Disini\",
                      closeOnConfirm: true
                    },
                    function(){
                          window.location.reload();
                    });
                } else {
                    swal(\"Oops...\", res.data, \"error\");
                }
            },
            error: function(jqXHR, exception) {
                alert(jqXHR.statusText);
            },
        });
        \$('#cropper-modal').modal('hide');
    });

    \$('#cropper-modal').on('hidden.bs.modal', function() {
        \$('#cropper-wrap-img > img').cropper('destroy');
        // \$('body').addClass('modal-open');
    });

</script>
";
    }

    public function getTemplateName()
    {
        return "backend/profile.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  384 => 233,  380 => 232,  375 => 230,  371 => 229,  367 => 228,  363 => 227,  359 => 226,  354 => 224,  350 => 223,  346 => 222,  342 => 221,  338 => 220,  334 => 219,  331 => 218,  328 => 217,  322 => 214,  318 => 213,  303 => 201,  274 => 175,  237 => 140,  231 => 138,  225 => 136,  223 => 135,  215 => 132,  201 => 120,  195 => 118,  189 => 116,  187 => 115,  179 => 112,  171 => 107,  161 => 100,  149 => 91,  139 => 84,  102 => 50,  97 => 47,  94 => 46,  54 => 9,  50 => 8,  46 => 7,  42 => 6,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{base_url()}}assets/sweetalert/dist/sweetalert.css" >*/
/* <link rel="stylesheet" href="{{base_url()}}assets/oneui/css/bootstrap-editable.css" >*/
/* <style>*/
/*     .fileUpload {*/
/*         position: relative;*/
/*         overflow: hidden;*/
/*     }*/
/*     .fileUpload input.upload {*/
/*         position: absolute;*/
/*         top: 0;*/
/*         right: 0;*/
/*         margin: 0;*/
/*         padding: 0;*/
/*         font-size: 20px;*/
/*         cursor: pointer;*/
/*         opacity: 0;*/
/*         filter: alpha(opacity=0);*/
/*     }*/
/* */
/*     .fileUpload input.uploadBG {*/
/*         position: absolute;*/
/*         top: 0;*/
/*         right: 0;*/
/*         margin: 0;*/
/*         padding: 0;*/
/*         font-size: 20px;*/
/*         cursor: pointer;*/
/*         opacity: 0;*/
/*         filter: alpha(opacity=0);*/
/*     }*/
/* */
/*     #imgPreview, #imgPreview-update{*/
/*         /*border-radius:50%;*//* */
/*         /*margin-bottom: 15px;*//* */
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrum" style="margin-top:-10px">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="{{base_url()}}" class="link-effect">Dashboard</a></li>*/
/*             <li>Profil</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* */
/* <!-- Main Container -->*/
/* <div class="content content-boxed">*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*           <div class="block">*/
/*             <div class="block-content block-content-full" style="text-align:justify !important;">*/
/* */
/*             <div class="row">*/
/*             <div class="col-md-1"></div>*/
/*                 <div class="col-md-8">*/
/*                    <table class="table">*/
/*                       <tr>*/
/*                         <th colspan="3">*/
/*                             <center>*/
/*                                 Profil Perusahaan*/
/*                             </center>*/
/*                         </th>*/
/*                       </tr>*/
/*                         <tr>*/
/*                           <th colspan="3">*/
/*                             Identitas Perusahaan*/
/*                           </th>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="30%">Nama Perusahaan</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="prof_company_name" href="#" data-type="text" data-pk="1" data-title="Nama Perusahaan" class="editable editable-click">{{profile.prof_company_name}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td>Review</td>*/
/*                             <td>:</td>*/
/*                             <td>*/
/*                               <a id="prof_review" href="#" data-type="textarea" data-pk="1" data-title="Review" class="editable editable-click">{{profile.prof_review}}</a>*/
/* */
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td>Deskripsi Perusahaan</td>*/
/*                             <td>:</td>*/
/*                             <td>*/
/*                                 <a id="prof_desc" href="#" data-type="textarea" data-pk="1" data-title="Deskripsi" class="editable editable-click">{{profile.prof_desc}}</a>*/
/*                               </td>*/
/*                         </tr>*/
/* */
/*                         <!-- <tr>*/
/*                             <td>Status</td>*/
/*                             <td>:</td>*/
/*                             <td>{{profile.prof_status}}</td>*/
/*                         </tr> -->*/
/* */
/*                     </table>*/
/* */
/*                     <form class="form-update-bg js-form1 validation form-horizontal" action="{{base_url()}}backend/profile/update_background/{{profile.prof_id}}" method="post">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                             {% if profile.prof_background %}*/
/*                                 <img id="imgPreview-bg" width="100%" src="../{{profile.prof_background}}">*/
/*                             {% else %}*/
/*                                 <img id="imgPreview-bg" width="100%" src="{{base_url()}}assets/oneui/img/avatars/image.png">*/
/*                             {% endif %}*/
/*                               <div class="fileUpload btn btn-default btn-flat btn-block" style="width:100%">*/
/*                                   <span>Ubah Background Beranda</span>*/
/*                                   <input type="file" class="uploadBG" name="ImageFile" id="imageInput" required/>*/
/*                                   <input type="hidden" class="" name="srcDataCrop-bg" id="srcDataCrop-bg"/>*/
/*                               </div>*/
/*                               <!-- <small class="text-muted">Rasio 2:3</small> -->*/
/*                             </div>*/
/*                         </div>*/
/*                       </form>*/
/* */
/*                 </div>*/
/*                 <div class="col-md-2 ">*/
/*                       <form class="form-update-logo js-form1 validation form-horizontal" action="{{base_url()}}backend/profile/update_logo/{{profile.prof_id}}" method="post">*/
/*                           <div class="form-group">*/
/*                               <div class="col-xs-12">*/
/*                               {% if profile.prof_logo %}*/
/*                                   <img id="imgPreview" width="90%" src="../{{profile.prof_logo}}">*/
/*                               {% else %}*/
/*                                   <img id="imgPreview" width="90%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                               {% endif %}*/
/*                                 <!-- <div class="fileUpload btn btn-default btn-flat btn-block" style="width:90%">*/
/*                                     <span>Ubah Logo</span>*/
/*                                     <input type="file" class="upload" name="ImageFile" id="imageInput" required/>*/
/*                                     <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop"/>*/
/* */
/*                                 </div> -->*/
/* */
/*                               </div>*/
/*                           </div>*/
/*                         </form>*/
/* */
/*                 </div>*/
/*                 <div class="col-md-1"></div>*/
/*             </div>*/
/*             </div></div>*/
/*         </div>*/
/*     </div>*/
/* */
/* </div>*/
/* */
/* <!-- Modal croper -->*/
/* <div class="modal fade" id="cropper-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" >*/
/*   <div class="modal-dialog modal-dialog-popout modal-dialog-top">*/
/*     <div class="modal-content">*/
/*         <div class="block block-themed block-transparent remove-margin-b">*/
/*             <div class="block-header bg-primary-dark">*/
/*                 <ul class="block-options">*/
/*                     <li>*/
/*                         <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                     </li>*/
/*                 </ul>*/
/*                 <h3 class="block-title">Image Cropper</h3>*/
/*             </div>*/
/*             <div class="block-content">*/
/*                 <div id="cropper-wrap-img">*/
/*                     <img width="100%" src="{{base_url()}}assets/oneui/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class="modal-footer">*/
/*             <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*             <button type="button" class="btn btn-primary btn-crop">Crop</button>*/
/*         </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* */
/* <div class="modal fade" id="cropper-modalBG" data-backdrop="static" data-keyboard="false" tabindex="-1" >*/
/*   <div class="modal-dialog modal-dialog-popout modal-dialog-top">*/
/*     <div class="modal-content">*/
/*         <div class="block block-themed block-transparent remove-margin-b">*/
/*             <div class="block-header bg-primary-dark">*/
/*                 <ul class="block-options">*/
/*                     <li>*/
/*                         <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                     </li>*/
/*                 </ul>*/
/*                 <h3 class="block-title">Image Cropper</h3>*/
/*             </div>*/
/*             <div class="block-content">*/
/*                 <div id="cropper-wrap-img">*/
/*                     <img width="100%" src="{{base_url()}}assets/oneui/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class="modal-footer">*/
/*             <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*             <button type="button" class="btn btn-primary btn-cropBG">Crop</button>*/
/*         </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="{{profile.prof_id}}" class="studentId" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* */
/* <script src="{{ base_url() }}assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/pages/base_forms_wizard.js"></script>*/
/* <script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>*/
/* <!-- <script src="{{ base_url() }}assets/oneui/js/pages/prof_password.js"></script> -->*/
/* */
/* <script src="{{ base_url() }}assets/oneui/js/bootstrap-editable.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/pages/adm_profile.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*         $('#birthdate-add-student').datetimepicker({*/
/*             format: 'YYYY-MM-DD',*/
/*             showTodayButton: true,*/
/*             showClose: true,*/
/*             icons: {*/
/*                 time: 'si si-clock',*/
/*                 date: 'si si-calendar',*/
/*                 up: 'si si-arrow-up',*/
/*                 down: 'si si-arrow-down',*/
/*                 previous: 'si si-arrow-left',*/
/*                 next: 'si si-arrow-right',*/
/*                 today: 'si si-size-actual',*/
/*                 clear: 'si si-trash',*/
/*                 close: 'si si-close'*/
/*             }*/
/*         });*/
/*         $('#birthdate-update-student').datetimepicker({*/
/*             format: 'YYYY-MM-DD',*/
/*             showTodayButton: true,*/
/*             showClose: true,*/
/*             icons: {*/
/*                 time: 'si si-clock',*/
/*                 date: 'si si-calendar',*/
/*                 up: 'si si-arrow-up',*/
/*                 down: 'si si-arrow-down',*/
/*                 previous: 'si si-arrow-left',*/
/*                 next: 'si si-arrow-right',*/
/*                 today: 'si si-size-actual',*/
/*                 clear: 'si si-trash',*/
/*                 close: 'si si-close'*/
/*             }*/
/*         });*/
/*     });*/
/* */
/* */
/*     // Logo*/
/*     $('input.upload').on('change', function(e) {*/
/*         if (this.files && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/)) {*/
/*             var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;*/
/*             var reader = new FileReader();*/
/*             reader.onload = function(e) {*/
/*                 image.attr('src', e.target.result);*/
/*             };*/
/* */
/*             reader.readAsDataURL(this.files[0]);*/
/*             $('#cropper-modal').modal('show');*/
/*         }else {*/
/*             alert('file not supported');*/
/*         }*/
/*     });*/
/* */
/*     $('#cropper-modal').on('shown.bs.modal', function() {*/
/*         var image = $('#cropper-wrap-img > img'), cropBoxData, canvasData;*/
/*         image.cropper({*/
/*             aspectRatio: 1 / 1,*/
/*             autoCropArea: 0.5,*/
/*             cropBoxResizable: true,*/
/*             checkImageOrigin: true,*/
/*             responsive: true,*/
/*             built: function() {*/
/*                 // Strict mode: set crop box data first*/
/*                 image.cropper('setCropBoxData', cropBoxData);*/
/*                 image.cropper('setCanvasData', canvasData);*/
/*             },*/
/*         });*/
/*     });*/
/* */
/* */
/*     $('.btn-crop').on('click', function(e) {*/
/*         var imgb64 = $('#cropper-wrap-img > img').cropper('getCroppedCanvas').toDataURL('image/png');*/
/*         $('img#imgPreview').attr('src', imgb64);*/
/*         $('#srcDataCrop').val(imgb64);*/
/*         $('img#imgPreview-update').attr('src', imgb64);*/
/*         $('#srcDataCrop-update').val(imgb64);*/
/*         var data = $('.form-update-logo').serialize();*/
/*         var action = $('.form-update-logo').attr('action');*/
/*         $.ajax({*/
/*             url: action,*/
/*             method: 'POST',*/
/*             data: data,*/
/*             timeout: 10000,*/
/*             success: function(res) {*/
/*                 res = $.parseJSON(res);*/
/*                 if (res.data == '1') {*/
/*                     swal({*/
/*                       title: "Success",*/
/*                       text: "logo berhasil diubah!!",*/
/*                       type: "success",*/
/*                       // showCancelButton: true,*/
/*                       confirmButtonColor: "#3498DB",*/
/*                       confirmButtonText: "Ok",*/
/*                       // cancelButtonText: "Tetap Disini",*/
/*                       closeOnConfirm: true*/
/*                     },*/
/*                     function(){*/
/*                           window.location.reload();*/
/*                     });*/
/*                 } else {*/
/*                     swal("Oops...", res.data, "error");*/
/*                 }*/
/*             },*/
/*             error: function(jqXHR, exception) {*/
/*                 alert(jqXHR.statusText);*/
/*             },*/
/*         });*/
/*         $('#cropper-modal').modal('hide');*/
/*     });*/
/* */
/*     $('#cropper-modal').on('hidden.bs.modal', function() {*/
/*         $('#cropper-wrap-img > img').cropper('destroy');*/
/*         // $('body').addClass('modal-open');*/
/*     });*/
/* */
/* </script>*/
/* {% endblock %}*/
/* */
