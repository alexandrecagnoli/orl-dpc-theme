<div class="item">
    <div class="item-time"><?= $time; ?></div>
    <div class="item-content"><?= $content; ?>
    </div>

<?php if(isset($experts)) : ?>
    <div class="item-faculty">
    <?php
        foreach($experts as $expert)
            {
                echo "<div>";
                echo $expert['img'];
                echo "<p><span>".$expert['title']." ".$expert['firstname']." ".$expert['lastname']."</span><span>".$expert['role']."</span> ".$expert['speciality']."</p>";
                echo "</div>";
            }
    ?>
    </div>
<?php endif; ?>
</div>

