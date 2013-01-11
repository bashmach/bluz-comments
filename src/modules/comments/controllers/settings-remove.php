<?php
/**
 * Approve action for grid comments
 *
 * @author   Pavel Machekhin
 * @created  28.12.12 17:50
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
function() use ($view, $request) {
    if ($request->isPost()) {
        $this->useJson(true);

        $data = $request->getParam('data');

        $row = Comments\Setting\Table::getInstance()->findRowWhere(['id' => $data['id']]);

        if (!$row) {
            throw new \Exception('Unable to find such record');
        }

        $row->delete();

        $this->getMessages()->addSuccess("Row was removed");

        $view->_reload = true;
    } else {
        $view->row = Comments\Setting\Table::getInstance()->findRowWhere(['alias' => $request->getParam('alias')]);
    }
};