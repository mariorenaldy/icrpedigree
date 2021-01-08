<?php

/* backend/certificatePreview.twig */
class __TwigTemplate_5d94049e3ff1343f551a20ba977bb4bb6def23decce37ee6df698be9239f97ab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/certificatePreview.twig", 1);
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
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/fonts/MTCORSVA/font.css\">

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
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 37
            echo "          ";
            if (($this->getAttribute($context["trah"], "tra_name", array()) == $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_breed", array()))) {
                // line 38
                echo "              background: url('";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_front", array()), "html", null, true);
                echo "') no-repeat;
          ";
            }
            // line 40
            echo "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "
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
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 81
            echo "            ";
            if (($this->getAttribute($context["trah"], "tra_name", array()) == $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_breed", array()))) {
                // line 82
                echo "        background: url('";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_front", array()), "html", null, true);
                echo "') no-repeat no-repeat !important;
            ";
            }
            // line 84
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        echo "        /* background: url('";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/depan.jpg') no-repeat !important; */
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
        color: red !important;
      }
      .as{
          /*margin-left: 110px;*/
          color: red !important;
      }

      .as2{
          /*margin-left: 110px;*/
          color: white !important;
      }

     .dam{
        color: red !important;
      }

      .sire{
        color: red !important;
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
      margin-top: 185px;
      /*margin-top: 164px;*/
      padding-top: 30px;
      font-family: Arial, sans-serif !important;
    }


</style>
";
    }

    // line 142
    public function block_body($context, array $blocks = array())
    {
        // line 143
        echo "<!-- <div class=\"content wrap-breadcrumb hidden-print\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 146
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li><a href=\"javascript:history.back()\" class=\"link-effect\">Sebelumnya</a></li>
        </ol>
    </div>
</div> -->
<!-- Page Content -->

<div class=\"content\">
  <div class=\"block graph-image cert\">
    <!-- <div class=\"block-header text-center bg-gray-lighter\">
      <button class=\"btn btn-primary btn-add-section-detail pull-right\" onClick=\"openModal('#modal-add-section-detail', 'add')\" data-toggle=\"tooltip\" title=\"Cetak Pengumuman\"><i class=\"si si-printer\"></i></button>
      <h4>Pengumuman <small>Detail</small></h4>
    </div> -->
    <div class=\"block-content\" style=\"background-color: black;\">
        <div class=\"surat\">
            <div class=\"row kopsurat\">
            <u>";
        // line 162
        echo twig_escape_filter($this->env, (isset($context["certificate_number"]) ? $context["certificate_number"] : null), "html", null, true);
        echo "</u>
            </div>
            <div class=\"row\">
              <div class=\"col-xs-12 tentang_surat\" style=\"color:white;\">
                  <div class=\"konten_surat\"style=\"margin-left: 175px;\">
                  <!-- <div  style=\"margin-left: 208px;\" > -->
                    <img class=\"pull-right\" style=\" margin-right: 70px; margin-top: -15px;\" src=\"";
        // line 168
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "uploads/canine/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_photo", array()), "html", null, true);
        echo "\" width=\"400px\" alt=\"\" />
                    ";
        // line 169
        if (($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_as_count", array()) > 28)) {
            // line 170
            echo "
                      ";
            // line 171
            if (($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 172
                echo "                        <p class=\"as\" style=\"color:red; width: 310px;\" >
                              ";
                // line 173
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "
                          </p>
                          ";
            } else {
                // line 176
                echo "                        <p class=\"as2\" style=\"color:white; width: 310px;\" >
                              ";
                // line 177
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "
                          </p>
                      ";
            }
            // line 180
            echo "

                        <!-- </p> -->
                        <p class=\"white\" style=\"margin-top:-3px;\">
                          ";
            // line 184
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_number", array()), "html", null, true);
            echo "
                        </p>
                    ";
        } else {
            // line 187
            echo "
                    ";
            // line 188
            if (($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_number", array()) != "-")) {
                // line 189
                echo "                        <p class=\"as\" style=\"color:red;\" >
                            ";
                // line 190
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "
                        </p>
                        ";
            } else {
                // line 193
                echo "                        <p class=\"as2\" style=\"color:white;\" >
                            ";
                // line 194
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
                echo "
                        </p>
                    ";
            }
            // line 197
            echo "

                        <!-- </p> -->
                        <p class=\"white\" style=\"margin-top:34px;\">
                          ";
            // line 201
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_number", array()), "html", null, true);
            echo "
                        </p>
                    ";
        }
        // line 204
        echo "                    <p class=\"white\" style=\"margin-top: -13px;
                                            margin-bottom: 6px;\">";
        // line 205
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_breed", array()), "html", null, true);
        echo "</p>
                    <p  class=\"white\"  >
                        ";
        // line 207
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_gender", array()), "html", null, true);
        echo "
                    </p>
                    <p class=\"white\" style=\"margin-top:-12px;\">
                        ";
        // line 210
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_color", array()), "html", null, true);
        echo "
                    </p>
                    <p class=\"white\" style=\"margin-top:-13px;\">
                        ";
        // line 213
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_date_of_birth", array()), "F"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_date_of_birth", array()), "d"), "html", null, true);
        if ((twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_date_of_birth", array()), "d") == 1)) {
            echo "st,";
        } elseif ((twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_date_of_birth", array()), "d") == 2)) {
            echo "rd,";
        } elseif ((twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_date_of_birth", array()), "d") == 3)) {
            echo "rd,";
        } else {
            echo "th,";
        }
        echo " ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_date_of_birth", array()), "Y"), "html", null, true);
        echo "
                    </p>
                    <br>
                    <p class=\"white\" style=\"margin-top:-15px;\">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        // line 217
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
        echo "
                    </p>
                    ";
        // line 219
        if ($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array())) {
            // line 220
            echo "                      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["sire"]) {
                // line 221
                echo "                        ";
                if ($context["sire"]) {
                    // line 222
                    echo "
                                ";
                    // line 223
                    if (($this->getAttribute($context["sire"], "can_icr_number", array()) != "-")) {
                        // line 224
                        echo "                                        ";
                        if (($this->getAttribute($context["sire"], "sire_as_count", array()) > 5)) {
                            // line 225
                            echo "                                          <p class=\"sire\"style=\"margin-top: 34px; color:red; font-size: 13px; margin-bottom: 20px;\">
                                              ";
                            // line 226
                            echo twig_escape_filter($this->env, $this->getAttribute($context["sire"], "can_a_s", array()), "html", null, true);
                            echo "
                                          </p>
                                          ";
                        } else {
                            // line 229
                            echo "                                          <!-- ini yg ditambahkan -->
                                          <p class=\"sire\"style=\"margin-top: 33px; color:red; font-size: 13px; margin-bottom: 20px;\">
                                              ";
                            // line 231
                            echo twig_escape_filter($this->env, $this->getAttribute($context["sire"], "can_a_s", array()), "html", null, true);
                            echo "
                                          </p>
                                        ";
                        }
                        // line 234
                        echo "
                                    ";
                    } else {
                        // line 236
                        echo "
                                        ";
                        // line 237
                        if (($this->getAttribute($context["sire"], "sire_as_count", array()) > 5)) {
                            // line 238
                            echo "                                          <p class=\"white\"style=\"margin-top: 36px; color:white; font-size: 13px; margin-bottom: 20px;\">
                                              ";
                            // line 239
                            echo twig_escape_filter($this->env, $this->getAttribute($context["sire"], "can_a_s", array()), "html", null, true);
                            echo "
                                          </p>
                                          ";
                        } else {
                            // line 242
                            echo "                                          <!-- ini yg ditambahkan -->
                                          <p class=\"white\"style=\"margin-top: 33px; color:white; font-size: 13px; margin-bottom: 20px;\">
                                              ";
                            // line 244
                            echo twig_escape_filter($this->env, $this->getAttribute($context["sire"], "can_a_s", array()), "html", null, true);
                            echo "
                                          </p>
                                        ";
                        }
                        // line 247
                        echo "
                                ";
                    }
                    // line 249
                    echo "



                              <p class=\"white\" style=\"margin-top:-11.5px;\">
                                  ";
                    // line 254
                    echo twig_escape_filter($this->env, $this->getAttribute($context["sire"], "can_icr_number", array()), "html", null, true);
                    echo "
                              </p>
                            ";
                } else {
                    // line 257
                    echo "                              <p class=\"white\"style=\"margin-top: 33px; color:white;\">
                                -
                              </p>
                              <p class=\"white\" style=\"margin-top:-11.5px;\">
                                -
                              </p>
                        ";
                }
                // line 264
                echo "                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sire'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 265
            echo "                    ";
        } else {
            // line 266
            echo "                        <p class=\"sire\"style=\"margin-top: 33px; color:red\">
                          -
                        </p>
                        <p class=\"white\" style=\"margin-top:-11.5px;\">
                          -
                        </p>
                    ";
        }
        // line 273
        echo "
                    ";
        // line 274
        if ($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "dam", array())) {
            // line 275
            echo "                      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "dam", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["dam"]) {
                // line 276
                echo "                        ";
                if ($context["dam"]) {
                    // line 277
                    echo "
                              ";
                    // line 278
                    if (($this->getAttribute($context["dam"], "can_icr_number", array()) != "-")) {
                        // line 279
                        echo "                                      ";
                        if (($this->getAttribute($context["dam"], "dam_as_count", array()) > 5)) {
                            // line 280
                            echo "                                        <p class=\"dam\" style=\"margin-top: -10px; color:red; font-size: 13px; margin-bottom: 24px;\">
                                            ";
                            // line 281
                            echo twig_escape_filter($this->env, $this->getAttribute($context["dam"], "can_a_s", array()), "html", null, true);
                            echo "
                                        </p>
                                        ";
                        } else {
                            // line 284
                            echo "                                        <!-- ini tes -->
                                        <p class=\"dam\" style=\"margin-top:-15px;color:red; font-size: 13px; margin-bottom: 24px;\">
                                            ";
                            // line 286
                            echo twig_escape_filter($this->env, $this->getAttribute($context["dam"], "can_a_s", array()), "html", null, true);
                            echo "
                                        </p>
                                      ";
                        }
                        // line 289
                        echo "
                                  ";
                    } else {
                        // line 291
                        echo "
                                  ";
                        // line 292
                        if (($this->getAttribute($context["dam"], "dam_as_count", array()) > 5)) {
                            // line 293
                            echo "                                    <p class=\"white\" style=\"margin-top: -10px; color:white; font-size: 13px; margin-bottom: 24px;\">
                                        ";
                            // line 294
                            echo twig_escape_filter($this->env, $this->getAttribute($context["dam"], "can_a_s", array()), "html", null, true);
                            echo "
                                    </p>
                                    ";
                        } else {
                            // line 297
                            echo "                                    <!-- ini tes -->
                                    <p class=\"white\" style=\"margin-top:-15px;color:white; font-size: 13px; margin-bottom: 24px;\">
                                        ";
                            // line 299
                            echo twig_escape_filter($this->env, $this->getAttribute($context["dam"], "can_a_s", array()), "html", null, true);
                            echo "
                                    </p>
                                  ";
                        }
                        // line 302
                        echo "
                              ";
                    }
                    // line 304
                    echo "

                              <p class=\"white\" style=\"margin-top:-15px;\">
                                  ";
                    // line 307
                    echo twig_escape_filter($this->env, $this->getAttribute($context["dam"], "can_icr_number", array()), "html", null, true);
                    echo "
                              </p>
                            ";
                } else {
                    // line 310
                    echo "                              <p class=\"dam\"style=\"margin-top: -15px; color:red\">
                                -
                              </p>
                              <p class=\"white\" style=\"margin-top:-15px;\">
                                -
                              </p>
                        ";
                }
                // line 317
                echo "                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dam'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 318
            echo "                    ";
        } else {
            // line 319
            echo "                      <p class=\"dam\"style=\"margin-top: -15px; color:red\">
                        -
                      </p>
                      <p class=\"white\" style=\"margin-top:-15px;\">
                        -
                      </p>
                    ";
        }
        // line 326
        echo "
                    <!-- <p style=\"margin-top:-11px;color:red;\">
                        PR.ARSENAL
                    </p>
                    <p class=\"sire\"style=\"margin-top:-11px;\">
                        16-D-09
                    </p> -->
                      </div>


                  <div  style=\"margin-top: 127px;margin-left: 45px;width: 450px;\">
                    <center>
                      <h4 class=\"white\" style=\"font-size: 22px;\">";
        // line 338
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_owner", array()), "html", null, true);
        echo "</h4>
                      <h5 class=\"white\" style=\"font-size: 16px;\">";
        // line 339
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_address", array()), "html", null, true);
        echo "</h5>
                    </center>
                  </div>

              </div>


              <div class=\"col-xs-12 isi_surat\">
                <!-- <br><br><br> -->


                <br class=\"hidden-print\">
                <br class=\"hidden-print\">
                <br class=\"hidden-print\">
                <br class=\"hidden-print\">

              </div>
              <div class=\"clearfix hidden-print\"></div>
              <hr class=\"hidden-print hidden-print\">

              <button class=\"btn btn-primary pull-right hidden-print\" onclick=\"_print(this)\" title=\"Cetak Sertifikat\"><i class=\"si si-printer\"></i>&nbsp;&nbsp;Cetak Sertifikat Depan</button>

              <a href=\"";
        // line 361
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/certificate/belakang/";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_id", array()), "html", null, true);
        echo "\" class=\"btn btn-primary btn-done pull-right hidden-print\" title=\"cetak sertifikat Belakang\" style=\"margin-right:10px; display:none\"><i class=\"si si-printer\"></i>&nbsp;&nbsp;Cetak Sertifikat Belakang</a>
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

    // line 372
    public function block_scripts($context, array $blocks = array())
    {
        // line 373
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 374
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 375
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 376
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 377
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 378
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 379
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 380
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 382
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 383
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_section_detail.js\"></script>
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
        // line 394
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "scores/update_student_score_status/'+scoid, function(res){
    res = \$.parseJSON(res);
    if (res.data == '1') {
        \$.post('";
        // line 397
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "certificate/add/'+scoid, function(res2){
          res2 = \$.parseJSON(res2);
          if (res2.data == '1') {
            alert('proses selesai');
            document.location.href = '";
        // line 401
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
        return "backend/certificatePreview.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  727 => 401,  720 => 397,  714 => 394,  700 => 383,  696 => 382,  691 => 380,  687 => 379,  683 => 378,  679 => 377,  675 => 376,  671 => 375,  667 => 374,  664 => 373,  661 => 372,  645 => 361,  620 => 339,  616 => 338,  602 => 326,  593 => 319,  590 => 318,  584 => 317,  575 => 310,  569 => 307,  564 => 304,  560 => 302,  554 => 299,  550 => 297,  544 => 294,  541 => 293,  539 => 292,  536 => 291,  532 => 289,  526 => 286,  522 => 284,  516 => 281,  513 => 280,  510 => 279,  508 => 278,  505 => 277,  502 => 276,  497 => 275,  495 => 274,  492 => 273,  483 => 266,  480 => 265,  474 => 264,  465 => 257,  459 => 254,  452 => 249,  448 => 247,  442 => 244,  438 => 242,  432 => 239,  429 => 238,  427 => 237,  424 => 236,  420 => 234,  414 => 231,  410 => 229,  404 => 226,  401 => 225,  398 => 224,  396 => 223,  393 => 222,  390 => 221,  385 => 220,  383 => 219,  378 => 217,  358 => 213,  352 => 210,  346 => 207,  341 => 205,  338 => 204,  332 => 201,  326 => 197,  320 => 194,  317 => 193,  311 => 190,  308 => 189,  306 => 188,  303 => 187,  297 => 184,  291 => 180,  285 => 177,  282 => 176,  276 => 173,  273 => 172,  271 => 171,  268 => 170,  266 => 169,  260 => 168,  251 => 162,  232 => 146,  227 => 143,  224 => 142,  163 => 85,  157 => 84,  150 => 82,  147 => 81,  143 => 80,  102 => 41,  96 => 40,  89 => 38,  86 => 37,  82 => 36,  52 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/fonts/MTCORSVA/font.css">*/
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
/*               background: url('{{base_url()}}{{trah.tra_front}}') no-repeat;*/
/*           {% endif %}*/
/*       {% endfor %}*/
/* */
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
/* */
/*     @media print{*/
/*       .cert {*/
/*         /*background: blue;*//* */
/*         margin: 0px !important;*/
/*       }*/
/*       body{*/
/*         {% for trah in trahs %}*/
/*             {% if trah.tra_name == canine[0].can_breed  %}*/
/*         background: url('{{base_url()}}{{trah.tra_front}}') no-repeat no-repeat !important;*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*         /* background: url('{{base_url()}}assets/depan.jpg') no-repeat !important; *//* */
/*         background-size: contain !important;*/
/*               padding: 0px !important;*/
/*               margin: 0px !important;  /* the margin on the content before printing *//* */
/*     }*/
/* */
/*       .graph-image img{*/
/*           display:inline !important;*/
/*       }*/
/*       .kopsurat{*/
/*         margin-top: -40px;*/
/*       }*/
/*       .konten_surat{*/
/*         color: red !important;*/
/*       }*/
/*       .as{*/
/*           /*margin-left: 110px;*//* */
/*           color: red !important;*/
/*       }*/
/* */
/*       .as2{*/
/*           /*margin-left: 110px;*//* */
/*           color: white !important;*/
/*       }*/
/* */
/*      .dam{*/
/*         color: red !important;*/
/*       }*/
/* */
/*       .sire{*/
/*         color: red !important;*/
/*       }*/
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
/*       margin-top: 185px;*/
/*       /*margin-top: 164px;*//* */
/*       padding-top: 30px;*/
/*       font-family: Arial, sans-serif !important;*/
/*     }*/
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
/*   <div class="block graph-image cert">*/
/*     <!-- <div class="block-header text-center bg-gray-lighter">*/
/*       <button class="btn btn-primary btn-add-section-detail pull-right" onClick="openModal('#modal-add-section-detail', 'add')" data-toggle="tooltip" title="Cetak Pengumuman"><i class="si si-printer"></i></button>*/
/*       <h4>Pengumuman <small>Detail</small></h4>*/
/*     </div> -->*/
/*     <div class="block-content" style="background-color: black;">*/
/*         <div class="surat">*/
/*             <div class="row kopsurat">*/
/*             <u>{{certificate_number}}</u>*/
/*             </div>*/
/*             <div class="row">*/
/*               <div class="col-xs-12 tentang_surat" style="color:white;">*/
/*                   <div class="konten_surat"style="margin-left: 175px;">*/
/*                   <!-- <div  style="margin-left: 208px;" > -->*/
/*                     <img class="pull-right" style=" margin-right: 70px; margin-top: -15px;" src="{{base_url()}}uploads/canine/{{canine[0].can_photo}}" width="400px" alt="" />*/
/*                     {% if canine[0].can_as_count > 28 %}*/
/* */
/*                       {% if canine[0].can_icr_number != '-' %}*/
/*                         <p class="as" style="color:red; width: 310px;" >*/
/*                               {{canine[0].can_a_s}}*/
/*                           </p>*/
/*                           {% else %}*/
/*                         <p class="as2" style="color:white; width: 310px;" >*/
/*                               {{canine[0].can_a_s}}*/
/*                           </p>*/
/*                       {% endif %}*/
/* */
/* */
/*                         <!-- </p> -->*/
/*                         <p class="white" style="margin-top:-3px;">*/
/*                           {{canine[0].can_icr_number}}*/
/*                         </p>*/
/*                     {% else %}*/
/* */
/*                     {% if canine[0].can_icr_number != '-' %}*/
/*                         <p class="as" style="color:red;" >*/
/*                             {{canine[0].can_a_s}}*/
/*                         </p>*/
/*                         {% else %}*/
/*                         <p class="as2" style="color:white;" >*/
/*                             {{canine[0].can_a_s}}*/
/*                         </p>*/
/*                     {% endif %}*/
/* */
/* */
/*                         <!-- </p> -->*/
/*                         <p class="white" style="margin-top:34px;">*/
/*                           {{canine[0].can_icr_number}}*/
/*                         </p>*/
/*                     {% endif %}*/
/*                     <p class="white" style="margin-top: -13px;*/
/*                                             margin-bottom: 6px;">{{canine[0].can_breed}}</p>*/
/*                     <p  class="white"  >*/
/*                         {{canine[0].can_gender}}*/
/*                     </p>*/
/*                     <p class="white" style="margin-top:-12px;">*/
/*                         {{canine[0].can_color}}*/
/*                     </p>*/
/*                     <p class="white" style="margin-top:-13px;">*/
/*                         {{canine[0].can_date_of_birth|date('F')}} {{canine[0].can_date_of_birth|date('d')}}{% if canine[0].can_date_of_birth|date('d') == 1 %}st,{% elseif canine[0].can_date_of_birth|date('d') == 2 %}rd,{% elseif canine[0].can_date_of_birth|date('d') == 3 %}rd,{% else %}th,{% endif %} {{canine[0].can_date_of_birth|date('Y')}}*/
/*                     </p>*/
/*                     <br>*/
/*                     <p class="white" style="margin-top:-15px;">*/
/*                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{canine[0].can_icr_moc_number}}*/
/*                     </p>*/
/*                     {% if canine[0].sire %}*/
/*                       {% for sire in canine[0].sire %}*/
/*                         {% if sire %}*/
/* */
/*                                 {% if sire.can_icr_number != '-' %}*/
/*                                         {% if sire.sire_as_count > 5 %}*/
/*                                           <p class="sire"style="margin-top: 34px; color:red; font-size: 13px; margin-bottom: 20px;">*/
/*                                               {{sire.can_a_s}}*/
/*                                           </p>*/
/*                                           {% else %}*/
/*                                           <!-- ini yg ditambahkan -->*/
/*                                           <p class="sire"style="margin-top: 33px; color:red; font-size: 13px; margin-bottom: 20px;">*/
/*                                               {{sire.can_a_s}}*/
/*                                           </p>*/
/*                                         {% endif %}*/
/* */
/*                                     {% else %}*/
/* */
/*                                         {% if sire.sire_as_count > 5 %}*/
/*                                           <p class="white"style="margin-top: 36px; color:white; font-size: 13px; margin-bottom: 20px;">*/
/*                                               {{sire.can_a_s}}*/
/*                                           </p>*/
/*                                           {% else %}*/
/*                                           <!-- ini yg ditambahkan -->*/
/*                                           <p class="white"style="margin-top: 33px; color:white; font-size: 13px; margin-bottom: 20px;">*/
/*                                               {{sire.can_a_s}}*/
/*                                           </p>*/
/*                                         {% endif %}*/
/* */
/*                                 {% endif %}*/
/* */
/* */
/* */
/* */
/*                               <p class="white" style="margin-top:-11.5px;">*/
/*                                   {{sire.can_icr_number}}*/
/*                               </p>*/
/*                             {% else %}*/
/*                               <p class="white"style="margin-top: 33px; color:white;">*/
/*                                 -*/
/*                               </p>*/
/*                               <p class="white" style="margin-top:-11.5px;">*/
/*                                 -*/
/*                               </p>*/
/*                         {% endif %}*/
/*                       {% endfor %}*/
/*                     {% else %}*/
/*                         <p class="sire"style="margin-top: 33px; color:red">*/
/*                           -*/
/*                         </p>*/
/*                         <p class="white" style="margin-top:-11.5px;">*/
/*                           -*/
/*                         </p>*/
/*                     {% endif %}*/
/* */
/*                     {% if canine[0].dam %}*/
/*                       {% for dam in canine[0].dam %}*/
/*                         {% if dam %}*/
/* */
/*                               {% if dam.can_icr_number != '-' %}*/
/*                                       {% if dam.dam_as_count > 5 %}*/
/*                                         <p class="dam" style="margin-top: -10px; color:red; font-size: 13px; margin-bottom: 24px;">*/
/*                                             {{dam.can_a_s}}*/
/*                                         </p>*/
/*                                         {% else %}*/
/*                                         <!-- ini tes -->*/
/*                                         <p class="dam" style="margin-top:-15px;color:red; font-size: 13px; margin-bottom: 24px;">*/
/*                                             {{dam.can_a_s}}*/
/*                                         </p>*/
/*                                       {% endif %}*/
/* */
/*                                   {% else %}*/
/* */
/*                                   {% if dam.dam_as_count > 5 %}*/
/*                                     <p class="white" style="margin-top: -10px; color:white; font-size: 13px; margin-bottom: 24px;">*/
/*                                         {{dam.can_a_s}}*/
/*                                     </p>*/
/*                                     {% else %}*/
/*                                     <!-- ini tes -->*/
/*                                     <p class="white" style="margin-top:-15px;color:white; font-size: 13px; margin-bottom: 24px;">*/
/*                                         {{dam.can_a_s}}*/
/*                                     </p>*/
/*                                   {% endif %}*/
/* */
/*                               {% endif %}*/
/* */
/* */
/*                               <p class="white" style="margin-top:-15px;">*/
/*                                   {{dam.can_icr_number}}*/
/*                               </p>*/
/*                             {% else %}*/
/*                               <p class="dam"style="margin-top: -15px; color:red">*/
/*                                 -*/
/*                               </p>*/
/*                               <p class="white" style="margin-top:-15px;">*/
/*                                 -*/
/*                               </p>*/
/*                         {% endif %}*/
/*                       {% endfor %}*/
/*                     {% else %}*/
/*                       <p class="dam"style="margin-top: -15px; color:red">*/
/*                         -*/
/*                       </p>*/
/*                       <p class="white" style="margin-top:-15px;">*/
/*                         -*/
/*                       </p>*/
/*                     {% endif %}*/
/* */
/*                     <!-- <p style="margin-top:-11px;color:red;">*/
/*                         PR.ARSENAL*/
/*                     </p>*/
/*                     <p class="sire"style="margin-top:-11px;">*/
/*                         16-D-09*/
/*                     </p> -->*/
/*                       </div>*/
/* */
/* */
/*                   <div  style="margin-top: 127px;margin-left: 45px;width: 450px;">*/
/*                     <center>*/
/*                       <h4 class="white" style="font-size: 22px;">{{canine[0].can_owner}}</h4>*/
/*                       <h5 class="white" style="font-size: 16px;">{{canine[0].can_address}}</h5>*/
/*                     </center>*/
/*                   </div>*/
/* */
/*               </div>*/
/* */
/* */
/*               <div class="col-xs-12 isi_surat">*/
/*                 <!-- <br><br><br> -->*/
/* */
/* */
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/*                 <br class="hidden-print">*/
/* */
/*               </div>*/
/*               <div class="clearfix hidden-print"></div>*/
/*               <hr class="hidden-print hidden-print">*/
/* */
/*               <button class="btn btn-primary pull-right hidden-print" onclick="_print(this)" title="Cetak Sertifikat"><i class="si si-printer"></i>&nbsp;&nbsp;Cetak Sertifikat Depan</button>*/
/* */
/*               <a href="{{base_url()}}backend/certificate/belakang/{{canine[0].can_id}}" class="btn btn-primary btn-done pull-right hidden-print" title="cetak sertifikat Belakang" style="margin-right:10px; display:none"><i class="si si-printer"></i>&nbsp;&nbsp;Cetak Sertifikat Belakang</a>*/
/*               <div class="clearfix hidden-print"></div>*/
/*               <br class="hidden-print">*/
/*             </div>*/
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
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_section_detail.js"></script>*/
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
