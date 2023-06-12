<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= lang("common_family_tree"); ?></title>
  <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
  <?php $this->load->view('frontend/layout/header_non_paid'); ?>
  <?php $this->load->view('frontend/layout/navbar'); ?>
  <h3 class="text-center text-warning"><?= lang("common_family_tree"); ?></h3>
  <div class="d-flex justify-content-center">
    <div class="search-container">
      <form action="<?= base_url().'frontend/Certificate/index/'.$this->uri->segment(4) ?>" method="post">
          <div class="input-group my-3">
              <label for="level" class="control-label col-sm-3 h4 mt-1">Level: </label>
              <div class="col-sm-7">
                  <input type="number" class="form-control" placeholder="Level" name="level" value="<?= set_value('level'); ?>" max="10">
              </div>
              <div class="col-sm-1 ms-1">
                  <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Search"><i class="fa fa-search"></i></button>
              </div>
          </div>
      </form>
    </div>
  </div>
  
  <div class="container">
    <div style="width:100%; height:700px;" id="tree">
    </div>
  </div>
  <?php $this->load->view('frontend/layout/footer'); ?>
  <script src="<?= base_url(); ?>assets/js/orgchart.js"></script>
  <script>
    OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.ana);
    OrgChart.templates.myTemplate.field_0 = '<text data-width="400" data-text-overflow="multiline-2-ellipsis" style="font-size: 30px;" fill="white" x="50" y="120">{val}</text>';
    OrgChart.templates.myTemplate.field_1 = '<text data-width="400" data-text-overflow="multiline-2-ellipsis" style="font-size: 30px;" fill="white" x="120" y="50">{val}</text>';
    OrgChart.templates.myTemplate.size = [500, 200];

    var chart = new OrgChart(document.getElementById("tree"), {
      template: 'myTemplate',
      nodeMouseClick: OrgChart.action.none,
      mode: 'dark',
      enableSearch: false,
      nodeBinding: {
        field_0: "name",
        field_1: "status",
        img_0: "img"
      },
      <?php 
      echo $array;
      ?>
    });
    
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script> 
</body>

</html>