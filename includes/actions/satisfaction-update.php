<?php

// Modification sur evaluation
add_action('wp', 'action_satisfaction_update');

function action_satisfaction_update()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'satisfaction_update') )
		{

			if(isset($_REQUEST['status']))
			{
				// Getting variables
				$post_ID = $_REQUEST['post_id'];
				$session_ID = $_REQUEST['session_id'];
				$customerId = $_REQUEST['customer_id'];
				$mySession = new Session($session_ID);
				$mySession->setCustomer_satisfaction_status( $customerId, $_REQUEST['status']);
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
