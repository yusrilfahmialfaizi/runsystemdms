     <script type="text/javascript">
       $(document).ready(function() {
         var uri = "<?php echo $this->uri->segment("1"); ?>";
         var uri2 = "<?php echo $this->uri->segment("2"); ?>";
         var modulactive = "<?php echo $this->session->userdata("modul"); ?>";
         var docno = "<?php echo $this->session->userdata('docno') ?>";
         if (uri == "admin"){
           $("li").removeClass("open");
           $("#" + uri2).addClass("open");
         }
         if (uri == "editor" || uri == "edit") {
           $("#sidebar").removeClass("iconbar-second-close");
         } else if (uri == "tabel") {
           $("#sidebar").removeClass("iconbar-second-close");
           $("#sidebar").addClass("iconbar-mainmenu-close");
           $("li").removeClass("open");
           $("#" + modulactive).addClass("open");
         }
         
         if (uri != "home" && uri != "tabel" && uri != "admin") {
           var modulCode = "<?php echo $this->session->userdata("modul"); ?>";
           var doc_status = "<?php echo $this->session->userdata("doc_status"); ?>";
           if (doc_status == "F") {
             document.getElementById('statushdr').disabled = true;
             document.getElementById('statushdr').checked = true;
           } else if (doc_status == "O") {
             document.getElementById('statushdr').disabled = false;
             document.getElementById('statushdr').checked = false;
           } else {
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
           $.ajax({ //to get all data menu from db
           type: 'POST',
           url: '<?php echo base_url("tabel/doc_status") ?>',
           dataType: 'json',
           data: {
             docno: docno
           },
           cache: false,
           success: function(response) {
             if (response.message == false) {
              document.getElementById('statushdr').disabled = true;
             }else{
              document.getElementById('statushdr').disabled = false;
              if (document.getElementById('statushdr').checked == true) {
                document.getElementById('statushdr').disabled = true;
              }
             }
           }
         });
         }
       });
     </script>
     <script type="text/javascript">
       // add and remove class open on sidebar
       function modules(id_li) {
         if ("<?php echo $this->uri->segment("1"); ?>" == "edit" || "<?php echo $this->uri->segment("1"); ?>" == "editor") {
          if ("<?php echo $this->session->userdata("modul"); ?>" == id_li) {
            $("li").removeClass("open");
            $("#" + id_li).even().addClass("open");  
          }else{
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Yes, change it!',
              reverseButtons: true
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = "<?php echo base_url("tabel?modulcode=") ?>"+id_li;
              }
            })
          }
         }
       }

       function modules2(id_li) {
         var modulname = $(id_li).attr("data-name");
         var modulCode = $(id_li).attr("data-modulcode");
         var docno = $(id_li).attr("data-docno");
         var active = $(id_li).attr("data-active");
         var status = $(id_li).attr("data-status");
         var clas = $('#sidebar').attr('class');
         if (clas == "iconsidebar-menu iconbar-second-close") {
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
         $.ajax({ //to get all data menu from db
           type: 'POST',
           url: '<?php echo base_url("tabel/doc_status") ?>',
           dataType: 'json',
           data: {
             docno: docno
           },
           cache: false,
           success: function(response) {
             if (response.message == false) {
              document.getElementById('statushdr').disabled = true;
             }else{
              document.getElementById('statushdr').disabled = false;
              if (document.getElementById('statushdr').checked == true) {
                document.getElementById('statushdr').disabled = true;
              }
             }
           }
         });
         if (status == "F") {
           document.getElementById('statushdr').disabled = true;
           document.getElementById('statushdr').checked = true;
         } else if (status == "O") {
           document.getElementById('statushdr').disabled = false;
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
         var url      = $(menuCode).data('url');
         var menuCode = $(menuCode).data('id');
         var uri      = "<?php echo $this->uri->segment("1"); ?>";

         const swalWithBootstrapButtons = Swal.mixin({
           customClass: {
             confirmButton: 'btn btn-success',
             cancelButton: 'btn btn-danger'
           },
           buttonsStyling: true
         });

         $.post("<?php echo base_url("tabel/menu_session") ?>", {
           menuCode: menuCode,
           menuName: menuName
         });

         if (uri == "tabel") {
           if (url == "edit") {
              window.location.href = "<?php echo base_url("edit") ?>";
           }else if (url == "editor") {
             window.location.href = "<?php echo base_url("editor") ?>";
           }
         }else if (uri == "edit" || uri == "editor") {
           if (url == "edit") {
             swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, move it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo base_url("edit") ?>";
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
              });
           }else if (url == "editor") {
            
             swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, move it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                   window.location.href = "<?php echo base_url("editor") ?>";
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
              });
           }
         }
       }
      //  if ("<?php echo $this->uri->segment("1"); ?>" == "edit" || "<?php echo $this->uri->segment("1"); ?>" == "edit") {

      //  }
       //  $('input[type="checkbox"]').click(function() {
       function toggle_checkbox(element) {
         if ($(element).prop("checked") == true) {
           // console.log("Checkbox is checked.");
           var checked = "F";
           $.post("<?php echo base_url("tabel/update_statushdr") ?>", {
             checked: checked
           }).done(function() {
             location.reload(true)
           });
         } else if ($(element).prop("checked") == false) {
           var checked = "O";
           // console.log("Checkbox is unchecked.");
           $.post("<?php echo base_url("tabel/update_statushdr") ?>", {
             checked: checked
           }).done(function() {
             location.reload(true)
           });
         }
       }
       //  });

       function preview(ths) {
         var docno = $(ths).attr("data-docno");
         var modulcode = $(ths).attr("data-modulcode");
         console.log(docno + modulcode);
         window.open('tabel/fpdf_output?docno=' + docno + '&modulcode=' + modulcode + '', '_blank');
       }

       function print(ths) {
         var docno = $(ths).attr("data-docno");
         var modulcode = $(ths).attr("data-modulcode");
         console.log(docno + modulcode);
         window.open('print?docno=' + docno + '&modulcode=' + modulcode + '', '_blank');
       }

       function sidebar_toggle() {
         var segment  = "<?php echo $this->uri->segment("1") ?>";
         var segment2 = "<?php echo $this->uri->segment("2") ?>";
         var clas     = $('#sidebar').attr('class');
         var clas2     = $('#side').attr('class');
         if (segment != "admin") {  
          if (segment == "tabel") {
            if (clas == "iconsidebar-menu iconbar-mainmenu-close") {
              $("#sidebar").removeClass("iconbar-mainmenu-close");
              $("#sidebar").addClass("iconbar-second-close");
            } else if (clas == "iconsidebar-menu iconbar-second-close") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            } else if (clas == "iconsidebar-menu") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            }
          } else if (segment == "edit" || segment == "editor") {
            if (clas == "iconsidebar-menu iconbar-mainmenu-close") {
              $("#sidebar").removeClass("iconbar-mainmenu-close");
              // $("#sidebar").addClass("iconbar-second-close");
            } else if (clas == "iconsidebar-menu iconbar-second-close") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            } else if (clas == "iconsidebar-menu") {
              $("#sidebar").removeClass("iconbar-second-close");
              $("#sidebar").addClass("iconbar-mainmenu-close");
            }
          }
         }else{
          if (clas2 == "iconsidebar-menu iconbar-mainmenu-close") {
              $("#side").removeClass("iconbar-mainmenu-close");
              $("#side").addClass("iconbar-second-close");
          } else if (clas2 == "iconsidebar-menu iconbar-second-close") {
              $("#side").removeClass("iconbar-second-close");
              $("#side").addClass("iconbar-mainmenu-close");
          } else if (clas2 == "iconsidebar-menu") {
              $("#side").removeClass("iconbar-second-close");
              $("#side").addClass("iconbar-mainmenu-close");
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
             swalWithBootstrapButtons.fire({
               title: 'Loading..!',
               text: 'Process..',
               allowOutsideClick: false,
               allowEscapeKey: false,
               allowEnterKey: false,
               onOpen: () => {
                 swal.showLoading()
               }
             })
             $.post("<?php echo base_url("tabel/createDocument") ?>")
               .done(function() {
                 swalWithBootstrapButtons.fire(
                   'Added!',
                   'Your file has been Added.',
                   'success',
                 ).then(function() {
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

     <script>
       $(document).ready(function() {
         $('[data-toggle="tooltip"]').tooltip();
       });
     </script>

     <!-- <script>
      var coll = document.getElementsByClassName("collapsible");
      var i;

      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight){
            content.style.maxHeight = null;
          } else {
            content.style.maxHeight = content.scrollHeight + "px";
          } 
        });
      }
    </script> -->

