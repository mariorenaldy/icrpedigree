<?php

/* template/backend.twig */
class __TwigTemplate_7bb74071b841a679e606df9cd3a095e8dd6db00d018322fd8d0d4a80f33b1a3c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'body' => array($this, 'block_body'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if IE 9]>         <html class=\"ie9 no-focus\"> <![endif]-->
<!--[if gt IE 9]><!--> <html class=\"no-focus\"> <!--<![endif]-->
    <head>
        <meta charset=\"utf-8\">

        <title>Backend ICR  </title>

        <meta name=\"description\" content=\"arsycode\">
        <meta name=\"author\" content=\"ARTechnology\">
        <meta name=\"robots\" content=\"noindex, nofollow\">
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1.0\">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel=\"shortcut icon\" href=\"http://www.mascotdesigngallery.com/wp/wp-content/uploads/2014/10/theincredibleenglishclub.png\">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700\">

        <!-- Page JS Plugins CSS -->
        <link rel=\"stylesheet\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/slick/slick.min.css\">
        <link rel=\"stylesheet\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/slick/slick-theme.min.css\">

        <!-- Bootstrap and OneUI CSS framework -->
        <link rel=\"stylesheet\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" id=\"css-main\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/oneui.css\">
        <link rel=\"stylesheet\" id=\"css-theme\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/themes/amethyst.min.css\">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel=\"stylesheet\" id=\"css-theme\" href=\"";
        // line 33
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/themes/flat.min.css\"> -->
        <!-- ARTechnology -->
        <link href=\"";
        // line 35
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/css/font-awesome.css\" rel=\"stylesheet\" type=\"text/css\" />
        
        <style media=\"screen\">
        .red{
            color: red !important;
        }
        .gray{
            color: gray !important;
        }
        </style>
        <!-- ARTechnology -->
        <!-- END Stylesheets -->
        ";
        // line 47
        $this->displayBlock('styles', $context, $blocks);
        // line 48
        echo "    </head>
    <body>
        <div id=\"page-container\" class=\"sidebar-l sidebar-o side-scroll header-navbar-fixed\">
            <!-- Sidebar -->
            <nav id=\"sidebar\">
                <!-- Sidebar Scroll Container -->
                <div id=\"sidebar-scroll\">
                    <!-- Sidebar Content -->
                    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                    <div class=\"sidebar-content\">
                        <!-- Side Header -->
                        <div class=\"side-header side-content bg-white-op\">
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class=\"btn btn-link text-gray pull-right hidden-md hidden-lg\" type=\"button\" data-toggle=\"layout\" data-action=\"sidebar_close\">
                                <i class=\"fa fa-times\"></i>
                            </button>
                            <a class=\"h5 text-white\" href=\"\">
                                <!-- <i class=\"fa fa-circle-o-notch text-primary\"></i> -->
                                <img src=\"";
        // line 66
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/logo.png\" width=\"30px\" style=\"margin-top:-10px;\"/>
                                <span class=\"h3 font-w600 sidebar-mini-hide\" style=\"margin-left:10px;\">ICR</span>
                            </a>
                        </div>
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class=\"side-content\">
                          <ul class=\"nav-main\">
                          ";
        // line 75
        if (($this->getAttribute((isset($context["users"]) ? $context["users"] : null), "use_akses", array()) == 1)) {
            // line 76
            echo "                              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["navigations"]) ? $context["navigations"] : null), "superadmin", array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["nav"]) {
                // line 77
                echo "                                  ";
                if ($this->getAttribute($context["nav"], "heading", array())) {
                    // line 78
                    echo "                                      <li class=\"nav-main-heading\">
                                          <span class=\"sidebar-mini-hide\">";
                    // line 79
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span>
                                      </li>
                                  ";
                } elseif (($this->getAttribute(                // line 81
$context["nav"], "child", array()) == false)) {
                    // line 82
                    echo "                                      <li>
                                          <a class=\"\" href=\"";
                    // line 83
                    echo twig_escape_filter($this->env, base_url($this->getAttribute($context["nav"], "url", array())), "html", null, true);
                    echo "\">
                                              <i class=\"si ";
                    // line 84
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "icon", array()), "html", null, true);
                    echo "\"></i>
                                              <span class=\"sidebar-mini-hide\">";
                    // line 85
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span>
                                          </a>
                                      </li>
                                  ";
                } else {
                    // line 89
                    echo "                                      <li>
                                          <a class=\"nav-submenu\" data-toggle=\"nav-submenu\" href=\"#\">
                                              <i class=\"si ";
                    // line 91
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "icon", array()), "html", null, true);
                    echo "\"></i>
                                              <span class=\"sidebar-mini-hide\">";
                    // line 92
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span></a>
                                              <ul>
                                                  ";
                    // line 94
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["nav"], "child", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["navChild"]) {
                        // line 95
                        echo "                                                      <li>
                                                          <a href=\"";
                        // line 96
                        echo twig_escape_filter($this->env, base_url($this->getAttribute($context["navChild"], "url", array())), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["navChild"], "displayName", array()), "html", null, true);
                        echo "</a>
                                                      </li>
                                                  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navChild'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 99
                    echo "                                              </ul>
                                  </li>
                                  ";
                }
                // line 102
                echo "                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nav'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 103
            echo "                            ";
        } elseif (($this->getAttribute((isset($context["users"]) ? $context["users"] : null), "use_akses", array()) == 2)) {
            // line 104
            echo "                              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["navigations"]) ? $context["navigations"] : null), "admin", array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["nav"]) {
                // line 105
                echo "                                  ";
                if ($this->getAttribute($context["nav"], "heading", array())) {
                    // line 106
                    echo "                                      <li class=\"nav-main-heading\">
                                          <span class=\"sidebar-mini-hide\">";
                    // line 107
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span>
                                      </li>
                                  ";
                } elseif (($this->getAttribute(                // line 109
$context["nav"], "child", array()) == false)) {
                    // line 110
                    echo "                                      <li>
                                          <a class=\"\" href=\"";
                    // line 111
                    echo twig_escape_filter($this->env, base_url($this->getAttribute($context["nav"], "url", array())), "html", null, true);
                    echo "\">
                                              <i class=\"si ";
                    // line 112
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "icon", array()), "html", null, true);
                    echo "\"></i>
                                              <span class=\"sidebar-mini-hide\">";
                    // line 113
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span>
                                          </a>
                                      </li>
                                  ";
                } else {
                    // line 117
                    echo "                                      <li>
                                          <a class=\"nav-submenu\" data-toggle=\"nav-submenu\" href=\"#\">
                                              <i class=\"si ";
                    // line 119
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "icon", array()), "html", null, true);
                    echo "\"></i>
                                              <span class=\"sidebar-mini-hide\">";
                    // line 120
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span></a>
                                              <ul>
                                                  ";
                    // line 122
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["nav"], "child", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["navChild"]) {
                        // line 123
                        echo "                                                      <li>
                                                          <a href=\"";
                        // line 124
                        echo twig_escape_filter($this->env, base_url($this->getAttribute($context["navChild"], "url", array())), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["navChild"], "displayName", array()), "html", null, true);
                        echo "</a>
                                                      </li>
                                                  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navChild'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 127
                    echo "                                              </ul>
                                  </li>
                                  ";
                }
                // line 130
                echo "                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nav'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 131
            echo "                            ";
        } elseif (($this->getAttribute((isset($context["users"]) ? $context["users"] : null), "use_akses", array()) == 3)) {
            // line 132
            echo "                              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["navigations"]) ? $context["navigations"] : null), "pegawai", array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["nav"]) {
                // line 133
                echo "                                  ";
                if ($this->getAttribute($context["nav"], "heading", array())) {
                    // line 134
                    echo "                                      <li class=\"nav-main-heading\">
                                          <span class=\"sidebar-mini-hide\">";
                    // line 135
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span>
                                      </li>
                                  ";
                } elseif (($this->getAttribute(                // line 137
$context["nav"], "child", array()) == false)) {
                    // line 138
                    echo "                                      <li>
                                          <a class=\"\" href=\"";
                    // line 139
                    echo twig_escape_filter($this->env, base_url($this->getAttribute($context["nav"], "url", array())), "html", null, true);
                    echo "\">
                                              <i class=\"si ";
                    // line 140
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "icon", array()), "html", null, true);
                    echo "\"></i>
                                              <span class=\"sidebar-mini-hide\">";
                    // line 141
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span>
                                          </a>
                                      </li>
                                  ";
                } else {
                    // line 145
                    echo "                                      <li>
                                          <a class=\"nav-submenu\" data-toggle=\"nav-submenu\" href=\"#\">
                                              <i class=\"si ";
                    // line 147
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "icon", array()), "html", null, true);
                    echo "\"></i>
                                              <span class=\"sidebar-mini-hide\">";
                    // line 148
                    echo twig_escape_filter($this->env, $this->getAttribute($context["nav"], "displayName", array()), "html", null, true);
                    echo "</span></a>
                                              <ul>
                                                  ";
                    // line 150
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["nav"], "child", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["navChild"]) {
                        // line 151
                        echo "                                                      <li>
                                                          <a href=\"";
                        // line 152
                        echo twig_escape_filter($this->env, base_url($this->getAttribute($context["navChild"], "url", array())), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["navChild"], "displayName", array()), "html", null, true);
                        echo "</a>
                                                      </li>
                                                  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navChild'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 155
                    echo "                                              </ul>
                                  </li>
                                  ";
                }
                // line 158
                echo "                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nav'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 159
            echo "
                          ";
        }
        // line 161
        echo "                          </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id=\"header-navbar\" class=\"content-mini content-mini-full\">
                <!-- Header Navigation Right -->
                <ul class=\"nav-header pull-right\">
                    <li>
                        <div class=\"btn-group\">
                            <button class=\"btn btn-default btn-image dropdown-toggle\" data-toggle=\"dropdown\" type=\"button\">
                                ";
        // line 178
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["users"]) ? $context["users"] : null), "use_name", array()), "html", null, true);
        echo " &nbsp;
                                <img src=\"";
        // line 179
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["users"]) ? $context["users"] : null), "use_photo", array()), "html", null, true);
        echo "\" alt=\"Avatar\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul class=\"dropdown-menu dropdown-menu-right\">
                                <!-- <li class=\"dropdown-header\">Account</li>
                                <li>
                                    <a tabindex=\"-1\" href=\"";
        // line 185
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/setting/\">
                                        <i class=\"si si-settings pull-right\"></i>Pengaturan
                                    </a>
                                </li> -->
                                <!-- <li class=\"divider\"></li> -->
                                <li class=\"dropdown-header\">Actions</li>
                                <li>
                                    <a tabindex=\"-1\" href=\"";
        // line 192
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/auth/logout\">
                                        <i class=\"si si-logout pull-right\"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- END Header Navigation Right -->

                <!-- Header Navigation Left -->
                <ul class=\"nav-header pull-left\">
                    <li class=\"hidden-md hidden-lg\">
                        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                        <button class=\"btn btn-default\" data-toggle=\"layout\" data-action=\"sidebar_toggle\" type=\"button\">
                            <i class=\"fa fa-navicon\"></i>
                        </button>
                    </li>
                    <li class=\"hidden-xs hidden-sm\">
                        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                        <!-- <button class=\"btn btn-default\" data-toggle=\"layout\" data-action=\"sidebar_mini_toggle\" type=\"button\">
                            <i class=\"fa fa-ellipsis-v\"></i>
                        </button> -->
                    </li>

                </ul>
                <!-- END Header Navigation Left -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id=\"main-container\">
                ";
        // line 224
        $this->displayBlock('body', $context, $blocks);
        // line 225
        echo "            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id=\"page-footer\" class=\"content-mini content-mini-full font-s12 bg-gray-lighter clearfix hidden-print\">
                <div class=\"pull-right\">
                <!-- ARTechnology -->
                    Crafted with <i class=\"fa fa-heart text-city\"></i> by <a class=\"font-w600\" href=\"http://artechnology.tech\" title=\"ARTechnology\" target=\"_blank\"><span class=\"red\">ART</span><span class=\"gray\">echnology</span></a>
                <!-- ARTechnology -->
                </div>
                <div class=\"pull-left\">
                    <a class=\"font-w600\" href=\"#\" target=\"_blank\">ICR</a> &copy; <span class=\"js-year-copy\"></span>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src=\"";
        // line 244
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/jquery.min.js\"></script>
        <script src=\"";
        // line 245
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/bootstrap.min.js\"></script>
        <script src=\"";
        // line 246
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/jquery.slimscroll.min.js\"></script>
        <script src=\"";
        // line 247
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/jquery.scrollLock.min.js\"></script>
        <script src=\"";
        // line 248
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/jquery.appear.min.js\"></script>
        <script src=\"";
        // line 249
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/jquery.countTo.min.js\"></script>
        <script src=\"";
        // line 250
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/jquery.placeholder.min.js\"></script>
        <script src=\"";
        // line 251
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/core/js.cookie.min.js\"></script>
        <script src=\"";
        // line 252
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/app.js\"></script>

        <!-- Page Plugins -->
        <script src=\"";
        // line 255
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/slick/slick.min.js\"></script>
        <script src=\"";
        // line 256
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/chartjs/Chart.min.js\"></script>
        <script type=\"text/javascript\">
        \$(function () {
          var path = window.location.href;
          \$('.nav-main li a').each(function(){
              path = path.replace('#', '');
              if(this.href === path){
                  \$(this).addClass('active');
              }

          });

          var checkCookie = localStorage.getItem(\"silp\");
          if (checkCookie != null) {
              \$('.nav-main > li > a:eq('+checkCookie+')').parent('li').addClass('open').next().show();
          }

          \$('.nav-main > li > a').click(function(){
              var navIndex = \$('.nav-main > li > a').index(this);
              localStorage.setItem(\"silp\", navIndex);
          });
        });
        </script>
        <!-- Page JS Code -->
        ";
        // line 280
        $this->displayBlock('scripts', $context, $blocks);
        // line 283
        echo "
    </body>
</html>
";
    }

    // line 47
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 224
    public function block_body($context, array $blocks = array())
    {
    }

    // line 280
    public function block_scripts($context, array $blocks = array())
    {
        // line 281
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "template/backend.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  563 => 281,  560 => 280,  555 => 224,  550 => 47,  543 => 283,  541 => 280,  514 => 256,  510 => 255,  504 => 252,  500 => 251,  496 => 250,  492 => 249,  488 => 248,  484 => 247,  480 => 246,  476 => 245,  472 => 244,  451 => 225,  449 => 224,  414 => 192,  404 => 185,  394 => 179,  390 => 178,  371 => 161,  367 => 159,  361 => 158,  356 => 155,  345 => 152,  342 => 151,  338 => 150,  333 => 148,  329 => 147,  325 => 145,  318 => 141,  314 => 140,  310 => 139,  307 => 138,  305 => 137,  300 => 135,  297 => 134,  294 => 133,  289 => 132,  286 => 131,  280 => 130,  275 => 127,  264 => 124,  261 => 123,  257 => 122,  252 => 120,  248 => 119,  244 => 117,  237 => 113,  233 => 112,  229 => 111,  226 => 110,  224 => 109,  219 => 107,  216 => 106,  213 => 105,  208 => 104,  205 => 103,  199 => 102,  194 => 99,  183 => 96,  180 => 95,  176 => 94,  171 => 92,  167 => 91,  163 => 89,  156 => 85,  152 => 84,  148 => 83,  145 => 82,  143 => 81,  138 => 79,  135 => 78,  132 => 77,  127 => 76,  125 => 75,  113 => 66,  93 => 48,  91 => 47,  76 => 35,  71 => 33,  65 => 30,  61 => 29,  57 => 28,  51 => 25,  47 => 24,  22 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->*/
/* <!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->*/
/*     <head>*/
/*         <meta charset="utf-8">*/
/* */
/*         <title>Backend ICR  </title>*/
/* */
/*         <meta name="description" content="arsycode">*/
/*         <meta name="author" content="ARTechnology">*/
/*         <meta name="robots" content="noindex, nofollow">*/
/*         <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">*/
/* */
/*         <!-- Icons -->*/
/*         <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->*/
/*         <link rel="shortcut icon" href="http://www.mascotdesigngallery.com/wp/wp-content/uploads/2014/10/theincredibleenglishclub.png">*/
/*         <!-- END Icons -->*/
/* */
/*         <!-- Stylesheets -->*/
/*         <!-- Web fonts -->*/
/*         <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">*/
/* */
/*         <!-- Page JS Plugins CSS -->*/
/*         <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/slick/slick.min.css">*/
/*         <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/slick/slick-theme.min.css">*/
/* */
/*         <!-- Bootstrap and OneUI CSS framework -->*/
/*         <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/bootstrap.min.css">*/
/*         <link rel="stylesheet" id="css-main" href="{{ base_url() }}/assets/oneui/css/oneui.css">*/
/*         <link rel="stylesheet" id="css-theme" href="{{ base_url() }}/assets/oneui/css/themes/amethyst.min.css">*/
/* */
/*         <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->*/
/*         <!-- <link rel="stylesheet" id="css-theme" href="{{ base_url() }}/assets/oneui/css/themes/flat.min.css"> -->*/
/*         <!-- ARTechnology -->*/
/*         <link href="{{base_url()}}assets/css/font-awesome.css" rel="stylesheet" type="text/css" />*/
/*         */
/*         <style media="screen">*/
/*         .red{*/
/*             color: red !important;*/
/*         }*/
/*         .gray{*/
/*             color: gray !important;*/
/*         }*/
/*         </style>*/
/*         <!-- ARTechnology -->*/
/*         <!-- END Stylesheets -->*/
/*         {% block styles %}{% endblock %}*/
/*     </head>*/
/*     <body>*/
/*         <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">*/
/*             <!-- Sidebar -->*/
/*             <nav id="sidebar">*/
/*                 <!-- Sidebar Scroll Container -->*/
/*                 <div id="sidebar-scroll">*/
/*                     <!-- Sidebar Content -->*/
/*                     <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->*/
/*                     <div class="sidebar-content">*/
/*                         <!-- Side Header -->*/
/*                         <div class="side-header side-content bg-white-op">*/
/*                             <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->*/
/*                             <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">*/
/*                                 <i class="fa fa-times"></i>*/
/*                             </button>*/
/*                             <a class="h5 text-white" href="">*/
/*                                 <!-- <i class="fa fa-circle-o-notch text-primary"></i> -->*/
/*                                 <img src="{{base_url()}}assets/oneui/img/logo.png" width="30px" style="margin-top:-10px;"/>*/
/*                                 <span class="h3 font-w600 sidebar-mini-hide" style="margin-left:10px;">ICR</span>*/
/*                             </a>*/
/*                         </div>*/
/*                         <!-- END Side Header -->*/
/* */
/*                         <!-- Side Content -->*/
/*                         <div class="side-content">*/
/*                           <ul class="nav-main">*/
/*                           {% if users.use_akses == 1 %}*/
/*                               {% for nav in navigations['superadmin'] %}*/
/*                                   {% if nav.heading %}*/
/*                                       <li class="nav-main-heading">*/
/*                                           <span class="sidebar-mini-hide">{{nav.displayName}}</span>*/
/*                                       </li>*/
/*                                   {% elseif nav.child == false %}*/
/*                                       <li>*/
/*                                           <a class="" href="{{base_url(nav.url)}}">*/
/*                                               <i class="si {{nav.icon}}"></i>*/
/*                                               <span class="sidebar-mini-hide">{{nav.displayName}}</span>*/
/*                                           </a>*/
/*                                       </li>*/
/*                                   {% else %}*/
/*                                       <li>*/
/*                                           <a class="nav-submenu" data-toggle="nav-submenu" href="#">*/
/*                                               <i class="si {{nav.icon}}"></i>*/
/*                                               <span class="sidebar-mini-hide">{{nav.displayName}}</span></a>*/
/*                                               <ul>*/
/*                                                   {% for navChild in nav.child %}*/
/*                                                       <li>*/
/*                                                           <a href="{{base_url(navChild.url)}}">{{navChild.displayName}}</a>*/
/*                                                       </li>*/
/*                                                   {% endfor %}*/
/*                                               </ul>*/
/*                                   </li>*/
/*                                   {% endif %}*/
/*                               {% endfor %}*/
/*                             {% elseif users.use_akses == 2 %}*/
/*                               {% for nav in navigations['admin'] %}*/
/*                                   {% if nav.heading %}*/
/*                                       <li class="nav-main-heading">*/
/*                                           <span class="sidebar-mini-hide">{{nav.displayName}}</span>*/
/*                                       </li>*/
/*                                   {% elseif nav.child == false %}*/
/*                                       <li>*/
/*                                           <a class="" href="{{base_url(nav.url)}}">*/
/*                                               <i class="si {{nav.icon}}"></i>*/
/*                                               <span class="sidebar-mini-hide">{{nav.displayName}}</span>*/
/*                                           </a>*/
/*                                       </li>*/
/*                                   {% else %}*/
/*                                       <li>*/
/*                                           <a class="nav-submenu" data-toggle="nav-submenu" href="#">*/
/*                                               <i class="si {{nav.icon}}"></i>*/
/*                                               <span class="sidebar-mini-hide">{{nav.displayName}}</span></a>*/
/*                                               <ul>*/
/*                                                   {% for navChild in nav.child %}*/
/*                                                       <li>*/
/*                                                           <a href="{{base_url(navChild.url)}}">{{navChild.displayName}}</a>*/
/*                                                       </li>*/
/*                                                   {% endfor %}*/
/*                                               </ul>*/
/*                                   </li>*/
/*                                   {% endif %}*/
/*                               {% endfor %}*/
/*                             {% elseif users.use_akses == 3 %}*/
/*                               {% for nav in navigations['pegawai'] %}*/
/*                                   {% if nav.heading %}*/
/*                                       <li class="nav-main-heading">*/
/*                                           <span class="sidebar-mini-hide">{{nav.displayName}}</span>*/
/*                                       </li>*/
/*                                   {% elseif nav.child == false %}*/
/*                                       <li>*/
/*                                           <a class="" href="{{base_url(nav.url)}}">*/
/*                                               <i class="si {{nav.icon}}"></i>*/
/*                                               <span class="sidebar-mini-hide">{{nav.displayName}}</span>*/
/*                                           </a>*/
/*                                       </li>*/
/*                                   {% else %}*/
/*                                       <li>*/
/*                                           <a class="nav-submenu" data-toggle="nav-submenu" href="#">*/
/*                                               <i class="si {{nav.icon}}"></i>*/
/*                                               <span class="sidebar-mini-hide">{{nav.displayName}}</span></a>*/
/*                                               <ul>*/
/*                                                   {% for navChild in nav.child %}*/
/*                                                       <li>*/
/*                                                           <a href="{{base_url(navChild.url)}}">{{navChild.displayName}}</a>*/
/*                                                       </li>*/
/*                                                   {% endfor %}*/
/*                                               </ul>*/
/*                                   </li>*/
/*                                   {% endif %}*/
/*                               {% endfor %}*/
/* */
/*                           {% endif %}*/
/*                           </ul>*/
/*                         </div>*/
/*                         <!-- END Side Content -->*/
/*                     </div>*/
/*                     <!-- Sidebar Content -->*/
/*                 </div>*/
/*                 <!-- END Sidebar Scroll Container -->*/
/*             </nav>*/
/*             <!-- END Sidebar -->*/
/* */
/*             <!-- Header -->*/
/*             <header id="header-navbar" class="content-mini content-mini-full">*/
/*                 <!-- Header Navigation Right -->*/
/*                 <ul class="nav-header pull-right">*/
/*                     <li>*/
/*                         <div class="btn-group">*/
/*                             <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">*/
/*                                 {{users.use_name}} &nbsp;*/
/*                                 <img src="{{base_url()}}{{ users.use_photo }}" alt="Avatar">*/
/*                                 <span class="caret"></span>*/
/*                             </button>*/
/*                             <ul class="dropdown-menu dropdown-menu-right">*/
/*                                 <!-- <li class="dropdown-header">Account</li>*/
/*                                 <li>*/
/*                                     <a tabindex="-1" href="{{ base_url() }}backend/setting/">*/
/*                                         <i class="si si-settings pull-right"></i>Pengaturan*/
/*                                     </a>*/
/*                                 </li> -->*/
/*                                 <!-- <li class="divider"></li> -->*/
/*                                 <li class="dropdown-header">Actions</li>*/
/*                                 <li>*/
/*                                     <a tabindex="-1" href="{{ base_url() }}backend/auth/logout">*/
/*                                         <i class="si si-logout pull-right"></i>Keluar*/
/*                                     </a>*/
/*                                 </li>*/
/*                             </ul>*/
/*                         </div>*/
/*                     </li>*/
/*                 </ul>*/
/*                 <!-- END Header Navigation Right -->*/
/* */
/*                 <!-- Header Navigation Left -->*/
/*                 <ul class="nav-header pull-left">*/
/*                     <li class="hidden-md hidden-lg">*/
/*                         <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->*/
/*                         <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">*/
/*                             <i class="fa fa-navicon"></i>*/
/*                         </button>*/
/*                     </li>*/
/*                     <li class="hidden-xs hidden-sm">*/
/*                         <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->*/
/*                         <!-- <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">*/
/*                             <i class="fa fa-ellipsis-v"></i>*/
/*                         </button> -->*/
/*                     </li>*/
/* */
/*                 </ul>*/
/*                 <!-- END Header Navigation Left -->*/
/*             </header>*/
/*             <!-- END Header -->*/
/* */
/*             <!-- Main Container -->*/
/*             <main id="main-container">*/
/*                 {% block body %}{% endblock %}*/
/*             </main>*/
/*             <!-- END Main Container -->*/
/* */
/*             <!-- Footer -->*/
/*             <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix hidden-print">*/
/*                 <div class="pull-right">*/
/*                 <!-- ARTechnology -->*/
/*                     Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://artechnology.tech" title="ARTechnology" target="_blank"><span class="red">ART</span><span class="gray">echnology</span></a>*/
/*                 <!-- ARTechnology -->*/
/*                 </div>*/
/*                 <div class="pull-left">*/
/*                     <a class="font-w600" href="#" target="_blank">ICR</a> &copy; <span class="js-year-copy"></span>*/
/*                 </div>*/
/*             </footer>*/
/*             <!-- END Footer -->*/
/*         </div>*/
/*         <!-- END Page Container -->*/
/* */
/*         <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/jquery.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/bootstrap.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/jquery.slimscroll.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/jquery.scrollLock.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/jquery.appear.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/jquery.countTo.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/jquery.placeholder.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/core/js.cookie.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/app.js"></script>*/
/* */
/*         <!-- Page Plugins -->*/
/*         <script src="{{ base_url() }}/assets/oneui/js/plugins/slick/slick.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/plugins/chartjs/Chart.min.js"></script>*/
/*         <script type="text/javascript">*/
/*         $(function () {*/
/*           var path = window.location.href;*/
/*           $('.nav-main li a').each(function(){*/
/*               path = path.replace('#', '');*/
/*               if(this.href === path){*/
/*                   $(this).addClass('active');*/
/*               }*/
/* */
/*           });*/
/* */
/*           var checkCookie = localStorage.getItem("silp");*/
/*           if (checkCookie != null) {*/
/*               $('.nav-main > li > a:eq('+checkCookie+')').parent('li').addClass('open').next().show();*/
/*           }*/
/* */
/*           $('.nav-main > li > a').click(function(){*/
/*               var navIndex = $('.nav-main > li > a').index(this);*/
/*               localStorage.setItem("silp", navIndex);*/
/*           });*/
/*         });*/
/*         </script>*/
/*         <!-- Page JS Code -->*/
/*         {% block scripts %}*/
/* */
/*         {% endblock %}*/
/* */
/*     </body>*/
/* </html>*/
/* */
