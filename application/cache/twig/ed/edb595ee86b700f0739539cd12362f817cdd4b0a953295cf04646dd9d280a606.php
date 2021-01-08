<?php

/* backend/management.twig */
class __TwigTemplate_e332a1ec3110186db0d3ad17038a0703a61e22fb5a962ee3450ca87898b4aca4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/management.twig", 1);
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
        echo "<!-- Page JS Plugins CSS -->
<link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">


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
</style>
";
    }

    // line 34
    public function block_body($context, array $blocks = array())
    {
        // line 35
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li>Manajemen</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-default btn-delete-management pull-left\"  data-toggle=\"tooltip\" title=\"Hapus yang dipilih\" disabled><i class=\"si si-trash\"></i></button>

            <button class=\"btn btn-primary btn-add-management pull-right\" onClick=\"openModal('#modal-add-management', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Manajemen\"><i class=\"si si-note\"></i></button>
            <h4> <small>Daftar</small> Manajemen</h4>
        </div>
        <div class=\"block-content table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
            <table class=\"table table-borderless table-striped data-managements\">
                <thead>
                    <tr>
                        <th width=\"5\">
                            <div class=\"checkbox-management-all\">
                              <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                            </div>
                        </th>
                        <th width=\"1%\">Foto</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-management\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-lg\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 79
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/managements/add\" class=\"form-add-management form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tambah Manajemen</h3>
                </div>
                <div class=\"block-content\">
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview\" width=\"100%\" src=\"";
        // line 93
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Upload Foto</span>
                              <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\"/>
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\"/>
                          </div>
                          <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                      </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"name-add-management\">Nama</label>
                          <input class=\"form-control\" id=\"name-add-management\" name=\"man_name\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"position-add-management\">Posisi</label>
                          <input class=\"form-control\" id=\"position-add-management\" name=\"man_position\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"email-add-management\">Email</label>
                          <input class=\"form-control\" id=\"email-add-management\" name=\"man_email\" type=\"email\" required>
                        </div>
                    </div>
                  </div>
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                      <label for=\"\">Sosial Media</label>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"facebook-add-management\">Facebook</label>
                          <input class=\"form-control\" id=\"facebook-add-management\" name=\"man_facebook\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"twitter-add-management\">Twitter</label>
                          <input class=\"form-control\" id=\"twitter-add-management\" name=\"man_twitter\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"instagram-add-management\">Instagram</label>
                          <input class=\"form-control\" id=\"instagram-add-management\" name=\"man_instagram\" type=\"text\" required>
                        </div>
                    </div>

                  </div>


                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-employee\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

<div class=\"modal fade\" id=\"modal-update-management\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-lg\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-management form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Manajemen</h3>
                </div>
                <div class=\"block-content\">
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 176
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Upload Foto</span>
                              <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\"/>
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\"/>
                          </div>
                          <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                      </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"name-update-management\">Nama</label>
                          <input class=\"form-control\" id=\"name-update-management\" name=\"man_name\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"position-update-management\">Posisi</label>
                          <input class=\"form-control\" id=\"position-update-management\" name=\"man_position\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"email-update-management\">Email</label>
                          <input class=\"form-control\" id=\"email-update-management\" name=\"man_email\" type=\"email\" required>
                        </div>
                    </div>
                  </div>
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                      <label for=\"\">Sosial Media</label>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"facebook-update-management\">Facebook</label>
                          <input class=\"form-control\" id=\"facebook-update-management\" name=\"man_facebook\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"twitter-update-management\">Twitter</label>
                          <input class=\"form-control\" id=\"twitter-update-management\" name=\"man_twitter\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"instagram-update-management\">Instagram</label>
                          <input class=\"form-control\" id=\"instagram-update-management\" name=\"man_instagram\" type=\"text\" required>
                        </div>
                    </div>

                  </div>


                </div>
          </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-management\">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->

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
                    <img width=\"100%\" src=\"/img/default.png\" alt=\"Picture\">
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
";
    }

    // line 269
    public function block_scripts($context, array $blocks = array())
    {
        // line 270
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 271
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 272
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 273
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 274
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 275
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 276
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 277
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 279
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 280
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_management.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/management.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  364 => 280,  360 => 279,  355 => 277,  351 => 276,  347 => 275,  343 => 274,  339 => 273,  335 => 272,  331 => 271,  328 => 270,  325 => 269,  229 => 176,  143 => 93,  126 => 79,  80 => 35,  77 => 34,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* */
/* */
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
/*     #imgPreview, #imgPreview-update{*/
/*         /*border-radius:50%;*//* */
/*         margin-bottom: 15px;*/
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Manajemen</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-default btn-delete-management pull-left"  data-toggle="tooltip" title="Hapus yang dipilih" disabled><i class="si si-trash"></i></button>*/
/* */
/*             <button class="btn btn-primary btn-add-management pull-right" onClick="openModal('#modal-add-management', 'add')" data-toggle="tooltip" title="Tambah Manajemen"><i class="si si-note"></i></button>*/
/*             <h4> <small>Daftar</small> Manajemen</h4>*/
/*         </div>*/
/*         <div class="block-content table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*             <table class="table table-borderless table-striped data-managements">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5">*/
/*                             <div class="checkbox-management-all">*/
/*                               <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                             </div>*/
/*                         </th>*/
/*                         <th width="1%">Foto</th>*/
/*                         <th>Nama</th>*/
/*                         <th>Posisi</th>*/
/*                         <th>Email</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-management" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-lg">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/managements/add" class="form-add-management form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tambah Manajemen</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Upload Foto</span>*/
/*                               <input type="file" class="upload" name="photo" id="imageInput"/>*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop"/>*/
/*                           </div>*/
/*                           <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                       </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="name-add-management">Nama</label>*/
/*                           <input class="form-control" id="name-add-management" name="man_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="position-add-management">Posisi</label>*/
/*                           <input class="form-control" id="position-add-management" name="man_position" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="email-add-management">Email</label>*/
/*                           <input class="form-control" id="email-add-management" name="man_email" type="email" required>*/
/*                         </div>*/
/*                     </div>*/
/*                   </div>*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                       <label for="">Sosial Media</label>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="facebook-add-management">Facebook</label>*/
/*                           <input class="form-control" id="facebook-add-management" name="man_facebook" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="twitter-add-management">Twitter</label>*/
/*                           <input class="form-control" id="twitter-add-management" name="man_twitter" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="instagram-add-management">Instagram</label>*/
/*                           <input class="form-control" id="instagram-add-management" name="man_instagram" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                   </div>*/
/* */
/* */
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-employee">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
/* */
/* <div class="modal fade" id="modal-update-management" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-lg">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-management form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Manajemen</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Upload Foto</span>*/
/*                               <input type="file" class="upload" name="photo" id="imageInput"/>*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update"/>*/
/*                           </div>*/
/*                           <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                       </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="name-update-management">Nama</label>*/
/*                           <input class="form-control" id="name-update-management" name="man_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="position-update-management">Posisi</label>*/
/*                           <input class="form-control" id="position-update-management" name="man_position" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="email-update-management">Email</label>*/
/*                           <input class="form-control" id="email-update-management" name="man_email" type="email" required>*/
/*                         </div>*/
/*                     </div>*/
/*                   </div>*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                       <label for="">Sosial Media</label>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="facebook-update-management">Facebook</label>*/
/*                           <input class="form-control" id="facebook-update-management" name="man_facebook" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="twitter-update-management">Twitter</label>*/
/*                           <input class="form-control" id="twitter-update-management" name="man_twitter" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="instagram-update-management">Instagram</label>*/
/*                           <input class="form-control" id="instagram-update-management" name="man_instagram" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                   </div>*/
/* */
/* */
/*                 </div>*/
/*           </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-management">Save</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
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
/*                     <img width="100%" src="/img/default.png" alt="Picture">*/
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
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_management.js"></script>*/
/* {% endblock %}*/
/* */
