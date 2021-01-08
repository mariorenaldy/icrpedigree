<?php

/* backend/logsCanines.twig */
class __TwigTemplate_32fad34abda0afa983e459eb306a294d8dfb32a8a8905a5901a2a9d2783c0fc9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/logsCanines.twig", 2);
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
<!-- <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/style.css\"> -->
<link rel=\"stylesheet\" href=\"";
        // line 7
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

    // line 17
    public function block_body($context, array $blocks = array())
    {
        // line 18
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li><a href=\"javascript:history.back()\" class=\"link-effect\">Sebelumnya</a></li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <h4>Logs ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["canines"]) ? $context["canines"] : null), "can_a_s", array()), "html", null, true);
        echo "</h4>
        </div>
        <div class=\"block-content \">
            <div class=\"table-responsive\">
            <table class=\"table table-borderless table-striped data-logs\">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Owner</th>
                        <th>Alamat</th>
                        <th>Kennel</th>
                        <th>Member</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 47
        if ((isset($context["logs"]) ? $context["logs"] : null)) {
            // line 48
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["logs"]) ? $context["logs"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 49
                echo "                            ";
                if (((($this->getAttribute($context["row"], "log_owner", array()) || $this->getAttribute($context["row"], "log_address", array())) || $this->getAttribute($context["row"], "log_cage", array())) || $this->getAttribute($context["row"], "log_member", array()))) {
                    // line 50
                    echo "                                <tr>
                                    <td>";
                    // line 51
                    echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "log_tanggal", array()), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 52
                    echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "log_owner", array()), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 53
                    echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "log_address", array()), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 54
                    echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "log_cage", array()), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 55
                    echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "log_member", array()), "html", null, true);
                    echo "</td>
                                </tr>
                            ";
                }
                // line 58
                echo "                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 59
            echo "                    ";
        }
        // line 60
        echo "                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<input type=\"hidden\" value=\"";
        // line 66
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />

";
    }

    // line 70
    public function block_scripts($context, array $blocks = array())
    {
        // line 71
        echo "<!-- Page JS Plugins -->

<script src=\"";
        // line 73
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<!-- Page JS Code -->

<input type=\"hidden\" value=\"";
        // line 76
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    public function getTemplateName()
    {
        return "backend/logsCanines.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 76,  156 => 73,  152 => 71,  149 => 70,  142 => 66,  134 => 60,  131 => 59,  125 => 58,  119 => 55,  115 => 54,  111 => 53,  107 => 52,  103 => 51,  100 => 50,  97 => 49,  92 => 48,  90 => 47,  72 => 32,  56 => 18,  53 => 17,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* {# By: ARTechnology #}*/
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <!-- <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/style.css"> -->*/
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
/*             <li><a href="javascript:history.back()" class="link-effect">Sebelumnya</a></li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <h4>Logs {{canines.can_a_s}}</h4>*/
/*         </div>*/
/*         <div class="block-content ">*/
/*             <div class="table-responsive">*/
/*             <table class="table table-borderless table-striped data-logs">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th>Tanggal</th>*/
/*                         <th>Owner</th>*/
/*                         <th>Alamat</th>*/
/*                         <th>Kennel</th>*/
/*                         <th>Member</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                     {% if logs %}*/
/*                         {% for row in logs %}*/
/*                             {% if row.log_owner or row.log_address or row.log_cage or row.log_member %}*/
/*                                 <tr>*/
/*                                     <td>{{ row.log_tanggal }}</td>*/
/*                                     <td>{{ row.log_owner }}</td>*/
/*                                     <td>{{ row.log_address }}</td>*/
/*                                     <td>{{ row.log_cage }}</td>*/
/*                                     <td>{{ row.log_member }}</td>*/
/*                                 </tr>*/
/*                             {% endif %}*/
/*                         {% endfor %}*/
/*                     {% endif %}*/
/*                 </tbody>*/
/*             </table>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* */
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
