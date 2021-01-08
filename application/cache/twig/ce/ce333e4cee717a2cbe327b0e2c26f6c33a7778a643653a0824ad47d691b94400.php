<?php

/* backend/product.twig */
class __TwigTemplate_fded54bbcc2a835dc10898b71c8543f889791f1d3798ce972637f5b80a173a2e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/product.twig", 1);
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
            <li>Produk</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-default btn-delete-product pull-left\"  data-toggle=\"tooltip\" title=\"Hapus yang dipilih\" disabled><i class=\"si si-trash\"></i></button>

            <button class=\"btn btn-primary btn-add-product pull-right\" onClick=\"openModal('#modal-add-product', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Produk\"><i class=\"si si-note\"></i></button>
            <h4> <small>Daftar</small> Produk</h4>
        </div>
        <div class=\"block-content table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->
            <table class=\"table table-borderless table-striped data-products\">
                <thead>
                    <tr>
                        <th width=\"5\">
                            <div class=\"checkbox-product-all\">
                              <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                            </div>
                        </th>
                        <th width=\"1%\">Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Deskripsi Produk</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-product\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 79
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/products/add\" class=\"form-add-product form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tambah Produk</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 92
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Upload Produk</span>
                              <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\"/>
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\"/>
                          </div>
                          <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                      </div>
                    </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"name-add-product\">Nama Produk</label>
                        <input class=\"form-control\" id=\"name-add-product\" name=\"pro_name\" type=\"text\" required>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"price-add-product\">Harga Produk</label>
                        <input class=\"form-control\" id=\"price-add-product\" name=\"pro_price\" type=\"number\" min=\"0\" required>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"description-add-product\">Deskripsi</label>
                        <textarea class=\"form-control\" name=\"pro_desc\" id=\"description-add-product\"  rows=\"4\" cols=\"20\" required></textarea>
                      </div>
                  </div>

                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-employee\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

<div class=\"modal fade\" id=\"modal-update-product\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-product form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Produk</h3>
                </div>
                <div class=\"block-content\">
                    <!-- <div class=\"col-sm-6\"> -->
                      <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 149
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                            <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                                <span>Browse Image</span>
                                <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\"/>
                                <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\"/>
                            </div>
                            <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                        </div>
                      </div>
                      <div class=\"form-group\">
                          <div class=\"col-xs-12\">
                            <label for=\"name-update-product\">Nama Produk</label>
                            <input class=\"form-control\" id=\"name-update-product\" name=\"pro_name\" type=\"text\" required>
                          </div>
                      </div>
                      <div class=\"form-group\">
                          <div class=\"col-xs-12\">
                            <label for=\"price-update-product\">Harga Produk</label>
                            <input class=\"form-control\" id=\"price-update-product\" name=\"pro_price\" type=\"number\" min=\"0\" required>
                          </div>
                      </div>
                      <div class=\"form-group\">
                          <div class=\"col-xs-12\">
                            <label for=\"description-update-product\">Deskripsi</label>
                            <textarea class=\"form-control\" name=\"pro_desc\" id=\"description-update-product\"  rows=\"4\" cols=\"20\" required></textarea>
                          </div>
                      </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-product\">Save</button>
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

    // line 216
    public function block_scripts($context, array $blocks = array())
    {
        // line 217
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 218
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 219
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 220
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 221
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 222
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 223
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 224
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->
<input type=\"hidden\" value=\"";
        // line 226
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 227
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_product.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "backend/product.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  311 => 227,  307 => 226,  302 => 224,  298 => 223,  294 => 222,  290 => 221,  286 => 220,  282 => 219,  278 => 218,  275 => 217,  272 => 216,  202 => 149,  142 => 92,  126 => 79,  80 => 35,  77 => 34,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
/*             <li>Produk</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-default btn-delete-product pull-left"  data-toggle="tooltip" title="Hapus yang dipilih" disabled><i class="si si-trash"></i></button>*/
/* */
/*             <button class="btn btn-primary btn-add-product pull-right" onClick="openModal('#modal-add-product', 'add')" data-toggle="tooltip" title="Tambah Produk"><i class="si si-note"></i></button>*/
/*             <h4> <small>Daftar</small> Produk</h4>*/
/*         </div>*/
/*         <div class="block-content table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/employee.js -->*/
/*             <table class="table table-borderless table-striped data-products">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5">*/
/*                             <div class="checkbox-product-all">*/
/*                               <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                             </div>*/
/*                         </th>*/
/*                         <th width="1%">Foto</th>*/
/*                         <th>Nama Produk</th>*/
/*                         <th>Harga Produk</th>*/
/*                         <th>Deskripsi Produk</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-product" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/products/add" class="form-add-product form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tambah Produk</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Upload Produk</span>*/
/*                               <input type="file" class="upload" name="photo" id="imageInput"/>*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update"/>*/
/*                           </div>*/
/*                           <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                       </div>*/
/*                     </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="name-add-product">Nama Produk</label>*/
/*                         <input class="form-control" id="name-add-product" name="pro_name" type="text" required>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="price-add-product">Harga Produk</label>*/
/*                         <input class="form-control" id="price-add-product" name="pro_price" type="number" min="0" required>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="description-add-product">Deskripsi</label>*/
/*                         <textarea class="form-control" name="pro_desc" id="description-add-product"  rows="4" cols="20" required></textarea>*/
/*                       </div>*/
/*                   </div>*/
/* */
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-employee">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
/* */
/* <div class="modal fade" id="modal-update-product" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-product form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Produk</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <!-- <div class="col-sm-6"> -->*/
/*                       <div class="form-group">*/
/*                         <div class="col-xs-4 col-xs-offset-4">*/
/*                             <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                             <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                                 <span>Browse Image</span>*/
/*                                 <input type="file" class="upload" name="photo" id="imageInput"/>*/
/*                                 <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop"/>*/
/*                             </div>*/
/*                             <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                         </div>*/
/*                       </div>*/
/*                       <div class="form-group">*/
/*                           <div class="col-xs-12">*/
/*                             <label for="name-update-product">Nama Produk</label>*/
/*                             <input class="form-control" id="name-update-product" name="pro_name" type="text" required>*/
/*                           </div>*/
/*                       </div>*/
/*                       <div class="form-group">*/
/*                           <div class="col-xs-12">*/
/*                             <label for="price-update-product">Harga Produk</label>*/
/*                             <input class="form-control" id="price-update-product" name="pro_price" type="number" min="0" required>*/
/*                           </div>*/
/*                       </div>*/
/*                       <div class="form-group">*/
/*                           <div class="col-xs-12">*/
/*                             <label for="description-update-product">Deskripsi</label>*/
/*                             <textarea class="form-control" name="pro_desc" id="description-update-product"  rows="4" cols="20" required></textarea>*/
/*                           </div>*/
/*                       </div>*/
/*                     <!-- </div> -->*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-product">Save</button>*/
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
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_product.js"></script>*/
/* {% endblock %}*/
/* */
