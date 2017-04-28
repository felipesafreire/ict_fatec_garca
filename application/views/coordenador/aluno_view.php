    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Alunos</h4>
            
        </div>

        <div class="panel-body">

            <h5><i class="fa fa-filter"></i> FILTROS</h5>    
            
            <div class="row">
                
                <div class="col-lg-6 col-md-6">
                    
                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input class="form-control" id="txtCPFFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-lg-6 col-md-6">
                    
                    <div class="form-group">
                        <label class="control-label">Nome do Aluno</label>
                        <input class="form-control" id="txtNomeFiltro" type="text">
                    </div>
                    
                </div>
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-5 col-md-5">
                    
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input class="form-control" id="txtEmailFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-lg-5 col-md-5">
                    
                    <div class="form-group">
                        <label class="control-label">Curso</label>    
                        <select class="form-control"  id="txtCursoFiltro">
                            <option value="">Todos os Cursos</option>
                            <option value="1">ADS</option>
                            <option value="2">Mecâtronica</option>
                            <option value="3">Gestão Empresarial</option>
                        </select>
                    </div>
                    
                </div>
                
                <div class="col-md-2 col-lg-2">
                    
                    <div class="form-group text-center">
                        <button id="btnBuscar" class="btn btn-primary" style="margin-top: 24px;"><i class="fa fa-fw fa-search"></i></button>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Aluno</th>
                                <th class="hidden-xs hidden-sm" style="text-align: center;">Curso</th>
                                <th class="hidden-xs hidden-sm">Orientador</th>
                                <th class="hidden-xs hidden-sm hidden-md">Projeto</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='7'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

<script src="<?=base_url('assets/js/plugins/mask/jquery.maskedinput.js');?>"></script>
<script type="text/javascript">

    $(document).ready(function(){
    
        $("#txtCPFFiltro").mask("999.999.999-99",{placeholder: "_"});
        
        $("#btnBuscar").click(function(){
           
           tabela();
           
        });
        
        tabela();
        
    });
    
    function tabela(page){
        
        $('#tblLista > tbody').html('<tr><td colspan="20">....Aguarde....</td></tr>');
        
        var cpf      = $("#txtCPFFiltro").val();
        var nome    = $("#txtNomeFiltro").val();
        var email   = $.trim($("#txtEmailFiltro").val());
        var curso   = $.trim($("#txtCursoFiltro").val());
        
        var filtro  = new Object();
        
        filtro ={'cpf':cpf,
                 'nome':nome,
                 'email':email,
                 'curso':curso};
        
        $.post('<?=base_url('coordenador/aluno/listar_aluno');?>',
        {'page':page,'filtro':filtro},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
</script>