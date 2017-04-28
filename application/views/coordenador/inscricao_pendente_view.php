
    <div class="panel panel-default" id="panelList">

        <div class="panel-body">
                
            <div class="row">
  
                <div class="col-lg-12 col-md-12 paginacao">    
                            
                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Aluno</th>
                                <th class="hidden-xs hidden-sm">Orientador</th>
                                <th class="hidden-xs hidden-sm hidden-md">Projeto</th>
                                <th style="text-align: center; max-width: 100px;">
                                
                                    Ação
                                
                                </th>
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

<script type="text/javascript">

    $(document).ready(function(){
        
        tabela();
        
        $('body').on('click','.link-inscricao',function(){
        
            var id = $(this).attr('id');
			
            $.post('<?=base_url('coordenador/dashboard/aceitar_inscricao');?>',
            {'id':id},
            function(retorno){
                
            if(retorno==true){
                tabela();
            }else{
                alert('Erro ao aceitar inscrição.');
            }

            });
	
        });
        
        $('body').on('click','.link-rejeitar',function(){
        
            var id = $(this).attr('id');
			
            var click = confirm('Deseja realmente Excluir');
            
            if(click==true){
            
                $.post('<?=base_url('coordenador/dashboard/recusar_inscricao');?>',
                {'id':id},
                function(retorno){

                if(retorno==true){
                    tabela();
                }else{
                    alert('Erro ao excluir inscrição.');
                }

            });
            
            }
	
        });
        
    });
        
    function tabela(page){
        
        $.post('<?=base_url('coordenador/dashboard/listar_inscricao');?>',
        {'page':page},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
   
    
</script>