<?php

/* backend/logsRequest.twig */
class __TwigTemplate_2c3b0a237a3869543e548e34f1dde8c55d3c383168c8595d4dbdefc8ce7d8baa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/logsRequest.twig", 2);
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
            <li>Request Pengubahan Data Canine</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <h4>Request Pengubahan Data Canine</h4>
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
                        <th>Status</th>
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
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 60
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/logs_request.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/logsRequest.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 60,  103 => 59,  98 => 57,  95 => 56,  92 => 55,  52 => 17,  49 => 16,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
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
/*             <li>Request Pengubahan Data Canine</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <h4>Request Pengubahan Data Canine</h4>*/
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
/*                         <th>Status</th>*/
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
/* <script src="{{ base_url() }}/assets/oneui/js/pages/logs_request.js"></script>*/
/* {% endblock %}*/
/* */
