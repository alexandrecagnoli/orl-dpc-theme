<?php

// Export des données
add_action('wp', 'action_export_session_data');

function action_export_session_data()
{

	if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'export_session_data' )
	{
		if( isset($_REQUEST['post_id']) && isset($_REQUEST['customer_id']))
		{
			$mySession = new Session($_REQUEST['post_id']);
			$customer = new User($_REQUEST['customer_id']);
			
			$customers = $mySession->getCustomers();
            $filename = $mySession->session_id." - Temps de connexions";
			header("Content-type: text/csv; charset=UTF-8");
			header("Content-Disposition: attachment; filename=".$filename.".csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			$data = array();
			$i=0;
            date_default_timezone_set('Europe/Paris');
            $timestamp = strtotime($mySession->getCustomerDateCreated($_REQUEST['customer_id']));
            foreach($customers as $customerId)
            {
            	$customer = new User($customerId);

                $eval1_startdate = $mySession->getCustomer_eval_1_startdate($customerId);
                $eval1_enddate = $mySession->getCustomer_eval_1_enddate($customerId);
                $eval2_startdate = $mySession->getCustomer_eval_2_startdate($customerId);
                $eval2_enddate = $mySession->getCustomer_eval_2_enddate($customerId);
               
            	$data[$i] = array(
            		$customer->firstname,
            		$customer->lastname,
                    $customer->email,
                    $customer->phone,
                    $customer->mobile,
            		getStatusNiceName($mySession->getCustomer_eval_1_status($customerId)),
                    convertSeconds($mySession->getSessionEvalDebut($customerId, 1)),
                    $mySession->getSessionEvalEnd($customerId, 1),
                    $mySession->getCustomer_eval_1_duration($customerId),
        			getStatusNiceName($mySession->getCustomer_eval_2_status($customerId)),
                    convertSeconds($mySession->getCustomer_eval_2_duration($customerId)),
                    $mySession->getSessionEvalDebut($customerId, 2),
                    $mySession->getSessionEvalEnd($customerId, 2),
                    $mySession->getCustomer_eval_all_duration($customerId)
            	);
                $i++;
            }
            $labels = array
            (
                "Prénom", 
                "Nom", 
                "Email",
                "Téléphone",
                "Mobile", 
                "Eval 1",
                "Eval 1 début",
                "Eval 1 fin",  
                "Durée", 
                "Eval 2", 
                "Durée", 
                "Eval 1 début",
                "Eval 1 fin",
                "Durée Totale",  
            );
            array_unshift($data, $labels);
			outputCSV($data);
		}

	}

	if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'export_session_data_2' )
	{
		if( isset($_REQUEST['post_id']) && isset($_REQUEST['customer_id']))
		{
			$mySession = new Session($_REQUEST['post_id']);
			$customer = new User($_REQUEST['customer_id']);
			$customers = $mySession->getCustomers();
            $filename = $mySession->session_id." - Temps de connexions";
			header("Content-type: text/csv; charset=UTF-8");
			header("Content-Disposition: attachment; filename=".$filename.".csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			$data = array();
			$i=0;
            date_default_timezone_set('Europe/Paris');
            $timestamp = strtotime($mySession->getCustomerDateCreated($_REQUEST['customer_id']));
            foreach($customers as $customerId)
            {
            	$customer = new User($customerId);

                $eval1_startdate = $mySession->getCustomer_eval_1_startdate($customerId);
                $eval1_enddate = $mySession->getCustomer_eval_1_enddate($customerId);
                $eval2_startdate = $mySession->getCustomer_eval_2_startdate($customerId);
                $eval2_enddate = $mySession->getCustomer_eval_2_enddate($customerId);
               
            	$data[$i] = array(
                    $customer->id,
            		strtoupper($customer->firstname),
            		strtoupper($customer->lastname),
                    strtolower($customer->email),
                    $mySession->id,
                    $mySession->session_id,
                    $mySession->dpc_id,
                    $mySession->getCourseTitle(),
            		getStatusNiceName($mySession->getCustomer_eval_1_status($customerId)),
                    convertSeconds($mySession->getCustomer_eval_1_duration($customerId)),
                    $mySession->getSessionEvalDebut($customerId, 1),
                    $mySession->getSessionEvalEnd($customerId, 1),
        			getStatusNiceName($mySession->getCustomer_eval_2_status($customerId)),
                    convertSeconds($mySession->getCustomer_eval_2_duration($customerId)),
                    $mySession->getSessionEvalDebut($customerId, 2),
                    $mySession->getSessionEvalEnd($customerId, 2),
                    $mySession->getCustomer_eval_all_duration($customerId),

            	);
                $i++;
            }
            $labels = array
            (
                "user_id",
                "user_firstname", 
                "user_lastname", 
                "user_email",
                "session_id",
                "session_key",
                "session_dpc_id",
                "course_name",
                "eval_1_status", 
                "eval_1_duration",
                "eval_1_start",
                "eval_1_end",    
                "eval_2_status", 
                "eval_2_duration",
                "eval_2_start",
                "eval_2_end",    
                "total_duration",
            );
            array_unshift($data, $labels);
			outputCSV($data);
		}

	}

}

function outputCSV($data) {
    $output = fopen("php://output", "w");
    fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF))); // Ajout du BOM pour UTF-8

    foreach ($data as $row) {
        // Conversion des chaînes en UTF-16LE
        $encodedRow = array_map(function($item) {
            return mb_convert_encoding($item, 'UTF-16LE', 'UTF-8');
        }, $row);

        // Écriture de la ligne encodée
        fputcsv($output, $encodedRow, ";");
    }

    fclose($output);
    exit();
}


