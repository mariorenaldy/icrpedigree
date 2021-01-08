<?php

/* backend/event.twig */
class __TwigTemplate_f04f1290a80f2f2075b089d69307e3d84bd74ea3f452051022bef1265f3e8ad9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/event.twig", 1);
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
            <li>Event</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-default btn-delete-event pull-left\"  data-toggle=\"tooltip\" title=\"Hapus yang dipilih\" disabled><i class=\"si si-trash\"></i></button>

            <button class=\"btn btn-primary btn-add-event pull-right\" onClick=\"openModal('#modal-add-event', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Event\"><i class=\"si si-note\"></i></button>
            <h4> <small>Daftar</small> Event</h4>
        </div>
        <div class=\"block-content table-responsive\">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/event.js -->
            <table class=\"table table-borderless table-striped data-events\">
                <thead>
                    <tr>
                        <th width=\"5\">
                            <div class=\"checkbox-event-all\">
                              <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                            </div>
                        </th>
                        <th width=\"1%\">Foto</th>
                        <th>Judul Event</th>
                        <th>Tempat</th>
                        <th>Tanggal</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-event\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 81
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/events/add\" class=\"form-add-event form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Tambah Event</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 94
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Upload Event</span>
                              <input type=\"file\" class=\"upload\" name=\"photo\" id=\"imageInput\"/>
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\"/>
                          </div>
                          <!-- <small class=\"text-muted\">Ratio 1:1</small> -->
                      </div>
                    </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"title-add-event\">Judul Event</label>
                        <input class=\"form-control\" id=\"title-add-event\" name=\"evn_title\" type=\"text\" required>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"place-add-event\">Tempat</label>
                        <input class=\"form-control\" id=\"place-add-event\" name=\"evn_place\" type=\"text\" required>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"date-add-event\">Tanggal</label>
                        <input class=\"form-control\" id=\"date-add-event\" name=\"evn_date\" type=\"date\"  required>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"description-add-event\">Deskripsi</label>
                        <textarea class=\"form-control\" name=\"evn_desc\" id=\"description-add-event\"  rows=\"4\" cols=\"20\" required></textarea>
                      </div>
                  </div>

                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Batal</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-event\">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

<div class=\"modal fade\" id=\"modal-update-event\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-event form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Event</h3>
                </div>
                <div class=\"block-content\">
                    <!-- <div class=\"col-sm-6\"> -->
                      <div class=\"form-group\">
                        <div class=\"col-xs-4 col-xs-offset-4\">
                            <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 157
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
                            <label for=\"title-update-event\">Judul Event</label>
                            <input class=\"form-control\" id=\"title-update-event\" name=\"evn_title\" type=\"text\" required>
                          </div>
                      </div>
                      <div class=\"form-group\">
                          <div class=\"col-xs-12\">
                            <label for=\"place-update-event\">Tempat</label>
                            <input class=\"form-control\" id=\"place-update-event\" name=\"evn_place\" type=\"text\" required>
                          </div>
                      </div>
                      <div class=\"form-group\">
                          <div class=\"col-xs-12\">
                            <label for=\"date-update-event\">Tanggal</label>
                            <input class=\"form-control\" id=\"date-update-event\" name=\"evn_date\" type=\"date\"  required>
                          </div>
                      </div>
                      <div class=\"form-group\">
                          <div class=\"col-xs-12\">
                            <label for=\"description-update-event\">Deskripsi</label>
                            <textarea class=\"form-control\" name=\"evn_desc\" id=\"description-update-event\"  rows=\"4\" cols=\"20\" required></textarea>
                          </div>
                      </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-event\">Save</button>
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
        // line 228
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
";
    }

    // line 231
    public function block_scripts($context, array $blocks = array())
    {
        // line 232
        echo "<!-- Page JS Plugins -->
<script src=\"";
        // line 233
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 234
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 235
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 236
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 237
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 238
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 239
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->

<script src=\"";
        // line 242
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_event.js\"></script>
<script>
    jQuery(function () {
        \$('#date-add-event').datetimepicker({
            format: 'YYYY-MM-DD',
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
        \$('#date_update_event').datetimepicker({
            format: 'YYYY-MM-DD',
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
";
    }

    public function getTemplateName()
    {
        return "backend/event.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  326 => 242,  320 => 239,  316 => 238,  312 => 237,  308 => 236,  304 => 235,  300 => 234,  296 => 233,  293 => 232,  290 => 231,  284 => 228,  210 => 157,  144 => 94,  128 => 81,  80 => 35,  77 => 34,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
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
/*             <li>Event</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-default btn-delete-event pull-left"  data-toggle="tooltip" title="Hapus yang dipilih" disabled><i class="si si-trash"></i></button>*/
/* */
/*             <button class="btn btn-primary btn-add-event pull-right" onClick="openModal('#modal-add-event', 'add')" data-toggle="tooltip" title="Tambah Event"><i class="si si-note"></i></button>*/
/*             <h4> <small>Daftar</small> Event</h4>*/
/*         </div>*/
/*         <div class="block-content table-responsive">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/event.js -->*/
/*             <table class="table table-borderless table-striped data-events">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5">*/
/*                             <div class="checkbox-event-all">*/
/*                               <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                             </div>*/
/*                         </th>*/
/*                         <th width="1%">Foto</th>*/
/*                         <th>Judul Event</th>*/
/*                         <th>Tempat</th>*/
/*                         <th>Tanggal</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                     </tr>*/
/*                 </thead>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-event" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/events/add" class="form-add-event form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Tambah Event</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Upload Event</span>*/
/*                               <input type="file" class="upload" name="photo" id="imageInput"/>*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update"/>*/
/*                           </div>*/
/*                           <!-- <small class="text-muted">Ratio 1:1</small> -->*/
/*                       </div>*/
/*                     </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="title-add-event">Judul Event</label>*/
/*                         <input class="form-control" id="title-add-event" name="evn_title" type="text" required>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="place-add-event">Tempat</label>*/
/*                         <input class="form-control" id="place-add-event" name="evn_place" type="text" required>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="date-add-event">Tanggal</label>*/
/*                         <input class="form-control" id="date-add-event" name="evn_date" type="date"  required>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="description-add-event">Deskripsi</label>*/
/*                         <textarea class="form-control" name="evn_desc" id="description-add-event"  rows="4" cols="20" required></textarea>*/
/*                       </div>*/
/*                   </div>*/
/* */
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-event">Simpan</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
/* */
/* <div class="modal fade" id="modal-update-event" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-event form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Event</h3>*/
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
/*                             <label for="title-update-event">Judul Event</label>*/
/*                             <input class="form-control" id="title-update-event" name="evn_title" type="text" required>*/
/*                           </div>*/
/*                       </div>*/
/*                       <div class="form-group">*/
/*                           <div class="col-xs-12">*/
/*                             <label for="place-update-event">Tempat</label>*/
/*                             <input class="form-control" id="place-update-event" name="evn_place" type="text" required>*/
/*                           </div>*/
/*                       </div>*/
/*                       <div class="form-group">*/
/*                           <div class="col-xs-12">*/
/*                             <label for="date-update-event">Tanggal</label>*/
/*                             <input class="form-control" id="date-update-event" name="evn_date" type="date"  required>*/
/*                           </div>*/
/*                       </div>*/
/*                       <div class="form-group">*/
/*                           <div class="col-xs-12">*/
/*                             <label for="description-update-event">Deskripsi</label>*/
/*                             <textarea class="form-control" name="evn_desc" id="description-update-event"  rows="4" cols="20" required></textarea>*/
/*                           </div>*/
/*                       </div>*/
/*                     <!-- </div> -->*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-event">Save</button>*/
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
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
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
/* */
/* <script src="{{ base_url() }}/assets/oneui/js/pages/adm_event.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*         $('#date-add-event').datetimepicker({*/
/*             format: 'YYYY-MM-DD',*/
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
/*         $('#date_update_event').datetimepicker({*/
/*             format: 'YYYY-MM-DD',*/
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
/* {% endblock %}*/
/* */
