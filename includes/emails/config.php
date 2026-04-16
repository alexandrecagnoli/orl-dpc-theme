<?php





function iti_user_mail($user_ID, $subject, $template, $vars)
{
  $customer = new User($user_ID);
  $to = $customer->email;
  $vars = $vars;
  $body = get_email_body($template, $vars);
  $subject = $subject;
  $headers = array('Content-Type: text/html; charset=UTF-8');
  wp_mail( $to, $subject, $body, $headers );
}


function get_email_body($template, $vars) {
  $url = TEMPLATEPATH;
  $url .= "/_emails/".$template.".php";
  $body = file_get_contents($url);
  foreach($vars as $key => $value)
  {
    $body = str_replace($key, $value, $body);
  }
  return $body;
}
