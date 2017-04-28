<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url('assets/img/icone.png');?>">
    <title>Sistema de ICT</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/one/css/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/font-awesome.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/simple-line-icons.css');?>"  />
    <!-- Custom styles for this template -->
    <link href="<?=base_url('assets/one/css/owl.carousel.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/owl.theme.default.min.css');?>"  rel="stylesheet">
    <link href="<?=base_url('assets/one/css/animate.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/style.css');?>" rel="stylesheet">
</head>
	<body id="page-top">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
                                    <a class="navbar-brand page-scroll" href="#consulta"><img style="width: 180px; height: 60px; margin-top: 3px;" class="img-responsive" src="<?=base_url('assets/img/logo.png');?>" alt="Sistema do ICT"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden">
							<a href="#documento"></a>
						</li>
						
						<li>
							<a class="page-scroll" href="#documento">Documentos</a>
						</li>
                                                <li>
							<a class="page-scroll" href="#incricao">Inscrição</a>
						</li>
                                                <li>
							<a class="page-scroll" href="#contato">Contato</a>
						</li>
                                                <li>
							<a href="<?=base_url('coordenador/dashboard/login');?>">Coordenador</a>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		<!-- Header -->
		<header>
			<div class="container-fluid">
				<div class="slider-container">

				</div>
			</div>
		</header>

		

		<section id="documento" class=" light-bg">
                    
                    <div class="container">
                            
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <div class="section-title">
                                    <h2 style="color: black;">Documentos</h2>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                
                                <h3 class="text-center" style="cursor: pointer;" id="regulamentacao"><Strong>Regulamentação</Strong></h3>
                                
                            </div>
                            
                            <div class="col-md-6">
                                
                                <h3 class="text-center" style="cursor: pointer;" id="documentonecessario"><Strong>Documentos Necessários</Strong></h3>
                                
                            </div>
                            
                        </div>
                        	
                    </div>
                    
		</section>
                
                <section id="incricao" class="white-bg">
                    
                    <div class="container inscricao">
                        
                               
                                
                    </div>
        	<!-- /.container -->
		</section>

		<section id="contato" class="dark-bg">
                    
                    <div class="container">
                        
                        <div class="row"
                             
                            <div class="col-md-12 text-center">
                                
                                <div class="section-title text-center">

                                        <h2>Contato - ICT</h2>

                                </div>
                                
                            </div>
                        
                            <div class="row">

                                <div class="col-md-12">
                                    
                                         <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" placeholder="Digite seu E-mail" id="txtEmail">
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" placeholder="Digite seu Nome" id="txtNome">
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" placeholder="Digite o Assunto" id="txtAssunto">
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="row">
                                                
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    <textarea rows="6" class="form-control" placeholder="Digite uma Mensagem" id="txtMensagem"></textarea>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <button id="btnContato" data-loading-text="Aguarde..." class="btn btn-primary btn-lg" style="margin-right: 5px;">Enviar</button>
                                                <button id="btnLimpar" class="btn btn-danger btn-lg">Limpar</button><br><br>
                                                <div id="spAviso"></div>
                                            </div>
                                            
                                        </div>
                                        
                                </div>

                            </div>
                             
                    </div>
                        
		</section>
		
<footer>
        <div class="container text-center">
                <p>2016 - Sistema ICT</p>
        </div>
</footer>
                
    <div class="modal fade" tabindex="-1" role="dialog" id="modalregulamentacao">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
              
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Regulamentação</h4>

                </div>
              
                <div class="modal-body">

                    <div class="list-group">

                        <li  class="list-group-item"><i class="fa fa-file-pdf-o"></i><a href="http://www.fatecgarca.edu.br/download/ict/regulamento_ict116.pdf" target="_blank"> Regulamento ICT</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-pdf-o"></i><a href="<?=$edital;?>" target="_blank"> Edital</a></li>
                        
                    </div>
                   
                    <div class="text-right">
                    
                        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin: 0 10px 10px 0">Fechar</button>
                    
                    </div>
                    
                </div>
              
            </div><!-- /.modal-content -->
          
        </div><!-- /.modal-dialog -->
        
    </div><!-- /.modal --> 
    
    <div class="modal fade" tabindex="-1" role="dialog" id="modaldocumento">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
              
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Documentos Necessários</h4>

                </div>
              
                <div class="modal-body">

                    <div class="list-group">

                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="http://www.fatecgarca.edu.br/download/ict/vinc_alu.docx" target="_blank"> Vínculo de Orientação - Aluno </a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="http://www.fatecgarca.edu.br/download/ict/vinc_sec.docx" target="_blank"> Vínculo de Orientação - Secretaria  </a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="http://www.fatecgarca.edu.br/download/ict/vinc_coord.docx" target="_blank"> Vínculo de Orientação - Coordenador </a></li>
                        
                    </div>
                   
                    <div class="text-right">
                    
                        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin: 0 10px 10px 0">Fechar</button>
                    
                    </div>
                    
                </div>
              
            </div><!-- /.modal-content -->
          
        </div><!-- /.modal-dialog -->
        
    </div><!-- /.modal --> 
    

<script src="<?=base_url('assets/one/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/jquery.easing.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/bootstrap.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/owl.carousel.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/cbpAnimatedHeader.js');?>"></script>
<script src="<?=base_url('assets/one/js/jquery.appear.js');?>"></script>
<script src="<?=base_url('assets/one/js/SmoothScroll.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/theme-scripts.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/mask/jquery.maskedinput.js');?>"></script>

</body>
</html>
<script>

    $(document).ready(function(){
        
        inscricao();
        
        $('body').on("click","#btnCadastro",function(){
           
           $("#spAvisoCadastro").hide();
           
           $(".has-error").removeClass("has-error");
           
           /* Orientando */
           
           var nome_orientando  = $("#txtNomeOrientando").val();
           var cpf_orientando   = $("#txtCPFOrientando").val();
           var email_orientando = $("#txtEmailOrientando").val();
           var lattes_orientando = $("#txtLattesOrientando").val();
           var curso_orientando = $("#cmbCurso").val();
           var periodo_orientando = $("#cmbCursoPeriodo").val();
           var termo_orientando = $("#cmbTermo").val();
           
           /* Orientador */
           
           var nome_orientador = $("#txtNomeOrientador").val();
           var cpf_orientador  = $("#txtCPFOrientador").val();
           var email_orientador  = $("#txtEmailOrientador").val();
           var lattes_orientador  = $("#txtLattesOrientador").val();
           var titulacao_orientador  = $("#cmbTitulacaoOrientador").val();
           var ies_orientador  = $("#txtIESOrientador").val();
           
           /* Coorientador */
           
           var nome_coorientador = $("#txtNomeCoorientador").val();
           var cpf_coorientador = $("#txtCPFCoorientador").val();
           var email_coorientador = $("#txtEmailCoorientador").val();
           var lattes_coorientador = $("#txtLattesCoorientador").val();
           var titulacao_coorientador = $("#cmbTitulacaoCoorientador").val();
           var ies_coorientador = $("#txtIESCoorientador").val();
           
           /* Projeto */
           
           var local = $("#txtLocal").val();
           var periodo_realizacao = $("#cmbPeriodoRealizacao").val();
           var dia_realizacao = $("#cmbDiaRealizacao").val();
           var hora_realizacao = $("#txtHora").val();
           var orgao_realizacao = $("#txtOrgao").val();
           var titulo_projeto = $("#txtTitulo").val();
           var resumo_projeto = $("#txtResumo").val();
           
            /* Orientando */
           
            if(nome_orientando==""){
                $("#txtNomeOrientando").parent('div').addClass('has-error');
            }
            if(cpf_orientando==""){
                $("#txtCPFOrientando").parent('div').addClass('has-error');
            }
            if(email_orientando==""){
                $("#txtEmailOrientando").parent('div').addClass('has-error');
            }
            if(lattes_orientando==""){
                $("#txtLattesOrientando").parent('div').addClass('has-error');
            }
            
            /* Orientador */
            
            if(nome_orientador==""){
                $("#txtNomeOrientador").parent('div').addClass('has-error');
            }
            if(cpf_orientador==""){
                $("#txtCPFOrientador").parent('div').addClass('has-error');
            }
            if(email_orientador==""){
                $("#txtEmailOrientador").parent('div').addClass('has-error');
            }
            if(lattes_orientador==""){
                $("#txtLattesOrientador").parent('div').addClass('has-error');
            }
            if(ies_orientador==""){
                $("#txtIESOrientador").parent('div').addClass('has-error');
            }
            
            /* Projeto */
            
            if(local==""){
                $("#txtLocal").parent('div').addClass('has-error');
            }
            if(hora_realizacao==""){
                $("#txtHora").parent('div').addClass('has-error');
            }
            if(orgao_realizacao==""){
                $("#txtOrgao").parent('div').addClass('has-error');
            }
            if(titulo_projeto==""){
                $("#txtTitulo").parent('div').addClass('has-error');
            }
            if(resumo_projeto==""){
                $("#txtResumo").parent('div').addClass('has-error');
            }
            
            if($(".has-error").length > 0){
              
               $("#spAvisoCadastro").css({"color":"red","font-weight":"bold"}).html("<br>Verique os campos que estão em branco...").show();
              
            }else{
              
               //$("#btnCadastro").button('loading');
              
                var inscricao = {'nome_orientando':nome_orientando,
                                 'cpf_orientando':cpf_orientando,
                                 'email_orientando':email_orientando,
                                 'lattes_orientando':lattes_orientando,
                                 'curso_orientando':curso_orientando,
                                 'periodo_orientando':periodo_orientando,
                                 'termo_orientando':termo_orientando,
                                 'nome_orientador':nome_orientador,
                                 'cpf_orientador':cpf_orientador,
                                 'email_orientador':email_orientador,
                                 'lattes_orientador':lattes_orientador,
                                 'titulacao_orientador':titulacao_orientador,
                                 'ies_orientador':ies_orientador,
                                 'nome_coorientador':nome_coorientador,
                                 'cpf_coorientador':cpf_coorientador,
                                 'email_coorientador':email_coorientador,
                                 'lattes_coorientador':lattes_coorientador,
                                 'titulacao_coorientador':titulacao_coorientador,
                                 'ies_coorientador':ies_coorientador,
                                 'local':local,
                                 'periodo_realizacao':periodo_realizacao,
                                 'dia_realizacao':dia_realizacao,
                                 'hora_realizacao':hora_realizacao,
                                 'orgao_realizacao':orgao_realizacao,
                                 'titulo_projeto':titulo_projeto,
                                 'resumo_projeto':resumo_projeto};
              
                $.post('<?=base_url('home/inscricao');?>',
                {'inscricao':inscricao},
                function(retorno){

                    $("#btnCadastro").button('reset');

                    if(retorno==true){
                        
                        $("#btnCadastro").button('reset');
                        
                        alert("Cadastrado com sucesso!");
                        window.location = '<?=base_url();?>';
                        
                    }else{
                        $("#spAvisoCadastro").css({"color":"red","font-weight":"bold"}).html("<br>"+retorno).show();
                        
                    }

                });
               
            }
           
        });
        
        $("#regulamentacao").click(function(){
           
           $('#modalregulamentacao').modal('show');
           
        });
       
        $("#documentonecessario").click(function(){
           
           $('#modaldocumento').modal('show');
           
        });
       
       
       $("#btnContato").click(function(){
          
          $(".has-error").removeClass("has-error");
          $("#spAviso").hide();
          
          var nome     = $("#txtNome").val();
          var email    = $.trim($("#txtEmail").val());
          var assunto  = $("#txtAssunto").val();
          var mensagem = $("#txtMensagem").val();
          
          if(nome==""){
              
              $("#txtNome").parent('.form-group').addClass('has-error');
              
          }
          if(email==""){
              
              $("#txtEmail").parent('.form-group').addClass('has-error');
              
          }
          if(assunto==""){
              
              $("#txtAssunto").parent('.form-group').addClass('has-error');
              
          }
          if(mensagem==""){
              
              $("#txtMensagem").parent('.form-group').addClass('has-error');
              
          }
          if($(".has-error").length > 0){
              
               $("#spAviso").css({"color":"white","font-weight":"bold"}).text("Verique os campos que estão em branco...").show();
              
          }else{
              
                $("#btnContato").button('loading');
               
                var dados = {'nome':nome,
                             'email':email,
                             'assunto':assunto,
                             'mensagem':mensagem};
               
                $.post('<?=base_url('home/enviar_email');?>',
                {'dados':dados},
                function(retorno){

                    if(retorno==true){
                        
                        $("#spAviso").css({"color":"white","font-weight":"bold"}).text("E-mail enviado com sucesso").show();
                        limpar_dados_form();
                        $("#btnContato").button('reset');
                        
                    }else{
                        
                        $("#spAviso").css({"color":"white","font-weight":"bold"}).text(retorno).show();
                        $("#btnContato").button('reset');
                    }

                });
              
          }
          
       });
       
        $("#btnLimpar").click(function(){
       
            limpar_dados_form();
       
        });
       
    });
    
    function limpar_dados_form(){
    
        $("#txtEmail").val('');
        $("#txtNome").val('');
        $("#txtAssunto").val('');
        $("#txtMensagem").val('');
        
    }
    
    function inscricao(){
        
        $.post('<?=base_url('home/verifica_inscricao');?>',
        {},
        function(retorno){
           
            $(".inscricao").html(retorno);
            
        });
        
    }
    
</script>
