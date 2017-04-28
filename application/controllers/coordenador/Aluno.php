<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends MY_Controller {

function __construct(){

        parent::__construct();
        $this->load->model('coordenador/Aluno_model', 'aluno');
        
    }
    
    public function index(){

        if($this->session->userdata('id_cood')){
            
            $data['nome']       = $this->session->userdata('nome_cood');
            $data['page']       = 'aluno';
            
            $this->load->view('coordenador/body_view',$data);
            
        }else{
        
            redirect(base_url('coordenador/dashboard/login'));    
            
        }
        
    }
    
    public function inscricao(){

        if($this->session->userdata('id_cood')){
            
            $data['nome']       = $this->session->userdata('nome_cood');
            $data['curso']      = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo;
            $data['page']       = 'inscricao_pendente';
            
            $this->load->view('coordenador/body_view',$data);
            
        }else{
        
            redirect(base_url('coordenador/dashboard/login'));    
            
        }
        
    }
    
    public function listar_aluno(){
        
        $dados = $this->aluno->listar_aluno($this->input->post('page'),$this->input->post('filtro'));
        
        $html = "";
        
          foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>
                          ".$item->nome_orientando."<br>
                          ".$item->email_orientando."<br>
                          ".$item->cpf_orientando."<br>
                          ".$item->lattes_orientando."
                          </td>
                          <td style='text-align:center; vertical-align:middle;'>
                            ".$item->curso."
                          </td>
                          <td style='vertical-align:middle;' class='hidden-xs hidden-sm'>
                          ".$item->nome_orientador."<br>
                          ".$item->email_orientador."<br>
                          ".$item->cpf_orientador."<br>
                          ".$item->lattes_orientador."
                          </td>
                          <td style='vertical-align:middle;' class='hidden-xs hidden-sm'>
                            Local: ".$item->local.", Horario:".$item->hora_realizacao."<br>
                            Orgão Fomento: ".$item->orgao_realizacao."<br>
                            Titulo: ".$item->titulo_projeto."<br>
                            Resumo: ".$item->resumo_projeto."
                          </td>
                      </tr>";
            
        endforeach;
        
        if($html==""){
            
            $html .= "<tr colspan='20'><td>Não foi encontrado nenhum registro...<td><tr>";
            
        }
        
        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links(),
                               'html'       => $html));
        
    }

    
    
}
