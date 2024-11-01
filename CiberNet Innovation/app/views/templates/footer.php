</div>

<!-- /.content-wrapper -->

<!--FOOTER-->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2025 <a href="https://adminlte.io">Garrobos DEV</a>.</strong> All rights
    reserved.
</footer>

<!-- jQuery 3 -->
<script src="../../../public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../../public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../../public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../public/dist/js/demo.js"></script>

<!-- Incluir JS de DataTables y Buttons -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#exportTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'Exportar a CSV',
                    titleAttr: 'Exportar a CSV',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#genericTable').DataTable(); // Inicializar DataTables
    });
</script>

<script>
    $(document).ready(function() {
        $('.sidebar-menu').tree()
    })
</script>
</body>

</html>