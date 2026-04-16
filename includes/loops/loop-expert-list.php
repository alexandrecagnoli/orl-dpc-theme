<?php

$i=0;

foreach($members as $member)
{ 
    

$member_img = my_expert_img($member['ID']);


$experts[$i] = array(
"title"  => get_field('team_member_title', $member['ID']),
"lastname"  => get_field('team_member_lastname', $member['ID']),
"firstname" => get_field('team_member_firstname', $member['ID']),
"img" => $member_img,
"speciality" => get_field('team_member_speciality', $member['ID']),
"role" => $member['role']
);
$i++;
}

foreach($experts as $expert)
{
    echo "<div>";
    echo $expert['img'];
    echo "<p><span>".$expert['title']." ".$expert['firstname']." ".$expert['lastname']."</span><span>".$expert['role']."</span> ".$expert['speciality']."</p>";
    echo "</div>";
}