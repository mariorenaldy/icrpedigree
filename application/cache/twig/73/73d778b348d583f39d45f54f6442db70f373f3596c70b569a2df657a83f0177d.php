<?php

/* backend/service.twig */
class __TwigTemplate_4f38abdbf6dc5a576a36824d5537782c383365584f3f0ee73ba93965f39a2242 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/service.twig", 2);
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
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">


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

    // line 35
    public function block_body($context, array $blocks = array())
    {
        // line 36
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li>Layanan</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
<div class=\"block\">
    <div class=\"block-header\">
        <h3 class=\"block-title text-center\">Layanan</h3>
    </div>
    <div class=\"block-content\">
      <form class=\"form-horizontal push-30-t push-30\" action=\"";
        // line 53
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/services/update/";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["service"]) ? $context["service"] : null), "ser_id", array()), "html", null, true);
        echo "\" method=\"post\" >
          <div class=\"form-group\">
              <div class=\"col-xs-10 col-md-offset-1 push-10\">
                  <!-- CKEditor Container -->
                  <label for=\"\">Deskripsi Layanan</label>
                  <textarea name=\"ser_desc\" class=\"form-control\" id=\"content1\" rows=\"8\" cols=\"80\">";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["service"]) ? $context["service"] : null), "ser_desc", array()), "html", null, true);
        echo "</textarea>
              </div>
          </div>
          <div class=\"form-group\">
              <div class=\"col-xs-10 col-md-offset-1 push-10\">
                  <!-- CKEditor Container -->
                  <label for=\"\">Aturan (Dalam Bahasa Indonesia)</label>
                  <textarea id=\"content2\" class=\"form-control\" name=\"rule_ind\" >";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["service"]) ? $context["service"] : null), "ser_reg_rule_ind", array()), "html", null, true);
        echo "</textarea>
              </div>
          </div>
          <div class=\"form-group\">
              <div class=\"col-xs-10 col-md-offset-1 push-10\">
                  <!-- CKEditor Container -->
                  <label for=\"\">Aturan (Dalam Bahasa Ingris)</label>
                  <textarea id=\"content3\" class=\"form-control\" name=\"rule_eng\" >";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["service"]) ? $context["service"] : null), "ser_reg_rule_eng", array()), "html", null, true);
        echo "</textarea>
              </div>
          </div>
           <div class=\"form-group\">
              <div class=\"col-xs-10 col-md-offset-1\">
                  <button class=\"btn btn-sm btn-success pull-right\" type=\"submit\"><i class=\"fa fa-save\" ></i> Simpan Perubahan</button>
              </div>
          </div>
      </form>

    </div>
</div>



</div>

";
    }

    // line 91
    public function block_scripts($context, array $blocks = array())
    {
        // line 92
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 93
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 94
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 95
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 96
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 97
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 98
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 99
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- <script src=\"";
        // line 100
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/ckeditor/ckeditor.js\"></script> -->
<!-- Page JS Code -->

<input type=\"hidden\" value=\"";
        // line 103
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 104
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_service.js\"></script>
<script>
    jQuery(function () {
      \$('#content1, #content2, #content3').summernote({
        height: 100,
        minHeight: null,
        maxHeight: null,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          // ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          // ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          // ['height', ['height']]
        ]
      });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "backend/service.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 104,  191 => 103,  185 => 100,  181 => 99,  177 => 98,  173 => 97,  169 => 96,  165 => 95,  161 => 94,  157 => 93,  154 => 92,  151 => 91,  129 => 72,  119 => 65,  109 => 58,  99 => 53,  80 => 36,  77 => 35,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* */
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* */
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
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Layanan</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/* <div class="block">*/
/*     <div class="block-header">*/
/*         <h3 class="block-title text-center">Layanan</h3>*/
/*     </div>*/
/*     <div class="block-content">*/
/*       <form class="form-horizontal push-30-t push-30" action="{{base_url()}}backend/services/update/{{service.ser_id}}" method="post" >*/
/*           <div class="form-group">*/
/*               <div class="col-xs-10 col-md-offset-1 push-10">*/
/*                   <!-- CKEditor Container -->*/
/*                   <label for="">Deskripsi Layanan</label>*/
/*                   <textarea name="ser_desc" class="form-control" id="content1" rows="8" cols="80">{{service.ser_desc}}</textarea>*/
/*               </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*               <div class="col-xs-10 col-md-offset-1 push-10">*/
/*                   <!-- CKEditor Container -->*/
/*                   <label for="">Aturan (Dalam Bahasa Indonesia)</label>*/
/*                   <textarea id="content2" class="form-control" name="rule_ind" >{{service.ser_reg_rule_ind}}</textarea>*/
/*               </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*               <div class="col-xs-10 col-md-offset-1 push-10">*/
/*                   <!-- CKEditor Container -->*/
/*                   <label for="">Aturan (Dalam Bahasa Ingris)</label>*/
/*                   <textarea id="content3" class="form-control" name="rule_eng" >{{service.ser_reg_rule_eng}}</textarea>*/
/*               </div>*/
/*           </div>*/
/*            <div class="form-group">*/
/*               <div class="col-xs-10 col-md-offset-1">*/
/*                   <button class="btn btn-sm btn-success pull-right" type="submit"><i class="fa fa-save" ></i> Simpan Perubahan</button>*/
/*               </div>*/
/*           </div>*/
/*       </form>*/
/* */
/*     </div>*/
/* </div>*/
/* */
/* */
/* */
/* </div>*/
/* */
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
/* <!-- <script src="{{ base_url() }}/assets/oneui/js/plugins/ckeditor/ckeditor.js"></script> -->*/
/* <!-- Page JS Code -->*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_service.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*       $('#content1, #content2, #content3').summernote({*/
/*         height: 100,*/
/*         minHeight: null,*/
/*         maxHeight: null,*/
/*         toolbar: [*/
/*           // [groupName, [list of button]]*/
/*           ['style', ['bold', 'italic', 'underline', 'clear']],*/
/*           // ['font', ['strikethrough', 'superscript', 'subscript']],*/
/*           ['fontsize', ['fontsize']],*/
/*           // ['color', ['color']],*/
/*           ['para', ['ul', 'ol', 'paragraph']],*/
/*           // ['height', ['height']]*/
/*         ]*/
/*       });*/
/*     });*/
/* </script>*/
/* {% endblock %}*/
/* */
