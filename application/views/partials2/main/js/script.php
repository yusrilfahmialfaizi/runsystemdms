     <script type="text/javascript">
       $(document).ready(function() {
         var uri          = "<?php echo $this->uri->segment("1"); ?>";
         var modulactive  = "<?php echo $this->session->userdata("modul"); ?>";
         if (uri == "editor" || uri == "edit") {
           $("#sidebar").removeClass("iconbar-second-close");
         } else if (uri == "tabel") {
           $("#sidebar").removeClass("iconbar-second-close");
           $("#sidebar").addClass("iconbar-mainmenu-close");
           $("li").removeClass("open");
           $("#"+modulactive).addClass("open");
         }
         if (uri != "home" && uri != "tabel") {
           var modulCode  = "<?php echo $this->session->userdata("modul"); ?>";
           var doc_status = "<?php echo $this->session->userdata("doc_status"); ?>";
           if (doc_status == "F") {
             document.getElementById('statushdr').checked = true;
           }else if (doc_status == "O"){
             document.getElementById('statushdr').checked = false;
           }else{
             console.log("data null");
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
         var clas = $('#sidebar').attr('class');
         if ( clas == "iconsidebar-menu iconbar-second-close"){
            $("#sidebar").removeClass("iconbar-second-close");
            $("#sidebar").addClass("iconbar-mainmenu-close");
          }
         $.ajax({ //to get all data menu from db
           type: 'POST',
           url: '<?php echo base_url("tabel/modulmenubyid") ?>',
           dataType: 'json',
           data: {
             docno: docno,
             modulCode: modulCode
           },
           cache: false,
           success: function(response) {
             $('#modul-menu-' + modulCode).html(response);
           }
         });
         $.post("<?php echo base_url("tabel/modul_session") ?>", {
           modulCode: modulCode
         });
         if (status != "O") {
           document.getElementById('statushdr').checked = true;
         } else {
           document.getElementById('statushdr').checked = false;
         }
         $.post("<?php echo base_url("tabel/doc_session") ?>", {
           docno: docno,
           active: active,
           status: status
         });
         $("#sub-header-" + modulCode).text(docno.replace("INVESTASI/", "INVESTASI/\n"));
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
       if ("<?php echo $this->uri->segment("1"); ?>" == "edit" || "<?php echo $this->uri->segment("1"); ?>" == "edit") {
         
       }
      //  $('input[type="checkbox"]').click(function() {
        function toggle_checkbox(element){
         if ($(element).prop("checked") == true) {
           // console.log("Checkbox is checked.");
           var checked = "F";
           $.post("<?php echo base_url("tabel/update_statushdr") ?>", {
             checked: checked
           }).done(function() {
            //  location.reload(true)
           });
         } else if ($(element).prop("checked") == false) {
           var checked = "O";
           // console.log("Checkbox is unchecked.");
           $.post("<?php echo base_url("tabel/update_statushdr") ?>", {
             checked: checked
           }).done(function() {
            //  location.reload(true)
           });
         }
        }
      //  });

       function preview(ths) {
         var docno = $(ths).attr("data-docno");
         var modulcode = $(ths).attr("data-modulcode");
         console.log(docno + modulcode);
         window.open('tabel/pdf?docno=' + docno + '&modulcode=' + modulcode + '', '_blank');
       }

       function print(ths) {
         var docno = $(ths).attr("data-docno");
         var modulcode = $(ths).attr("data-modulcode");
         console.log(docno + modulcode);
         window.open('print?docno=' + docno + '&modulcode=' + modulcode + '', '_blank');
       }

       function sidebar_toggle(){
          var segment = "<?php echo $this->uri->segment("1") ?>";
          var clas = $('#sidebar').attr('class');
          if (segment == "tabel") {  
            if ( clas == "iconsidebar-menu iconbar-mainmenu-close"){
              $("#sidebar").removeClass("iconbar-mainmenu-close");
              $("#sidebar").addClass("iconbar-second-close");
            }else if (clas == "iconsidebar-menu iconbar-second-close") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            } else if (clas == "iconsidebar-menu") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            }
          }else if (segment == "edit" || segment == "editor") {
            if ( clas == "iconsidebar-menu iconbar-mainmenu-close"){
              $("#sidebar").removeClass("iconbar-mainmenu-close");
              // $("#sidebar").addClass("iconbar-second-close");
            }else if (clas == "iconsidebar-menu iconbar-second-close") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            } else if (clas == "iconsidebar-menu") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            }
          }
       }
     </script>

     <script type="text/javascript">
       document.querySelector(".btnsweet").addEventListener("click", function() {
         const swalWithBootstrapButtons = Swal.mixin({
           customClass: {
             confirmButton: 'btn btn-success',
             cancelButton: 'btn btn-danger'
           },
           buttonsStyling: true
         })

         swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, add it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
         }).then((result) => {
           if (result.isConfirmed) {
              $.post("<?php echo base_url("tabel/createDocument") ?>"
              ).done(function() { 
                swalWithBootstrapButtons.fire(
                  'Added!',
                  'Your file has been Added.',
                  'success',
                ).then(function(){
                  location.reload(true);
                })
              })
             
           } else if (
             /* Read more about handling dismissals below */
             result.dismiss === Swal.DismissReason.cancel
           ) {
             swalWithBootstrapButtons.fire(
               'Cancelled',
               'Your imaginary file is safe :)',
               'error'
             )
           }
         })
       });
     </script>