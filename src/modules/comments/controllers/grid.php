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
    function() use ($request, $view, $module, $controller) {
        $this->getLayout()->setTemplate('dashboard.phtml');
        $this->getLayout()->breadCrumbs([
            $view->ahref('Dashboard', ['dashboard', 'index']),
            'Comments'
        ]);

        $alias = $request->getParam('comments-filter-alias', '');

        $view->settingFilterRow = Comments\Setting\Table::getInstance()->findRowWhere(['alias' => $alias]);
        $view->statusFilter = $request->getParam('comments-filter-status', Comments\Content\Row::FILTER_ALL);

        if ($request->isPost()) {
            $params = [];

            if (!empty($view->settingFilterRow)) {
                $params['comments-filter-alias'] = $view->settingFilterRow->alias;
            }

            if ($view->statusFilter !== Comments\Content\Row::FILTER_ALL) {
                $params['comments-filter-status'] = $view->statusFilter;
            }

            $this->redirectTo('comments', 'grid', $params);
        }

        $grid = new Comments\Content\Grid();
        $grid->setModule($module);
        $grid->setController($controller);

        $view->grid = $grid;
        $view->settingList = Comments\Setting\Table::getInstance()->fetchAliases();
    };