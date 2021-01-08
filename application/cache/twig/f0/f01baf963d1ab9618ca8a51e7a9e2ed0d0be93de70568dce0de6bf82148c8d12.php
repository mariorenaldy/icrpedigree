<?php

/* login.twig */
class __TwigTemplate_b49819b824632ba036e271ba8589f8f89d84f03127436ea650a9fdb6d351f62b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
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

        <title>Login - ICR</title>

        <meta name=\"description\" content=\"OneUI - Admin Dashboard Template & UI Framework created by pixelcave and published on Themeforest\">
        <meta name=\"author\" content=\"pixelcave\">
        <meta name=\"robots\" content=\"noindex, nofollow\">
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1.0\">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel=\"shortcut icon\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/img/favicons/favicon.png\">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700\">

        <!-- Bootstrap and OneUI CSS framework -->
        <link rel=\"stylesheet\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/css/bootstrap.min.css\">
        <link rel=\"stylesheet\" id=\"css-main\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/css/oneui.css\">
        <link rel=\"stylesheet\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.css\" >
        <style media=\"screen\">

        body{
          background-color: #fff;
        }
        .login{
          margin-top: 100px;
          color: #fff;
          background-color: #7f4e1d;
          padding: 30px;
          box-shadow: 5px 5px 3px #d8d8d8;
          border-radius: 4px;

        }

        .login hr{
          border-color: #fff;
        }

        .img-circle{
          padding: 10px;
        }

        .block-content.block-content-full {
            padding-bottom: 0px;
        }
        </style>
    </head>
    <body>

        <div class=\"container\">
            <div class=\"row \">
                <div class=\"col-md-4\">
                </div>
                <div class=\"col-md-4 login\">
                    <img src=\"";
        // line 62
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/logo.png\" style=\"float:left; padding-right:5px; margin-top:-5px;\" class=\"img\" width=\"60px\"alt=\"\" />
                    <p class=\"h4 font-w600 text-center\">

                        <strong>ICR</strong>
                        <br>
                        (Indonesian Canine Registry)
                    </p>
                    <hr>
                    <div class=\"block-content \">
                      <form class=\"form-horizontal form-login\" action=\"";
        // line 71
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/auth\" method=\"post\">
                        <div class=\"form-group\">
                          <label class=\"control-label\" for=\"username\">Nama Pengguna</label>
                          <div class=\"\">
                            <input class=\"form-control\" type=\"text\" id=\"username\" name=\"username\" placeholder=\"Masukan nama pengguna..\" required>
                          </div>
                        </div>
                        <div class=\"form-group\">
                          <label class=\"control-label\" for=\"password\">Kata Sandi</label>
                          <div class=\"\">
                            <input class=\"form-control\" type=\"password\" id=\"password\" name=\"password\" placeholder=\"Masukan Kata Sandi..\" required minlength=\"5\">
                          </div>
                        </div>
                        <div class=\"form-group\">
                          <div class=\"\">
                            <button class=\"btn btn-md btn-default\" type=\"submit\"><i class=\"si si-login\"></i> Masuk</button>
                            <!-- <a href=\"#\" class=\"h5\" style=\"float:right;margin-top:9px;\">Lupa kata sandi?</a> -->
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
                <div class=\"col-md-4\">
                </div>
    </div>
</div>

        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src=\"";
        // line 99
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.min.js\"></script>
        <script src=\"";
        // line 100
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/bootstrap.min.js\"></script>
        <script src=\"";
        // line 101
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.slimscroll.min.js\"></script>
        <script src=\"";
        // line 102
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.scrollLock.min.js\"></script>
        <script src=\"";
        // line 103
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.appear.min.js\"></script>
        <script src=\"";
        // line 104
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.countTo.min.js\"></script>
        <script src=\"";
        // line 105
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/jquery.placeholder.min.js\"></script>
        <script src=\"";
        // line 106
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/core/js.cookie.min.js\"></script>
        <script src=\"";
        // line 107
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/app.js\"></script>
        <script src=\"";
        // line 108
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>

        <!-- Page JS Code -->
        <script src=\"";
        // line 111
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/sweetalert/dist/sweetalert.min.js\"></script>
        <script src=\"";
        // line 112
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/login.js\"></script>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 112,  179 => 111,  173 => 108,  169 => 107,  165 => 106,  161 => 105,  157 => 104,  153 => 103,  149 => 102,  145 => 101,  141 => 100,  137 => 99,  106 => 71,  94 => 62,  55 => 26,  51 => 25,  47 => 24,  36 => 16,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->*/
/* <!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->*/
/*     <head>*/
/*         <meta charset="utf-8">*/
/* */
/*         <title>Login - ICR</title>*/
/* */
/*         <meta name="description" content="OneUI - Admin Dashboard Template & UI Framework created by pixelcave and published on Themeforest">*/
/*         <meta name="author" content="pixelcave">*/
/*         <meta name="robots" content="noindex, nofollow">*/
/*         <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">*/
/* */
/*         <!-- Icons -->*/
/*         <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->*/
/*         <link rel="shortcut icon" href="{{base_url()}}assets/img/favicons/favicon.png">*/
/*         <!-- END Icons -->*/
/* */
/*         <!-- Stylesheets -->*/
/*         <!-- Web fonts -->*/
/*         <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">*/
/* */
/*         <!-- Bootstrap and OneUI CSS framework -->*/
/*         <link rel="stylesheet" href="{{base_url()}}assets/oneui/css/bootstrap.min.css">*/
/*         <link rel="stylesheet" id="css-main" href="{{base_url()}}assets/oneui/css/oneui.css">*/
/*         <link rel="stylesheet" href="{{base_url()}}assets/sweetalert/dist/sweetalert.css" >*/
/*         <style media="screen">*/
/* */
/*         body{*/
/*           background-color: #fff;*/
/*         }*/
/*         .login{*/
/*           margin-top: 100px;*/
/*           color: #fff;*/
/*           background-color: #7f4e1d;*/
/*           padding: 30px;*/
/*           box-shadow: 5px 5px 3px #d8d8d8;*/
/*           border-radius: 4px;*/
/* */
/*         }*/
/* */
/*         .login hr{*/
/*           border-color: #fff;*/
/*         }*/
/* */
/*         .img-circle{*/
/*           padding: 10px;*/
/*         }*/
/* */
/*         .block-content.block-content-full {*/
/*             padding-bottom: 0px;*/
/*         }*/
/*         </style>*/
/*     </head>*/
/*     <body>*/
/* */
/*         <div class="container">*/
/*             <div class="row ">*/
/*                 <div class="col-md-4">*/
/*                 </div>*/
/*                 <div class="col-md-4 login">*/
/*                     <img src="{{base_url()}}assets/oneui/img/logo.png" style="float:left; padding-right:5px; margin-top:-5px;" class="img" width="60px"alt="" />*/
/*                     <p class="h4 font-w600 text-center">*/
/* */
/*                         <strong>ICR</strong>*/
/*                         <br>*/
/*                         (Indonesian Canine Registry)*/
/*                     </p>*/
/*                     <hr>*/
/*                     <div class="block-content ">*/
/*                       <form class="form-horizontal form-login" action="{{base_url()}}backend/auth" method="post">*/
/*                         <div class="form-group">*/
/*                           <label class="control-label" for="username">Nama Pengguna</label>*/
/*                           <div class="">*/
/*                             <input class="form-control" type="text" id="username" name="username" placeholder="Masukan nama pengguna.." required>*/
/*                           </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                           <label class="control-label" for="password">Kata Sandi</label>*/
/*                           <div class="">*/
/*                             <input class="form-control" type="password" id="password" name="password" placeholder="Masukan Kata Sandi.." required minlength="5">*/
/*                           </div>*/
/*                         </div>*/
/*                         <div class="form-group">*/
/*                           <div class="">*/
/*                             <button class="btn btn-md btn-default" type="submit"><i class="si si-login"></i> Masuk</button>*/
/*                             <!-- <a href="#" class="h5" style="float:right;margin-top:9px;">Lupa kata sandi?</a> -->*/
/*                           </div>*/
/*                         </div>*/
/*                       </form>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="col-md-4">*/
/*                 </div>*/
/*     </div>*/
/* </div>*/
/* */
/*         <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->*/
/*         <script src="{{base_url()}}assets/oneui/js/core/jquery.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/bootstrap.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/jquery.slimscroll.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/jquery.scrollLock.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/jquery.appear.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/jquery.countTo.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/jquery.placeholder.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/core/js.cookie.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/app.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* */
/*         <!-- Page JS Code -->*/
/*         <script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>*/
/*         <script src="{{base_url()}}assets/oneui/js/pages/login.js"></script>*/
/*     </body>*/
/* </html>*/
/* */
