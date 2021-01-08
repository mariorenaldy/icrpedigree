<?php

/* backend/members.twig */
class __TwigTemplate_4929ba3eedb12cb49b960ae89fdfd9c312b1ce013a6e19b6f26175eaac99c2dd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/members.twig", 2);
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

    // line 4
    public function block_styles($context, array $blocks = array())
    {
        // line 5
        echo "<!-- Page JS Plugins CSS -->
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">

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
            <li>Members</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-success btn-activate-member pull-left\"  data-toggle=\"tooltip\" title=\"Aktivasi yang dipilih\" disabled><i class=\"si si-check\"></i></button>
            <button class=\"btn btn-danger btn-deactivate-member pull-left\"  data-toggle=\"tooltip\" title=\"Deaktivasi yang dipilih\" disabled><i class=\"si si-close\"></i></button>

            <button class=\"btn btn-primary btn-add-member pull-right\" onClick=\"openModal('#modal-add-member', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Member\"><i class=\"si si-note\"></i></button>
            <h4>Daftar Member</h4>
        </div>
        <div class=\"block-content\">
            <div class=\"table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
                <table class=\"table table-borderless table-striped data-members\">
                    <thead>
                        <tr>
                            <th width=\"5\">
                                <div class=\"checkbox-member-all\">
                                <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                                </div>
                            </th>
                            <th width=\"1%\">Foto</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Alamat Surat</th>
                            <th>No. Telp</th>
                            <th>Status</th>
                            <th>Approver</th>
                            <th>Tanggal Approve</th>
                            <th class=\"text-center\" width=\"1%\">#</th>
                            <th class=\"text-center\" width=\"1%\">#</th>
                            <th class=\"text-center\" width=\"1%\">#</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-member\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 88
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/members/add\" class=\"form-add-member form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tambah Member</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 101
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Upload KTP</span>
                              <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\" required/>
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\" required/>
                          </div>
                          <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                      </div>
                    </div>
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"name-add-member\">Nama Member</label>
                            <input class=\"form-control\" id=\"name-add-member\" name=\"mem_name\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"address-add-member\">Alamat Member</label>
                            <input class=\"form-control\" id=\"address-add-member\" name=\"mem_address\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"mail-address-add-member\">Alamat Surat Member</label>
                            <input class=\"form-control\" id=\"mail-address-add-member\" name=\"mem_mail_address\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"hp-add-member\">No. Telp</label>
                            <input class=\"form-control\" id=\"hp-add-member\" name=\"mem_hp\" type=\"text\" required>
                        </div>
                    </div>
                  </div>
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                            <label for=\"username-add-user\">Username</label>
                            <input class=\"form-control\" id=\"username-add-user\" name=\"mem_username\" type=\"text\" required>
                            </div>
                    </div>
                    <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                            <label for=\"password-add-member\">Kata Sandi</label>
                            <input class=\"form-control\" id=\"password-add-member\" name=\"password\" type=\"password\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"repass-add-member\">Konfirmasi Kata Sandi</label>
                                <input class=\"form-control\" id=\"repass-add-member\" name=\"repass\" type=\"password\" required>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-member\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

<div class=\"modal fade\" id=\"modal-update-member\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-member form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Member</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 184
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                                <span>Upload KTP</span>
                                <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\" />
                            </div>
                            <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                        </div>
                    </div>
                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"name-update-member\">Nama Member</label>
                                <input class=\"form-control\" id=\"name-update-member\" name=\"mem_name\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"address-update-member\">Alamat Member</label>
                                <input class=\"form-control\" id=\"address-update-member\" name=\"mem_address\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"mail-address-update-member\">Alamat Surat Member</label>
                                <input class=\"form-control\" id=\"mail-address-update-member\" name=\"mem_mail_address\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"hp-update-member\">No. Telp</label>
                                <input class=\"form-control\" id=\"hp-update-member\" name=\"mem_hp\" type=\"text\" required>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"username-update-member\">Username</label>
                                <input class=\"form-control\" id=\"username-update-member\" name=\"mem_username\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"pass-update-member\">Kata Sandi</label>
                                <input class=\"form-control\" id=\"pass-update-member\" name=\"password\" type=\"password\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"newpass-update-member\">Kata Sandi Baru</label>
                                <input class=\"form-control\" id=\"newpass-update-member\" name=\"newpass\" type=\"password\">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-member\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->

<div class=\"modal fade\" id=\"modal-update-password\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-password form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Reset Password</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"username-update-password\">Username</label>
                                <input class=\"form-control\" id=\"username-update-password\" name=\"mem_username\" type=\"text\" readonly>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"pass-update-password\">Kata Sandi</label>
                                <input class=\"form-control\" id=\"pass-update-password\" name=\"password\" type=\"password\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"newpass-update-password\">Kata Sandi Baru</label>
                                <input class=\"form-control\" id=\"newpass-update-password\" name=\"repass\" type=\"password\">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-password\">Simpan</button>
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

    // line 324
    public function block_scripts($context, array $blocks = array())
    {
        // line 325
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 326
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 327
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 328
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 329
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 330
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 332
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 333
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_member.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/members.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  410 => 333,  406 => 332,  401 => 330,  397 => 329,  393 => 328,  389 => 327,  385 => 326,  382 => 325,  379 => 324,  236 => 184,  150 => 101,  134 => 88,  79 => 35,  76 => 34,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* {# ARTechnology #}*/
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
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
/*             <li>Members</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-success btn-activate-member pull-left"  data-toggle="tooltip" title="Aktivasi yang dipilih" disabled><i class="si si-check"></i></button>*/
/*             <button class="btn btn-danger btn-deactivate-member pull-left"  data-toggle="tooltip" title="Deaktivasi yang dipilih" disabled><i class="si si-close"></i></button>*/
/* */
/*             <button class="btn btn-primary btn-add-member pull-right" onClick="openModal('#modal-add-member', 'add')" data-toggle="tooltip" title="Tambah Member"><i class="si si-note"></i></button>*/
/*             <h4>Daftar Member</h4>*/
/*         </div>*/
/*         <div class="block-content">*/
/*             <div class="table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*                 <table class="table table-borderless table-striped data-members">*/
/*                     <thead>*/
/*                         <tr>*/
/*                             <th width="5">*/
/*                                 <div class="checkbox-member-all">*/
/*                                 <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                                 </div>*/
/*                             </th>*/
/*                             <th width="1%">Foto</th>*/
/*                             <th>Nama</th>*/
/*                             <th>Alamat</th>*/
/*                             <th>Alamat Surat</th>*/
/*                             <th>No. Telp</th>*/
/*                             <th>Status</th>*/
/*                             <th>Approver</th>*/
/*                             <th>Tanggal Approve</th>*/
/*                             <th class="text-center" width="1%">#</th>*/
/*                             <th class="text-center" width="1%">#</th>*/
/*                             <th class="text-center" width="1%">#</th>*/
/*                         </tr>*/
/*                     </thead>*/
/*                 </table>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-member" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/members/add" class="form-add-member form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tambah Member</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Upload KTP</span>*/
/*                               <input type="file" class="upload" name="photo" id="imageInput" required/>*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update" required/>*/
/*                           </div>*/
/*                           <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                       </div>*/
/*                     </div>*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="name-add-member">Nama Member</label>*/
/*                             <input class="form-control" id="name-add-member" name="mem_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="address-add-member">Alamat Member</label>*/
/*                             <input class="form-control" id="address-add-member" name="mem_address" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="mail-address-add-member">Alamat Surat Member</label>*/
/*                             <input class="form-control" id="mail-address-add-member" name="mem_mail_address" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="hp-add-member">No. Telp</label>*/
/*                             <input class="form-control" id="hp-add-member" name="mem_hp" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                   </div>*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                             <label for="username-add-user">Username</label>*/
/*                             <input class="form-control" id="username-add-user" name="mem_username" type="text" required>*/
/*                             </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                             <label for="password-add-member">Kata Sandi</label>*/
/*                             <input class="form-control" id="password-add-member" name="password" type="password" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="repass-add-member">Konfirmasi Kata Sandi</label>*/
/*                                 <input class="form-control" id="repass-add-member" name="repass" type="password" required>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*               </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-member">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
/* */
/* <div class="modal fade" id="modal-update-member" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-member form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Member</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                                 <span>Upload KTP</span>*/
/*                                 <input type="file" class="upload" name="photo" id="imageInput" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop" />*/
/*                             </div>*/
/*                             <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="col-md-6">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="name-update-member">Nama Member</label>*/
/*                                 <input class="form-control" id="name-update-member" name="mem_name" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="address-update-member">Alamat Member</label>*/
/*                                 <input class="form-control" id="address-update-member" name="mem_address" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="mail-address-update-member">Alamat Surat Member</label>*/
/*                                 <input class="form-control" id="mail-address-update-member" name="mem_mail_address" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="hp-update-member">No. Telp</label>*/
/*                                 <input class="form-control" id="hp-update-member" name="mem_hp" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="col-md-6">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="username-update-member">Username</label>*/
/*                                 <input class="form-control" id="username-update-member" name="mem_username" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="pass-update-member">Kata Sandi</label>*/
/*                                 <input class="form-control" id="pass-update-member" name="password" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="newpass-update-member">Kata Sandi Baru</label>*/
/*                                 <input class="form-control" id="newpass-update-member" name="newpass" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-member">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
/* <div class="modal fade" id="modal-update-password" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-password form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Reset Password</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="col-md-6">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="username-update-password">Username</label>*/
/*                                 <input class="form-control" id="username-update-password" name="mem_username" type="text" readonly>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="pass-update-password">Kata Sandi</label>*/
/*                                 <input class="form-control" id="pass-update-password" name="password" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="newpass-update-password">Kata Sandi Baru</label>*/
/*                                 <input class="form-control" id="newpass-update-password" name="repass" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-password">Simpan</button>*/
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
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_member.js"></script>*/
/* {% endblock %}*/
/* */
