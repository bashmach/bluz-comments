<?php
/**
 * Approve action for grid comments
 *
 * @author   Pavel Machekhin
 * @created  13.12.12 13:18
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
    $this->useLayout(false);

    $data = $request->getParam('data');

    if (!is_array($data['id'])) {
        $data['id'] = array($data['id']);
    }

    /**
     * @var $row \Application\Comments\Content\Row
     */

    try {
        foreach ($data['id'] as $id) {
            $row = Comments\Content\Table::getInstance()->findRow($id);
            $row->changeStatus($data['status']);
        }

        $this->getMessages()->addSuccess('Status has been successfully changed.');
    } catch (Exception $e) {
        $view->errors[] = $e->getMessage();
    }

    $view->callback = 'refreshGrid';
    $view->status = 1;
};