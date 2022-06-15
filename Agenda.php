<?php

    require_once("Conexao.php");
    require_once("Paciente.php");
    require_once("Profissional.php");

    class Agenda{
        private $idagenda;
        private $dtagenda;
        private $horaagenda;
        private $paciente;
        private $profissional;

        public function getIdAgenda(){
            return $this->idagenda;
        }
        public function setIdAgenda($idagenda){
            $this->idagenda = $idagenda;
        }
        public function getDtAgenda(){
            return $this->dtagenda;
        }
        public function setDtAgenda($dtagenda){
            $this->dtagenda = $dtagenda;
        }
        public function getHoraAgenda(){
            return $this->horaagenda;
        }
        public function setHoraAgenda($horaagenda){
            $this->horaagenda = $horaagenda;
        }
        public function getPaciente(){
            return $this->paciente;
        }
        public function setPaciente($paciente){
            $this->paciente = $paciente;
        }
        public function getProfissional(){
            return $this->profissional;
        }
        public function setProfissional($profissional){
            $this->profissional = $profissional;
        }

        public function cadastrar($agenda){
            $conexao = Conexao::conectar();

            $stmt = $conexao->prepare("INSERT INTO tbagenda(dataagenda, horaagenda,
                            codProfissional, codPaciente) VALUES(?, ?, ?, ?)");

            $stmt->bindValue(1, $agenda->getDtAgenda());
            $stmt->bindValue(2, $agenda->getHoraAgenda());
            $stmt->bindValue(3, $agenda->getProfissional()->getIdProfissional());
            $stmt->bindValue(4, $agenda->getPaciente()->getIdPaciente());
          
            $stmt->execute();
        }

        public function listar(){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT idAgenda, dataagenda, horaagenda, 
                            nomePaciente, nomeProfissional FROM tbagenda
                            INNER JOIN tbpaciente ON tbpaciente.codPaciente = tbagenda.codPaciente
                            INNER JOIN tbProfissional ON tbprofissional.codProfissional = tbagenda.codProfissional";
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;   
        }

    }

    //n tá cadastrando o profissional, n sobe  o nome  dele 
    // o erro pode estar aqui 

?>