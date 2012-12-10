<?php
/**
 * @author   Pavel Machekhin
 * @created  07.12.12 09:48
 */
namespace Application;
return
    /**
     * @return \closure
     */
    function ($hash) {
        /**
         * @var \Bluz\Application $this
         */
        ?>
        <img src="http://www.gravatar.com/avatar/<?= md5($hash) ?>?s=48" alt="" />

        <?php
    }
?>
