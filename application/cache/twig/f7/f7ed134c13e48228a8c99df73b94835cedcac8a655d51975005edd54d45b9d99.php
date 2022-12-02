<?php

/* front/beranda.twig */
class __TwigTemplate_95e3cf19566dffcf9f5d625077081b88175a9f5886e138cfce42b8cfcf9426a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/beranda.twig", 2);
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
        echo "Beranda";
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
        echo "assets/coco/css/style.css\" rel=\"stylesheet\" type=\"text/css\" />";
    }

    // line 12
    public function block_header($context, array $blocks = array())
    {
        // line 13
        echo "<section class=\"main-slider fullsize\" data-stellar-background-ratio=\"0.5\" style=\"background-image: url(";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_background", array()), "html", null, true);
        echo ")\">
    <div class=\"slider-caption\">
        <h1 data-animate=\"fadeInDown\" data-delay=\"1000\" data-duration=\"2s\">
            Pastikan
            <br>Anjing kesayangan Anda tersertifikasi
            <br>Kami siap melayani!
        </h1>
        <!--<a data-animate=\"fadeInUp\" data-duration=\"2s\" data-delay=\"1300\" href=\"javascript:;\" class=\"btn btn-primary btn-lg\">-->
        <a data-animate=\"fadeInUp\" data-duration=\"2s\" data-delay=\"1300\" href=\"#contact\" class=\"btn btn-danger btn-lg\">
            Hubungi Kami
        </a>
    </div>
</section>";
    }

    // line 27
    public function block_content($context, array $blocks = array())
    {
        // line 28
        echo "<section class=\"hero-banner\">
    <div class=\"container text-center\">

        <div class=\"row\">
            <div class=\"col-sm-10 col-sm-offset-1\">
                <h2>Kami <span class=\"invert bg-success\">mengerti</span> apa yang Anda butuhkan!</h2>
                  <p>";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_review", array()), "html", null, true);
        echo "
                  </p>
            </div>
        </div>
    </div>
</section>


  <section class=\"features-block\">

      <div class=\"container\">
          <div class=\"row\">
              <div class=\"col-sm-12\">
                  <h2>EVENT DAN FESTIVAL POPULER</h2>
              </div>
          </div>
          <div class=\"row zoom-gallery\" data-animate=\"zoomIn\" data-delay=\"0\">";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["event"]) ? $context["event"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["events"]) {
            // line 53
            echo "              <div class=\"col-sm-4\">
                  <a href=\"";
            // line 54
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_photo", array()), "html", null, true);
            echo "\" data-source=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_photo", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_title", array()), "html", null, true);
            echo "\" class=\"gallery-item effect-milo\">
                      <img src=\"";
            // line 55
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_photo", array()), "html", null, true);
            echo "\">
                  </a>

                  <div class=\"col-md-12\" style=\"margin:0px;padding:0px;\">
                    <a href=\"javascript:;\" class=\"gallery-item-title pull-left\">";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_title", array()), "html", null, true);
            echo "</a>
                    <a href=\"";
            // line 60
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "events/albums/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_id", array()), "html", null, true);
            echo "\" name=\"button\" class=\"btn btn-default pull-right\"><span class=\"glyphicon glyphicon-picture\"></span> Galeri Event</a>
                  </div>
                  <!-- <br> -->
                  <hr>
                <div class=\"col-md-12\" style=\"margin:0px;padding:0px;\">
                    <p class=\"gallery-item-descr\">";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_desc", array()), "html", null, true);
            echo "
                    <!-- <ul> -->
                        <br/>Tempat  :";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute($context["events"], "evn_place", array()), "html", null, true);
            echo "
                        <br/>Tanggal :";
            // line 69
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "evn_date", array()), "d M Y"), "html", null, true);
            echo "
                        <!-- <li>Milik Wesi Prayudha Sakti</li> -->
                    <!-- </ul> -->


                    </p>
                    <p>
                      Ranking sementara :
                    </p>
                    <ol>";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["winners"]) ? $context["winners"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["winner"]) {
                // line 80
                echo "                          <li>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["winner"], "can_a_s", array()), "html", null, true);
                echo " - score :";
                echo twig_escape_filter($this->env, $this->getAttribute($context["winner"], "can_score", array()), "html", null, true);
                echo "</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['winner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "                    </ol>
                  </div>

              </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['events'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "
          </div>
      </div>
  </section>


<section class=\"testimonials-block parallax-bg text-center\" data-stellar-background-ratio=\"0.6\" style=\"padding-top: 0px;\">

    <!-- <div id=\"testimonial\" class=\"owl-carousel owl-theme\"> -->";
        // line 97
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sponsorsPrimary"]) ? $context["sponsorsPrimary"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["sponsor"]) {
            // line 98
            echo "        <div class=\"item\">
            <a href=\"";
            // line 99
            echo twig_escape_filter($this->env, $this->getAttribute($context["sponsor"], "spo_website", array()), "html", null, true);
            echo "\" target=\"_blank\">
                <img src=\"";
            // line 100
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["sponsor"], "spo_logo", array()), "html", null, true);
            echo "\" width=\"100%\" class=\"img img-responsive\" alt=\"\" />
            </a>
        </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sponsor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        echo "

    <!-- </div> -->
</section>
<section class=\"testimonials-block parallax-bg text-center\" data-stellar-background-ratio=\"0.6\">

    <div id=\"testimonial\" class=\"owl-carousel owl-theme\">";
        // line 112
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["quote"]) ? $context["quote"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["quotes"]) {
            // line 113
            echo "        <div class=\"item\">
            <h2>\"";
            // line 114
            echo twig_escape_filter($this->env, $this->getAttribute($context["quotes"], "quo_content", array()), "html", null, true);
            echo "\"</h2>
            <p><b>";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute($context["quotes"], "quo_author", array()), "html", null, true);
            echo "</b></p>
        </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quotes'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        echo "

    </div>
</section>";
    }

    // line 125
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "front/beranda.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  263 => 125,  256 => 118,  248 => 115,  244 => 114,  241 => 113,  237 => 112,  229 => 104,  219 => 100,  215 => 99,  212 => 98,  208 => 97,  198 => 87,  189 => 82,  179 => 80,  175 => 79,  163 => 69,  159 => 68,  154 => 66,  144 => 60,  140 => 59,  132 => 55,  122 => 54,  119 => 53,  115 => 52,  96 => 35,  88 => 28,  85 => 27,  66 => 13,  63 => 12,  58 => 10,  54 => 9,  50 => 8,  46 => 7,  41 => 6,  38 => 5,  32 => 3,  11 => 2,);
    }
}
/* */
/* {% extends "template/frontend.twig" %}*/
/* {% block title %}Beranda*/
/* {% endblock %}*/
/* {% block styles %}*/
/* <link href="{{base_url()}}assets/coco/libs/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/libs/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/libs/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/libs/jquery-magnific/magnific-popup.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* {% endblock %}*/
/* {% block header %}*/
/* <section class="main-slider fullsize" data-stellar-background-ratio="0.5" style="background-image: url({{base_url()}}{{profile.prof_background}})">*/
/*     <div class="slider-caption">*/
/*         <h1 data-animate="fadeInDown" data-delay="1000" data-duration="2s">*/
/*             Pastikan*/
/*             <br>Anjing kesayangan Anda tersertifikasi*/
/*             <br>Kami siap melayani!*/
/*         </h1>*/
/*         <!--<a data-animate="fadeInUp" data-duration="2s" data-delay="1300" href="javascript:;" class="btn btn-primary btn-lg">-->*/
/*         <a data-animate="fadeInUp" data-duration="2s" data-delay="1300" href="#contact" class="btn btn-danger btn-lg">*/
/*             Hubungi Kami*/
/*         </a>*/
/*     </div>*/
/* </section>*/
/* {% endblock %}*/
/* {% block content %}*/
/* <section class="hero-banner">*/
/*     <div class="container text-center">*/
/* */
/*         <div class="row">*/
/*             <div class="col-sm-10 col-sm-offset-1">*/
/*                 <h2>Kami <span class="invert bg-success">mengerti</span> apa yang Anda butuhkan!</h2>*/
/*                   <p>*/
/*                       {{profile.prof_review}}*/
/*                   </p>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* */
/*   <section class="features-block">*/
/* */
/*       <div class="container">*/
/*           <div class="row">*/
/*               <div class="col-sm-12">*/
/*                   <h2>EVENT DAN FESTIVAL POPULER</h2>*/
/*               </div>*/
/*           </div>*/
/*           <div class="row zoom-gallery" data-animate="zoomIn" data-delay="0">*/
/*             {% for events in event %}*/
/*               <div class="col-sm-4">*/
/*                   <a href="{{base_url()}}{{events.evn_photo}}" data-source="{{base_url()}}{{events.evn_photo}}" title="{{events.evn_title}}" class="gallery-item effect-milo">*/
/*                       <img src="{{base_url()}}{{events.evn_photo}}">*/
/*                   </a>*/
/* */
/*                   <div class="col-md-12" style="margin:0px;padding:0px;">*/
/*                     <a href="javascript:;" class="gallery-item-title pull-left">{{events.evn_title}}</a>*/
/*                     <a href="{{base_url()}}events/albums/{{events.evn_id}}" name="button" class="btn btn-default pull-right"><span class="glyphicon glyphicon-picture"></span> Galeri Event</a>*/
/*                   </div>*/
/*                   <!-- <br> -->*/
/*                   <hr>*/
/*                 <div class="col-md-12" style="margin:0px;padding:0px;">*/
/*                     <p class="gallery-item-descr">*/
/*                         {{events.evn_desc}}*/
/*                     <!-- <ul> -->*/
/*                         <br/>Tempat  : {{events.evn_place}}*/
/*                         <br/>Tanggal : {{event.evn_date|date('d M Y')}}*/
/*                         <!-- <li>Milik Wesi Prayudha Sakti</li> -->*/
/*                     <!-- </ul> -->*/
/* */
/* */
/*                     </p>*/
/*                     <p>*/
/*                       Ranking sementara :*/
/*                     </p>*/
/*                     <ol>*/
/*                       {% for winner in winners %}*/
/*                           <li>{{winner.can_a_s}} - score : {{winner.can_score}}</li>*/
/*                       {% endfor %}*/
/*                     </ol>*/
/*                   </div>*/
/* */
/*               </div>*/
/*             {% endfor %}*/
/* */
/*           </div>*/
/*       </div>*/
/*   </section>*/
/* */
/* */
/* <section class="testimonials-block parallax-bg text-center" data-stellar-background-ratio="0.6" style="padding-top: 0px;">*/
/* */
/*     <!-- <div id="testimonial" class="owl-carousel owl-theme"> -->*/
/* */
/*         {% for sponsor in sponsorsPrimary %}*/
/*         <div class="item">*/
/*             <a href="{{sponsor.spo_website}}" target="_blank">*/
/*                 <img src="{{base_url()}}{{sponsor.spo_logo}}" width="100%" class="img img-responsive" alt="" />*/
/*             </a>*/
/*         </div>*/
/*         {% endfor %}*/
/* */
/* */
/*     <!-- </div> -->*/
/* </section>*/
/* <section class="testimonials-block parallax-bg text-center" data-stellar-background-ratio="0.6">*/
/* */
/*     <div id="testimonial" class="owl-carousel owl-theme">*/
/* */
/*         {% for quotes in quote %}*/
/*         <div class="item">*/
/*             <h2>"{{quotes.quo_content}}"</h2>*/
/*             <p><b>{{quotes.quo_author}}</b></p>*/
/*         </div>*/
/*         {% endfor %}*/
/* */
/* */
/*     </div>*/
/* </section>*/
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* */
/* {% endblock %}*/
/* */
