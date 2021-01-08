<?php

/* backend/quotes.twig */
class __TwigTemplate_ff6c1a83804801c29985538f60f5d9d7f777887462b16f023d6872380a9e3745 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/quotes.twig", 1);
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
            <li>Quote</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-default btn-delete-quotes pull-left\"  data-toggle=\"tooltip\" title=\"Hapus yang dipilih\" disabled><i class=\"si si-trash\"></i></button>

            <button class=\"btn btn-primary btn-add-quotes pull-right\" onClick=\"openModal('#modal-add-quotes', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Quote\"><i class=\"si si-note\"></i></button>
            <h4> <small>Daftar</small> Quote</h4>
        </div>
        <div class=\"block-content table-requonsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/quotes.js -->
            <table class=\"table table-borderless table-striped data-quotess\">
                <thead>
                    <tr>
                        <th width=\"5\">
                            <div class=\"checkbox-quotes-all\">
                              <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                            </div>
                        </th>
                        <th>Author</th>
                        <th>Content</th>
                        <!-- <th>Tanggal</th> -->
                        <th class=\"text-center\" width=\"1%\">#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-quotes\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 78
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/quotes/add\" class=\"form-add-quotes form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tambah Quote</h3>
                </div>
                <div class=\"block-content\">

                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"aouthor-add-quotes\">Author</label>
                        <input class=\"form-control\" id=\"aouthor-add-quotes\" name=\"quo_author\" type=\"text\" required>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"content-add-quotes\">content</label>
                        <textarea class=\"form-control\" name=\"quo_content\" id=\"content-add-quotes\"  rows=\"4\" cols=\"20\" required></textarea>
                      </div>
                  </div>

                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-quotes\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

<div class=\"modal fade\" id=\"modal-update-quotes\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-quotes form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Quote</h3>
                </div>
                <div class=\"block-content\">
                    <!-- <div class=\"col-sm-6\"> -->

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"author-update-quotes\">Author</label>
                          <input class=\"form-control\" id=\"author-update-quotes\" name=\"quo_author\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"content-update-quotes\">content</label>
                          <textarea class=\"form-control\" name=\"quo_content\" id=\"content-update-quotes\"  rows=\"4\" cols=\"20\" required></textarea>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-quotes\">Save</button>
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
";
    }

    // line 183
    public function block_scripts($context, array $blocks = array())
    {
        // line 184
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 185
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 186
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 187
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 188
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 189
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 190
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 191
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 193
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 194
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_quote.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/quotes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  272 => 194,  268 => 193,  263 => 191,  259 => 190,  255 => 189,  251 => 188,  247 => 187,  243 => 186,  239 => 185,  236 => 184,  233 => 183,  125 => 78,  80 => 35,  77 => 34,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Quote</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-default btn-delete-quotes pull-left"  data-toggle="tooltip" title="Hapus yang dipilih" disabled><i class="si si-trash"></i></button>*/
/* */
/*             <button class="btn btn-primary btn-add-quotes pull-right" onClick="openModal('#modal-add-quotes', 'add')" data-toggle="tooltip" title="Tambah Quote"><i class="si si-note"></i></button>*/
/*             <h4> <small>Daftar</small> Quote</h4>*/
/*         </div>*/
/*         <div class="block-content table-requonsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/quotes.js -->*/
/*             <table class="table table-borderless table-striped data-quotess">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5">*/
/*                             <div class="checkbox-quotes-all">*/
/*                               <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                             </div>*/
/*                         </th>*/
/*                         <th>Author</th>*/
/*                         <th>Content</th>*/
/*                         <!-- <th>Tanggal</th> -->*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-quotes" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/quotes/add" class="form-add-quotes form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tambah Quote</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/* */
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="aouthor-add-quotes">Author</label>*/
/*                         <input class="form-control" id="aouthor-add-quotes" name="quo_author" type="text" required>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="content-add-quotes">content</label>*/
/*                         <textarea class="form-control" name="quo_content" id="content-add-quotes"  rows="4" cols="20" required></textarea>*/
/*                       </div>*/
/*                   </div>*/
/* */
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-quotes">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
/* */
/* <div class="modal fade" id="modal-update-quotes" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-quotes form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Quote</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <!-- <div class="col-sm-6"> -->*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="author-update-quotes">Author</label>*/
/*                           <input class="form-control" id="author-update-quotes" name="quo_author" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="content-update-quotes">content</label>*/
/*                           <textarea class="form-control" name="quo_content" id="content-update-quotes"  rows="4" cols="20" required></textarea>*/
/*                         </div>*/
/*                     </div>*/
/*                     <!-- </div> -->*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-quotes">Save</button>*/
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
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_quote.js"></script>*/
/* {% endblock %}*/
/* */
