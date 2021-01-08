<?php

/* backend/requests.twig */
class __TwigTemplate_5d0ab2d5d528b5001848544b11fed9e0a7a286a14d2b4c8c310e302ead9d65f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/requests.twig", 2);
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

<style>
    #imgPreview, #imgPreview-update{
        /*border-radius:50%;*/
        margin-bottom: 15px;
    }
</style>
";
    }

    // line 16
    public function block_body($context, array $blocks = array())
    {
        // line 17
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li>Approve Request Pengubahan Data Canine</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <h4>Approve Request Pengubahan Data Canine</h4>
        </div>
        <div class=\"block-content table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
            <table class=\"table table-borderless table-striped data-requests\">
                <thead>
                    <tr>
                        <th width=\"1%\">Foto</th>
                        <th>Tanggal Request</th>
                        <th>AS</th>
                        <th>Kennel</th>
                        <th>Alamat</th>
                        <th>Pemilik</th>
                        <th>Approver</th>
                        <th>Tanggal Approve</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
";
    }

    // line 56
    public function block_scripts($context, array $blocks = array())
    {
        // line 57
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 58
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 61
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/requests.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/requests.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 61,  104 => 60,  99 => 58,  96 => 57,  93 => 56,  52 => 17,  49 => 16,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* {# ARTechnology #}*/
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* */
/* <style>*/
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
/*             <li>Approve Request Pengubahan Data Canine</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <h4>Approve Request Pengubahan Data Canine</h4>*/
/*         </div>*/
/*         <div class="block-content table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*             <table class="table table-borderless table-striped data-requests">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="1%">Foto</th>*/
/*                         <th>Tanggal Request</th>*/
/*                         <th>AS</th>*/
/*                         <th>Kennel</th>*/
/*                         <th>Alamat</th>*/
/*                         <th>Pemilik</th>*/
/*                         <th>Approver</th>*/
/*                         <th>Tanggal Approve</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
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
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/requests.js"></script>*/
/* {% endblock %}*/
/* */
