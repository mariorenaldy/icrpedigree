<?php

/* backend/logsStud.twig */
class __TwigTemplate_7e1a41d8c0baaadaebfe202b73733105b7e0d0fa7de6c315519c5a0e995d6ec9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/logsStud.twig", 2);
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
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 11
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
    #imgStud, #imgSire, #imgDam, #imgStud-update, #imgSire-update, #imgDam-update, #imgCanine{
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
            <li>Pacak</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-primary btn-add-stud pull-right\" onClick=\"openModal('#modal-add-stud', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Data Pacak\"><i class=\"si si-note\"></i></button>
            <h4>Daftar Pacak</h4>
        </div>
        <div class=\"block-content\">
            <div class=\"table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
                <table class=\"table table-borderless table-striped data-studs\">
                    <thead>
                        <tr>
                            <th width=\"5%\">Pacak</th>
                            <th>Tanggal Pacak</th>
                            <th>Member</th>
                            <th>Sire</th>
                            <th>Dam</th>
                            <th>Approver</th>
                            <th>Tanggal Approve</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th class=\"text-center\" width=\"1%\">#</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-stud\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 80
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/studs/add\" class=\"form-add-stud form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Penambahan Data Pacak</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-2\">
                                    <img id=\"imgStud\" width=\"100%\" src=\"";
        // line 95
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputStud\" class=\"btn\">Gambar Pacak</label>
                                        <input type=\"file\" class=\"upload stud\" name=\"stu_photo\" id=\"imageInputStud\" required/>
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCropStud\" required/>
                                    </div>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-2\">
                                    <img id=\"imgSire\" width=\"100%\" src=\"";
        // line 105
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputSire\" class=\"btn\">Gambar Sire</label>
                                        <input type=\"file\" class=\"upload sire\" name=\"stu_sire_photo\" id=\"imageInputSire\" required/>
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCropSire\" id=\"srcDataCropSire\" required/>
                                    </div>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-2\">
                                    <img id=\"imgDam\" width=\"100%\" src=\"";
        // line 115
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputDam\" class=\"btn\">Gambar Dam</label>
                                        <input type=\"file\" class=\"upload dam\" name=\"stu_mom_photo\" id=\"imageInputDam\" required/>
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCropDam\" id=\"srcDataCropDam\" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"date-add-stud\">Tanggal Pacak</label>
                                    <input class=\"form-control\" id=\"date-add-stud\" name=\"stu_stud_date\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_sire\">
                                    <label for=\"stu_sire_id\">Sire</label>
                                    <select class=\"form-control sire\" id=\"stu_sire_id\" name=\"stu_sire_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_dam\">
                                    <label for=\"stu_dam_id\">Dam</label>
                                    <select class=\"form-control dam\" id=\"stu_dam_id\" name=\"stu_mom_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_member_id\">
                                    <label for=\"stu_member\">Member</label>
                                    <select class=\"form-control member\" id=\"stu_member\" name=\"stu_member\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"stu_note\">Keterangan</label>
                                    <textarea class=\"form-control\" name=\"stu_note\" id=\"stu_note\" rows=\"4\" cols=\"20\"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-stud\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal approve-->

<div class=\"modal fade\" id=\"modal-update-stud\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-stud form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Pacak</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-2\">
                                    <img id=\"imgStud-update\" width=\"100%\" src=\"";
        // line 187
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputStud-update\" class=\"btn\">Gambar Pacak</label>
                                        <input type=\"file\" class=\"upload stud\" name=\"stu_photo\" id=\"imageInputStud-update\" required/>
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCropStud-update\" required/>
                                    </div>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-2\">
                                    <img id=\"imgSire-update\" width=\"100%\" src=\"";
        // line 197
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputSire-update\" class=\"btn\">Gambar Sire</label>
                                        <input type=\"file\" class=\"upload sire\" name=\"stu_sire_photo\" id=\"imageInputSire-update\" required/>
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCropSire\" id=\"srcDataCropSire-update\" required/>
                                    </div>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-8 col-xs-offset-2\">
                                    <img id=\"imgDam-update\" width=\"100%\" src=\"";
        // line 207
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputDam-update\" class=\"btn\">Gambar Dam</label>
                                        <input type=\"file\" class=\"upload dam\" name=\"stu_mom_photo\" id=\"imageInputDam-update\" required/>
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCropDam\" id=\"srcDataCropDam-update\" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"date-update-stud\">Tanggal Pacak</label>
                                    <input class=\"form-control\" id=\"date-update-stud\" name=\"stu_stud_date\" type=\"text\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_sire-update\">
                                    <label for=\"stu_sire_id-update\">Sire</label>
                                    <select class=\"form-control sire\" id=\"stu_sire_id-update\" name=\"stu_sire_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_dam-update\">
                                    <label for=\"stu_dam_id-update\">Dam</label>
                                    <select class=\"form-control dam\" id=\"stu_dam_id-update\" name=\"stu_mom_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_member_id-update\">
                                    <label for=\"stu_member-update\">Member</label>
                                    <select class=\"form-control member\" id=\"stu_member-update\" name=\"stu_member\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"stu_note-update\">Keterangan</label>
                                    <textarea class=\"form-control\" name=\"stu_note\" id=\"stu_note-update\" rows=\"4\" cols=\"20\"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-stud\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal reject-->

<div class=\"modal fade\" id=\"modal-add-birth\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 264
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/births/add\" class=\"form-add-birth form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Penambahan Data Lahir</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <img id=\"imgCanine\" width=\"100%\" src=\"";
        // line 279
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInputCanine\" class=\"btn\">Gambar Canine</label>
                                        <input type=\"file\" class=\"upload canine\" name=\"bir_photo\" id=\"imageInputCanine\" />
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCropCanine\" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                <label for=\"as-add-canines\">Nama</label>
                                <input class=\"form-control\" id=\"as-add-canines\" name=\"bir_a_s\" type=\"text\" required>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                <label for=\"breed-add-canines\">Breed</label>
                                <select class=\"form-control\" id=\"breed-add-canines\" name=\"bir_breed\" required>
                                    ";
        // line 301
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 302
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 304
        echo "                                </select>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                <label for=\"gender-add-canines\">Gender</label>
                                <br>
                                <input id=\"gender-add-canines\" name=\"bir_gender\" type=\"radio\" value=\"Male\" checked>Male&nbsp;&nbsp;
                                <input id=\"gender-add-canines\" name=\"bir_gender\" type=\"radio\" value=\"Female\" />Female
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                <label for=\"color-add-canines\">Color</label>
                                <input class=\"form-control\" id=\"color-add-canines\" name=\"bir_color\" type=\"text\" required>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_date_of_birth\">Tanggal Lahir</label>
                                    <input class=\"form-control\" id=\"bir_date_of_birth\" name=\"bir_date_of_birth\" type=\"text\" required>
                                </div>
                            </div>
                        </div>

                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"breeder-canines\">
                                <label for=\"breeder\">Breeder</label>
                                <input class=\"form-control typeahead\" id=\"breeder\" name=\"bir_owner_name\" type=\"text\" required>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"kennel-canines\">
                                <label for=\"kennel\">Kennel</label>
                                <input class=\"form-control typeahead\" id=\"kennel\" name=\"bir_cage\" type=\"text\" required>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"bir_member_id\">
                                    <label for=\"bir_member\">Member</label>
                                    <select class=\"form-control member\" id=\"bir_member\" name=\"bir_member\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-10 col-xs-offset-1\">
                                    <label for=\"bir_note_approve\">Keterangan</label>
                                    <textarea class=\"form-control\" name=\"bir_note\" id=\"bir_note\" rows=\"4\" cols=\"20\"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type=\"hidden\" value=\"\" id=\"bir_stu_id\" name=\"bir_stu_id\">

                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                            <button type=\"submit\" class=\"btn btn-primary submit-add-birth\">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

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

<input type=\"hidden\" value=\"";
        // line 402
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"\" id=\"imgPreview\" />
<input type=\"hidden\" value=\"\" id=\"srcDataCrop\" />
";
    }

    // line 407
    public function block_scripts($context, array $blocks = array())
    {
        // line 408
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 409
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 410
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 411
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<script src=\"";
        // line 412
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/select2/js/select2.min.js\"></script>
<script src=\"";
        // line 413
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 414
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 415
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script>
    jQuery(function () {
        \$('#date-add-stud').datetimepicker({
            format: 'DD-MM-YYYY',
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
        \$('#date-update-stud').datetimepicker({
            format: 'DD-MM-YYYY',
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
        \$('#bir_date_of_birth').datetimepicker({
            format: 'DD-MM-YYYY',
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
</script>

<!-- Page JS Code -->
<script src=\"";
        // line 470
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/logs_stud.js\"></script>

<!-- search engine -->
<script src=\"";
        // line 473
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 474
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 475
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>

<script>
var base_url = \$('.base_url').val();

";
        // line 481
        echo "
\$(\"#stu_dam_id\").select2({
    placeholder: 'Pilih Dam',
    ajax: {
        url: base_url+\"/backend/canines/dam\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-add-stud\")
});

\$(\"#stu_sire_id\").select2({
    placeholder: 'Pilih Sire',
    ajax: {
        url: base_url+\"/backend/canines/sire\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-add-stud\")
});

\$(\"#stu_member\").select2({
    placeholder: 'Pilih Member',
    ajax: {
        url: base_url+\"/backend/canines/member\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-add-stud\")
});

\$(\"#stu_dam_id-update\").select2({
    placeholder: 'Pilih Dam',
    ajax: {
        url: base_url+\"/backend/canines/dam\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-update-stud\")
});

\$(\"#stu_sire_id-update\").select2({
    placeholder: 'Pilih Sire',
    ajax: {
        url: base_url+\"/backend/canines/sire\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-update-stud\")
});

\$(\"#stu_member-update\").select2({
    placeholder: 'Pilih Member',
    ajax: {
        url: base_url+\"/backend/canines/member\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-update-stud\")
});

\$(\"#bir_member\").select2({
    placeholder: 'Pilih Member',
    ajax: {
        url: base_url+\"/backend/canines/member\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-add-birth\")
});

function functionSire(\$id){
  \$('#stu_sire_id').val(\$id);
}

function functionDam(\$id){
  \$('#stu_dam_id').val(\$id);
}

function functionMember(\$id){
  \$('#stu_member').val(\$id);
}

function functionSireUpdate(\$id){
  \$('#stu_sire_id-update').val(\$id);
}

function functionDamUpdate(\$id){
  \$('#stu_dam_id-update').val(\$id);
}

function functionMemberUpdate(\$id){
  \$('#stu_member-update').val(\$id);
}

function functionMemberAdd(\$id){
  \$('#bir_member').val(\$id);
}

// sire
var sire = new Bloodhound({
    identify: function(o) { return o.can_a_s; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),
    dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },
    remote: {
      url: base_url+'backend/canines/sire?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

sire.initialize();

\$('#stu_sire_id').typeahead(null, {
    name: 'sire',
    display: 'can_a_s',
    placeholder: false,
    source: sire.ttAdapter(),
    templates: {
    empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
    ].join('\\n'),
        suggestion: function (data) {
            \$('#stu_sire_id').val(data.can_id);
            return '<a style=\"color:black;\" href=\"javascript:functionSire('+data.can_id+')\"><div style=\"margin-bottom:15px;\"><img width=\"30px\" style=\"float:left; margin:5px;\" src=\"'+data.can_photo+'\">' + data.can_a_s + '</div></a><br><br>';
        }
    }
});

\$('#stu_sire_id-update').typeahead(null, {
    name: 'sire',
    display: 'can_a_s',
    placeholder: false,
    source: sire.ttAdapter(),
    templates: {
    empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
    ].join('\\n'),
        suggestion: function (data) {
            \$('#stu_sire_id').val(data.can_id);
            return '<a style=\"color:black;\" href=\"javascript:functionSireUpdate('+data.can_id+')\"><div style=\"margin-bottom:15px;\"><img width=\"30px\" style=\"float:left; margin:5px;\" src=\"'+data.can_photo+'\">' + data.can_a_s + '</div></a><br><br>';
        }
    }
});

// dam
var dam = new Bloodhound({
    identify: function(o) { return o.can_a_s; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),
    dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },
    remote: {
      url: base_url+'backend/canines/dam?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

dam.initialize();

\$('#stu_dam_id').typeahead(null, {
    name: 'dam',
    display: 'can_a_s',
    placeholder: false,
    source: dam.ttAdapter(),
    templates: {
    empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
    ].join('\\n'),
        suggestion: function (data) {
            \$('#stu_dam_id').val(data.can_id);
            return '<a style=\"color:black;\" href=\"javascript:functionDam('+data.can_id+')\"><div style=\"margin-bottom:15px;\"><img width=\"30px\" style=\"float:left; margin:5px;\" src=\"'+data.can_photo+'\">' + data.can_a_s + '</div></a><br><br>';
        }
    }
});

\$('#stu_dam_id-update').typeahead(null, {
    name: 'dam',
    display: 'can_a_s',
    placeholder: false,
    source: dam.ttAdapter(),
    templates: {
    empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
    ].join('\\n'),
        suggestion: function (data) {
            \$('#stu_dam_id').val(data.can_id);
            return '<a style=\"color:black;\" href=\"javascript:functionDamUpdate('+data.can_id+')\"><div style=\"margin-bottom:15px;\"><img width=\"30px\" style=\"float:left; margin:5px;\" src=\"'+data.can_photo+'\">' + data.can_a_s + '</div></a><br><br>';
        }
    }
});

// member
var member = new Bloodhound({
    identify: function(o) { return o.mem_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('mem_name'),
    dupDetector: function(a, b) { return a.mem_name === b.mem_name; },
    remote: {
      url: base_url+'backend/canines/member?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

member.initialize();

\$('#stu_member').typeahead(null, {
    name: 'member',
    display: 'mem_name',
    placeholder: false,
    source: member.ttAdapter(),
    templates: {
        empty: [
            '<div class=\"empty-message\">',
            '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
            '</div>'
        ].join('\\n'),
        suggestion: function (data) {
            \$('#stu_member').val(data.mem_id);
            return '<a style=\"color:black;\" href=\"javascript:functionMember('+data.mem_id+')\"><div style=\"margin-bottom:15px;\">' + data.mem_name + '</div></a><br><br>';
        }
    }
});

\$('#stu_member-update').typeahead(null, {
    name: 'member',
    display: 'mem_name',
    placeholder: false,
    source: member.ttAdapter(),
    templates: {
        empty: [
            '<div class=\"empty-message\">',
            '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
            '</div>'
        ].join('\\n'),
        suggestion: function (data) {
            \$('#stu_member').val(data.mem_id);
            return '<a style=\"color:black;\" href=\"javascript:functionMemberUpdate('+data.mem_id+')\"><div style=\"margin-bottom:15px;\">' + data.mem_name + '</div></a><br><br>';
        }
    }
});

\$('#bir_member').typeahead(null, {
    name: 'member',
    display: 'mem_name',
    placeholder: false,
    source: member.ttAdapter(),
    templates: {
        empty: [
            '<div class=\"empty-message\">',
            '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
            '</div>'
        ].join('\\n'),
        suggestion: function (data) {
            \$('#bir_member').val(data.mem_id);
            return '<a style=\"color:black;\" href=\"javascript:functionMemberAdd('+data.mem_id+')\"><div style=\"margin-bottom:15px;\">' + data.mem_name + '</div></a><br><br>';
        }
    }
});

// breeder
var breeder = new Bloodhound({
    identify: function(o) { return o.can_owner_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),
    dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },
    remote: {
      url: base_url+'backend/canines/breeder?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

breeder.initialize();
\$('#breeder-canines .typeahead').typeahead(null, {
    name: 'breeder',
    display: 'can_owner_name',
    placeholder: false,
    source: breeder.ttAdapter(),
    templates: {
    empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
    ].join('\\n'),
    suggestion: function (data) {
        return '<a style=\"color:black;\" href=\"#\"><div style=\"margin-bottom:10px;padding-left:10px;\">'+ data.can_owner_name + '</div></a><br><hr>';
    }
    }
});

// kennel
var kennel = new Bloodhound({
    identify: function(o) { return o.can_cage; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),
    dupDetector: function(a, b) { return a.can_cage === b.can_cage; },
    remote: {
      url: base_url+'backend/canines/kennel?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

kennel.initialize();
\$('#kennel-canines .typeahead').typeahead(null, {
    name: 'kennel',
    display: 'can_cage',
    placeholder: false,
    source: kennel.ttAdapter(),
    templates: {
    empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
    ].join('\\n'),
    suggestion: function (data) {
        return '<a style=\"color:black;\" href=\"#\"><div style=\"margin-bottom:10px;padding-left:10px;\">'+ data.can_cage + '</div></a><br><hr>';
    }
    }
});
</script>
";
    }

    public function getTemplateName()
    {
        return "backend/logsStud.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  613 => 481,  605 => 475,  601 => 474,  597 => 473,  591 => 470,  533 => 415,  529 => 414,  525 => 413,  521 => 412,  517 => 411,  513 => 410,  509 => 409,  506 => 408,  503 => 407,  495 => 402,  395 => 304,  384 => 302,  380 => 301,  355 => 279,  337 => 264,  277 => 207,  264 => 197,  251 => 187,  176 => 115,  163 => 105,  150 => 95,  132 => 80,  85 => 35,  82 => 34,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* {# ARTechnology #}*/
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
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
/*     #imgStud, #imgSire, #imgDam, #imgStud-update, #imgSire-update, #imgDam-update, #imgCanine{*/
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
/*             <li>Pacak</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-primary btn-add-stud pull-right" onClick="openModal('#modal-add-stud', 'add')" data-toggle="tooltip" title="Tambah Data Pacak"><i class="si si-note"></i></button>*/
/*             <h4>Daftar Pacak</h4>*/
/*         </div>*/
/*         <div class="block-content">*/
/*             <div class="table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*                 <table class="table table-borderless table-striped data-studs">*/
/*                     <thead>*/
/*                         <tr>*/
/*                             <th width="5%">Pacak</th>*/
/*                             <th>Tanggal Pacak</th>*/
/*                             <th>Member</th>*/
/*                             <th>Sire</th>*/
/*                             <th>Dam</th>*/
/*                             <th>Approver</th>*/
/*                             <th>Tanggal Approve</th>*/
/*                             <th>Status</th>*/
/*                             <th>Keterangan</th>*/
/*                             <th class="text-center" width="1%">#</th>*/
/*                         </tr>*/
/*                     </thead>*/
/*                 </table>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-stud" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/studs/add" class="form-add-stud form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Penambahan Data Pacak</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-8 col-xs-offset-2">*/
/*                                     <img id="imgStud" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputStud" class="btn">Gambar Pacak</label>*/
/*                                         <input type="file" class="upload stud" name="stu_photo" id="imageInputStud" required/>*/
/*                                         <input type="hidden" class="" name="srcDataCrop" id="srcDataCropStud" required/>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-8 col-xs-offset-2">*/
/*                                     <img id="imgSire" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputSire" class="btn">Gambar Sire</label>*/
/*                                         <input type="file" class="upload sire" name="stu_sire_photo" id="imageInputSire" required/>*/
/*                                         <input type="hidden" class="" name="srcDataCropSire" id="srcDataCropSire" required/>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-8 col-xs-offset-2">*/
/*                                     <img id="imgDam" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputDam" class="btn">Gambar Dam</label>*/
/*                                         <input type="file" class="upload dam" name="stu_mom_photo" id="imageInputDam" required/>*/
/*                                         <input type="hidden" class="" name="srcDataCropDam" id="srcDataCropDam" required/>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="date-add-stud">Tanggal Pacak</label>*/
/*                                     <input class="form-control" id="date-add-stud" name="stu_stud_date" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_sire">*/
/*                                     <label for="stu_sire_id">Sire</label>*/
/*                                     <select class="form-control sire" id="stu_sire_id" name="stu_sire_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_dam">*/
/*                                     <label for="stu_dam_id">Dam</label>*/
/*                                     <select class="form-control dam" id="stu_dam_id" name="stu_mom_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_member_id">*/
/*                                     <label for="stu_member">Member</label>*/
/*                                     <select class="form-control member" id="stu_member" name="stu_member" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="stu_note">Keterangan</label>*/
/*                                     <textarea class="form-control" name="stu_note" id="stu_note" rows="4" cols="20"></textarea>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-stud">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal approve-->*/
/* */
/* <div class="modal fade" id="modal-update-stud" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-stud form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Pacak</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-8 col-xs-offset-2">*/
/*                                     <img id="imgStud-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputStud-update" class="btn">Gambar Pacak</label>*/
/*                                         <input type="file" class="upload stud" name="stu_photo" id="imageInputStud-update" required/>*/
/*                                         <input type="hidden" class="" name="srcDataCrop" id="srcDataCropStud-update" required/>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-8 col-xs-offset-2">*/
/*                                     <img id="imgSire-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputSire-update" class="btn">Gambar Sire</label>*/
/*                                         <input type="file" class="upload sire" name="stu_sire_photo" id="imageInputSire-update" required/>*/
/*                                         <input type="hidden" class="" name="srcDataCropSire" id="srcDataCropSire-update" required/>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-8 col-xs-offset-2">*/
/*                                     <img id="imgDam-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputDam-update" class="btn">Gambar Dam</label>*/
/*                                         <input type="file" class="upload dam" name="stu_mom_photo" id="imageInputDam-update" required/>*/
/*                                         <input type="hidden" class="" name="srcDataCropDam" id="srcDataCropDam-update" required/>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="date-update-stud">Tanggal Pacak</label>*/
/*                                     <input class="form-control" id="date-update-stud" name="stu_stud_date" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_sire-update">*/
/*                                     <label for="stu_sire_id-update">Sire</label>*/
/*                                     <select class="form-control sire" id="stu_sire_id-update" name="stu_sire_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_dam-update">*/
/*                                     <label for="stu_dam_id-update">Dam</label>*/
/*                                     <select class="form-control dam" id="stu_dam_id-update" name="stu_mom_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_member_id-update">*/
/*                                     <label for="stu_member-update">Member</label>*/
/*                                     <select class="form-control member" id="stu_member-update" name="stu_member" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="stu_note-update">Keterangan</label>*/
/*                                     <textarea class="form-control" name="stu_note" id="stu_note-update" rows="4" cols="20"></textarea>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-stud">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal reject-->*/
/* */
/* <div class="modal fade" id="modal-add-birth" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/births/add" class="form-add-birth form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Penambahan Data Lahir</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-12">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <img id="imgCanine" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInputCanine" class="btn">Gambar Canine</label>*/
/*                                         <input type="file" class="upload canine" name="bir_photo" id="imageInputCanine" />*/
/*                                         <input type="hidden" class="" name="srcDataCrop" id="srcDataCropCanine" />*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="as-add-canines">Nama</label>*/
/*                                 <input class="form-control" id="as-add-canines" name="bir_a_s" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="breed-add-canines">Breed</label>*/
/*                                 <select class="form-control" id="breed-add-canines" name="bir_breed" required>*/
/*                                     {% for trah in trahs %}*/
/*                                         <option value="{{trah.tra_name}}">{{trah.tra_name}}</option>*/
/*                                     {% endfor %}*/
/*                                 </select>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="gender-add-canines">Gender</label>*/
/*                                 <br>*/
/*                                 <input id="gender-add-canines" name="bir_gender" type="radio" value="Male" checked>Male&nbsp;&nbsp;*/
/*                                 <input id="gender-add-canines" name="bir_gender" type="radio" value="Female" />Female*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="color-add-canines">Color</label>*/
/*                                 <input class="form-control" id="color-add-canines" name="bir_color" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_date_of_birth">Tanggal Lahir</label>*/
/*                                     <input class="form-control" id="bir_date_of_birth" name="bir_date_of_birth" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="breeder-canines">*/
/*                                 <label for="breeder">Breeder</label>*/
/*                                 <input class="form-control typeahead" id="breeder" name="bir_owner_name" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="kennel-canines">*/
/*                                 <label for="kennel">Kennel</label>*/
/*                                 <input class="form-control typeahead" id="kennel" name="bir_cage" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="bir_member_id">*/
/*                                     <label for="bir_member">Member</label>*/
/*                                     <select class="form-control member" id="bir_member" name="bir_member" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-10 col-xs-offset-1">*/
/*                                     <label for="bir_note_approve">Keterangan</label>*/
/*                                     <textarea class="form-control" name="bir_note" id="bir_note" rows="4" cols="20"></textarea>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <input type="hidden" value="" id="bir_stu_id" name="bir_stu_id">*/
/* */
/*                         <div class="modal-footer">*/
/*                             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                             <button type="submit" class="btn btn-primary submit-add-birth">Save</button>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
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
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="" id="imgPreview" />*/
/* <input type="hidden" value="" id="srcDataCrop" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <script src="{{ base_url() }}assets/select2/js/select2.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*         $('#date-add-stud').datetimepicker({*/
/*             format: 'DD-MM-YYYY',*/
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
/*         $('#date-update-stud').datetimepicker({*/
/*             format: 'DD-MM-YYYY',*/
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
/*         $('#bir_date_of_birth').datetimepicker({*/
/*             format: 'DD-MM-YYYY',*/
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
/* </script>*/
/* */
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/logs_stud.js"></script>*/
/* */
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* {# start select2 #}*/
/* */
/* $("#stu_dam_id").select2({*/
/*     placeholder: 'Pilih Dam',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/dam",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*             return {*/
/*                 results: data*/
/*             };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-add-stud")*/
/* });*/
/* */
/* $("#stu_sire_id").select2({*/
/*     placeholder: 'Pilih Sire',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/sire",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*             return {*/
/*                 results: data*/
/*             };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-add-stud")*/
/* });*/
/* */
/* $("#stu_member").select2({*/
/*     placeholder: 'Pilih Member',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/member",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-add-stud")*/
/* });*/
/* */
/* $("#stu_dam_id-update").select2({*/
/*     placeholder: 'Pilih Dam',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/dam",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*             return {*/
/*                 results: data*/
/*             };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-update-stud")*/
/* });*/
/* */
/* $("#stu_sire_id-update").select2({*/
/*     placeholder: 'Pilih Sire',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/sire",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*             return {*/
/*                 results: data*/
/*             };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-update-stud")*/
/* });*/
/* */
/* $("#stu_member-update").select2({*/
/*     placeholder: 'Pilih Member',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/member",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-update-stud")*/
/* });*/
/* */
/* $("#bir_member").select2({*/
/*     placeholder: 'Pilih Member',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/member",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-add-birth")*/
/* });*/
/* */
/* function functionSire($id){*/
/*   $('#stu_sire_id').val($id);*/
/* }*/
/* */
/* function functionDam($id){*/
/*   $('#stu_dam_id').val($id);*/
/* }*/
/* */
/* function functionMember($id){*/
/*   $('#stu_member').val($id);*/
/* }*/
/* */
/* function functionSireUpdate($id){*/
/*   $('#stu_sire_id-update').val($id);*/
/* }*/
/* */
/* function functionDamUpdate($id){*/
/*   $('#stu_dam_id-update').val($id);*/
/* }*/
/* */
/* function functionMemberUpdate($id){*/
/*   $('#stu_member-update').val($id);*/
/* }*/
/* */
/* function functionMemberAdd($id){*/
/*   $('#bir_member').val($id);*/
/* }*/
/* */
/* // sire*/
/* var sire = new Bloodhound({*/
/*     identify: function(o) { return o.can_a_s; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),*/
/*     dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/sire?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* sire.initialize();*/
/* */
/* $('#stu_sire_id').typeahead(null, {*/
/*     name: 'sire',*/
/*     display: 'can_a_s',*/
/*     placeholder: false,*/
/*     source: sire.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#stu_sire_id').val(data.can_id);*/
/*             return '<a style="color:black;" href="javascript:functionSire('+data.can_id+')"><div style="margin-bottom:15px;"><img width="30px" style="float:left; margin:5px;" src="'+data.can_photo+'">' + data.can_a_s + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* $('#stu_sire_id-update').typeahead(null, {*/
/*     name: 'sire',*/
/*     display: 'can_a_s',*/
/*     placeholder: false,*/
/*     source: sire.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#stu_sire_id').val(data.can_id);*/
/*             return '<a style="color:black;" href="javascript:functionSireUpdate('+data.can_id+')"><div style="margin-bottom:15px;"><img width="30px" style="float:left; margin:5px;" src="'+data.can_photo+'">' + data.can_a_s + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* // dam*/
/* var dam = new Bloodhound({*/
/*     identify: function(o) { return o.can_a_s; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),*/
/*     dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/dam?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* dam.initialize();*/
/* */
/* $('#stu_dam_id').typeahead(null, {*/
/*     name: 'dam',*/
/*     display: 'can_a_s',*/
/*     placeholder: false,*/
/*     source: dam.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#stu_dam_id').val(data.can_id);*/
/*             return '<a style="color:black;" href="javascript:functionDam('+data.can_id+')"><div style="margin-bottom:15px;"><img width="30px" style="float:left; margin:5px;" src="'+data.can_photo+'">' + data.can_a_s + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* $('#stu_dam_id-update').typeahead(null, {*/
/*     name: 'dam',*/
/*     display: 'can_a_s',*/
/*     placeholder: false,*/
/*     source: dam.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#stu_dam_id').val(data.can_id);*/
/*             return '<a style="color:black;" href="javascript:functionDamUpdate('+data.can_id+')"><div style="margin-bottom:15px;"><img width="30px" style="float:left; margin:5px;" src="'+data.can_photo+'">' + data.can_a_s + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* // member*/
/* var member = new Bloodhound({*/
/*     identify: function(o) { return o.mem_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('mem_name'),*/
/*     dupDetector: function(a, b) { return a.mem_name === b.mem_name; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/member?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* member.initialize();*/
/* */
/* $('#stu_member').typeahead(null, {*/
/*     name: 'member',*/
/*     display: 'mem_name',*/
/*     placeholder: false,*/
/*     source: member.ttAdapter(),*/
/*     templates: {*/
/*         empty: [*/
/*             '<div class="empty-message">',*/
/*             '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*             '</div>'*/
/*         ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#stu_member').val(data.mem_id);*/
/*             return '<a style="color:black;" href="javascript:functionMember('+data.mem_id+')"><div style="margin-bottom:15px;">' + data.mem_name + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* $('#stu_member-update').typeahead(null, {*/
/*     name: 'member',*/
/*     display: 'mem_name',*/
/*     placeholder: false,*/
/*     source: member.ttAdapter(),*/
/*     templates: {*/
/*         empty: [*/
/*             '<div class="empty-message">',*/
/*             '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*             '</div>'*/
/*         ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#stu_member').val(data.mem_id);*/
/*             return '<a style="color:black;" href="javascript:functionMemberUpdate('+data.mem_id+')"><div style="margin-bottom:15px;">' + data.mem_name + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* $('#bir_member').typeahead(null, {*/
/*     name: 'member',*/
/*     display: 'mem_name',*/
/*     placeholder: false,*/
/*     source: member.ttAdapter(),*/
/*     templates: {*/
/*         empty: [*/
/*             '<div class="empty-message">',*/
/*             '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*             '</div>'*/
/*         ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#bir_member').val(data.mem_id);*/
/*             return '<a style="color:black;" href="javascript:functionMemberAdd('+data.mem_id+')"><div style="margin-bottom:15px;">' + data.mem_name + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* // breeder*/
/* var breeder = new Bloodhound({*/
/*     identify: function(o) { return o.can_owner_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),*/
/*     dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/breeder?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* breeder.initialize();*/
/* $('#breeder-canines .typeahead').typeahead(null, {*/
/*     name: 'breeder',*/
/*     display: 'can_owner_name',*/
/*     placeholder: false,*/
/*     source: breeder.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*     suggestion: function (data) {*/
/*         return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_owner_name + '</div></a><br><hr>';*/
/*     }*/
/*     }*/
/* });*/
/* */
/* // kennel*/
/* var kennel = new Bloodhound({*/
/*     identify: function(o) { return o.can_cage; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),*/
/*     dupDetector: function(a, b) { return a.can_cage === b.can_cage; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/kennel?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* kennel.initialize();*/
/* $('#kennel-canines .typeahead').typeahead(null, {*/
/*     name: 'kennel',*/
/*     display: 'can_cage',*/
/*     placeholder: false,*/
/*     source: kennel.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*     suggestion: function (data) {*/
/*         return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_cage + '</div></a><br><hr>';*/
/*     }*/
/*     }*/
/* });*/
/* </script>*/
/* {% endblock %}*/
/* */
