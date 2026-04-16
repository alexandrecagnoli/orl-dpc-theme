<?php
/*

// All the admin's action on the session subscribers

	$update_action = 1 to 3 -> Update subscription status
	$update_action = 10 to 11 -> Update subscribtion agencedpc.fr
	$update_action = 20 to 2X -> Delete QCM data
	$update_action = 30 to 31 -> Update Attendance 
	$update_action = 92 to 96 -> Send transactional reminders email (not active anymore)
	$update_action = 97 -> Send transactional email for Evaluation 1
	$update_action = 98 -> Send transactional email for Evaluation 2
	$update_action = 99 -> Kill subscriber

*/
add_action('wp', 'action_customer_update');

function action_customer_update()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'customer_update') )
		{

			if(isset($_REQUEST['post_id']))
			{
				// Getting variables
				$post_ID = $_REQUEST['post_id'];
				$customerIds = $_REQUEST['customerId'];

				// Check if entries selected
				if(isset($_REQUEST['update_action']))
				{
					$update_action = $_REQUEST['update_action'];

					// Check if entries selected
					if (isset($_REQUEST['customerId']))
					{
						$tab = $_REQUEST['customerId'];
						foreach ($tab as $customerId)
						{
					        $mySession = new Session($post_ID);
					        $customer = new User($customerId);

							// Disclaimer de bas de page 
							$disclaimer = "";
							if($mySession->type != 1 ){
								$disclaimer = '
								<p style="text-align:left;color:#EB9530;font-size:18px;"><strong>ATTENTION !</strong></p>
								<p>Si vous ne l’avez pas encore fait pour l’année <?php echo date("Y"); ?> et  afin de pouvoir valider votre inscription, faîtes-nous parvenir votre  chèque de caution de 230€ (à l’ordre d’ORL-DPC) accompagné du bulletin d’inscription à télécharger ci-dessous</p>
								<p><a href="https://orl-dpc.fr/session-inscription/confirmation/?post_id='.$mySession->id.'&form_action=subscription_confirm&customer_id=#'.$customer->id.'" class="session-action-pdf" target="_blank">Imprimer mon bulletin d’inscription</a> </p>
								';
							}
							else
							$disclaimer="";

							// Setting Variables
							$vars= array(
								'#FIRSTNAME' => $customer->firstname,
								'#LASTNAME' => $customer->lastname,
								'#CUSTOMER_ID' => $customer->id,
								'#POST_ID' => $mySession->id,
								'#SESSION_VISIOCONFERENCE_LINK' => $mySession->conference_link,
								'#SESSION_VISIOCONFERENCE_ID' => $mySession->conference_id,
								'#SESSION_VISIOCONFERENCE_PASSWORD' => $mySession->conference_password,
								'#SESSION_TYPE' => $mySession->type,
								'#DPC_ID' => $mySession->dpc_id,
								'#DPC_NUMBER' => $mySession->dpc_number,
								'#SESSION_STARTDATE' => getNiceDateHome($mySession->startdate),
								'#SESSION_STARTTIME' => $mySession->starttime,
								'#SESSION_ENDTIME' => $mySession->endtime,
								'#SESSION_LOCATION' => $mySession->location,
								'#SESSION_ZIPCODE' => $mySession->zipcode,
								'#SESSION_CITY' => $mySession->city,
								'#SESSION_ADDRESS' => $mySession->address,
								'#SESSION_ID' => $mySession->session_id,
								'#SESSION_INDEMNISATION' => $mySession->indemnisation,
								'#EVAL_1_STARTDATE' => getNiceDateHome($mySession->eval_1_startdate),
								'#EVAL_1_ENDDATE' => getNiceDateHome($mySession->eval_1_enddate),
								'#EVAL_2_STARTDATE' => getNiceDateHome($mySession->eval_2_startdate),
								'#EVAL_2_ENDDATE' => getNiceDateHome($mySession->eval_2_enddate),
								'#COURSE_NAME' => $mySession->getCourseTitle(),
								'#CAUTION' => $customer->paycheck_IsValid(),
								'#CAUTION_AMOUNT' => get_field('website_paycheck_amount', 'option').'€',
								'#DISCLAIMER' => $disclaimer
							);

					        ///////////////////
					        //
					        //
					        // Update subscription status
					        //
					        ///////////////////
					        if($update_action <= 3)
					        {

								$mySession->setCustomerStatus($customerId, $update_action);
								$startdate = strtotime($mySession->eval_1_startdate);

								// si le statut de l'inscription = validée
								if($update_action == 2)
								{
									// envoi du mail transactionnel : inscription validée
									if($mySession->type == 1)
									iti_user_mail($customerId, "Votre préinscription a été prise en compte", "session-subscribe-validated-webinar", $vars);
									else
									iti_user_mail($customerId, "Votre préinscription a été prise en compte", "session-subscribe-validated", $vars);
								}
								if(
									// si le deuxieme QCM n'a pas été validé
									$mySession->getCustomer_eval_2_status($customer->id) <= 1 &&
									// si le statut de l'inscription = validée
									$update_action == 2 &&
									// Si le QCM est ouvert
									$startdate <= strtotime("now")
								)
								{
									// envoi du mail transactionnel : évaluation pré-formation
									if($mySession->evaluation_type == "epp"){
										iti_user_mail($customerId, "Validez votre évaluation pré-formation", "eval_1-invite-epp", $vars);
									}
									elseif($mySession->evaluation_type == "app+epp"){
										iti_user_mail($customerId, "Validez votre évaluation pré-formation", "eval_1-invite-epp", $vars);
									}
									else
									iti_user_mail($customerId, "Validez votre évaluation pré-formation", "eval_1-invite", $vars);
								}
					        }

					        ///////////////////
					        //
					        //
					        // Update subscribtion mondpc.fr
					        //
					        ///////////////////
					        if($update_action == 10)
					        {
					        	$mySession->setDPC( $customerId,1);
					        }
					        if($update_action == 11)
					        {
					        	$mySession->setDPC( $customerId,0);
					        }
					        ///////////////////
					        //
					        //
					        // Delete QCM
					        //
					        ///////////////////
					        if($update_action == 20)
					        {
					        	$mySession->deleteCustomer_eval_1_startdate($customerId);
					        	$mySession->deleteCustomer_eval_1_enddate($customerId);
								$mySession->setCustomer_eval_1_status($customerId, 0);
					        }
					        if($update_action == 21)
					        {
					        	$mySession->deleteCustomer_eval_2_startdate($customerId);
					        	$mySession->deleteCustomer_eval_2_enddate($customerId);
								$mySession->setCustomer_eval_2_status($customerId, 0);
					        }
					        ///////////////////
					        //
					        //
					        // Update QCM
					        //
							///////////////////
					        if($update_action == 22)
					        {
								$mySession->setCustomer_eval_1_status($customerId, 2);
							}		
					        if($update_action == 23)
					        {
								$mySession->setCustomer_eval_2_status($customerId, 2);
					        }
					        if($update_action == 24)
					        {
								$mySession->setCustomer_eval_1_status($customerId, 1);
							}		
					        if($update_action == 25)
					        {
								$mySession->setCustomer_eval_2_status($customerId, 1);
					        }
					        ///////////////////
					        //
					        //
					        // Update Attendance (presence a la session)
					        //
							///////////////////		
					        if($update_action == 30)
					        {
								$mySession->setCustomerAttendance($customerId, 2);
							}									
					        if($update_action == 31)
					        {
								$mySession->setCustomerAttendance($customerId, 0);
							}									
														
					        ///////////////////
					        //
					        //
					        // Update registration form (not used anymore)
					        //
							///////////////////
							/*
					        if($update_action == 95)
					        {
					        	$mySession->setRegistrationForm( $customerId, 1);
							}
							*/
					        ///////////////////
					        //
					        //
					        // Send subsription email
					        //
					        ///////////////////
					        if($update_action == 95)
					        {
								// Confirmation de préinscription
								iti_user_mail($customerId, "Votre préinscription à ".$mySession->session_id." a été prise en compte", "session-subscribe", $vars);
							}
					        ///////////////////
					        //
					        //
					        // Send "Documents téléchargeables email"
					        //
					        ///////////////////
					        if( $update_action == 92 )
					        {
								// Confirmation de préinscription
								iti_user_mail($customerId, $mySession->session_id." : Vos documents téléchargeables", "user-documents", $vars);
					        }
					        ///////////////////
					        //
					        //
					        // Send MONDPC Reminder email
					        //
					        ///////////////////
					        if( $update_action == 93 )
					        {
								// Confirmation de préinscription
								iti_user_mail($customerId,$mySession->session_id." : Inscrivez-vous sur agencedpc.fr", "dpc-reminder", $vars);
					        }

					        ///////////////////
					        //
					        //
					        // Send subscription validated email
					        //
					        ///////////////////
					        if( $update_action == 96 )
					        {
								// Confirmation de préinscription
								iti_user_mail($customerId, $mySession->session_id." Votre inscription est validée", "session-subscribe-validated", $vars);
					        }

					        ///////////////////
					        //
					        //
					        // Send subsription validated email
					        //
					        ///////////////////
					        if( $update_action == 94 )
					        {
								if($mySession->type != 1 )
								// Confirmation de préinscription présentiel
								iti_user_mail($customerId, "Votre session DPC ".$mySession->session_id, "session-reminder", $vars);
								else
								// Confirmation de préinscription distanciel
								iti_user_mail($customerId, "Vos identifiants de connexion ".$mySession->session_id, "session-reminder-webinar", $vars);
					        }

					        ///////////////////
					        //
					        //
					        // Send transactional email for Evaluation 1
					        //
					        ///////////////////
					        if( $update_action == 97 )
					        {
								if($mySession->evaluation_type == "epp"){
									iti_user_mail($customerId, "Validez votre évaluation pré-formation", "eval_1-invite-epp", $vars);
								}
								elseif($mySession->evaluation_type == "app+epp"){
									iti_user_mail($customerId, "Validez votre évaluation pré-formation", "eval_1-invite-epp", $vars);
								}
								else
					        	iti_user_mail($customerId, "Validez votre évaluation pré-formation", "eval_1-invite", $vars);
					        }
					        ///////////////////
					        //
					        //
					        // Send transactional email for Evaluation 2
					        //
					        ///////////////////
					        if($update_action == 98)
					        {
								if($mySession->evaluation_type == "epp"){
									iti_user_mail($customerId, "Validez votre évaluation post-formation", "eval_2-invite-epp", $vars);
								}
								elseif($mySession->evaluation_type == "app+epp"){
									iti_user_mail($customerId, "Validez votre évaluation post-formation", "eval_2-invite-epp", $vars);
								}
								else
					        	iti_user_mail($customerId, "Validez votre évaluation post-formation", "eval_2-invite", $vars);
					        }
					        // Delete entry
					        if($update_action == 99)
					        {
					        	$mySession->deleteCustomer( $customerId);
					        }

					    }
					}
				}
			}
			else
			{
				$urlRedirect=home_url();
				wp_redirect( $urlRedirect );
				exit;
			}

		}
	}
}
