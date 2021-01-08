<?php

/* front/view_studs.twig */
class __TwigTemplate_ca0bd8418dee618049267481333cab93596acd210ce3ceadf67529bf83fe046a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/view_studs.twig", 2);
        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'inverted' => array($this, 'block_inverted'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "template/frontend.twig";
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
<link href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/css/font-awesome.css\" rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-magnific/magnific-popup.css\" rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">

<style>
    .bg-info{
        background-color: #000000 !important;
    }
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
    th{
        color: white !important;
    }
    th.picker-switch{
        color: gray !important;
    }
    .datepicker table tr td.today,
    .datepicker table tr td.today:hover,
    .datepicker table tr td.today.disabled,
    .datepicker table tr td.today.disabled:hover {
        background-color: gray;
    }
    .text-gray{
        color: gray !important;
    }
</style>
";
    }

    // line 53
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 55
    public function block_header($context, array $blocks = array())
    {
        // line 56
        echo "
";
    }

    // line 59
    public function block_content($context, array $blocks = array())
    {
        // line 60
        echo "<!-- Page Content -->

<section class=\"hero-banner bg-info\">
    <div class=\"container\">
        <div class=\"row text-center\">
            <h3 class=\"text-white-1\">List Pacak</h3>
            <br/>
        </div>
        <div class=\"row\">
            <form class=\"form-horizontal push-10-t\" action=\"";
        // line 69
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "studs\" method=\"get\" style=\"margin-top:19px;\">
                <div class=\"form-group\">
                    <div class=\"col-xs-7\"></div>
                    <div class=\"col-xs-5\">
                        <div class=\"col-xs-12 js-header-search header-search\" >
                            <div class=\"input-group\" id=\"prefetch\">
                                <input class=\"form-control search\" type=\"text\" name=\"q\" placeholder=\"Tanggal Pacak\" required=\"Maaf pencarian tidak boleh kosong!!\">
                                <div class=\"input-group-btn\">
                                    <button class=\"btn btn-default\"><i class=\"icon-search\"></i></button>
                                </div>
                            </div>
                            <h5 class=\"text-white-1 text-center\">Format Tanggal Pacak: tgl-bulan-tahun. Contoh: 12-12-2012.</h5>
                        </div>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-xs-4 col-xs-offset-4\">    
                        ";
        // line 86
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 87
            echo "                            <div class=\"panel panel-default\" data-modal=\"md-fade-in-scale-up\" style=\"margin-top: 5px; background-color:#fcf8e3;\">
                                <div class=\"panel-body\">";
            // line 88
            echo (isset($context["error"]) ? $context["error"] : null);
            echo "</div>
                            </div>
                        ";
        }
        // line 91
        echo "                    </div>
                </div>
            </form>
        </div>
        <div class=\"table-responsive\">
            <div class=\"block-header text-center bg-gray-lighter\">
                <button class=\"btn btn-primary btn-add-studs pull-right\" onClick=\"openModal('#modal-add-stud', 'add-stud')\" data-toggle=\"tooltip\" title=\"Tambah Pacak\"><i class=\"fa fa-plus\"></i></button>
            </div>
            <table class=\"table table-borderless\">
                <thead>
                    <tr>
                        <th width=\"5%\">Pacak</th>
                        <th>Tanggal Pacak</th>
                        <th width=\"5%\">Sire</th>
                        <th width=\"5%\">Dam</th>
                        <th>Status</th>
                        <th>Approver</th>
                        <th>Tanggal Approve</th>
                        <th class=\"text-center\" width=\"1%\"></th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 114
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["studs"]) ? $context["studs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 115
            echo "                        <tr>
                            ";
            // line 116
            if (($this->getAttribute($context["row"], "stu_photo", array()) == "-")) {
                // line 117
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            } else {
                // line 119
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/stud/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stu_photo", array()), "html", null, true);
                echo "\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            }
            // line 121
            echo "
                            <td class=\"text-white-1\">";
            // line 122
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "stu_date", array()), "d-m-Y"), "html", null, true);
            echo "</td>

                            ";
            // line 124
            if (($this->getAttribute($context["row"], "stu_sire_photo", array()) == "-")) {
                // line 125
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            } else {
                // line 127
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/stud/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stu_sire_photo", array()), "html", null, true);
                echo "\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            }
            // line 129
            echo "                            
                            ";
            // line 130
            if (($this->getAttribute($context["row"], "stu_mom_photo", array()) == "-")) {
                // line 131
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            } else {
                // line 133
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/stud/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stu_mom_photo", array()), "html", null, true);
                echo "\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            }
            // line 135
            echo "
                            <td class=\"text-white-1\">";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stat_name", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "use_username", array()), "html", null, true);
            echo "</td>

                            ";
            // line 139
            if ($this->getAttribute($context["row"], "stu_app_date", array())) {
                // line 140
                echo "                                <td class=\"text-white-1\">";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "stu_app_date", array()), "d-m-Y"), "html", null, true);
                echo "</td>
                            ";
            } else {
                // line 142
                echo "                                <td class=\"text-white-1\"></td>
                            ";
            }
            // line 144
            echo "
                            ";
            // line 145
            if (($this->getAttribute($context["row"], "stu_stat", array()) == 0)) {
                // line 146
                echo "                                <td><button class=\"btn btn-default\" onClick=\"openModal('#modal-update-stud', 'update-stud', ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stu_id", array()), "html", null, true);
                echo ")\" data-toggle=\"tooltip\" title=\"Ubah Data\"><i class=\"fa fa-pencil\"></i></button></td>
                            ";
            } elseif (($this->getAttribute(            // line 147
$context["row"], "stu_stat", array()) == 1)) {
                // line 148
                echo "                                <td><button class=\"btn btn-info\" onClick=\"openModal('#modal-add-birth', 'add-birth', ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stu_id", array()), "html", null, true);
                echo ")\" data-toggle=\"tooltip\" title=\"Tambah data lahir\"><i class=\"fa fa-plus\"></i></button></td>
                            ";
            } else {
                // line 150
                echo "                                <td></td>
                            ";
            }
            // line 152
            echo "
                            <td class=\"text-white-1\">";
            // line 153
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stu_note", array()), "html", null, true);
            echo "</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 156
        echo "                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-stud\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 166
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "studs/add\" class=\"form-add-stud form-horizontal\" method=\"post\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h3 class=\"modal-title\" id=\"myModalLabel\">Request Penambahan Data Pacak</h3>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgStud\" width=\"100%\" src=\"";
        // line 174
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
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgSire\" width=\"100%\" src=\"";
        // line 185
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
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgDam\" width=\"100%\" src=\"";
        // line 196
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInputDam\" class=\"btn\">Gambar Dam</label>
                                <input type=\"file\" class=\"upload dam\" name=\"stu_mom_photo\" id=\"imageInputDam\" required/>
                                <input type=\"hidden\" class=\"\" name=\"srcDataCropDam\" id=\"srcDataCropDam\" required/>
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"date-add-stud\">Tanggal Pacak</label>
                            <input class=\"form-control\" id=\"date-add-stud\" name=\"stu_stud_date\" type=\"text\" required>
                        </div>
                    </div>
                </div>

                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                    <button type=\"submit\" class=\"btn btn-primary submit-add-stud\">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=\"modal fade\" id=\"modal-update-stud\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-stud form-horizontal\" method=\"post\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h3 class=\"modal-title\" id=\"myModalLabel\">Request Pengubahan Data Pacak</h3>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgStud-update\" width=\"100%\" src=\"";
        // line 233
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInputStud-update\" class=\"btn\">Gambar Pacak</label>
                                <input type=\"file\" class=\"upload stud\" name=\"stu_photo\" id=\"imageInputStud-update\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCropStud-update\" />
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgSire-update\" width=\"100%\" src=\"";
        // line 244
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInputSire-update\" class=\"btn\">Gambar Sire</label>
                                <input type=\"file\" class=\"upload sire\" name=\"stu_sire_photo\" id=\"imageInputSire-update\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCropSire\" id=\"srcDataCropSire-update\" />
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgDam-update\" width=\"100%\" src=\"";
        // line 255
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInputDam-update\" class=\"btn\">Gambar Dam</label>
                                <input type=\"file\" class=\"upload dam\" name=\"stu_mom_photo\" id=\"imageInputDam-update\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCropDam\" id=\"srcDataCropDam-update\" />
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"date-update-stud\">Tanggal Pacak</label>
                            <input class=\"form-control\" id=\"date-update-stud\" name=\"stu_stud_date\" type=\"text\" required>
                        </div>
                    </div>
                </div>

                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                    <button type=\"submit\" class=\"btn btn-primary submit-update-stud\">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=\"modal fade\" id=\"modal-add-birth\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-add-birth form-horizontal\" method=\"post\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h3 class=\"modal-title\" id=\"myModalLabel\">Request Penambahan Data Lahir</h3>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgCanine\" width=\"100%\" src=\"";
        // line 292
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInputCanine\" class=\"btn\">Gambar Canine</label>
                                <input type=\"file\" class=\"upload canine\" name=\"bir_photo\" id=\"imageInputCanine\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCropCanine\" />
                            </div>
                        </div>
                    </div>

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
        // line 312
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 313
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 315
        echo "                          </select>
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

                    <input type=\"hidden\" value=\"\" id=\"bir_stu_id\" name=\"bir_stu_id\">

                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                        <button type=\"submit\" class=\"btn btn-primary submit-add-birth\">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=\"modal fade\" id=\"cropper-modal\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                <h3 class=\"modal-title\" id=\"myModalLabel\">Image Cropper</h3>
            </div>
            <div class=\"modal-body\">
                <div id=\"cropper-wrap-img\">
                    <img width=\"100%\" src=\"/img/default.png\" alt=\"Picture\">
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
        // line 388
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"\" id=\"imgPreview\" />
<input type=\"hidden\" value=\"\" id=\"srcDataCrop\" />
";
    }

    // line 393
    public function block_scripts($context, array $blocks = array())
    {
        // line 394
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 395
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 396
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 397
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 398
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>

<!-- search engine -->
<script src=\"";
        // line 401
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 402
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 403
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>

<!-- Page JS Code -->
<script src=\"";
        // line 406
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/view_studs.js\"></script>

<script>
var base_url = \$('.base_url').val();

// breeder
var breeder = new Bloodhound({
    identify: function(o) { return o.can_owner_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),
    dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },
    remote: {
      url: base_url+'canines/breeder?q=%QUERY',
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
      url: base_url+'canines/kennel?q=%QUERY',
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
        return "front/view_studs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  629 => 406,  623 => 403,  619 => 402,  615 => 401,  609 => 398,  605 => 397,  601 => 396,  597 => 395,  594 => 394,  591 => 393,  583 => 388,  508 => 315,  497 => 313,  493 => 312,  470 => 292,  430 => 255,  416 => 244,  402 => 233,  362 => 196,  348 => 185,  334 => 174,  323 => 166,  311 => 156,  302 => 153,  299 => 152,  295 => 150,  289 => 148,  287 => 147,  282 => 146,  280 => 145,  277 => 144,  273 => 142,  267 => 140,  265 => 139,  260 => 137,  256 => 136,  253 => 135,  245 => 133,  239 => 131,  237 => 130,  234 => 129,  226 => 127,  220 => 125,  218 => 124,  213 => 122,  210 => 121,  202 => 119,  196 => 117,  194 => 116,  191 => 115,  187 => 114,  162 => 91,  156 => 88,  153 => 87,  151 => 86,  131 => 69,  120 => 60,  117 => 59,  112 => 56,  109 => 55,  103 => 53,  58 => 11,  54 => 10,  50 => 9,  46 => 8,  42 => 7,  38 => 6,  35 => 5,  32 => 4,  11 => 2,);
    }
}
/* {# By: ARTechnology #}*/
/* {% extends "template/frontend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/css/font-awesome.css" rel="stylesheet" type="text/css" />*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link href="{{base_url()}}assets/coco/libs/jquery-magnific/magnific-popup.css" rel="stylesheet" type="text/css" />*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* */
/* <style>*/
/*     .bg-info{*/
/*         background-color: #000000 !important;*/
/*     }*/
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
/*     th{*/
/*         color: white !important;*/
/*     }*/
/*     th.picker-switch{*/
/*         color: gray !important;*/
/*     }*/
/*     .datepicker table tr td.today,*/
/*     .datepicker table tr td.today:hover,*/
/*     .datepicker table tr td.today.disabled,*/
/*     .datepicker table tr td.today.disabled:hover {*/
/*         background-color: gray;*/
/*     }*/
/*     .text-gray{*/
/*         color: gray !important;*/
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block inverted %}inverted{% endblock %}*/
/* */
/* {% block header %}*/
/* */
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* <!-- Page Content -->*/
/* */
/* <section class="hero-banner bg-info">*/
/*     <div class="container">*/
/*         <div class="row text-center">*/
/*             <h3 class="text-white-1">List Pacak</h3>*/
/*             <br/>*/
/*         </div>*/
/*         <div class="row">*/
/*             <form class="form-horizontal push-10-t" action="{{ base_url() }}studs" method="get" style="margin-top:19px;">*/
/*                 <div class="form-group">*/
/*                     <div class="col-xs-7"></div>*/
/*                     <div class="col-xs-5">*/
/*                         <div class="col-xs-12 js-header-search header-search" >*/
/*                             <div class="input-group" id="prefetch">*/
/*                                 <input class="form-control search" type="text" name="q" placeholder="Tanggal Pacak" required="Maaf pencarian tidak boleh kosong!!">*/
/*                                 <div class="input-group-btn">*/
/*                                     <button class="btn btn-default"><i class="icon-search"></i></button>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <h5 class="text-white-1 text-center">Format Tanggal Pacak: tgl-bulan-tahun. Contoh: 12-12-2012.</h5>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <div class="col-xs-4 col-xs-offset-4">    */
/*                         {% if error %}*/
/*                             <div class="panel panel-default" data-modal="md-fade-in-scale-up" style="margin-top: 5px; background-color:#fcf8e3;">*/
/*                                 <div class="panel-body">{{error|raw}}</div>*/
/*                             </div>*/
/*                         {% endif %}*/
/*                     </div>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*         <div class="table-responsive">*/
/*             <div class="block-header text-center bg-gray-lighter">*/
/*                 <button class="btn btn-primary btn-add-studs pull-right" onClick="openModal('#modal-add-stud', 'add-stud')" data-toggle="tooltip" title="Tambah Pacak"><i class="fa fa-plus"></i></button>*/
/*             </div>*/
/*             <table class="table table-borderless">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5%">Pacak</th>*/
/*                         <th>Tanggal Pacak</th>*/
/*                         <th width="5%">Sire</th>*/
/*                         <th width="5%">Dam</th>*/
/*                         <th>Status</th>*/
/*                         <th>Approver</th>*/
/*                         <th>Tanggal Approve</th>*/
/*                         <th class="text-center" width="1%"></th>*/
/*                         <th>Keterangan</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                     {% for row in studs %}*/
/*                         <tr>*/
/*                             {% if row.stu_photo == '-' %}*/
/*                                 <td><img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% else %}*/
/*                                 <td><img src="{{base_url()}}uploads/stud/{{row.stu_photo}}" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% endif %}*/
/* */
/*                             <td class="text-white-1">{{row.stu_date|date("d-m-Y")}}</td>*/
/* */
/*                             {% if row.stu_sire_photo == '-' %}*/
/*                                 <td><img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% else %}*/
/*                                 <td><img src="{{base_url()}}uploads/stud/{{row.stu_sire_photo}}" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% endif %}*/
/*                             */
/*                             {% if row.stu_mom_photo == '-' %}*/
/*                                 <td><img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% else %}*/
/*                                 <td><img src="{{base_url()}}uploads/stud/{{row.stu_mom_photo}}" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% endif %}*/
/* */
/*                             <td class="text-white-1">{{row.stat_name}}</td>*/
/*                             <td class="text-white-1">{{row.use_username}}</td>*/
/* */
/*                             {% if row.stu_app_date %}*/
/*                                 <td class="text-white-1">{{row.stu_app_date|date("d-m-Y")}}</td>*/
/*                             {% else %}*/
/*                                 <td class="text-white-1"></td>*/
/*                             {% endif %}*/
/* */
/*                             {% if row.stu_stat == 0 %}*/
/*                                 <td><button class="btn btn-default" onClick="openModal('#modal-update-stud', 'update-stud', {{row.stu_id}})" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-pencil"></i></button></td>*/
/*                             {% elseif row.stu_stat == 1 %}*/
/*                                 <td><button class="btn btn-info" onClick="openModal('#modal-add-birth', 'add-birth', {{row.stu_id}})" data-toggle="tooltip" title="Tambah data lahir"><i class="fa fa-plus"></i></button></td>*/
/*                             {% else %}*/
/*                                 <td></td>*/
/*                             {% endif %}*/
/* */
/*                             <td class="text-white-1">{{row.stu_note}}</td>*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                 </tbody>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-stud" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}studs/add" class="form-add-stud form-horizontal" method="post">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                     <h3 class="modal-title" id="myModalLabel">Request Penambahan Data Pacak</h3>*/
/*                 </div>*/
/*                 <div class="modal-body">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgStud" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputStud" class="btn">Gambar Pacak</label>*/
/*                                 <input type="file" class="upload stud" name="stu_photo" id="imageInputStud" required/>*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCropStud" required/>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgSire" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputSire" class="btn">Gambar Sire</label>*/
/*                                 <input type="file" class="upload sire" name="stu_sire_photo" id="imageInputSire" required/>*/
/*                                 <input type="hidden" class="" name="srcDataCropSire" id="srcDataCropSire" required/>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgDam" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputDam" class="btn">Gambar Dam</label>*/
/*                                 <input type="file" class="upload dam" name="stu_mom_photo" id="imageInputDam" required/>*/
/*                                 <input type="hidden" class="" name="srcDataCropDam" id="srcDataCropDam" required/>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="date-add-stud">Tanggal Pacak</label>*/
/*                             <input class="form-control" id="date-add-stud" name="stu_stud_date" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="modal-footer">*/
/*                     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                     <button type="submit" class="btn btn-primary submit-add-stud">Save</button>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="modal fade" id="modal-update-stud" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-stud form-horizontal" method="post">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                     <h3 class="modal-title" id="myModalLabel">Request Pengubahan Data Pacak</h3>*/
/*                 </div>*/
/*                 <div class="modal-body">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgStud-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputStud-update" class="btn">Gambar Pacak</label>*/
/*                                 <input type="file" class="upload stud" name="stu_photo" id="imageInputStud-update" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCropStud-update" />*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgSire-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputSire-update" class="btn">Gambar Sire</label>*/
/*                                 <input type="file" class="upload sire" name="stu_sire_photo" id="imageInputSire-update" />*/
/*                                 <input type="hidden" class="" name="srcDataCropSire" id="srcDataCropSire-update" />*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgDam-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputDam-update" class="btn">Gambar Dam</label>*/
/*                                 <input type="file" class="upload dam" name="stu_mom_photo" id="imageInputDam-update" />*/
/*                                 <input type="hidden" class="" name="srcDataCropDam" id="srcDataCropDam-update" />*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="date-update-stud">Tanggal Pacak</label>*/
/*                             <input class="form-control" id="date-update-stud" name="stu_stud_date" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="modal-footer">*/
/*                     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                     <button type="submit" class="btn btn-primary submit-update-stud">Save</button>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="modal fade" id="modal-add-birth" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-add-birth form-horizontal" method="post">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                     <h3 class="modal-title" id="myModalLabel">Request Penambahan Data Lahir</h3>*/
/*                 </div>*/
/*                 <div class="modal-body">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgCanine" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInputCanine" class="btn">Gambar Canine</label>*/
/*                                 <input type="file" class="upload canine" name="bir_photo" id="imageInputCanine" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCropCanine" />*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="as-add-canines">Nama</label>*/
/*                           <input class="form-control" id="as-add-canines" name="bir_a_s" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="breed-add-canines">Breed</label>*/
/*                           <select class="form-control" id="breed-add-canines" name="bir_breed" required>*/
/*                             {% for trah in trahs %}*/
/*                                 <option value="{{trah.tra_name}}">{{trah.tra_name}}</option>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="gender-add-canines">Gender</label>*/
/*                           <br>*/
/*                           <input id="gender-add-canines" name="bir_gender" type="radio" value="Male" checked>Male&nbsp;&nbsp;*/
/*                           <input id="gender-add-canines" name="bir_gender" type="radio" value="Female" />Female*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="color-add-canines">Color</label>*/
/*                           <input class="form-control" id="color-add-canines" name="bir_color" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="bir_date_of_birth">Tanggal Lahir</label>*/
/*                             <input class="form-control" id="bir_date_of_birth" name="bir_date_of_birth" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="breeder-canines">*/
/*                           <label for="breeder">Breeder</label>*/
/*                           <input class="form-control typeahead" id="breeder" name="bir_owner_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="kennel-canines">*/
/*                           <label for="kennel">Kennel</label>*/
/*                           <input class="form-control typeahead" id="kennel" name="bir_cage" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <input type="hidden" value="" id="bir_stu_id" name="bir_stu_id">*/
/* */
/*                     <div class="modal-footer">*/
/*                         <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                         <button type="submit" class="btn btn-primary submit-add-birth">Save</button>*/
/*                     </div>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="modal fade" id="cropper-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <div class="modal-header">*/
/*                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                 <h3 class="modal-title" id="myModalLabel">Image Cropper</h3>*/
/*             </div>*/
/*             <div class="modal-body">*/
/*                 <div id="cropper-wrap-img">*/
/*                     <img width="100%" src="/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*                 <button type="button" class="btn btn-primary btn-crop">Crop</button>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="" id="imgPreview" />*/
/* <input type="hidden" value="" id="srcDataCrop" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* */
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/view_studs.js"></script>*/
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* // breeder*/
/* var breeder = new Bloodhound({*/
/*     identify: function(o) { return o.can_owner_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),*/
/*     dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },*/
/*     remote: {*/
/*       url: base_url+'canines/breeder?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* breeder.initialize();*/
/* $('#breeder-canines .typeahead').typeahead(null, {*/
/* name: 'breeder',*/
/* display: 'can_owner_name',*/
/* placeholder: false,*/
/* source: breeder.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*      return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_owner_name + '</div></a><br><hr>';*/
/*  }*/
/* }*/
/* });*/
/* */
/* // kennel*/
/* var kennel = new Bloodhound({*/
/*     identify: function(o) { return o.can_cage; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),*/
/*     dupDetector: function(a, b) { return a.can_cage === b.can_cage; },*/
/*     remote: {*/
/*       url: base_url+'canines/kennel?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* kennel.initialize();*/
/* $('#kennel-canines .typeahead').typeahead(null, {*/
/* name: 'kennel',*/
/* display: 'can_cage',*/
/* placeholder: false,*/
/* source: kennel.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*      return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_cage + '</div></a><br><hr>';*/
/*  }*/
/* }*/
/* });*/
/* </script>*/
/* */
/* {% endblock %}*/
