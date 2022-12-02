<?php

/* backend/dashboard.twig */
class __TwigTemplate_529fe65e279612ad720392b4e0bec048c6efb0edca162da1fbc57c2cab8a97ff extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/dashboard.twig", 1);
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

";
    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        // line 13
        echo "<div class=\"content wrap-breadcrumb\">
\t<div class=\"col-sm-12 text-right hidden-xs\">
\t\t<ol class=\"breadcrumb\">
\t\t\t<li>Dashboard</li>
\t\t</ol>
\t</div>
</div>
<!-- Page Content -->

<div class=\"content\">
\t<!-- Dynamic Table Full -->
\t<div class=\"block\">
\t\t<div class=\"block-header text-center bg-gray-lighter\">

\t\t\t<h4> <small>Dashboard</small></h4>
\t\t</div>
\t\t<div class=\"block-content table-requonsive\">
\t\t\t";
        // line 30
        if (($this->getAttribute((isset($context["users"]) ? $context["users"] : null), "use_akses", array()) == 1)) {
            // line 31
            echo "\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 33
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/canines\">
\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-danger ribbon ribbon-bookmark ribbon-crystal\">
\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 36
            echo twig_escape_filter($this->env, (isset($context["canine"]) ? $context["canine"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t<em>Canine</em>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 46
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/members\">
\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-amethyst ribbon ribbon-bookmark ribbon-crystal\">
\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t<i class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t\t\t\t";
            // line 52
            echo twig_escape_filter($this->env, (isset($context["member"]) ? $context["member"] : null), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t\t\t</i>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t<em>
\t\t\t\t\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t\t\t\tMember
\t\t\t\t\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t\t\t</em>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 68
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/studs/view\">
\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-success ribbon ribbon-bookmark ribbon-crystal\">
\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t<i class=\"text-white-op\"><!-- ARTechnology -->
\t\t\t\t\t\t\t\t\t";
            // line 73
            echo twig_escape_filter($this->env, (isset($context["stud"]) ? $context["stud"] : null), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t<!-- ARTechnology --></i>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t<em>
\t\t\t\t\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t\t\t\tPacak
\t\t\t\t\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t\t\t\t</em>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 90
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/births/view\">
\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-primary-dark ribbon ribbon-bookmark ribbon-crystal\">
\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 93
            echo twig_escape_filter($this->env, (isset($context["birth"]) ? $context["birth"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t<em>Birth</em>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 102
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/events\">
\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-warning ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 106
            echo twig_escape_filter($this->env, (isset($context["event"]) ? $context["event"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t<em>Event</em>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 115
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/products\">
\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-info ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 119
            echo twig_escape_filter($this->env, (isset($context["product"]) ? $context["product"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t<em>Produk</em>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- ARTechnology -->
\t\t\t\t</div>
\t\t\t\t";
        } elseif (($this->getAttribute(        // line 129
(isset($context["users"]) ? $context["users"] : null), "use_akses", array()) == 2)) {
            // line 130
            echo "\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 132
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/canines\">
\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-danger ribbon ribbon-bookmark ribbon-crystal\">
\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 135
            echo twig_escape_filter($this->env, (isset($context["canine"]) ? $context["canine"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t<em>Canine</em>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"#\">
\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-success ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 149
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["pegawai"]) ? $context["pegawai"] : null)), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t<em>Pegawai</em>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 159
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/events\">
\t\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-warning ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 163
            echo twig_escape_filter($this->env, (isset($context["event"]) ? $context["event"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t\t<em>Event</em>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 172
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/products\">
\t\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-info ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 176
            echo twig_escape_filter($this->env, (isset($context["product"]) ? $context["product"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t\t<em>Produk</em>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t\t";
        } elseif (($this->getAttribute(        // line 186
(isset($context["users"]) ? $context["users"] : null), "use_akses", array()) == 3)) {
            // line 187
            echo "
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-md-2\"></div>
\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 191
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/events\">
\t\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-warning ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 195
            echo twig_escape_filter($this->env, (isset($context["event"]) ? $context["event"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t\t<em>Event</em>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t<a class=\"block block-link-hover3\" href=\"";
            // line 204
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "backend/products\">
\t\t\t\t\t\t\t\t<div class=\"block-content block-content-full text-center bg-info ribbon ribbon-bookmark ribbon-crystal\">

\t\t\t\t\t\t\t\t\t<div class=\"item item-2x item-circle bg-crystal-op push-20-t push-20\">
\t\t\t\t\t\t\t\t\t\t<i class=\"text-white-op\">";
            // line 208
            echo twig_escape_filter($this->env, (isset($context["product"]) ? $context["product"] : null), "html", null, true);
            echo "</i>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"text-white-op\">
\t\t\t\t\t\t\t\t\t\t<em>Produk</em>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-md-2\"></div>
\t\t\t\t\t</div>

\t\t\t";
        }
        // line 220
        echo "


\t\t</div>
\t</div>
</div>

";
    }

    // line 229
    public function block_scripts($context, array $blocks = array())
    {
        // line 230
        echo "<!-- Page JS Plugins -->
";
    }

    public function getTemplateName()
    {
        return "backend/dashboard.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  359 => 230,  356 => 229,  345 => 220,  330 => 208,  323 => 204,  311 => 195,  304 => 191,  298 => 187,  296 => 186,  283 => 176,  276 => 172,  264 => 163,  257 => 159,  244 => 149,  227 => 135,  221 => 132,  217 => 130,  215 => 129,  202 => 119,  195 => 115,  183 => 106,  176 => 102,  164 => 93,  158 => 90,  138 => 73,  130 => 68,  111 => 52,  102 => 46,  89 => 36,  83 => 33,  79 => 31,  77 => 30,  58 => 13,  55 => 12,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* */
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/* 	<div class="col-sm-12 text-right hidden-xs">*/
/* 		<ol class="breadcrumb">*/
/* 			<li>Dashboard</li>*/
/* 		</ol>*/
/* 	</div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* 	<!-- Dynamic Table Full -->*/
/* 	<div class="block">*/
/* 		<div class="block-header text-center bg-gray-lighter">*/
/* */
/* 			<h4> <small>Dashboard</small></h4>*/
/* 		</div>*/
/* 		<div class="block-content table-requonsive">*/
/* 			{% if users.use_akses == 1 %}*/
/* 			<div class="row">*/
/* 				<div class="col-md-4">*/
/* 					<a class="block block-link-hover3" href="{{base_url()}}backend/canines">*/
/* 						<div class="block-content block-content-full text-center bg-danger ribbon ribbon-bookmark ribbon-crystal">*/
/* 							<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 								<i class="text-white-op">{{canine}}</i>*/
/* 							</div>*/
/* 							<div class="text-white-op">*/
/* 								<em>Canine</em>*/
/* 							</div>*/
/* 						</div>*/
/* 					</a>*/
/* 				</div>*/
/* 				<div class="col-md-4">*/
/* 					<!-- ARTechnology -->*/
/* 					<a class="block block-link-hover3" href="{{base_url()}}backend/members">*/
/* 					<!-- ARTechnology -->*/
/* 						<div class="block-content block-content-full text-center bg-amethyst ribbon ribbon-bookmark ribbon-crystal">*/
/* 							<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 								<i class="text-white-op">*/
/* 									<!-- ARTechnology -->*/
/* 									{{member}}*/
/* 									<!-- ARTechnology -->*/
/* 								</i>*/
/* 							</div>*/
/* 							<div class="text-white-op">*/
/* 								<em>*/
/* 									<!-- ARTechnology -->*/
/* 									Member*/
/* 									<!-- ARTechnology -->*/
/* 								</em>*/
/* 							</div>*/
/* 						</div>*/
/* 					</a>*/
/* 				</div>*/
/* 				<div class="col-md-4">*/
/* 					<!-- ARTechnology -->*/
/* 					<a class="block block-link-hover3" href="{{base_url()}}backend/studs/view">*/
/* 					<!-- ARTechnology -->*/
/* 						<div class="block-content block-content-full text-center bg-success ribbon ribbon-bookmark ribbon-crystal">*/
/* 							<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 								<i class="text-white-op"><!-- ARTechnology -->*/
/* 									{{stud}}*/
/* 									<!-- ARTechnology --></i>*/
/* 							</div>*/
/* 							<div class="text-white-op">*/
/* 								<em>*/
/* 									<!-- ARTechnology -->*/
/* 									Pacak*/
/* 									<!-- ARTechnology -->*/
/* 								</em>*/
/* 							</div>*/
/* 						</div>*/
/* 					</a>*/
/* 				</div>*/
/* 				</div>*/
/* 				<div class="row">*/
/* 					<!-- ARTechnology -->*/
/* 					<div class="col-md-4">*/
/* 						<a class="block block-link-hover3" href="{{base_url()}}backend/births/view">*/
/* 							<div class="block-content block-content-full text-center bg-primary-dark ribbon ribbon-bookmark ribbon-crystal">*/
/* 								<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 									<i class="text-white-op">{{birth}}</i>*/
/* 								</div>*/
/* 								<div class="text-white-op">*/
/* 									<em>Birth</em>*/
/* 								</div>*/
/* 							</div>*/
/* 						</a>*/
/* 					</div>*/
/* 					<div class="col-md-4">*/
/* 						<a class="block block-link-hover3" href="{{base_url()}}backend/events">*/
/* 							<div class="block-content block-content-full text-center bg-warning ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 								<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 									<i class="text-white-op">{{event}}</i>*/
/* 								</div>*/
/* 								<div class="text-white-op">*/
/* 									<em>Event</em>*/
/* 								</div>*/
/* 							</div>*/
/* 						</a>*/
/* 					</div>*/
/* 					<div class="col-md-4">*/
/* 						<a class="block block-link-hover3" href="{{base_url()}}backend/products">*/
/* 							<div class="block-content block-content-full text-center bg-info ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 								<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 									<i class="text-white-op">{{product}}</i>*/
/* 								</div>*/
/* 								<div class="text-white-op">*/
/* 									<em>Produk</em>*/
/* 								</div>*/
/* 							</div>*/
/* 						</a>*/
/* 					</div>*/
/* 					<!-- ARTechnology -->*/
/* 				</div>*/
/* 				{% elseif users.use_akses == 2 %}*/
/* 				<div class="row">*/
/* 					<div class="col-md-3">*/
/* 						<a class="block block-link-hover3" href="{{base_url()}}backend/canines">*/
/* 							<div class="block-content block-content-full text-center bg-danger ribbon ribbon-bookmark ribbon-crystal">*/
/* 								<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 									<i class="text-white-op">{{canine}}</i>*/
/* 								</div>*/
/* 								<div class="text-white-op">*/
/* 									<em>Canine</em>*/
/* 								</div>*/
/* 							</div>*/
/* 						</a>*/
/* 					</div>*/
/* */
/* 					<div class="col-md-3">*/
/* 						<a class="block block-link-hover3" href="#">*/
/* 							<div class="block-content block-content-full text-center bg-success ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 								<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 									<i class="text-white-op">{{pegawai|length}}</i>*/
/* 								</div>*/
/* 								<div class="text-white-op">*/
/* 									<em>Pegawai</em>*/
/* 								</div>*/
/* 							</div>*/
/* 						</a>*/
/* 					</div>*/
/* */
/* 						<div class="col-md-3">*/
/* 							<a class="block block-link-hover3" href="{{base_url()}}backend/events">*/
/* 								<div class="block-content block-content-full text-center bg-warning ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 									<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 										<i class="text-white-op">{{event}}</i>*/
/* 									</div>*/
/* 									<div class="text-white-op">*/
/* 										<em>Event</em>*/
/* 									</div>*/
/* 								</div>*/
/* 							</a>*/
/* 						</div>*/
/* 						<div class="col-md-3">*/
/* 							<a class="block block-link-hover3" href="{{base_url()}}backend/products">*/
/* 								<div class="block-content block-content-full text-center bg-info ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 									<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 										<i class="text-white-op">{{product}}</i>*/
/* 									</div>*/
/* 									<div class="text-white-op">*/
/* 										<em>Produk</em>*/
/* 									</div>*/
/* 								</div>*/
/* 							</a>*/
/* 						</div>*/
/* */
/* 					</div>*/
/* 					{% elseif users.use_akses == 3 %}*/
/* */
/* 					<div class="row">*/
/* 						<div class="col-md-2"></div>*/
/* 						<div class="col-md-4">*/
/* 							<a class="block block-link-hover3" href="{{base_url()}}backend/events">*/
/* 								<div class="block-content block-content-full text-center bg-warning ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 									<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 										<i class="text-white-op">{{event}}</i>*/
/* 									</div>*/
/* 									<div class="text-white-op">*/
/* 										<em>Event</em>*/
/* 									</div>*/
/* 								</div>*/
/* 							</a>*/
/* 						</div>*/
/* 						<div class="col-md-4">*/
/* 							<a class="block block-link-hover3" href="{{base_url()}}backend/products">*/
/* 								<div class="block-content block-content-full text-center bg-info ribbon ribbon-bookmark ribbon-crystal">*/
/* */
/* 									<div class="item item-2x item-circle bg-crystal-op push-20-t push-20">*/
/* 										<i class="text-white-op">{{product}}</i>*/
/* 									</div>*/
/* 									<div class="text-white-op">*/
/* 										<em>Produk</em>*/
/* 									</div>*/
/* 								</div>*/
/* 							</a>*/
/* 						</div>*/
/* 						<div class="col-md-2"></div>*/
/* 					</div>*/
/* */
/* 			{% endif %}*/
/* */
/* */
/* */
/* 		</div>*/
/* 	</div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* {% endblock %}*/
/* */
