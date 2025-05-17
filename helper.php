<?php
defined('_JEXEC') or die;

abstract class ModRatingCommentHelper
{
    public static function getItemRatings($itemId)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('AVG(rating) AS average, COUNT(*) AS count')
            ->from($db->quoteName('#__module_rating_stars'))
            ->where($db->quoteName('item_id') . ' = ' . (int) $itemId);
        $db->setQuery($query);
        return $db->loadObject();
    }

    public static function getItemComments($itemId)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__module_rating_comments'))
            ->where($db->quoteName('item_id') . ' = ' . (int) $itemId)
            ->where($db->quoteName('published') . ' = 1')
            ->order($db->quoteName('comment_time') . ' DESC');
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    public static function saveRating($itemId, $userId, $rating)
    {
        if ($rating < 1 || $rating > 5) {
            return false;
        }

        $db = JFactory::getDbo();

        // Optional: kiểm tra user đã đánh giá chưa (cập nhật hoặc insert)
        $query = $db->getQuery(true)
            ->select('id')
            ->from($db->quoteName('#__module_rating_stars'))
            ->where($db->quoteName('item_id') . ' = ' . (int) $itemId)
            ->where($db->quoteName('user_id') . ' = ' . (int) $userId);
        $db->setQuery($query);
        $existing = $db->loadResult();

        if ($existing) {
            // Cập nhật rating cũ
            $query = $db->getQuery(true)
                ->update($db->quoteName('#__module_rating_stars'))
                ->set($db->quoteName('rating') . ' = ' . (int) $rating)
                ->set($db->quoteName('rating_time') . ' = NOW()')
                ->where('id = ' . (int) $existing);
        } else {
            // Thêm rating mới
            $columns = ['item_id', 'user_id', 'rating', 'rating_time'];
            $values = [
                (int) $itemId,
                (int) $userId,
                (int) $rating,
                'NOW()'
            ];
            $query = $db->getQuery(true)
                ->insert($db->quoteName('#__module_rating_stars'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));
        }

        $db->setQuery($query);

        try {
            $db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function saveComment($itemId, $userId, $name, $email, $comment)
    {
        if (empty(trim($comment))) {
            return false;
        }

        $db = JFactory::getDbo();
        $columns = ['item_id', 'user_id', 'name', 'email', 'comment', 'comment_time', 'published'];
        $values = [
            (int) $itemId,
            (int) $userId,
            $db->quote($name),
            $db->quote($email),
            $db->quote($comment),
            'NOW()',
            1
        ];

        $query = $db->getQuery(true)
            ->insert($db->quoteName('#__module_rating_comments'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        $db->setQuery($query);

        try {
            $db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
