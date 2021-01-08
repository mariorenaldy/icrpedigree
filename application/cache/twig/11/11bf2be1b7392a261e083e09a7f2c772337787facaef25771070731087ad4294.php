<?php

/* backend/logsBirth.twig */
class __TwigTemplate_8ef1dc2fd49f3deb06ead3a30d5b51e0dfc0392a92f15c071f686f811a2a739d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/logsBirth.twig", 2);
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

    // line 4
    public function block_styles($context, array $blocks = array())
    {
        // line 5
        echo "<!-- Page JS Plugins CSS -->
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/select2/css/select2.min.css\" />
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
        margin-bottom: 15px;
    }
</style>
";
    }

    // line 34
    public function block_body($context, array $blocks = array())
    {
        // line 35
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li>Lahir</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <h4>Daftar Lahir</h4>
        </div>
        <div class=\"block-content\">
            <div class=\"table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
                <table class=\"table table-borderless table-striped data-births\">
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
                            <th>Member</th>
                            <th class=\"text-center\" width=\"1%\">#</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modals -->
<div class=\"modal fade\" id=\"modal-update-birth\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-birth form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Lahir</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"form-group\">
                                <div class=\"col-xs-4 col-xs-offset-4\">
                                    <img id=\"imgPreview\" width=\"100%\" src=\"";
        // line 98
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                                    <div class=\"fileUpload btn btn-default btn-flat btn-block text-center\">
                                        <label for=\"imageInput\" class=\"btn\">Gambar Canine</label>
                                        <input type=\"file\" class=\"upload canine\" name=\"bir_photo\" id=\"imageInput\" />
                                        <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"col-md-6\">
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
        // line 120
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 121
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["trah"], "tra_name", array()), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trah'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 123
        echo "                                </select>
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
                        </div>

                        <div class=\"col-md-6\">
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

                            <div class=\"form-group\">
                                <div class=\"col-xs-12\" id=\"bir_member_id\">
                                    <label for=\"bir_member\">Member</label>
                                    <select class=\"form-control member\" id=\"bir_member\" name=\"bir_member\" required style=\"height: 34px;width:100%\"></select>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-xs-10 col-xs-offset-1\">
                                    <label for=\"bir_note_approve\">Keterangan</label>
                                    <textarea class=\"form-control\" name=\"bir_note\" id=\"bir_note\" rows=\"4\" cols=\"20\"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-birth\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->

<div class=\"modal fade\" id=\"cropper-modal\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" >
  <div class=\"modal-dialog modal-dialog-popout modal-dialog-top\">
    <div class=\"modal-content\">
        <div class=\"block block-themed block-transparent remove-margin-b\">
            <div class=\"block-header bg-primary-dark\">
                <ul class=\"block-options\">
                    <li>
                        <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                    </li>
                </ul>
                <h3 class=\"block-title\">Image Cropper</h3>
            </div>
            <div class=\"block-content\">
                <div id=\"cropper-wrap-img\">
                    <img width=\"100%\" src=\"/img/default.png\" alt=\"Picture\">
                </div>
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
        // line 219
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    // line 222
    public function block_scripts($context, array $blocks = array())
    {
        // line 223
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 224
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 225
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 226
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<script src=\"";
        // line 227
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/select2/js/select2.min.js\"></script>
<script src=\"";
        // line 228
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 229
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 230
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script>
    jQuery(function () {
        \$('#bir_date_of_birth').datetimepicker({
            format: 'DD-MM-YYYY',
            showTodayButton: true,
            showClose: true,
            icons: {
                time: 'si si-clock',
                date: 'si si-calendar',
                up: 'si si-arrow-up',
                down: 'si si-arrow-down',
                previous: 'si si-arrow-left',
                next: 'si si-arrow-right',
                today: 'si si-size-actual',
                clear: 'si si-trash',
                close: 'si si-close'
            }
        });
    });
</script>

<!-- Page JS Code -->
<script src=\"";
        // line 253
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/logs_birth.js\"></script>

<!-- search engine -->
<script src=\"";
        // line 256
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 257
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 258
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>

<script>
var base_url = \$('.base_url').val();

";
        // line 264
        echo "
\$(\"#bir_member\").select2({
    placeholder: 'Pilih Member',
    ajax: {
        url: base_url+\"/backend/canines/member\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-update-birth\")
});

function functionMember(\$id){
  \$('#bir_member').val(\$id);
}

// member
var member = new Bloodhound({
    identify: function(o) { return o.mem_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('mem_name'),
    dupDetector: function(a, b) { return a.mem_name === b.mem_name; },
    remote: {
      url: base_url+'backend/canines/member?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

member.initialize();

\$('#bir_member').typeahead(null, {
    name: 'member',
    display: 'mem_name',
    placeholder: false,
    source: member.ttAdapter(),
    templates: {
        empty: [
            '<div class=\"empty-message\">',
            '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
            '</div>'
        ].join('\\n'),
        suggestion: function (data) {
            \$('#bir_member').val(data.mem_id);
            return '<a style=\"color:black;\" href=\"javascript:functionMember('+data.mem_id+')\"><div style=\"margin-bottom:15px;\">' + data.mem_name + '</div></a><br><br>';
        }
    }
});

// breeder
var breeder = new Bloodhound({
    identify: function(o) { return o.can_owner_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),
    dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },
    remote: {
      url: base_url+'backend/canines/breeder?q=%QUERY',
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
      url: base_url+'backend/canines/kennel?q=%QUERY',
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
        return "backend/logsBirth.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  372 => 264,  364 => 258,  360 => 257,  356 => 256,  350 => 253,  324 => 230,  320 => 229,  316 => 228,  312 => 227,  308 => 226,  304 => 225,  300 => 224,  297 => 223,  294 => 222,  288 => 219,  190 => 123,  179 => 121,  175 => 120,  150 => 98,  85 => 35,  82 => 34,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 2,);
    }
}
/* {# ARTechnology #}*/
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/select2/css/select2.min.css" />*/
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
/*         margin-bottom: 15px;*/
/*     }*/
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Lahir</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <h4>Daftar Lahir</h4>*/
/*         </div>*/
/*         <div class="block-content">*/
/*             <div class="table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*                 <table class="table table-borderless table-striped data-births">*/
/*                     <thead>*/
/*                         <tr>*/
/*                             <th width="5%">Foto</th>*/
/*                             <th>Nama</th>*/
/*                             <th>Breed</th>*/
/*                             <th>Jenis Kelamin</th>*/
/*                             <th>Warna</th>*/
/*                             <th>Tanggal Lahir</th>*/
/*                             <th>Breeder</th>*/
/*                             <th>Kennel</th>*/
/*                             <th>Status</th>*/
/*                             <th>Approver</th>*/
/*                             <th>Tanggal Approve</th>*/
/*                             <th>Member</th>*/
/*                             <th class="text-center" width="1%">#</th>*/
/*                             <th>Keterangan</th>*/
/*                         </tr>*/
/*                     </thead>*/
/*                 </table>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-update-birth" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-birth form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Lahir</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="row">*/
/*                         <div class="col-md-12">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-4 col-xs-offset-4">*/
/*                                     <img id="imgPreview" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                                     <div class="fileUpload btn btn-default btn-flat btn-block text-center">*/
/*                                         <label for="imageInput" class="btn">Gambar Canine</label>*/
/*                                         <input type="file" class="upload canine" name="bir_photo" id="imageInput" />*/
/*                                         <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop" />*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="bir_a_s">Nama</label>*/
/*                                 <input class="form-control" id="bir_a_s" name="bir_a_s" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="bir_breed">Breed</label>*/
/*                                 <select class="form-control" id="bir_breed" name="bir_breed" required>*/
/*                                     {% for trah in trahs %}*/
/*                                         <option value="{{trah.tra_name}}">{{trah.tra_name}}</option>*/
/*                                     {% endfor %}*/
/*                                 </select>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="bir_gender">Jenis Kelamin</label>*/
/*                                 <br>*/
/*                                 <input id="bir_gender" name="bir_gender" type="radio" value="Male" checked>Male&nbsp;&nbsp;*/
/*                                 <input id="bir_gender" name="bir_gender" type="radio" value="Female" />Female*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                 <label for="bir_color">Warna</label>*/
/*                                 <input class="form-control" id="bir_color" name="bir_color" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12">*/
/*                                     <label for="bir_date_of_birth">Tanggal Lahir</label>*/
/*                                     <input class="form-control" id="bir_date_of_birth" name="bir_date_of_birth" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="col-md-6">*/
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="breeder-canines">*/
/*                                 <label for="breeder">Breeder</label>*/
/*                                 <input class="form-control typeahead" id="breeder" name="bir_owner_name" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="kennel-canines">*/
/*                                 <label for="kennel">Kennel</label>*/
/*                                 <input class="form-control typeahead" id="kennel" name="bir_cage" type="text" required>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-12" id="bir_member_id">*/
/*                                     <label for="bir_member">Member</label>*/
/*                                     <select class="form-control member" id="bir_member" name="bir_member" required style="height: 34px;width:100%"></select>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div class="form-group">*/
/*                                 <div class="col-xs-10 col-xs-offset-1">*/
/*                                     <label for="bir_note_approve">Keterangan</label>*/
/*                                     <textarea class="form-control" name="bir_note" id="bir_note" rows="4" cols="20"></textarea>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-birth">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
/* <div class="modal fade" id="cropper-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" >*/
/*   <div class="modal-dialog modal-dialog-popout modal-dialog-top">*/
/*     <div class="modal-content">*/
/*         <div class="block block-themed block-transparent remove-margin-b">*/
/*             <div class="block-header bg-primary-dark">*/
/*                 <ul class="block-options">*/
/*                     <li>*/
/*                         <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                     </li>*/
/*                 </ul>*/
/*                 <h3 class="block-title">Image Cropper</h3>*/
/*             </div>*/
/*             <div class="block-content">*/
/*                 <div id="cropper-wrap-img">*/
/*                     <img width="100%" src="/img/default.png" alt="Picture">*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class="modal-footer">*/
/*             <button type="button" data-dismiss="modal" class="btn btn-default pull-left">Close</button>*/
/*             <button type="button" class="btn btn-primary btn-crop">Crop</button>*/
/*         </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <script src="{{ base_url() }}assets/select2/js/select2.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*         $('#bir_date_of_birth').datetimepicker({*/
/*             format: 'DD-MM-YYYY',*/
/*             showTodayButton: true,*/
/*             showClose: true,*/
/*             icons: {*/
/*                 time: 'si si-clock',*/
/*                 date: 'si si-calendar',*/
/*                 up: 'si si-arrow-up',*/
/*                 down: 'si si-arrow-down',*/
/*                 previous: 'si si-arrow-left',*/
/*                 next: 'si si-arrow-right',*/
/*                 today: 'si si-size-actual',*/
/*                 clear: 'si si-trash',*/
/*                 close: 'si si-close'*/
/*             }*/
/*         });*/
/*     });*/
/* </script>*/
/* */
/* <!-- Page JS Code -->*/
/* <script src="{{ base_url() }}/assets/oneui/js/pages/logs_birth.js"></script>*/
/* */
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* {# start select2 #}*/
/* */
/* $("#bir_member").select2({*/
/*     placeholder: 'Pilih Member',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/member",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-update-birth")*/
/* });*/
/* */
/* function functionMember($id){*/
/*   $('#bir_member').val($id);*/
/* }*/
/* */
/* // member*/
/* var member = new Bloodhound({*/
/*     identify: function(o) { return o.mem_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('mem_name'),*/
/*     dupDetector: function(a, b) { return a.mem_name === b.mem_name; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/member?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* member.initialize();*/
/* */
/* $('#bir_member').typeahead(null, {*/
/*     name: 'member',*/
/*     display: 'mem_name',*/
/*     placeholder: false,*/
/*     source: member.ttAdapter(),*/
/*     templates: {*/
/*         empty: [*/
/*             '<div class="empty-message">',*/
/*             '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*             '</div>'*/
/*         ].join('\n'),*/
/*         suggestion: function (data) {*/
/*             $('#bir_member').val(data.mem_id);*/
/*             return '<a style="color:black;" href="javascript:functionMember('+data.mem_id+')"><div style="margin-bottom:15px;">' + data.mem_name + '</div></a><br><br>';*/
/*         }*/
/*     }*/
/* });*/
/* */
/* // breeder*/
/* var breeder = new Bloodhound({*/
/*     identify: function(o) { return o.can_owner_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),*/
/*     dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/breeder?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* breeder.initialize();*/
/* $('#breeder-canines .typeahead').typeahead(null, {*/
/*     name: 'breeder',*/
/*     display: 'can_owner_name',*/
/*     placeholder: false,*/
/*     source: breeder.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*     suggestion: function (data) {*/
/*         return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_owner_name + '</div></a><br><hr>';*/
/*     }*/
/*     }*/
/* });*/
/* */
/* // kennel*/
/* var kennel = new Bloodhound({*/
/*     identify: function(o) { return o.can_cage; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),*/
/*     dupDetector: function(a, b) { return a.can_cage === b.can_cage; },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/kennel?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* kennel.initialize();*/
/* $('#kennel-canines .typeahead').typeahead(null, {*/
/*     name: 'kennel',*/
/*     display: 'can_cage',*/
/*     placeholder: false,*/
/*     source: kennel.ttAdapter(),*/
/*     templates: {*/
/*     empty: [*/
/*         '<div class="empty-message">',*/
/*         '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*         '</div>'*/
/*     ].join('\n'),*/
/*     suggestion: function (data) {*/
/*         return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_cage + '</div></a><br><hr>';*/
/*     }*/
/*     }*/
/* });*/
/* </script>*/
/* {% endblock %}*/
/* */
