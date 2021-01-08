<?php

/* front/family_tree.twig */
class __TwigTemplate_203348a30db49505d59549772f52fadf05806c42bc75c7b63eb2963210b63960 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 3
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/family_tree.twig", 3);
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
<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css\" />
<link href=\"";
        // line 12
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/css/primitives.latest.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<style media=\"screen\">
.bp-title {
  text-overflow: ellipsis;
  -o-text-overflow: ellipsis;
  white-space: nowrap;
  font-size: 10px;
  line-height: 16px;
  color: white;
  padding: 0;
}

input{
  margin-top: 0px;
  /*border-color: #B4B1B1;*/
}
#prefetch input:focus{
  /*color: #646464;*/
  color: #222;
  /*border: 1px solid #CB3838;*/
  border-radius: 3px;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-transition: all 0.15s ease-out;
  transition: all 0.15s ease-out;
}
#prefetch .empty-message{
  padding: 5px 10px;
  text-align: center;
  width: auto;

}

.twitter-typeahead{
  /*width: auto;*/
  display: block !important;
}
.tt-menu{
  width: 100%;
  border: .2px solid grey;
  margin-top: 5px;
  border-radius: 3px;
  /*box-shadow: 1px 1px gray;*/
}

/*.tt-dataset .tt-selectable:hover{
background-color: gray !important;
}*/

.tt-dataset{
  display: block; overflow:auto;
  width: auto;
  max-height: 120px;
  overflow-y: auto;
  /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
  -webkit-overflow-scrolling: touch;

}
.eac-item{
  width: auto;
}
.eac-item ul img{
  margin-bottom: 10px;
  clear: both;
}
.card {
    /* Add shadows to create the \"card\" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 120px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

// ARTechnology
.containerCard {
  padding: 2px;
}

.hero-banner{
  background-color: black !important;
}

.medium{
  font-size: medium;
  color: white;
}

.small{
  font-size: small;
  color: #CDCDCD;
}

.middle-center{
  text-align: center !important;
  vertical-align: middle !important;
}
// ARTechnology

/*#basicdiagram{
  overflow:auto;
  overflow-y: auto;
}*/

.bg-info {
    background-color: #000000 !important;
}

</style>
";
    }

    // line 126
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 128
    public function block_header($context, array $blocks = array())
    {
        // line 129
        echo "
";
    }

    // line 132
    public function block_content($context, array $blocks = array())
    {
        // line 133
        echo "
<section class=\"hero-banner\">
  <div class=\"container-fluid \">
    <!-- <div class=\"block\"> -->
        <div >
            <!-- ARTechnology --> 
            <h3 style=\"color:white; text-align:center;\" > Silsilah Anjing</h3>
            <!-- ARTechnology -->
        </div>
        <div class=\"block-content\" style=\"background-color:black;overflow-y: auto; padding:10px; border-radius:0px;\">
          <table class=\"table table-bordered table-responsive \">
              <tr>
                  <!-- ARTechnology -->
                  <td colspan=\"4\" align=\"right\">
                    <div class=\"card\">
                    <center>
                      ";
        // line 149
        if (($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_photo", array()) == "-")) {
            // line 150
            echo "                          <img src=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                          ";
        } else {
            // line 152
            echo "                          <img src=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "uploads/canine/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_photo", array()), "html", null, true);
            echo "\" width=\"120px\" alt=\"\" />
                      ";
        }
        // line 154
        echo "                      <div class=\"containerCard\">
                        
                        <div><div class=\"medium\"><b>";
        // line 156
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
        echo "</b></div>
                        <div class=\"small\">
                          ";
        // line 158
        if ($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_moc_number", array())) {
            // line 159
            echo "                            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
            echo "
                            ";
        } else {
            // line 161
            echo "                                -
                          ";
        }
        // line 163
        echo "                          </div>
                          <div class=\"small\">
                          ";
        // line 165
        if ($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_owner", array())) {
            // line 166
            echo "                            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_owner", array()), "html", null, true);
            echo "
                            ";
        } else {
            // line 168
            echo "                                -
                          ";
        }
        // line 170
        echo "                          </div>
                        </div>
                      </div>
                    </center>  
                    </div>
                  </td>
                  <td colspan=\"4\" class=\"middle-center\">
                    <div class=\"small\">";
        // line 177
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_note", array()), "html", null, true);
        echo "</div>
                  </td>
                  <!-- ARTechnology -->
              </tr>
              <tr>
                  <td colspan=\"4\">
                    ";
        // line 183
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 184
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 186
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 187
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 189
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 191
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 193
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 195
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 196
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 198
                echo "                                    -
                              ";
            }
            // line 200
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 202
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 203
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 205
                echo "                                    -
                              ";
            }
            // line 207
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 214
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 216
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <!-- <img src=\"";
            // line 217
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "uploads/canine/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
            echo "\" width=\"120px\" alt=\"\" /> -->
                        <div class=\"containerCard\">
                          <p><b>NO F</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 225
        echo "
                  </td>
                  <td colspan=\"4\">
                    ";
        // line 228
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 229
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 231
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 232
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 234
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 236
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 238
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 240
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 241
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 243
                echo "                                    -
                              ";
            }
            // line 245
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 247
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 248
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 250
                echo "                                    -
                              ";
            }
            // line 252
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 259
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 261
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO M</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 269
        echo "                  </td>
              </tr>


              <tr>
                <!-- father -->
                  <td colspan=\"2\">
                    ";
        // line 276
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 277
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 279
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 280
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 282
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 284
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 286
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 288
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 289
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 291
                echo "                                    -
                              ";
            }
            // line 293
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 295
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 296
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 298
                echo "                                    -
                              ";
            }
            // line 300
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 307
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 309
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO F</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 317
        echo "                  </td>
                  <td colspan=\"2\">
                    ";
        // line 319
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 320
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 322
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 323
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 325
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 327
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 329
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 331
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 332
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 334
                echo "                                    -
                              ";
            }
            // line 336
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 338
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 339
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 341
                echo "                                    -
                              ";
            }
            // line 343
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 350
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 352
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO M</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 360
        echo "                  </td>
                  <!-- ==============================================================================================================  -->
                  <!-- mom -->
                  <td colspan=\"2\">
                    ";
        // line 364
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 365
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 367
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 368
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 370
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 372
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 374
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 376
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 377
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 379
                echo "                                    -
                              ";
            }
            // line 381
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 383
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 384
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 386
                echo "                                    -
                              ";
            }
            // line 388
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 395
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 397
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO F</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 405
        echo "                  </td>
                  <td colspan=\"2\">
                    ";
        // line 407
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 408
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 410
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 411
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 413
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 415
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 417
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 419
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 420
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 422
                echo "                                    -
                              ";
            }
            // line 424
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 426
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 427
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 429
                echo "                                    -
                              ";
            }
            // line 431
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 438
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 440
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO M</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 448
        echo "                  </td>

              </tr>


              <!--================================  -->
              <tr>
                <td>
                  ";
        // line 456
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 457
            echo "                    <center>
                      <div class=\"card\">
                        ";
            // line 459
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 460
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                            ";
            } else {
                // line 462
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                        ";
            }
            // line 464
            echo "                        <!-- ARTechnology -->
                        <div class=\"containerCard\">
                          <div><div class=\"medium\"><b>";
            // line 466
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                            <div class=\"small\">
                            ";
            // line 468
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 469
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 471
                echo "                                  -
                            ";
            }
            // line 473
            echo "                            </div>
                            <div class=\"small\">
                            ";
            // line 475
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 476
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 478
                echo "                                  -
                            ";
            }
            // line 480
            echo "                            </div>
                          </div>
                        </div>
                        <!-- ARTechnology -->
                      </div>
                    </center>
                  ";
        } else {
            // line 487
            echo "                  <center>
                    <div class=\"card\">
                      <img src=\"";
            // line 489
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                      <div class=\"containerCard\">
                        <p><b>NO F</b>
                        </p>
                      </div>
                    </div>
                  </center>
                  ";
        }
        // line 497
        echo "                </td>
                <td>
                  ";
        // line 499
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 500
            echo "                    <center>
                      <div class=\"card\">
                        ";
            // line 502
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 503
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                            ";
            } else {
                // line 505
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                        ";
            }
            // line 507
            echo "                        <!-- ARTechnology -->
                        <div class=\"containerCard\">
                          <div><div class=\"medium\"><b>";
            // line 509
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                            <div class=\"small\">
                            ";
            // line 511
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 512
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 514
                echo "                                  -
                            ";
            }
            // line 516
            echo "                            </div>
                            <div class=\"small\">
                            ";
            // line 518
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 519
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 521
                echo "                                  -
                            ";
            }
            // line 523
            echo "                            </div>
                          </div>
                        </div>
                        <!-- ARTechnology -->
                      </div>
                    </center>
                  ";
        } else {
            // line 530
            echo "                  <center>
                    <div class=\"card\">
                      <img src=\"";
            // line 532
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                      <div class=\"containerCard\">
                        <p><b>NO M</b>
                        </p>
                      </div>
                    </div>
                  </center>
                  ";
        }
        // line 540
        echo "                </td>
                <!-- sire sire sire-->
                <td>
                  ";
        // line 543
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 544
            echo "                    <center>
                      <div class=\"card\">
                        ";
            // line 546
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 547
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                            ";
            } else {
                // line 549
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                        ";
            }
            // line 551
            echo "                        <!-- ARTechnology -->
                        <div class=\"containerCard\">
                          <div><div class=\"medium\"><b>";
            // line 553
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                            <div class=\"small\">
                            ";
            // line 555
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 556
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 558
                echo "                                  -
                            ";
            }
            // line 560
            echo "                            </div>
                            <div class=\"small\">
                            ";
            // line 562
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 563
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 565
                echo "                                  -
                            ";
            }
            // line 567
            echo "                            </div>
                          </div>
                        </div>
                        <!-- ARTechnology -->
                      </div>
                    </center>
                  ";
        } else {
            // line 574
            echo "                  <center>
                    <div class=\"card\">
                      <img src=\"";
            // line 576
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                      <div class=\"containerCard\">
                        <p><b>NO F</b>
                        </p>
                      </div>
                    </div>
                  </center>
                  ";
        }
        // line 584
        echo "                </td>
                <td>
                  ";
        // line 586
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 587
            echo "                    <center>
                      <div class=\"card\">
                        ";
            // line 589
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 590
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                            ";
            } else {
                // line 592
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                        ";
            }
            // line 594
            echo "                        <!-- ARTechnology -->
                        <div class=\"containerCard\">
                          <div><div class=\"medium\"><b>";
            // line 596
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                            <div class=\"small\">
                            ";
            // line 598
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 599
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 601
                echo "                                  -
                            ";
            }
            // line 603
            echo "                            </div>
                            <div class=\"small\">
                            ";
            // line 605
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 606
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 608
                echo "                                  -
                            ";
            }
            // line 610
            echo "                            </div>
                          </div>
                        </div>
                        <!-- ARTechnology -->
                      </div>
                    </center>
                  ";
        } else {
            // line 617
            echo "                  <center>
                    <div class=\"card\">
                      <img src=\"";
            // line 619
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                      <div class=\"containerCard\">
                        <p><b>NO M</b>
                        </p>
                      </div>
                    </div>
                  </center>
                  ";
        }
        // line 627
        echo "                </td>
                <!-- sire sire mom -->

                  <td>
                    ";
        // line 631
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 632
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 634
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 635
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 637
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 639
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 641
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 643
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 644
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 646
                echo "                                    -
                              ";
            }
            // line 648
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 650
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 651
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 653
                echo "                                    -
                              ";
            }
            // line 655
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 662
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 664
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO F</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 672
        echo "                  </td>
                  <td>
                    ";
        // line 674
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 675
            echo "                      <center>
                        <div class=\"card\">
                          ";
            // line 677
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 678
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                              ";
            } else {
                // line 680
                echo "                              <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                          ";
            }
            // line 682
            echo "                          <!-- ARTechnology -->
                          <div class=\"containerCard\">
                            <div><div class=\"medium\"><b>";
            // line 684
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                              <div class=\"small\">
                              ";
            // line 686
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 687
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 689
                echo "                                    -
                              ";
            }
            // line 691
            echo "                              </div>
                              <div class=\"small\">
                              ";
            // line 693
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 694
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 696
                echo "                                    -
                              ";
            }
            // line 698
            echo "                              </div>
                            </div>
                          </div>
                          <!-- ARTechnology -->
                        </div>
                      </center>
                    ";
        } else {
            // line 705
            echo "                    <center>
                      <div class=\"card\">
                        <img src=\"";
            // line 707
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                        <div class=\"containerCard\">
                          <p><b>NO M</b>
                          </p>
                        </div>
                      </div>
                    </center>
                    ";
        }
        // line 715
        echo "                  </td>

                <!-- mom mom sire -->
                <td>
                  ";
        // line 719
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 720
            echo "                    <center>
                      <div class=\"card\">
                        ";
            // line 722
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 723
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                            ";
            } else {
                // line 725
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                        ";
            }
            // line 727
            echo "                        <!-- ARTechnology -->
                        <div class=\"containerCard\">
                          <div><div class=\"medium\"><b>";
            // line 729
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                            <div class=\"small\">
                            ";
            // line 731
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 732
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 734
                echo "                                  -
                            ";
            }
            // line 736
            echo "                            </div>
                            <div class=\"small\">
                            ";
            // line 738
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array())) {
                // line 739
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 741
                echo "                                  -
                            ";
            }
            // line 743
            echo "                            </div>
                          </div>
                        </div>
                        <!-- ARTechnology -->
                      </div>
                    </center>
                  ";
        } else {
            // line 750
            echo "                  <center>
                    <div class=\"card\">
                      <img src=\"";
            // line 752
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                      <div class=\"containerCard\">
                        <p><b>NO F</b>
                        </p>
                      </div>
                    </div>
                  </center>
                  ";
        }
        // line 760
        echo "                </td>
                <td>
                  ";
        // line 762
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 763
            echo "                    <center>
                      <div class=\"card\">
                        ";
            // line 765
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 766
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"120px\" height=\"105px\" alt=\"\" />
                            ";
            } else {
                // line 768
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"120px\" alt=\"\" />
                        ";
            }
            // line 770
            echo "                        <!-- ARTechnology -->
                        <div class=\"containerCard\">
                          <div><div class=\"medium\"><b>";
            // line 772
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b></div>
                            <div class=\"small\">
                            ";
            // line 774
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array())) {
                // line 775
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_icr_moc_number", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 777
                echo "                                  -
                            ";
            }
            // line 779
            echo "                            </div>
                            <div class=\"small\">
                            ";
            // line 781
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array())) {
                // line 782
                echo "                              ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_owner", array()), "html", null, true);
                echo "
                              ";
            } else {
                // line 784
                echo "                                  -
                            ";
            }
            // line 786
            echo "                            </div>
                          </div>
                        </div>
                        <!-- ARTechnology -->
                      </div>
                    </center>
                  ";
        } else {
            // line 793
            echo "                  <center>
                    <div class=\"card\">
                      <img src=\"";
            // line 795
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"120px\"  height=\"105px\" alt=\"\" />
                      <div class=\"containerCard\">
                        <p><b>NO M</b>
                        </p>
                      </div>
                    </div>
                  </center>
                  ";
        }
        // line 803
        echo "                </td>
                <!-- mom mom mom -->

              </tr>
          </table>

        </div>
    <!-- </div> -->

  </div>
</section>



<input type=\"hidden\" value=\"";
        // line 817
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"";
        // line 818
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), "can_id", array()), "html", null, true);
        echo "\" class=\"can_id\" />
";
    }

    // line 821
    public function block_scripts($context, array $blocks = array())
    {
        // line 822
        echo "<script src=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.slimscroll.min.js\"></script>
<script src=\"";
        // line 823
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.scrollLock.min.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 824
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/jquery/jquery-1.9.1.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 825
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/jquery/jquery-ui-1.10.2.custom.min.js\"></script>
<script  type=\"text/javascript\" src=\"";
        // line 826
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/primitives.min.js\"></script>

<script>
\$(function () {
    // Init page helpers (SlimScroll plugin)
    App.initHelpers('slimscroll');
});

var can_id = \$('.can_id').val();
var base_url = \$('.base_url').val();

\$(window).load(function () {

    \$.get(base_url+'pedigrees/cid/'+can_id, function(res) {
      res = \$.parseJSON(res);

      var options = new primitives.orgdiagram.Config();

        var item = [];
        var canines = res;
        canines.forEach(function(v, i){
          var newItem = new primitives.famdiagram.ItemConfig(
            {
                id: v.id,
                parent: v.parent,
                title: v.can_a_s,
                description: v.can_date_of_birth,
                image: base_url+'uploads/canine/'+v.can_photo,
            });

            item.push(newItem);

        })

        var items = item;
        options.items = items;
        options.cursorItem = 0;
        options.hasSelectorCheckbox = primitives.common.Enabled.False;
        // delete items[0];
        jQuery(\"#basicdiagram\").orgDiagram(options);
      });
});
</script>
";
    }

    public function getTemplateName()
    {
        return "front/family_tree.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1570 => 826,  1566 => 825,  1562 => 824,  1558 => 823,  1553 => 822,  1550 => 821,  1544 => 818,  1540 => 817,  1524 => 803,  1513 => 795,  1509 => 793,  1500 => 786,  1496 => 784,  1490 => 782,  1488 => 781,  1484 => 779,  1480 => 777,  1474 => 775,  1472 => 774,  1467 => 772,  1463 => 770,  1455 => 768,  1449 => 766,  1447 => 765,  1443 => 763,  1441 => 762,  1437 => 760,  1426 => 752,  1422 => 750,  1413 => 743,  1409 => 741,  1403 => 739,  1401 => 738,  1397 => 736,  1393 => 734,  1387 => 732,  1385 => 731,  1380 => 729,  1376 => 727,  1368 => 725,  1362 => 723,  1360 => 722,  1356 => 720,  1354 => 719,  1348 => 715,  1337 => 707,  1333 => 705,  1324 => 698,  1320 => 696,  1314 => 694,  1312 => 693,  1308 => 691,  1304 => 689,  1298 => 687,  1296 => 686,  1291 => 684,  1287 => 682,  1279 => 680,  1273 => 678,  1271 => 677,  1267 => 675,  1265 => 674,  1261 => 672,  1250 => 664,  1246 => 662,  1237 => 655,  1233 => 653,  1227 => 651,  1225 => 650,  1221 => 648,  1217 => 646,  1211 => 644,  1209 => 643,  1204 => 641,  1200 => 639,  1192 => 637,  1186 => 635,  1184 => 634,  1180 => 632,  1178 => 631,  1172 => 627,  1161 => 619,  1157 => 617,  1148 => 610,  1144 => 608,  1138 => 606,  1136 => 605,  1132 => 603,  1128 => 601,  1122 => 599,  1120 => 598,  1115 => 596,  1111 => 594,  1103 => 592,  1097 => 590,  1095 => 589,  1091 => 587,  1089 => 586,  1085 => 584,  1074 => 576,  1070 => 574,  1061 => 567,  1057 => 565,  1051 => 563,  1049 => 562,  1045 => 560,  1041 => 558,  1035 => 556,  1033 => 555,  1028 => 553,  1024 => 551,  1016 => 549,  1010 => 547,  1008 => 546,  1004 => 544,  1002 => 543,  997 => 540,  986 => 532,  982 => 530,  973 => 523,  969 => 521,  963 => 519,  961 => 518,  957 => 516,  953 => 514,  947 => 512,  945 => 511,  940 => 509,  936 => 507,  928 => 505,  922 => 503,  920 => 502,  916 => 500,  914 => 499,  910 => 497,  899 => 489,  895 => 487,  886 => 480,  882 => 478,  876 => 476,  874 => 475,  870 => 473,  866 => 471,  860 => 469,  858 => 468,  853 => 466,  849 => 464,  841 => 462,  835 => 460,  833 => 459,  829 => 457,  827 => 456,  817 => 448,  806 => 440,  802 => 438,  793 => 431,  789 => 429,  783 => 427,  781 => 426,  777 => 424,  773 => 422,  767 => 420,  765 => 419,  760 => 417,  756 => 415,  748 => 413,  742 => 411,  740 => 410,  736 => 408,  734 => 407,  730 => 405,  719 => 397,  715 => 395,  706 => 388,  702 => 386,  696 => 384,  694 => 383,  690 => 381,  686 => 379,  680 => 377,  678 => 376,  673 => 374,  669 => 372,  661 => 370,  655 => 368,  653 => 367,  649 => 365,  647 => 364,  641 => 360,  630 => 352,  626 => 350,  617 => 343,  613 => 341,  607 => 339,  605 => 338,  601 => 336,  597 => 334,  591 => 332,  589 => 331,  584 => 329,  580 => 327,  572 => 325,  566 => 323,  564 => 322,  560 => 320,  558 => 319,  554 => 317,  543 => 309,  539 => 307,  530 => 300,  526 => 298,  520 => 296,  518 => 295,  514 => 293,  510 => 291,  504 => 289,  502 => 288,  497 => 286,  493 => 284,  485 => 282,  479 => 280,  477 => 279,  473 => 277,  471 => 276,  462 => 269,  451 => 261,  447 => 259,  438 => 252,  434 => 250,  428 => 248,  426 => 247,  422 => 245,  418 => 243,  412 => 241,  410 => 240,  405 => 238,  401 => 236,  393 => 234,  387 => 232,  385 => 231,  381 => 229,  379 => 228,  374 => 225,  361 => 217,  357 => 216,  353 => 214,  344 => 207,  340 => 205,  334 => 203,  332 => 202,  328 => 200,  324 => 198,  318 => 196,  316 => 195,  311 => 193,  307 => 191,  299 => 189,  293 => 187,  291 => 186,  287 => 184,  285 => 183,  276 => 177,  267 => 170,  263 => 168,  257 => 166,  255 => 165,  251 => 163,  247 => 161,  241 => 159,  239 => 158,  234 => 156,  230 => 154,  222 => 152,  216 => 150,  214 => 149,  196 => 133,  193 => 132,  188 => 129,  185 => 128,  179 => 126,  62 => 12,  58 => 11,  54 => 10,  50 => 9,  46 => 8,  43 => 7,  40 => 6,  33 => 4,  11 => 3,);
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
/* <link rel="stylesheet" href="{{base_url()}}assets/primitive/demo/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" />*/
/* <link href="{{base_url()}}assets/primitive/demo/css/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />*/
/* <style media="screen">*/
/* .bp-title {*/
/*   text-overflow: ellipsis;*/
/*   -o-text-overflow: ellipsis;*/
/*   white-space: nowrap;*/
/*   font-size: 10px;*/
/*   line-height: 16px;*/
/*   color: white;*/
/*   padding: 0;*/
/* }*/
/* */
/* input{*/
/*   margin-top: 0px;*/
/*   /*border-color: #B4B1B1;*//* */
/* }*/
/* #prefetch input:focus{*/
/*   /*color: #646464;*//* */
/*   color: #222;*/
/*   /*border: 1px solid #CB3838;*//* */
/*   border-radius: 3px;*/
/*   -webkit-box-shadow: none;*/
/*   box-shadow: none;*/
/*   -webkit-transition: all 0.15s ease-out;*/
/*   transition: all 0.15s ease-out;*/
/* }*/
/* #prefetch .empty-message{*/
/*   padding: 5px 10px;*/
/*   text-align: center;*/
/*   width: auto;*/
/* */
/* }*/
/* */
/* .twitter-typeahead{*/
/*   /*width: auto;*//* */
/*   display: block !important;*/
/* }*/
/* .tt-menu{*/
/*   width: 100%;*/
/*   border: .2px solid grey;*/
/*   margin-top: 5px;*/
/*   border-radius: 3px;*/
/*   /*box-shadow: 1px 1px gray;*//* */
/* }*/
/* */
/* /*.tt-dataset .tt-selectable:hover{*/
/* background-color: gray !important;*/
/* }*//* */
/* */
/* .tt-dataset{*/
/*   display: block; overflow:auto;*/
/*   width: auto;*/
/*   max-height: 120px;*/
/*   overflow-y: auto;*/
/*   /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*//* */
/*   -webkit-overflow-scrolling: touch;*/
/* */
/* }*/
/* .eac-item{*/
/*   width: auto;*/
/* }*/
/* .eac-item ul img{*/
/*   margin-bottom: 10px;*/
/*   clear: both;*/
/* }*/
/* .card {*/
/*     /* Add shadows to create the "card" effect *//* */
/*     box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
/*     transition: 0.3s;*/
/*     width: 120px;*/
/* }*/
/* */
/* /* On mouse-over, add a deeper shadow *//* */
/* .card:hover {*/
/*     box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);*/
/* }*/
/* */
/* // ARTechnology*/
/* .containerCard {*/
/*   padding: 2px;*/
/* }*/
/* */
/* .hero-banner{*/
/*   background-color: black !important;*/
/* }*/
/* */
/* .medium{*/
/*   font-size: medium;*/
/*   color: white;*/
/* }*/
/* */
/* .small{*/
/*   font-size: small;*/
/*   color: #CDCDCD;*/
/* }*/
/* */
/* .middle-center{*/
/*   text-align: center !important;*/
/*   vertical-align: middle !important;*/
/* }*/
/* // ARTechnology*/
/* */
/* /*#basicdiagram{*/
/*   overflow:auto;*/
/*   overflow-y: auto;*/
/* }*//* */
/* */
/* .bg-info {*/
/*     background-color: #000000 !important;*/
/* }*/
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
/* */
/* <section class="hero-banner">*/
/*   <div class="container-fluid ">*/
/*     <!-- <div class="block"> -->*/
/*         <div >*/
/*             <!-- ARTechnology --> */
/*             <h3 style="color:white; text-align:center;" > Silsilah Anjing</h3>*/
/*             <!-- ARTechnology -->*/
/*         </div>*/
/*         <div class="block-content" style="background-color:black;overflow-y: auto; padding:10px; border-radius:0px;">*/
/*           <table class="table table-bordered table-responsive ">*/
/*               <tr>*/
/*                   <!-- ARTechnology -->*/
/*                   <td colspan="4" align="right">*/
/*                     <div class="card">*/
/*                     <center>*/
/*                       {% if canine[0].can_photo == '-' %}*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                           {% else %}*/
/*                           <img src="{{base_url()}}uploads/canine/{{canine[0].can_photo}}" width="120px" alt="" />*/
/*                       {% endif %}*/
/*                       <div class="containerCard">*/
/*                         */
/*                         <div><div class="medium"><b>{{canine[0].can_a_s}}</b></div>*/
/*                         <div class="small">*/
/*                           {% if canine[0].can_icr_moc_number %}*/
/*                             {{canine[0].can_icr_moc_number}}*/
/*                             {% else %}*/
/*                                 -*/
/*                           {% endif %}*/
/*                           </div>*/
/*                           <div class="small">*/
/*                           {% if canine[0].can_owner %}*/
/*                             {{canine[0].can_owner}}*/
/*                             {% else %}*/
/*                                 -*/
/*                           {% endif %}*/
/*                           </div>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>  */
/*                     </div>*/
/*                   </td>*/
/*                   <td colspan="4" class="middle-center">*/
/*                     <div class="small">{{canine[0].can_note}}</div>*/
/*                   </td>*/
/*                   <!-- ARTechnology -->*/
/*               </tr>*/
/*               <tr>*/
/*                   <td colspan="4">*/
/*                     {% if canine[0].sire[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].sire[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].sire[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].sire[0].can_icr_moc_number %}*/
/*                                 {{canine[0].sire[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].sire[0].can_owner %}*/
/*                                 {{canine[0].sire[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <!-- <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].can_photo}}" width="120px" alt="" /> -->*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO F</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/* */
/*                   </td>*/
/*                   <td colspan="4">*/
/*                     {% if canine[0].mom[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].mom[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].mom[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].can_icr_moc_number %}*/
/*                                 {{canine[0].mom[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].can_owner %}*/
/*                                 {{canine[0].mom[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO M</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/*               </tr>*/
/* */
/* */
/*               <tr>*/
/*                 <!-- father -->*/
/*                   <td colspan="2">*/
/*                     {% if canine[0].sire[0].sire[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].sire[0].sire[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].sire[0].sire[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].sire[0].sire[0].can_icr_moc_number %}*/
/*                                 {{canine[0].sire[0].sire[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].sire[0].sire[0].can_owner %}*/
/*                                 {{canine[0].sire[0].sire[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO F</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/*                   <td colspan="2">*/
/*                     {% if canine[0].sire[0].mom[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].sire[0].mom[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].sire[0].mom[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].sire[0].mom[0].can_icr_moc_number %}*/
/*                                 {{canine[0].sire[0].mom[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].sire[0].mom[0].can_owner %}*/
/*                                 {{canine[0].sire[0].mom[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO M</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/*                   <!-- ==============================================================================================================  -->*/
/*                   <!-- mom -->*/
/*                   <td colspan="2">*/
/*                     {% if canine[0].mom[0].sire[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].mom[0].sire[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].mom[0].sire[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].sire[0].can_icr_moc_number %}*/
/*                                 {{canine[0].mom[0].sire[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].sire[0].can_owner %}*/
/*                                 {{canine[0].mom[0].sire[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO F</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/*                   <td colspan="2">*/
/*                     {% if canine[0].mom[0].mom[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].mom[0].mom[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].mom[0].mom[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].mom[0].can_icr_moc_number %}*/
/*                                 {{canine[0].mom[0].mom[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].mom[0].can_owner %}*/
/*                                 {{canine[0].mom[0].mom[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO M</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/* */
/*               </tr>*/
/* */
/* */
/*               <!--================================  -->*/
/*               <tr>*/
/*                 <td>*/
/*                   {% if canine[0].sire[0].sire[0].sire[0] != null %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         {% if canine[0].sire[0].sire[0].sire[0].can_photo == '-' %}*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                             {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].sire[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                         {% endif %}*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="containerCard">*/
/*                           <div><div class="medium"><b>{{canine[0].sire[0].sire[0].sire[0].can_a_s}}</b></div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].sire[0].sire[0].can_icr_moc_number %}*/
/*                               {{canine[0].sire[0].sire[0].sire[0].can_icr_moc_number}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].sire[0].sire[0].can_owner %}*/
/*                               {{canine[0].sire[0].sire[0].sire[0].can_owner}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                           </div>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                       </div>*/
/*                     </center>*/
/*                   {% else %}*/
/*                   <center>*/
/*                     <div class="card">*/
/*                       <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                       <div class="containerCard">*/
/*                         <p><b>NO F</b>*/
/*                         </p>*/
/*                       </div>*/
/*                     </div>*/
/*                   </center>*/
/*                   {% endif %}*/
/*                 </td>*/
/*                 <td>*/
/*                   {% if canine[0].sire[0].sire[0].mom[0] != null %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         {% if canine[0].sire[0].sire[0].mom[0].can_photo == '-' %}*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                             {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].sire[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                         {% endif %}*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="containerCard">*/
/*                           <div><div class="medium"><b>{{canine[0].sire[0].sire[0].mom[0].can_a_s}}</b></div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].sire[0].mom[0].can_icr_moc_number %}*/
/*                               {{canine[0].sire[0].sire[0].mom[0].can_icr_moc_number}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].sire[0].mom[0].can_owner %}*/
/*                               {{canine[0].sire[0].sire[0].mom[0].can_owner}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                           </div>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                       </div>*/
/*                     </center>*/
/*                   {% else %}*/
/*                   <center>*/
/*                     <div class="card">*/
/*                       <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                       <div class="containerCard">*/
/*                         <p><b>NO M</b>*/
/*                         </p>*/
/*                       </div>*/
/*                     </div>*/
/*                   </center>*/
/*                   {% endif %}*/
/*                 </td>*/
/*                 <!-- sire sire sire-->*/
/*                 <td>*/
/*                   {% if canine[0].sire[0].mom[0].sire[0] != null %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         {% if canine[0].sire[0].mom[0].sire[0].can_photo == '-' %}*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                             {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].mom[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                         {% endif %}*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="containerCard">*/
/*                           <div><div class="medium"><b>{{canine[0].sire[0].mom[0].sire[0].can_a_s}}</b></div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].mom[0].sire[0].can_icr_moc_number %}*/
/*                               {{canine[0].sire[0].mom[0].sire[0].can_icr_moc_number}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].mom[0].sire[0].can_owner %}*/
/*                               {{canine[0].sire[0].mom[0].sire[0].can_owner}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                           </div>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                       </div>*/
/*                     </center>*/
/*                   {% else %}*/
/*                   <center>*/
/*                     <div class="card">*/
/*                       <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                       <div class="containerCard">*/
/*                         <p><b>NO F</b>*/
/*                         </p>*/
/*                       </div>*/
/*                     </div>*/
/*                   </center>*/
/*                   {% endif %}*/
/*                 </td>*/
/*                 <td>*/
/*                   {% if canine[0].sire[0].mom[0].mom[0] != null %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         {% if canine[0].sire[0].mom[0].mom[0].can_photo == '-' %}*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                             {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].mom[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                         {% endif %}*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="containerCard">*/
/*                           <div><div class="medium"><b>{{canine[0].sire[0].mom[0].mom[0].can_a_s}}</b></div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].mom[0].mom[0].can_icr_moc_number %}*/
/*                               {{canine[0].sire[0].mom[0].mom[0].can_icr_moc_number}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].sire[0].mom[0].mom[0].can_owner %}*/
/*                               {{canine[0].sire[0].mom[0].mom[0].can_owner}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                           </div>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                       </div>*/
/*                     </center>*/
/*                   {% else %}*/
/*                   <center>*/
/*                     <div class="card">*/
/*                       <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                       <div class="containerCard">*/
/*                         <p><b>NO M</b>*/
/*                         </p>*/
/*                       </div>*/
/*                     </div>*/
/*                   </center>*/
/*                   {% endif %}*/
/*                 </td>*/
/*                 <!-- sire sire mom -->*/
/* */
/*                   <td>*/
/*                     {% if canine[0].mom[0].sire[0].sire[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].mom[0].sire[0].sire[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].sire[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].mom[0].sire[0].sire[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].sire[0].sire[0].can_icr_moc_number %}*/
/*                                 {{canine[0].mom[0].sire[0].sire[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].sire[0].sire[0].can_owner %}*/
/*                                 {{canine[0].mom[0].sire[0].sire[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO F</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/*                   <td>*/
/*                     {% if canine[0].mom[0].sire[0].mom[0] != null %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           {% if canine[0].mom[0].sire[0].mom[0].can_photo == '-' %}*/
/*                               <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                               {% else %}*/
/*                               <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].sire[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                           {% endif %}*/
/*                           <!-- ARTechnology -->*/
/*                           <div class="containerCard">*/
/*                             <div><div class="medium"><b>{{canine[0].mom[0].sire[0].mom[0].can_a_s}}</b></div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].sire[0].mom[0].can_icr_moc_number %}*/
/*                                 {{canine[0].mom[0].sire[0].mom[0].can_icr_moc_number}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                               <div class="small">*/
/*                               {% if canine[0].mom[0].sire[0].mom[0].can_owner %}*/
/*                                 {{canine[0].mom[0].sire[0].mom[0].can_owner}}*/
/*                                 {% else %}*/
/*                                     -*/
/*                               {% endif %}*/
/*                               </div>*/
/*                             </div>*/
/*                           </div>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                       </center>*/
/*                     {% else %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                         <div class="containerCard">*/
/*                           <p><b>NO M</b>*/
/*                           </p>*/
/*                         </div>*/
/*                       </div>*/
/*                     </center>*/
/*                     {% endif %}*/
/*                   </td>*/
/* */
/*                 <!-- mom mom sire -->*/
/*                 <td>*/
/*                   {% if canine[0].mom[0].mom[0].sire[0] != null %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         {% if canine[0].mom[0].mom[0].sire[0].can_photo == '-' %}*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                             {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].mom[0].sire[0].can_photo}}" width="120px" alt="" />*/
/*                         {% endif %}*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="containerCard">*/
/*                           <div><div class="medium"><b>{{canine[0].mom[0].mom[0].sire[0].can_a_s}}</b></div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].mom[0].mom[0].sire[0].can_icr_moc_number %}*/
/*                               {{canine[0].mom[0].mom[0].sire[0].can_icr_moc_number}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].mom[0].mom[0].sire[0].can_owner %}*/
/*                               {{canine[0].mom[0].mom[0].sire[0].can_owner}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                           </div>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                       </div>*/
/*                     </center>*/
/*                   {% else %}*/
/*                   <center>*/
/*                     <div class="card">*/
/*                       <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                       <div class="containerCard">*/
/*                         <p><b>NO F</b>*/
/*                         </p>*/
/*                       </div>*/
/*                     </div>*/
/*                   </center>*/
/*                   {% endif %}*/
/*                 </td>*/
/*                 <td>*/
/*                   {% if canine[0].mom[0].mom[0].mom[0] != null %}*/
/*                     <center>*/
/*                       <div class="card">*/
/*                         {% if canine[0].mom[0].mom[0].mom[0].can_photo == '-' %}*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px" height="105px" alt="" />*/
/*                             {% else %}*/
/*                             <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].mom[0].mom[0].can_photo}}" width="120px" alt="" />*/
/*                         {% endif %}*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="containerCard">*/
/*                           <div><div class="medium"><b>{{canine[0].mom[0].mom[0].mom[0].can_a_s}}</b></div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].mom[0].mom[0].mom[0].can_icr_moc_number %}*/
/*                               {{canine[0].mom[0].mom[0].mom[0].can_icr_moc_number}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                             <div class="small">*/
/*                             {% if canine[0].mom[0].mom[0].mom[0].can_owner %}*/
/*                               {{canine[0].mom[0].mom[0].mom[0].can_owner}}*/
/*                               {% else %}*/
/*                                   -*/
/*                             {% endif %}*/
/*                             </div>*/
/*                           </div>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                       </div>*/
/*                     </center>*/
/*                   {% else %}*/
/*                   <center>*/
/*                     <div class="card">*/
/*                       <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="120px"  height="105px" alt="" />*/
/*                       <div class="containerCard">*/
/*                         <p><b>NO M</b>*/
/*                         </p>*/
/*                       </div>*/
/*                     </div>*/
/*                   </center>*/
/*                   {% endif %}*/
/*                 </td>*/
/*                 <!-- mom mom mom -->*/
/* */
/*               </tr>*/
/*           </table>*/
/* */
/*         </div>*/
/*     <!-- </div> -->*/
/* */
/*   </div>*/
/* </section>*/
/* */
/* */
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="{{canine.can_id}}" class="can_id" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <script src="{{base_url()}}assets/oneui/js/core/jquery.slimscroll.min.js"></script>*/
/* <script src="{{base_url()}}assets/oneui/js/core/jquery.scrollLock.min.js"></script>*/
/* <script type="text/javascript" src="{{base_url()}}assets/primitive/demo/js/jquery/jquery-1.9.1.js"></script>*/
/* <script type="text/javascript" src="{{base_url()}}assets/primitive/demo/js/jquery/jquery-ui-1.10.2.custom.min.js"></script>*/
/* <script  type="text/javascript" src="{{base_url()}}assets/primitive/demo/js/primitives.min.js"></script>*/
/* */
/* <script>*/
/* $(function () {*/
/*     // Init page helpers (SlimScroll plugin)*/
/*     App.initHelpers('slimscroll');*/
/* });*/
/* */
/* var can_id = $('.can_id').val();*/
/* var base_url = $('.base_url').val();*/
/* */
/* $(window).load(function () {*/
/* */
/*     $.get(base_url+'pedigrees/cid/'+can_id, function(res) {*/
/*       res = $.parseJSON(res);*/
/* */
/*       var options = new primitives.orgdiagram.Config();*/
/* */
/*         var item = [];*/
/*         var canines = res;*/
/*         canines.forEach(function(v, i){*/
/*           var newItem = new primitives.famdiagram.ItemConfig(*/
/*             {*/
/*                 id: v.id,*/
/*                 parent: v.parent,*/
/*                 title: v.can_a_s,*/
/*                 description: v.can_date_of_birth,*/
/*                 image: base_url+'uploads/canine/'+v.can_photo,*/
/*             });*/
/* */
/*             item.push(newItem);*/
/* */
/*         })*/
/* */
/*         var items = item;*/
/*         options.items = items;*/
/*         options.cursorItem = 0;*/
/*         options.hasSelectorCheckbox = primitives.common.Enabled.False;*/
/*         // delete items[0];*/
/*         jQuery("#basicdiagram").orgDiagram(options);*/
/*       });*/
/* });*/
/* </script>*/
/* {% endblock %}*/
/* */
