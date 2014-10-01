<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- jQuery Validate 1.13.0 -->
<script src="/js/jquery.validate-1.13.0.min.js" type="text/javascript"></script>
<!--validação-->
<script src="/js/AdminLTE/validacao.js" type="text/javascript"></script>
<!-- CK Editor -->
<script src="/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<!-- Bootstrap -->
<script src="/js/bootstrap.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="/js/AdminLTE/app.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>-->


<!-- AdminLTE for demo purposes -->
<!--<script src="js/AdminLTE/demo.js" type="text/javascript"></script>-->

<!-- DATA TABES SCRIPT -->
<script src="/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#grid1').dataTable({
            "iDisplayLength": 5,
            "aLengthMenu": [5, 10, 25, 50, 100 ],
            "oLanguage": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }

            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>