<?php

/* backend/studs.twig */
class __TwigTemplate_073b871f219aba732b6ee259517659c038696d05c33b44185bc233ae746e9511 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/studs.twig", 2);
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
        echo "/assets/select2/css/select2.min.css\" />
";
    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        // line 13
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li>Approve Data Pacak</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <h4>Approve Data Pacak</h4>
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
                            <th width=\"5%\">Sire</th>
                            <th width=\"5%\">Dam</th>
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
<div class=\"modal fade\" id=\"modal-approve-stud\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-approve-stud form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Approve Pacak</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgStud\">Pacak</label>
                                    <img id=\"imgStud\" width=\"100%\" src=\"";
        // line 69
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"stu-stud-date\">Tanggal Pacak</label>
                                    <div id=\"stu-stud-date\"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgSire\">Foto Sire</label>
                                    <img id=\"imgSire\" width=\"100%\" src=\"";
        // line 87
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_sire\">
                                    <label for=\"stu_sire_id\">Sire</label>
                                    <select class=\"form-control sire\" id=\"stu_sire_id\" name=\"stu_sire_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgDam\">Foto Dam</label>
                                    <img id=\"imgDam\" width=\"100%\" src=\"";
        // line 105
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"stu_dam\">
                                    <label for=\"stu_dam_id\">Dam</label>
                                    <select class=\"form-control dam\" id=\"stu_dam_id\" name=\"stu_mom_id\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-10 col-xs-offset-1\">
                                <label for=\"stu_note_approve\">Keterangan</label>
                                <textarea class=\"form-control\" name=\"stu_note\" id=\"stu_note_approve\"  rows=\"4\" cols=\"20\"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-approve-stud\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal approve-->

<div class=\"modal fade\" id=\"modal-reject-stud\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-reject-stud form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tolak Pacak</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgStud\">Pacak</label>
                                    <img id=\"imgStud\" width=\"100%\" src=\"";
        // line 157
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12 text-center\">
                                    <label for=\"stu-stud-date-reject\">Tanggal Pacak</label>
                                    <div id=\"stu-stud-date-reject\"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgSire\">Foto Sire</label>
                                    <img id=\"imgSire\" width=\"100%\" src=\"";
        // line 175
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgDam\">Foto Dam</label>
                                    <img id=\"imgDam\" width=\"100%\" src=\"";
        // line 183
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group\">
                            <div class=\"col-xs-10 col-xs-offset-1\">
                                <label for=\"stu_note_reject\">Keterangan</label>
                                <textarea class=\"form-control\" name=\"stu_note\" id=\"stu_note_reject\"  rows=\"4\" cols=\"20\"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-reject-stud\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal approve-->
";
    }

    // line 209
    public function block_scripts($context, array $blocks = array())
    {
        // line 210
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 211
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 212
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 213
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<script src=\"";
        // line 214
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/select2/js/select2.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 216
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 217
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_studs.js\"></script>
<script>
var base_url = \$('.base_url').val();

";
        // line 222
        echo "
\$(\".dam\").select2({
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
    dropdownParent: \$(\"#modal-approve-stud\")
});

\$(\".sire\").select2({
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
    dropdownParent: \$(\"#modal-approve-stud\")
});
</script>
";
    }

    public function getTemplateName()
    {
        return "backend/studs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  307 => 222,  300 => 217,  296 => 216,  291 => 214,  287 => 213,  283 => 212,  279 => 211,  276 => 210,  273 => 209,  244 => 183,  233 => 175,  212 => 157,  157 => 105,  136 => 87,  115 => 69,  57 => 13,  54 => 12,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
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
/* <link rel="stylesheet" href="{{ base_url() }}/assets/select2/css/select2.min.css" />*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Approve Data Pacak</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <h4>Approve Data Pacak</h4>*/
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
/*                             <th width="5%">Sire</th>*/
/*                             <th width="5%">Dam</th>*/
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
/* <div class="modal fade" id="modal-approve-stud" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-approve-stud form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Approve Pacak</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgStud">Pacak</label>*/
/*                                     <img id="imgStud" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="stu-stud-date">Tanggal Pacak</label>*/
/*                                     <div id="stu-stud-date"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgSire">Foto Sire</label>*/
/*                                     <img id="imgSire" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_sire">*/
/*                                     <label for="stu_sire_id">Sire</label>*/
/*                                     <select class="form-control sire" id="stu_sire_id" name="stu_sire_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgDam">Foto Dam</label>*/
/*                                     <img id="imgDam" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="stu_dam">*/
/*                                     <label for="stu_dam_id">Dam</label>*/
/*                                     <select class="form-control dam" id="stu_dam_id" name="stu_mom_id" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="row">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-10 col-xs-offset-1">*/
/*                                 <label for="stu_note_approve">Keterangan</label>*/
/*                                 <textarea class="form-control" name="stu_note" id="stu_note_approve"  rows="4" cols="20"></textarea>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-approve-stud">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal approve-->*/
/* */
/* <div class="modal fade" id="modal-reject-stud" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-reject-stud form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tolak Pacak</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgStud">Pacak</label>*/
/*                                     <img id="imgStud" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12 text-center">*/
/*                                     <label for="stu-stud-date-reject">Tanggal Pacak</label>*/
/*                                     <div id="stu-stud-date-reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgSire">Foto Sire</label>*/
/*                                     <img id="imgSire" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgDam">Foto Dam</label>*/
/*                                     <img id="imgDam" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="row">*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-10 col-xs-offset-1">*/
/*                                 <label for="stu_note_reject">Keterangan</label>*/
/*                                 <textarea class="form-control" name="stu_note" id="stu_note_reject"  rows="4" cols="20"></textarea>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-reject-stud">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal approve-->*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <script src="{{ base_url() }}assets/select2/js/select2.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_studs.js"></script>*/
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* {# start select2 #}*/
/* */
/* $(".dam").select2({*/
/*     placeholder: 'Pilih Dam',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/dam",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-approve-stud")*/
/* });*/
/* */
/* $(".sire").select2({*/
/*     placeholder: 'Pilih Sire',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/sire",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-approve-stud")*/
/* });*/
/* </script>*/
/* {% endblock %}*/
/* */
