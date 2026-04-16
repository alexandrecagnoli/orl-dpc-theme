<?php

// Modification sur customeer
add_action('wp', 'action_subscription_confirm');

function action_subscription_confirm()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'subscription_confirm') )
		{
                }
        }
}