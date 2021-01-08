<?php

/* front/profile.twig */
class __TwigTemplate_9bf1e0cc3fd68581ce1d437bd8d5547bcd5749c9f5cb6ae459d613938f0cd346 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/profile.twig", 2);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'styles' => array($this, 'block_styles'),
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

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Profil
";
    }

    // line 5
    public function block_styles($context, array $blocks = array())
    {
        // line 6
        echo "<link href=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/owl-carousel/owl.carousel.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/owl-carousel/owl.theme.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/owl-carousel/owl.transitions.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-magnific/magnific-popup.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
";
    }

    // line 12
    public function block_header($context, array $blocks = array())
    {
        // line 13
        echo "<section class=\"main-slider\" data-stellar-background-ratio=\"0.5\" style=\"background-image: url(";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/headers/about.jpg)\">
    <div class=\"slider-caption\">
        <h2 data-animate=\"fadeInDown\" data-delay=\"1000\" data-duration=\"2s\" style=\"color: yellow;\">
            Bergabunglah bersama kami
            <br> <span class=\"invert bg-info\">ICR</span> Indonesian Canine Registry<br>
        </h2>
        <!--<a data-animate=\"fadeInUp\" data-duration=\"2s\" data-delay=\"1300\" href=\"#theteam\" class=\"btn btn-primary btn-lg\">MEET THE TEAM</a>\t</div>-->
</section>
";
    }

    // line 23
    public function block_content($context, array $blocks = array())
    {
        // line 24
        echo "<section class=\"hero-banner bg-grey-1\">
    <div class=\"container text-center\">
        <div class=\"row\">
            <div class=\"col-sm-10 col-sm-offset-1\">
                <h2 class=\"text-primary\">
                    <!-- <b>I</b>NDONESIAN
                    <b>C</b>ANINE
                    <b>R</b>EGISTRY -->
                    ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_company_name", array()), "html", null, true);
        echo "
                  </h2><hr>
                <div class=\"row text-justify\">
                    <div class=\"col-sm-12\">
                        ";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_desc", array()), "html", null, true);
        echo "
                    </div>
                    <!-- <div class=\"col-sm-6\">
                                                                                </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class=\"video-block text-center\">
    <div class=\"video-overlay\"></div>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-sm-10 col-sm-offset-1\">
                <h1 class=\"text-success\">Mengapa Bergabung Dengan ICR?</h1>

                <div class=\"row\">
                    <div class=\"col-sm-12 text-left\">
                        <p>";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_review", array()), "html", null, true);
        echo "</p><br>
                        <!-- <p>
                            <a href=\"javascript:;\" class=\"btn btn-default btn-bordered btn-pill\">SEE DETAILS</a>
                        </p> -->
                    </div>
                    <!-- <div class=\"col-sm-6 text-left\">
                        <ul class=\"list-unstyled whyuslist\">
                            <li><i class=\"icon-checkmark2 text-default\"></i> 40 years of experience on Web development</li>
                            <li><i class=\"icon-checkmark2 text-default\"></i> 10 billion happy clients</li>
                            <li><i class=\"icon-checkmark2 text-default\"></i> HTML6 & CSS4 web design</li>
                            <li><i class=\"icon-checkmark2 text-default\"></i> 50 years guarantee with unlimited support</li>
                            <li><i class=\"icon-checkmark2 text-default\"></i> Headquarters in Silicon Valley</li>
                            <li>and more...</li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- <video loop=\"\" muted=\"\" autoplay=\"\" data-src=\"";
        // line 74
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/video/Site_Map_Drawing_from_LIFEOFVIDS_on_296353493.mp4\">
    </video> -->
</section>

<section id=\"theteam\" class=\"team-block\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-sm-12\">
                <h2>Manajemen ICR</h2>
            </div>
        </div>
        <div class=\"row zoom-gallery\" data-animate=\"zoomIn\" data-delay=\"0\">
          ";
        // line 86
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["managements"]) ? $context["managements"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["management"]) {
            // line 87
            echo "          <div class=\"col-sm-3\">
              <a href=\"";
            // line 88
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["management"], "man_photo", array()), "html", null, true);
            echo "\" data-source=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["management"], "man_photo", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["management"], "man_position", array()), "html", null, true);
            echo "\" class=\"gallery-item effect-milo\">
                  <img src=\"";
            // line 89
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["management"], "man_photo", array()), "html", null, true);
            echo "\">
              </a>
              <div class=\"btn-group pull-right\">
                  <a class=\"btn btn-link\"><i class=\"icon-facebook4\"></i></a>
                  <a class=\"btn btn-link\"><i class=\"icon-twitter4\"></i></a>
                  <a class=\"btn btn-link\"><i class=\"icon-linkedin3\"></i></a>
                  <a class=\"btn btn-link\"><i class=\"icon-envelope\"></i></a>
              </div>
              <a href=\"javascript:;\" class=\"gallery-item-title\">";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute($context["management"], "man_name", array()), "html", null, true);
            echo "</a>
              <b>";
            // line 98
            echo twig_escape_filter($this->env, $this->getAttribute($context["management"], "man_position", array()), "html", null, true);
            echo "</b>
          </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['management'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "
            <!-- <div class=\"col-sm-3\" data-animate=\"zoomIn\" data-delay=\"300\">
                <a href=\"";
        // line 103
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user11.jpg\" data-source=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user11.jpg\" title=\"Team Member Info\" class=\"gallery-item effect-milo\">
                    <img src=\"";
        // line 104
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user11.jpg\">
                </a>
                <div class=\"btn-group pull-right\"><a class=\"btn btn-link\"><i class=\"icon-facebook4\"></i></a><a class=\"btn btn-link\"><i class=\"icon-twitter4\"></i></a><a class=\"btn btn-link\"><i class=\"icon-linkedin3\"></i></a><a class=\"btn btn-link\"><i class=\"icon-envelope\"></i></a></div>
                <a href=\"javascript:;\" class=\"gallery-item-title\">KRIS JOHAN</a>
                <b>Presiden Indonesian Canine Registry</b>
            </div>
            <div class=\"col-sm-3\" data-animate=\"zoomIn\" data-delay=\"600\">
                <a href=\"";
        // line 111
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user13.jpg\" data-source=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user13.jpg\" title=\"Team Member Info\" class=\"gallery-item effect-milo\">
                    <img src=\"";
        // line 112
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user13.jpg\">
                </a>
                <div class=\"btn-group pull-right\"><a class=\"btn btn-link\"><i class=\"icon-facebook4\"></i></a><a class=\"btn btn-link\"><i class=\"icon-twitter4\"></i></a><a class=\"btn btn-link\"><i class=\"icon-linkedin3\"></i></a><a class=\"btn btn-link\"><i class=\"icon-envelope\"></i></a></div>
                <a href=\"javascript:;\" class=\"gallery-item-title\">KRIS JOHAN</a>
                <b>Presiden Indonesian Canine Registry</b>
            </div>
            <div class=\"col-sm-3\" data-animate=\"zoomIn\" data-delay=\"600\">
                <a href=\"";
        // line 119
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user7.jpg\" data-source=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user7.jpg\" title=\"Team Member Info\" class=\"gallery-item effect-milo\">
                    <img src=\"";
        // line 120
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/users/user7.jpg\">
                </a>
                <div class=\"btn-group pull-right\"><a class=\"btn btn-link\"><i class=\"icon-facebook4\"></i></a><a class=\"btn btn-link\"><i class=\"icon-twitter4\"></i></a><a class=\"btn btn-link\"><i class=\"icon-linkedin3\"></i></a><a class=\"btn btn-link\"><i class=\"icon-envelope\"></i></a></div>
                <a href=\"javascript:;\" class=\"gallery-item-title\">KRIS JOHAN</a>
                <b>Presiden Indonesian Canine Registry</b>
            </div> -->
        </div>
    </div>
</section>

";
    }

    // line 132
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "front/profile.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  260 => 132,  245 => 120,  239 => 119,  229 => 112,  223 => 111,  213 => 104,  207 => 103,  203 => 101,  194 => 98,  190 => 97,  178 => 89,  168 => 88,  165 => 87,  161 => 86,  146 => 74,  124 => 55,  102 => 36,  95 => 32,  85 => 24,  82 => 23,  68 => 13,  65 => 12,  59 => 10,  55 => 9,  51 => 8,  47 => 7,  42 => 6,  39 => 5,  32 => 3,  11 => 2,);
    }
}
/* */
/* {% extends "template/frontend.twig" %}*/
/* {% block title %}Profil*/
/* {% endblock %}*/
/* {% block styles %}*/
/* <link href="{{base_url()}}assets/coco/libs/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/libs/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/libs/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/libs/jquery-magnific/magnific-popup.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* {% endblock %}*/
/* {% block header %}*/
/* <section class="main-slider" data-stellar-background-ratio="0.5" style="background-image: url({{base_url()}}assets/coco/images/headers/about.jpg)">*/
/*     <div class="slider-caption">*/
/*         <h2 data-animate="fadeInDown" data-delay="1000" data-duration="2s" style="color: yellow;">*/
/*             Bergabunglah bersama kami*/
/*             <br> <span class="invert bg-info">ICR</span> Indonesian Canine Registry<br>*/
/*         </h2>*/
/*         <!--<a data-animate="fadeInUp" data-duration="2s" data-delay="1300" href="#theteam" class="btn btn-primary btn-lg">MEET THE TEAM</a>	</div>-->*/
/* </section>*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* <section class="hero-banner bg-grey-1">*/
/*     <div class="container text-center">*/
/*         <div class="row">*/
/*             <div class="col-sm-10 col-sm-offset-1">*/
/*                 <h2 class="text-primary">*/
/*                     <!-- <b>I</b>NDONESIAN*/
/*                     <b>C</b>ANINE*/
/*                     <b>R</b>EGISTRY -->*/
/*                     {{profile.prof_company_name}}*/
/*                   </h2><hr>*/
/*                 <div class="row text-justify">*/
/*                     <div class="col-sm-12">*/
/*                         {{profile.prof_desc}}*/
/*                     </div>*/
/*                     <!-- <div class="col-sm-6">*/
/*                                                                                 </div> -->*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <section class="video-block text-center">*/
/*     <div class="video-overlay"></div>*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-sm-10 col-sm-offset-1">*/
/*                 <h1 class="text-success">Mengapa Bergabung Dengan ICR?</h1>*/
/* */
/*                 <div class="row">*/
/*                     <div class="col-sm-12 text-left">*/
/*                         <p>{{profile.prof_review}}</p><br>*/
/*                         <!-- <p>*/
/*                             <a href="javascript:;" class="btn btn-default btn-bordered btn-pill">SEE DETAILS</a>*/
/*                         </p> -->*/
/*                     </div>*/
/*                     <!-- <div class="col-sm-6 text-left">*/
/*                         <ul class="list-unstyled whyuslist">*/
/*                             <li><i class="icon-checkmark2 text-default"></i> 40 years of experience on Web development</li>*/
/*                             <li><i class="icon-checkmark2 text-default"></i> 10 billion happy clients</li>*/
/*                             <li><i class="icon-checkmark2 text-default"></i> HTML6 & CSS4 web design</li>*/
/*                             <li><i class="icon-checkmark2 text-default"></i> 50 years guarantee with unlimited support</li>*/
/*                             <li><i class="icon-checkmark2 text-default"></i> Headquarters in Silicon Valley</li>*/
/*                             <li>and more...</li>*/
/*                         </ul>*/
/*                     </div> -->*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <!-- <video loop="" muted="" autoplay="" data-src="{{base_url()}}assets/coco/images/video/Site_Map_Drawing_from_LIFEOFVIDS_on_296353493.mp4">*/
/*     </video> -->*/
/* </section>*/
/* */
/* <section id="theteam" class="team-block">*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-sm-12">*/
/*                 <h2>Manajemen ICR</h2>*/
/*             </div>*/
/*         </div>*/
/*         <div class="row zoom-gallery" data-animate="zoomIn" data-delay="0">*/
/*           {% for management in managements %}*/
/*           <div class="col-sm-3">*/
/*               <a href="{{base_url()}}{{management.man_photo}}" data-source="{{base_url()}}{{management.man_photo}}" title="{{management.man_position}}" class="gallery-item effect-milo">*/
/*                   <img src="{{base_url()}}{{management.man_photo}}">*/
/*               </a>*/
/*               <div class="btn-group pull-right">*/
/*                   <a class="btn btn-link"><i class="icon-facebook4"></i></a>*/
/*                   <a class="btn btn-link"><i class="icon-twitter4"></i></a>*/
/*                   <a class="btn btn-link"><i class="icon-linkedin3"></i></a>*/
/*                   <a class="btn btn-link"><i class="icon-envelope"></i></a>*/
/*               </div>*/
/*               <a href="javascript:;" class="gallery-item-title">{{management.man_name}}</a>*/
/*               <b>{{management.man_position}}</b>*/
/*           </div>*/
/*           {% endfor %}*/
/* */
/*             <!-- <div class="col-sm-3" data-animate="zoomIn" data-delay="300">*/
/*                 <a href="{{base_url()}}assets/coco/images/users/user11.jpg" data-source="{{base_url()}}assets/coco/images/users/user11.jpg" title="Team Member Info" class="gallery-item effect-milo">*/
/*                     <img src="{{base_url()}}assets/coco/images/users/user11.jpg">*/
/*                 </a>*/
/*                 <div class="btn-group pull-right"><a class="btn btn-link"><i class="icon-facebook4"></i></a><a class="btn btn-link"><i class="icon-twitter4"></i></a><a class="btn btn-link"><i class="icon-linkedin3"></i></a><a class="btn btn-link"><i class="icon-envelope"></i></a></div>*/
/*                 <a href="javascript:;" class="gallery-item-title">KRIS JOHAN</a>*/
/*                 <b>Presiden Indonesian Canine Registry</b>*/
/*             </div>*/
/*             <div class="col-sm-3" data-animate="zoomIn" data-delay="600">*/
/*                 <a href="{{base_url()}}assets/coco/images/users/user13.jpg" data-source="{{base_url()}}assets/coco/images/users/user13.jpg" title="Team Member Info" class="gallery-item effect-milo">*/
/*                     <img src="{{base_url()}}assets/coco/images/users/user13.jpg">*/
/*                 </a>*/
/*                 <div class="btn-group pull-right"><a class="btn btn-link"><i class="icon-facebook4"></i></a><a class="btn btn-link"><i class="icon-twitter4"></i></a><a class="btn btn-link"><i class="icon-linkedin3"></i></a><a class="btn btn-link"><i class="icon-envelope"></i></a></div>*/
/*                 <a href="javascript:;" class="gallery-item-title">KRIS JOHAN</a>*/
/*                 <b>Presiden Indonesian Canine Registry</b>*/
/*             </div>*/
/*             <div class="col-sm-3" data-animate="zoomIn" data-delay="600">*/
/*                 <a href="{{base_url()}}assets/coco/images/users/user7.jpg" data-source="{{base_url()}}assets/coco/images/users/user7.jpg" title="Team Member Info" class="gallery-item effect-milo">*/
/*                     <img src="{{base_url()}}assets/coco/images/users/user7.jpg">*/
/*                 </a>*/
/*                 <div class="btn-group pull-right"><a class="btn btn-link"><i class="icon-facebook4"></i></a><a class="btn btn-link"><i class="icon-twitter4"></i></a><a class="btn btn-link"><i class="icon-linkedin3"></i></a><a class="btn btn-link"><i class="icon-envelope"></i></a></div>*/
/*                 <a href="javascript:;" class="gallery-item-title">KRIS JOHAN</a>*/
/*                 <b>Presiden Indonesian Canine Registry</b>*/
/*             </div> -->*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}{% endblock %}*/
/* */
