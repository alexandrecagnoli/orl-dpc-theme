<?php
function my_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

     <div id="comment-<?php comment_ID(); ?>">

      <div class="comment-author-avatar">
         <?php echo get_avatar($comment,$size='36',$default='http://imagesmag.ziodev.fr/wp-content/themes/imagesmag.v1/images/default-avatar.png' ); ?>
      </div>

 
    <div class="comment-content">
        <div class="comment-meta">
            <span class="author-link"><?php comment_author_link(); ?></span> •
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
            <?php endif; ?>
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
            <?php edit_comment_link(__('(Edit)'),'  ','') ?>
        </div>
      <?php comment_text() ?>
 
        <div class="reply">
           <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>

     </div>
<?php
        }
?>