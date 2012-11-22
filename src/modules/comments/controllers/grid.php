<?php
/**
 * Grid of comments
 *
 * @author   Pavel Machekhin
 * @created  21.11.12 16:47
 * @return closure
 */
namespace Application;

use Bluz;
use Application\Comments;

return
/**
 * @privilege Management
 * @return \closure
 */
function() use ($view, $module, $controller) {
    $this->getLayout()->setTemplate('dashboard.phtml');
    $this->getLayout()->breadCrumbs([
        $view->ahref('Dashboard', ['dashboard', 'index']),
        'Comments'
    ]);

    $grid = new Comments\Content\Grid;
    $grid->setModule($module);
    $grid->setController($controller);

    $view->grid = $grid;
};