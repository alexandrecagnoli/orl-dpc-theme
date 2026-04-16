<?php

function getSessionAlerts($session_id, $customer_id)
{
	$mySession = new Session($session_id);
	$customer = new User($customer_id);


	if(
		// si l'évaluation 1 n'a pas été réalisée
		$mySession->getCustomer_eval_1_status($customer_id) <= 1 ||
		// OU si l'évaluation 2 n'a pas été réalisée
		$mySession->getCustomer_eval_2_status($customer_id) <= 1 ||
		// OU si l'inscription de l'user n'est validée
		$mySession->getCustomerStatus($customer_id) != 2 
	   ) :
	   $output="<div class='alert-wrapper'>";
	   if(current_user_can('administrator')):
		//$output.="Eval 1 status".$mySession->getCustomer_eval_1_status($customer_id)."<br>";
		//$output.="Eval 2 status".$mySession->getCustomer_eval_2_status($customer_id)."<br>";
	   endif;
			if( $mySession->getCustomerStatus($customer_id) != 2)
			{
				if ( 
					( $mySession->getDPC($customer_id) != 1)  || 
					( ( $customer->paycheck_IsValid() != 2 ) && ($mySession->type != 1 )   ) 
					)
				{
					//$output .="<p class='alert-wrapper-title'>Merci de finaliser votre inscription en réalisant les étapes ci-dessous</p>";
				}
				else
				{
					$output .="<div class='alert-block warning'> <p class='alert-title'>Votre inscription est en cours de validation. Vous serez prévenu par email de sa validation par nos équipes.</p></div>";
				}
			}
			//
			//
			// Alertes de vérification
			//
			//
			$output .= getDPCAlert($mySession->id, get_current_user_id());
			$output .= getPaycheckAlert($mySession->id, get_current_user_id());
			//$output .= getEval_Alert($mySession->id, get_current_user_id(),1);
			//$output .= getEval_Alert($mySession->id, get_current_user_id(),2);
			$output .= "</div>";

			return $output;

			//
			// Satisfaction
			elseif(
				// si le deuxieme QCM a été validé
				$mySession->getCustomer_eval_2_status($customer_id) == 2 &&
				// si le premier QCM a été validé
				$mySession->getCustomer_eval_1_status($customer_id) == 2 &&
				// si le  QCM satisfaction n'a pas été validé
				$mySession->getCustomer_satisfaction_status($customer_id) < 2
				) :

			$output="<div class='alert-wrapper'>";
			$ph = "En prenant quelques instants pour répondre à notre étude de satisfaction, nous pouvons identifier les axes d'améliorations et ainsi vous proposer des formations toujours plus qualitatives.";
			$ph .= '<p><a class="btn btn-turquoise" href="./?customer_id='.get_current_user_id().'&post_id='.$mySession->id.'&session_id='.$mySession->session_id.'&satisfaction_eval=1&form_action=satisfaction_update&status=1">JE DONNE MON AVIS SUR LA FORMATION</a></p>';
			$myAlert = new Alert(
			'Votre avis nous intéresse',
			$ph,
			'ico-ampoule.png',
			'alert-main'
			);
			$output .= $myAlert->get();
			$output .= "</div>";

			return $output;

		//
		//
		// Alertes d'évaluation pré / post formation
		//
		//
		//
		// QCM VALIDÉ
		elseif(	 isset($_REQUEST['callback']) && ($_REQUEST['callback'] == 'qcm_done')) :

			$output="<div class='alert-wrapper'>";
			$myAlert = new Alert(
			'Merci pour votre participation',
			'',
			'ico-valid.svg',
			'alert-main'
			);
			$output .= $myAlert->get();
			$output .= "</div>";

			return $output;

		endif;
}

function getDPCAlert( $session_id, $customer_id){
	$mySession = new Session($session_id);
	$customer = new User($customer_id);
	// Vérification d'inscription mondpc.fr
	if( $mySession->getDPC($customer_id) != 1)
	{
		$myAlert = new Alert(
		'Inscrivez-vous sur agencedpc.fr',
		"Afin de pouvoir bénéficier du financement DPC, vous devez impérativement être enregistré sur le site agencedpc.fr.<br/>Si vous n’avez pas de compte, créez le en quelques minutes. <a href='/faq/'>Plus d'informations</a>",
		'ico-subscribe-orange.svg',
		'warning'
		);
		$output .= $myAlert->get();
		return $output;
	}
}

function getPaycheckAlert($session_id, $customer_id){

	$mySession = new Session($session_id);
	$customer = new User($customer_id);

	// Vérification chèque de caution
	if( ($customer->paycheck_IsValid() != 2) && ($mySession->type != 1 ) )
	{

		$paycheck = ' accompagné d’un chèque de caution de '.get_field('website_paycheck_amount', 'option').'€ à l’Ordre d’ORL-DPC';
		$myAlert = new Alert(
		'Faîtes-nous parvenir votre fiche d’inscription',
		'Afin de pouvoir valider vos inscriptions, merci de nous retourner <a href="/session-inscription/confirmation/?post_id='.$mySession->id.'&form_action=subscription_confirm&customer_id='.get_current_user_id().'" class="session-action-pdf" target="_blank">votre bulletin d’inscription </a>'.$paycheck.'.',
		'ico-mail-orange.svg',
		'warning'
		);
		$output .= $myAlert->get();
		return $output;
	}

}

function getEval_Alert($session_id, $customer_id, $eval_index){
	$mySession = new Session($session_id);
	$customer = new User($customer_id);

	if($eval_index == 1)
	{
		$startdate = $mySession->eval_1_startdate;
		$enddate = $mySession->eval_1_enddate;
	}
	if($eval_index == 2)
	{
		$startdate = $mySession->eval_2_startdate;
		$enddate = $mySession->eval_2_enddate;
	}
	$ph = "Nous vous rappelons que cette évaluation est obligatoire pour pouvoir accéder à la formation.";

	// QCM Pré-formation
	if(
		// si l'user est inscrit sur MONDPC
		$mySession->getDPC($customer_id) >= 1 &&
		// si l'user a renvoyé son formulaire d'inscription
		//$mySession->getRegistrationForm($customer_id) >= 1 &&
		// si l'user a un chèque de caution valide
		($customer->paycheck_IsValid() >= 2 || $mySession->type == 1 ) &&
		// si l'inscription de l'user est validée
		$mySession->getCustomerStatus($customer_id) == 2
		)
		{
			$app = new Quiz($mySession->app_form['id']);

			if($mySession->evaluation_type == "epp" || $mySession->evaluation_type == "app+epp")
			$epp = new Quiz($mySession->epp_form['id']);


			if($mySession->evaluation_type == "app" || $mySession->evaluation_type == "app+epp"){
				// si l'évaluation n'a pas été réalisée
				$titre='Étape 1 : Mon pré-test Analyse des pratiques professionnelles';
				if($app->countUserFormEntries($customer_id, $eval_index) == 0 ){
					if( isDateRangeValid($startdate, $enddate)  || current_user_can('administrator') )// si la date d'ouverture est atteinte ou que l'user est admin
					{
						$ph .= '<p><a href="/mon-compte/mes-sessions-dpc/?customer_id='.$customer_id.'&session_id='.$mySession->id.'&session_eval='.$eval_index.'&action=eval_show&eval_type=app&qcm_id='.$mySession->app_form['id'].'">Faire mon évaluation</a></p>';

					}
					else{
						$ph .= '<p><i>Elle sera disponible du '.getNiceDate($startdate).' à 00:00 au '.getNiceDate($enddate).' à 23h59</i></p>';
					}
				}
				else
				{
					$ph .= '<p>Déjà fait</p>';
				}
				$myAlert = new Alert($titre,$ph,'ico-qcm.svg','alert-main'); 
				$output .= $myAlert->get();
				unset($myAlert);
				$ph = null; 

			}
			if($mySession->evaluation_type == "epp" || $mySession->evaluation_type == "app+epp")
			{
				// si l'évaluation n'a pas été réalisée
				$titre = 'Étape 2 : Mon pré-test Évaluation des pratiques professionnelles '.$epp->countUserFormEntries($customer_id, $eval_index).' / '.$mySession->epp_number;
				if ($epp->countUserFormEntries($customer_id, $eval_index) < $mySession->epp_number){
					if( isDateRangeValid($startdate, $enddate)  || current_user_can('administrator') )// si la date d'ouverture est atteinte ou que l'user est admin
					{
						$ph = "Nous vous rappelons que cette évaluation est obligatoire pour pouvoir accéder à la formation.";
						$ph .= '<p><a class="btn btn-blue" href="/mon-compte/mes-sessions-dpc/?customer_id='.$customer_id.'&session_id='.$mySession->id.'&session_eval='.$eval_index.'&action=eval_show&eval_type=app&qcm_id='.$mySession->app_form['id'].'">Faire mon évaluation</a></p>';
					}
					else{
						$ph .= '<p><i>Elle sera disponible du '.getNiceDate($startdate).' à 00:00 au '.getNiceDate($enddate).' à 23h59</i></p>';
					}
				}
				else{
					$ph .= '<p>Déjà fait</p>';
				}
				$myAlert = new Alert($titre,$ph,'ico-qcm.svg','alert-main'); 
				$output .= $myAlert->get();
				return $output;
			}
		}
}
