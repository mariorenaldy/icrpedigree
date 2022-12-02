<?php

/* backend/setting.twig */
class __TwigTemplate_ee80c615c15452401cef7f2d21eda882b0a16fc5f65a86cb3302ea1f2dca0eb7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/setting.twig", 1);
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
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.css\" >
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/css/bootstrap-editable.css\" >

";
    }

    // line 13
    public function block_body($context, array $blocks = array())
    {
        // line 14
        echo "<div class=\"content wrap-breadcrum\" style=\"margin-top:-10px\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 17
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"link-effect\">Dashboard</a></li>
            <li>Pengaturan</li>
        </ol>
    </div>
</div>

<!-- Main Container -->
<div class=\"content content-boxed\">
    <div class=\"row\">
        <div class=\"col-md-12\">
          <div class=\"block\">
            <div class=\"block-content block-content-full\" style=\"text-align:justify !important;\">

            <div class=\"row\">
                <div class=\"col-md-8 col-md-offset-2\">
                   <table class=\"table\">
                      <tr>
                        <th colspan=\"3\">
                            <center>
                                Pengaturan
                            </center>
                        </th>
                      </tr>
                        <tr>
                            <td width=\"20%\">Harga Sertifikat</td>
                            <td width=\"1\">:</td>
                            <td>RP &nbsp;
                              <a id=\"set_certificate_price\" href=\"#\" data-type=\"number\" data-pk=\"1\" data-title=\"Nama Perusahaan\" class=\"editable editable-click\">";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_certificate_price", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>

                        <tr>
                            <td width=\"20%\">Poin Juara 1</td>
                            <td width=\"1% \">:</td>
                            <td>
                              <a id=\"set_first_champion_score\" href=\"#\" data-type=\"number\" data-pk=\"1\" data-title=\"Nama Perusahaan\" class=\"editable editable-click\">";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_first_champion_score", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>

                        <tr>
                            <td width=\"20%\">Poin Juara 2</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"set_second_champion_score\" href=\"#\" data-type=\"number\" data-pk=\"1\" data-title=\"Nama Perusahaan\" class=\"editable editable-click\">";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_second_champion_score", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>

                        <tr>
                            <td width=\"20%\">Poin Juara 3</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"set_third_champion_score\" href=\"#\" data-type=\"number\" data-pk=\"1\" data-title=\"Nama Perusahaan\" class=\"editable editable-click\">";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_third_champion_score", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>

                        <tr>
                            <td width=\"20%\">Term & Condition</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"set_tc\" href=\"#\" data-type=\"textarea\" data-pk=\"1\" data-title=\"Term & Condition\" class=\"editable editable-click\">";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_tc", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>

                        <!-- <tr>
                            <td>Status</td>
                            <td>:</td>
                            ";
        // line 84
        echo "                        </tr> -->

                    </table>
                </div>

            </div>
            </div></div>
        </div>
    </div>

</div>

<input type=\"hidden\" value=\"";
        // line 96
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"";
        // line 97
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_id", array()), "html", null, true);
        echo "\" class=\"studentId\" />
";
    }

    // line 100
    public function block_scripts($context, array $blocks = array())
    {
        // line 101
        echo "<script src=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 102
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 103
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 104
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 105
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 106
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<!-- Page JS Code -->
<script src=\"";
        // line 108
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 109
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js\"></script>
<script src=\"";
        // line 110
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/base_forms_wizard.js\"></script>
<script src=\"";
        // line 111
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.min.js\"></script>
<!-- <script src=\"";
        // line 112
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/set_password.js\"></script> -->

<script src=\"";
        // line 114
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/bootstrap-editable.js\"></script>
<script src=\"";
        // line 115
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/adm_setting.js\"></script>

";
    }

    public function getTemplateName()
    {
        return "backend/setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 115,  227 => 114,  222 => 112,  218 => 111,  214 => 110,  210 => 109,  206 => 108,  201 => 106,  197 => 105,  193 => 104,  189 => 103,  185 => 102,  180 => 101,  177 => 100,  171 => 97,  167 => 96,  153 => 84,  143 => 76,  132 => 68,  121 => 60,  110 => 52,  99 => 44,  69 => 17,  64 => 14,  61 => 13,  54 => 9,  50 => 8,  46 => 7,  42 => 6,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{base_url()}}assets/sweetalert/dist/sweetalert.css" >*/
/* <link rel="stylesheet" href="{{base_url()}}assets/oneui/css/bootstrap-editable.css" >*/
/* */
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrum" style="margin-top:-10px">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="{{base_url()}}" class="link-effect">Dashboard</a></li>*/
/*             <li>Pengaturan</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* */
/* <!-- Main Container -->*/
/* <div class="content content-boxed">*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*           <div class="block">*/
/*             <div class="block-content block-content-full" style="text-align:justify !important;">*/
/* */
/*             <div class="row">*/
/*                 <div class="col-md-8 col-md-offset-2">*/
/*                    <table class="table">*/
/*                       <tr>*/
/*                         <th colspan="3">*/
/*                             <center>*/
/*                                 Pengaturan*/
/*                             </center>*/
/*                         </th>*/
/*                       </tr>*/
/*                         <tr>*/
/*                             <td width="20%">Harga Sertifikat</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>RP &nbsp;*/
/*                               <a id="set_certificate_price" href="#" data-type="number" data-pk="1" data-title="Nama Perusahaan" class="editable editable-click">{{setting.set_certificate_price}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="20%">Poin Juara 1</td>*/
/*                             <td width="1% ">:</td>*/
/*                             <td>*/
/*                               <a id="set_first_champion_score" href="#" data-type="number" data-pk="1" data-title="Nama Perusahaan" class="editable editable-click">{{setting.set_first_champion_score}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="20%">Poin Juara 2</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="set_second_champion_score" href="#" data-type="number" data-pk="1" data-title="Nama Perusahaan" class="editable editable-click">{{setting.set_second_champion_score}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="20%">Poin Juara 3</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="set_third_champion_score" href="#" data-type="number" data-pk="1" data-title="Nama Perusahaan" class="editable editable-click">{{setting.set_third_champion_score}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="20%">Term & Condition</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="set_tc" href="#" data-type="textarea" data-pk="1" data-title="Term & Condition" class="editable editable-click">{{setting.set_tc}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <!-- <tr>*/
/*                             <td>Status</td>*/
/*                             <td>:</td>*/
/*                             {# <td>{{setting.set_status}}</td> #}*/
/*                         </tr> -->*/
/* */
/*                     </table>*/
/*                 </div>*/
/* */
/*             </div>*/
/*             </div></div>*/
/*         </div>*/
/*     </div>*/
/* */
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="{{setting.set_id}}" class="studentId" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/pages/base_forms_wizard.js"></script>*/
/* <script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>*/
/* <!-- <script src="{{ base_url() }}assets/oneui/js/pages/set_password.js"></script> -->*/
/* */
/* <script src="{{ base_url() }}assets/oneui/js/bootstrap-editable.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/pages/adm_setting.js"></script>*/
/* */
/* {% endblock %}*/
/* */
