<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$moduleBaseUrl = JURI::base() . 'modules/mod_rating_comment/';
$document->addScript($moduleBaseUrl . 'js/mod_rating_comment.js');
$userId = isset($displayData['userId']) ? $displayData['userId'] : $user->id;

?>

<?php if ($showRating && $ratings) : ?>
<div class="rating-container">
    <?php if ($ratings->count > 0) : ?>
        <p><?php echo JText::_('Average Rating:'); ?>
            <strong><?php echo round($ratings->average, 2); ?></strong>
            (<?php echo $ratings->count; ?> <?php echo JText::_('votes'); ?>)
        </p>

        <?php
        $avgRating = round($ratings->average, 2);
        $fullStars = floor($avgRating);
        $halfStar = ($avgRating - $fullStars >= 0.5) ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;
        ?>

        <div class="star-display">
            <?php for ($i = 0; $i < $fullStars; $i++) : ?>
                <span style="color: gold;">★</span>
            <?php endfor; ?>
            <?php if ($halfStar) : ?>
                <span style="color: gold;">☆</span>
            <?php endif; ?>
            <?php for ($i = 0; $i < $emptyStars; $i++) : ?>
                <span style="color: #ccc;">★</span>
            <?php endfor; ?>
        </div>

    <?php else : ?>
        <p><?php echo JText::_('No ratings yet.'); ?></p>
    <?php endif; ?>

    <style>
        .star-rating {
            direction: rtl;
            display: inline-flex;
            font-size: 2rem;
            unicode-bidi: bidi-override;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
        .star-display {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
    </style>

    <form id="rating-form">
        <div class="star-rating">
            <?php for ($i = 5; $i >= 1; $i--) : ?>
                <input type="radio" name="rating" value="<?php echo $i; ?>" id="star<?php echo $i; ?>">
                <label for="star<?php echo $i; ?>">★</label>
            <?php endfor; ?>
        </div>
        <br>
        <button type="button" onclick="submitRating()">Submit Rating</button>
        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
    </form>
</div>
<?php endif; ?>


<?php if ($showComments) : ?>
<div class="comments-container">
    <h3><?php echo JText::_('Comments'); ?></h3>
    <?php if ($comments) : ?>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <p><strong><?php echo $comment->name ?: JFactory::getUser($comment->user_id)->name; ?></strong> (<?php echo JHtml::_('date', $comment->comment_time); ?>)</p>
                <p><?php echo nl2br(htmlspecialchars($comment->comment)); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p><?php echo JText::_('No comments yet.'); ?></p>
    <?php endif; ?>
</div>

<div class="comment-form-container">
    <h3><?php echo JText::_('Leave a Comment'); ?></h3>
    <form id="comment-form">
        <?php if (!$user->id && $allowGuestComment) : ?>
            <p><input type="text" name="name" placeholder="<?php echo JText::_('Your Name'); ?>" required></p>
            <p><input type="email" name="email" placeholder="<?php echo JText::_('Your Email'); ?>" required></p>
        <?php endif; ?>
        <p><textarea name="comment" placeholder="<?php echo JText::_('Your Comment'); ?>" required></textarea></p>
        <button type="button" onclick="submitComment()">Submit Comment</button>
        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
    </form>
</div>
<?php endif; ?>
