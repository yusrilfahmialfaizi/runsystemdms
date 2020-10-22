    <script type="text/javascript">
      $(document).ready(function(){
        var url = 'http://127.0.0.1:8080/runsystemdms/getRootModules';
        $.ajax({
          type: 'GET',
          url: url,
          dataType: 'json',
          cache: false,
          success: function(data) {
              data = JSON.parse(JSON.stringify(data));
              data = data.rmodule;
              var modul = [];
              for (i = 0; i < data.length; i++) {
                  modul.push('<li id="'+i+'"><a class="bar-icons" href="javascript:void(0)" onClick="modules('+data[i].menucode+','+i+')"><i></i><span>'+data[i].menudesc+'</div></span></a><ul class="iconbar-mainmenu custom-scrollbar"><li class="iconbar-header">Sub Module</li><li id="'+data[i].menucode+'"></li></ul></li>');
              }
                $("#module").html(modul);
            }
          });
      });
      </script>
      <script type="text/javascript">
          function modules(menucode, id_li){
            var parent = menucode;
            $("li").removeClass("open");
            $("#"+id_li).even().addClass("open");
            $.ajax({
              type : "POST",
              url : "http://127.0.0.1:8080/runsystemdms/getSubModules",
              dataType : "JSON",
              data : {parent :parent},
              cache : false,
              success : function(data){
                data = JSON.parse(JSON.stringify(data));
                data = data.submodule;
                var subs = [];
                if (data != null) {   
                  for (i = 0; i < data.length; i++) {
                      subs.push('<li><a href="<?php echo base_url("Editor")?>">'+data[i].menudesc+'</a></li>');      
                  }
                  $("#"+data[0].parent).html(subs);
                }
              }
            });
          }
      </script>
      
    <!-- latest jquery-->
    <script src="<?php echo base_url("assets/js/jquery-3.5.1.min.js") ?>"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo base_url("assets/js/bootstrap/popper.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap/bootstrap.js") ?>"></script>
    <!-- feather icon js-->
    <script src="<?php echo base_url("assets/js/icons/feather-icon/feather.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/icons/feather-icon/feather-icon.js") ?>"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo base_url("assets/js/sidebar-menu.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/config.js") ?>"></script>
    <!-- Plugins JS start--><!-- 
    <script src="<?php echo base_url("assets/js/typeahead/handlebars.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/typeahead/typeahead.bundle.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/typeahead/typeahead.custom.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/typeahead-search/handlebars.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/typeahead-search/typeahead-custom.js") ?>"></script> -->
    <!-- <script src="<?php echo base_url("assets/js/chart/chartist/chartist.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/chart/chartist/chartist-plugin-tooltip.js") ?>"></script> -->
    <script src="<?php echo base_url("assets/js/chart/apex-chart/apex-chart.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/chart/apex-chart/stock-prices.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/prism/prism.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/clipboard/clipboard.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/counter/jquery.waypoints.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/counter/jquery.counterup.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/counter/counter-custom.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/custom-card/custom-card.js") ?>"></script>
    <!-- <script src="<?php echo base_url("assets/js/notify/bootstrap-notify.min.js") ?>"></script> -->
    <script src="<?php echo base_url("assets/js/dashboard/default.js") ?>"></script>
    <!-- <script src="<?php echo base_url("assets/js/notify/index.js") ?>"></script> -->
    <script src="<?php echo base_url("assets/js/datepicker/date-picker/datepicker.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datepicker/date-picker/datepicker.en.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datepicker/date-picker/datepicker.custom.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/chat-menu.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.buttons.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/jszip.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/buttons.colVis.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/pdfmake.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/vfs_fonts.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.autoFill.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.select.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/buttons.html5.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/buttons.print.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.responsive.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.keyTable.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.colReorder.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/dataTables.scroller.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/datatable/datatable-extension/custom.js") ?>"></script>
    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo base_url("assets/js/script.js") ?>"></script>
    <!-- <script src="<?php echo base_url("assets/js/theme-customizer/customizer.js") ?>"></script> -->
    <!-- login js-->
