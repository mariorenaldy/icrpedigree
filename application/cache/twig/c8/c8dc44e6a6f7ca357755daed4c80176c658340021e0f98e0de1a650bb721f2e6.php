<?php

/* front/pedigrees.twig */
class __TwigTemplate_16656b80144fc1571f377b49a260efb3fcea9fdd8cf6665d4a672a3709b6823e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/pedigrees.twig", 3);
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
        echo "Pedigrees
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
<link rel=\"stylesheet\" id=\"css-main\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/css/typeaheadjs.css\">
<!-- ARTechnology -->
<link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/coco/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">
<!-- ARTechnology -->
<style>
.bg-info{
  background-color: #000000 !important;
}
</style>
";
    }

    // line 21
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 23
    public function block_header($context, array $blocks = array())
    {
        // line 24
        echo "
";
    }

    // line 27
    public function block_content($context, array $blocks = array())
    {
        // line 28
        echo "
<section class=\"hero-banner bg-info\">
  <div class=\"container text-center\">
    <div class=\"row\">
      <div class=\"col-sm-10 col-sm-offset-1\">
        <h2 class=\"text-white-1\">Pencarian <b>Silsilah Anjing</b> ANDA!!</h2><hr>
        <div class=\"row\">
          <div class=\"col-md-12\">
            <br>

            <form class=\"form-horizontal push-10-t\" action=\"";
        // line 38
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "pedigrees\" method=\"get\" style=\"margin-top:19px;\"> <!--/*onsubmit=\"return false;*/ -->
              <div class=\"form-group\">
                <div class=\"col-xs-2\">

                </div>
                <div class=\"col-xs-8\">
                  <div class=\"col-xs-12 js-header-search header-search\" >
                    <div class=\"input-group input-group-lg\" id=\"prefetch\">
                      <!-- ARTechnology -->
                      <input class=\"form-control search typeahead\" type=\"text\" name=\"q\" placeholder=\"Pencarian Silsilah berdasarkan No. ICR/Nama/Kennel/Tanggal Lahir\" required=\"Maaf pencarian tidak boleh kosong!!\">
                      <div class=\"input-group-btn\">
                        <button class=\"btn btn-default\"><i class=\"icon-search\"></i></button>
                      </div>
                    </div>
                    <h4 class=\"text-white-1\">Format Tanggal Lahir: tgl-bulan-tahun. Contoh: 12-12-2012.</h4>
                    <!-- ARTechnology -->
                    <!-- <center> -->
                      ";
        // line 55
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 56
            echo "                        <div class=\"panel panel-default\" data-modal=\"md-fade-in-scale-up\" style=\"margin-top: 5px; background-color:#fcf8e3;\">
                          <div class=\"panel-body\">
                          ";
            // line 58
            echo (isset($context["error"]) ? $context["error"] : null);
            echo "
                          </div>
                        </div>
                      ";
        }
        // line 62
        echo "                      <!-- <p class=\"pull-left\"style=\"color:white;\">

                      </p> -->
                    <!-- </center> -->
                  </div>
                </div>
              </div>

            </form>
            <br><br>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<input type=\"hidden\" value=\"";
        // line 78
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    // line 81
    public function block_scripts($context, array $blocks = array())
    {
        // line 82
        echo "<script src=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 83
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 84
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>

<script>
var base_url = \$('.base_url').val();

var canines = new Bloodhound({

  identify: function(obj) { return obj.can_icr_number; },
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_icr_number, can_a_s, can_icr_moc_number'),
  dupDetector: function(a, b) { return a.can_icr_number === b.can_icr_number; },

  remote: {
    url: base_url+'pedigrees/search?q=%QUERY',
    wildcard: '%QUERY',
    cache: false
  }

});

canines.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used
\$('#prefetch .typeahead').typeahead(null, {
  name: 'canines',
  display: 'can_icr_number',
  placeholder: false,
  source: canines.ttAdapter(),
  templates: {
    empty: [
      '<div class=\"empty-message\">',
      '<h5><strong>Maaf Data Tidak Ditemukan</strong></h5>',
      '</div>'
    ].join('\\n'),
    suggestion: function (data) {
      // data = \$.parseJSON(data);
      if (data.can_photo == '-') {
          return '<a style=\"color:black;\" href=\"'+base_url+'pedigrees/id/'+data.can_id+'\"><div style=\"margin-bottom:15px;\"><img width=\"40px\" style=\"float:left; margin:5px;\" src=\"'+base_url+'assets/oneui/img/avatars/image.png\"><strong>' + data.can_icr_number + '</strong> <br> ' + data.can_a_s + '</div></a><br><br>';
      }else{
        return '<a style=\"color:black;\" href=\"'+base_url+'pedigrees/id/'+data.can_id+'\"><div style=\"margin-bottom:15px;\"><img width=\"40px\" style=\"float:left; margin:5px;\" src=\"'+base_url+'uploads/canine/'+data.can_photo+'\"><strong>' + data.can_icr_number + '</strong> <br> ' + data.can_a_s + '</div></a><br><br>';
      }

    }
  }
});
</script>
";
    }

    public function getTemplateName()
    {
        return "front/pedigrees.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 84,  165 => 83,  160 => 82,  157 => 81,  151 => 78,  133 => 62,  126 => 58,  122 => 56,  120 => 55,  100 => 38,  88 => 28,  85 => 27,  80 => 24,  77 => 23,  71 => 21,  59 => 12,  54 => 10,  50 => 9,  46 => 8,  43 => 7,  40 => 6,  33 => 4,  11 => 3,);
    }
}
/* */
/* */
/* {% extends "template/frontend.twig" %}*/
/* {% block title %}Pedigrees*/
/* {% endblock %}*/
/* {% block styles %}*/
/* */
/* <link href="{{base_url()}}assets/coco/libs/jquery-magnific/magnific-popup.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* <link rel="stylesheet" id="css-main" href="{{ base_url() }}assets/typeahead.js/css/typeaheadjs.css">*/
/* <!-- ARTechnology -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/coco/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* <!-- ARTechnology -->*/
/* <style>*/
/* .bg-info{*/
/*   background-color: #000000 !important;*/
/* }*/
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
/* */
/* <section class="hero-banner bg-info">*/
/*   <div class="container text-center">*/
/*     <div class="row">*/
/*       <div class="col-sm-10 col-sm-offset-1">*/
/*         <h2 class="text-white-1">Pencarian <b>Silsilah Anjing</b> ANDA!!</h2><hr>*/
/*         <div class="row">*/
/*           <div class="col-md-12">*/
/*             <br>*/
/* */
/*             <form class="form-horizontal push-10-t" action="{{ base_url() }}pedigrees" method="get" style="margin-top:19px;"> <!--/*onsubmit="return false;*//*  -->*/
/*               <div class="form-group">*/
/*                 <div class="col-xs-2">*/
/* */
/*                 </div>*/
/*                 <div class="col-xs-8">*/
/*                   <div class="col-xs-12 js-header-search header-search" >*/
/*                     <div class="input-group input-group-lg" id="prefetch">*/
/*                       <!-- ARTechnology -->*/
/*                       <input class="form-control search typeahead" type="text" name="q" placeholder="Pencarian Silsilah berdasarkan No. ICR/Nama/Kennel/Tanggal Lahir" required="Maaf pencarian tidak boleh kosong!!">*/
/*                       <div class="input-group-btn">*/
/*                         <button class="btn btn-default"><i class="icon-search"></i></button>*/
/*                       </div>*/
/*                     </div>*/
/*                     <h4 class="text-white-1">Format Tanggal Lahir: tgl-bulan-tahun. Contoh: 12-12-2012.</h4>*/
/*                     <!-- ARTechnology -->*/
/*                     <!-- <center> -->*/
/*                       {% if error %}*/
/*                         <div class="panel panel-default" data-modal="md-fade-in-scale-up" style="margin-top: 5px; background-color:#fcf8e3;">*/
/*                           <div class="panel-body">*/
/*                           {{error|raw}}*/
/*                           </div>*/
/*                         </div>*/
/*                       {% endif %}*/
/*                       <!-- <p class="pull-left"style="color:white;">*/
/* */
/*                       </p> -->*/
/*                     <!-- </center> -->*/
/*                   </div>*/
/*                 </div>*/
/*               </div>*/
/* */
/*             </form>*/
/*             <br><br>*/
/*           </div>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </section>*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* var canines = new Bloodhound({*/
/* */
/*   identify: function(obj) { return obj.can_icr_number; },*/
/*   queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_icr_number, can_a_s, can_icr_moc_number'),*/
/*   dupDetector: function(a, b) { return a.can_icr_number === b.can_icr_number; },*/
/* */
/*   remote: {*/
/*     url: base_url+'pedigrees/search?q=%QUERY',*/
/*     wildcard: '%QUERY',*/
/*     cache: false*/
/*   }*/
/* */
/* });*/
/* */
/* canines.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
/* $('#prefetch .typeahead').typeahead(null, {*/
/*   name: 'canines',*/
/*   display: 'can_icr_number',*/
/*   placeholder: false,*/
/*   source: canines.ttAdapter(),*/
/*   templates: {*/
/*     empty: [*/
/*       '<div class="empty-message">',*/
/*       '<h5><strong>Maaf Data Tidak Ditemukan</strong></h5>',*/
/*       '</div>'*/
/*     ].join('\n'),*/
/*     suggestion: function (data) {*/
/*       // data = $.parseJSON(data);*/
/*       if (data.can_photo == '-') {*/
/*           return '<a style="color:black;" href="'+base_url+'pedigrees/id/'+data.can_id+'"><div style="margin-bottom:15px;"><img width="40px" style="float:left; margin:5px;" src="'+base_url+'assets/oneui/img/avatars/image.png"><strong>' + data.can_icr_number + '</strong> <br> ' + data.can_a_s + '</div></a><br><br>';*/
/*       }else{*/
/*         return '<a style="color:black;" href="'+base_url+'pedigrees/id/'+data.can_id+'"><div style="margin-bottom:15px;"><img width="40px" style="float:left; margin:5px;" src="'+base_url+'uploads/canine/'+data.can_photo+'"><strong>' + data.can_icr_number + '</strong> <br> ' + data.can_a_s + '</div></a><br><br>';*/
/*       }*/
/* */
/*     }*/
/*   }*/
/* });*/
/* </script>*/
/* {% endblock %}*/
/* */
