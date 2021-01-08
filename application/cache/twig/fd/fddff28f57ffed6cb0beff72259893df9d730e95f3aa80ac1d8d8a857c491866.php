<?php

/* backend/certificatePreviewBack.twig */
class __TwigTemplate_93f2ffe35ffe0409b9adc21bceac0d90d74da0a8bcde528fee2db15b893d07de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/certificatePreviewBack.twig", 1);
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
        echo "<!-- Page JS Plugins CSS -->
<link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<!-- ARTechnology -->
";
        // line 11
        echo "<!-- ARTechnology -->
<link href=\"https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:500\" rel=\"stylesheet\">

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
    td{
      padding: 5px 5px;
    }
    .cert {
      /*background: blue;*/
      ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 40
            echo "          ";
            if (($this->getAttribute($context["trah"], "tra_name", array()) == $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_breed", array()))) {
                // line 41
                echo "              background: url('";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_back", array()), "html", null, true);
                echo "') no-repeat;
          ";
            }
            // line 43
            echo "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "      /* background: url('";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/blkng.jpg') no-repeat; */
      background-size: contain;
      /*background-color: black;*/
    }
    .tentang_surat, .isi_surat{
      font-family: ;
      /*font-weight: bold;*/
      letter-spacing: 1px;
    }
    /*.tentang_surat h2, .tentang_surat h3, .tentang_surat p{
      font-family: 'MTCORSVA' !important;
    }*/
    .tentang_surat h2{
      margin-top: -10px;
    }
    .tentang_surat h3{
      margin-top: -5px;
      margin-bottom: -5px;
      font-size: 25px;
    }
    .tentang_surat p{
      font-size: 16px;
      line-height: 1;
    }
    .isi_surat{
      font-size: 19px;
      letter-spacing: 0px;
    }
    .kopsurat{
      text-align: right;
      padding-right: 0px;
    }
    @media print{
      .cert {
        /*background: blue;*/

        margin: 0px !important;
      }
      body{
        ";
        // line 83
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 84
            echo "            ";
            if (($this->getAttribute($context["trah"], "tra_name", array()) == $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_breed", array()))) {
                // line 85
                echo "                background: url('";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_back", array()), "html", null, true);
                echo "') no-repeat !important;
            ";
            }
            // line 87
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "        /* background: url('";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/blkng.jpg') no-repeat !important; */
        background-size: contain !important;
              padding: 0px !important;
              margin: 0px !important;  /* the margin on the content before printing */
      }

      .graph-image img{
          display:inline !important;
      }
      .kopsurat{
        margin-top: -40px;
      }
      .konten_surat{
        color: #FF0000 !important;
      }
      .as{
          /*margin-left: 110px;*/
          color: #FF0000 !important;
      }
     .dam{
        color: #FF0000 !important;
      }

      .sire{
        color: #FF0000 !important;
      }

       .as2{
         color: #FFF !important;
       }

      .white{
        color: white !important;
      }
   }
   /*@page narrow {size: 0mm 0mm}*/
   /*@page rotated {size: landscape}*/

   @page {
         size:  landscape;   /* auto is the initial value */
        margin: 0mm;
    }
    .tentang_surat{
      text-align: left;
      /*margin-top: 181px;*/
      /*margin-top: 185px;*/
      /*margin-top: 164px;*/
      font-family: 'Alegreya Sans SC', sans-serif !important;
      padding-top: 30px;
      /*font-family: Arial, sans-serif ;*/
    }

    .as{
       color: #FF0000 !important;
     }

     .as2{
       color: #FFF !important;
     }


</style>
";
    }

    // line 152
    public function block_body($context, array $blocks = array())
    {
        // line 153
        echo "<!-- <div class=\"content wrap-breadcrumb hidden-print\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 156
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li><a href=\"javascript:history.back()\" class=\"link-effect\">Sebelumnya</a></li>
        </ol>
    </div>
</div> -->
<!-- Page Content -->

<div class=\"content\">
  <div class=\"block graph-image cert\" >
    <!-- <div class=\"block-header text-center bg-gray-lighter\">
      <button class=\"btn btn-primary btn-add-section-detail pull-right\" onClick=\"openModal('#modal-add-section-detail', 'add')\" data-toggle=\"tooltip\" title=\"Cetak Pengumuman\"><i class=\"si si-printer\"></i></button>
      <h4>Pengumuman <small>Detail</small></h4>
    </div> -->
    <div class=\"block-content\" style=\"background-color: black;\">
        <div class=\"surat\">
            <div class=\"row kopsurat\">

            </div>
            <div class=\"row\">
              <div class=\"col-xs-12 tentang_surat\" style=\"color:white;\">

                  <div class=\"konten_surat\"style=\"margin-left: 15px;margin-top:75px;\">

                    <div class=\"font-w600 pull-right white\" style=\"margin-right: -156px; width: 430px; z-index:2; margin-top: 14px;\">

                          ";
        // line 181
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 182
            echo "
                            ";
            // line 183
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 184
                echo "                                <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                                ";
            } else {
                // line 186
                echo "                                <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            }
            // line 188
            echo "
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            // line 189
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 190
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 192
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px\">NO F</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 196
        echo "                          <br>

                          ";
        // line 198
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 199
            echo "
                            ";
            // line 200
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 201
                echo "                                <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                                ";
            } else {
                // line 203
                echo "                                <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            }
            // line 205
            echo "
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            // line 206
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 207
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                            ";
        } else {
            // line 209
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px\">NO M</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 213
        echo "                          <br>

                          ";
        // line 215
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 216
            echo "

                          ";
            // line 218
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 219
                echo "                            <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            } else {
                // line 221
                echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>

                          ";
            }
            // line 224
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 225
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                            ";
        } else {
            // line 227
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;\">NO F</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 231
        echo "                          <br>
                          ";
        // line 232
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 233
            echo "
                          ";
            // line 234
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 235
                echo "                            <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:1px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            } else {
                // line 237
                echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:1px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 239
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 240
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 242
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:1px;\">NO M</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 246
        echo "                          <br>

";
        // line 249
        echo "                          ";
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 250
            echo "
                          ";
            // line 251
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 252
                echo "                                <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 10px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                              ";
            } else {
                // line 254
                echo "                                <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 10px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 256
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 257
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 259
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 10px;\">NO F</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 263
        echo "                          <br>

                          ";
        // line 265
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 266
            echo "
                          ";
            // line 267
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 268
                echo "
                            <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px;\">";
                // line 269
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                              ";
            } else {
                // line 271
                echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 273
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 274
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 276
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px;\">NO M</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 280
        echo "                          <br>

                          ";
        // line 282
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 283
            echo "
                          ";
            // line 284
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 285
                echo "                            <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            } else {
                // line 287
                echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 289
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 290
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                            ";
        } else {
            // line 292
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;\">NO F</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 296
        echo "                          <br>

                          ";
        // line 298
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 299
            echo "
                          ";
            // line 300
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 301
                echo "                            <h6 class=\"as\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 1px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            } else {
                // line 303
                echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 1px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 305
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">";
            // line 306
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                            ";
        } else {
            // line 308
            echo "                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 1px;\">NO M</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"white\" style=\"font-weight:500; font-size:0.9em; margin-left: -30px;\">-</h6>
                          ";
        }
        // line 312
        echo "

                    </div>

                    <div class=\"font-w600 pull-right white\" style=\"margin-right: -162px;
                                width: 430px;
                                z-index:2;
                                margin-top: 50px;\">
                                <!-- margin-right: 222px; -->
                          ";
        // line 321
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 322
            echo "
                          ";
            // line 323
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 324
                echo "                          <h6 class=\"as\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            } else {
                // line 326
                echo "                          <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 328
            echo "                          <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:10px;\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                          <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -30px;\">";
            // line 329
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 331
            echo "                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px\">NO F</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:10px;\">-</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -30px;\">-</h6>
                          ";
        }
        // line 335
        echo "
                          ";
        // line 336
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 337
            echo "
                          ";
            // line 338
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 339
                echo "                          <h6 class=\"as\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top:100px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>

                          ";
            } else {
                // line 342
                echo "                          <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top:100px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>

                          ";
            }
            // line 345
            echo "
                          <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;\">";
            // line 346
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                          <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -33px;\">";
            // line 347
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 349
            echo "                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top:100px;\">NO M</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;\">-</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -33px;\">-</h6>
                          ";
        }
        // line 353
        echo "
                          ";
        // line 354
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 355
            echo "
                          ";
            // line 356
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 357
                echo "                            <h6 class=\"as\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 100px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                            ";
            } else {
                // line 359
                echo "                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 100px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 361
            echo "
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;\">";
            // line 362
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -33px;\">";
            // line 363
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 365
            echo "                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 100px;\">NO F</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;\">-</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -33px;\">-</h6>
                          ";
        }
        // line 369
        echo "
                          ";
        // line 370
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 371
            echo "
                          ";
            // line 372
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 373
                echo "                                <h6 class=\"as\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 102px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                              ";
            } else {
                // line 375
                echo "                                 <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 102px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "</h6>
                          ";
            }
            // line 377
            echo "
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:9px;\">";
            // line 378
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
            echo "</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -33px;\">";
            // line 379
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
            echo "</h6>
                          ";
        } else {
            // line 381
            echo "                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 102px;\">NO M</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:9px;\">-</h6>
                            <h6 class=\"white\" style=\" font-weight: 500;font-size: 0.8em;margin-left: -33px;\">-</h6>
                          ";
        }
        // line 385
        echo "
                    </div>
                    <div class=\"font-w600 pull-right white\" style=\"margin-right: -164px;
                                width: 430px;
                                z-index:2;
                                margin-top: 99px;\">
                          ";
        // line 391
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 392
            echo "                          <div class=\"\">
                            <!-- font-size: 0.8em;
                            margin-right: 225px;
                            margin-top: -10px; -->
                            ";
            // line 396
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire_as_count", array()) > 25)) {
                // line 397
                echo "
                                ";
                // line 398
                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                    // line 399
                    echo "                                    <h6 class=\"font-w600 as\" style=\"font-size: 0.8em;
                                    margin-right: 225px;
                                    margin-top: -10px;\">";
                    // line 401
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>

                                    ";
                } else {
                    // line 404
                    echo "
                                    <h6 class=\"font-w600 as2\" style=\"font-size: 0.8em;
                                    margin-right: 225px;
                                    margin-top: -10px;\">";
                    // line 407
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>
                                ";
                }
                // line 409
                echo "
                                <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 80px;margin-top:6px;\">";
                // line 410
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
                echo "</h6>
                                <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: -30px;margin-top:1px;\">";
                // line 411
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
                echo "</h6>

                              ";
            } else {
                // line 414
                echo "
                                ";
                // line 415
                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                    // line 416
                    echo "                                    <h6 class=\"font-w600 as\" style=\"font-size: 0.9em;margin-right: 200px\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>
                                  ";
                } else {
                    // line 418
                    echo "                                    <h6 class=\"font-w600 as2\" style=\"font-size: 0.9em;margin-right: 200px\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>
                                ";
                }
                // line 420
                echo "
                                <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 80px;margin-top:6px;\">";
                // line 421
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
                echo "</h6>
                                <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: -30px;margin-top:1px;\">";
                // line 422
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
                echo "</h6>
                            ";
            }
            // line 424
            echo "
                          </div>

                          ";
        } else {
            // line 428
            echo "                            <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-right: 200px\">NO F</h6>
                            <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 80px;margin-top:6px;\">-</h6>
                            <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: -30px;margin-top:1px;\">-</h6>
                          ";
        }
        // line 432
        echo "
                          <h6 style=\"margin-top: 283px;\"></h6>

                          ";
        // line 435
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 436
            echo "
                              ";
            // line 437
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom_as_count", array()) > 25)) {
                // line 438
                echo "

                                  ";
                // line 440
                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_numbe", array()) != "-")) {
                    // line 441
                    echo "
                                      <h6 class=\"font-w600 as\" style=\"
                                      font-size: 0.8em;
                                      margin-right: 225px;
                                      margin-top: -10px;
                                      margin-left: 5px;
                                      z-index:3;\">";
                    // line 447
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>

                                      ";
                } else {
                    // line 450
                    echo "
                                      <h6 class=\"font-w600 as2\" style=\"
                                      font-size: 0.8em;
                                      margin-right: 225px;
                                      margin-top: -10px;
                                      margin-left: 5px;
                                      z-index:3;\">";
                    // line 456
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>

                                  ";
                }
                // line 459
                echo "                                  <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 80px;margin-top:4px;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
                echo "</h6>
                                  <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: -30px;margin-top:1px;\">";
                // line 460
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
                echo "</h6>

                                ";
            } else {
                // line 463
                echo "
                                    ";
                // line 464
                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_numbe", array()) != "-")) {
                    // line 465
                    echo "                                      <h6 class=\"font-w600 as\" style=\"font-size: 0.9em;margin-left: 5px;margin-right: 200px;z-index:3;\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>
                                      ";
                } else {
                    // line 467
                    echo "                                      <h6 class=\"font-w600 as2\" style=\"font-size: 0.9em;margin-left: 5px;margin-right: 200px;z-index:3;\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                    echo "</h6>
                                    ";
                }
                // line 469
                echo "
                                    <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 80px;margin-top:4px;\">";
                // line 470
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_current_reg_number", array()), "html", null, true);
                echo "</h6>
                                    <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: -30px;margin-top:1px;\">";
                // line 471
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_color", array()), "html", null, true);
                echo "</h6>
                              ";
            }
            // line 473
            echo "
                            ";
        } else {
            // line 475
            echo "                            <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 5px;margin-right: 200px;z-index:3;\">NO M</h6>
                            <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: 80px;margin-top:4px;\">-</h6>
                            <h6 class=\"font-w600 white\" style=\"font-size: 0.9em;margin-left: -30px;margin-top:1px;\">-</h6>
                          ";
        }
        // line 479
        echo "
                          <br><br><br>
                          <h6 class=\"font-w600 white\" style=\"margin-left: -35px;margin-top:10px;\"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        // line 481
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "D"), "html", null, true);
        echo ",&nbsp;&nbsp;&nbsp;";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "F"), "html", null, true);
        echo " &nbsp;&nbsp;&nbsp;";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "dS"), "html", null, true);
        echo "&nbsp;&nbsp;&nbsp;&nbsp; ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "Y"), "html", null, true);
        echo "</h6>
                    </div>

                    <div class=\"pull-left\" style=\"margin-left: 20px;
                                width: 350px;
                                margin-top: 185px;position: absolute;z-index:1 !important;\">
                        <h3 class=\"as font-w600\" style=\"color:#FF0000;position: absolute;z-index:2 !important;\">";
        // line 487
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
        echo "</h3>
                        <h4 class=\"white \" style=\"color:white;margin-top:55px;margin-left:80px;\" >";
        // line 488
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_owner_name", array()), "html", null, true);
        echo "</h4>
                        <br/>
                        <font class=\"white\" style=\"margin-top:5px;\" size=\"0.1\">";
        // line 490
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sibling_male"]) ? $context["sibling_male"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["male"]) {
            // line 491
            echo "                          ";
            if (($this->getAttribute($context["loop"], "index", array()) == twig_length_filter($this->env, $context["male"]))) {
                // line 492
                echo twig_escape_filter($this->env, trim($this->getAttribute($context["male"], "can_a_s", array())), "html", null, true);
            } else {
                echo ",";
                echo twig_escape_filter($this->env, trim($this->getAttribute($context["male"], "can_a_s", array())), "html", null, true);
                echo "
                          ";
            }
            // line 494
            echo "                        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['male'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "(male)</font>
                        <br>
                        <br>
                        <font class=\"white\" style=\"margin-top:5px;\" size=\"0.1\">
                          ";
        // line 498
        ob_start();
        // line 499
        echo "                            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sibling_female"]) ? $context["sibling_female"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["female"]) {
            // line 500
            echo "                                ";
            if (($this->getAttribute($context["loop"], "index", array()) == twig_length_filter($this->env, $context["female"]))) {
                // line 501
                echo "                                  ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["female"], "can_a_s", array()), "html", null, true);
            } else {
                echo ",";
                echo twig_escape_filter($this->env, $this->getAttribute($context["female"], "can_a_s", array()), "html", null, true);
                echo "
                                ";
            }
            // line 503
            echo "                            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['female'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "(female)</font>
                          ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 505
        echo "                    </div>
                    <!-- <div class=\"font-w300 pull-right white\" style=\"margin-right: -166px;
                                width: 430px;
                                z-index:9;
                                margin-top: 66px;\">

                    </div> -->
                  </div>
              </div>

              <div class=\"col-xs-12 isi_surat\">
                <!-- <br><br><br> -->
                <br class=\"hidden-print\">
                <br class=\"hidden-print\">
                <br class=\"hidden-print\">
                <br class=\"hidden-print\">
                <br class=\"hidden-print\">

              </div>
              <div class=\"clearfix hidden-print\"></div>
              <hr class=\"hidden-print hidden-print\">

              <button class=\"btn btn-primary pull-right hidden-print\" onclick=\"_print(this)\" title=\"Cetak Sertifikat\"><i class=\"si si-printer\"></i>&nbsp;&nbsp;Cetak Sertifikat</button>

              <a href=\"";
        // line 529
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/canines\" class=\"btn btn-success btn-done pull-right hidden-print\" title=\"Proses Selesai\" style=\"margin-right:10px; display:none\"><i class=\"si si-check\"></i>&nbsp;&nbsp;Selesai</a>
              <div class=\"clearfix hidden-print\"></div>
              <br class=\"hidden-print\">
            </div>

        </div>
    </div>
<!-- Dynamic Table Full -->
  </div>
</div>
";
    }

    // line 541
    public function block_scripts($context, array $blocks = array())
    {
        // line 542
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 543
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 544
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 545
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 546
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 547
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 548
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 549
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 551
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<!-- ARTechnology -->
<!-- <script src=\"";
        // line 553
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_section_detail.js\"></script> -->
<!-- ARTechnology -->
<script type=\"text/javascript\">
jQuery(function () {
    \$('#page-container').addClass('sidebar-mini');
});
function _print(btn){
  App.initHelper('print-page');
  \$('.btn-done').show();
  \$(btn).hide();
}
function _chstat(scoid){
  \$.post('";
        // line 565
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "scores/update_student_score_status/'+scoid, function(res){
    res = \$.parseJSON(res);
    if (res.data == '1') {
        \$.post('";
        // line 568
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "certificate/add/'+scoid, function(res2){
          res2 = \$.parseJSON(res2);
          if (res2.data == '1') {
            alert('proses selesai');
            document.location.href = '";
        // line 572
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "certificate/filing';
          }else {
              alert('proses gagal silahkan ulangi lagi');
          }
        });
    }else {
        alert('proses gagal silahkan ulangi lagi');
    }
  })
}
</script>
";
    }

    public function getTemplateName()
    {
        return "backend/certificatePreviewBack.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1180 => 572,  1173 => 568,  1167 => 565,  1152 => 553,  1147 => 551,  1142 => 549,  1138 => 548,  1134 => 547,  1130 => 546,  1126 => 545,  1122 => 544,  1118 => 543,  1115 => 542,  1112 => 541,  1097 => 529,  1071 => 505,  1054 => 503,  1045 => 501,  1042 => 500,  1024 => 499,  1022 => 498,  1003 => 494,  995 => 492,  992 => 491,  975 => 490,  970 => 488,  966 => 487,  951 => 481,  947 => 479,  941 => 475,  937 => 473,  932 => 471,  928 => 470,  925 => 469,  919 => 467,  913 => 465,  911 => 464,  908 => 463,  902 => 460,  897 => 459,  891 => 456,  883 => 450,  877 => 447,  869 => 441,  867 => 440,  863 => 438,  861 => 437,  858 => 436,  856 => 435,  851 => 432,  845 => 428,  839 => 424,  834 => 422,  830 => 421,  827 => 420,  821 => 418,  815 => 416,  813 => 415,  810 => 414,  804 => 411,  800 => 410,  797 => 409,  792 => 407,  787 => 404,  781 => 401,  777 => 399,  775 => 398,  772 => 397,  770 => 396,  764 => 392,  762 => 391,  754 => 385,  748 => 381,  743 => 379,  739 => 378,  736 => 377,  730 => 375,  724 => 373,  722 => 372,  719 => 371,  717 => 370,  714 => 369,  708 => 365,  703 => 363,  699 => 362,  696 => 361,  690 => 359,  684 => 357,  682 => 356,  679 => 355,  677 => 354,  674 => 353,  668 => 349,  663 => 347,  659 => 346,  656 => 345,  649 => 342,  642 => 339,  640 => 338,  637 => 337,  635 => 336,  632 => 335,  626 => 331,  621 => 329,  616 => 328,  610 => 326,  604 => 324,  602 => 323,  599 => 322,  597 => 321,  586 => 312,  580 => 308,  575 => 306,  570 => 305,  564 => 303,  558 => 301,  556 => 300,  553 => 299,  551 => 298,  547 => 296,  541 => 292,  536 => 290,  531 => 289,  525 => 287,  519 => 285,  517 => 284,  514 => 283,  512 => 282,  508 => 280,  502 => 276,  497 => 274,  492 => 273,  486 => 271,  481 => 269,  478 => 268,  476 => 267,  473 => 266,  471 => 265,  467 => 263,  461 => 259,  456 => 257,  451 => 256,  445 => 254,  439 => 252,  437 => 251,  434 => 250,  431 => 249,  427 => 246,  421 => 242,  416 => 240,  411 => 239,  405 => 237,  399 => 235,  397 => 234,  394 => 233,  392 => 232,  389 => 231,  383 => 227,  378 => 225,  373 => 224,  366 => 221,  360 => 219,  358 => 218,  354 => 216,  352 => 215,  348 => 213,  342 => 209,  337 => 207,  333 => 206,  330 => 205,  324 => 203,  318 => 201,  316 => 200,  313 => 199,  311 => 198,  307 => 196,  301 => 192,  296 => 190,  292 => 189,  289 => 188,  283 => 186,  277 => 184,  275 => 183,  272 => 182,  270 => 181,  242 => 156,  237 => 153,  234 => 152,  166 => 88,  160 => 87,  153 => 85,  150 => 84,  146 => 83,  103 => 44,  97 => 43,  90 => 41,  87 => 40,  83 => 39,  53 => 11,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url()}}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <!-- ARTechnology -->*/
/* {# <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/fonts/MTCORSVA/font.css"> #}*/
/* <!-- ARTechnology -->*/
/* <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:500" rel="stylesheet">*/
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
/*     td{*/
/*       padding: 5px 5px;*/
/*     }*/
/*     .cert {*/
/*       /*background: blue;*//* */
/*       {% for trah in trahs %}*/
/*           {% if trah.tra_name == canine[0].can_breed  %}*/
/*               background: url('{{base_url()}}{{trah.tra_back}}') no-repeat;*/
/*           {% endif %}*/
/*       {% endfor %}*/
/*       /* background: url('{{base_url()}}assets/blkng.jpg') no-repeat; *//* */
/*       background-size: contain;*/
/*       /*background-color: black;*//* */
/*     }*/
/*     .tentang_surat, .isi_surat{*/
/*       font-family: ;*/
/*       /*font-weight: bold;*//* */
/*       letter-spacing: 1px;*/
/*     }*/
/*     /*.tentang_surat h2, .tentang_surat h3, .tentang_surat p{*/
/*       font-family: 'MTCORSVA' !important;*/
/*     }*//* */
/*     .tentang_surat h2{*/
/*       margin-top: -10px;*/
/*     }*/
/*     .tentang_surat h3{*/
/*       margin-top: -5px;*/
/*       margin-bottom: -5px;*/
/*       font-size: 25px;*/
/*     }*/
/*     .tentang_surat p{*/
/*       font-size: 16px;*/
/*       line-height: 1;*/
/*     }*/
/*     .isi_surat{*/
/*       font-size: 19px;*/
/*       letter-spacing: 0px;*/
/*     }*/
/*     .kopsurat{*/
/*       text-align: right;*/
/*       padding-right: 0px;*/
/*     }*/
/*     @media print{*/
/*       .cert {*/
/*         /*background: blue;*//* */
/* */
/*         margin: 0px !important;*/
/*       }*/
/*       body{*/
/*         {% for trah in trahs %}*/
/*             {% if trah.tra_name == canine[0].can_breed  %}*/
/*                 background: url('{{base_url()}}{{trah.tra_back}}') no-repeat !important;*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*         /* background: url('{{base_url()}}assets/blkng.jpg') no-repeat !important; *//* */
/*         background-size: contain !important;*/
/*               padding: 0px !important;*/
/*               margin: 0px !important;  /* the margin on the content before printing *//* */
/*       }*/
/* */
/*       .graph-image img{*/
/*           display:inline !important;*/
/*       }*/
/*       .kopsurat{*/
/*         margin-top: -40px;*/
/*       }*/
/*       .konten_surat{*/
/*         color: #FF0000 !important;*/
/*       }*/
/*       .as{*/
/*           /*margin-left: 110px;*//* */
/*           color: #FF0000 !important;*/
/*       }*/
/*      .dam{*/
/*         color: #FF0000 !important;*/
/*       }*/
/* */
/*       .sire{*/
/*         color: #FF0000 !important;*/
/*       }*/
/* */
/*        .as2{*/
/*          color: #FFF !important;*/
/*        }*/
/* */
/*       .white{*/
/*         color: white !important;*/
/*       }*/
/*    }*/
/*    /*@page narrow {size: 0mm 0mm}*//* */
/*    /*@page rotated {size: landscape}*//* */
/* */
/*    @page {*/
/*          size:  landscape;   /* auto is the initial value *//* */
/*         margin: 0mm;*/
/*     }*/
/*     .tentang_surat{*/
/*       text-align: left;*/
/*       /*margin-top: 181px;*//* */
/*       /*margin-top: 185px;*//* */
/*       /*margin-top: 164px;*//* */
/*       font-family: 'Alegreya Sans SC', sans-serif !important;*/
/*       padding-top: 30px;*/
/*       /*font-family: Arial, sans-serif ;*//* */
/*     }*/
/* */
/*     .as{*/
/*        color: #FF0000 !important;*/
/*      }*/
/* */
/*      .as2{*/
/*        color: #FFF !important;*/
/*      }*/
/* */
/* */
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <!-- <div class="content wrap-breadcrumb hidden-print">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="{{base_url()}}dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li><a href="javascript:history.back()" class="link-effect">Sebelumnya</a></li>*/
/*         </ol>*/
/*     </div>*/
/* </div> -->*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/*   <div class="block graph-image cert" >*/
/*     <!-- <div class="block-header text-center bg-gray-lighter">*/
/*       <button class="btn btn-primary btn-add-section-detail pull-right" onClick="openModal('#modal-add-section-detail', 'add')" data-toggle="tooltip" title="Cetak Pengumuman"><i class="si si-printer"></i></button>*/
/*       <h4>Pengumuman <small>Detail</small></h4>*/
/*     </div> -->*/
/*     <div class="block-content" style="background-color: black;">*/
/*         <div class="surat">*/
/*             <div class="row kopsurat">*/
/* */
/*             </div>*/
/*             <div class="row">*/
/*               <div class="col-xs-12 tentang_surat" style="color:white;">*/
/* */
/*                   <div class="konten_surat"style="margin-left: 15px;margin-top:75px;">*/
/* */
/*                     <div class="font-w600 pull-right white" style="margin-right: -156px; width: 430px; z-index:2; margin-top: 14px;">*/
/* */
/*                           {% if canine[0].sire[0].sire[0].sire[0] != null %}*/
/* */
/*                             {% if canine[0].sire[0].sire[0].sire[0].can_icr_number != '-' %}*/
/*                                 <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px">{{canine[0].sire[0].sire[0].sire[0].can_a_s}}</h6>*/
/*                                 {% else %}*/
/*                                 <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px">{{canine[0].sire[0].sire[0].sire[0].can_a_s}}</h6>*/
/*                             {% endif %}*/
/* */
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].sire[0].sire[0].sire[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].sire[0].sire[0].sire[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px">NO F</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/* */
/*                           {% if canine[0].sire[0].sire[0].mom[0] != null %}*/
/* */
/*                             {% if canine[0].sire[0].sire[0].mom[0].can_icr_number != '-' %}*/
/*                                 <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px">{{canine[0].sire[0].sire[0].mom[0].can_a_s}}</h6>*/
/*                                 {% else %}*/
/*                                 <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px">{{canine[0].sire[0].sire[0].mom[0].can_a_s}}</h6>*/
/*                             {% endif %}*/
/* */
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].sire[0].sire[0].mom[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].sire[0].sire[0].mom[0].can_color}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px">NO M</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/* */
/*                           {% if canine[0].sire[0].mom[0].sire[0] != null %}*/
/* */
/* */
/*                           {% if canine[0].sire[0].mom[0].sire[0].can_icr_number != '-' %}*/
/*                             <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;">{{canine[0].sire[0].mom[0].sire[0].can_a_s}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;">{{canine[0].sire[0].mom[0].sire[0].can_a_s}}</h6>*/
/* */
/*                           {% endif %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].sire[0].mom[0].sire[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].sire[0].mom[0].sire[0].can_color}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;">NO F</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/*                           {% if canine[0].sire[0].mom[0].mom[0] != null %}*/
/* */
/*                           {% if canine[0].sire[0].mom[0].mom[0].can_icr_number != '-' %}*/
/*                             <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:1px;">{{canine[0].sire[0].mom[0].mom[0].can_a_s}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:1px;">{{canine[0].sire[0].mom[0].mom[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].sire[0].mom[0].mom[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].sire[0].mom[0].mom[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:1px;">NO M</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/* */
/* {# mom #}*/
/*                           {% if canine[0].mom[0].sire[0].sire[0] != null %}*/
/* */
/*                           {% if canine[0].mom[0].sire[0].sire[0].can_icr_number != '-' %}*/
/*                                 <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 10px;">{{canine[0].mom[0].sire[0].sire[0].can_a_s}}</h6>*/
/*                               {% else %}*/
/*                                 <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 10px;">{{canine[0].mom[0].sire[0].sire[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].mom[0].sire[0].sire[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].mom[0].sire[0].sire[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 10px;">NO F</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/* */
/*                           {% if canine[0].mom[0].sire[0].mom[0] != null %}*/
/* */
/*                           {% if canine[0].mom[0].sire[0].mom[0].can_icr_number != '-' %}*/
/* */
/*                             <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px;">{{canine[0].mom[0].sire[0].mom[0].can_a_s}}</h6>*/
/*                               {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px;">{{canine[0].mom[0].sire[0].mom[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].mom[0].sire[0].mom[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].mom[0].sire[0].mom[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top:2px;">NO M</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/* */
/*                           {% if canine[0].mom[0].mom[0].sire[0] != null %}*/
/* */
/*                           {% if canine[0].mom[0].mom[0].sire[0].can_icr_number != '-' %}*/
/*                             <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;">{{canine[0].mom[0].mom[0].sire[0].can_a_s}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;">{{canine[0].mom[0].mom[0].sire[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].mom[0].mom[0].sire[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].mom[0].mom[0].sire[0].can_color}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 8px;">NO F</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/*                           <br>*/
/* */
/*                           {% if canine[0].mom[0].mom[0].mom[0] != null %}*/
/* */
/*                           {% if canine[0].mom[0].mom[0].mom[0].can_icr_number != '-' %}*/
/*                             <h6 class="as" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 1px;">{{canine[0].mom[0].mom[0].mom[0].can_a_s}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 1px;">{{canine[0].mom[0].mom[0].mom[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">{{canine[0].mom[0].mom[0].mom[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">{{canine[0].mom[0].mom[0].mom[0].can_color}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-right: 200px;margin-top: 1px;">NO M</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="white" style="font-weight:500; font-size:0.9em; margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/* */
/* */
/*                     </div>*/
/* */
/*                     <div class="font-w600 pull-right white" style="margin-right: -162px;*/
/*                                 width: 430px;*/
/*                                 z-index:2;*/
/*                                 margin-top: 50px;">*/
/*                                 <!-- margin-right: 222px; -->*/
/*                           {% if canine[0].sire[0].sire[0] != null %}*/
/* */
/*                           {% if canine[0].sire[0].sire[0].can_icr_number != '-' %}*/
/*                           <h6 class="as" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px">{{canine[0].sire[0].sire[0].can_a_s}}</h6>*/
/*                           {% else %}*/
/*                           <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px">{{canine[0].sire[0].sire[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/*                           <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:10px;">{{canine[0].sire[0].sire[0].can_current_reg_number}}</h6>*/
/*                           <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -30px;">{{canine[0].sire[0].sire[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px">NO F</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:10px;">-</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -30px;">-</h6>*/
/*                           {% endif %}*/
/* */
/*                           {% if canine[0].sire[0].mom[0] != null %}*/
/* */
/*                           {% if canine[0].sire[0].mom[0].can_icr_number != '-' %}*/
/*                           <h6 class="as" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top:100px;">{{canine[0].sire[0].mom[0].can_a_s}}</h6>*/
/* */
/*                           {% else %}*/
/*                           <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top:100px;">{{canine[0].sire[0].mom[0].can_a_s}}</h6>*/
/* */
/*                           {% endif %}*/
/* */
/*                           <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;">{{canine[0].sire[0].mom[0].can_current_reg_number}}</h6>*/
/*                           <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -33px;">{{canine[0].sire[0].mom[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top:100px;">NO M</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;">-</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -33px;">-</h6>*/
/*                           {% endif %}*/
/* */
/*                           {% if canine[0].mom[0].sire[0] != null %}*/
/* */
/*                           {% if canine[0].mom[0].sire[0].can_icr_number != '-' %}*/
/*                             <h6 class="as" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 100px;">{{canine[0].mom[0].sire[0].can_a_s}}</h6>*/
/*                             {% else %}*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 100px;">{{canine[0].mom[0].sire[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/* */
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;">{{canine[0].mom[0].sire[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -33px;">{{canine[0].mom[0].sire[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 100px;">NO F</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:8px;">-</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -33px;">-</h6>*/
/*                           {% endif %}*/
/* */
/*                           {% if canine[0].mom[0].mom[0] != null %}*/
/* */
/*                           {% if canine[0].mom[0].mom[0].can_icr_number != '-' %}*/
/*                                 <h6 class="as" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 102px;">{{canine[0].mom[0].mom[0].can_a_s}}</h6>*/
/*                               {% else %}*/
/*                                  <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 102px;">{{canine[0].mom[0].mom[0].can_a_s}}</h6>*/
/*                           {% endif %}*/
/* */
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:9px;">{{canine[0].mom[0].mom[0].can_current_reg_number}}</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -33px;">{{canine[0].mom[0].mom[0].can_color}}</h6>*/
/*                           {% else %}*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-right: 200px;margin-top: 102px;">NO M</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: 70px;margin-top:9px;">-</h6>*/
/*                             <h6 class="white" style=" font-weight: 500;font-size: 0.8em;margin-left: -33px;">-</h6>*/
/*                           {% endif %}*/
/* */
/*                     </div>*/
/*                     <div class="font-w600 pull-right white" style="margin-right: -164px;*/
/*                                 width: 430px;*/
/*                                 z-index:2;*/
/*                                 margin-top: 99px;">*/
/*                           {% if canine[0].sire[0] != null %}*/
/*                           <div class="">*/
/*                             <!-- font-size: 0.8em;*/
/*                             margin-right: 225px;*/
/*                             margin-top: -10px; -->*/
/*                             {% if canine[0].sire[0].sire_as_count > 25 %}*/
/* */
/*                                 {% if canine[0].sire[0].can_icr_number != '-' %}*/
/*                                     <h6 class="font-w600 as" style="font-size: 0.8em;*/
/*                                     margin-right: 225px;*/
/*                                     margin-top: -10px;">{{canine[0].sire[0].can_a_s}}</h6>*/
/* */
/*                                     {% else %}*/
/* */
/*                                     <h6 class="font-w600 as2" style="font-size: 0.8em;*/
/*                                     margin-right: 225px;*/
/*                                     margin-top: -10px;">{{canine[0].sire[0].can_a_s}}</h6>*/
/*                                 {% endif %}*/
/* */
/*                                 <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 80px;margin-top:6px;">{{canine[0].sire[0].can_current_reg_number}}</h6>*/
/*                                 <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: -30px;margin-top:1px;">{{canine[0].sire[0].can_color}}</h6>*/
/* */
/*                               {% else %}*/
/* */
/*                                 {% if canine[0].sire[0].can_icr_number != '-' %}*/
/*                                     <h6 class="font-w600 as" style="font-size: 0.9em;margin-right: 200px">{{canine[0].sire[0].can_a_s}}</h6>*/
/*                                   {% else %}*/
/*                                     <h6 class="font-w600 as2" style="font-size: 0.9em;margin-right: 200px">{{canine[0].sire[0].can_a_s}}</h6>*/
/*                                 {% endif %}*/
/* */
/*                                 <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 80px;margin-top:6px;">{{canine[0].sire[0].can_current_reg_number}}</h6>*/
/*                                 <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: -30px;margin-top:1px;">{{canine[0].sire[0].can_color}}</h6>*/
/*                             {% endif %}*/
/* */
/*                           </div>*/
/* */
/*                           {% else %}*/
/*                             <h6 class="font-w600 white" style="font-size: 0.9em;margin-right: 200px">NO F</h6>*/
/*                             <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 80px;margin-top:6px;">-</h6>*/
/*                             <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: -30px;margin-top:1px;">-</h6>*/
/*                           {% endif %}*/
/* */
/*                           <h6 style="margin-top: 283px;"></h6>*/
/* */
/*                           {% if canine[0].mom[0] != null %}*/
/* */
/*                               {% if canine[0].mom[0].mom_as_count > 25 %}*/
/* */
/* */
/*                                   {% if canine[0].mom[0].can_icr_numbe != '-' %}*/
/* */
/*                                       <h6 class="font-w600 as" style="*/
/*                                       font-size: 0.8em;*/
/*                                       margin-right: 225px;*/
/*                                       margin-top: -10px;*/
/*                                       margin-left: 5px;*/
/*                                       z-index:3;">{{canine[0].mom[0].can_a_s}}</h6>*/
/* */
/*                                       {% else %}*/
/* */
/*                                       <h6 class="font-w600 as2" style="*/
/*                                       font-size: 0.8em;*/
/*                                       margin-right: 225px;*/
/*                                       margin-top: -10px;*/
/*                                       margin-left: 5px;*/
/*                                       z-index:3;">{{canine[0].mom[0].can_a_s}}</h6>*/
/* */
/*                                   {% endif %}*/
/*                                   <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 80px;margin-top:4px;">{{canine[0].mom[0].can_current_reg_number}}</h6>*/
/*                                   <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: -30px;margin-top:1px;">{{canine[0].mom[0].can_color}}</h6>*/
/* */
/*                                 {% else %}*/
/* */
/*                                     {% if canine[0].mom[0].can_icr_numbe != '-' %}*/
/*                                       <h6 class="font-w600 as" style="font-size: 0.9em;margin-left: 5px;margin-right: 200px;z-index:3;">{{canine[0].mom[0].can_a_s}}</h6>*/
/*                                       {% else %}*/
/*                                       <h6 class="font-w600 as2" style="font-size: 0.9em;margin-left: 5px;margin-right: 200px;z-index:3;">{{canine[0].mom[0].can_a_s}}</h6>*/
/*                                     {% endif %}*/
/* */
/*                                     <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 80px;margin-top:4px;">{{canine[0].mom[0].can_current_reg_number}}</h6>*/
/*                                     <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: -30px;margin-top:1px;">{{canine[0].mom[0].can_color}}</h6>*/
/*                               {% endif %}*/
/* */
/*                             {% else %}*/
/*                             <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 5px;margin-right: 200px;z-index:3;">NO M</h6>*/
/*                             <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: 80px;margin-top:4px;">-</h6>*/
/*                             <h6 class="font-w600 white" style="font-size: 0.9em;margin-left: -30px;margin-top:1px;">-</h6>*/
/*                           {% endif %}*/
/* */
/*                           <br><br><br>*/
/*                           <h6 class="font-w600 white" style="margin-left: -35px;margin-top:10px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{now|date('D')}},&nbsp;&nbsp;&nbsp;{{now|date('F')}} &nbsp;&nbsp;&nbsp;{{now|date('dS')}}&nbsp;&nbsp;&nbsp;&nbsp; {{now|date('Y')}}</h6>*/
/*                     </div>*/
/* */
/*                     <div class="pull-left" style="margin-left: 20px;*/
/*                                 width: 350px;*/
/*                                 margin-top: 185px;position: absolute;z-index:1 !important;">*/
/*                         <h3 class="as font-w600" style="color:#FF0000;position: absolute;z-index:2 !important;">{{canine[0].can_a_s}}</h3>*/
/*                         <h4 class="white " style="color:white;margin-top:55px;margin-left:80px;" >{{canine[0].can_owner_name}}</h4>*/
/*                         <br/>*/
/*                         <font class="white" style="margin-top:5px;" size="0.1">{% for male in sibling_male %}*/
/*                           {% if loop.index == male|length %}*/
/*                             {{- male.can_a_s|trim}}{% else %},{{- male.can_a_s|trim}}*/
/*                           {% endif %}*/
/*                         {% endfor %}(male)</font>*/
/*                         <br>*/
/*                         <br>*/
/*                         <font class="white" style="margin-top:5px;" size="0.1">*/
/*                           {% spaceless %}*/
/*                             {% for female in sibling_female %}*/
/*                                 {% if loop.index == female|length %}*/
/*                                   {{female.can_a_s}}{% else %},{{female.can_a_s}}*/
/*                                 {% endif %}*/
/*                             {% endfor %}(female)</font>*/
/*                           {% endspaceless %}*/
/*                     </div>*/
/*                     <!-- <div class="font-w300 pull-right white" style="margin-right: -166px;*/
/*                                 width: 430px;*/
/*                                 z-index:9;*/
/*                                 margin-top: 66px;">*/
/* */
/*                     </div> -->*/
/*                   </div>*/
/*               </div>*/
/* */
/*               <div class="col-xs-12 isi_surat">*/
/*                 <!-- <br><br><br> -->*/
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/* */
/*               </div>*/
/*               <div class="clearfix hidden-print"></div>*/
/*               <hr class="hidden-print hidden-print">*/
/* */
/*               <button class="btn btn-primary pull-right hidden-print" onclick="_print(this)" title="Cetak Sertifikat"><i class="si si-printer"></i>&nbsp;&nbsp;Cetak Sertifikat</button>*/
/* */
/*               <a href="{{base_url()}}backend/canines" class="btn btn-success btn-done pull-right hidden-print" title="Proses Selesai" style="margin-right:10px; display:none"><i class="si si-check"></i>&nbsp;&nbsp;Selesai</a>*/
/*               <div class="clearfix hidden-print"></div>*/
/*               <br class="hidden-print">*/
/*             </div>*/
/* */
/*         </div>*/
/*     </div>*/
/* <!-- Dynamic Table Full -->*/
/*   </div>*/
/* </div>*/
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
/* <!-- Page JS Code -->*/
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <!-- ARTechnology -->*/
/* <!-- <script src="{{ base_url() }}/assets/oneui/js/pages/adm_section_detail.js"></script> -->*/
/* <!-- ARTechnology -->*/
/* <script type="text/javascript">*/
/* jQuery(function () {*/
/*     $('#page-container').addClass('sidebar-mini');*/
/* });*/
/* function _print(btn){*/
/*   App.initHelper('print-page');*/
/*   $('.btn-done').show();*/
/*   $(btn).hide();*/
/* }*/
/* function _chstat(scoid){*/
/*   $.post('{{base_url()}}scores/update_student_score_status/'+scoid, function(res){*/
/*     res = $.parseJSON(res);*/
/*     if (res.data == '1') {*/
/*         $.post('{{base_url()}}certificate/add/'+scoid, function(res2){*/
/*           res2 = $.parseJSON(res2);*/
/*           if (res2.data == '1') {*/
/*             alert('proses selesai');*/
/*             document.location.href = '{{base_url()}}certificate/filing';*/
/*           }else {*/
/*               alert('proses gagal silahkan ulangi lagi');*/
/*           }*/
/*         });*/
/*     }else {*/
/*         alert('proses gagal silahkan ulangi lagi');*/
/*     }*/
/*   })*/
/* }*/
/* </script>*/
/* {% endblock %}*/
/* */
