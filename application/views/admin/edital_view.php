
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Editais</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Adiocionar Edital</button>

                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th style="max-width:40px; text-align: center;">Nroº Edital</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Data Inicial</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Data Final</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Semestre</th>
                                <th style="text-align: center; max-width: 100px;">Ação</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='5'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="panel panel-default" id="panelAdd">

        <div class="panel-heading">
            <h4>Adicionar Edital</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Data Inicial da Inscrição</label>
                        <input type="text" class="form-control" id="txtInicial">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Data Final da Inscrição</label>
                        <input type="text" class="form-control" id="txtFinal">
                    </div>

                </div>

            </div>
                
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Semestre</label>
                        <select class="form-control" id="cmbSemestre">
                            <option value="1">Primeiro Semestre</option>
                            <option value="2">Segundo Semestre</option>
                        </select>
                    </div>

                </div>

            </div>
            
            <div class="row">
 
                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Link Edital</label>
                        <input type="text" class="form-control" id="txtLink">
                    </div>

                </div>

            </div>
            
        </div>

        <div class="panel-footer">
            
            <button class="btn  btn-primary" id="btnSalvar" data-loading-text="Aguarde...">Salvar</button>
            <button class="btn  btn-default" id="btnVoltar">Voltar</button>
            <input type="hidden" id="txtID" value="">
            <div class="spAviso"></div>
            
        </div>
        
    </div>

<script src="<?=base_url('assets/js/plugins/mask/jquery.maskedinput.js');?>"></script>   
<script>

    $(document).ready(function(){
        
        $("#txtInicial").mask("99/99/9999");
        $("#txtFinal").mask("99/99/9999");
        
        $("#panelList").show();
        $("#panelAdd").hide();
        
        $("#btnAdicionar").click(function(){
           
           $("#panelList").hide();
           $("#panelAdd").show();
           limpar_campos();
           
        });
        
        $("#btnVoltar").click(function(){
           
           $("#panelList").show();
           $("#panelAdd").hide();
           tabela();
           
        });
        
        $("#btnSalvar").click(function(){
           
           var id       = $("#txtID").val();
           var inicial  = $("#txtInicial").val();
           var final    = $("#txtFinal").val();
           var semestre = $("#cmbSemestre").val();
           var link     = $("#txtLink").val();
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(inicial==""){
               
               $("#txtInicial").parent('.form-group').addClass('has-error');
               
           }
           if(final==""){
               
               $("#txtFinal").parent('.form-group').addClass('has-error');
               
           }
           if(link==""){
               
               $("#txtLink").parent('.form-group').addClass('has-error');
               
           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('admin/edital/salvar_edital');?>',
               {
                   'id':id,
                   'inicial':inicial,
                   'final':final,
                   'semestre':semestre,
                   'link':link,
                   
               },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $(".spAviso").addClass('text-primary').html('<br>Salvo com sucesso...').show();
                      limpar_campos();
                      
                  }else{
                      
                      $(".spAviso").addClass('text-danger').html('<br>Erro ao efetuar o registro...').show();
                      $("#btnSalvar").button('reset');
                      alert(retorno);
                  }      
                  
                });
               
           }
            
        });
        
        $('body').on('click','.link-alterar',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            
            $.post('<?=base_url('admin/edital/dados_edital');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                 
                    $("#txtInicial").val(retorno.inicial);
                    $("#txtFinal").val(retorno.final);
                    $("#cmbSemestre").val(retorno.semestre);
                    $("#txtLink").val(retorno.edital);
                  
                },'json');
            
        });
        
        tabela();
        

    });
 
    function tabela(){
        
        $.post('<?=base_url('admin/edital/listar_edital');?>',
        {},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno);
           
        },'json');
        
    }
    function limpar_campos(){
        
        $("#txtInicial").val('');
        $("#txtFinal").val('');
        $("#cmbSemestre").val(1);
        $("#txtLink").val('');
        $("#txtID").val('');
        $("#btnSalvar").button('reset');
        
    }
    
</script>
