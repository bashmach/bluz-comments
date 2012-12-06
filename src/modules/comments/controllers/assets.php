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
 * @param string $filepath
 * @param string $type
 * @route /assets/comments/{$filepath}.{$type}
 * @return \closure
 */
function($filepath, $type) use ($view, $module, $controller) {
    $this->useLayout(false);

    $src = PATH_LIBRARY . DIRECTORY_SEPARATOR
        . 'bashmach' . DIRECTORY_SEPARATOR
        . 'bluz-comments' . DIRECTORY_SEPARATOR
        . 'assets' . DIRECTORY_SEPARATOR
        . $type . DIRECTORY_SEPARATOR
        . $filepath . '.' . $type;

    switch ($type) {
        case 'css':
            $contentType = 'Content-Type: text/css';
            break;
        case 'js':
            $contentType = 'Content-Type: text/javascript';
            break;
        default:
            break;
    }

    if (!is_file($src)) {
        throw new Exception("Asset $src not found", 404);
    }

    header($contentType);

    echo file_get_contents($src);
};