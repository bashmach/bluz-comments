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
     * @param string $filter
     * @route /comments/grid/{$filter}
     * @privilege Management
     * @return \closure
     */
    function($filter) use ($view, $module, $controller) {
        $this->getLayout()->setTemplate('dashboard.phtml');
        $this->getLayout()->breadCrumbs([
            $view->ahref('Dashboard', ['dashboard', 'index']),
            'Comments'
        ]);

        $grid = new Comments\Content\Grid;
        $grid->setModule($module);
        $grid->setController($controller);

        $view->filter = $filter;
        $view->grid = $grid;
    };