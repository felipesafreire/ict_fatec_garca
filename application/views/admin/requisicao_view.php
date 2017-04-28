<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/select2.css');?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/select2-bootstrap.css');?>">
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Requisições</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Adicionar Requisição</button>

                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Título</th>
                                <th style="" class="hidden-xs hidden-sm">Data</th>
                                <th style="" class="hidden-xs hidden-sm">Observação</th>
                                <th style="text-align: center; max-width: 100px;">Ação</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='4'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="panel panel-default" id="panelAdd">

        <div class="panel-heading">
            <h4>Adicionar Requisição</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Título</label>
                        <input type="text" class="form-control" id="txtNome">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Descrição</label>
                        <textarea id="txtObs" class="form-control" rows="6"></textarea>
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


<script>

    $(document).ready(function(){
        
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
                    
           var id           = $("#txtID").val();
           var titulo       = $("#txtNome").val();
           var descricao    = $("#txtObs").val();
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(titulo==""){
               
               $("#txtNome").parent('.form-group').addClass('has-error');
               
           }
           if(descricao==""){
               
               $("#txtObs").parent('.form-group').addClass('has-error');

           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('admin/requisicao/salvar_requisicao');?>',
                {
                   'titulo':titulo,
                   'id':id,
                   'descricao':descricao,
                },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $(".spAviso").addClass('text-primary').html('<br>Salvo com sucesso...').show();
                      limpar_campos();
                      
                  }else{
                      
                      $(".spAviso").addClass('text-danger').html('<br>'+retorno).show();
                      $("#btnSalvar").button('reset');
                      
                  }      
                  
                });
               
           }
            
        });
        
        $('body').on('click','.link-excluir',function(){
        
            var id      = $(this).attr('id');
            var conf = confirm("Deseja realmente excluir ess Requisicao?");
        
            if(conf==true){
                
                $.post('<?=base_url('admin/requisicao/excluir_requisicao');?>',
                {
                    'id':id,   
                },
                function(retorno){

                    if(retorno==true){
                       
                       tabela();
                       
                    }else{
                    
                        alert('Erro... Tente novamente mais Tarde');
                    
                    }

                });
                
            }
        
        });
        
        $('body').on('click','.link-alterar',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            $("#txtIDAU").val(id);
            
            $.post('<?=base_url('admin/requisicao/dados_requisicao');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                 
                    $("#txtNome").val(retorno.titulo);
                    $("#txtObs").val(retorno.descricao);
                 
                    
                },'json');
            
        });
        
        tabela();
        

    });
    
    function tabela(){
        
        $.post('<?=base_url('admin/requisicao/listar_requisicao');?>',
        {},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno);
           
        },'json');
        
    }
    
    
    function limpar_campos(){
        
        $("#txtNome").val('');
        $("#txtObs").val('');
        $("#txtID").val('');
        $("#btnSalvar").button('reset');
        
    }
    
</script>