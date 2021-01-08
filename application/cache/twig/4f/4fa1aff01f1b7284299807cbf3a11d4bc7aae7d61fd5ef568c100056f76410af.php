<?php

/* front/view_canines.twig */
class __TwigTemplate_8b22bea7dcae97d3bfea49882d7aee2019e70d27c97240cc0aaccdca1b3d4d31 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/frontend.twig", "front/view_canines.twig", 2);
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
        echo "/assets/coco/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">
<link rel=\"stylesheet\" id=\"css-main\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/css/typeaheadjs.css\">

<style>
    .bg-info{
        background-color: #000000 !important;
    }
    #imgPreview, #imgPreview-update{
        margin-bottom: 15px;
    }
    th{
        color: white !important;
    }
</style>
";
    }

    // line 26
    public function block_inverted($context, array $blocks = array())
    {
        echo "inverted";
    }

    // line 28
    public function block_header($context, array $blocks = array())
    {
        // line 29
        echo "
";
    }

    // line 32
    public function block_content($context, array $blocks = array())
    {
        // line 33
        echo "<!-- Page Content -->

<section class=\"hero-banner bg-info\">
    <div class=\"container\">
        <div class=\"row text-center\">
            <h3 class=\"text-white-1\">List Anjing</h3>
            <br/>
        </div>
        <div class=\"row\">
            <form class=\"form-horizontal push-10-t\" action=\"";
        // line 42
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "canines\" method=\"get\" style=\"margin-top:19px;\">
                <div class=\"form-group\">
                    <div class=\"col-xs-7\"></div>
                    <div class=\"col-xs-5\">
                        <div class=\"col-xs-12 js-header-search header-search\" >
                            <div class=\"input-group\" id=\"prefetch\">
                                <input class=\"form-control search typeahead\" type=\"text\" name=\"q\" placeholder=\"No. ICR/Nama/Kennel/Tanggal Lahir\" required=\"Maaf pencarian tidak boleh kosong!!\">
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
        // line 59
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 60
            echo "                            <div class=\"panel panel-default\" data-modal=\"md-fade-in-scale-up\" style=\"margin-top: 5px; background-color:#fcf8e3;\">
                                <div class=\"panel-body\">";
            // line 61
            echo (isset($context["error"]) ? $context["error"] : null);
            echo "</div>
                            </div>
                        ";
        }
        // line 64
        echo "                    </div>
                </div>
            </form>
        </div>
        <div class=\"table-responsive\">
            <table class=\"table table-borderless\">
                <thead>
                    <tr>
                        <th width=\"1%\">Foto</th>
                        <th>Nomor Chip</th>
                        <th>Nomor ICR</th>
                        <th>Nama</th>
                        <th>Breed</th>
                        <th>Jenis Kelamin</th>
                        <th>Warna</th>
                        <th>Tanggal Lahir</th>
                        <th>Breeder</th>
                        <th>Kennel</th>
                        <th>Owner</th>
                        <th class=\"text-center\" width=\"1%\"></th>
                        <th class=\"text-center\" width=\"1%\"></th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["canines"]) ? $context["canines"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 89
            echo "                        <tr>
                            ";
            // line 90
            if (($this->getAttribute($context["row"], "can_photo", array()) == "-")) {
                // line 91
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "assets/oneui/img/avatars/image.png\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            } else {
                // line 93
                echo "                                <td><img src=\"";
                echo twig_escape_filter($this->env, base_url(), "html", null, true);
                echo "uploads/canine/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_photo", array()), "html", null, true);
                echo "\" width=\"100\" class=\"img img-thumbnail\" style=\"border-radius:5%\"></td>
                            ";
            }
            // line 95
            echo "                            <td class=\"text-white-1\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_icr_moc_number", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 96
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_icr_number", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_a_s", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 98
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_breed", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 99
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_gender", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 100
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_color", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 101
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["row"], "can_date_of_birth", array()), "d-m-Y"), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_owner_name", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 103
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_cage", array()), "html", null, true);
            echo "</td>
                            <td class=\"text-white-1\">";
            // line 104
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_owner", array()), "html", null, true);
            echo "</td>
                            <td><button class=\"btn btn-default\" onClick=\"openModal('#modal-update-canines', 'update', ";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_id", array()), "html", null, true);
            echo ")\" data-toggle=\"tooltip\" title=\"Ubah Data\"><i class=\"fa fa-pencil\"></i></button></td>
                            <td><a href=\"";
            // line 106
            echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
            echo "canines/logs/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "can_id", array()), "html", null, true);
            echo "\" class=\"btn btn-primary\" data-toggle=\"tooltip\" title=\"Lihat Request\"><i class=\"fa fa-file\"></i></a></td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 109
        echo "                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- modals -->
<div class=\"modal fade\" id=\"modal-update-canines\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-canine form-horizontal\" method=\"post\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h3 class=\"modal-title\" id=\"myModalLabel\">Request Pengubahan Data Canine</h3>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 127
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                <label for=\"imageInput\" class=\"btn\">Cari Gambar</label>
                                <input type=\"file\" class=\"upload hidden\" name=\"can_photo\" id=\"imageInput\" />
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\" />
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                        <label for=\"can_cage\">Kennel</label>
                        <input class=\"form-control\" name=\"can_cage\" id=\"can_cage\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                        <label for=\"can_address\">Alamat</label>
                        <input class=\"form-control\" name=\"can_address\" id=\"can_address\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                        <label for=\"can_owner\">Pemilik</label>
                        <input class=\"form-control\" name=\"can_owner\" id=\"can_owner\" type=\"text\" required>
                        </div>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                    <button type=\"submit\" class=\"btn btn-primary submit-update-canines\">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->

<div class=\"modal fade\" id=\"cropper-modal\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" >
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
        // line 185
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    // line 188
    public function block_scripts($context, array $blocks = array())
    {
        // line 189
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 190
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 191
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>

<!-- search engine -->
<script src=\"";
        // line 194
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 195
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 196
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>

<!-- Page JS Code -->
<script src=\"";
        // line 199
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/view_canines.js\"></script>

<script>
var base_url = \$('.base_url').val();

// canine
var canines = new Bloodhound({
  identify: function(o) { return o.can_a_s; },
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s, can_icr_number, can_icr_moc_number, can_cage'),
  // datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),
  dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },
  remote: {
    url: base_url+'canines/search?q=%QUERY',
    wildcard: '%QUERY',
    cache: false
  }
});

canines.initialize();

\$('#prefetch .typeahead').typeahead(null, {
    name: 'canines',
    display: 'can_a_s',
    placeholder: false,
    source: canines.ttAdapter(),
    templates: {
        empty: [
        '<div class=\"empty-message\">',
        '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
        '</div>'
        ].join('\\n'),
        suggestion: function (data) {
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
        return "front/view_canines.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  357 => 199,  351 => 196,  347 => 195,  343 => 194,  337 => 191,  333 => 190,  330 => 189,  327 => 188,  321 => 185,  260 => 127,  240 => 109,  229 => 106,  225 => 105,  221 => 104,  217 => 103,  213 => 102,  209 => 101,  205 => 100,  201 => 99,  197 => 98,  193 => 97,  189 => 96,  184 => 95,  176 => 93,  170 => 91,  168 => 90,  165 => 89,  161 => 88,  135 => 64,  129 => 61,  126 => 60,  124 => 59,  104 => 42,  93 => 33,  90 => 32,  85 => 29,  82 => 28,  76 => 26,  58 => 11,  54 => 10,  50 => 9,  46 => 8,  42 => 7,  38 => 6,  35 => 5,  32 => 4,  11 => 2,);
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
/* <link rel="stylesheet" href="{{ base_url() }}/assets/coco/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* <link rel="stylesheet" id="css-main" href="{{ base_url() }}assets/typeahead.js/css/typeaheadjs.css">*/
/* */
/* <style>*/
/*     .bg-info{*/
/*         background-color: #000000 !important;*/
/*     }*/
/*     #imgPreview, #imgPreview-update{*/
/*         margin-bottom: 15px;*/
/*     }*/
/*     th{*/
/*         color: white !important;*/
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
/*             <h3 class="text-white-1">List Anjing</h3>*/
/*             <br/>*/
/*         </div>*/
/*         <div class="row">*/
/*             <form class="form-horizontal push-10-t" action="{{ base_url() }}canines" method="get" style="margin-top:19px;">*/
/*                 <div class="form-group">*/
/*                     <div class="col-xs-7"></div>*/
/*                     <div class="col-xs-5">*/
/*                         <div class="col-xs-12 js-header-search header-search" >*/
/*                             <div class="input-group" id="prefetch">*/
/*                                 <input class="form-control search typeahead" type="text" name="q" placeholder="No. ICR/Nama/Kennel/Tanggal Lahir" required="Maaf pencarian tidak boleh kosong!!">*/
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
/*                         <th width="1%">Foto</th>*/
/*                         <th>Nomor Chip</th>*/
/*                         <th>Nomor ICR</th>*/
/*                         <th>Nama</th>*/
/*                         <th>Breed</th>*/
/*                         <th>Jenis Kelamin</th>*/
/*                         <th>Warna</th>*/
/*                         <th>Tanggal Lahir</th>*/
/*                         <th>Breeder</th>*/
/*                         <th>Kennel</th>*/
/*                         <th>Owner</th>*/
/*                         <th class="text-center" width="1%"></th>*/
/*                         <th class="text-center" width="1%"></th>*/
/*                     </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                     {% for row in canines %}*/
/*                         <tr>*/
/*                             {% if row.can_photo == '-' %}*/
/*                                 <td><img src="{{base_url()}}assets/oneui/img/avatars/image.png" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% else %}*/
/*                                 <td><img src="{{base_url()}}uploads/canine/{{row.can_photo}}" width="100" class="img img-thumbnail" style="border-radius:5%"></td>*/
/*                             {% endif %}*/
/*                             <td class="text-white-1">{{row.can_icr_moc_number}}</td>*/
/*                             <td class="text-white-1">{{row.can_icr_number}}</td>*/
/*                             <td class="text-white-1">{{row.can_a_s}}</td>*/
/*                             <td class="text-white-1">{{row.can_breed}}</td>*/
/*                             <td class="text-white-1">{{row.can_gender}}</td>*/
/*                             <td class="text-white-1">{{row.can_color}}</td>*/
/*                             <td class="text-white-1">{{row.can_date_of_birth|date("d-m-Y")}}</td>*/
/*                             <td class="text-white-1">{{row.can_owner_name}}</td>*/
/*                             <td class="text-white-1">{{row.can_cage}}</td>*/
/*                             <td class="text-white-1">{{row.can_owner}}</td>*/
/*                             <td><button class="btn btn-default" onClick="openModal('#modal-update-canines', 'update', {{row.can_id}})" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-pencil"></i></button></td>*/
/*                             <td><a href="{{base_url}}canines/logs/{{row.can_id}}" class="btn btn-primary" data-toggle="tooltip" title="Lihat Request"><i class="fa fa-file"></i></a></td>*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                 </tbody>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-update-canines" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-canine form-horizontal" method="post">*/
/*                 <div class="modal-header">*/
/*                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                     <h3 class="modal-title" id="myModalLabel">Request Pengubahan Data Canine</h3>*/
/*                 </div>*/
/*                 <div class="modal-body">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                 <label for="imageInput" class="btn">Cari Gambar</label>*/
/*                                 <input type="file" class="upload hidden" name="can_photo" id="imageInput" />*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update" />*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                         <label for="can_cage">Kennel</label>*/
/*                         <input class="form-control" name="can_cage" id="can_cage" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                         <label for="can_address">Alamat</label>*/
/*                         <input class="form-control" name="can_address" id="can_address" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                         <label for="can_owner">Pemilik</label>*/
/*                         <input class="form-control" name="can_owner" id="can_owner" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="modal-footer">*/
/*                     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                     <button type="submit" class="btn btn-primary submit-update-canines">Save</button>*/
/*                 </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
/* <div class="modal fade" id="cropper-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" >*/
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
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* */
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/view_canines.js"></script>*/
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* // canine*/
/* var canines = new Bloodhound({*/
/*   identify: function(o) { return o.can_a_s; },*/
/*   queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s, can_icr_number, can_icr_moc_number, can_cage'),*/
/*   // datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),*/
/*   dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },*/
/*   remote: {*/
/*     url: base_url+'canines/search?q=%QUERY',*/
/*     wildcard: '%QUERY',*/
/*     cache: false*/
/*   }*/
/* });*/
/* */
/* canines.initialize();*/
/* */
/* $('#prefetch .typeahead').typeahead(null, {*/
/*     name: 'canines',*/
/*     display: 'can_a_s',*/
/*     placeholder: false,*/
/*     source: canines.ttAdapter(),*/
/*     templates: {*/
/*         empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*         ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             if (data.can_photo == '-') {*/
/*                 return '<a style="color:black;" href="'+base_url+'pedigrees/id/'+data.can_id+'"><div style="margin-bottom:15px;"><img width="40px" style="float:left; margin:5px;" src="'+base_url+'assets/oneui/img/avatars/image.png"><strong>' + data.can_icr_number + '</strong> <br> ' + data.can_a_s + '</div></a><br><br>';*/
/*             }else{*/
/*                 return '<a style="color:black;" href="'+base_url+'pedigrees/id/'+data.can_id+'"><div style="margin-bottom:15px;"><img width="40px" style="float:left; margin:5px;" src="'+base_url+'uploads/canine/'+data.can_photo+'"><strong>' + data.can_icr_number + '</strong> <br> ' + data.can_a_s + '</div></a><br><br>';*/
/*             }*/
/*         }*/
/*     }*/
/* });*/
/* </script>*/
/* {% endblock %}*/
