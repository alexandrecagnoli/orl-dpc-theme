<?php

// Modification sur evaluation
add_action('wp', 'action_evaluation_update');
/*
function action_evaluation_update()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'evaluation_update') )
		{
			if( ! is_user_logged_in() )
			{
				wp_redirect( home_url( '/connexion' ), 302 );
				exit();
			}
			if ( is_user_logged_in() ) {
				if(isset($_REQUEST['status']))
				{
					// Getting variables
					$post_ID = $_REQUEST['session_id'];
					$customerId = $_REQUEST['customer_id'];
					$session_eval = $_REQUEST['session_eval'];
					$mySession = new Session($post_ID);

					// QCM préformation
					if($session_eval == 1)
					{
						$mySession->setCustomer_eval_1_status( $customerId, $_REQUEST['status']);
						if($_REQUEST['status'] == 1)
						{
							$mySession->setCustomer_eval_1_startdate( $customerId, time() );
						}
						if($_REQUEST['status'] == 2)
						{
							$mySession->setCustomer_eval_1_enddate( $customerId, time() );
						}
						$mySession->setCustomer_eval_2_status( $customerId, 0);
					}
					// QCM postformation
					elseif($session_eval == 2)
					{
						$mySession->setCustomer_eval_2_status( $customerId, $_REQUEST['status']);
						if($_REQUEST['status'] == 1)
						{
							$mySession->setCustomer_eval_2_startdate( $customerId, time() );
						}
						if($_REQUEST['status'] == 2)
						{
							$mySession->setCustomer_eval_2_enddate( $customerId, time() );
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
*/

function action_evaluation_update()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'evaluation_update') )
		{

			if(isset($_REQUEST['status']))
			{
				// Getting variables
				$post_ID = $_REQUEST['session_id'];
				$customerId = $_REQUEST['customer_id'];
				$session_eval = $_REQUEST['session_eval'];
				$mySession = new Session($post_ID);

				// QCM préformation
				if($session_eval == 1)
				{
					$mySession->setCustomer_eval_1_status( $customerId, $_REQUEST['status']);
					if($_REQUEST['status'] == 1)
					{
						$mySession->setCustomer_eval_1_startdate( $customerId, time() );
					}
					if($_REQUEST['status'] == 2)
					{
						$mySession->setCustomer_eval_1_enddate( $customerId, time() );
					}
					$mySession->setCustomer_eval_2_status( $customerId, 0);
				}
				// QCM postformation
				elseif($session_eval == 2)
				{
					$mySession->setCustomer_eval_2_status( $customerId, $_REQUEST['status']);
					if($_REQUEST['status'] == 1)
					{
						$mySession->setCustomer_eval_2_startdate( $customerId, time() );
					}
					if($_REQUEST['status'] == 2)
					{
						$mySession->setCustomer_eval_2_enddate( $customerId, time() );
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

