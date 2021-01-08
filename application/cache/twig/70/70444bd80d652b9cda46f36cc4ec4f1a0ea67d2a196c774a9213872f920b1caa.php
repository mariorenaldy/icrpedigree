<?php

/* backend/pedigrees.twig */
class __TwigTemplate_8a46c015ac5c8ada6bdcf510549e630d70fa840464a3f5ea00db36a98f0d2b79 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/pedigrees.twig", 1);
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
        echo "
<link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css\" />
<link href=\"";
        // line 6
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

.card {
    /* Add shadows to create the \"card\" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 170px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
// ARTechnology
.containerCard {
    padding: 1px;
}

.small{
  font-size: x-small;
}

.middle-center{
  text-align: center !important;
  vertical-align: middle !important;
}
// ARTechnology
</style>
";
    }

    // line 48
    public function block_body($context, array $blocks = array())
    {
        // line 49
        echo "<div class=\"content wrap-breadcrum\" style=\"margin-top:-10px\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"";
        // line 52
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"link-effect\">Dashboard</a></li>
            <li><a href=\"";
        // line 53
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/canines\" class=\"link-effect\">Canines</a></li>
            <li>Sislsilah</li>
        </ol>
    </div>
</div>

<!-- Main Container -->
<div class=\"content \">
        <div class=\"block\">
            <div class=\"block-header text-center bg-gray-lighter\">
              <!-- ARTechnology -->
              <h4> Silsilah Anjing</h4>
              <!-- ARTechnology -->
            </div>
            <div class=\"block-content\" style=\"overflow-y: auto;\">
              <table class=\"table table-bordered table-responsive \">
                  <tr>
                      <!-- ARTechnology -->
                      <td colspan=\"4\" align=\"right\">
                        <div class=\"card\">
                          <center>
                            ";
        // line 74
        if (($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_photo", array()) == "-")) {
            // line 75
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
        } else {
            // line 77
            echo "                                <img src=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "uploads/canine/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_photo", array()), "html", null, true);
            echo "\" width=\"170px\" alt=\"\" />
                            ";
        }
        // line 79
        echo "                            <div class=\"containerCard\">
                              <p><b>";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_a_s", array()), "html", null, true);
        echo "</b>
                              </p>
                              <p></p>
                            </div>
                          </center>
                        </div>
                      </td>
                      <td colspan=\"4\" class=\"middle-center\">
                        <div class=\"small\">";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "can_note", array()), "html", null, true);
        echo "</div>
                      </td>
                      <!-- ARTechnology -->
                  </tr>
                  <tr>
                      <td colspan=\"4\">
                        ";
        // line 94
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 95
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 97
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 98
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 100
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 102
            echo "
                              <div class=\"containerCard\">
                                <p><b>";
            // line 104
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 110
            echo "                        <center>
                          <div class=\"card\">
                            <!-- <img src=\"";
            // line 112
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "uploads/canine/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
            echo "\" width=\"170px\" alt=\"\" /> -->
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO MALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 122
        echo "
                      </td>
                      <td colspan=\"4\">
                        ";
        // line 125
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 126
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 128
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 129
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 131
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 133
            echo "
                              <div class=\"containerCard\">
                                <p><b>";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 141
            echo "                        <center>
                          <div class=\"card\">
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO FEMALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 152
        echo "                      </td>
                  </tr>


                  <tr>
                    <!-- father -->
                      <td colspan=\"2\">
                        ";
        // line 159
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 160
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 162
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 163
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 165
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 167
            echo "
                              <div class=\"containerCard\">
                                <p><b>";
            // line 169
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 175
            echo "                        <center>
                          <div class=\"card\">
                            <img src=\"";
            // line 177
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO MALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 187
        echo "                      </td>
                      <td colspan=\"2\">
                        ";
        // line 189
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 190
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 192
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 193
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 195
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 197
            echo "                              <div class=\"containerCard\">
                                <p><b>";
            // line 198
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 204
            echo "                        <center>
                          <div class=\"card\">
                            <img src=\"";
            // line 206
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO FEMALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 216
        echo "                      </td>
                      <!-- ==============================================================================================================  -->
                      <!-- mom -->
                      <td colspan=\"2\">
                        ";
        // line 220
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 221
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 223
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 224
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 226
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 228
            echo "                              <div class=\"containerCard\">
                                <p><b>";
            // line 229
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 235
            echo "                        <center>
                          <div class=\"card\">
                            <img src=\"";
            // line 237
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO MALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 247
        echo "                      </td>
                      <td colspan=\"2\">
                        ";
        // line 249
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 250
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 252
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 253
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 255
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 257
            echo "                              <div class=\"containerCard\">
                                <p><b>";
            // line 258
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 264
            echo "                        <center>
                          <div class=\"card\">
                            <img src=\"";
            // line 266
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO FEMALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 276
        echo "                      </td>

                  </tr>


                  <!--================================  -->
                  <tr>
                    <td>
                      ";
        // line 284
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 285
            echo "                        <center>
                          <div class=\"card\">
                            ";
            // line 287
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 288
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
            } else {
                // line 290
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                            ";
            }
            // line 292
            echo "                            <div class=\"containerCard\">
                              <p><b>";
            // line 293
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                              </p>
                            </div>
                          </div>
                        </center>
                      ";
        } else {
            // line 299
            echo "                      <center>
                        <div class=\"card\">
                          <img src=\"";
            // line 301
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                          <div class=\"containerCard\">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                          </div>
                        </div>
                      </center>
                      ";
        }
        // line 311
        echo "                    </td>
                    <td>
                      ";
        // line 313
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 314
            echo "                        <center>
                          <div class=\"card\">
                            ";
            // line 316
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 317
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
            } else {
                // line 319
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                            ";
            }
            // line 321
            echo "                            <div class=\"containerCard\">
                              <p><b>";
            // line 322
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                              </p>
                            </div>
                          </div>
                        </center>
                      ";
        } else {
            // line 328
            echo "                      <center>
                        <div class=\"card\">
                          <img src=\"";
            // line 330
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                          <div class=\"containerCard\">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                          </div>
                        </div>
                      </center>
                      ";
        }
        // line 340
        echo "                    </td>
                    <!-- sire sire sire-->
                    <td>
                      ";
        // line 343
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 344
            echo "                        <center>
                          <div class=\"card\">
                            ";
            // line 346
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 347
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
            } else {
                // line 349
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                            ";
            }
            // line 351
            echo "                            <div class=\"containerCard\">
                              <p><b>";
            // line 352
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                              </p>
                            </div>
                          </div>
                        </center>
                      ";
        } else {
            // line 358
            echo "                      <center>
                        <div class=\"card\">
                          <img src=\"";
            // line 360
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                          <div class=\"containerCard\">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                          </div>
                        </div>
                      </center>
                      ";
        }
        // line 370
        echo "                    </td>
                    <td>
                      ";
        // line 372
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 373
            echo "                        <center>
                          <div class=\"card\">
                            ";
            // line 375
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 376
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
            } else {
                // line 378
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                            ";
            }
            // line 380
            echo "                            <div class=\"containerCard\">
                              <p><b>";
            // line 381
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                              </p>
                            </div>
                          </div>
                        </center>
                      ";
        } else {
            // line 387
            echo "                      <center>
                        <div class=\"card\">
                          <img src=\"";
            // line 389
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                          <div class=\"containerCard\">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                          </div>
                        </div>
                      </center>
                      ";
        }
        // line 399
        echo "                    </td>
                    <!-- sire sire mom -->

                      <td>
                        ";
        // line 403
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 404
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 406
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 407
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 409
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 411
            echo "                              <div class=\"containerCard\">
                                <p><b>";
            // line 412
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 418
            echo "                        <center>
                          <div class=\"card\">
                            <img src=\"";
            // line 420
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO MALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 430
        echo "                      </td>
                      <td>
                        ";
        // line 432
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 433
            echo "                          <center>
                            <div class=\"card\">
                              ";
            // line 435
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 436
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                  ";
            } else {
                // line 438
                echo "                                  <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                              ";
            }
            // line 440
            echo "                              <div class=\"containerCard\">
                                <p><b>";
            // line 441
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                                </p>
                              </div>
                            </div>
                          </center>
                        ";
        } else {
            // line 447
            echo "                        <center>
                          <div class=\"card\">
                            <img src=\"";
            // line 449
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                            <div class=\"containerCard\">
                              <!-- ARTechnology -->
                              <p><b>NO FEMALE</b>
                              <!-- ARTechnology -->
                              </p>
                            </div>
                          </div>
                        </center>
                        ";
        }
        // line 459
        echo "                      </td>

                    <!-- mom mom sire -->
                    <td>
                      ";
        // line 463
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array") != null)) {
            // line 464
            echo "                        <center>
                          <div class=\"card\">
                            ";
            // line 466
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 467
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
            } else {
                // line 469
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                            ";
            }
            // line 471
            echo "                            <div class=\"containerCard\">
                              <p><b>";
            // line 472
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "sire", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                              </p>
                            </div>
                          </div>
                        </center>
                      ";
        } else {
            // line 478
            echo "                      <center>
                        <div class=\"card\">
                          <img src=\"";
            // line 480
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                          <div class=\"containerCard\">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                          </div>
                        </div>
                      </center>
                      ";
        }
        // line 490
        echo "                    </td>
                    <td>
                      ";
        // line 492
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array") != null)) {
            // line 493
            echo "                        <center>
                          <div class=\"card\">
                            ";
            // line 495
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()) == "-")) {
                // line 496
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"170px\" height=\"105px\" alt=\"\" />
                                ";
            } else {
                // line 498
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_photo", array()), "html", null, true);
                echo "\" width=\"170px\" alt=\"\" />
                            ";
            }
            // line 500
            echo "                            <div class=\"containerCard\">
                              <p><b>";
            // line 501
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["canine"]) ? $context["canine"] : null), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "mom", array()), 0, array(), "array"), "can_a_s", array()), "html", null, true);
            echo "</b>
                              </p>
                            </div>
                          </div>
                        </center>
                      ";
        } else {
            // line 507
            echo "                      <center>
                        <div class=\"card\">
                          <img src=\"";
            // line 509
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "assets/oneui/img/avatars/image.png\" width=\"170px\"  height=\"105px\" alt=\"\" />
                          <div class=\"containerCard\">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                          </div>
                        </div>
                      </center>
                      ";
        }
        // line 519
        echo "                    </td>
                    <!-- mom mom mom -->

                  </tr>
              </table>

            </div>
        </div>
</div>

<input type=\"hidden\" value=\"";
        // line 529
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<input type=\"hidden\" value=\"";
        // line 530
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["canines"]) ? $context["canines"] : null), "can_id", array()), "html", null, true);
        echo "\" class=\"can_id\" />
";
    }

    // line 533
    public function block_scripts($context, array $blocks = array())
    {
        // line 534
        echo "<script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/jquery/jquery-1.9.1.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 535
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/jquery/jquery-ui-1.10.2.custom.min.js\"></script>
<script  type=\"text/javascript\" src=\"";
        // line 536
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/primitive/demo/js/primitives.min.js\"></script>

<script>
jQuery(function () {
    \$('#page-container').addClass('sidebar-mini');
});

var can_id = \$('.can_id').val();
var base_url = \$('.base_url').val();

\$(window).load(function () {

    \$.get(base_url+'backend/pedigrees/cid/'+can_id, function(res) {
      res = \$.parseJSON(res);

      var options = new primitives.orgdiagram.Config();

        var item = [];
        var canines = res;
        canines.forEach(function(v, i){
          var newItem = new primitives.orgdiagram.ItemConfig(
            {
                id: v.id,
                parent: v.parent,
                title: v.can_a_s,
                description: v.can_date_of_birth,
                image: base_url+'uploads/canine/'+v.can_photo,
                phone: \"(123) 800-80-80\",
                email: \"joseph@org.com\"
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
        return "backend/pedigrees.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  980 => 536,  976 => 535,  971 => 534,  968 => 533,  962 => 530,  958 => 529,  946 => 519,  933 => 509,  929 => 507,  920 => 501,  917 => 500,  909 => 498,  903 => 496,  901 => 495,  897 => 493,  895 => 492,  891 => 490,  878 => 480,  874 => 478,  865 => 472,  862 => 471,  854 => 469,  848 => 467,  846 => 466,  842 => 464,  840 => 463,  834 => 459,  821 => 449,  817 => 447,  808 => 441,  805 => 440,  797 => 438,  791 => 436,  789 => 435,  785 => 433,  783 => 432,  779 => 430,  766 => 420,  762 => 418,  753 => 412,  750 => 411,  742 => 409,  736 => 407,  734 => 406,  730 => 404,  728 => 403,  722 => 399,  709 => 389,  705 => 387,  696 => 381,  693 => 380,  685 => 378,  679 => 376,  677 => 375,  673 => 373,  671 => 372,  667 => 370,  654 => 360,  650 => 358,  641 => 352,  638 => 351,  630 => 349,  624 => 347,  622 => 346,  618 => 344,  616 => 343,  611 => 340,  598 => 330,  594 => 328,  585 => 322,  582 => 321,  574 => 319,  568 => 317,  566 => 316,  562 => 314,  560 => 313,  556 => 311,  543 => 301,  539 => 299,  530 => 293,  527 => 292,  519 => 290,  513 => 288,  511 => 287,  507 => 285,  505 => 284,  495 => 276,  482 => 266,  478 => 264,  469 => 258,  466 => 257,  458 => 255,  452 => 253,  450 => 252,  446 => 250,  444 => 249,  440 => 247,  427 => 237,  423 => 235,  414 => 229,  411 => 228,  403 => 226,  397 => 224,  395 => 223,  391 => 221,  389 => 220,  383 => 216,  370 => 206,  366 => 204,  357 => 198,  354 => 197,  346 => 195,  340 => 193,  338 => 192,  334 => 190,  332 => 189,  328 => 187,  315 => 177,  311 => 175,  302 => 169,  298 => 167,  290 => 165,  284 => 163,  282 => 162,  278 => 160,  276 => 159,  267 => 152,  254 => 141,  245 => 135,  241 => 133,  233 => 131,  227 => 129,  225 => 128,  221 => 126,  219 => 125,  214 => 122,  199 => 112,  195 => 110,  186 => 104,  182 => 102,  174 => 100,  168 => 98,  166 => 97,  162 => 95,  160 => 94,  151 => 88,  140 => 80,  137 => 79,  129 => 77,  123 => 75,  121 => 74,  97 => 53,  93 => 52,  88 => 49,  85 => 48,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* */
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
/* .card {*/
/*     /* Add shadows to create the "card" effect *//* */
/*     box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
/*     transition: 0.3s;*/
/*     width: 170px;*/
/* }*/
/* */
/* /* On mouse-over, add a deeper shadow *//* */
/* .card:hover {*/
/*     box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);*/
/* }*/
/* */
/* /* Add some padding inside the card container *//* */
/* // ARTechnology*/
/* .containerCard {*/
/*     padding: 1px;*/
/* }*/
/* */
/* .small{*/
/*   font-size: x-small;*/
/* }*/
/* */
/* .middle-center{*/
/*   text-align: center !important;*/
/*   vertical-align: middle !important;*/
/* }*/
/* // ARTechnology*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrum" style="margin-top:-10px">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="{{base_url()}}" class="link-effect">Dashboard</a></li>*/
/*             <li><a href="{{base_url()}}backend/canines" class="link-effect">Canines</a></li>*/
/*             <li>Sislsilah</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* */
/* <!-- Main Container -->*/
/* <div class="content ">*/
/*         <div class="block">*/
/*             <div class="block-header text-center bg-gray-lighter">*/
/*               <!-- ARTechnology -->*/
/*               <h4> Silsilah Anjing</h4>*/
/*               <!-- ARTechnology -->*/
/*             </div>*/
/*             <div class="block-content" style="overflow-y: auto;">*/
/*               <table class="table table-bordered table-responsive ">*/
/*                   <tr>*/
/*                       <!-- ARTechnology -->*/
/*                       <td colspan="4" align="right">*/
/*                         <div class="card">*/
/*                           <center>*/
/*                             {% if canine[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].can_a_s}}</b>*/
/*                               </p>*/
/*                               <p></p>*/
/*                             </div>*/
/*                           </center>*/
/*                         </div>*/
/*                       </td>*/
/*                       <td colspan="4" class="middle-center">*/
/*                         <div class="small">{{canine[0].can_note}}</div>*/
/*                       </td>*/
/*                       <!-- ARTechnology -->*/
/*                   </tr>*/
/*                   <tr>*/
/*                       <td colspan="4">*/
/*                         {% if canine[0].sire[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].sire[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/* */
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].sire[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <!-- <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].can_photo}}" width="170px" alt="" /> -->*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO MALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/* */
/*                       </td>*/
/*                       <td colspan="4">*/
/*                         {% if canine[0].mom[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].mom[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/* */
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].mom[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO FEMALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/*                   </tr>*/
/* */
/* */
/*                   <tr>*/
/*                     <!-- father -->*/
/*                       <td colspan="2">*/
/*                         {% if canine[0].sire[0].sire[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].sire[0].sire[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/* */
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].sire[0].sire[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO MALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/*                       <td colspan="2">*/
/*                         {% if canine[0].sire[0].mom[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].sire[0].mom[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].sire[0].mom[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO FEMALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/*                       <!-- ==============================================================================================================  -->*/
/*                       <!-- mom -->*/
/*                       <td colspan="2">*/
/*                         {% if canine[0].mom[0].sire[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].mom[0].sire[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].mom[0].sire[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO MALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/*                       <td colspan="2">*/
/*                         {% if canine[0].mom[0].mom[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].mom[0].mom[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].mom[0].mom[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO FEMALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/* */
/*                   </tr>*/
/* */
/* */
/*                   <!--================================  -->*/
/*                   <tr>*/
/*                     <td>*/
/*                       {% if canine[0].sire[0].sire[0].sire[0] != null %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             {% if canine[0].sire[0].sire[0].sire[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].sire[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].sire[0].sire[0].sire[0].can_a_s}}</b>*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                       {% else %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                           <div class="containerCard">*/
/*                             <!-- ARTechnology -->*/
/*                             <p><b>NO MALE</b>*/
/*                             <!-- ARTechnology -->*/
/*                             </p>*/
/*                           </div>*/
/*                         </div>*/
/*                       </center>*/
/*                       {% endif %}*/
/*                     </td>*/
/*                     <td>*/
/*                       {% if canine[0].sire[0].sire[0].mom[0] != null %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             {% if canine[0].sire[0].sire[0].mom[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].sire[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].sire[0].sire[0].mom[0].can_a_s}}</b>*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                       {% else %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                           <div class="containerCard">*/
/*                             <!-- ARTechnology -->*/
/*                             <p><b>NO FEMALE</b>*/
/*                             <!-- ARTechnology -->*/
/*                             </p>*/
/*                           </div>*/
/*                         </div>*/
/*                       </center>*/
/*                       {% endif %}*/
/*                     </td>*/
/*                     <!-- sire sire sire-->*/
/*                     <td>*/
/*                       {% if canine[0].sire[0].mom[0].sire[0] != null %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             {% if canine[0].sire[0].mom[0].sire[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].mom[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].sire[0].mom[0].sire[0].can_a_s}}</b>*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                       {% else %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                           <div class="containerCard">*/
/*                             <!-- ARTechnology -->*/
/*                             <p><b>NO MALE</b>*/
/*                             <!-- ARTechnology -->*/
/*                             </p>*/
/*                           </div>*/
/*                         </div>*/
/*                       </center>*/
/*                       {% endif %}*/
/*                     </td>*/
/*                     <td>*/
/*                       {% if canine[0].sire[0].mom[0].mom[0] != null %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             {% if canine[0].sire[0].mom[0].mom[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].sire[0].mom[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].sire[0].mom[0].mom[0].can_a_s}}</b>*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                       {% else %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                           <div class="containerCard">*/
/*                             <!-- ARTechnology -->*/
/*                             <p><b>NO FEMALE</b>*/
/*                             <!-- ARTechnology -->*/
/*                             </p>*/
/*                           </div>*/
/*                         </div>*/
/*                       </center>*/
/*                       {% endif %}*/
/*                     </td>*/
/*                     <!-- sire sire mom -->*/
/* */
/*                       <td>*/
/*                         {% if canine[0].mom[0].sire[0].sire[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].mom[0].sire[0].sire[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].sire[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].mom[0].sire[0].sire[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO MALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/*                       <td>*/
/*                         {% if canine[0].mom[0].sire[0].mom[0] != null %}*/
/*                           <center>*/
/*                             <div class="card">*/
/*                               {% if canine[0].mom[0].sire[0].mom[0].can_photo == '-' %}*/
/*                                   <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                   {% else %}*/
/*                                   <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].sire[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                               {% endif %}*/
/*                               <div class="containerCard">*/
/*                                 <p><b>{{canine[0].mom[0].sire[0].mom[0].can_a_s}}</b>*/
/*                                 </p>*/
/*                               </div>*/
/*                             </div>*/
/*                           </center>*/
/*                         {% else %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                             <div class="containerCard">*/
/*                               <!-- ARTechnology -->*/
/*                               <p><b>NO FEMALE</b>*/
/*                               <!-- ARTechnology -->*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                         {% endif %}*/
/*                       </td>*/
/* */
/*                     <!-- mom mom sire -->*/
/*                     <td>*/
/*                       {% if canine[0].mom[0].mom[0].sire[0] != null %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             {% if canine[0].mom[0].mom[0].sire[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].mom[0].sire[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].mom[0].mom[0].sire[0].can_a_s}}</b>*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                       {% else %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                           <div class="containerCard">*/
/*                             <!-- ARTechnology -->*/
/*                             <p><b>NO MALE</b>*/
/*                             <!-- ARTechnology -->*/
/*                             </p>*/
/*                           </div>*/
/*                         </div>*/
/*                       </center>*/
/*                       {% endif %}*/
/*                     </td>*/
/*                     <td>*/
/*                       {% if canine[0].mom[0].mom[0].mom[0] != null %}*/
/*                         <center>*/
/*                           <div class="card">*/
/*                             {% if canine[0].mom[0].mom[0].mom[0].can_photo == '-' %}*/
/*                                 <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />*/
/*                                 {% else %}*/
/*                                 <img src="{{base_url()}}uploads/canine/{{canine[0].mom[0].mom[0].mom[0].can_photo}}" width="170px" alt="" />*/
/*                             {% endif %}*/
/*                             <div class="containerCard">*/
/*                               <p><b>{{canine[0].mom[0].mom[0].mom[0].can_a_s}}</b>*/
/*                               </p>*/
/*                             </div>*/
/*                           </div>*/
/*                         </center>*/
/*                       {% else %}*/
/*                       <center>*/
/*                         <div class="card">*/
/*                           <img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" />*/
/*                           <div class="containerCard">*/
/*                             <!-- ARTechnology -->*/
/*                             <p><b>NO FEMALE</b>*/
/*                             <!-- ARTechnology -->*/
/*                             </p>*/
/*                           </div>*/
/*                         </div>*/
/*                       </center>*/
/*                       {% endif %}*/
/*                     </td>*/
/*                     <!-- mom mom mom -->*/
/* */
/*                   </tr>*/
/*               </table>*/
/* */
/*             </div>*/
/*         </div>*/
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <input type="hidden" value="{{canines.can_id}}" class="can_id" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <script type="text/javascript" src="{{base_url()}}assets/primitive/demo/js/jquery/jquery-1.9.1.js"></script>*/
/* <script type="text/javascript" src="{{base_url()}}assets/primitive/demo/js/jquery/jquery-ui-1.10.2.custom.min.js"></script>*/
/* <script  type="text/javascript" src="{{base_url()}}assets/primitive/demo/js/primitives.min.js"></script>*/
/* */
/* <script>*/
/* jQuery(function () {*/
/*     $('#page-container').addClass('sidebar-mini');*/
/* });*/
/* */
/* var can_id = $('.can_id').val();*/
/* var base_url = $('.base_url').val();*/
/* */
/* $(window).load(function () {*/
/* */
/*     $.get(base_url+'backend/pedigrees/cid/'+can_id, function(res) {*/
/*       res = $.parseJSON(res);*/
/* */
/*       var options = new primitives.orgdiagram.Config();*/
/* */
/*         var item = [];*/
/*         var canines = res;*/
/*         canines.forEach(function(v, i){*/
/*           var newItem = new primitives.orgdiagram.ItemConfig(*/
/*             {*/
/*                 id: v.id,*/
/*                 parent: v.parent,*/
/*                 title: v.can_a_s,*/
/*                 description: v.can_date_of_birth,*/
/*                 image: base_url+'uploads/canine/'+v.can_photo,*/
/*                 phone: "(123) 800-80-80",*/
/*                 email: "joseph@org.com"*/
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
/* */
/*       });*/
/* });*/
/* </script>*/
/* {% endblock %}*/
/* */
