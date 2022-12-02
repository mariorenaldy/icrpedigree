<?php

/* template/frontend.twig */
class __TwigTemplate_96489c72185d47f52dca66fbd116c8474869d6784b320bb77a5768dfa2c7d12f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'styles' => array($this, 'block_styles'),
            'inverted' => array($this, 'block_inverted'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7]>      <html class=\"no-js lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>         <html class=\"no-js lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>         <html class=\"no-js lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=\"no-js\"> <!--<![endif]-->
    <head>
        <meta charset=\"utf-8\">
        <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo " | Indonesia Canines</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"description\" content=\"\">
        <meta name=\"keywords\" content=\"Pastikan Anjing kesayangan Anda tersertifikasi Kami siap melayani!\">
        <meta name=\"author\" content=\"ARTechnology\">

        <link href=\"";
        // line 16
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\" />
        <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/animate-css/animate.min.css\" rel=\"stylesheet\" />
        <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/iconmoon/style.css\" rel=\"stylesheet\" />
        <link rel=\"shortcut icon\" href=\"http://www.mascotdesigngallery.com/wp/wp-content/uploads/2014/10/theincredibleenglishclub.png\">
        <style media=\"screen\">

        body {

        }
        /*@media (min-width: 768px)*/
        .navbar-form {
  /*border-color: #ff1515;*/
          margin-top: -8px;
          margin-left: -40px;
          /*margin-left: -25px;*/
        }

        /*@media (min-width: 768px)*/
        .navbar-form .form-control {
            display: inline-block;
            /*width: 220px;*/
            vertical-align: middle;
        }

        h1{
          font-family: Trajan !important;
            src: url(assets/font/Trajan.ttf) !important;
        }
        h2{
          font-family: Trajan !important;
            src: url(assets/font/Trajan.ttf) !important;
        }
        h3{
          font-family: Trajan !important;
            src: url(assets/font/Trajan.ttf) !important;
        }
        h4{
          font-family: Trajan !important;
            src: url(assets/font/Trajan.ttf) !important;
        }
        h5{
          font-family: Trajan !important;
            src: url(assets/font/Trajan.ttf) !important;
        }
        h6{
          font-family: Trajan !important;
            src: url(assets/font/Trajan.ttf) !important;
        }
        .navbar-header{
          font-family: Trajan !important;
           src: url(assets/font/Trajan.ttf) !important;
        }
        /* ARTechnology */
        a .dropdown-a{
            background-color: #000000 !important;
        }
        ul .dropdown-ul{
            background-color: #000000 !important;
            color: #FFFFFF !important;
        }
        .dropdown-ul > li > a{
            color: #FFFFFF !important;
        }
        .dropdown-ul > li > a:hover{
            color: #000000 !important;
        }
        .red{
            color: red !important;
        }
        /* ARTechnology */
        </style>

        ";
        // line 88
        $this->displayBlock('styles', $context, $blocks);
        // line 89
        echo "    </head>
    <body style=\"  font-family: Trajan !important;
      src: url(assets/font/Trajan.ttf) !important;\">
      <div id=\"wrapper\">
            <header class=\"";
        // line 93
        $this->displayBlock('inverted', $context, $blocks);
        echo "\" >
                <div id=\"topbar\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-sm-6 col-xs-6\">
                                <span class=\"hidden-sm hidden-xs\"><i class=\"icon-location4\"></i>
                                    ";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_address", array()), "html", null, true);
        echo "
                                </span>
                                <span class=\"vertical-space\"></span>
                                <i class=\"icon-phone4\"></i>";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_phone_number", array()), "html", null, true);
        echo "
                            </div>
                            <div class=\"col-sm-6 col-xs-6 text-right\">
                                <div class=\"btn-group social-links hidden-sm hidden-xs\">
                                    <a href=\"https://www.facebook.com/Indonesian-Canine-Registry-1793017194288491/\" class=\"btn btn-link\"><i class=\"icon-facebook6\"></i></a>
                                    <a href=\"https://www.instagram.com/icr_indonesia/\" class=\"btn btn-link\"><i class=\"icon-instagram3\"></i></a>
                                </div>
                                <!--<a href=\"login.html\" class=\"login-button\">LOGIN</a><a href=\"signup.html\" class=\"signup-button\">SIGN UP</a>-->
                            </div>
                        </div>
                        <div class=\"top-divider\"></div>
                    </div>
                </div>
                <nav class=\"navbar navbar-default\" role=\"navigation\" style=\" font-family: Trajan !important;
                  src: url(assets/font/Trajan.ttf) !important;\">
                    <div class=\"container\">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class=\"navbar-header\">
                            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#main-navigation\">
                                <span class=\"icon-navicon\"></span>
                            </button>
                            <a class=\"navbar-brand\" href=\"index.html\">
                                <!--<img src=\"";
        // line 124
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/img/logo.png\" data-dark-src=\"";
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/img/logo_dark.png\" alt=\"Coco Frontend Template\" class=\"logo\">-->
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class=\"collapse navbar-collapse\" id=\"main-navigation\" style=\" font-family: Trajan !important;
                          src: url(assets/font/Trajan.ttf) !important;\">
                            <!-- <ul class=\"nav navbar-nav navbar-left\">
                              <form class=\"navbar-form\" role=\"search\">
                                <div class=\"form-group\">
                                  <input type=\"text\" class=\"form-control\" placeholder=\"Pencarian anjing..\">
                                </div>
                                <button type=\"submit\" style=\"margin-left: -6px;\"class=\"btn btn-default\"><span class=\"glyphicon glyphicon-search\" aria-hidden=\"true\"></span></button>
                              </form>
                            </ul> -->

                            <ul class=\"nav navbar-nav navbar-right\" style=\"\">

                                <li><a href=\"";
        // line 142
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\">BERANDA</a></li>
                                <!-- ARTechnology -->
                                <!--
                                <li><a href=\"";
        // line 145
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "profile\">PROFIL</a></li>
                                <li><a href=\"";
        // line 146
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "service\">ATURAN</a></li>

                                ";
        // line 148
        if ((isset($context["products"]) ? $context["products"] : null)) {
            // line 149
            echo "                                  <li><a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "product\">PRODUK</a></li>
                                ";
        }
        // line 151
        echo "                                -->
                                <li><a href=\"";
        // line 152
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "events\">ACARA </a></li>
                                <!--
                                ";
        // line 154
        if ((isset($context["sponsors"]) ? $context["sponsors"] : null)) {
            // line 155
            echo "                                  <li><a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "sponsor\">SPONSOR </a></li>
                                ";
        }
        // line 157
        echo "                                -->
                                ";
        // line 158
        if ((isset($context["users"]) ? $context["users"] : null)) {
            // line 159
            echo "                                    <li><a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "pedigrees\">CARI SILSILAH</a></li>
                                    <li><a href=\"";
            // line 160
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "canines\">LIST ANJING</a></li>
                                    <li><a href=\"";
            // line 161
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "studs\">LIST PACAK</a></li>
                                    <li><a href=\"";
            // line 162
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "births\">LIST LAHIR</a></li>
                                    <li>
                                        <a class=\"dropdown-a\" href=\"#\" data-toggle=\"dropdown\">
                                            ";
            // line 165
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["users"]) ? $context["users"] : null), "mem_username", array()), "html", null, true);
            echo "<span class=\"caret\"></span>
                                        </a>
                                        <ul class=\"dropdown-menu dropdown-ul\">
                                            <li><a href=\"";
            // line 168
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "members\">UBAH PROFIL</a></li>
                                            <li><a href=\"";
            // line 169
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "members/logs\">LIST REQUEST UBAH PROFIL</a></li>
                                            <li><a href=\"";
            // line 170
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "members/ubah_password\">UBAH PASSWORD</a></li>
                                            <li><a href=\"";
            // line 171
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "notification\">NOTIFIKASI</a></li>
                                            <li><a href=\"";
            // line 172
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "signin/logout\">SIGN OUT</a></li>
                                        </ul>
                                    </li>
                                ";
        } else {
            // line 176
            echo "                                    <li><a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "signup\">SIGN UP</a></li>
                                    <li><a href=\"";
            // line 177
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "signin\">SIGN IN</a></li>
                                ";
        }
        // line 179
        echo "                                <!--<li><a href=\"contact.html\">KONTAK</a></li>-->
                                <!-- ARTechnology -->
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-->
                </nav>
                ";
        // line 187
        $this->displayBlock('header', $context, $blocks);
        // line 188
        echo "            </header>

            ";
        // line 190
        $this->displayBlock('content', $context, $blocks);
        // line 191
        echo "
            <!-- sample modal content -->
\t\t\t\t\t\t\t\t  <div id=\"modal-add-kritik\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
\t\t\t\t\t\t\t\t    <div class=\"modal-dialog\">
\t\t\t\t\t\t\t\t      <div class=\"modal-content\">
                      <form action=\"";
        // line 196
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "faqs/add\" class=\"form-add-kritik form-horizontal\" method=\"post\">
\t\t\t\t\t\t\t\t        <div class=\"modal-header\">
\t\t\t\t\t\t\t\t          <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
\t\t\t\t\t\t\t\t          <h4 class=\"modal-title\" id=\"myModalLabel\">Kritik</h4>
\t\t\t\t\t\t\t\t        </div>
\t\t\t\t\t\t\t\t        <div class=\"modal-body\">
                          <div class=\"form-group\">
                              <div class=\"col-xs-12\">
                                <label for=\"email-add-kritik\">Email</label>
                                <input class=\"form-control\" id=\"email-add-kritik\" name=\"tes_email\" type=\"email\" required>
                                <input class=\"form-control\" name=\"tes_type\" type=\"hidden\" value=\"Kritik\" required>
                              </div>
                          </div>
                          <div class=\"form-group\">
                              <div class=\"col-xs-12\">
                                <label for=\"content-update-kritik\">Konten</label>
                                <textarea class=\"form-control\" name=\"tes_content\" id=\"content-update-kritik\"  rows=\"4\" cols=\"20\" required></textarea>
                              </div>
                          </div>
\t\t\t\t\t\t\t\t        </div>
\t\t\t\t\t\t\t\t        <div class=\"modal-footer\">
                          <button type=\"button\" class=\"btn btn-danger pull-left\" data-dismiss=\"modal\">Close</button>
                          <button type=\"submit\" class=\"btn btn-primary submit-add-kritik\">Kirim Kritik</button>
\t\t\t\t\t\t\t\t        </div>
                      </form>
\t\t\t\t\t\t\t\t      </div><!-- /.modal-content -->
\t\t\t\t\t\t\t\t    </div><!-- /.modal-dialog -->
\t\t\t\t\t\t\t\t  </div><!-- /.modal -->


                  <!-- sample modal content -->
                        <div id=\"modal-add-saran\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                          <div class=\"modal-dialog\">
                            <div class=\"modal-content\">

                            <form action=\"";
        // line 231
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "faqs/add\" class=\"form-add-saran form-horizontal\" method=\"post\">
                              <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                                <h4 class=\"modal-title\" id=\"myModalLabel\">Saran</h4>
                              </div>
                              <div class=\"modal-body\">
                                <div class=\"form-group\">
                                    <div class=\"col-xs-12\">
                                      <label for=\"email-add-saran\">Email</label>
                                      <input class=\"form-control\" id=\"email-add-saran\" name=\"tes_email\" type=\"email\" required>
                                      <input class=\"form-control\" name=\"tes_type\" type=\"hidden\" value=\"saran\" required>
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <div class=\"col-xs-12\">
                                      <label for=\"content-update-saran\">Konten</label>
                                      <textarea class=\"form-control\" name=\"tes_content\" id=\"content-update-saran\"  rows=\"4\" cols=\"20\" required></textarea>
                                    </div>
                                </div>
                              </div>
                              <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-danger pull-left\" data-dismiss=\"modal\">Close</button>
                                <button type=\"submit\" class=\"btn btn-primary submit-add-saran\">Kirim Saran</button>
                              </div>
                            </form>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

            <footer style=\"background: #343838 url(";
        // line 260
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/images/footer-bg.png) center 20px no-repeat;background-size: 30%;\">
                <section id=\"contact\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-4\">
                            <a href=\"#\" >
                                <!--<img src=\"";
        // line 266
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/img/logo.png\" alt=\"Coco Frontend Template\" class=\"footer-logo\">-->
                                <img src=\"";
        // line 267
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : null), "prof_logo", array()), "html", null, true);
        echo "\" alt=\"Coco Frontend Template\" style=\"width: 100px; margin-top : 5px;\">
                            </a>
                            <h5>Indonesian Caniene Registry</h5>
                        </div>
                        <div class=\"col-sm-4 text-white\">
                            <h4>Hubungi Kami</h4>
                            <ul class=\"list-unstyled company-info\">
                                <li><i class=\"icon-map-marker\"></i> ";
        // line 274
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_address", array()), "html", null, true);
        echo "</li>
                                <li><i class=\"icon-phone3\"></i> ";
        // line 275
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_phone_number", array()), "html", null, true);
        echo "</li>
                                <!--<li><i class=\"icon-envelope\"></i> <a href=\"mailto:contact@somecorporation.com\">contact@somecorporation.com</a></li>-->
                                <li><i class=\"icon-alarm2\"></i>
                                        ";
        // line 278
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_open_time", array()), "html", null, true);
        echo "
                                    <br>";
        // line 279
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_close_time", array()), "html", null, true);
        echo "</li>
                            </ul>
                        </div>

                        <div class=\"col-sm-4 hidden-xs\">
                            <h4>Sosial Media</h4>
                            <ul class=\"list-unstyled social-stream\">
                                <li><a href=\"";
        // line 286
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_facebook", array()), "html", null, true);
        echo "\"><i class=\"icon-facebook6\"></i> Kunjungi Facebook kami</a></li>
                                <li><a href=\"";
        // line 287
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "con_twitter", array()), "html", null, true);
        echo "\"><i class=\"icon-instagram3\"></i> Kunjungi Instagram kami</a></li>
                            </ul>
                            <hr>
                            <ul class=\"list-unstyled social-stream\">
                                <li><button type=\"button\" class=\"btn btn-default btn-sm\"name=\"button\" onClick=\"openModalFaq('#modal-add-kritik', 'add')\" >Kritik</button> &nbsp; <button type=\"button\" class=\"btn btn-default btn-sm\"name=\"button\"  onClick=\"openModalFaq('#modal-add-saran', 'add')\"><i class=\"icon-comment\"></i> Saran</button></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class=\"row\">
                        <!-- ARTechnology -->
                        <div class=\"col-sm-6\">
                            <p>Copyright &copy; 2017 by <a href=\"http://www.icrpedigree.com\" target=\"_blank\">Indonesian Canine Registry</a> - Powered by <a href=\"http://artechnology.tech\" title=\"ARTechnology\" target=\"_blank\"><span class=\"red\">ART</span>echnology</a></p>
                        </div>
                        <!-- ARTechnology -->
                        <div class=\"col-sm-6 text-right\">
                            <div class=\"social-links\">
                                <!--                                <a href=\"https://www.facebook.com/Indonesian-Canine-Registry-1793017194288491/\">
                                                                    <i class=\"icon-facebook4\"></i>
                                                                </a>
                                                                <a href=\"https://www.instagram.com/icr_indonesia/\">
                                                                    <i class=\"icon-instagram3\"></i>
                                                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            </footer>
            <a class=\"tothetop\" href=\"javascript:;\"><i class=\"icon-angle-up\"></i></a>
        </div>

        <script>
            var resizefunc = [];
        </script>
        <script src=\"";
        // line 322
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/less-js/less-1.7.5.min.js\"></script>
        <script src=\"";
        // line 323
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery/jquery-1.11.1.min.js\"></script>
        <script src=\"";
        // line 324
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/bootstrap/js/bootstrap.min.js\"></script>
        <script src=\"";
        // line 325
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-browser/jquery.browser.min.js\"></script>
        <script src=\"";
        // line 326
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/fastclick/fastclick.js\"></script>
        <script src=\"";
        // line 327
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/stellarjs/jquery.stellar.min.js\"></script>
        <script src=\"";
        // line 328
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-appear/jquery.appear.js\"></script>
        <script src=\"";
        // line 329
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/pace/pace.min.js\"></script>
        <script src=\"";
        // line 330
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/js/init.js\"></script>
        <!-- Page Specific JS Libraries -->
        <script src=\"";
        // line 332
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/owl-carousel/owl.carousel.min.js\"></script>
        <script src=\"";
        // line 333
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-magnific/jquery.magnific-popup.min.js\"></script>
        <script src=\"";
        // line 334
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/js/pages/index.js\"></script>
        <!-- Page Specific JS Libraries End -->

        <!-- Page JS Plugins -->
        <script src=\"";
        // line 338
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
        <script src=\"";
        // line 339
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
        <script src=\"";
        // line 340
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>

        <!-- Page JS Code -->
        <input type=\"hidden\" value=\"";
        // line 343
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />

        <script>
          jQuery('.form-add-kritik').validate({
              errorClass: 'help-block text-right animated fadeInDown',
              errorElement: 'div',
              errorPlacement: function(error, e) {
                  jQuery(e).parents('.form-group > div').append(error);
              },

              highlight: function(e) {
                  jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                  jQuery(e).closest('.help-block').remove();
              },

              success: function(e) {
                  jQuery(e).closest('.form-group').removeClass('has-error');
                  jQuery(e).closest('.help-block').remove();
              },
              rules: {
                  ImageFile: {
                      required: true,
                  },
                  description: {
                      required: true,
                  },
              },
              messages: {
                  ImageFile: {
                      required: 'Please choose a picture',
                  },
                  description: {
                      required: 'Please enter a description',
                  },
              },
              submitHandler: function(form) {
                  \$form = \$(form);
                  var button = \$form.find('button[type=\"submit\"]');
                  button.attr('disabled', 'disabled');
                  button.text('saving..');
                  \$.ajax({
                      url:\$form.attr('action'),
                      type:'POST',
                      data:\$form.serialize(),
                      success: function(res) {
                          res = \$.parseJSON(res);
                          if (res.data == '1') {
                              form.reset();
                              \$('#modal-add-kritik').modal('hide');
                              // window.tablekritik.api().ajax.reload();
                              alert(\"Kritik dan saran anda telah kami terima!!\")
                          }else {
                              alert(res.data);

                          }
                          button.removeAttr('disabled');
                          button.text('Save');
                      },

                      error: function(jqXHR, exception) {
                        console.log(jqXHR)
                          alert(jqXHR.statusText);

                          button.removeAttr('disabled');
                          button.text('Save');
                      },
                  });
                  return false; // required to block normal submit since you used ajax
              },
          });

          jQuery('.form-add-saran').validate({
              errorClass: 'help-block text-right animated fadeInDown',
              errorElement: 'div',
              errorPlacement: function(error, e) {
                  jQuery(e).parents('.form-group > div').append(error);
              },

              highlight: function(e) {
                  jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                  jQuery(e).closest('.help-block').remove();
              },

              success: function(e) {
                  jQuery(e).closest('.form-group').removeClass('has-error');
                  jQuery(e).closest('.help-block').remove();
              },
              rules: {
                  ImageFile: {
                      required: true,
                  },
                  description: {
                      required: true,
                  },
              },
              messages: {
                  ImageFile: {
                      required: 'Please choose a picture',
                  },
                  description: {
                      required: 'Please enter a description',
                  },
              },
              submitHandler: function(form) {
                  \$form = \$(form);
                  var button = \$form.find('button[type=\"submit\"]');
                  button.attr('disabled', 'disabled');
                  button.text('saving..');
                  \$.ajax({
                      url:\$form.attr('action'),
                      type:'POST',
                      data:\$form.serialize(),
                      success: function(res) {
                          res = \$.parseJSON(res);
                          if (res.data == '1') {
                              form.reset();
                              \$('#modal-add-saran').modal('hide');
                              // window.tablekritik.api().ajax.reload();
                              alert(\"Kritik dan saran anda telah kami terima!!\")
                          }else {
                              alert(res.data);

                          }
                          button.removeAttr('disabled');
                          button.text('Save');
                      },

                      error: function(jqXHR, exception) {
                        console.log(jqXHR)
                          alert(jqXHR.statusText);

                          button.removeAttr('disabled');
                          button.text('Save');
                      },
                  });
                  return false; // required to block normal submit since you used ajax
              },
          });

          \$(function () {
            var path = window.location.href;
            \$('.navbar-nav li a').each(function(){
                path = path.replace('#', '');
                if(this.href === path){
                    \$(this).addClass('active');
                }

            });

            // var checkCookie = localStorage.getItem(\"silp\");
            // if (checkCookie != null) {
            //     \$('.navbar-nav > li > a:eq('+checkCookie+')').parent('li').addClass('open').next().show();
            // }
            //
            // \$('.navbar-nav > li > a').click(function(){
            //     var navIndex = \$('.navbar-nav > li > a').index(this);
            //     localStorage.setItem(\"silp\", navIndex);
            // });
          });
          
        <!-- ARTechnology -->
            function openModalFaq(target, type, id) {
                \$(target).modal('show');
            }
        </script>
        <!--
        <script src=\"";
        // line 509
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_faqs.js\"></script>
        -->
        <!-- ARTechnology -->
        ";
        // line 512
        $this->displayBlock('scripts', $context, $blocks);
        // line 513
        echo "
        <!--  -->
    </body>
</html>
";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
    }

    // line 88
    public function block_styles($context, array $blocks = array())
    {
    }

    // line 93
    public function block_inverted($context, array $blocks = array())
    {
    }

    // line 187
    public function block_header($context, array $blocks = array())
    {
    }

    // line 190
    public function block_content($context, array $blocks = array())
    {
    }

    // line 512
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "template/frontend.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  760 => 512,  755 => 190,  750 => 187,  745 => 93,  740 => 88,  735 => 9,  727 => 513,  725 => 512,  719 => 509,  550 => 343,  544 => 340,  540 => 339,  536 => 338,  529 => 334,  525 => 333,  521 => 332,  516 => 330,  512 => 329,  508 => 328,  504 => 327,  500 => 326,  496 => 325,  492 => 324,  488 => 323,  484 => 322,  446 => 287,  442 => 286,  432 => 279,  428 => 278,  422 => 275,  418 => 274,  407 => 267,  403 => 266,  394 => 260,  362 => 231,  324 => 196,  317 => 191,  315 => 190,  311 => 188,  309 => 187,  299 => 179,  294 => 177,  289 => 176,  282 => 172,  278 => 171,  274 => 170,  270 => 169,  266 => 168,  260 => 165,  254 => 162,  250 => 161,  246 => 160,  241 => 159,  239 => 158,  236 => 157,  230 => 155,  228 => 154,  223 => 152,  220 => 151,  214 => 149,  212 => 148,  207 => 146,  203 => 145,  197 => 142,  174 => 124,  149 => 102,  143 => 99,  134 => 93,  128 => 89,  126 => 88,  53 => 18,  49 => 17,  45 => 16,  35 => 9,  25 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->*/
/* <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->*/
/* <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->*/
/* <!--[if gt IE 8]><!-->*/
/* <html class="no-js"> <!--<![endif]-->*/
/*     <head>*/
/*         <meta charset="utf-8">*/
/*         <title>{% block title %}{% endblock %} | Indonesia Canines</title>*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*         <meta name="description" content="">*/
/*         <meta name="keywords" content="Pastikan Anjing kesayangan Anda tersertifikasi Kami siap melayani!">*/
/*         <meta name="author" content="ARTechnology">*/
/* */
/*         <link href="{{base_url()}}assets/coco/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />*/
/*         <link href="{{base_url()}}assets/coco/libs/animate-css/animate.min.css" rel="stylesheet" />*/
/*         <link href="{{base_url()}}assets/coco/libs/iconmoon/style.css" rel="stylesheet" />*/
/*         <link rel="shortcut icon" href="http://www.mascotdesigngallery.com/wp/wp-content/uploads/2014/10/theincredibleenglishclub.png">*/
/*         <style media="screen">*/
/* */
/*         body {*/
/* */
/*         }*/
/*         /*@media (min-width: 768px)*//* */
/*         .navbar-form {*/
/*   /*border-color: #ff1515;*//* */
/*           margin-top: -8px;*/
/*           margin-left: -40px;*/
/*           /*margin-left: -25px;*//* */
/*         }*/
/* */
/*         /*@media (min-width: 768px)*//* */
/*         .navbar-form .form-control {*/
/*             display: inline-block;*/
/*             /*width: 220px;*//* */
/*             vertical-align: middle;*/
/*         }*/
/* */
/*         h1{*/
/*           font-family: Trajan !important;*/
/*             src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         h2{*/
/*           font-family: Trajan !important;*/
/*             src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         h3{*/
/*           font-family: Trajan !important;*/
/*             src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         h4{*/
/*           font-family: Trajan !important;*/
/*             src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         h5{*/
/*           font-family: Trajan !important;*/
/*             src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         h6{*/
/*           font-family: Trajan !important;*/
/*             src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         .navbar-header{*/
/*           font-family: Trajan !important;*/
/*            src: url(assets/font/Trajan.ttf) !important;*/
/*         }*/
/*         /* ARTechnology *//* */
/*         a .dropdown-a{*/
/*             background-color: #000000 !important;*/
/*         }*/
/*         ul .dropdown-ul{*/
/*             background-color: #000000 !important;*/
/*             color: #FFFFFF !important;*/
/*         }*/
/*         .dropdown-ul > li > a{*/
/*             color: #FFFFFF !important;*/
/*         }*/
/*         .dropdown-ul > li > a:hover{*/
/*             color: #000000 !important;*/
/*         }*/
/*         .red{*/
/*             color: red !important;*/
/*         }*/
/*         /* ARTechnology *//* */
/*         </style>*/
/* */
/*         {% block styles %}{% endblock %}*/
/*     </head>*/
/*     <body style="  font-family: Trajan !important;*/
/*       src: url(assets/font/Trajan.ttf) !important;">*/
/*       <div id="wrapper">*/
/*             <header class="{% block inverted %}{% endblock %}" >*/
/*                 <div id="topbar">*/
/*                     <div class="container">*/
/*                         <div class="row">*/
/*                             <div class="col-sm-6 col-xs-6">*/
/*                                 <span class="hidden-sm hidden-xs"><i class="icon-location4"></i>*/
/*                                     {{contact.con_address}}*/
/*                                 </span>*/
/*                                 <span class="vertical-space"></span>*/
/*                                 <i class="icon-phone4"></i>{{contact.con_phone_number}}*/
/*                             </div>*/
/*                             <div class="col-sm-6 col-xs-6 text-right">*/
/*                                 <div class="btn-group social-links hidden-sm hidden-xs">*/
/*                                     <a href="https://www.facebook.com/Indonesian-Canine-Registry-1793017194288491/" class="btn btn-link"><i class="icon-facebook6"></i></a>*/
/*                                     <a href="https://www.instagram.com/icr_indonesia/" class="btn btn-link"><i class="icon-instagram3"></i></a>*/
/*                                 </div>*/
/*                                 <!--<a href="login.html" class="login-button">LOGIN</a><a href="signup.html" class="signup-button">SIGN UP</a>-->*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="top-divider"></div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <nav class="navbar navbar-default" role="navigation" style=" font-family: Trajan !important;*/
/*                   src: url(assets/font/Trajan.ttf) !important;">*/
/*                     <div class="container">*/
/*                         <!-- Brand and toggle get grouped for better mobile display -->*/
/*                         <div class="navbar-header">*/
/*                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">*/
/*                                 <span class="icon-navicon"></span>*/
/*                             </button>*/
/*                             <a class="navbar-brand" href="index.html">*/
/*                                 <!--<img src="{{base_url()}}assets/coco/img/logo.png" data-dark-src="{{base_url()}}assets/coco/img/logo_dark.png" alt="Coco Frontend Template" class="logo">-->*/
/*                             </a>*/
/*                         </div>*/
/* */
/*                         <!-- Collect the nav links, forms, and other content for toggling -->*/
/*                         <div class="collapse navbar-collapse" id="main-navigation" style=" font-family: Trajan !important;*/
/*                           src: url(assets/font/Trajan.ttf) !important;">*/
/*                             <!-- <ul class="nav navbar-nav navbar-left">*/
/*                               <form class="navbar-form" role="search">*/
/*                                 <div class="form-group">*/
/*                                   <input type="text" class="form-control" placeholder="Pencarian anjing..">*/
/*                                 </div>*/
/*                                 <button type="submit" style="margin-left: -6px;"class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>*/
/*                               </form>*/
/*                             </ul> -->*/
/* */
/*                             <ul class="nav navbar-nav navbar-right" style="">*/
/* */
/*                                 <li><a href="{{base_url()}}">BERANDA</a></li>*/
/*                                 <!-- ARTechnology -->*/
/*                                 <!--*/
/*                                 <li><a href="{{base_url()}}profile">PROFIL</a></li>*/
/*                                 <li><a href="{{base_url()}}service">ATURAN</a></li>*/
/* */
/*                                 {% if products %}*/
/*                                   <li><a href="{{base_url()}}product">PRODUK</a></li>*/
/*                                 {% endif %}*/
/*                                 -->*/
/*                                 <li><a href="{{base_url()}}events">ACARA </a></li>*/
/*                                 <!--*/
/*                                 {% if sponsors %}*/
/*                                   <li><a href="{{base_url()}}sponsor">SPONSOR </a></li>*/
/*                                 {% endif %}*/
/*                                 -->*/
/*                                 {% if users %}*/
/*                                     <li><a href="{{base_url()}}pedigrees">CARI SILSILAH</a></li>*/
/*                                     <li><a href="{{base_url()}}canines">LIST ANJING</a></li>*/
/*                                     <li><a href="{{base_url()}}studs">LIST PACAK</a></li>*/
/*                                     <li><a href="{{base_url()}}births">LIST LAHIR</a></li>*/
/*                                     <li>*/
/*                                         <a class="dropdown-a" href="#" data-toggle="dropdown">*/
/*                                             {{users.mem_username}}<span class="caret"></span>*/
/*                                         </a>*/
/*                                         <ul class="dropdown-menu dropdown-ul">*/
/*                                             <li><a href="{{base_url()}}members">UBAH PROFIL</a></li>*/
/*                                             <li><a href="{{base_url()}}members/logs">LIST REQUEST UBAH PROFIL</a></li>*/
/*                                             <li><a href="{{base_url()}}members/ubah_password">UBAH PASSWORD</a></li>*/
/*                                             <li><a href="{{base_url()}}notification">NOTIFIKASI</a></li>*/
/*                                             <li><a href="{{base_url()}}signin/logout">SIGN OUT</a></li>*/
/*                                         </ul>*/
/*                                     </li>*/
/*                                 {% else %}*/
/*                                     <li><a href="{{base_url()}}signup">SIGN UP</a></li>*/
/*                                     <li><a href="{{base_url()}}signin">SIGN IN</a></li>*/
/*                                 {% endif %}*/
/*                                 <!--<li><a href="contact.html">KONTAK</a></li>-->*/
/*                                 <!-- ARTechnology -->*/
/*                             </ul>*/
/*                         </div>*/
/*                         <!-- /.navbar-collapse -->*/
/*                     </div>*/
/*                     <!-- /.container-->*/
/*                 </nav>*/
/*                 {% block header %}{% endblock %}*/
/*             </header>*/
/* */
/*             {% block content %}{% endblock %}*/
/* */
/*             <!-- sample modal content -->*/
/* 								  <div id="modal-add-kritik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">*/
/* 								    <div class="modal-dialog">*/
/* 								      <div class="modal-content">*/
/*                       <form action="{{base_url()}}faqs/add" class="form-add-kritik form-horizontal" method="post">*/
/* 								        <div class="modal-header">*/
/* 								          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/* 								          <h4 class="modal-title" id="myModalLabel">Kritik</h4>*/
/* 								        </div>*/
/* 								        <div class="modal-body">*/
/*                           <div class="form-group">*/
/*                               <div class="col-xs-12">*/
/*                                 <label for="email-add-kritik">Email</label>*/
/*                                 <input class="form-control" id="email-add-kritik" name="tes_email" type="email" required>*/
/*                                 <input class="form-control" name="tes_type" type="hidden" value="Kritik" required>*/
/*                               </div>*/
/*                           </div>*/
/*                           <div class="form-group">*/
/*                               <div class="col-xs-12">*/
/*                                 <label for="content-update-kritik">Konten</label>*/
/*                                 <textarea class="form-control" name="tes_content" id="content-update-kritik"  rows="4" cols="20" required></textarea>*/
/*                               </div>*/
/*                           </div>*/
/* 								        </div>*/
/* 								        <div class="modal-footer">*/
/*                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>*/
/*                           <button type="submit" class="btn btn-primary submit-add-kritik">Kirim Kritik</button>*/
/* 								        </div>*/
/*                       </form>*/
/* 								      </div><!-- /.modal-content -->*/
/* 								    </div><!-- /.modal-dialog -->*/
/* 								  </div><!-- /.modal -->*/
/* */
/* */
/*                   <!-- sample modal content -->*/
/*                         <div id="modal-add-saran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">*/
/*                           <div class="modal-dialog">*/
/*                             <div class="modal-content">*/
/* */
/*                             <form action="{{base_url()}}faqs/add" class="form-add-saran form-horizontal" method="post">*/
/*                               <div class="modal-header">*/
/*                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                                 <h4 class="modal-title" id="myModalLabel">Saran</h4>*/
/*                               </div>*/
/*                               <div class="modal-body">*/
/*                                 <div class="form-group">*/
/*                                     <div class="col-xs-12">*/
/*                                       <label for="email-add-saran">Email</label>*/
/*                                       <input class="form-control" id="email-add-saran" name="tes_email" type="email" required>*/
/*                                       <input class="form-control" name="tes_type" type="hidden" value="saran" required>*/
/*                                     </div>*/
/*                                 </div>*/
/*                                 <div class="form-group">*/
/*                                     <div class="col-xs-12">*/
/*                                       <label for="content-update-saran">Konten</label>*/
/*                                       <textarea class="form-control" name="tes_content" id="content-update-saran"  rows="4" cols="20" required></textarea>*/
/*                                     </div>*/
/*                                 </div>*/
/*                               </div>*/
/*                               <div class="modal-footer">*/
/*                                 <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>*/
/*                                 <button type="submit" class="btn btn-primary submit-add-saran">Kirim Saran</button>*/
/*                               </div>*/
/*                             </form>*/
/*                             </div><!-- /.modal-content -->*/
/*                           </div><!-- /.modal-dialog -->*/
/*                         </div><!-- /.modal -->*/
/* */
/*             <footer style="background: #343838 url({{base_url()}}assets/coco/images/footer-bg.png) center 20px no-repeat;background-size: 30%;">*/
/*                 <section id="contact">*/
/*                 <div class="container">*/
/*                     <div class="row">*/
/*                         <div class="col-sm-4">*/
/*                             <a href="#" >*/
/*                                 <!--<img src="{{base_url()}}assets/coco/img/logo.png" alt="Coco Frontend Template" class="footer-logo">-->*/
/*                                 <img src="{{base_url()}}{{profile.prof_logo}}" alt="Coco Frontend Template" style="width: 100px; margin-top : 5px;">*/
/*                             </a>*/
/*                             <h5>Indonesian Caniene Registry</h5>*/
/*                         </div>*/
/*                         <div class="col-sm-4 text-white">*/
/*                             <h4>Hubungi Kami</h4>*/
/*                             <ul class="list-unstyled company-info">*/
/*                                 <li><i class="icon-map-marker"></i> {{contact.con_address}}</li>*/
/*                                 <li><i class="icon-phone3"></i> {{contact.con_phone_number}}</li>*/
/*                                 <!--<li><i class="icon-envelope"></i> <a href="mailto:contact@somecorporation.com">contact@somecorporation.com</a></li>-->*/
/*                                 <li><i class="icon-alarm2"></i>*/
/*                                         {{contact.con_open_time}}*/
/*                                     <br>{{contact.con_close_time}}</li>*/
/*                             </ul>*/
/*                         </div>*/
/* */
/*                         <div class="col-sm-4 hidden-xs">*/
/*                             <h4>Sosial Media</h4>*/
/*                             <ul class="list-unstyled social-stream">*/
/*                                 <li><a href="{{contact.con_facebook}}"><i class="icon-facebook6"></i> Kunjungi Facebook kami</a></li>*/
/*                                 <li><a href="{{contact.con_twitter}}"><i class="icon-instagram3"></i> Kunjungi Instagram kami</a></li>*/
/*                             </ul>*/
/*                             <hr>*/
/*                             <ul class="list-unstyled social-stream">*/
/*                                 <li><button type="button" class="btn btn-default btn-sm"name="button" onClick="openModalFaq('#modal-add-kritik', 'add')" >Kritik</button> &nbsp; <button type="button" class="btn btn-default btn-sm"name="button"  onClick="openModalFaq('#modal-add-saran', 'add')"><i class="icon-comment"></i> Saran</button></li>*/
/*                             </ul>*/
/*                         </div>*/
/*                     </div>*/
/*                     <hr>*/
/*                     <div class="row">*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="col-sm-6">*/
/*                             <p>Copyright &copy; 2017 by <a href="http://www.icrpedigree.com" target="_blank">Indonesian Canine Registry</a> - Powered by <a href="http://artechnology.tech" title="ARTechnology" target="_blank"><span class="red">ART</span>echnology</a></p>*/
/*                         </div>*/
/*                         <!-- ARTechnology -->*/
/*                         <div class="col-sm-6 text-right">*/
/*                             <div class="social-links">*/
/*                                 <!--                                <a href="https://www.facebook.com/Indonesian-Canine-Registry-1793017194288491/">*/
/*                                                                     <i class="icon-facebook4"></i>*/
/*                                                                 </a>*/
/*                                                                 <a href="https://www.instagram.com/icr_indonesia/">*/
/*                                                                     <i class="icon-instagram3"></i>*/
/*                                                                 </a>-->*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 </section>*/
/*             </footer>*/
/*             <a class="tothetop" href="javascript:;"><i class="icon-angle-up"></i></a>*/
/*         </div>*/
/* */
/*         <script>*/
/*             var resizefunc = [];*/
/*         </script>*/
/*         <script src="{{base_url()}}assets/coco/libs/less-js/less-1.7.5.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/jquery/jquery-1.11.1.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/bootstrap/js/bootstrap.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/jquery-browser/jquery.browser.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/fastclick/fastclick.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/stellarjs/jquery.stellar.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/jquery-appear/jquery.appear.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/pace/pace.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/js/init.js"></script>*/
/*         <!-- Page Specific JS Libraries -->*/
/*         <script src="{{base_url()}}assets/coco/libs/owl-carousel/owl.carousel.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/libs/jquery-magnific/jquery.magnific-popup.min.js"></script>*/
/*         <script src="{{base_url()}}assets/coco/js/pages/index.js"></script>*/
/*         <!-- Page Specific JS Libraries End -->*/
/* */
/*         <!-- Page JS Plugins -->*/
/*         <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>*/
/*         <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* */
/*         <!-- Page JS Code -->*/
/*         <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* */
/*         <script>*/
/*           jQuery('.form-add-kritik').validate({*/
/*               errorClass: 'help-block text-right animated fadeInDown',*/
/*               errorElement: 'div',*/
/*               errorPlacement: function(error, e) {*/
/*                   jQuery(e).parents('.form-group > div').append(error);*/
/*               },*/
/* */
/*               highlight: function(e) {*/
/*                   jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');*/
/*                   jQuery(e).closest('.help-block').remove();*/
/*               },*/
/* */
/*               success: function(e) {*/
/*                   jQuery(e).closest('.form-group').removeClass('has-error');*/
/*                   jQuery(e).closest('.help-block').remove();*/
/*               },*/
/*               rules: {*/
/*                   ImageFile: {*/
/*                       required: true,*/
/*                   },*/
/*                   description: {*/
/*                       required: true,*/
/*                   },*/
/*               },*/
/*               messages: {*/
/*                   ImageFile: {*/
/*                       required: 'Please choose a picture',*/
/*                   },*/
/*                   description: {*/
/*                       required: 'Please enter a description',*/
/*                   },*/
/*               },*/
/*               submitHandler: function(form) {*/
/*                   $form = $(form);*/
/*                   var button = $form.find('button[type="submit"]');*/
/*                   button.attr('disabled', 'disabled');*/
/*                   button.text('saving..');*/
/*                   $.ajax({*/
/*                       url:$form.attr('action'),*/
/*                       type:'POST',*/
/*                       data:$form.serialize(),*/
/*                       success: function(res) {*/
/*                           res = $.parseJSON(res);*/
/*                           if (res.data == '1') {*/
/*                               form.reset();*/
/*                               $('#modal-add-kritik').modal('hide');*/
/*                               // window.tablekritik.api().ajax.reload();*/
/*                               alert("Kritik dan saran anda telah kami terima!!")*/
/*                           }else {*/
/*                               alert(res.data);*/
/* */
/*                           }*/
/*                           button.removeAttr('disabled');*/
/*                           button.text('Save');*/
/*                       },*/
/* */
/*                       error: function(jqXHR, exception) {*/
/*                         console.log(jqXHR)*/
/*                           alert(jqXHR.statusText);*/
/* */
/*                           button.removeAttr('disabled');*/
/*                           button.text('Save');*/
/*                       },*/
/*                   });*/
/*                   return false; // required to block normal submit since you used ajax*/
/*               },*/
/*           });*/
/* */
/*           jQuery('.form-add-saran').validate({*/
/*               errorClass: 'help-block text-right animated fadeInDown',*/
/*               errorElement: 'div',*/
/*               errorPlacement: function(error, e) {*/
/*                   jQuery(e).parents('.form-group > div').append(error);*/
/*               },*/
/* */
/*               highlight: function(e) {*/
/*                   jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');*/
/*                   jQuery(e).closest('.help-block').remove();*/
/*               },*/
/* */
/*               success: function(e) {*/
/*                   jQuery(e).closest('.form-group').removeClass('has-error');*/
/*                   jQuery(e).closest('.help-block').remove();*/
/*               },*/
/*               rules: {*/
/*                   ImageFile: {*/
/*                       required: true,*/
/*                   },*/
/*                   description: {*/
/*                       required: true,*/
/*                   },*/
/*               },*/
/*               messages: {*/
/*                   ImageFile: {*/
/*                       required: 'Please choose a picture',*/
/*                   },*/
/*                   description: {*/
/*                       required: 'Please enter a description',*/
/*                   },*/
/*               },*/
/*               submitHandler: function(form) {*/
/*                   $form = $(form);*/
/*                   var button = $form.find('button[type="submit"]');*/
/*                   button.attr('disabled', 'disabled');*/
/*                   button.text('saving..');*/
/*                   $.ajax({*/
/*                       url:$form.attr('action'),*/
/*                       type:'POST',*/
/*                       data:$form.serialize(),*/
/*                       success: function(res) {*/
/*                           res = $.parseJSON(res);*/
/*                           if (res.data == '1') {*/
/*                               form.reset();*/
/*                               $('#modal-add-saran').modal('hide');*/
/*                               // window.tablekritik.api().ajax.reload();*/
/*                               alert("Kritik dan saran anda telah kami terima!!")*/
/*                           }else {*/
/*                               alert(res.data);*/
/* */
/*                           }*/
/*                           button.removeAttr('disabled');*/
/*                           button.text('Save');*/
/*                       },*/
/* */
/*                       error: function(jqXHR, exception) {*/
/*                         console.log(jqXHR)*/
/*                           alert(jqXHR.statusText);*/
/* */
/*                           button.removeAttr('disabled');*/
/*                           button.text('Save');*/
/*                       },*/
/*                   });*/
/*                   return false; // required to block normal submit since you used ajax*/
/*               },*/
/*           });*/
/* */
/*           $(function () {*/
/*             var path = window.location.href;*/
/*             $('.navbar-nav li a').each(function(){*/
/*                 path = path.replace('#', '');*/
/*                 if(this.href === path){*/
/*                     $(this).addClass('active');*/
/*                 }*/
/* */
/*             });*/
/* */
/*             // var checkCookie = localStorage.getItem("silp");*/
/*             // if (checkCookie != null) {*/
/*             //     $('.navbar-nav > li > a:eq('+checkCookie+')').parent('li').addClass('open').next().show();*/
/*             // }*/
/*             //*/
/*             // $('.navbar-nav > li > a').click(function(){*/
/*             //     var navIndex = $('.navbar-nav > li > a').index(this);*/
/*             //     localStorage.setItem("silp", navIndex);*/
/*             // });*/
/*           });*/
/*           */
/*         <!-- ARTechnology -->*/
/*             function openModalFaq(target, type, id) {*/
/*                 $(target).modal('show');*/
/*             }*/
/*         </script>*/
/*         <!--*/
/*         <script src="{{ base_url() }}/assets/oneui/js/pages/adm_faqs.js"></script>*/
/*         -->*/
/*         <!-- ARTechnology -->*/
/*         {% block scripts %}{% endblock %}*/
/* */
/*         <!--  -->*/
/*     </body>*/
/* </html>*/
/* */
