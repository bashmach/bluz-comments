<?php
/**
 * Example of Crud
 *
 * @author   Anton Shevchuk
 * @created  30.10.12 09:29
 */
namespace Application;

use Bluz;

return
/**
 * @privilege Management
 * @return \closure
 */
function() use ($view) {
    /**
     * @var Bluz\Application $this
     */
    $crud = new Comments\Setting\Crud();
    return $crud->processController();
};
