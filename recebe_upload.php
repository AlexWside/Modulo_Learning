<?php
session_start();
$conterro = 0;
if($_FILES['arquivo']['error']==NULL){
error_reporting(E_ALL & ~E_NOTICE); // isso é errado eu to ignorando aquele notice chato ele não quebra o codigo mas pode ocultar informações relevantes 
// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'uploads/';
 
// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 300; // 500Mb
 
// Array com as extensões permitidas
$_UP['extensoes'] = array('mp4','MP4');
 
// Renomeia o arquivo? (Se true, o arquivo será salvo como .mp4 e um nome único)
$_UP['renomeia'] = true;


//pega o nome atual do arquivo Nome atual 
$nome_atual = $_FILES['arquivo']['name'];

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
die("Não foi possível fazer o upload, erro:<br />" . $_UP['error'][$_FILES['arquivo']['error']]);
exit; // Para a execução do script
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {

$conterro = 'E';
echo "Por favor, envie arquivos com as seguintes extensões: mp4";
}

 
// Faz a verificação do tamanho do arquivo
else 
if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {

echo "O arquivo enviado é muito grande, envie arquivos de até 300Mb.";
}
 
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com a mesma extensão
$nome_final = time().".$extensao";
} else {
// Mantém o nome original do arquivo
$nome_final = $_FILES['arquivo']['name'];
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
echo "Upload efetuado com sucesso!";
$diretorio = $_UP['pasta'] . $nome_final ;
//echo "<br /><a href= $diretorio >Clique aqui para acessar o arquivo</a>";

} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Não foi possível enviar o arquivo, tente novamente";
}
 
}

if($conterro !=0 && $conterro == 'E'){ // if de verificação erro de extensão
   header('Location:postar.php?params=erroext');
}else{
require_once("model/arquivo_dao.php");
$arquivo->adicionar_video($nome_atual,$diretorio,$_POST['descricao'],$_SESSION['matricula'],$_SESSION['set_usuario'],$_POST['titulo'],$_POST['assunto'],$_POST['tipo'],$_POST['subtipo'],$_POST['tempo']);
} // fim if verificação erro de extensão
} else {// se tiver vazio
   header('Location:postar.php?params=erronull');
}
//

?>
