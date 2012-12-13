<?php
/**
 * @author   Pavel Machekhin
 * @created  13.12.12 12:56
 */
namespace Application;
use Symfony\Component\Console\Application;

return
    /**
     * @return \closure
     */
    function ($status) {
        switch ($status) {
            case Comments\Content\Row::STATUS_APPROVED:
                $labelClass = 'label-success';
                break;
            case Comments\Content\Row::STATUS_SPAM:
                $labelClass = 'label-warning';
                break;
            case Comments\Content\Row::STATUS_DELETED:
                $labelClass = 'label-important';
                break;
            case Comments\Content\Row::STATUS_PENDING:
            default:
                $labelClass = '';
                break;
        }

        /**
         * @var \Bluz\Application $this
         */
        ?>
    <span class="label <?=$labelClass?>"><?=$status?></span>

    <?php
    }
?>
