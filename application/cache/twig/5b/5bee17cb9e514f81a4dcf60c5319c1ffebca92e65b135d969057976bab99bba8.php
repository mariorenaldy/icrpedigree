<?php

/* front/requests.twig */
class __TwigTemplate_6a6207faab9773f49061dce19aa59e54d07e6d7eb295bcc93a13fdf28adf715f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/requests.twig", 2);
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

<style>
    .bg-info{
        background-color: #000000 !important;
    }
    #imgPreview, #imgPreview-update{
        margin-bottom: 15px;
    }
    th{
        color: white !important;
    }
</style>
";
    }

    // line 21
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 23
    public function block_header($context, array $blocks = array())
    {
        // line 24
        echo "
";
    }

    // line 27
    public function block_content($context, array $blocks = array())
    {
        // line 28
        echo "<!-- Page Content -->

<section class=\"hero-banner bg-info\">
    <div class=\"container\">
        <div class=\"row text-center\">
            <h3 class=\"text-white-1\">List Request Pengubahan Data ";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["reqs"]) ? $context["reqs"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
        echo "</h3>
            <br/>
        </div>
        <div class=\"block-content table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
            <table class=\"table table-borderless\">
                <thead>
                    <tr>
                        <th width=\"1%\">Foto</th>
                        <th>Tanggal Request</th>
                        <th>Kennel</th>
                        <th>Alamat</th>
                        <th>Pemilik</th>
                        <th>Status</th>
                        <th>Approver</th>
                        <th>Tanggal Approve</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["reqs"]) ? $context["reqs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 53
            echo "                        <tr>
                            ";
            // line 54
            if (($this->getAttribute($context["row"], "req_can_photo", array()) == "-")) {
                // line 55
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            } else {
                // line 57
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "req_can_photo", array()), "html", null, true);
                echo "\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            }
            // line 59
            echo "                            <td class=\"text-white-1\">";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "req_date", array()), "d-m-Y"), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "req_can_cage", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "req_can_address", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "req_can_owner", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stat_name", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "use_username", array()), "html", null, true);
            echo "</td>
                            ";
            // line 65
            if ($this->getAttribute($context["row"], "req_app_date", array())) {
                // line 66
                echo "                                <td class=\"text-white-1\">";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "req_app_date", array()), "d-m-Y"), "html", null, true);
                echo "</td>
                            ";
            } else {
                // line 68
                echo "                                <td class=\"text-white-1\"></td>
                            ";
            }
            // line 70
            echo "                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "                </tbody>
            </table>
        </div>
    </div>
</section>
<input type=\"hidden\" value=\"";
        // line 77
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    // line 80
    public function block_scripts($context, array $blocks = array())
    {
        // line 81
        echo "<!-- Page JS Plugins -->
<!-- Page JS Code -->

";
    }

    public function getTemplateName()
    {
        return "front/requests.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  185 => 81,  182 => 80,  176 => 77,  169 => 72,  162 => 70,  158 => 68,  152 => 66,  150 => 65,  146 => 64,  142 => 63,  138 => 62,  134 => 61,  130 => 60,  125 => 59,  117 => 57,  111 => 55,  109 => 54,  106 => 53,  102 => 52,  80 => 33,  73 => 28,  70 => 27,  65 => 24,  62 => 23,  56 => 21,  38 => 6,  35 => 5,  32 => 4,  11 => 2,);
    }
}
/* {# By: ARTechnology #}*/
/* {% extends "template/frontend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* */
/* <style>*/
/*     .bg-info{*/
/*         background-color: #000000 !important;*/
/*     }*/
/*     #imgPreview, #imgPreview-update{*/
/*         margin-bottom: 15px;*/
/*     }*/
/*     th{*/
/*         color: white !important;*/
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
/*             <h3 class="text-white-1">List Request Pengubahan Data {{reqs[0].can_a_s}}</h3>*/
/*             <br/>*/
/*         </div>*/
/*         <div class="block-content table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*             <table class="table table-borderless">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="1%">Foto</th>*/
/*                         <th>Tanggal Request</th>*/
/*                         <th>Kennel</th>*/
/*                         <th>Alamat</th>*/
/*                         <th>Pemilik</th>*/
/*                         <th>Status</th>*/
/*                         <th>Approver</th>*/
/*                         <th>Tanggal Approve</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                     {% for row in reqs %}*/
/*                         <tr>*/
/*                             {% if row.req_can_photo == '-' %}*/
/*                                 <td><img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% else %}*/
/*                                 <td><img src="{{base_url()}}uploads/canine/{{row.req_can_photo}}" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% endif %}*/
/*                             <td class="text-white-1">{{row.req_date|date("d-m-Y")}}</td>*/
/*                             <td class="text-white-1">{{row.req_can_cage}}</td>*/
/*                             <td class="text-white-1">{{row.req_can_address}}</td>*/
/*                             <td class="text-white-1">{{row.req_can_owner}}</td>*/
/*                             <td class="text-white-1">{{row.stat_name}}</td>*/
/*                             <td class="text-white-1">{{row.use_username}}</td>*/
/*                             {% if row.req_app_date %}*/
/*                                 <td class="text-white-1">{{row.req_app_date|date("d-m-Y")}}</td>*/
/*                             {% else %}*/
/*                                 <td class="text-white-1"></td>*/
/*                             {% endif %}*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                 </tbody>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <!-- Page JS Code -->*/
/* */
/* {% endblock %}*/
