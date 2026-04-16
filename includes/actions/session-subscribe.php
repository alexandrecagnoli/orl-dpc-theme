<?php

// Inscription d'un user au défi
add_action('wp', 'action_session_subscribe');

function action_session_subscribe()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'session_subscribe') )
		{
			// Getting variables
			$post_ID = $_REQUEST['post_id'];
			$session_ID = $_REQUEST['session_id'];
			$user_ID = $_REQUEST['user_id']; 
			
			$step=0;
			// Check if user is logged
			if ( $user_ID <= 0 )
			{
			  $alert_type="warning";
			  $alert_msg = "Vous devez être connecté pour vous inscrire à une session.";
			  $urlRedirect = "/connexion/";
			}
			else
			{
				if( isset($_REQUEST['step']) && $_REQUEST['step'] == 2)
				{
					$step = $_REQUEST['step'];
					$urlRedirect="/session-inscription/?post_id=".$_REQUEST['post_id']."&user_id=".$user_ID."&session_id=".$session_ID."&step=".$step;
				}
				elseif( isset($_REQUEST['step']) && $_REQUEST['step'] == 3)
				{
					$step = $_REQUEST['step'];
					$mySession = new Session($post_ID);
					$customer = new User($user_ID);
					//
					//
					// INSCRIPTION
					$mySession->addCustomer($user_ID);
					// Validation automatique du DPC pour les médecins hopsitaliers
					if( $customer->type == "Médecin hospitalier" )
					{
						$mySession->setDPC($user_ID, 1);		
					}
					// Validation automatique du dossier si webinar
					if( $mySession->type == 1 ) 
					{
						$mySession->setRegistrationForm($user_ID, 1);
					}
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
					// EMAIL TRANSACTIONNEL
				  $vars= array(

						'#FIRSTNAME' => $customer->firstname,
						'#LASTNAME' => $customer->firstname,
						'#CUSTOMER_ID' => $customer->id,
						'#SESSION_ID' => $mySession->id,
						'#SESSION_STARTDATE' => getNiceDateHome($mySession->startdate),
						'#SESSION_STARTTIME' => $mySession->starttime,
						'#SESSION_ENDTIME' => $mySession->endtime,
						'#SESSION_LOCATION' => $mySession->location,
						'#SESSION_ZIPCODE' => $mySession->zipcode,
						'#SESSION_CITY' => $mySession->city,
						'#SESSION_ADDRESS' => $mySession->address,
						'#SESSION_ID' => $mySession->session_id,
						'#SESSION_INDEMNISATION' => $mySession->session_indemnisation,
						'#EVAL_1_STARTDATE' => getNiceDateHome($mySession->eval_1_startdate),
						'#EVAL_1_ENDTDATE' => getNiceDateHome($mySession->eval_1_enddate),
						'#EVAL_2_STARTDATE' => getNiceDateHome($mySession->eval_2_startdate),
						'#EVAL_2_ENDDATE' => getNiceDateHome($mySession->eval_2_enddate),
						'#COURSE_NAME' => $mySession->getCourseTitle(),
						'#CAUTION' => $customer->paycheck_IsValid(),
						'#CAUTION_AMOUNT' => get_field('website_paycheck_amount', 'option').'€',
						'#DISCLAIMER' => $disclaimer
				  );
				  // Confirmation de préinscription
				  	if($mySession->type == 1)
					iti_user_mail($user_ID, "Votre préinscription a été prise en compte", "session-subscribe-webinar", $vars);
					else
					iti_user_mail($user_ID, "Votre préinscription a été prise en compte", "session-subscribe", $vars);

					// Evaluation ouverte
					$startdate = strtotime($mySession->eval_1_startdate);
					if( $startdate <= strtotime("now") ) // si la date d'ouverture est atteinte
					{
						//iti_user_mail($user_ID, "Votre évaluation est ouverte", "eval_1-invite", $vars);
					}

					$urlRedirect="/session-inscription/?post_id=".$_REQUEST['post_id']."&user_id=".$user_ID."&step=".$step;
				}
				else
				{
					$urlRedirect="/session-inscription/?post_id=".$_REQUEST['post_id']."&session_id=".$session_ID."&user_id=".$user_ID;
				}

			}

			wp_redirect( $urlRedirect );
			exit;
		}
	}
}
