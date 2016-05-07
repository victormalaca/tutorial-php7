<?php
class Log {
	/**
	 * metodo que escreve os logs
	 * @param string $msg
	 * @param string $level
	 * @param string $file
	 */
	function write($msg, $level = 'info', $file = 'main.log') {
		switch ($level) {
			case 'info' :
				$msg = '[INFO] ' . $msg;
				break;

			case 'warning' :
				$msg = '[WARNING] ' . $msg;
				break;

			case 'error' :
				$msg = '[ERROR] ' . $msg;
				break;
		}

		// data atual
		$date = date( 'Y-m-d H:i:s' );

		$msg = '[' . $date . '] ' . $msg;

		// adiciona quebra de linha
		$msg .= PHP_EOL;

		file_put_contents ( $file, $msg, FILE_APPEND );
	}
}
