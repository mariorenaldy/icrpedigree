<?php

/* front/events.twig */
class __TwigTemplate_4ac292e3debde2f3940bf6f41480bfad8e4517c81553eb7a7f6f695af4017c22 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/events.twig", 3);
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
        echo "Event
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
        $context['_seq'] = twig_ensure_traversable((isset($context["events"]) ? $context["events"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 27
            echo "                            <div class=\"col-md-4\">
                              <!-- <div class=\"project development design\" style=\"position: absolute; left: 0px; top: 0px;\"> -->
                                  <a href=\"javascript:;\" class=\"gallery-item-title\">";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_title", array()), "html", null, true);
            echo "</a>
                                  <a href=\"";
            // line 30
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_photo", array()), "html", null, true);
            echo "\" data-source=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_photo", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_title", array()), "html", null, true);
            echo "\" class=\"gallery-item effect-milo\">
                                      <img src=\"";
            // line 31
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_photo", array()), "html", null, true);
            echo "\">
                                  </a>

                                  <div class=\"pull-left\">
                                    <p class=\"gallery-item-descr\">
                                        <i class=\"icon-tag4\"></i> ";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_place", array()), "html", null, true);
            echo "
                                    </p>
                                  </div>


                                  <div class=\" pull-right\">
                                    <a href=\"";
            // line 42
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "events/albums/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_id", array()), "html", null, true);
            echo "\" name=\"button\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-picture\"></span> Galeri Acara</a>

                                  </div>

                                  <div class=\"col-md-12\" style=\"padding:0px;margin-top:5px;\">
                                    <p class=\"gallery-item-descr\">
                                        ";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_desc", array()), "html", null, true);
            echo "
                                    <!-- <ul> -->
                                        <br/>Tempat  : ";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "evn_place", array()), "html", null, true);
            echo "
                                        <br/>Tanggal : ";
            // line 51
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["event"], "evn_date", array()), "d M Y"), "html", null, true);
            echo "
                                        <!-- <li>Milik Wesi Prayudha Sakti</li> -->
                                    <!-- </ul> -->
                                    </p>
                                    <!-- <p>
                                      Ranking sementara :
                                    </p>
                                    <ol>
                                      ";
            // line 59
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["winners"]) ? $context["winners"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["winner"]) {
                // line 60
                echo "                                          <li>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["winner"], "can_a_s", array()), "html", null, true);
                echo " - score : ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["winner"], "can_score", array()), "html", null, true);
                echo "</li>
                                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['winner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "                                    </ol> -->
                                  </div>

                              <!-- </div> -->
                            </div>
                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        echo "
                      </div>

                    </div>
                </div>

                <center>
                  <nav>
                    ";
        // line 76
        echo (isset($context["links"]) ? $context["links"] : null);
        echo "
                  </nav>

                </center>
            </section>

            <section class=\"hero-banner bg-primary\">
                <div class=\"container text-center\">

                    <div class=\"row\">
                        <div class=\"col-sm-10 col-sm-offset-1\">
                            <h2 class=\"text-white-1\">IKUTI EVENT YANG KAMI SELENGGARAKAN!</h2><hr>
                            <div class=\"row\">
                                <div class=\"col-sm-12 text-white-1\">
                                 Setiap gelaran event yang dilaksanakan bertujuan sebagai ajang kumpul ICR. Ada berbagai agenda kebersamaan dan semua akan menjadi lebih meriah saat Anda bisa bergabung sebagai keluarga besar ICR.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

";
    }

    // line 100
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "front/events.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 100,  189 => 76,  179 => 68,  168 => 62,  157 => 60,  153 => 59,  142 => 51,  138 => 50,  133 => 48,  122 => 42,  113 => 36,  104 => 31,  94 => 30,  90 => 29,  86 => 27,  82 => 26,  73 => 19,  70 => 18,  65 => 15,  62 => 14,  56 => 12,  50 => 9,  46 => 8,  43 => 7,  40 => 6,  33 => 4,  11 => 3,);
    }
}
/* */
/* */
/* {% extends "template/frontend.twig" %}*/
/* {% block title %}Event*/
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
/*                           {% for event in events %}*/
/*                             <div class="col-md-4">*/
/*                               <!-- <div class="project development design" style="position: absolute; left: 0px; top: 0px;"> -->*/
/*                                   <a href="javascript:;" class="gallery-item-title">{{event.evn_title}}</a>*/
/*                                   <a href="{{base_url()}}{{event.evn_photo}}" data-source="{{base_url()}}{{event.evn_photo}}" title="{{event.evn_title}}" class="gallery-item effect-milo">*/
/*                                       <img src="{{base_url()}}{{event.evn_photo}}">*/
/*                                   </a>*/
/* */
/*                                   <div class="pull-left">*/
/*                                     <p class="gallery-item-descr">*/
/*                                         <i class="icon-tag4"></i> {{event.evn_place}}*/
/*                                     </p>*/
/*                                   </div>*/
/* */
/* */
/*                                   <div class=" pull-right">*/
/*                                     <a href="{{base_url()}}events/albums/{{event.evn_id}}" name="button" class="btn btn-default"><span class="glyphicon glyphicon-picture"></span> Galeri Acara</a>*/
/* */
/*                                   </div>*/
/* */
/*                                   <div class="col-md-12" style="padding:0px;margin-top:5px;">*/
/*                                     <p class="gallery-item-descr">*/
/*                                         {{event.evn_desc}}*/
/*                                     <!-- <ul> -->*/
/*                                         <br/>Tempat  : {{event.evn_place}}*/
/*                                         <br/>Tanggal : {{event.evn_date|date('d M Y')}}*/
/*                                         <!-- <li>Milik Wesi Prayudha Sakti</li> -->*/
/*                                     <!-- </ul> -->*/
/*                                     </p>*/
/*                                     <!-- <p>*/
/*                                       Ranking sementara :*/
/*                                     </p>*/
/*                                     <ol>*/
/*                                       {% for winner in winners %}*/
/*                                           <li>{{winner.can_a_s}} - score : {{winner.can_score}}</li>*/
/*                                       {% endfor %}*/
/*                                     </ol> -->*/
/*                                   </div>*/
/* */
/*                               <!-- </div> -->*/
/*                             </div>*/
/*                           {% endfor %}*/
/* */
/*                       </div>*/
/* */
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <center>*/
/*                   <nav>*/
/*                     {{links|raw}}*/
/*                   </nav>*/
/* */
/*                 </center>*/
/*             </section>*/
/* */
/*             <section class="hero-banner bg-primary">*/
/*                 <div class="container text-center">*/
/* */
/*                     <div class="row">*/
/*                         <div class="col-sm-10 col-sm-offset-1">*/
/*                             <h2 class="text-white-1">IKUTI EVENT YANG KAMI SELENGGARAKAN!</h2><hr>*/
/*                             <div class="row">*/
/*                                 <div class="col-sm-12 text-white-1">*/
/*                                  Setiap gelaran event yang dilaksanakan bertujuan sebagai ajang kumpul ICR. Ada berbagai agenda kebersamaan dan semua akan menjadi lebih meriah saat Anda bisa bergabung sebagai keluarga besar ICR.*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </section>*/
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}{% endblock %}*/
/* */
