<?php

function getSessionAlerts($session_id, $customer_id)
{
    $mySession = new Session($session_id);
    $output = "<div class='alert-wrapper'>";

    // 1. Message de confirmation après soumission QCM
    if (isset($_REQUEST['callback']) && $_REQUEST['callback'] === 'qcm_done') {
        $myAlert = new Alert(
            'Merci pour votre participation',
            '',
            'ico-valid.svg',
            'alert-main'
        );

        $output .= $myAlert->get();
        $output .= "</div>";
        return $output;
    }

    // 2. Si l'éval 1 n'est pas terminée, on n'affiche QUE la prochaine alerte liée à l'éval 1
    if ((int) $mySession->getCustomer_eval_1_status($customer_id) < 2) {
        $output .= getEval_Alert($session_id, $customer_id, 1);
        $output .= "</div>";
        return $output;
    }

    // 3. Si présence non encore validée, on bloque avant l'éval 2
    if ((int) $mySession->getCustomerAttendance($customer_id) < 2) {
        $myAlert = new Alert(
            'Votre présence à la session est en attente de validation',
            'Dès que votre présence aura été validée par nos équipes, vous pourrez accéder à la suite de votre parcours.',
            'ico-valid.svg',
            'warning'
        );

        $output .= $myAlert->get();
        $output .= "</div>";
        return $output;
    }

    // 4. Si l'éval 2 n'est pas terminée, on n'affiche QUE la prochaine alerte liée à l'éval 2
    if ((int) $mySession->getCustomer_eval_2_status($customer_id) < 2) {
        $output .= getEval_Alert($session_id, $customer_id, 2);
        $output .= "</div>";
        return $output;
    }

    // 5. Satisfaction optionnelle
    if ((int) $mySession->getCustomer_satisfaction_status($customer_id) < 2) {
        $ph = "En prenant quelques instants pour répondre à notre étude de satisfaction, nous pouvons améliorer continuellement la qualité de nos formations.";
        $ph .= '<p><a class="btn btn-turquoise" href="./?customer_id=' . $customer_id . '&post_id=' . $mySession->id . '&session_id=' . $mySession->session_id . '&satisfaction_eval=1&form_action=satisfaction_update&status=1">JE DONNE MON AVIS</a></p>';

        $myAlert = new Alert(
            'Votre avis nous intéresse',
            $ph,
            'ico-ampoule.png',
            'alert-main'
        );

        $output .= $myAlert->get();
        $output .= "</div>";
        return $output;
    }

    // 6. Tout est terminé
    $myAlert = new Alert(
        'Votre parcours est terminé',
        'Toutes les étapes obligatoires de votre session ont été complétées.',
        'ico-valid.svg',
        'success'
    );

    $output .= $myAlert->get();
    $output .= "</div>";
    return $output;
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

function getEval_Alert($session_id, $customer_id, $eval_index)
{
    $mySession = new Session($session_id);
    $customer  = new User($customer_id);
    $output    = '';

    $eval_type = strtolower(trim((string) $mySession->evaluation_type));
    $eval_type = str_replace(' ', '', $eval_type);

    $is_eval_1 = ((int) $eval_index === 1);

    $startdate = $is_eval_1 ? $mySession->eval_1_startdate : $mySession->eval_2_startdate;
    $enddate   = $is_eval_1 ? $mySession->eval_1_enddate   : $mySession->eval_2_enddate;

    $phase_label        = $is_eval_1 ? 'pré-formation' : 'post-formation';
    $phase_title_prefix = $is_eval_1 ? 'Avant votre formation' : 'Après votre formation';

    $app_enabled = ($eval_type === 'app' || $eval_type === 'app+epp');
    $epp_enabled = ($eval_type === 'epp' || $eval_type === 'app+epp');

    /*
    |--------------------------------------------------------------------------
    | 0. PRÉREQUIS AVANT TOUTE ÉVALUATION
    |--------------------------------------------------------------------------
    */

    // 0.1 - Inscription DPC manquante
    if ((int) $mySession->getDPC($customer_id) !== 1) {
        return getDPCAlert($session_id, $customer_id);
    }

    // 0.2 - Chèque / bulletin manquant (uniquement si présentiel)
    if ((int) $customer->paycheck_IsValid() !== 2 && (int) $mySession->type !== 1) {
        return getPaycheckAlert($session_id, $customer_id);
    }

    // 0.3 - Inscription en attente de validation admin
    if ((int) $mySession->getCustomerStatus($customer_id) !== 2) {
        $myAlert = new Alert(
            'Votre inscription est en cours de validation',
            "Votre dossier est complet. Vous serez prévenu par email dès que nos équipes auront validé votre inscription.",
            'ico-subscribe-orange.svg',
            'warning'
        );

        return $myAlert->get();
    }

    /*
    |--------------------------------------------------------------------------
    | 1. PARAMÈTRES DE PHASE
    |--------------------------------------------------------------------------
    */

    $app_done = true;
    $epp_done = true;

    $app_count = 0;
    $epp_count = 0;
    $epp_total = (int) $mySession->epp_number;

    $range_is_open = isDateRangeValid($startdate, $enddate) || current_user_can('administrator');

    $start_ts = strtotime($startdate);
    $end_ts   = strtotime($enddate);
    $now_ts   = strtotime('now');

    $range_has_not_opened = ($start_ts && $start_ts > $now_ts);
    $range_is_closed      = ($end_ts && $end_ts < $now_ts);

    if ($app_enabled && !empty($mySession->app_form['id'])) {
        $app = new Quiz($mySession->app_form['id']);
        $app_count = (int) $app->countUserFormEntries($customer_id, $eval_index, $mySession->id);
        $app_done = ($app_count >= 1);
    }

    if ($epp_enabled && !empty($mySession->epp_form['id'])) {
        $epp = new Quiz($mySession->epp_form['id']);
        $epp_count = (int) $epp->countUserFormEntries($customer_id, $eval_index, $mySession->id);
        $epp_done = ($epp_count >= $epp_total);
    }

    $phase_complete = $app_done && $epp_done;

    /*
    |--------------------------------------------------------------------------
    | 2. ALERTES APP / EPP INCOMPLÈTES
    |--------------------------------------------------------------------------
    */

    if ($app_enabled && !$app_done) {
        $title   = $phase_title_prefix . ' : complétez votre APP';
        $content = "L’analyse des pratiques professionnelles est obligatoire dans votre parcours DPC.";

        if ($range_is_open) {
            $url = '/mon-compte/mes-sessions-dpc/?customer_id=' . $customer_id
                . '&session_id=' . $mySession->id
                . '&session_eval=' . $eval_index
                . '&action=eval_show'
                . '&eval_type=app'
                . '&qcm_id=' . $mySession->app_form['id'];

            $content .= '<p><a class="btn btn-blue" href="' . $url . '">Faire mon APP ' . $phase_label . '</a></p>';
        } elseif ($range_has_not_opened) {
            $content .= '<p><i>Cette évaluation ouvrira le ' . getNiceDate($startdate) . '.</i></p>';
        } elseif ($range_is_closed) {
            $content .= '<p><i>Cette évaluation est clôturée depuis le ' . getNiceDate($enddate) . '.</i></p>';
        }

        $myAlert = new Alert(
            $title,
            $content,
            'ico-qcm.svg',
            'alert-main'
        );
        $output .= $myAlert->get();
    }

    if ($epp_enabled && !$epp_done) {
        $remaining = max(0, $epp_total - $epp_count);

        $title = $phase_title_prefix . ' : complétez votre EPP';
        $content = "Il vous reste <strong>" . $remaining . " cas"
            . ($remaining > 1 ? ' patients' : ' patient')
            . "</strong> à renseigner sur <strong>" . $epp_total . "</strong>.";

        if ($range_is_open) {
            $url = '/mon-compte/mes-sessions-dpc/?customer_id=' . $customer_id
                . '&session_id=' . $mySession->id
                . '&session_eval=' . $eval_index
                . '&action=eval_show'
                . '&eval_type=epp'
                . '&qcm_id=' . $mySession->epp_form['id'];

            $content .= '<p><a class="btn btn-blue" href="' . $url . '">Faire mon EPP ' . $phase_label . '</a></p>';
        } elseif ($range_has_not_opened) {
            $content .= '<p><i>Cette évaluation ouvrira le ' . getNiceDate($startdate) . '.</i></p>';
        } elseif ($range_is_closed) {
            $content .= '<p><i>Cette évaluation est clôturée depuis le ' . getNiceDate($enddate) . '.</i></p>';
        }

        $myAlert = new Alert(
            $title,
            $content,
            'ico-qcm.svg',
            'alert-main'
        );
        $output .= $myAlert->get();
    }

    /*
    |--------------------------------------------------------------------------
    | 3. CONFIRMATION SI PHASE TERMINÉE
    |--------------------------------------------------------------------------
    */

    if ($phase_complete) {

        if ($is_eval_1) {
            $formation_date = getNiceDate($mySession->startdate);

            $title   = 'Vos évaluations pré-formation ont bien été enregistrées';
            $content = 'Merci, vos évaluations pré-formation sont complètes.';
            $content .= '<p>Nous vous donnons rendez-vous pour votre formation présentielle le <strong>' . $formation_date . '</strong>.</p>';

            $myAlert = new Alert(
                $title,
                $content,
                'ico-valid.svg',
                'success'
            );
            $output .= $myAlert->get();
        } else {
            $title   = 'Vos évaluations post-formation ont bien été enregistrées';
            $content = 'Merci, vos évaluations post-formation sont complètes.';

            if ((int) $mySession->getCustomer_satisfaction_status($customer_id) < 2) {
                $url = './?customer_id=' . $customer_id
                    . '&post_id=' . $mySession->id
                    . '&session_id=' . $mySession->session_id
                    . '&satisfaction_eval=1'
                    . '&form_action=satisfaction_update'
                    . '&status=1';

                $content .= '<p>Vous pouvez maintenant compléter votre questionnaire de satisfaction.</p>';
                $content .= '<p><a class="btn btn-turquoise" href="' . $url . '">Je donne mon avis sur la formation</a></p>';
            } else {
                $content .= '<p>Votre questionnaire de satisfaction a déjà été complété.</p>';
            }

            $myAlert = new Alert(
                $title,
                $content,
                'ico-valid.svg',
                'success'
            );
            $output .= $myAlert->get();
        }
    }

    return $output;
}