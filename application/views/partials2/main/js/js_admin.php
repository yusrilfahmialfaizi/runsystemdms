    <script type="text/javascript">
      $(document).ready(function() {
        var uri = "<?php echo $this->uri->segment("1"); ?>";

        if (uri != "home" && uri != "edit" && uri != "editor") {
          $("#sidebar").removeClass("iconbar-second-close");
          $("#sidebar").addClass("iconbar-mainmenu-close");
        }
        // get data dynamic sidebar menu 
        var url1 = 'http://127.0.0.1:8080/runsystemdms/getModuls';
        var url2 = 'http://127.0.0.1:8080/runsystemdms/getDynamicMenuParts';
        var modul = [];
        var menu = '';
        var menus = 'menu';
        var sub = '';
        var subs = '';

        $.ajax({ //to get all data menu from db
          type: 'GET',
          url: url1,
          dataType: 'json',
          cache: false,
          success: function(data1) {
            data1 = JSON.parse(JSON.stringify(data1));
            data1 = data1.menu[0].modulmenu;
            $.ajax({ // to get length of parent
              type: 'GET',
              url: url2,
              dataType: 'json',
              cache: false,
              success: function(data2) {
                data2 = JSON.parse(JSON.stringify(data2));
                data2 = data2.parts[0];
                $.each(data1, function(i, data){
                var u = 2;
                  if (data.parent.length == 0) { 
                    sub = '<li><a onClick="menuCode(this)" data-id="'+data.menucode+'"  href="<?php echo base_url("edit") ?>"> > ' + data.menudesc + ' ('+ data.status + ')</a><ul id="' + data.menucode + '"></ul></li>';
                    $("#" + data.modulcode).append(sub);
                  }
                  for (var j = 0; j < data2.parentlength.length; j++) {
                    if (data.parent.length == (u = u + 2)) {
                      for (k = 0; k < data2.lastChilds.length; k++) {
                        if (data.menucode == data2.lastChilds[k].menucode) {
                          // console.log(data.menucode+ "=="+ data2.lastChilds[k].menucode);
                          // subs = '<li><a href="<?php echo base_url("editor") ?>"> > ' + data2.lastChilds[k].menucode + '</a><ul id="' + data2.lastChilds[k].menucode + '"></ul></li>';
                          // $("#" + data.parent).append(sub);
                        }else{
                        }
                      }
                        subs = '<li><a onClick="menuCode(this)" data-id="'+data.menucode+'" href="<?php echo base_url("edit")?>"> > '+data.menudesc+'</a><ul id="'+data.menucode+'"></ul></li>';
                        $("#"+data.parent).append(subs);
                    }
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
      function modules(id_li) {
        $("li").removeClass("open");
        $("#" + id_li).even().addClass("open");
      }
      function modules2(id_li) {
        var modulname = $(id_li).attr("data-id");
        var modulcode = $(id_li).attr("data-modulcode");
        var docno = $(id_li).attr("data-docno");
        var active = $(id_li).attr("data-active");
        var status = $(id_li).attr("data-status");
        if (status != "O") {
          document.getElementById('statushdr').checked = true;
        }
        $.post( "<?php echo base_url("tabel/doc_session")?>", { docno: docno, active:active} );
        $("#sub-header-"+ modulcode ).text(docno);
        $("li").removeClass("open");
        document.getElementById(modulname).className += "open";
        $("#sidebar").removeClass("iconbar-mainmenu-close");
      }
      function modulCode(modulCode) {
        var modulCode = modulCode;
        $.post( "<?php echo base_url("tabel/modul_session")?>", { modulCode: modulCode} );
      }
      function menuCode(menuCode) {
        var menuCode = $(menuCode).attr('data-id');
        console.log(menuCode);
        $.post( "<?php echo base_url("tabel/menu_session")?>", { menuCode: menuCode} );
      }
      $('input[type="checkbox"]').click(function(){
          if($(this).prop("checked") == true){
              // console.log("Checkbox is checked.");
              var checked = "F";
              $.post( "<?php echo base_url("tabel/update_statushdr")?>", { checked: checked} );
          }
          else if($(this).prop("checked") == false){
              var checked = "O";
              // console.log("Checkbox is unchecked.");
              $.post( "<?php echo base_url("tabel/update_statushdr")?>", { checked: checked} );
          }
      });
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
    <script src="<?php echo base_url("assets/js/sweet-alert/sweetalert.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/sweet-alert/app.js") ?>"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo base_url("assets/js/script.js") ?>"></script>