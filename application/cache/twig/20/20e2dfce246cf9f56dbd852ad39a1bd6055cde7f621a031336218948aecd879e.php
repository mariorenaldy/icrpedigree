<?php

/* front/add_member.twig */
class __TwigTemplate_92cfe9de9795b1648981ed9e01be0c27784995af037e2b33006d00136029db32 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/add_member.twig", 2);
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
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<link href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/css/style.css\" rel=\"stylesheet\" type=\"text/css\" />

<style>
    .bg-info{
        background-color: #000000 !important;
    }
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

    // line 36
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 38
    public function block_header($context, array $blocks = array())
    {
        // line 39
        echo "
";
    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
        // line 43
        echo "<!-- Page Content -->

<section class=\"hero-banner bg-info\">
    <div class=\"container\">
        <div class=\"row text-center\">
            <h3 class=\"text-white-1\">Sign Up</h3>
            <br/>
        </div>
        <div class=\"row\">
            <form action=\"";
        // line 52
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "signup/add\" class=\"form-add-member form-horizontal\" method=\"post\">
                <div class=\"form-group\">
                    <div class=\"col-xs-2 col-xs-offset-5\">
                        <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 55
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                        <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                            <span>Upload KTP</span>
                            <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\"/>
                            <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\"/>
                        </div>
                        <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                    </div>
                </div>
                <br/>
                <div class=\"col-md-6\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" or=\"name-add-member\">Nama Member</label>
                            <input class=\"form-control\" id=\"name-add-member\" name=\"mem_name\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" for=\"address-add-member\">Alamat Member</label>
                            <input class=\"form-control\" id=\"address-add-member\" name=\"mem_address\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" for=\"mail-address-add-member\">Alamat Surat Member</label>
                            <input class=\"form-control\" id=\"mail-address-add-member\" name=\"mem_mail_address\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" for=\"hp-add-member\">No. Telp</label>
                            <input class=\"form-control\" id=\"hp-add-member\" name=\"mem_hp\" type=\"text\" required>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" for=\"username-add-user\">Username</label>
                            <input class=\"form-control\" id=\"username-add-user\" name=\"mem_username\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" for=\"password-add-member\">Kata Sandi</label>
                            <input class=\"form-control\" id=\"password-add-member\" name=\"password\" type=\"password\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label class=\"text-white-1\" for=\"repass-add-member\">Konfirmasi Kata Sandi</label>
                            <input class=\"form-control\" id=\"repass-add-member\" name=\"repass\" type=\"password\" required>
                        </div>
                    </div>
                </div>
                <br/>
                <div class=\"col-xs-12 text-center\">
                    <button type=\"submit\" class=\"btn btn-primary submit-add-member\">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- modals -->
<div class=\"modal fade\" id=\"cropper-modal\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" >
  <div class=\"modal-dialog modal-dialog-popout modal-dialog-top\">
    <div class=\"modal-content\">
        <div class=\"block block-themed block-transparent remove-margin-b\">
            <div class=\"block-header bg-primary-dark\">
                <ul class=\"block-options\">
                    <li>
                        <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                    </li>
                </ul>
                <h3 class=\"block-title\">Image Cropper</h3>
            </div>
            <div class=\"block-content\">
                <div id=\"cropper-wrap-img\">
                    <img width=\"100%\" src=\"/img/default.png\" alt=\"Picture\">
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default pull-left\">Close</button>
            <button type=\"button\" class=\"btn btn-primary btn-crop\">Crop</button>
        </div>
    </div>
  </div>
</div>
";
    }

    // line 147
    public function block_scripts($context, array $blocks = array())
    {
        // line 148
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 149
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 150
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 151
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 153
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 154
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/add_member.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "front/add_member.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 154,  225 => 153,  220 => 151,  216 => 150,  212 => 149,  209 => 148,  206 => 147,  111 => 55,  105 => 52,  94 => 43,  91 => 42,  86 => 39,  83 => 38,  77 => 36,  46 => 8,  42 => 7,  38 => 6,  35 => 5,  32 => 4,  11 => 2,);
    }
}
/* {# ARTechnology #}*/
/* {% extends "template/frontend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* */
/* <style>*/
/*     .bg-info{*/
/*         background-color: #000000 !important;*/
/*     }*/
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
/*             <h3 class="text-white-1">Sign Up</h3>*/
/*             <br/>*/
/*         </div>*/
/*         <div class="row">*/
/*             <form action="{{base_url()}}signup/add" class="form-add-member form-horizontal" method="post">*/
/*                 <div class="form-group">*/
/*                     <div class="col-xs-2 col-xs-offset-5">*/
/*                         <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                         <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                             <span>Upload KTP</span>*/
/*                             <input type="file" class="upload" name="photo" id="imageInput"/>*/
/*                             <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update"/>*/
/*                         </div>*/
/*                         <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                     </div>*/
/*                 </div>*/
/*                 <br/>*/
/*                 <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" or="name-add-member">Nama Member</label>*/
/*                             <input class="form-control" id="name-add-member" name="mem_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" for="address-add-member">Alamat Member</label>*/
/*                             <input class="form-control" id="address-add-member" name="mem_address" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" for="mail-address-add-member">Alamat Surat Member</label>*/
/*                             <input class="form-control" id="mail-address-add-member" name="mem_mail_address" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" for="hp-add-member">No. Telp</label>*/
/*                             <input class="form-control" id="hp-add-member" name="mem_hp" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" for="username-add-user">Username</label>*/
/*                             <input class="form-control" id="username-add-user" name="mem_username" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" for="password-add-member">Kata Sandi</label>*/
/*                             <input class="form-control" id="password-add-member" name="password" type="password" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label class="text-white-1" for="repass-add-member">Konfirmasi Kata Sandi</label>*/
/*                             <input class="form-control" id="repass-add-member" name="repass" type="password" required>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <br/>*/
/*                 <div class="col-xs-12 text-center">*/
/*                     <button type="submit" class="btn btn-primary submit-add-member">Simpan</button>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="cropper-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" >*/
/*   <div class="modal-dialog modal-dialog-popout modal-dialog-top">*/
/*     <div class="modal-content">*/
/*         <div class="block block-themed block-transparent remove-margin-b">*/
/*             <div class="block-header bg-primary-dark">*/
/*                 <ul class="block-options">*/
/*                     <li>*/
/*                         <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                     </li>*/
/*                 </ul>*/
/*                 <h3 class="block-title">Image Cropper</h3>*/
/*             </div>*/
/*             <div class="block-content">*/
/*                 <div id="cropper-wrap-img">*/
/*                     <img width="100%" src="/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class="modal-footer">*/
/*             <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*             <button type="button" class="btn btn-primary btn-crop">Crop</button>*/
/*         </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/add_member.js"></script>*/
/* {% endblock %}*/
/* */
