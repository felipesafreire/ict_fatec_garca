<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edital extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('admin/Edital_model', 'edital');
        
    }
    
    public function index(){

        if($this->session->userdata('id_admin')){
        
            $data['nome'] = $this->session->userdata('nome_admin');
            $data['page'] = 'edital';
            $this->load->view('admin/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function salvar_edital(){
        
        $id    = $this->input->post('id');
        
        $dados = array('inicial'  => $this->input->post('inicial'),
                       'final'    => $this->input->post('final'),
                       'semestre' => $this->input->post('semestre'),
                       'link'     => $this->input->post('link'));
        
        if(empty($dados['inicial'])){
            die("Data de Inicial Inscrição Obrigatória");
        }
        if(empty($dados['final'])){
            die("Data de Final Inscrição Obrigatória");
        }
        if(empty($dados['link'])){
            die("Link Edital Obrigatória");
        }
        
        if(empty($id)){
           
            echo $this->edital->salvar_edital($dados);
            
        }else{
            
            echo $this->edital->editar_edital($dados,$id);
            
        }

    }
    
    public function listar_edital(){
        
        $dados = $this->edital->listar_edital();
        
        $html = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
        
            if($item->semestre==1){
                
                $semestre = "Primeiro Semestre";
                
            }else{
                
                $semestre = "Segundo Semestre";
                
            }
            
            $html .= "<tr>
                          <td style='vertical-align:middle; max-width:40px; text-align:center;'>$item->id <br><a href='".$item->link."' target='_blank'>Link Edital</a></td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>".  inverteData($item->data_inicial_inscricao)."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>".  inverteData($item->data_final_inscricao)."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$semestre</td>
                          <td style='text-align:center; vertical-align:middle;'>
                          
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                Ações
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Edital</a></li>
                                </ul>
                            </div>
                          
                          </td>
                      </tr>
                
                
                ";
            
        endforeach;
        
        if($html==""){
            
            $html = "<tr><td colspan='5'>Não foi encontrado nenhum registro...</td></tr>";
            
        }
        
        echo json_encode($html);
        
    }
    
    public function dados_edital(){

        $id = $this->encrypt->decode($this->input->post('id'));
        
        $dados = $this->edital->dados_edital($id);
        
        if($dados){
            
            echo json_encode(array('error'      =>false,
                                   'inicial'    => inverteData($dados->data_inicial_inscricao),
                                   'final'      => inverteData($dados->data_final_inscricao),
                                   'semestre'   => $dados->semestre,
                                   'edital'     => $dados->link));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
        }
        
    }
    
}
