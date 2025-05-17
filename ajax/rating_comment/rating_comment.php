<?php
// plugins/ajax/rating_comment/rating_comment.php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Response\JsonResponse;

class PlgAjaxRating_Comment extends CMSPlugin
{
    public function onAjaxRating_comment()
    {
        $app = Factory::getApplication();
        $input = $app->input;
        $method = $input->getCmd('method');

        switch ($method) {
            case 'saveRating':
                return $this->saveRating();

            case 'saveComment':
                return $this->saveComment();

            default:
                return new JsonResponse(false, 'Invalid method');
        }
    }

    protected function saveRating()
    {
        $input = Factory::getApplication()->input;
        $itemId = $input->getInt('item_id');
        $userId = $input->getInt('user_id');
        $rating = $input->getInt('rating');

        if (!$itemId || !$userId || !$rating) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data']);
        }

        require_once JPATH_SITE . '/modules/mod_rating_comment/helper.php';

        $result = ModRatingCommentHelper::saveRating($itemId, $userId, $rating);

        if ($result) {
            return new JsonResponse(['success' => true, 'message' => 'Rating saved']);
        } else {
            return new JsonResponse(['success' => false, 'message' => 'Failed to save rating']);
        }
    }

    protected function saveComment()
    {
        $input = Factory::getApplication()->input;
        $itemId = $input->getInt('item_id');
        $comment = $input->getString('comment', '', 'RAW');
        $name = $input->getString('name', '');
        $email = $input->getString('email', '');

        if (!$itemId || empty(trim($comment))) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data']);
        }

        require_once JPATH_SITE . '/modules/mod_rating_comment/helper.php';

        $user = Factory::getUser();
        $userId = $user->id ?: 0;

        $result = ModRatingCommentHelper::saveComment($itemId, $userId, $name, $email, $comment);

        if ($result) {
            return new JsonResponse(['success' => true, 'message' => 'Comment saved']);
        } else {
            return new JsonResponse(['success' => false, 'message' => 'Failed to save comment']);
        }
    }
}
