<?php

/* backend/births.twig */
class __TwigTemplate_fa619278200e04715fe7152cec4f128ff102b0f25220530810064bb9b6a5f120 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/births.twig", 2);
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
            <li>Approve Data Lahir</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <h4>Approve Data Lahir</h4>
        </div>
        <div class=\"block-content\">
            <div class=\"table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
                <table class=\"table table-borderless table-striped data-births\">
                    <thead>
                        <tr>
                            <th width=\"5%\">Foto</th>
                            <th>Nama</th>
                            <th>Breed</th>
                            <th>Jenis Kelamin</th>
                            <th>Warna</th>
                            <th>Tanggal Lahir</th>
                            <th>Breeder</th>
                            <th>Kennel</th>
                            <th>Member</th>
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
<div class=\"modal fade\" id=\"modal-approve-birth\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-approve-birth form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Approve Lahir</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgBirth_approve\">Foto</label>
                                    <img id=\"imgBirth_approve\" width=\"100%\" src=\"";
        // line 73
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_a_s_approve\">Nama</label>
                                    <div id=\"bir_a_s_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_breed_approve\">Breed</label>
                                    <div id=\"bir_breed_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_gender_approve\">Jenis Kelamin</label>
                                    <div id=\"bir_gender_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_color_approve\">Warna</label>
                                    <div id=\"bir_color_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_date_of_birth_approve\">Tanggal Lahir</label>
                                    <div id=\"bir_date_of_birth_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_owner_name_approve\">Breeder</label>
                                    <div id=\"bir_owner_name_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_cage_approve\">Kennel</label>
                                    <div id=\"bir_cage_approve\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-10 col-xs-offset-1\">
                                <label for=\"bir_note_approve\">Keterangan</label>
                                <textarea class=\"form-control\" name=\"bir_note\" id=\"bir_note_approve\"  rows=\"4\" cols=\"20\"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-approve-birth\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal approve-->

<div class=\"modal fade\" id=\"modal-reject-birth\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-reject-birth form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tolak Lahir</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <label for=\"imgBirth_reject\">Foto</label>
                                    <img id=\"imgBirth_reject\" width=\"100%\" src=\"";
        // line 171
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_a_s_reject\">Nama</label>
                                    <div id=\"bir_a_s_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_breed_reject\">Breed</label>
                                    <div id=\"bir_breed_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_gender_reject\">Jenis Kelamin</label>
                                    <div id=\"bir_gender_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_color_reject\">Warna</label>
                                    <div id=\"bir_color_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_date_of_birth_reject\">Tanggal Lahir</label>
                                    <div id=\"bir_date_of_birth_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_owner_name_reject\">Breeder</label>
                                    <div id=\"bir_owner_name_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-12\">
                                    <label for=\"bir_cage_reject\">Kennel</label>
                                    <div id=\"bir_cage_reject\"></div>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-xs-10 col-xs-offset-1\">
                                <label for=\"bir_note_reject\">Keterangan</label>
                                <textarea class=\"form-control\" name=\"bir_note\" id=\"bir_note_reject\"  rows=\"4\" cols=\"20\"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-reject-birth\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal reject-->
";
    }

    // line 251
    public function block_scripts($context, array $blocks = array())
    {
        // line 252
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 253
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 254
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 255
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 257
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 258
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_births.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/births.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  326 => 258,  322 => 257,  317 => 255,  313 => 254,  309 => 253,  306 => 252,  303 => 251,  220 => 171,  119 => 73,  57 => 13,  54 => 12,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
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
/*             <li>Approve Data Lahir</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <h4>Approve Data Lahir</h4>*/
/*         </div>*/
/*         <div class="block-content">*/
/*             <div class="table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*                 <table class="table table-borderless table-striped data-births">*/
/*                     <thead>*/
/*                         <tr>*/
/*                             <th width="5%">Foto</th>*/
/*                             <th>Nama</th>*/
/*                             <th>Breed</th>*/
/*                             <th>Jenis Kelamin</th>*/
/*                             <th>Warna</th>*/
/*                             <th>Tanggal Lahir</th>*/
/*                             <th>Breeder</th>*/
/*                             <th>Kennel</th>*/
/*                             <th>Member</th>*/
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
/* <div class="modal fade" id="modal-approve-birth" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-approve-birth form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Approve Lahir</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-12">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgBirth_approve">Foto</label>*/
/*                                     <img id="imgBirth_approve" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_a_s_approve">Nama</label>*/
/*                                     <div id="bir_a_s_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_breed_approve">Breed</label>*/
/*                                     <div id="bir_breed_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_gender_approve">Jenis Kelamin</label>*/
/*                                     <div id="bir_gender_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_color_approve">Warna</label>*/
/*                                     <div id="bir_color_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_date_of_birth_approve">Tanggal Lahir</label>*/
/*                                     <div id="bir_date_of_birth_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_owner_name_approve">Breeder</label>*/
/*                                     <div id="bir_owner_name_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_cage_approve">Kennel</label>*/
/*                                     <div id="bir_cage_approve"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-10 col-xs-offset-1">*/
/*                                 <label for="bir_note_approve">Keterangan</label>*/
/*                                 <textarea class="form-control" name="bir_note" id="bir_note_approve"  rows="4" cols="20"></textarea>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-approve-birth">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal approve-->*/
/* */
/* <div class="modal fade" id="modal-reject-birth" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-reject-birth form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tolak Lahir</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <label for="imgBirth_reject">Foto</label>*/
/*                                     <img id="imgBirth_reject" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_a_s_reject">Nama</label>*/
/*                                     <div id="bir_a_s_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_breed_reject">Breed</label>*/
/*                                     <div id="bir_breed_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_gender_reject">Jenis Kelamin</label>*/
/*                                     <div id="bir_gender_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_color_reject">Warna</label>*/
/*                                     <div id="bir_color_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_date_of_birth_reject">Tanggal Lahir</label>*/
/*                                     <div id="bir_date_of_birth_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_owner_name_reject">Breeder</label>*/
/*                                     <div id="bir_owner_name_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_cage_reject">Kennel</label>*/
/*                                     <div id="bir_cage_reject"></div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                             <div class="col-xs-10 col-xs-offset-1">*/
/*                                 <label for="bir_note_reject">Keterangan</label>*/
/*                                 <textarea class="form-control" name="bir_note" id="bir_note_reject"  rows="4" cols="20"></textarea>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-reject-birth">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal reject-->*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_births.js"></script>*/
/* {% endblock %}*/
/* */
