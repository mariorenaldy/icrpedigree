<?php

/* front/login.twig */
class __TwigTemplate_b3ba1482bdd9340bbd4bba8086a245661dce3c633b0af73feaa97891cec5b93e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/login.twig", 2);
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
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.css\" >

<style>
    .bg-info{
        background-color: #000000 !important;
    }

</style>
";
    }

    // line 19
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 21
    public function block_header($context, array $blocks = array())
    {
        // line 22
        echo "
";
    }

    // line 25
    public function block_content($context, array $blocks = array())
    {
        // line 26
        echo "<!-- Page Content -->

<section class=\"hero-banner bg-info\">
    <div class=\"container\">
      <div class=\"row text-center\">
        <h3 class=\"text-white-1\">Login</h3>
        <hr/>
      </div>
      <div class=\"row col-md-6 col-md-offset-3\">
        <form class=\"form-horizontal form-login\" action=\"";
        // line 35
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "signin/login\" method=\"post\">
          <div class=\"form-group\">
            <label class=\"control-label text-white-1\" for=\"username\">Username</label>
            <input class=\"form-control\" type=\"text\" id=\"username\" name=\"username\" placeholder=\"Masukan username\" required>
          </div>
          <div class=\"form-group\">
              <label class=\"control-label text-white-1\" for=\"password\">Password</label>
              <input class=\"form-control\" type=\"password\" id=\"password\" name=\"password\" placeholder=\"Masukan password\" required minlength=\"3\">
          </div>
          <div class=\"form-group text-center\">
            <button class=\"btn btn-md btn-default\" type=\"submit\"><i class=\"si si-login\"></i> Masuk</button>
              <!-- <a href=\"#\" class=\"h5\" style=\"float:right;margin-top:9px;\">Lupa kata sandi?</a> -->
          </div>
        </form>
      </div>
    </div>
</section>
";
    }

    // line 54
    public function block_scripts($context, array $blocks = array())
    {
        // line 55
        echo "  <!-- Page JS Code -->
  <script src=\"";
        // line 56
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.min.js\"></script>
  <input type=\"hidden\" value=\"";
        // line 57
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
  <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/login_member.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "front/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 58,  123 => 57,  119 => 56,  116 => 55,  113 => 54,  91 => 35,  80 => 26,  77 => 25,  72 => 22,  69 => 21,  63 => 19,  50 => 9,  46 => 8,  42 => 7,  38 => 6,  35 => 5,  32 => 4,  11 => 2,);
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
/* <link rel="stylesheet" href="{{base_url()}}assets/sweetalert/dist/sweetalert.css" >*/
/* */
/* <style>*/
/*     .bg-info{*/
/*         background-color: #000000 !important;*/
/*     }*/
/* */
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
/*       <div class="row text-center">*/
/*         <h3 class="text-white-1">Login</h3>*/
/*         <hr/>*/
/*       </div>*/
/*       <div class="row col-md-6 col-md-offset-3">*/
/*         <form class="form-horizontal form-login" action="{{base_url()}}signin/login" method="post">*/
/*           <div class="form-group">*/
/*             <label class="control-label text-white-1" for="username">Username</label>*/
/*             <input class="form-control" type="text" id="username" name="username" placeholder="Masukan username" required>*/
/*           </div>*/
/*           <div class="form-group">*/
/*               <label class="control-label text-white-1" for="password">Password</label>*/
/*               <input class="form-control" type="password" id="password" name="password" placeholder="Masukan password" required minlength="3">*/
/*           </div>*/
/*           <div class="form-group text-center">*/
/*             <button class="btn btn-md btn-default" type="submit"><i class="si si-login"></i> Masuk</button>*/
/*               <!-- <a href="#" class="h5" style="float:right;margin-top:9px;">Lupa kata sandi?</a> -->*/
/*           </div>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/* </section>*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/*   <!-- Page JS Code -->*/
/*   <script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>*/
/*   <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/*   <script src="{{base_url()}}assets/oneui/js/pages/login_member.js"></script>*/
/* {% endblock %}*/
/* */
