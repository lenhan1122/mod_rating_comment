<?php
defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$app = JFactory::getApplication();
$input = $app->input;

$itemId = $input->getInt('id'); // lấy ID bài viết hiện tại


$showRating = (bool) $params->get('show_rating', 1);
$showComments = (bool) $params->get('show_comments', 1);
$allowGuestComment = (bool) $params->get('allow_guest_comment', 0);

$input = JFactory::getApplication()->input;
$userId = $input->getInt('user_id', JFactory::getUser()->id); // Ưu tiên user_id từ URL nếu có

// Lấy đối tượng user tương ứng (nếu cần dùng thêm user info)
$user = JFactory::getUser($userId);


$ratings = ModRatingCommentHelper::getItemRatings($itemId);
$comments = ModRatingCommentHelper::getItemComments($itemId);

require JModuleHelper::getLayoutPath('mod_rating_comment', $params->get('layout', 'default'));
