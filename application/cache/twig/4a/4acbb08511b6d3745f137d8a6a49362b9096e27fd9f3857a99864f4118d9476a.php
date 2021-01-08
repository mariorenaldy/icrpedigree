<?php

/* backend/contacts.twig */
class __TwigTemplate_29e0a49a84b6ea726b9465942f2e19d52258f7dc7ba166968ab4725f54b1fb6e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/contacts.twig", 1);
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

    .fileUpload input.uploadBG {
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
        /*margin-bottom: 15px;*/
    }
</style>
";
    }

    // line 46
    public function block_body($context, array $blocks = array())
    {
        // line 47
        echo "<div class=\"content wrap-breadcrum\" style=\"margin-top:-10px\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 50
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"link-effect\">Dashboard</a></li>
            <li>Kontak dan Pengalaman</li>
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
            <div class=\"col-md-1\"></div>
                <div class=\"col-md-10\">
                   <table class=\"table\">
                      <tr>
                        <th colspan=\"3\">
                            <center>
                                Kontak dan Pengalamatan
                            </center>
                        </th>
                      </tr>
                        <tr>
                          <th colspan=\"3\">
                            Pengalamatan
                          </th>
                        </tr>

                        <tr>
                            <td width=\"30%\">Alamat Perusahaan</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"con_address\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"alamat Perusahaan\" class=\"editable editable-click\">";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_address", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>
                        <tr>
                            <td width=\"30%\">Waktu Buka dan Tutup</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"con_open_time\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"Jam Buka\" class=\"editable editable-click\">";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_open_time", array()), "html", null, true);
        echo "</a> &nbsp;<b><small> dan </small></b>&nbsp;   <a id=\"con_close_time\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"Jam Buka\" class=\"editable editable-click\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_close_time", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>
                        <tr>
                          <th colspan=\"3\">
                            Kontak dan Sosial Media
                          </th>
                        </tr>

                        <tr>
                            <td width=\"30%\">Nomor Telpon</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"con_phone_number\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"Number telphone Perusahaan\" class=\"editable editable-click\">";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_phone_number", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>
                        <tr>
                            <td width=\"30%\">Facebook</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"con_facebook\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"Number telphone Perusahaan\" class=\"editable editable-click\">";
        // line 111
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_facebook", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>
                        <tr>
                            <td width=\"30%\">Twitter</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"con_twitter\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"twitter\" class=\"editable editable-click\">";
        // line 118
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_twitter", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>

                        <tr>
                            <td width=\"30%\">Instagram</td>
                            <td width=\"1\">:</td>
                            <td>
                              <a id=\"con_instagram\" href=\"#\" data-type=\"text\" data-pk=\"1\" data-title=\"Instagram\" class=\"editable editable-click\">";
        // line 126
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_instagram", array()), "html", null, true);
        echo "</a>
                            </td>
                        </tr>


                    </table>
                </div>
                <div class=\"col-md-1\"></div>
            </div>
            </div></div>
        </div>
    </div>

</div>

<input type=\"hidden\" value=\"";
        // line 141
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"";
        // line 142
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_id", array()), "html", null, true);
        echo "\" class=\"conId\" />
";
    }

    // line 145
    public function block_scripts($context, array $blocks = array())
    {
        // line 146
        echo "
<script src=\"";
        // line 147
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 148
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 149
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 150
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 151
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 152
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<!-- Page JS Code -->
<script src=\"";
        // line 154
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 155
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js\"></script>
<script src=\"";
        // line 156
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/base_forms_wizard.js\"></script>
<script src=\"";
        // line 157
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.min.js\"></script>
<!-- <script src=\"";
        // line 158
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/prof_password.js\"></script> -->

<script src=\"";
        // line 160
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/bootstrap-editable.js\"></script>
<script src=\"";
        // line 161
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/adm_contact.js\"></script>
<script>
    jQuery(function () {
        \$('#birthdate-add-student').datetimepicker({
            format: 'YYYY-MM-DD',
            showTodayButton: true,
            showClose: true,
            icons: {
                time: 'si si-clock',
                date: 'si si-calendar',
                up: 'si si-arrow-up',
                down: 'si si-arrow-down',
                previous: 'si si-arrow-left',
                next: 'si si-arrow-right',
                today: 'si si-size-actual',
                clear: 'si si-trash',
                close: 'si si-close'
            }
        });
        \$('#birthdate-update-student').datetimepicker({
            format: 'YYYY-MM-DD',
            showTodayButton: true,
            showClose: true,
            icons: {
                time: 'si si-clock',
                date: 'si si-calendar',
                up: 'si si-arrow-up',
                down: 'si si-arrow-down',
                previous: 'si si-arrow-left',
                next: 'si si-arrow-right',
                today: 'si si-size-actual',
                clear: 'si si-trash',
                close: 'si si-close'
            }
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "backend/contacts.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  282 => 161,  278 => 160,  273 => 158,  269 => 157,  265 => 156,  261 => 155,  257 => 154,  252 => 152,  248 => 151,  244 => 150,  240 => 149,  236 => 148,  232 => 147,  229 => 146,  226 => 145,  220 => 142,  216 => 141,  198 => 126,  187 => 118,  177 => 111,  167 => 104,  149 => 91,  139 => 84,  102 => 50,  97 => 47,  94 => 46,  54 => 9,  50 => 8,  46 => 7,  42 => 6,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
/* */
/*     .fileUpload input.uploadBG {*/
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
/* */
/*     #imgPreview, #imgPreview-update{*/
/*         /*border-radius:50%;*//* */
/*         /*margin-bottom: 15px;*//* */
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrum" style="margin-top:-10px">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="{{base_url()}}" class="link-effect">Dashboard</a></li>*/
/*             <li>Kontak dan Pengalaman</li>*/
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
/*             <div class="col-md-1"></div>*/
/*                 <div class="col-md-10">*/
/*                    <table class="table">*/
/*                       <tr>*/
/*                         <th colspan="3">*/
/*                             <center>*/
/*                                 Kontak dan Pengalamatan*/
/*                             </center>*/
/*                         </th>*/
/*                       </tr>*/
/*                         <tr>*/
/*                           <th colspan="3">*/
/*                             Pengalamatan*/
/*                           </th>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="30%">Alamat Perusahaan</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="con_address" href="#" data-type="text" data-pk="1" data-title="alamat Perusahaan" class="editable editable-click">{{contact.con_address}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td width="30%">Waktu Buka dan Tutup</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="con_open_time" href="#" data-type="text" data-pk="1" data-title="Jam Buka" class="editable editable-click">{{contact.con_open_time}}</a> &nbsp;<b><small> dan </small></b>&nbsp;   <a id="con_close_time" href="#" data-type="text" data-pk="1" data-title="Jam Buka" class="editable editable-click">{{contact.con_close_time}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                           <th colspan="3">*/
/*                             Kontak dan Sosial Media*/
/*                           </th>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="30%">Nomor Telpon</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="con_phone_number" href="#" data-type="text" data-pk="1" data-title="Number telphone Perusahaan" class="editable editable-click">{{contact.con_phone_number}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td width="30%">Facebook</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="con_facebook" href="#" data-type="text" data-pk="1" data-title="Number telphone Perusahaan" class="editable editable-click">{{contact.con_facebook}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td width="30%">Twitter</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="con_twitter" href="#" data-type="text" data-pk="1" data-title="twitter" class="editable editable-click">{{contact.con_twitter}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/*                         <tr>*/
/*                             <td width="30%">Instagram</td>*/
/*                             <td width="1">:</td>*/
/*                             <td>*/
/*                               <a id="con_instagram" href="#" data-type="text" data-pk="1" data-title="Instagram" class="editable editable-click">{{contact.con_instagram}}</a>*/
/*                             </td>*/
/*                         </tr>*/
/* */
/* */
/*                     </table>*/
/*                 </div>*/
/*                 <div class="col-md-1"></div>*/
/*             </div>*/
/*             </div></div>*/
/*         </div>*/
/*     </div>*/
/* */
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="{{contact.con_id}}" class="conId" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* */
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
/* <!-- <script src="{{ base_url() }}assets/oneui/js/pages/prof_password.js"></script> -->*/
/* */
/* <script src="{{ base_url() }}assets/oneui/js/bootstrap-editable.js"></script>*/
/* <script src="{{ base_url() }}assets/oneui/js/pages/adm_contact.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*         $('#birthdate-add-student').datetimepicker({*/
/*             format: 'YYYY-MM-DD',*/
/*             showTodayButton: true,*/
/*             showClose: true,*/
/*             icons: {*/
/*                 time: 'si si-clock',*/
/*                 date: 'si si-calendar',*/
/*                 up: 'si si-arrow-up',*/
/*                 down: 'si si-arrow-down',*/
/*                 previous: 'si si-arrow-left',*/
/*                 next: 'si si-arrow-right',*/
/*                 today: 'si si-size-actual',*/
/*                 clear: 'si si-trash',*/
/*                 close: 'si si-close'*/
/*             }*/
/*         });*/
/*         $('#birthdate-update-student').datetimepicker({*/
/*             format: 'YYYY-MM-DD',*/
/*             showTodayButton: true,*/
/*             showClose: true,*/
/*             icons: {*/
/*                 time: 'si si-clock',*/
/*                 date: 'si si-calendar',*/
/*                 up: 'si si-arrow-up',*/
/*                 down: 'si si-arrow-down',*/
/*                 previous: 'si si-arrow-left',*/
/*                 next: 'si si-arrow-right',*/
/*                 today: 'si si-size-actual',*/
/*                 clear: 'si si-trash',*/
/*                 close: 'si si-close'*/
/*             }*/
/*         });*/
/*     });*/
/* </script>*/
/* {% endblock %}*/
/* */
