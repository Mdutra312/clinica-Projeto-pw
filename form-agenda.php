<?php 
   
    include_once("valida-sentinela.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clínica X</title>
    </head>
    <body>
        <h1>Área Restrita - Clínica X</h1>
        <?php
            echo("Olá, ".$_SESSION['login-session']);
        ?>
        <br>
        <a href='logout.php'>Sair</a>
        <br><br><br>
        <a href='form-paciente.php'>Cadastro de Pacientes</a>
        <br>
        <a href='form-profissional.php'>Cadastro de Profissionais</a>
        <br>
        <a href='form-agenda.php'>Agendamento</a>

        <?php
            require_once("Paciente.php");
            require_once("Profissional.php");
            require_once("Agenda.php");
            try {
                $paciente = new Paciente();
                $profissional = new Profissional();
                $agenda = new Agenda();
                $listapaciente = $paciente->listar();
                $listaprofissional = $profissional->listar();
                $listaagenda = $agenda->listar();
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        ?>

        <h2>Agendamento</h2>
        <form action="cadastra-agenda.php" method="post">
            <label>Data: </label>
            <input type="date" name="txtData">
            <br>
            <label>Hora:</label>
            <input type="time" name="txtHora">
            <br>
            <label>Paciente:</label>
            <select name="paciente" action="">
                <option value="0">Selecione</option>
                <?php foreach ($listapaciente as $linha){ ?>
                    <option value="<?php echo $linha['codPaciente'] ?>">
                        <?php echo $linha['nomePaciente'] ?>
                    </option>
                <?php } ?>
            </select>
            <br>


            
            <label>Profissional:</label>
            <select name="profissional">
                <option value="0">Selecione</option>
                <?php foreach ($listaprofissional as $linha){ ?>
                    <option value="<?php echo $linha['codProfissional'] ?>">
                        <?php echo $linha['nomeProfissional'] ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" value="Cadastrar">
                </form>



        <h1>Agendamentos Cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Profissional</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaagenda as $linha){ ?>
                    <tr>
                        <td><?php echo $linha['idAgenda'] ?></td>
                        <td><?php echo $linha['dataagenda'] ?></td>
                        <td><?php echo $linha['horaagenda'] ?></td>
                        <td><?php echo $linha['nomePaciente'] ?></td>
                        <td><?php echo $linha['nomeProfissional'] ?></td>
                        <td><a href="#">Editar</a></td>
                        <td><a href="#">Excluir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>