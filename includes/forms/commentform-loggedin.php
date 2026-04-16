<div id="comment-form">
    <?php
        $comments_args = array(

        'comment_notes_after' => '',
        'title_reply' => __( '' ),
        'title_reply_to' => __( '' ),
        'logged_in_as' => __( '<img src="'.get_template_directory_uri().'/images/default-avatar.png"/>' ),
        'comment_field'         => __( '<textarea placeholder="Laissez un message" class="emboss greygradient" name="comment" id="comment" cols="100%" rows="10" tabindex="4"/></textarea>' ),
        );
    
        comment_form($comments_args);
    ?>
</div>