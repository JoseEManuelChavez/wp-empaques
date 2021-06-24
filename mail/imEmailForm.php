<?php
	$settings['imEmailForm_8_17'] = array(
		"owner_email_from" => "empestol@prodigy.net.mx",
		"owner_email_to" => "empestol@prodigy.net.mx",
		"customer_email_from" => "empestol@prodigy.net.mx",
		"customer_email_to" => "",
		"owner_message" => "",
		"customer_message" => "",
		"owner_subject" => "",
		"customer_subject" => "",
		"owner_csv" => False,
		"customer_csv" => False,
		"confirmation_page" => "../index.html"
	);

	if(substr(basename($_SERVER['PHP_SELF']), 0, 11) == "imEmailForm") {
		include "../res/x5engine.php";

		$answers = array(
		);

		$form_data = array(
			array('label' => 'Nombre Completo:', 'value' => $_POST['imObjectForm_17_1']),
			array('label' => 'E-mail:', 'value' => $_POST['imObjectForm_17_2']),
			array('label' => 'Empresa:', 'value' => $_POST['imObjectForm_17_3']),
			array('label' => 'Telefono:', 'value' => $_POST['imObjectForm_17_4']),
			array('label' => 'Comentario:', 'value' => $_POST['imObjectForm_17_5'])
		);

		$files_data = array(
		);

		if(@$_POST['action'] != "check_answer") {
			if(!isset($_POST['imJsCheck']) || $_POST['imJsCheck'] != "jsactive")
				die(imPrintJsError());
			if (isset($_POST['imCpt']) && !isset($_POST['imCptHdn']))
				die(imPrintJsError());
			if(isset($_POST['imSpProt']) && $_POST['imSpProt'] != "")
				die(imPrintJsError());
			$email = new imSendEmail();
			$email->sendFormEmail($settings['imEmailForm_8_17'], $form_data, $files_data);
			@header('Location: ' . $settings['imEmailForm_8_17']['confirmation_page']);
		} else {
			if(@$_POST['id'] == "" || @$_POST['answer'] == "" || strtolower(trim($answers[@$_POST['id']])) != strtolower(trim(@$_POST['answer'])))
				echo "0";
			else
				echo "1";
		}
	}

// End of file