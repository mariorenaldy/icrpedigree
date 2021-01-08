<?php

/* backend/faqs.twig */
class __TwigTemplate_95f0a617a5fbb506c3cea0e1db55e67d3e8bd0be288018d36bcdf69f9a24aeca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/faqs.twig", 1);
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
            <li>Kritik dan Saran</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-default btn-delete-faqs pull-left\"  data-toggle=\"tooltip\" title=\"Hapus yang dipilih\" disabled><i class=\"si si-trash\"></i></button>

            <!-- <button class=\"btn btn-primary btn-add-faqs pull-right\" onClick=\"openModal('#modal-add-faqs', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Kritik dan Saran\"><i class=\"si si-note\"></i></button> -->
            <h4> <small>Daftar</small> Kritik dan Saran</h4>
        </div>
        <div class=\"block-content table-requonsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/faqs.js -->
            <table class=\"table table-borderless table-striped data-faqss\">
                <thead>
                    <tr>
                        <th width=\"5\">
                            <div class=\"checkbox-faqs-all\">
                              <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                            </div>
                        </th>
                        <th>Email</th>
                        <th>Content</th>
                        <th>Jenis</th>
                        <!-- <th>Tanggal</th> -->
                        <!-- <th class=\"text-center\" width=\"1%\">#</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
";
    }

    // line 55
    public function block_scripts($context, array $blocks = array())
    {
        // line 56
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 57
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 58
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 59
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 60
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 61
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 62
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 63
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 66
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_faqs.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/faqs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 66,  137 => 65,  132 => 63,  128 => 62,  124 => 61,  120 => 60,  116 => 59,  112 => 58,  108 => 57,  105 => 56,  102 => 55,  58 => 13,  55 => 12,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Kritik dan Saran</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-default btn-delete-faqs pull-left"  data-toggle="tooltip" title="Hapus yang dipilih" disabled><i class="si si-trash"></i></button>*/
/* */
/*             <!-- <button class="btn btn-primary btn-add-faqs pull-right" onClick="openModal('#modal-add-faqs', 'add')" data-toggle="tooltip" title="Tambah Kritik dan Saran"><i class="si si-note"></i></button> -->*/
/*             <h4> <small>Daftar</small> Kritik dan Saran</h4>*/
/*         </div>*/
/*         <div class="block-content table-requonsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/faqs.js -->*/
/*             <table class="table table-borderless table-striped data-faqss">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5">*/
/*                             <div class="checkbox-faqs-all">*/
/*                               <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                             </div>*/
/*                         </th>*/
/*                         <th>Email</th>*/
/*                         <th>Content</th>*/
/*                         <th>Jenis</th>*/
/*                         <!-- <th>Tanggal</th> -->*/
/*                         <!-- <th class="text-center" width="1%">#</th> -->*/
/*                     </tr>*/
/*                 </thead>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
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
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_faqs.js"></script>*/
/* {% endblock %}*/
/* */
