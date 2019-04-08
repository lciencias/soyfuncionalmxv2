
<script src="<?=$pathWeb?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$pathWeb?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=$pathWeb?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$pathWeb?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=$pathWeb?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=$pathJs?>bower_components/js/bootstrapValidator.min.js"></script>
<script src="<?=$pathJs?>bower_components/js/sweetalert.min.js"></script>
<script src="<?=$pathWeb?>bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?=$pathWeb?>dist/js/adminlte.min.js"></script>
<script src="<?=$pathJs?>bower_components/js/sweetalert-data.js"></script>
<script src="<?=$pathJs?>bower_components/js/soyfuncional.js"></script>
<script src="<?=$pathJs?>bower_components/js/validaciones.js"></script>
<script src="<?=$pathJs?>bower_components/js/swalert.js"></script>
<script src="<?=$pathWeb?>dist/js/demo.js"></script>
<script>
  $(function () {
    //$('#example1').DataTable()
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
</body>
</html>