    <script type="text/javascript">
      $(document).ready(function() {
        var uri = "<?php echo $this->uri->segment("1"); ?>";

        if (uri != "home") { 
          $("#sidebar").removeClass("iconbar-second-close");
        }else if(uri == "table") {
          $("#sidebar").removeClass("iconbar-second-close");
          $("#sidebar").addClass("iconbar-mainmenu-close");
        }

        if (uri != "home" && uri != "tabel") {
          var modulCode = "<?php echo $this->session->userdata("modul"); ?>";
          if ("<?php echo $this->session->userdata("doc_status "); ?>" != "O") {
            document.getElementById('statushdr').checked = true;
          }

          $.ajax({ //to get all data menu from db
            type: 'POST',
            url: '<?php echo base_url("tabel/modulmenubyid") ?>',
            dataType: 'json',
            data: {
              modulCode: modulCode
            },
            cache: false,
            success: function(response) {
              $('#modul-menu-' + modulCode).html(response);
            }
          });
        }
      });
    </script>
    <script type="text/javascript">
      // add and remove class open on sidebar
      function modules(id_li) {
        $("li").removeClass("open");
        $("#" + id_li).even().addClass("open");
        $.post("<?php echo base_url("tabel/modul_session ") ?>", {
          modulCode: id_li
        });
      }

      function modules2(id_li) {
        var modulname = $(id_li).attr("data-name");
        var modulCode = $(id_li).attr("data-modulcode");
        var docno = $(id_li).attr("data-docno");
        var active = $(id_li).attr("data-active");
        var status = $(id_li).attr("data-status");
        $.post("<?php echo base_url("tabel/modul_session") ?>", {
          modulCode: modulCode
        });
        $.ajax({ //to get all data menu from db
          type: 'POST',
          url: '<?php echo base_url("tabel/modulmenubyid") ?>',
          dataType: 'json',
          data: {
            modulCode: modulCode
          },
          cache: false,
          success: function(response) {
            $('#modul-menu-' + modulCode).html(response);
          }
        });
        if (status != "O") {
          document.getElementById('statushdr').checked = true;
        }
        $.post("<?php echo base_url("tabel/doc_session") ?>", {
          docno: docno,
          active: active,
          status: status
        });
        $("#sub-header-" + modulCode).text(docno);
        $("li").removeClass("open");
        document.getElementById(modulCode).className += "open";
        $("#sidebar").removeClass("iconbar-mainmenu-close");
      }

      function modulCode(ths) {
        var modulCode = $(ths).attr("data-modul");
        $.post("<?php echo base_url("tabel/modul_session ") ?>", {
          modulCode: modulCode
        });
        $.ajax({ //to get all data menu from db
          type: 'POST',
          url: '<?php echo base_url("tabel/modulmenubyid") ?>',
          dataType: 'json',
          data: {
            modulCode: modulCode
          },
          cache: false,
          success: function(response) {
            $('#modul-menu-' + modulCode).html(response);
          }
        });
      }

      function menuCode(menuCode) {
        var menuName = $(menuCode).data('name');
        var menuCode = $(menuCode).attr('data-id');

        $.post("<?php echo base_url("tabel/menu_session") ?>", {
          menuCode: menuCode,
          menuName: menuName
        });
      }
      $('input[type="checkbox"]').click(function() {
        if ($(this).prop("checked") == true) {
          // console.log("Checkbox is checked.");
          var checked = "F";
          $.post("<?php echo base_url("tabel/update_statushdr") ?>", {
            checked: checked
          });
        } else if ($(this).prop("checked") == false) {
          var checked = "O";
          // console.log("Checkbox is unchecked.");
          $.post("<?php echo base_url("tabel/update_statushdr") ?>", {
            checked: checked
          });
        }
      });

      function preview(ths) {
        var docno = $(ths).attr("data-docno");
        var modulcode = $(ths).attr("data-modulcode");
        console.log(docno + modulcode);
        window.open('tabel/pdf?docno=' + docno + '&modulcode=' + modulcode + '', '_blank');
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
    <!-- <script src="<?php //echo base_url("assets/js/sidebar-menu.js") 
                      ?>"></script> -->
    <script src="<?php echo base_url("assets/js/config.js") ?>"></script>
    <!-- Plugins JS start-->
    <!-- <script src="<?php //echo base_url("assets/js/typeahead/handlebars.js") 
                      ?>"></script> -->
    <!-- <script src="<?php //echo base_url("assets/js/typeahead/typeahead.bundle.js") 
                      ?>"></script> -->
    <!-- <script src="<?php //echo base_url("assets/js/typeahead/typeahead.custom.js") 
                      ?>"></script> -->
    <!-- <script src="<?php //echo base_url("assets/js/typeahead-search/handlebars.js") 
                      ?>"></script> -->
    <!-- <script src="<?php //echo base_url("assets/js/typeahead-search/typeahead-custom.js") 
                      ?>"></script> -->
    <!-- <script src="<?php //echo base_url("assets/js/chart/chartist/chartist.js") 
                      ?>"></script>
    <!-- <script src="<?php //echo base_url("assets/js/chart/chartist/chartist-plugin-tooltip.js") 
                      ?>"></script> -->
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
    <!-- Plugins JS start-->
    <script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/jszip.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatable/datatable-extension/custom.js"></script>
    <script src="<?php echo base_url("assets/js/sweet-alert/sweetalert.min.js") ?>"></script>
    <!-- <script src="<?php //echo base_url("assets/js/sweet-alert/app.js") 
                      ?>"></script> -->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo base_url("assets/js/script.js") ?>"></script>