<?php

/* front/view_births.twig */
class __TwigTemplate_688caf18b86b3902f9b619fa8af1894a112f2c0702dd4b44f1d50a31b94aabe1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/view_births.twig", 2);
        $this->blocks = array(
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
    public function block_styles($context, array $blocks = array())
    {
        // line 5
        echo "<!-- Page JS Plugins CSS -->
<link href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/css/font-awesome.css\" rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/coco/libs/jquery-magnific/magnific-popup.css\" rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">

<style>
    .bg-info{
        background-color: #000000 !important;
    }
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
    #imgPreview{
        margin-bottom: 15px;
    }
    th{
        color: white !important;
    }
    th.picker-switch{
        color: gray !important;
    }
    .datepicker table tr td.today,
    .datepicker table tr td.today:hover,
    .datepicker table tr td.today.disabled,
    .datepicker table tr td.today.disabled:hover {
        background-color: gray;
    }
    .text-gray{
        color: gray !important;
    }
</style>
";
    }

    // line 53
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 55
    public function block_header($context, array $blocks = array())
    {
        // line 56
        echo "
";
    }

    // line 59
    public function block_content($context, array $blocks = array())
    {
        // line 60
        echo "<!-- Page Content -->

<section class=\"hero-banner bg-info\">
    <div class=\"container\">
        <div class=\"row text-center\">
            <h3 class=\"text-white-1\">List Lahir</h3>
            <br/>
        </div>
        <div class=\"row\">
            <form class=\"form-horizontal push-10-t\" action=\"";
        // line 69
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "births\" method=\"get\" style=\"margin-top:19px;\">
                <div class=\"form-group\">
                    <div class=\"col-xs-7\"></div>
                    <div class=\"col-xs-5\">
                        <div class=\"col-xs-12 js-header-search header-search\" >
                            <div class=\"input-group\" id=\"prefetch\">
                                <input class=\"form-control search\" type=\"text\" name=\"q\" placeholder=\"Nama/Kennel/Tanggal Lahir\" required=\"Maaf pencarian tidak boleh kosong!!\">
                                <div class=\"input-group-btn\">
                                    <button class=\"btn btn-default\"><i class=\"icon-search\"></i></button>
                                </div>
                            </div>
                            <h5 class=\"text-white-1 text-center\">Format Tanggal Lahir: tgl-bulan-tahun. Contoh: 12-12-2012.</h5>
                        </div>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-xs-4 col-xs-offset-4\">    
                        ";
        // line 86
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 87
            echo "                            <div class=\"panel panel-default\" data-modal=\"md-fade-in-scale-up\" style=\"margin-top: 5px; background-color:#fcf8e3;\">
                                <div class=\"panel-body\">";
            // line 88
            echo (isset($context["error"]) ? $context["error"] : null);
            echo "</div>
                            </div>
                        ";
        }
        // line 91
        echo "                    </div>
                </div>
            </form>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table table-borderless\">
                <thead>
                    <tr>
                        <th width=\"5%\">Foto</th>
                        <th>Nama</th>
                        <th>Breed</th>
                        <th>Jenis Kelamin</th>
                        <th>Warna</th>
                        <th>Tanggal Lahir</th>
                        <th>Breeder</th>
                        <th>Kennel</th>
                        <th>Status</th>
                        <th>Approver</th>
                        <th>Tanggal Approve</th>
                        <th class=\"text-center\" width=\"1%\"></th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 115
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["births"]) ? $context["births"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 116
            echo "                        <tr>
                            ";
            // line 117
            if (($this->getAttribute($context["row"], "bir_photo", array()) == "-")) {
                // line 118
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            } else {
                // line 120
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_photo", array()), "html", null, true);
                echo "\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            }
            // line 122
            echo "
                            <td class=\"text-white-1\">";
            // line 123
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_a_s", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 124
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_breed", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 125
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_gender", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 126
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_color", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 127
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "bir_date_of_birth", array()), "d-m-Y"), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 128
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_owner_name", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 129
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_cage", array()), "html", null, true);
            echo "</td>

                            <td class=\"text-white-1\">";
            // line 131
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "stat_name", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 132
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "use_username", array()), "html", null, true);
            echo "</td>

                            ";
            // line 134
            if ($this->getAttribute($context["row"], "bir_app_date", array())) {
                // line 135
                echo "                                <td class=\"text-white-1\">";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "bir_app_date", array()), "d-m-Y"), "html", null, true);
                echo "</td>
                            ";
            } else {
                // line 137
                echo "                                <td class=\"text-white-1\"></td>
                            ";
            }
            // line 139
            echo "
                            ";
            // line 140
            if (($this->getAttribute($context["row"], "bir_stat", array()) == 0)) {
                // line 141
                echo "                                <td><button class=\"btn btn-default\" onClick=\"openModal('#modal-update-birth', 'update-birth', ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_id", array()), "html", null, true);
                echo ")\" data-toggle=\"tooltip\" title=\"Ubah Data\"><i class=\"fa fa-pencil\"></i></button></td>
                            ";
            } else {
                // line 143
                echo "                                <td></td>
                            ";
            }
            // line 145
            echo "
                            <td class=\"text-white-1\">";
            // line 146
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "bir_note", array()), "html", null, true);
            echo "</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 149
        echo "                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- modals -->
<div class=\"modal fade\" id=\"modal-update-birth\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-birth form-horizontal\" method=\"post\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h3 class=\"modal-title\" id=\"myModalLabel\">Request Penambahan Data Lahir</h3>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgPreview\" width=\"100%\" src=\"";
        // line 167
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInput\" class=\"btn\">Gambar Canine</label>
                                <input type=\"file\" class=\"upload canine\" name=\"bir_photo\" id=\"imageInput\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\" />
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"bir_a_s\">Nama</label>
                          <input class=\"form-control\" id=\"bir_a_s\" name=\"bir_a_s\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"bir_breed\">Breed</label>
                          <select class=\"form-control\" id=\"bir_breed\" name=\"bir_breed\" required>
                            ";
        // line 187
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 188
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 190
        echo "                          </select>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"bir_gender\">Jenis Kelamin</label>
                          <br>
                          <input id=\"bir_gender\" name=\"bir_gender\" type=\"radio\" value=\"Male\" checked>Male&nbsp;&nbsp;
                          <input id=\"bir_gender\" name=\"bir_gender\" type=\"radio\" value=\"Female\" />Female
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"bir_color\">Warna</label>
                          <input class=\"form-control\" id=\"bir_color\" name=\"bir_color\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                            <label for=\"bir_date_of_birth\">Tanggal Lahir</label>
                            <input class=\"form-control\" id=\"bir_date_of_birth\" name=\"bir_date_of_birth\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"breeder-canines\">
                          <label for=\"breeder\">Breeder</label>
                          <input class=\"form-control typeahead\" id=\"breeder\" name=\"bir_owner_name\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"kennel-canines\">
                          <label for=\"kennel\">Kennel</label>
                          <input class=\"form-control typeahead\" id=\"kennel\" name=\"bir_cage\" type=\"text\" required>
                        </div>
                    </div>

                    <input type=\"hidden\" value=\"\" id=\"bir_stu_id\" name=\"bir_stu_id\">

                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                        <button type=\"submit\" class=\"btn btn-primary submit-update-stud\">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class=\"modal fade\" id=\"cropper-modal\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                <h3 class=\"modal-title\" id=\"myModalLabel\">Image Cropper</h3>
            </div>
            <div class=\"modal-body\">
                <div id=\"cropper-wrap-img\">
                    <img width=\"100%\" src=\"/img/default.png\" alt=\"Picture\">
                </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default pull-left\">Close</button>
                <button type=\"button\" class=\"btn btn-primary btn-crop\">Crop</button>
            </div>
        </div>
    </div>
</div>

<input type=\"hidden\" value=\"";
        // line 263
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    // line 266
    public function block_scripts($context, array $blocks = array())
    {
        // line 267
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 268
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 269
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 270
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 271
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>

<!-- search engine -->
<script src=\"";
        // line 274
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 275
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 276
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>

<!-- Page JS Code -->
<script src=\"";
        // line 279
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/view_births.js\"></script>

<script>
var base_url = \$('.base_url').val();

// breeder
var breeder = new Bloodhound({
    identify: function(o) { return o.can_owner_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),
    dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },
    remote: {
      url: base_url+'canines/breeder?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

breeder.initialize();
\$('#breeder-canines .typeahead').typeahead(null, {
name: 'breeder',
display: 'can_owner_name',
placeholder: false,
source: breeder.ttAdapter(),
templates: {
  empty: [
    '<div class=\"empty-message\">',
      '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
    '</div>'
  ].join('\\n'),
  suggestion: function (data) {
     return '<a style=\"color:black;\" href=\"#\"><div style=\"margin-bottom:10px;padding-left:10px;\">'+ data.can_owner_name + '</div></a><br><hr>';
 }
}
});

// kennel
var kennel = new Bloodhound({
    identify: function(o) { return o.can_cage; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),
    dupDetector: function(a, b) { return a.can_cage === b.can_cage; },
    remote: {
      url: base_url+'canines/kennel?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

kennel.initialize();
\$('#kennel-canines .typeahead').typeahead(null, {
name: 'kennel',
display: 'can_cage',
placeholder: false,
source: kennel.ttAdapter(),
templates: {
  empty: [
    '<div class=\"empty-message\">',
      '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
    '</div>'
  ].join('\\n'),
  suggestion: function (data) {
     return '<a style=\"color:black;\" href=\"#\"><div style=\"margin-bottom:10px;padding-left:10px;\">'+ data.can_cage + '</div></a><br><hr>';
 }
}
});
</script>

";
    }

    public function getTemplateName()
    {
        return "front/view_births.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  468 => 279,  462 => 276,  458 => 275,  454 => 274,  448 => 271,  444 => 270,  440 => 269,  436 => 268,  433 => 267,  430 => 266,  424 => 263,  349 => 190,  338 => 188,  334 => 187,  311 => 167,  291 => 149,  282 => 146,  279 => 145,  275 => 143,  269 => 141,  267 => 140,  264 => 139,  260 => 137,  254 => 135,  252 => 134,  247 => 132,  243 => 131,  238 => 129,  234 => 128,  230 => 127,  226 => 126,  222 => 125,  218 => 124,  214 => 123,  211 => 122,  203 => 120,  197 => 118,  195 => 117,  192 => 116,  188 => 115,  162 => 91,  156 => 88,  153 => 87,  151 => 86,  131 => 69,  120 => 60,  117 => 59,  112 => 56,  109 => 55,  103 => 53,  58 => 11,  54 => 10,  50 => 9,  46 => 8,  42 => 7,  38 => 6,  35 => 5,  32 => 4,  11 => 2,);
    }
}
/* {# By: ARTechnology #}*/
/* {% extends "template/frontend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link href="{{base_url()}}assets/coco/css/style.css" rel="stylesheet" type="text/css" />*/
/* <link href="{{base_url()}}assets/css/font-awesome.css" rel="stylesheet" type="text/css" />*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link href="{{base_url()}}assets/coco/libs/jquery-magnific/magnific-popup.css" rel="stylesheet" type="text/css" />*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* */
/* <style>*/
/*     .bg-info{*/
/*         background-color: #000000 !important;*/
/*     }*/
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
/*     #imgPreview{*/
/*         margin-bottom: 15px;*/
/*     }*/
/*     th{*/
/*         color: white !important;*/
/*     }*/
/*     th.picker-switch{*/
/*         color: gray !important;*/
/*     }*/
/*     .datepicker table tr td.today,*/
/*     .datepicker table tr td.today:hover,*/
/*     .datepicker table tr td.today.disabled,*/
/*     .datepicker table tr td.today.disabled:hover {*/
/*         background-color: gray;*/
/*     }*/
/*     .text-gray{*/
/*         color: gray !important;*/
/*     }*/
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
/* <!-- Page Content -->*/
/* */
/* <section class="hero-banner bg-info">*/
/*     <div class="container">*/
/*         <div class="row text-center">*/
/*             <h3 class="text-white-1">List Lahir</h3>*/
/*             <br/>*/
/*         </div>*/
/*         <div class="row">*/
/*             <form class="form-horizontal push-10-t" action="{{ base_url() }}births" method="get" style="margin-top:19px;">*/
/*                 <div class="form-group">*/
/*                     <div class="col-xs-7"></div>*/
/*                     <div class="col-xs-5">*/
/*                         <div class="col-xs-12 js-header-search header-search" >*/
/*                             <div class="input-group" id="prefetch">*/
/*                                 <input class="form-control search" type="text" name="q" placeholder="Nama/Kennel/Tanggal Lahir" required="Maaf pencarian tidak boleh kosong!!">*/
/*                                 <div class="input-group-btn">*/
/*                                     <button class="btn btn-default"><i class="icon-search"></i></button>*/
/*                                 </div>*/
/*                             </div>*/
/*                             <h5 class="text-white-1 text-center">Format Tanggal Lahir: tgl-bulan-tahun. Contoh: 12-12-2012.</h5>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                     <div class="col-xs-4 col-xs-offset-4">    */
/*                         {% if error %}*/
/*                             <div class="panel panel-default" data-modal="md-fade-in-scale-up" style="margin-top: 5px; background-color:#fcf8e3;">*/
/*                                 <div class="panel-body">{{error|raw}}</div>*/
/*                             </div>*/
/*                         {% endif %}*/
/*                     </div>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*         <div class="table-responsive">*/
/*             <table class="table table-borderless">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5%">Foto</th>*/
/*                         <th>Nama</th>*/
/*                         <th>Breed</th>*/
/*                         <th>Jenis Kelamin</th>*/
/*                         <th>Warna</th>*/
/*                         <th>Tanggal Lahir</th>*/
/*                         <th>Breeder</th>*/
/*                         <th>Kennel</th>*/
/*                         <th>Status</th>*/
/*                         <th>Approver</th>*/
/*                         <th>Tanggal Approve</th>*/
/*                         <th class="text-center" width="1%"></th>*/
/*                         <th>Keterangan</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                     {% for row in births %}*/
/*                         <tr>*/
/*                             {% if row.bir_photo == '-' %}*/
/*                                 <td><img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% else %}*/
/*                                 <td><img src="{{base_url()}}uploads/canine/{{row.bir_photo}}" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% endif %}*/
/* */
/*                             <td class="text-white-1">{{row.bir_a_s}}</td>*/
/*                             <td class="text-white-1">{{row.bir_breed}}</td>*/
/*                             <td class="text-white-1">{{row.bir_gender}}</td>*/
/*                             <td class="text-white-1">{{row.bir_color}}</td>*/
/*                             <td class="text-white-1">{{row.bir_date_of_birth|date("d-m-Y")}}</td>*/
/*                             <td class="text-white-1">{{row.bir_owner_name}}</td>*/
/*                             <td class="text-white-1">{{row.bir_cage}}</td>*/
/* */
/*                             <td class="text-white-1">{{row.stat_name}}</td>*/
/*                             <td class="text-white-1">{{row.use_username}}</td>*/
/* */
/*                             {% if row.bir_app_date %}*/
/*                                 <td class="text-white-1">{{row.bir_app_date|date("d-m-Y")}}</td>*/
/*                             {% else %}*/
/*                                 <td class="text-white-1"></td>*/
/*                             {% endif %}*/
/* */
/*                             {% if row.bir_stat == 0 %}*/
/*                                 <td><button class="btn btn-default" onClick="openModal('#modal-update-birth', 'update-birth', {{row.bir_id}})" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-pencil"></i></button></td>*/
/*                             {% else %}*/
/*                                 <td></td>*/
/*                             {% endif %}*/
/* */
/*                             <td class="text-white-1">{{row.bir_note}}</td>*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                 </tbody>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-update-birth" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-birth form-horizontal" method="post">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                     <h3 class="modal-title" id="myModalLabel">Request Penambahan Data Lahir</h3>*/
/*                 </div>*/
/*                 <div class="modal-body">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgPreview" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInput" class="btn">Gambar Canine</label>*/
/*                                 <input type="file" class="upload canine" name="bir_photo" id="imageInput" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop" />*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="bir_a_s">Nama</label>*/
/*                           <input class="form-control" id="bir_a_s" name="bir_a_s" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="bir_breed">Breed</label>*/
/*                           <select class="form-control" id="bir_breed" name="bir_breed" required>*/
/*                             {% for trah in trahs %}*/
/*                                 <option value="{{trah.tra_name}}">{{trah.tra_name}}</option>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="bir_gender">Jenis Kelamin</label>*/
/*                           <br>*/
/*                           <input id="bir_gender" name="bir_gender" type="radio" value="Male" checked>Male&nbsp;&nbsp;*/
/*                           <input id="bir_gender" name="bir_gender" type="radio" value="Female" />Female*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="bir_color">Warna</label>*/
/*                           <input class="form-control" id="bir_color" name="bir_color" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                             <label for="bir_date_of_birth">Tanggal Lahir</label>*/
/*                             <input class="form-control" id="bir_date_of_birth" name="bir_date_of_birth" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="breeder-canines">*/
/*                           <label for="breeder">Breeder</label>*/
/*                           <input class="form-control typeahead" id="breeder" name="bir_owner_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="kennel-canines">*/
/*                           <label for="kennel">Kennel</label>*/
/*                           <input class="form-control typeahead" id="kennel" name="bir_cage" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <input type="hidden" value="" id="bir_stu_id" name="bir_stu_id">*/
/* */
/*                     <div class="modal-footer">*/
/*                         <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                         <button type="submit" class="btn btn-primary submit-update-stud">Save</button>*/
/*                     </div>*/
/*                 </div>*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div class="modal fade" id="cropper-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <div class="modal-header">*/
/*                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                 <h3 class="modal-title" id="myModalLabel">Image Cropper</h3>*/
/*             </div>*/
/*             <div class="modal-body">*/
/*                 <div id="cropper-wrap-img">*/
/*                     <img width="100%" src="/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*                 <button type="button" class="btn btn-primary btn-crop">Crop</button>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* */
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/view_births.js"></script>*/
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* // breeder*/
/* var breeder = new Bloodhound({*/
/*     identify: function(o) { return o.can_owner_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),*/
/*     dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },*/
/*     remote: {*/
/*       url: base_url+'canines/breeder?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* breeder.initialize();*/
/* $('#breeder-canines .typeahead').typeahead(null, {*/
/* name: 'breeder',*/
/* display: 'can_owner_name',*/
/* placeholder: false,*/
/* source: breeder.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*      return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_owner_name + '</div></a><br><hr>';*/
/*  }*/
/* }*/
/* });*/
/* */
/* // kennel*/
/* var kennel = new Bloodhound({*/
/*     identify: function(o) { return o.can_cage; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),*/
/*     dupDetector: function(a, b) { return a.can_cage === b.can_cage; },*/
/*     remote: {*/
/*       url: base_url+'canines/kennel?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* kennel.initialize();*/
/* $('#kennel-canines .typeahead').typeahead(null, {*/
/* name: 'kennel',*/
/* display: 'can_cage',*/
/* placeholder: false,*/
/* source: kennel.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*      return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_cage + '</div></a><br><hr>';*/
/*  }*/
/* }*/
/* });*/
/* </script>*/
/* */
/* {% endblock %}*/
