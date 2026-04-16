<?php 
add_action('wp', 'action_eval_show');
function action_eval_show()
{
	if( isset($_REQUEST['form_action']))
	{
		if(($_REQUEST['form_action'] == 'eval_show') )
		{
            if( isset( $_REQUEST['qcm_id'] ))
            {
                $html =  "debut ";
                $mySession = new Session($_REQUEST['session_id']);
                if($_REQUEST['session_eval'] == 1){
                    $html .= "ee";
                    $html .= gravity_form( $_REQUEST['qcm_id'], false, false, false, '', false );
                }  
                else{
                    $html .= "QCM terminés";
                }
                return $html;
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