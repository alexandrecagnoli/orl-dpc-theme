<?php





// Function to query posts using taxonomy terms
function query_posts_by_terms($type,$tax,$field,$terms,$perpage)
{
 $args = array(
            'post_type' => $type,
            'posts_per_page'=>'9999',
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'field' => $field,
                    'terms' => $terms 
                )
            )
        );

        query_posts($args);
}