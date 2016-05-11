<?php
header ('Content-type: text/html; charset=UTF-8');
// header ('Content-type: text/html; charset=ISO-8859-1');
include_once 'config.php';
include_once 'vendor/autoload.php';
include_once 'Logs.php';
include_once 'Funcionario.php';
include_once 'conexaoPDO.php';

function main( $PDO ) {
	$log = new Log();
	$log->write("Inicio da execucao");
	$log->write("Caminho PHP: " . PHP_PATH);

	$f = new Funcionario("Victor", "Pinheiro");
	$email = $f->gerarEmail();
	print $email;

	$log->write("Email gerado: " . $email);

	// banco usando PDO
	$sql = "SELECT * FROM programadores";
	$result = $PDO->query( $sql );
	$rows = $result->fetchAll( PDO::FETCH_ASSOC );

	print '<h2>QUERY SIMPLES</h2>';
	foreach ($rows as $row) {
		print '<pre>';
		print_r( $row );
		print '</pre>';
	}

	// consulta com query no sql
	$search = "facebook";
	$sql = "SELECT * FROM programadores WHERE site LIKE '%" . $search . "%'";
	$result = $PDO->query( $sql );
	$rows = $result->fetchAll( PDO::FETCH_ASSOC );

	print '<h2>QUERY COM FILTRO NO SQL</h2>';
	foreach ($rows as $row) {
		print '<pre>';
		print_r( $row );
		print '</pre>';
	}

	// query com filtro com segurança
	$search = "BERALDO";
	$search = '%' . $search . '%';
	$sql = "SELECT * FROM programadores WHERE site LIKE :search";
	$stmt = $PDO->prepare( $sql );
	$stmt->bindParam( ':search', $search );
	$result = $stmt->execute();
	$rows = $stmt->fetchAll( PDO::FETCH_ASSOC );

	print '<h2>QUERY COM FILTRO COM SEGURANÇA</h2>';
	foreach ($rows as $row) {
		print '<pre>';
		print_r( $row );
		print '</pre>';
	}

	// INSERT COM PDO
	$id = null;
	$nome = 'Bill Gates';
	$site = 'http://microsoft.com';
	$sql = "INSERT INTO programadores(id, nome, site) VALUES(:id, :nome, :site)";
	$stmt = $PDO->prepare( $sql );
	$stmt->bindParam( ':id', $id );
	$stmt->bindParam( ':nome', $nome );
	$stmt->bindParam( ':site', $site );

	$result = $stmt->execute();

	if ( ! $result ) {
		var_dump( $stmt->errorInfo() );
		exit;
	}

	echo $stmt->rowCount() . " linhas inseridas";

	// UPDATE COM PDO
	$nome = 'Bill Gates';
	$site = 'http://ruindows.com.br';
	$sql = "UPDATE programadores set site = :site WHERE nome = :nome";
	$stmt = $PDO->prepare( $sql );
	$stmt->bindParam( ':nome', $nome );
	$stmt->bindParam( ':site', $site );

	$result = $stmt->execute();

	if ( ! $result ) {
		var_dump( $stmt->errorInfo() );
		exit;
	}

	echo $stmt->rowCount() . " linhas alteradas";

	// DELETE COM PDO
	$nome = 'Bill Gates';
	$sql = "DELETE FROM programadores WHERE nome = :nome";
	$stmt = $PDO->prepare( $sql );
	$stmt->bindParam( ':nome', $nome );

	$result = $stmt->execute();

	if ( ! $result ) {
		var_dump( $stmt->errorInfo() );
		exit;
	}

	echo $stmt->rowCount() . " linhas removidas";

}

main( $PDO );