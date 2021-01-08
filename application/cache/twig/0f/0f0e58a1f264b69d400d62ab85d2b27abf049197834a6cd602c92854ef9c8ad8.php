<?php

/* backend/canines.twig */
class __TwigTemplate_f1685a37c10673b6da2c97d60f95802b7b2b9f020868243dfc45eddca3fe7830 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/backend.twig", "backend/canines.twig", 1);
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
<!-- <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/style.css\"> -->
<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.css\">
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/css/search.css\" media=\"screen\" title=\"no title\" charset=\"utf-8\">
<!-- ARTechnology -->
<!--
<link href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css\" rel=\"stylesheet\" />
-->
<link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/select2/css/select2.min.css\" />
<!-- ARTechnology -->
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

    // line 41
    public function block_body($context, array $blocks = array())
    {
        // line 42
        echo "<div class=\"content wrap-breadcrumb\">
    <div class=\"col-sm-12 text-right hidden-xs\">
        <ol class=\"breadcrumb\">
            <li><a href=\"/dashboard\" class=\"link-effect\">Dashboard</a></li>
            <li>Canines</li>
        </ol>
    </div>
</div>
<!-- Page Content -->

<div class=\"content\">
<!-- Dynamic Table Full -->
    <div class=\"block\">
        <div class=\"block-header text-center bg-gray-lighter\">
            <button class=\"btn btn-default btn-delete-canine pull-left\"  data-toggle=\"tooltip\" title=\"Hapus yang dipilih\" disabled><i class=\"si si-trash\"></i></button>
            <!-- ARTechnology -->
            <button class=\"btn btn-success btn-activate-canine pull-left\"  data-toggle=\"tooltip\" title=\"Aktivasi yang dipilih\" disabled><i class=\"si si-check\"></i></button>
            <button class=\"btn btn-danger btn-deactivate-canine pull-left\"  data-toggle=\"tooltip\" title=\"Deaktivasi yang dipilih\" disabled><i class=\"si si-close\"></i></button>
            <!-- ARTechnology -->
            <button class=\"btn btn-primary btn-add-canines pull-right\" onClick=\"openModal('#modal-add-canines', 'add')\" data-toggle=\"tooltip\" title=\"Tambah Canines\"><i class=\"si si-note\"></i></button>
            <h4><small>Daftar</small> Canines</h4>
        </div>
        <div class=\"block-content \">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/canines.js -->
            <div class=\"table-responsive\">
            <table class=\"table table-borderless table-striped data-canines\">
                <thead>
                    <tr>
                        <th width=\"5\">
                            <div class=\"checkbox-canine-all\">
                              <input type=\"checkbox\" data-toggle=\"tooltip\" title=\"Select all\">
                            </div>
                        </th>
                        <th width=\"1%\">Foto</th>
                        <th>Nomor Registrasi</th>
                        <th>
                          Nomor Chip
                        </th>
                        <th>Nomor ICR</th>
                        <th>AS</th>
                        <th>Jenis Kelamin</th>
                        <th>Owner</th>
                        <!-- ARTechnology 1 -->
                        <th>Member</th>
                        <!-- ARTechnology 1 -->
                        <th>Score</th>
                        <!-- ARTechnology 2 -->
                        <th>Status</th>
                        <!-- ARTechnology 2 -->
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <!-- ARTechnology 3 -->
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <th class=\"text-center\" width=\"1%\">#</th>
                        <!-- ARTechnology 3 -->
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>
<!-- modals -->
<div class=\"modal fade\" id=\"modal-add-canines\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-lg\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 111
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "backend/canines/add\" class=\"form-add-canines form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Add Canines</h3>
                </div>
                <div class=\"block-content\">
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview\" width=\"100%\" src=\"";
        // line 125
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Browse Image</span>
                              <input type=\"file\" class=\"upload\" name=\"can_photo\" id=\"imageInput\" />
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop\" />
                          </div>
                      </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"crn-add-canines\">Current Reg No</label>
                          <input class=\"form-control\" id=\"crn-add-canines\" name=\"can_current_reg_number\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"as-add-canines\">As</label>
                          <input class=\"form-control\" id=\"as-add-canines\" name=\"can_a_s\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"cin-add-canines\">ICR Number</label>
                          <input class=\"form-control\" id=\"cin-add-canines\" name=\"can_icr_number\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"breed-add-canines\">Breed</label>
                          <select class=\"form-control\" id=\"breed-add-canines\" name=\"can_breed\" required>
                            ";
        // line 156
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 157
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
        // line 159
        echo "                          </select>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"gender-add-canines\">Gender</label>
                          <br>
                          <input id=\"gender-add-canines\" name=\"can_gender\" type=\"radio\" value=\"Male\" checked>Male&nbsp;&nbsp;
                          <input id=\"gender-add-canines\" name=\"can_gender\" type=\"radio\" value=\"Female\" />Female
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"dob-add-canines\">Date of Birth</label>
                          <input class=\"form-control\" id=\"dob-add-canines\" name=\"can_date_of_birth\" type=\"text\" required>
                        </div>
                    </div>

                    <!-- ARTechnology -->
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"color-add-canines\">Color</label>
                          <input class=\"form-control\" id=\"color-add-canines\" name=\"can_color\" type=\"text\" required>
                        </div>
                    </div>
                  </div>

                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"icrmn-add-canines\">ICR Microchip No</label>
                          <input class=\"form-control\" id=\"icrmn-add-canines\" name=\"can_icr_moc_number\" type=\"text\" >
                        </div>
                    </div>
                    <!-- ARTechnology -->
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"sire-add-canines\">
                          <label for=\"sire-add\">Sire</label>
                          <select class=\"form-control sire\" id=\"sire-add\" name=\"can_sire\" required style=\"height: 34px;width:100%\"></select>
                          ";
        // line 201
        echo "                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"dam-canines\">
                          <label for=\"dam-add\">Dam</label>
                          </br>
                            <select class=\"form-control dam\" id=\"dam-add\" name=\"can_dam\" required style=\"height: 34px;width:100%\"></select>

                            ";
        // line 211
        echo "                            ";
        // line 212
        echo "                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"breeder-canines\">
                          <label for=\"breeder\">Breeder</label>
                          <input class=\"form-control typeahead\" id=\"breeder\" name=\"can_owner_name\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"kennel-canines\">
                          <label for=\"kennel\">Kennel</label>
                          <input class=\"form-control typeahead \" id=\"kennel\" name=\"can_cage\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"address-canines\">
                          <label for=\"address-add-canines\">Address</label>
                          <input class=\"form-control typeahead\" id=\"address-add-canines\" name=\"can_address\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"owner-canines\">
                          <label for=\"owner-add-canines\">Owner</label>
                          <input class=\"form-control typeahead\" id=\"owner-add-canines\" name=\"can_owner\" type=\"text\" required>
                        </div>
                    </div>

                    <!-- ARTechnology -->
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"member-canines\">
                          <label for=\"member-add\">Member</label>
                          </br>
                            <select class=\"form-control member\" id=\"member-add\" name=\"can_member\" required style=\"height: 34px;width:100%\"></select>

                            ";
        // line 251
        echo "                            ";
        // line 252
        echo "                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"note-add\">
                          <label for=\"note-add-canines\">Catatan</label>
                          <textarea class=\"form-control\" name=\"can_note\" id=\"note-add-canines\"  rows=\"4\" cols=\"20\"></textarea>
                        </div>
                    </div>
                    <!-- ARTechnology -->
                  </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-canines\">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

<div class=\"modal fade\" id=\"modal-update-canines\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-lg\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-canine form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Canines</h3>
                </div>
                <div class=\"block-content\">
                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                      <div class=\"col-xs-4 col-xs-offset-4\">
                          <img id=\"imgPreview-update\" width=\"100%\" src=\"";
        // line 292
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/img/avatars/avatar1.jpg\">
                          <div class=\"fileUpload btn btn-default btn-flat btn-block\">
                              <span>Browse Image</span>
                              <input type=\"file\" class=\"upload\" name=\"can_photo\" id=\"imageInput\" />
                              <input type=\"hidden\" class=\"\" name=\"srcDataCrop\" id=\"srcDataCrop-update\" />
                          </div>
                      </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"crn-update-canines\">Current Reg No</label>
                          <input class=\"form-control\" id=\"crn-update-canines\" name=\"can_current_reg_number\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"as-update-canines\">As</label>
                          <input class=\"form-control\" id=\"as-update-canines\" name=\"can_a_s\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"cin-update-canines\">ICR Number</label>
                          <input class=\"form-control\" id=\"cin-update-canines\" name=\"can_icr_number\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"breed-update-canines\">Breed</label>
                          <select class=\"form-control\" id=\"breed-update-canines\" name=\"can_breed\" required>
                            ";
        // line 324
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trahs"]) ? $context["trahs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["trah"]) {
            // line 325
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
        // line 327
        echo "                          </select>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"gender-update-canines\">Gender</label>
                          <select id=\"gender-update-canines\" class=\"form-control\" name=\"can_gender\" >
                              <option value=\"Male\">Male</option>
                              <option value=\"Female\">Female</option>
                          </select>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"dob-update-canines\">Date of Birth</label>
                          <input class=\"form-control\" id=\"dob-update-canines\" name=\"can_date_of_birth\" required>
                        </div>
                    </div>
                  </div>

                  <div class=\"col-md-6\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"color-update-canines\">Color</label>
                          <input class=\"form-control\" id=\"color-update-canines\" name=\"can_color\" type=\"text\" required>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"icrmn-update-canines\">ICR Microchip No</label>
                          <input class=\"form-control\" id=\"icrmn-update-canines\" name=\"can_icr_moc_number\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"breeder-update\">
                          <label for=\"breeder\">Breeder</label>
                          <input class=\"form-control typeahead breeder-update\" id=\"breeder-update\" name=\"can_owner_name\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"kennel-update\">
                          <label for=\"kennel\">Kennel</label>
                          <input class=\"form-control typeahead kennel-update\" id=\"kennel-update\" name=\"can_cage\" type=\"text\" required>
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"address-update\">
                          <label for=\"address-update-canines\">Address</label>
                          <!-- ARTechnology -->
                          <input class=\"form-control typeahead address-update\" id=\"address-update\" name=\"can_address\" type=\"text\" required>
                          <!-- ARTechnology -->
                        </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"owner-update\">
                          <label for=\"owner-update\">Owner</label>
                          <input class=\"form-control typeahead owner-update\" id=\"owner-update\" name=\"can_owner\" type=\"text\" required>
                        </div>
                    </div>

                    <!-- ARTechnology -->
                    ";
        // line 401
        echo "
                    <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"member-update\">Member</label>
                        <select class=\"form-control\" id=\"member-update\" name=\"can_member\" required style=\"height: 34px;width:100%\"></select>
                      </div>
                    </div>

                    <div class=\"form-group\">
                        <div class=\"col-xs-12\" id=\"note-update\">
                          <label for=\"note-update-canines\">Catatan</label>
                          <textarea class=\"form-control\" name=\"can_note\" id=\"note-update-canines\"  rows=\"4\" cols=\"20\"></textarea>
                        </div>
                    </div>
                    <!-- ARTechnology -->
                  </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-canines\">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->

<div class=\"modal fade\" id=\"modal-update-pedigree\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-update-pedigree form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Ubah Silsilah</h3>
                </div>
                <div class=\"block-content\">

                  ";
        // line 458
        echo "
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\" >
                        <label for=\"sire-update\">Sire</label>
                        <select class=\"form-control\" id=\"sire-update\" name=\"can_sire\" required style=\"height: 34px;width:100%\"></select>
                      </div>
                  </div>
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"dam-update\">Dam</label>
                        <select class=\"form-control\" id=\"dam-update\" name=\"can_dam\" required style=\"height: 34px;width:100%\"></select>
                      </div>
                  </div>

                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-canines\">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->


<div class=\"modal fade\" id=\"modal-payment-canines\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top modal-md\">
        <div class=\"modal-content\">
            <form action=\"\" class=\"form-payment-canine form-horizontal\" method=\"post\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Payment</h3>
                </div>
                <div class=\"block-content\">
                  <!-- <div class=\"col-md-6\"> -->
                  <div class=\"form-group\">
                      <div class=\"col-xs-12\">
                        <label for=\"crp-update-canines\">Jumlah Pembayaran</label>
                        <input class=\"form-control\" id=\"crp-update-canines\" name=\"can_remaining_payment\" type=\"text\" value=\"";
        // line 503
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["setting"]) ? $context["setting"] : null), "set_certificate_price", array()), "html", null, true);
        echo "\" readonly>
                      </div>
                  </div>
                    <!-- <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"cin-update-canines\">ICR Number</label>
                          <input class=\"form-control\" id=\"cin-update-canines\" name=\"can_icr_number\" type=\"text\" required>
                        </div>
                    </div> -->
                  <!-- </div> -->
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-update-canines\">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal update-->

<div class=\"modal fade\" id=\"modal-import-canines\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-top\">
        <div class=\"modal-content\">
            <form action=\"";
        // line 528
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "canines/import_csv\" class=\"form-import-canines form-horizontal\" method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"block block-themed block-transparent remove-margin-b\">
                <div class=\"block-header bg-primary-dark\">
                    <ul class=\"block-options\">
                        <li>
                            <button data-dismiss=\"modal\" type=\"button\"><i class=\"si si-close\"></i></button>
                        </li>
                    </ul>
                    <h3 class=\"block-title\">Import Canines dari CSV</h3>
                </div>
                <div class=\"block-content\">
                    <div class=\"form-group\">
                        <div class=\"col-xs-12\">
                          <label for=\"csv-add-canines\">File CSV</label>
                          <input class=\"\" id=\"csv-add-canines\" name=\"userfile\" type=\"file\" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class=\"progress progress-add\" style=\"display:none\">
                        <div style=\"width: 0%;\" aria-valuemax=\"100\" aria-valuemin=\"0\" aria-valuenow=\"0\" role=\"progressbar\" class=\"progress-upload-rec progress-bar progress-bar-success\">0%</div>
                    </div>
                </div>
            </div>
            <div class=\"clearfix\"></div><br>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default pull-left\" data-dismiss=\"modal\">Close</button>
                <button type=\"submit\" class=\"btn btn-primary submit-add-canines\">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal add-->

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
        // line 587
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />

";
    }

    // line 591
    public function block_scripts($context, array $blocks = array())
    {
        // line 592
        echo "<!-- Page JS Plugins -->

<!-- ARTechnology -->
<!--
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js\"></script>
-->
<script src=\"";
        // line 599
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/select2/js/select2.min.js\"></script>
<!-- ARTechnology -->

<script src=\"";
        // line 602
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js\"></script>
<script src=\"";
        // line 603
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js\"></script>
<script src=\"";
        // line 604
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/cropper/dist/cropper.min.js\"></script>
<script src=\"";
        // line 605
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js\"></script>
<script src=\"";
        // line 606
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>
<script src=\"";
        // line 607
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>
<script src=\"";
        // line 608
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/plugins/summernote/summernote.min.js\"></script>
<!-- Page JS Code -->

<input type=\"hidden\" value=\"";
        // line 611
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" class=\"base_url\" />
<script src=\"";
        // line 612
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/oneui/js/pages/adm_canines.js\"></script>
<script>
    jQuery(function () {
        \$('#dob-add-canines').datetimepicker({
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
        \$('#dob-update-canines').datetimepicker({
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

<!-- search engine -->
<script src=\"";
        // line 651
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/bloodhound.min.js\"></script>
<script src=\"";
        // line 652
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.bundle.min.js\"></script>
<script src=\"";
        // line 653
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "assets/typeahead.js/dist/typeahead.jquery.min.js\"></script>


<script>
var base_url = \$('.base_url').val();

";
        // line 660
        echo "
\$(\".dam\").select2({
    placeholder: 'Pilih Dam',
    ajax: {
        url: base_url+\"/backend/canines/dam\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-add-canines\")
});

\$(\".sire\").select2({
    placeholder: 'Pilih Sire',
    ajax: {
        url: base_url+\"/backend/canines/sire\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-add-canines\")
});

// ARTechnology
\$(\".member\").select2({
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
    dropdownParent: \$(\"#modal-add-canines\")
});
// ARTechnology

\$(\"#dam-update\").select2({
    placeholder: 'Pilih Dam',
    ajax: {
        url: base_url+\"/backend/canines/dam\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-update-pedigree\")
});

\$(\"#sire-update\").select2({
    placeholder: 'Pilih Sire',
    ajax: {
        url: base_url+\"/backend/canines/sire\",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
            results: data
        };
        },
        cache: true
    },
    dropdownParent: \$(\"#modal-update-pedigree\")
});

// ARTechnology
\$(\"#member-update\").select2({
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
    dropdownParent: \$(\"#modal-update-canines\")
});
// ARTechnology
";
        // line 761
        echo "
function functionSire(\$id){
  \$('#can_sire_update').val(\$id);
}

function functionDam(\$id){
  \$('#can_dam_update').val(\$id);
}

// ARTechnology
function functionMember(\$id){
  \$('#can_member_update').val(\$id);
}
// ARTechnology

// sire
var sire = new Bloodhound({
    identify: function(o) { return o.can_a_s; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),
    dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },
    // prefetch: {
    //   cache: false,
    //     url : base_url+'canines/search'
    // },
    remote: {
      url: base_url+'backend/canines/sire?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

sire.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used

\$('#sire-update .typeahead').typeahead(null, {
name: 'sire',
display: 'can_a_s',
placeholder: false,
source: sire.ttAdapter(),
templates: {
  empty: [
    '<div class=\"empty-message\">',
      '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
    '</div>'
  ].join('\\n'),
  suggestion: function (data) {
    \$('#can_sire_update').val(data.can_id);
     return '<a style=\"color:black;\" href=\"javascript:functionSire('+data.can_id+')\"><div style=\"margin-bottom:15px;\"><img width=\"30px\" style=\"float:left; margin:5px;\" src=\"'+data.can_photo+'\">' + data.can_a_s + '</div></a><br><br>';
 }
}
});

// dam
var dam = new Bloodhound({
    identify: function(o) { return o.can_a_s; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),
    dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },
    // prefetch: {
    //   cache: false,
    //     url : base_url+'canines/search'
    // },
    remote: {
      url: base_url+'backend/canines/dam?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

dam.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used

\$('#dam-update .typeahead').typeahead(null, {
name: 'dam',
display: 'can_a_s',
placeholder: false,
source: dam.ttAdapter(),
templates: {
  empty: [
    '<div class=\"empty-message\">',
      '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
    '</div>'
  ].join('\\n'),
  suggestion: function (data) {
    \$('#can_dam_update').val(data.can_id);
    console.log(data.can_id);
     return '<a style=\"color:black;\" href=\"javascript:functionDam('+data.can_id+')\"><div style=\"margin-bottom:15px;\"><img width=\"30px\" style=\"float:left; margin:5px;\" src=\"'+data.can_photo+'\">' + data.can_a_s + '</div></a><br><br>';
 }
}
});

// ARTechnology
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
// passing in `null` for the `options` arguments will result in the default
// options being used

\$('#member-update .typeahead').typeahead(null, {
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
    \$('#can_member_update').val(data.mem_id);
    return '<a style=\"color:black;\" href=\"javascript:functionMember('+data.mem_id+')\"><div style=\"margin-bottom:15px;\">' + data.mem_name + '</div></a><br><br>';
 }
}
});
// ARTechnology

// breeder
var breeder = new Bloodhound({
    identify: function(o) { return o.can_owner_name; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),
    dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },
    // prefetch: {
    //   cache: false,
    //     url : base_url+'canines/search'
    // },
    remote: {
      url: base_url+'backend/canines/breeder?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

breeder.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used
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
    // prefetch: {
    //   cache: false,
    //     url : base_url+'canines/search'
    // },
    remote: {
      url: base_url+'backend/canines/kennel?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

kennel.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used
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

// address

var address = new Bloodhound({
    identify: function(o) { return o.can_address; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_address'),
    dupDetector: function(a, b) { return a.can_address === b.can_address; },
    // prefetch: {
    //   cache: false,
    //     url : base_url+'canines/search'
    // },
    remote: {
      url: base_url+'backend/canines/address?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

address.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used
\$('#address-canines .typeahead').typeahead(null, {
name: 'address',
display: 'can_address',
placeholder: false,
source: address.ttAdapter(),
templates: {
  empty: [
    '<div class=\"empty-message\">',
      '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
    '</div>'
  ].join('\\n'),
  suggestion: function (data) {
     return '<a style=\"color:black;\" href=\"#\"><div style=\"margin-bottom:10px;padding-left:10px;\">'+ data.can_address + '</div></a><br><hr>';
 }
}
});

// owner
var owner = new Bloodhound({
    identify: function(o) { return o.can_owner; },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner'),
    dupDetector: function(a, b) { return a.can_owner === b.can_owner; },
    // prefetch: {
    //   cache: false,
    //     url : base_url+'canines/search'
    // },
    remote: {
      url: base_url+'backend/canines/owner?q=%QUERY',
      wildcard: '%QUERY',
      cache: false
    }
  });

owner.initialize();
// passing in `null` for the `options` arguments will result in the default
// options being used
\$('#owner-canines .typeahead').typeahead(null, {
name: 'owner',
display: 'can_owner',
placeholder: false,
source: owner.ttAdapter(),
templates: {
  empty: [
    '<div class=\"empty-message\">',
      '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',
    '</div>'
  ].join('\\n'),
  suggestion: function (data) {
     return '<a style=\"color:black;\" href=\"#\"><div style=\"margin-bottom:10px;padding-left:10px;\">'+ data.can_owner + '</div></a><br><hr>';
 }
}
});
</script>
<!-- <script src=\"";
        // line 1042
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "/assets/oneui/js/pages/adm_canines.js\"></script> -->
";
    }

    public function getTemplateName()
    {
        return "backend/canines.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1177 => 1042,  894 => 761,  792 => 660,  783 => 653,  779 => 652,  775 => 651,  733 => 612,  729 => 611,  723 => 608,  719 => 607,  715 => 606,  711 => 605,  707 => 604,  703 => 603,  699 => 602,  693 => 599,  684 => 592,  681 => 591,  674 => 587,  612 => 528,  584 => 503,  537 => 458,  492 => 401,  423 => 327,  412 => 325,  408 => 324,  373 => 292,  331 => 252,  329 => 251,  289 => 212,  287 => 211,  276 => 201,  233 => 159,  222 => 157,  218 => 156,  184 => 125,  167 => 111,  96 => 42,  93 => 41,  64 => 15,  56 => 10,  52 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }
}
/* {% extends "template/backend.twig" %}*/
/* */
/* {% block styles %}*/
/* <!-- Page JS Plugins CSS -->*/
/* <!-- <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/style.css"> -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.css">*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/oneui/css/search.css" media="screen" title="no title" charset="utf-8">*/
/* <!-- ARTechnology -->*/
/* <!--*/
/* <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />*/
/* -->*/
/* <link rel="stylesheet" href="{{ base_url() }}/assets/select2/css/select2.min.css" />*/
/* <!-- ARTechnology -->*/
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
/* */
/* </style>*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/* <div class="content wrap-breadcrumb">*/
/*     <div class="col-sm-12 text-right hidden-xs">*/
/*         <ol class="breadcrumb">*/
/*             <li><a href="/dashboard" class="link-effect">Dashboard</a></li>*/
/*             <li>Canines</li>*/
/*         </ol>*/
/*     </div>*/
/* </div>*/
/* <!-- Page Content -->*/
/* */
/* <div class="content">*/
/* <!-- Dynamic Table Full -->*/
/*     <div class="block">*/
/*         <div class="block-header text-center bg-gray-lighter">*/
/*             <button class="btn btn-default btn-delete-canine pull-left"  data-toggle="tooltip" title="Hapus yang dipilih" disabled><i class="si si-trash"></i></button>*/
/*             <!-- ARTechnology -->*/
/*             <button class="btn btn-success btn-activate-canine pull-left"  data-toggle="tooltip" title="Aktivasi yang dipilih" disabled><i class="si si-check"></i></button>*/
/*             <button class="btn btn-danger btn-deactivate-canine pull-left"  data-toggle="tooltip" title="Deaktivasi yang dipilih" disabled><i class="si si-close"></i></button>*/
/*             <!-- ARTechnology -->*/
/*             <button class="btn btn-primary btn-add-canines pull-right" onClick="openModal('#modal-add-canines', 'add')" data-toggle="tooltip" title="Tambah Canines"><i class="si si-note"></i></button>*/
/*             <h4><small>Daftar</small> Canines</h4>*/
/*         </div>*/
/*         <div class="block-content ">*/
/*             <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/canines.js -->*/
/*             <div class="table-responsive">*/
/*             <table class="table table-borderless table-striped data-canines">*/
/*                 <thead>*/
/*                     <tr>*/
/*                         <th width="5">*/
/*                             <div class="checkbox-canine-all">*/
/*                               <input type="checkbox" data-toggle="tooltip" title="Select all">*/
/*                             </div>*/
/*                         </th>*/
/*                         <th width="1%">Foto</th>*/
/*                         <th>Nomor Registrasi</th>*/
/*                         <th>*/
/*                           Nomor Chip*/
/*                         </th>*/
/*                         <th>Nomor ICR</th>*/
/*                         <th>AS</th>*/
/*                         <th>Jenis Kelamin</th>*/
/*                         <th>Owner</th>*/
/*                         <!-- ARTechnology 1 -->*/
/*                         <th>Member</th>*/
/*                         <!-- ARTechnology 1 -->*/
/*                         <th>Score</th>*/
/*                         <!-- ARTechnology 2 -->*/
/*                         <th>Status</th>*/
/*                         <!-- ARTechnology 2 -->*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <!-- ARTechnology 3 -->*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <th class="text-center" width="1%">#</th>*/
/*                         <!-- ARTechnology 3 -->*/
/*                     </tr>*/
/*                 </thead>*/
/*             </table>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- modals -->*/
/* <div class="modal fade" id="modal-add-canines" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-lg">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}backend/canines/add" class="form-add-canines form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Add Canines</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Browse Image</span>*/
/*                               <input type="file" class="upload" name="can_photo" id="imageInput" />*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop" />*/
/*                           </div>*/
/*                       </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="crn-add-canines">Current Reg No</label>*/
/*                           <input class="form-control" id="crn-add-canines" name="can_current_reg_number" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="as-add-canines">As</label>*/
/*                           <input class="form-control" id="as-add-canines" name="can_a_s" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="cin-add-canines">ICR Number</label>*/
/*                           <input class="form-control" id="cin-add-canines" name="can_icr_number" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="breed-add-canines">Breed</label>*/
/*                           <select class="form-control" id="breed-add-canines" name="can_breed" required>*/
/*                             {% for trah in trahs %}*/
/*                                 <option value="{{trah.tra_name}}">{{trah.tra_name}}</option>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="gender-add-canines">Gender</label>*/
/*                           <br>*/
/*                           <input id="gender-add-canines" name="can_gender" type="radio" value="Male" checked>Male&nbsp;&nbsp;*/
/*                           <input id="gender-add-canines" name="can_gender" type="radio" value="Female" />Female*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="dob-add-canines">Date of Birth</label>*/
/*                           <input class="form-control" id="dob-add-canines" name="can_date_of_birth" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <!-- ARTechnology -->*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="color-add-canines">Color</label>*/
/*                           <input class="form-control" id="color-add-canines" name="can_color" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                   </div>*/
/* */
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="icrmn-add-canines">ICR Microchip No</label>*/
/*                           <input class="form-control" id="icrmn-add-canines" name="can_icr_moc_number" type="text" >*/
/*                         </div>*/
/*                     </div>*/
/*                     <!-- ARTechnology -->*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="sire-add-canines">*/
/*                           <label for="sire-add">Sire</label>*/
/*                           <select class="form-control sire" id="sire-add" name="can_sire" required style="height: 34px;width:100%"></select>*/
/*                           {# <input type="hidden" name="can_sire" id="can_sire"> #}*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="dam-canines">*/
/*                           <label for="dam-add">Dam</label>*/
/*                           </br>*/
/*                             <select class="form-control dam" id="dam-add" name="can_dam" required style="height: 34px;width:100%"></select>*/
/* */
/*                             {# <select class="form-control dam"  name="can_dam" required width="100%"></select> #}*/
/*                             {# <input type="hidden" name="can_dam" id="can_dam"> #}*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="breeder-canines">*/
/*                           <label for="breeder">Breeder</label>*/
/*                           <input class="form-control typeahead" id="breeder" name="can_owner_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="kennel-canines">*/
/*                           <label for="kennel">Kennel</label>*/
/*                           <input class="form-control typeahead " id="kennel" name="can_cage" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="address-canines">*/
/*                           <label for="address-add-canines">Address</label>*/
/*                           <input class="form-control typeahead" id="address-add-canines" name="can_address" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="owner-canines">*/
/*                           <label for="owner-add-canines">Owner</label>*/
/*                           <input class="form-control typeahead" id="owner-add-canines" name="can_owner" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <!-- ARTechnology -->*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="member-canines">*/
/*                           <label for="member-add">Member</label>*/
/*                           </br>*/
/*                             <select class="form-control member" id="member-add" name="can_member" required style="height: 34px;width:100%"></select>*/
/* */
/*                             {# <select class="form-control member"  name="can_member" required width="100%"></select> #}*/
/*                             {# <input type="hidden" name="can_member" id="can_member"> #}*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="note-add">*/
/*                           <label for="note-add-canines">Catatan</label>*/
/*                           <textarea class="form-control" name="can_note" id="note-add-canines"  rows="4" cols="20"></textarea>*/
/*                         </div>*/
/*                     </div>*/
/*                     <!-- ARTechnology -->*/
/*                   </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-canines">Save</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
/* */
/* <div class="modal fade" id="modal-update-canines" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-lg">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-canine form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Canines</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                       <div class="col-xs-4 col-xs-offset-4">*/
/*                           <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">*/
/*                           <div class="fileUpload btn btn-default btn-flat btn-block">*/
/*                               <span>Browse Image</span>*/
/*                               <input type="file" class="upload" name="can_photo" id="imageInput" />*/
/*                               <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update" />*/
/*                           </div>*/
/*                       </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="crn-update-canines">Current Reg No</label>*/
/*                           <input class="form-control" id="crn-update-canines" name="can_current_reg_number" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="as-update-canines">As</label>*/
/*                           <input class="form-control" id="as-update-canines" name="can_a_s" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="cin-update-canines">ICR Number</label>*/
/*                           <input class="form-control" id="cin-update-canines" name="can_icr_number" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="breed-update-canines">Breed</label>*/
/*                           <select class="form-control" id="breed-update-canines" name="can_breed" required>*/
/*                             {% for trah in trahs %}*/
/*                                 <option value="{{trah.tra_name}}">{{trah.tra_name}}</option>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="gender-update-canines">Gender</label>*/
/*                           <select id="gender-update-canines" class="form-control" name="can_gender" >*/
/*                               <option value="Male">Male</option>*/
/*                               <option value="Female">Female</option>*/
/*                           </select>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="dob-update-canines">Date of Birth</label>*/
/*                           <input class="form-control" id="dob-update-canines" name="can_date_of_birth" required>*/
/*                         </div>*/
/*                     </div>*/
/*                   </div>*/
/* */
/*                   <div class="col-md-6">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="color-update-canines">Color</label>*/
/*                           <input class="form-control" id="color-update-canines" name="can_color" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="icrmn-update-canines">ICR Microchip No</label>*/
/*                           <input class="form-control" id="icrmn-update-canines" name="can_icr_moc_number" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="breeder-update">*/
/*                           <label for="breeder">Breeder</label>*/
/*                           <input class="form-control typeahead breeder-update" id="breeder-update" name="can_owner_name" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="kennel-update">*/
/*                           <label for="kennel">Kennel</label>*/
/*                           <input class="form-control typeahead kennel-update" id="kennel-update" name="can_cage" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="address-update">*/
/*                           <label for="address-update-canines">Address</label>*/
/*                           <!-- ARTechnology -->*/
/*                           <input class="form-control typeahead address-update" id="address-update" name="can_address" type="text" required>*/
/*                           <!-- ARTechnology -->*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="owner-update">*/
/*                           <label for="owner-update">Owner</label>*/
/*                           <input class="form-control typeahead owner-update" id="owner-update" name="can_owner" type="text" required>*/
/*                         </div>*/
/*                     </div>*/
/* */
/*                     <!-- ARTechnology -->*/
/*                     {# <div class="form-group">*/
/*                       <div class="col-xs-12" id="member-update">*/
/*                         <label for="member">Member</label>*/
/*                         <input class="form-control typeahead member-update" id="member-update" name="member" type="text">*/
/*                         <input class="form-control" type="hidden"  name="can_member" id="can_member_update">*/
/*                       </div>*/
/*                     </div> #}*/
/* */
/*                     <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="member-update">Member</label>*/
/*                         <select class="form-control" id="member-update" name="can_member" required style="height: 34px;width:100%"></select>*/
/*                       </div>*/
/*                     </div>*/
/* */
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12" id="note-update">*/
/*                           <label for="note-update-canines">Catatan</label>*/
/*                           <textarea class="form-control" name="can_note" id="note-update-canines"  rows="4" cols="20"></textarea>*/
/*                         </div>*/
/*                     </div>*/
/*                     <!-- ARTechnology -->*/
/*                   </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-canines">Save</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
/* <div class="modal fade" id="modal-update-pedigree" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-update-pedigree form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Ubah Silsilah</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/* */
/*                   {# <div class="form-group">*/
/*                       <div class="col-xs-12" id="sire-update">*/
/*                         <label for="sire">Sire</label>*/
/*                         <input class="form-control typeahead sire-update" id="sire-update" name="sire" type="text">*/
/*                         <input class="form-control" type="hidden"  name="can_sire" id="can_sire_update">*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12" id="dam-update">*/
/*                         <label for="dam">Dam</label>*/
/*                         <input class="form-control typeahead dam-update" id="dam-update" name="dam" type="text">*/
/*                         <input class="form-control" type="hidden"  name="can_dam" id="can_dam_update">*/
/*                       </div>*/
/*                   </div> #}*/
/* */
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12" >*/
/*                         <label for="sire-update">Sire</label>*/
/*                         <select class="form-control" id="sire-update" name="can_sire" required style="height: 34px;width:100%"></select>*/
/*                       </div>*/
/*                   </div>*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="dam-update">Dam</label>*/
/*                         <select class="form-control" id="dam-update" name="can_dam" required style="height: 34px;width:100%"></select>*/
/*                       </div>*/
/*                   </div>*/
/* */
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-canines">Save</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
/* */
/* <div class="modal fade" id="modal-payment-canines" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top modal-md">*/
/*         <div class="modal-content">*/
/*             <form action="" class="form-payment-canine form-horizontal" method="post">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Payment</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                   <!-- <div class="col-md-6"> -->*/
/*                   <div class="form-group">*/
/*                       <div class="col-xs-12">*/
/*                         <label for="crp-update-canines">Jumlah Pembayaran</label>*/
/*                         <input class="form-control" id="crp-update-canines" name="can_remaining_payment" type="text" value="{{	setting.set_certificate_price}}" readonly>*/
/*                       </div>*/
/*                   </div>*/
/*                     <!-- <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="cin-update-canines">ICR Number</label>*/
/*                           <input class="form-control" id="cin-update-canines" name="can_icr_number" type="text" required>*/
/*                         </div>*/
/*                     </div> -->*/
/*                   <!-- </div> -->*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-update-canines">Save</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal update-->*/
/* */
/* <div class="modal fade" id="modal-import-canines" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-dialog-top">*/
/*         <div class="modal-content">*/
/*             <form action="{{base_url()}}canines/import_csv" class="form-import-canines form-horizontal" method="post" enctype="multipart/form-data">*/
/*             <div class="block block-themed block-transparent remove-margin-b">*/
/*                 <div class="block-header bg-primary-dark">*/
/*                     <ul class="block-options">*/
/*                         <li>*/
/*                             <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>*/
/*                         </li>*/
/*                     </ul>*/
/*                     <h3 class="block-title">Import Canines dari CSV</h3>*/
/*                 </div>*/
/*                 <div class="block-content">*/
/*                     <div class="form-group">*/
/*                         <div class="col-xs-12">*/
/*                           <label for="csv-add-canines">File CSV</label>*/
/*                           <input class="" id="csv-add-canines" name="userfile" type="file" required>*/
/*                         </div>*/
/*                     </div>*/
/*                     <br>*/
/*                     <br>*/
/*                     <div class="progress progress-add" style="display:none">*/
/*                         <div style="width: 0%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-upload-rec progress-bar progress-bar-success">0%</div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="clearfix"></div><br>*/
/*             <div class="modal-footer">*/
/*                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>*/
/*                 <button type="submit" class="btn btn-primary submit-add-canines">Save</button>*/
/*             </div>*/
/*             </form>*/
/*         </div><!-- /.modal-content -->*/
/*     </div><!-- /.modal-dialog -->*/
/* </div><!-- /.modal add-->*/
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
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* <!-- Page JS Plugins -->*/
/* */
/* <!-- ARTechnology -->*/
/* <!--*/
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>*/
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>*/
/* -->*/
/* <script src="{{ base_url() }}assets/select2/js/select2.min.js"></script>*/
/* <!-- ARTechnology -->*/
/* */
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/shiftcheckbox/jquery.shiftcheckbox.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/cropper/dist/cropper.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/jquery-validation/jquery.validate.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>*/
/* <script src="{{ base_url() }}/assets/oneui/js/plugins/summernote/summernote.min.js"></script>*/
/* <!-- Page JS Code -->*/
/* */
/* <input type="hidden" value="{{ base_url() }}" class="base_url" />*/
/* <script src="{{ base_url() }}assets/oneui/js/pages/adm_canines.js"></script>*/
/* <script>*/
/*     jQuery(function () {*/
/*         $('#dob-add-canines').datetimepicker({*/
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
/*         $('#dob-update-canines').datetimepicker({*/
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
/* <!-- search engine -->*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/bloodhound.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.bundle.min.js"></script>*/
/* <script src="{{ base_url() }}assets/typeahead.js/dist/typeahead.jquery.min.js"></script>*/
/* */
/* */
/* <script>*/
/* var base_url = $('.base_url').val();*/
/* */
/* {# start select2 #}*/
/* */
/* $(".dam").select2({*/
/*     placeholder: 'Pilih Dam',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/dam",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-add-canines")*/
/* });*/
/* */
/* $(".sire").select2({*/
/*     placeholder: 'Pilih Sire',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/sire",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-add-canines")*/
/* });*/
/* */
/* // ARTechnology*/
/* $(".member").select2({*/
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
/*     dropdownParent: $("#modal-add-canines")*/
/* });*/
/* // ARTechnology*/
/* */
/* $("#dam-update").select2({*/
/*     placeholder: 'Pilih Dam',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/dam",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-update-pedigree")*/
/* });*/
/* */
/* $("#sire-update").select2({*/
/*     placeholder: 'Pilih Sire',*/
/*     ajax: {*/
/*         url: base_url+"/backend/canines/sire",*/
/*         dataType: 'json',*/
/*         delay: 250,*/
/*         processResults: function (data) {*/
/*         return {*/
/*             results: data*/
/*         };*/
/*         },*/
/*         cache: true*/
/*     },*/
/*     dropdownParent: $("#modal-update-pedigree")*/
/* });*/
/* */
/* // ARTechnology*/
/* $("#member-update").select2({*/
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
/*     dropdownParent: $("#modal-update-canines")*/
/* });*/
/* // ARTechnology*/
/* {# end select2 #}*/
/* */
/* function functionSire($id){*/
/*   $('#can_sire_update').val($id);*/
/* }*/
/* */
/* function functionDam($id){*/
/*   $('#can_dam_update').val($id);*/
/* }*/
/* */
/* // ARTechnology*/
/* function functionMember($id){*/
/*   $('#can_member_update').val($id);*/
/* }*/
/* // ARTechnology*/
/* */
/* // sire*/
/* var sire = new Bloodhound({*/
/*     identify: function(o) { return o.can_a_s; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),*/
/*     dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },*/
/*     // prefetch: {*/
/*     //   cache: false,*/
/*     //     url : base_url+'canines/search'*/
/*     // },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/sire?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* sire.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
/* */
/* $('#sire-update .typeahead').typeahead(null, {*/
/* name: 'sire',*/
/* display: 'can_a_s',*/
/* placeholder: false,*/
/* source: sire.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*     $('#can_sire_update').val(data.can_id);*/
/*      return '<a style="color:black;" href="javascript:functionSire('+data.can_id+')"><div style="margin-bottom:15px;"><img width="30px" style="float:left; margin:5px;" src="'+data.can_photo+'">' + data.can_a_s + '</div></a><br><br>';*/
/*  }*/
/* }*/
/* });*/
/* */
/* // dam*/
/* var dam = new Bloodhound({*/
/*     identify: function(o) { return o.can_a_s; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_a_s'),*/
/*     dupDetector: function(a, b) { return a.can_a_s === b.can_a_s; },*/
/*     // prefetch: {*/
/*     //   cache: false,*/
/*     //     url : base_url+'canines/search'*/
/*     // },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/dam?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* dam.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
/* */
/* $('#dam-update .typeahead').typeahead(null, {*/
/* name: 'dam',*/
/* display: 'can_a_s',*/
/* placeholder: false,*/
/* source: dam.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*     $('#can_dam_update').val(data.can_id);*/
/*     console.log(data.can_id);*/
/*      return '<a style="color:black;" href="javascript:functionDam('+data.can_id+')"><div style="margin-bottom:15px;"><img width="30px" style="float:left; margin:5px;" src="'+data.can_photo+'">' + data.can_a_s + '</div></a><br><br>';*/
/*  }*/
/* }*/
/* });*/
/* */
/* // ARTechnology*/
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
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
/* */
/* $('#member-update .typeahead').typeahead(null, {*/
/* name: 'member',*/
/* display: 'mem_name',*/
/* placeholder: false,*/
/* source: member.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*     $('#can_member_update').val(data.mem_id);*/
/*     return '<a style="color:black;" href="javascript:functionMember('+data.mem_id+')"><div style="margin-bottom:15px;">' + data.mem_name + '</div></a><br><br>';*/
/*  }*/
/* }*/
/* });*/
/* // ARTechnology*/
/* */
/* // breeder*/
/* var breeder = new Bloodhound({*/
/*     identify: function(o) { return o.can_owner_name; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner_name'),*/
/*     dupDetector: function(a, b) { return a.can_owner_name === b.can_owner_name; },*/
/*     // prefetch: {*/
/*     //   cache: false,*/
/*     //     url : base_url+'canines/search'*/
/*     // },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/breeder?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* breeder.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
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
/* */
/* var kennel = new Bloodhound({*/
/*     identify: function(o) { return o.can_cage; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_cage'),*/
/*     dupDetector: function(a, b) { return a.can_cage === b.can_cage; },*/
/*     // prefetch: {*/
/*     //   cache: false,*/
/*     //     url : base_url+'canines/search'*/
/*     // },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/kennel?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* kennel.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
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
/* */
/* // address*/
/* */
/* var address = new Bloodhound({*/
/*     identify: function(o) { return o.can_address; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_address'),*/
/*     dupDetector: function(a, b) { return a.can_address === b.can_address; },*/
/*     // prefetch: {*/
/*     //   cache: false,*/
/*     //     url : base_url+'canines/search'*/
/*     // },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/address?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* address.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
/* $('#address-canines .typeahead').typeahead(null, {*/
/* name: 'address',*/
/* display: 'can_address',*/
/* placeholder: false,*/
/* source: address.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*      return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_address + '</div></a><br><hr>';*/
/*  }*/
/* }*/
/* });*/
/* */
/* // owner*/
/* var owner = new Bloodhound({*/
/*     identify: function(o) { return o.can_owner; },*/
/*     queryTokenizer: Bloodhound.tokenizers.whitespace,*/
/*     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('can_owner'),*/
/*     dupDetector: function(a, b) { return a.can_owner === b.can_owner; },*/
/*     // prefetch: {*/
/*     //   cache: false,*/
/*     //     url : base_url+'canines/search'*/
/*     // },*/
/*     remote: {*/
/*       url: base_url+'backend/canines/owner?q=%QUERY',*/
/*       wildcard: '%QUERY',*/
/*       cache: false*/
/*     }*/
/*   });*/
/* */
/* owner.initialize();*/
/* // passing in `null` for the `options` arguments will result in the default*/
/* // options being used*/
/* $('#owner-canines .typeahead').typeahead(null, {*/
/* name: 'owner',*/
/* display: 'can_owner',*/
/* placeholder: false,*/
/* source: owner.ttAdapter(),*/
/* templates: {*/
/*   empty: [*/
/*     '<div class="empty-message">',*/
/*       '<h6><strong>Maaf Data Tidak Ditemukan</strong></h6>',*/
/*     '</div>'*/
/*   ].join('\n'),*/
/*   suggestion: function (data) {*/
/*      return '<a style="color:black;" href="#"><div style="margin-bottom:10px;padding-left:10px;">'+ data.can_owner + '</div></a><br><hr>';*/
/*  }*/
/* }*/
/* });*/
/* </script>*/
/* <!-- <script src="{{ base_url() }}/assets/oneui/js/pages/adm_canines.js"></script> -->*/
/* {% endblock %}*/
/* */
