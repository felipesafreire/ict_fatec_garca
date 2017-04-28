<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requisicao extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('admin/Requisicao_model', 'requisicao');
        
    }
    
    public function index(){

        if($this->session->userdata('id_admin')){
        
            $data['nome'] = $this->session->userdata('nome_admin');
            $data['page'] = 'requisicao';
            $this->load->view('admin/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function salvar_requisicao(){
        
        $id    = $this->input->post('id');
        $id    = $this->encrypt->decode($id);
        
        $dados = array('descricao'  =>  $this->input->post('descricao'),
                       'titulo'     =>  $this->input->post('titulo'));
        
        if(empty($dados['titulo'])){
            
            die('Título Obrigatório!');
            
        }
        if(empty($dados['descricao'])){
            
            die('Descrição Obrigatório!');
            
        }
        if(empty($id)){
        
            /* continuar aqui */
            echo $this->requisicao->salvar_requisicao($dados);
            
        }else{
            
            echo $this->requisicao->alterar_requisicao($dados,$id);
            
        }
        
    }
    
    public function listar_requisicao(){
        
        $dados = $this->requisicao->listar_requisicao();
        
        $html = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>$item->titulo</td>
                          <td style='vertical-align:middle;' class='hidden-xs hidden-sm'>".  inverteData($item->data)."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$item->descricao</td>
                          <td style='text-align:center; vertical-align:middle;'>
                          
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <strong>Ações</strong>
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Requisição</a></li>
                                  <li><a href='javascript:' class='link-excluir' id='".$id."'>Excluir</a></li>
                                </ul>
                            </div>
                          
                          </td>
                      </tr>";
        endforeach;
        
        if($html==""){
            
            $html = "<tr><td colspan='6'>Não foi encontrado nenhum registro...</td></tr>";
            
        }
        
        echo json_encode($html);
        
    }
    
    public function dados_requisicao(){
        
        $id = $this->input->post('id');
        $id = $this->encrypt->decode($id);
        
        $dados = $this->requisicao->dados_requisicao($id);
        
        if($dados){
            
            echo json_encode(array('error'     =>false,
                                   'titulo'    => $dados->titulo,
                                   'descricao' => $dados->descricao));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
        }
        
    }
   
    public function excluir_requisicao(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        echo $this->requisicao->excluir_requisicao($id); 
        
    }
    
}
