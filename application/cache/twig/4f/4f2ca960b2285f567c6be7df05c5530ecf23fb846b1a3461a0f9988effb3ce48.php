<?php

/* backend/members.twig */
class __TwigTemplate_00569b936c756a6790e012749031dd82b48599ba38fc944a53e7e8ef26005ee3 extends Twig_Template
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
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/select2/css/select2.min.css\" />
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
    #imgPreview, #imgPreviewPP, 
    #imgPreview-update, #imgPreviewPP-update{
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
                            <th>Nama Sesuai KTP</th>
                            <th>Alamat Sesuai KTP</th>
                            <th>Alamat Surat Menyurat</th>
                            <th>No. Telp</th>
                            <th>Kota</th>
                            <th>Kode Pos</th>
                            <th>email</th>
                            <th>No. KTP</th>
                            <th>PP</th>
                            <th>Kennel</th>
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
        // line 94
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
                        <div class=\"col-xs-1\"></div>
                        <div class=\"col-xs-4\">
                            <img id=\"imgPreview\" width=\"100%\" src=\"";
        // line 108
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                                <span>Upload KTP</span>
                                <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\" />
                            </div>
                            <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                        </div>
                        <div class=\"col-xs-2\"></div>
                        <div class=\"col-xs-4\">
                            <img id=\"imgPreviewPP\" width=\"100%\" src=\"";
        // line 118
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                                <span>Upload Profile Picture</span>
                                <input type=\"file\" class=\"upload\" name=\"photoPP\" id=\"imageInputPP\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCropPP\" id=\"srcDataCropPP\" />
                            </div>
                            <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                        </div>
                        <div class=\"col-xs-1\"></div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"name-add-member\">Nama Sesuai KTP</label>
                                    <input class=\"form-control\" id=\"name-add-member\" name=\"mem_name\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"address-add-member\">Alamat Sesuai KTP</label>
                                    <input class=\"form-control\" id=\"address-add-member\" name=\"mem_address\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"mail-address-add-member\">Alamat Surat Menyurat</label>
                                    <input class=\"form-control\" id=\"mail-address-add-member\" name=\"mem_mail_address\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"hp-add-member\">No. Telp</label>
                                    <input class=\"form-control\" id=\"hp-add-member\" name=\"mem_hp\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"kota-add-member\">Kota</label>
                                    <input class=\"form-control\" id=\"kota-add-member\" name=\"mem_kota\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"kode-pos-add-member\">Kode Pos</label>
                                    <input class=\"form-control\" id=\"kode-pos-add-member\" name=\"mem_kode_pos\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"email-add-member\">email</label>
                                    <input class=\"form-control\" id=\"email-add-member\" name=\"mem_email\" type=\"text\" required>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"kennel-add-member\">Kennel</label>
                                    </br>
                                    <select class=\"form-control kennel\" id=\"kennel-add-member\" name=\"mem_ken_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"ktp-add-member\">No. KTP</label>
                                    <input class=\"form-control\" id=\"ktp-add-member\" name=\"mem_ktp\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                    <div class=\"col-xs-12\">
                                    <label for=\"username-add-user\">Username</label>
                                    <input class=\"form-control\" id=\"username-add-user\" name=\"mem_username\" type=\"text\" required>
                                    </div>
                            </div>
                            <div class=\"form-group\">
                                    <div class=\"col-xs-12\">
                                    <label for=\"password-add-member\">Password</label>
                                    <input class=\"form-control\" id=\"password-add-member\" name=\"password\" type=\"password\" required>
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <div class=\"col-xs-12\">
                                        <label for=\"repass-add-member\">Konfirmasi Password</label>
                                        <input class=\"form-control\" id=\"repass-add-member\" name=\"repass\" type=\"password\" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                        <button type=\"submit\" class=\"btn btn-primary submit-add-member\">Simpan</button>
                    </div>
                </div>
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
                        <div class=\"col-xs-1\"></div>
                        <div class=\"col-xs-4\">
                            <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 236
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                                <span>Upload KTP</span>
                                <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput-update\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\" />
                            </div>
                            <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                        </div>
                        <div class=\"col-xs-2\"></div>
                        <div class=\"col-xs-4\">
                            <img id=\"imgPreviewPP-update\" width=\"100%\" src=\"";
        // line 246
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                                <span>Upload Profile Picture</span>
                                <input type=\"file\" class=\"upload\" name=\"photoPP\" id=\"imageInputPP-update\"/>
                                <input type=\"hidden\" class=\"\" name=\"srcDataCropPP\" id=\"srcDataCropPP-update\"/>
                            </div>
                            <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                        </div>
                        <div class=\"col-xs-1\"></div>
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
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"kota-update-member\">Kota</label>
                                <input class=\"form-control\" id=\"kota-update-member\" name=\"mem_kota\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"kode-pos-update-member\">Kode Pos</label>
                                <input class=\"form-control\" id=\"kode-pos-update-member\" name=\"mem_kode_pos\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"email-update-member\">email</label>
                                <input class=\"form-control\" id=\"email-update-member\" name=\"mem_email\" type=\"text\" required>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"kennel-update-member\">Kennel</label>
                                </br>
                                <select class=\"form-control kennel\" id=\"kennel-update-member\" name=\"mem_ken_id\" required style=\"height: 34px;width:100%\"></select>
                            </div>
                        </div>
                        <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"ktp-update-member\">No. KTP</label>
                                    <input class=\"form-control\" id=\"ktp-update-member\" name=\"mem_ktp\" type=\"text\" required>
                                </div>
                            </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"username-update-member\">Username</label>
                                <input class=\"form-control\" id=\"username-update-member\" name=\"mem_username\" type=\"text\" required>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"pass-update-member\">Password</label>
                                <input class=\"form-control\" id=\"pass-update-member\" name=\"password\" type=\"password\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"newpass-update-member\">Password Baru</label>
                                <input class=\"form-control\" id=\"newpass-update-member\" name=\"newpass\" type=\"password\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"repass-update-member\">Konfirmasi Password</label>
                                <input class=\"form-control\" id=\"repass-update-member\" name=\"repass\" type=\"password\">
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
                                <label for=\"newpass-update-password\">Password Baru</label>
                                <input class=\"form-control\" id=\"newpass-update-password\" name=\"newpass\" type=\"password\">
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-12\">
                                <label for=\"repass-update-password\">Konfirmasi Password</label>
                                <input class=\"form-control\" id=\"repass-update-password\" name=\"repass\" type=\"password\">
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
            <button type=\"button\" class=\"btn btn-primary btn-crop\" id=\"btn-crop\">Crop</button>
        </div>
    </div>
  </div>
</div>

<div class=\"modal fade\" id=\"cropper-modal-PP\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" >
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
                <div id=\"cropper-wrap-img-PP\">
                    <img width=\"100%\" src=\"/img/default.png\" alt=\"Picture\">
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default pull-left\">Close</button>
            <button type=\"button\" class=\"btn btn-primary btn-crop\" id=\"btn-crop-PP\">Crop</button>
        </div>
    </div>
  </div>
</div>
";
    }

    // line 450
    public function block_scripts($context, array $blocks = array())
    {
        // line 451
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 452
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 453
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 454
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 455
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 456
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<script src=\"";
        // line 457
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/select2/js/select2.min.js\"></script>
<!-- search engine -->
<script src=\"";
        // line 459
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 460
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 461
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 463
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 464
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_member.js\"></script>
<script>
    var base_url = \$('.base_url').val();
    
    \$(\"#kennel-add-member\").select2({
        placeholder: 'Pilih Kennel',
        ajax: {
            url: base_url+\"backend/kennels/kennel\",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results: data
            };
            },
            cache: true
        },
        dropdownParent: \$(\"#modal-add-member\")
    });

    \$(\"#kennel-update-member\").select2({
        placeholder: 'Pilih Kennel',
        ajax: {
            url: base_url+\"backend/kennels/kennel\",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results: data
            };
            },
            cache: true
        },
        dropdownParent: \$(\"#modal-update-member\")
    });

    function functionKennel(\$id){
        \$('#kennel-update-member').val(\$id);
    }

    var kennel = new Bloodhound({
        identify: function(o) { return o.mem_ken_id; },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('mem_ken_id'),
        dupDetector: function(a, b) { return a.mem_ken_id === b.mem_ken_id; },
        remote: {
            url: base_url+'backend/kennels/kennel?q=%QUERY',
            wildcard: '%QUERY',
            cache: false
        }
    });

    kennel.initialize();
    // passing in `null` for the `options` arguments will result in the default
    // options being used

    \$('#kennel-update-member .typeahead').typeahead(null, {
        name: 'kennel',
        display: 'mem_ken_id',
        placeholder: false,
        source: kennel.ttAdapter(),
        templates: {
        empty: [
            '<div class=\"empty-message\">',
            '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
            '</div>'
        ].join('\\n'),
        suggestion: function (data) {
            \$('#kennel-update-member').val(data.mem_ken_id);
                return '<a style=\"color:black;\" href=\"javascript:functionKennel('+data.mem_ken_id+')\"><div style=\"margin-bottom:15px;\">' + data.mem_name + '</div></a><br><br>';
            }
        }
    });
</script>
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
        return array (  562 => 464,  558 => 463,  553 => 461,  549 => 460,  545 => 459,  540 => 457,  536 => 456,  532 => 455,  528 => 454,  524 => 453,  520 => 452,  517 => 451,  514 => 450,  307 => 246,  294 => 236,  173 => 118,  160 => 108,  143 => 94,  82 => 35,  79 => 34,  52 => 10,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
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
/* <link rel="stylesheet" href="{{ base_url() }}/assets/select2/css/select2.min.css" />*/
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
/*     #imgPreview, #imgPreviewPP, */
/*     #imgPreview-update, #imgPreviewPP-update{*/
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
/*                             <th>Nama Sesuai KTP</th>*/
/*                             <th>Alamat Sesuai KTP</th>*/
/*                             <th>Alamat Surat Menyurat</th>*/
/*                             <th>No. Telp</th>*/
/*                             <th>Kota</th>*/
/*                             <th>Kode Pos</th>*/
/*                             <th>email</th>*/
/*                             <th>No. KTP</th>*/
/*                             <th>PP</th>*/
/*                             <th>Kennel</th>*/
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
/*                         <div class="col-xs-1"></div>*/
/*                         <div class="col-xs-4">*/
/*                             <img id="imgPreview" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                                 <span>Upload KTP</span>*/
/*                                 <input type="file" class="upload" name="photo" id="imageInput" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop" />*/
/*                             </div>*/
/*                             <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                         </div>*/
/*                         <div class="col-xs-2"></div>*/
/*                         <div class="col-xs-4">*/
/*                             <img id="imgPreviewPP" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                                 <span>Upload Profile Picture</span>*/
/*                                 <input type="file" class="upload" name="photoPP" id="imageInputPP" />*/
/*                                 <input type="hidden" class="" name="srcDataCropPP" id="srcDataCropPP" />*/
/*                             </div>*/
/*                             <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                         </div>*/
/*                         <div class="col-xs-1"></div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="name-add-member">Nama Sesuai KTP</label>*/
/*                                     <input class="form-control" id="name-add-member" name="mem_name" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="address-add-member">Alamat Sesuai KTP</label>*/
/*                                     <input class="form-control" id="address-add-member" name="mem_address" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="mail-address-add-member">Alamat Surat Menyurat</label>*/
/*                                     <input class="form-control" id="mail-address-add-member" name="mem_mail_address" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="hp-add-member">No. Telp</label>*/
/*                                     <input class="form-control" id="hp-add-member" name="mem_hp" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="kota-add-member">Kota</label>*/
/*                                     <input class="form-control" id="kota-add-member" name="mem_kota" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="kode-pos-add-member">Kode Pos</label>*/
/*                                     <input class="form-control" id="kode-pos-add-member" name="mem_kode_pos" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="email-add-member">email</label>*/
/*                                     <input class="form-control" id="email-add-member" name="mem_email" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="kennel-add-member">Kennel</label>*/
/*                                     </br>*/
/*                                     <select class="form-control kennel" id="kennel-add-member" name="mem_ken_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="ktp-add-member">No. KTP</label>*/
/*                                     <input class="form-control" id="ktp-add-member" name="mem_ktp" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                     <div class="col-xs-12">*/
/*                                     <label for="username-add-user">Username</label>*/
/*                                     <input class="form-control" id="username-add-user" name="mem_username" type="text" required>*/
/*                                     </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                     <div class="col-xs-12">*/
/*                                     <label for="password-add-member">Password</label>*/
/*                                     <input class="form-control" id="password-add-member" name="password" type="password" required>*/
/*                                     </div>*/
/*                                 </div>*/
/*                                 <div class="form-group">*/
/*                                     <div class="col-xs-12">*/
/*                                         <label for="repass-add-member">Konfirmasi Password</label>*/
/*                                         <input class="form-control" id="repass-add-member" name="repass" type="password" required>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="modal-footer">*/
/*                         <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                         <button type="submit" class="btn btn-primary submit-add-member">Simpan</button>*/
/*                     </div>*/
/*                 </div>*/
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
/*                         <div class="col-xs-1"></div>*/
/*                         <div class="col-xs-4">*/
/*                             <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                                 <span>Upload KTP</span>*/
/*                                 <input type="file" class="upload" name="photo" id="imageInput-update" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update" />*/
/*                             </div>*/
/*                             <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                         </div>*/
/*                         <div class="col-xs-2"></div>*/
/*                         <div class="col-xs-4">*/
/*                             <img id="imgPreviewPP-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                                 <span>Upload Profile Picture</span>*/
/*                                 <input type="file" class="upload" name="photoPP" id="imageInputPP-update"/>*/
/*                                 <input type="hidden" class="" name="srcDataCropPP" id="srcDataCropPP-update"/>*/
/*                             </div>*/
/*                             <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                         </div>*/
/*                         <div class="col-xs-1"></div>*/
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
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="kota-update-member">Kota</label>*/
/*                                 <input class="form-control" id="kota-update-member" name="mem_kota" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="kode-pos-update-member">Kode Pos</label>*/
/*                                 <input class="form-control" id="kode-pos-update-member" name="mem_kode_pos" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="email-update-member">email</label>*/
/*                                 <input class="form-control" id="email-update-member" name="mem_email" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="col-md-6">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="kennel-update-member">Kennel</label>*/
/*                                 </br>*/
/*                                 <select class="form-control kennel" id="kennel-update-member" name="mem_ken_id" required style="height: 34px;width:100%"></select>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="ktp-update-member">No. KTP</label>*/
/*                                     <input class="form-control" id="ktp-update-member" name="mem_ktp" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="username-update-member">Username</label>*/
/*                                 <input class="form-control" id="username-update-member" name="mem_username" type="text" required>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="pass-update-member">Password</label>*/
/*                                 <input class="form-control" id="pass-update-member" name="password" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="newpass-update-member">Password Baru</label>*/
/*                                 <input class="form-control" id="newpass-update-member" name="newpass" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="repass-update-member">Konfirmasi Password</label>*/
/*                                 <input class="form-control" id="repass-update-member" name="repass" type="password">*/
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
/*                                 <label for="newpass-update-password">Password Baru</label>*/
/*                                 <input class="form-control" id="newpass-update-password" name="newpass" type="password">*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-12">*/
/*                                 <label for="repass-update-password">Konfirmasi Password</label>*/
/*                                 <input class="form-control" id="repass-update-password" name="repass" type="password">*/
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
/*             <button type="button" class="btn btn-primary btn-crop" id="btn-crop">Crop</button>*/
/*         </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* */
/* <div class="modal fade" id="cropper-modal-PP" data-backdrop="static" data-keyboard="false" tabindex="-1" >*/
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
/*                 <div id="cropper-wrap-img-PP">*/
/*                     <img width="100%" src="/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class="modal-footer">*/
/*             <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*             <button type="button" class="btn btn-primary btn-crop" id="btn-crop-PP">Crop</button>*/
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
/* <script src="{{ base_url() }}assets/select2/js/select2.min.js"></script>*/
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_member.js"></script>*/
/* <script>*/
/*     var base_url = $('.base_url').val();*/
/*     */
/*     $("#kennel-add-member").select2({*/
/*         placeholder: 'Pilih Kennel',*/
/*         ajax: {*/
/*             url: base_url+"backend/kennels/kennel",*/
/*             dataType: 'json',*/
/*             delay: 250,*/
/*             processResults: function (data) {*/
/*             return {*/
/*                 results: data*/
/*             };*/
/*             },*/
/*             cache: true*/
/*         },*/
/*         dropdownParent: $("#modal-add-member")*/
/*     });*/
/* */
/*     $("#kennel-update-member").select2({*/
/*         placeholder: 'Pilih Kennel',*/
/*         ajax: {*/
/*             url: base_url+"backend/kennels/kennel",*/
/*             dataType: 'json',*/
/*             delay: 250,*/
/*             processResults: function (data) {*/
/*             return {*/
/*                 results: data*/
/*             };*/
/*             },*/
/*             cache: true*/
/*         },*/
/*         dropdownParent: $("#modal-update-member")*/
/*     });*/
/* */
/*     function functionKennel($id){*/
/*         $('#kennel-update-member').val($id);*/
/*     }*/
/* */
/*     var kennel = new Bloodhound({*/
/*         identify: function(o) { return o.mem_ken_id; },*/
/*         queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*         datumTokenizer: Bloodhound.tokenizers.obj.whitespace('mem_ken_id'),*/
/*         dupDetector: function(a, b) { return a.mem_ken_id === b.mem_ken_id; },*/
/*         remote: {*/
/*             url: base_url+'backend/kennels/kennel?q=%QUERY',*/
/*             wildcard: '%QUERY',*/
/*             cache: false*/
/*         }*/
/*     });*/
/* */
/*     kennel.initialize();*/
/*     // passing in `null` for the `options` arguments will result in the default*/
/*     // options being used*/
/* */
/*     $('#kennel-update-member .typeahead').typeahead(null, {*/
/*         name: 'kennel',*/
/*         display: 'mem_ken_id',*/
/*         placeholder: false,*/
/*         source: kennel.ttAdapter(),*/
/*         templates: {*/
/*         empty: [*/
/*             '<div class="empty-message">',*/
/*             '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*             '</div>'*/
/*         ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#kennel-update-member').val(data.mem_ken_id);*/
/*                 return '<a style="color:black;" href="javascript:functionKennel('+data.mem_ken_id+')"><div style="margin-bottom:15px;">' + data.mem_name + '</div></a><br><br>';*/
/*             }*/
/*         }*/
/*     });*/
/* </script>*/
/* {% endblock %}*/
