<?php
include_once 'C:\xampp\htdocs\Clinica-Odontologica\Admin\assets\classes\atualizacoes\BancodeDados.php';

class ConsultaDao extends BancodeDados{

    public function listaConsultas(){

        $sql = $this->conexao->prepare("Select * from consulta c
        inner join dentista d
        on d.idDentista = c.Dentista_idDentista
        
        inner join paciente p
        on p.idPaciente = c.paciente_idPaciente");
        $sql->execute();
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        return $dados;
    } 

    public function listaDentistas(){

        $sql = $this->conexao->prepare("Select * from dentista ORDER BY nomeDentista");
        $sql->execute();
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        return $dados;
    }

    public function listaPacientesID($idPaciente){

        $sql = $this->conexao->prepare("Select * from paciente WHERE idPaciente =$idPaciente");
        $sql->execute();
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        return $dados;
    }

    public function novaConsulta($consulta){

        $horario = $consulta->getHorario();

        $data = $consulta->getData();

        $paciente = $consulta->getPaciente();

        $dentista = $consulta->getDentista();


        $sql = $this->conexao->prepare("Select * from consulta WHERE Dentista_idDentista = '$dentista' AND ");
        $sql->execute();
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

        var_dump($dados);

        if($dados != null){
            foreach($dados as $disponivel){

                if($disponivel['data']==$data && $disponivel['horario']){

                    echo "marcou não";
                    //$mensagem = "Este horário não está disponível, tente marcar sua consulta em outro horário";
                }
                else{
                    echo "o erro ta aqui";
                    $sql = $this->conexao->prepare("INSERT INTO consulta (data, horario, paciente_idPaciente, Dentista_idDentista) VALUES ( '$data', '$horario', '$paciente', '$dentista')");
            
                    if($sql->execute()==true){
                        $mensagem = "Consulta marcada com sucesso";
                    }else{
                        $mensagem = "Erro ao marcar a consulta";
                    }
                }
            }
        }else{
            
            $sql = $this->conexao->prepare("INSERT INTO consulta (data, horario, paciente_idPaciente, Dentista_idDentista) VALUES ( '$data', '$horario', '$paciente', '$dentista')");
            echo 'Entrou no IF do NULL';
            if($sql->execute()==true){
                $mensagem = "Consulta marcada com sucesso";
                echo 'entrou no ultimo IF';
            }else{
                $mensagem = "Erro ao marcar a consulta";
            }
        }        
        
        return $mensagem;
    }

}