<?php
class Funcionario {
	var $nome;
	var $sobrenome;

	/**
	 * metodo construtor
	 * @param string $nome
	 * @param string $sobrenome
	 */
	public function __construct($nome, $sobrenome) {
		$this->nome = $nome;
		$this->sobrenome = $sobrenome;
	}

	/**
	 * metodo para gerar email com nome.sobrenome
	 * @return string
	 */
	public function gerarEmail() : string {
		return strtolower($this->nome) .
		"." .
		strtolower($this->sobrenome) .
		"@email.com.br";
	}

}