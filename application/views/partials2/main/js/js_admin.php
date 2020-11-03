    
    <script type="text/javascript">
    $(document).ready(function(){
      if ("<?php $this->uri->segment(3)?>" != "home"){
        $("#sidebar").removeClass("iconbar-second-close");
      }
      // get data dynamic sidebar menu 
      var url1 = 'http://127.0.0.1:8080/runsystemdms/getMenuParents';
      var url2 = 'http://127.0.0.1:8080/runsystemdms/getParentsLength';
      var url3 = 'http://127.0.0.1:8080/runsystemdms/getLastChilds';
      var modul = [];
      var menu = '';
      var menus = 'menu';
      var sub = '';
      var subs = 'sub';
      
      $.ajax({ //to get all data menu from db
        type: 'GET',
        url: url1,
        dataType: 'json',
        cache: false,
        success: function(data1) {
          data1 = JSON.parse(JSON.stringify(data1));
          data1 = data1.menuparent;
          $.ajax({ // to get length of parent
              type: 'GET',
              url: url2,
              dataType: 'json',
              cache: false,
              success: function(data2) {
                data2 = JSON.parse(JSON.stringify(data2));
                data2 = data2.parentlength;
                $.ajax({
                  type : 'GET',
                  url : url3,
                  dataType : 'json',
                  cache : false,
                  success: function(data3){
                    data3 = JSON.parse(JSON.stringify(data3));
                    data3 = data3.lastChilds;
                    $.each(data1, function(i,data){
                      var u = 2;
                      if (data.parent != null) {  
                        if (data.parent.length == u) { 
                          menu = '<li id="' + i + '"><a class="bar-icons" href="javascript:modules('+i+')" ><i></i><span>'+data.menudesc+'</div></span></a><ul class="iconbar-mainmenu custom-scrollbar"><li class="iconbar-header">Sub Module</li><li id="'+data.menucode+'"></li></ul></li>';
                          $("#module").append(menu);
                        }
                        for (var j = 0; j < data2.length; j++) {
                          if (data.parent.length == (u = u+2)) { 
                            for (k = 0; k < data3.length; k++){
                              if (data.menucode == data3[k].menucode){
                                sub = '<li><a href="<?php echo base_url("edit")?>"> > '+data.menudesc+'</a><ul id="'+data.menucode+'"></ul></li>';
                                console.log("Ya"+ k +" : "+data3[k].menucode)
                                $("#"+data.parent).append(sub);
                              }
                            }
                                sub = '<li><a href="<?php echo base_url("editor")?>"> > '+data.menudesc+'</a><ul id="'+data.menucode+'"></ul></li>';
                                $("#"+data.parent).append(sub);
                          }
                        }
                      };
                    });
                  }
                });
              }
            });
          }
        });
    });
    </script>
    <script type="text/javascript">
      // add and remove class open on sidebar
      function modules(id_li){
        $("li").removeClass("open");
        $("#"+id_li).even().addClass("open");
        // window.location = "<?php echo base_url("tabel")?>";
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
    <!-- Plugins JS start-->
    <!-- <script src="<?php echo base_url("assets/js/typeahead/handlebars.js") ?>"></script> -->
    <!-- <script src="<?php echo base_url("assets/js/typeahead/typeahead.bundle.js") ?>"></script> -->
    <!-- <script src="<?php echo base_url("assets/js/typeahead/typeahead.custom.js") ?>"></script> -->
    <!-- <script src="<?php echo base_url("assets/js/typeahead-search/handlebars.js") ?>"></script> -->
    <!-- <script src="<?php echo base_url("assets/js/typeahead-search/typeahead-custom.js") ?>"></script> -->
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
    <!-- Data Table JS -->
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