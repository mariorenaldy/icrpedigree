<?php

/* front/event_galery.twig */
class __TwigTemplate_81692e3a3783b8fad2db65cf6b648adf224cdf20773d73c6836bf03446f13a1d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/event_galery.twig", 3);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        echo "Produk
";
    }

    // line 6
    public function block_styles($context, array $blocks = array())
    {
        // line 7
        echo "
<link href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-magnific/magnific-popup.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
";
    }

    // line 12
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 14
    public function block_header($context, array $blocks = array())
    {
        // line 15
        echo "
";
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
        // line 19
        echo "
<section class=\"portfolio-block\" style=\"margin-bottom: 25px;\">

                <div class=\"container\">
                    <div class=\"portfolio-container zoom-gallery\" style=\"position: relative; \">
                      <div class=\"row\">

                          ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["galeries"]) ? $context["galeries"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["galery"]) {
            // line 27
            echo "                            <div class=\"col-md-4\">
                              <!-- <div class=\"project development design\" style=\"position: absolute; left: 0px; top: 0px;\"> -->
                                  <a href=\"javascript:;\" class=\"gallery-item-title\">";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($context["galery"], "gal_title", array()), "html", null, true);
            echo "</a>
                                  <a href=\"";
            // line 30
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["galery"], "gal_photo", array()), "html", null, true);
            echo "\" data-source=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["galery"], "gal_photo", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["galery"], "gal_title", array()), "html", null, true);
            echo "\" class=\"gallery-item effect-milo\">
                                      <img src=\"";
            // line 31
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["galery"], "gal_photo", array()), "html", null, true);
            echo "\">
                                  </a>
                                  <p class=\"text-sm text-muted\">
                                      ";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($context["galery"], "gal_description", array()), "html", null, true);
            echo "
                                  </p>
                              <!-- </div> -->
                            </div>
                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['galery'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "
                      </div>

                      <div class=\"row\" style=\"\">
                          ";
        // line 43
        if (((isset($context["galeries"]) ? $context["galeries"] : null) == null)) {
            // line 44
            echo "                          <div class=\"col-md-12 animated fadeIn\" style=\"margin-bottom: 100px;
    margin-top: 83px;\">
                              <center>
                                  <strong><h1>--Belum ada foto untuk acara ini--</h1></strong>
                              </center>
                          </div>
                          ";
        }
        // line 51
        echo "                      </div>



                    </div>
                </div>
            </section>



";
    }

    // line 63
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "front/event_galery.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 63,  139 => 51,  130 => 44,  128 => 43,  122 => 39,  111 => 34,  104 => 31,  94 => 30,  90 => 29,  86 => 27,  82 => 26,  73 => 19,  70 => 18,  65 => 15,  62 => 14,  56 => 12,  50 => 9,  46 => 8,  43 => 7,  40 => 6,  33 => 4,  11 => 3,);
    }
}
/* */
/* */
/* {% extends "template/frontend.twig" %}*/
/* {% block title %}Produk*/
/* {% endblock %}*/
/* {% block styles %}*/
/* */
/* <link href="{{base_url()}}assets/coco/libs/jquery-magnific/magnific-popup.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* {% endblock %}*/
/* */
/* {% block inverted %}inverted{% endblock %}*/
/* */
/* {% block header %}*/
/* */
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* */
/* <section class="portfolio-block" style="margin-bottom: 25px;">*/
/* */
/*                 <div class="container">*/
/*                     <div class="portfolio-container zoom-gallery" style="position: relative; ">*/
/*                       <div class="row">*/
/* */
/*                           {% for galery in galeries %}*/
/*                             <div class="col-md-4">*/
/*                               <!-- <div class="project development design" style="position: absolute; left: 0px; top: 0px;"> -->*/
/*                                   <a href="javascript:;" class="gallery-item-title">{{galery.gal_title}}</a>*/
/*                                   <a href="{{base_url()}}{{galery.gal_photo}}" data-source="{{base_url()}}{{galery.gal_photo}}" title="{{galery.gal_title}}" class="gallery-item effect-milo">*/
/*                                       <img src="{{base_url()}}{{galery.gal_photo}}">*/
/*                                   </a>*/
/*                                   <p class="text-sm text-muted">*/
/*                                       {{galery.gal_description}}*/
/*                                   </p>*/
/*                               <!-- </div> -->*/
/*                             </div>*/
/*                           {% endfor %}*/
/* */
/*                       </div>*/
/* */
/*                       <div class="row" style="">*/
/*                           {% if galeries == null %}*/
/*                           <div class="col-md-12 animated fadeIn" style="margin-bottom: 100px;*/
/*     margin-top: 83px;">*/
/*                               <center>*/
/*                                   <strong><h1>--Belum ada foto untuk acara ini--</h1></strong>*/
/*                               </center>*/
/*                           </div>*/
/*                           {% endif %}*/
/*                       </div>*/
/* */
/* */
/* */
/*                     </div>*/
/*                 </div>*/
/*             </section>*/
/* */
/* */
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}{% endblock %}*/
/* */
