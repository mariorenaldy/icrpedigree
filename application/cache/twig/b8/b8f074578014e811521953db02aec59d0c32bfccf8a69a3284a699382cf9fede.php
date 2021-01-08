<?php

/* backend/family.twig */
class __TwigTemplate_e12a89a4ad15947282b9f078094e944d9cc86c9f2117bd89a805cbc48e3f8844 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/family.twig", 2);
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
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">
<link href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css\" rel=\"stylesheet\" />

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
    #imgPreview, #imgPreview-update{
        /*border-radius:50%;*/
        margin-bottom: 15px;
    }

</style>
";
    }

    // line 38
    public function block_body($context, array $blocks = array())
    {
        // line 39
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
            <h4>Keluarga</h4>
        </div>
        <div class=\"block-content \">
            <div class=\"table-responsive\">
            <table class=\"table table-borderless table-striped data-family\">
                <thead>
                    <tr>
                        <th>Pasangan</th>
                        <th>Anak</th>
                        <th>DOB Anak</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 66
        if ((isset($context["canines"]) ? $context["canines"] : null)) {
            // line 67
            echo "                        ";
            $context["spouse"] = "";
            // line 68
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["canines"]) ? $context["canines"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 69
                echo "                        <tr>
                            ";
                // line 70
                if (((isset($context["spouse"]) ? $context["spouse"] : null) != $this->getAttribute($context["row"], "spouse", array()))) {
                    // line 71
                    echo "                                <td>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "spouse", array()), "html", null, true);
                    echo "</td>
                                ";
                    // line 72
                    $context["spouse"] = $this->getAttribute($context["row"], "spouse", array());
                    // line 73
                    echo "                            ";
                } else {
                    // line 74
                    echo "                                <td></td>
                            ";
                }
                // line 76
                echo "                            <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "sibling", array()), "html", null, true);
                echo "</td>
                            <td>";
                // line 77
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "dob", array()), "html", null, true);
                echo "</td>
                        </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 80
            echo "                    ";
        }
        // line 81
        echo "                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<input type=\"hidden\" value=\"";
        // line 87
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />

";
    }

    // line 91
    public function block_scripts($context, array $blocks = array())
    {
        // line 92
        echo "<!-- Page JS Plugins -->

<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js\"></script>

<script src=\"";
        // line 97
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 98
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 99
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 100
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 101
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 102
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 103
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->

<input type=\"hidden\" value=\"";
        // line 106
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    public function getTemplateName()
    {
        return "backend/family.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 106,  213 => 103,  209 => 102,  205 => 101,  201 => 100,  197 => 99,  193 => 98,  189 => 97,  182 => 92,  179 => 91,  172 => 87,  164 => 81,  161 => 80,  152 => 77,  147 => 76,  143 => 74,  140 => 73,  138 => 72,  133 => 71,  131 => 70,  128 => 69,  123 => 68,  120 => 67,  118 => 66,  89 => 39,  86 => 38,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* {# By: ARTechnology #}*/
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <!-- <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/style.css"> -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />*/
/* */
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
/*     #imgPreview, #imgPreview-update{*/
/*         /*border-radius:50%;*//* */
/*         margin-bottom: 15px;*/
/*     }*/
/* */
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
/*             <h4>Keluarga</h4>*/
/*         </div>*/
/*         <div class="block-content ">*/
/*             <div class="table-responsive">*/
/*             <table class="table table-borderless table-striped data-family">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th>Pasangan</th>*/
/*                         <th>Anak</th>*/
/*                         <th>DOB Anak</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                     {% if canines %}*/
/*                         {% set spouse = "" %}*/
/*                         {% for row in canines %}*/
/*                         <tr>*/
/*                             {% if spouse != row.spouse %}*/
/*                                 <td>{{ row.spouse }}</td>*/
/*                                 {% set spouse = row.spouse %}*/
/*                             {% else %}*/
/*                                 <td></td>*/
/*                             {% endif %}*/
/*                             <td>{{ row.sibling }}</td>*/
/*                             <td>{{ row.dob }}</td>*/
/*                         </tr>*/
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
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>*/
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>*/
/* */
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
