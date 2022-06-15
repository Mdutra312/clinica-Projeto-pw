<?php

require_once("Profissional.php");

$nome = $_POST['txtNome'];

$profissional = new Profissional();

$cpf = $_POST['txtCpf'];

$profissional->setNomeprofissional($nome);


if(empty($cpf)) {
    header("Location: form-profissional.php");

}else{
    if (strlen($cpf) != 11) {
        header("Location: form-profissional.php");



    }else if ($cpf == '00000000000' || 
    $cpf == '11111111111' || 
    $cpf == '22222222222' || 
    $cpf == '33333333333' || 
    $cpf == '44444444444' || 
    $cpf == '55555555555' || 
    $cpf == '66666666666' || 
    $cpf == '77777777777' || 
    $cpf == '88888888888' || 
    $cpf == '99999999999') {
    header("Location: form-profissional.php");
 // Calcula os digitos verificadores para verificar se o
 // CPF é válido
 
 } else{
    for ($t = 9; $t < 11; $t++) {
			
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d){
            header("Location: form-profissional.php");
        }
    }
    // precisa emiliminar possível máscara
    $profissional->setRgprofissional($_POST['txtRg']);
    $profissional->setCpfProfissional($cpf);    
    $profissional->cadastrar($profissional);

    print("Bem vindo a Brilho Radiante ! Profissional ".$nome."<br><br>");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php"> Sair da Sessão</a>
</body>
</html>