<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url("assets_admin/assets/jquery/jquery.min.js") ?>"></script>
<script src="<?php echo base_url("assets_admin/assets/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url("assets_admin/assets/jquery-easing/jquery.easing.min.js") ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url("assets_admin/js/sb-admin-2.min.js") ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url("assets_admin/assets/chart.js/Chart.min.js") ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url("assets_admin/js/demo/chart-area-demo.js") ?>"></script>
<script src="<?php echo base_url("assets_admin/js/demo/chart-pie-demo.js") ?>"></script>
<!-- Page level plugins -->
<script src="<?php echo base_url("assets_admin/assets/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo base_url("assets_admin/assets/datatables/dataTables.bootstrap4.min.js") ?>"></script>
<!-- Page level custom scripts -->
<script src="<?php echo base_url("assets_admin/js/demo/datatables-demo.js") ?>"></script>
<!-- Customizer -->
<script src="<?php echo base_url("assets_admin/js/sb-customizer.js") ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
     $("#add_projectcode").on('change', function(){
          var projectcode = $("#add_projectcode").val();
          console.log(projectcode);
          $.ajax({
               type      : "POST",
               url       : "<?php echo base_url("admin/menu/getModuleWithPc") ?>",
               dataType  : "json",
               data      : {projectcode:projectcode},
               cache     : false,
               success   : function(data){
                    document.getElementById("modulcode").disabled = false;
                    var html = '';
                    html += "<option value=''>--Pilih--</option>";
                    for (let index = 0; index < data.length; index++) {
                         html += "<option value='"+data[index].modulcode+"'>"+data[index].modulcode+' - '+data[index].modulname+"</option>";
                    }
                    $("#modulcode").html(html);                        
               }
          })
     });
});
</script>