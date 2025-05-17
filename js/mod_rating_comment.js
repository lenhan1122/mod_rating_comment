function submitRating() {
    const rating = document.querySelector('input[name="rating"]:checked');
    const itemId = document.querySelector('#rating-form input[name="item_id"]').value;
    const userId = document.querySelector('#rating-form input[name="user_id"]').value;

    if (!rating) {
        alert('Please select a rating.');
        return;
    }

    fetch('index.php?option=com_ajax&plugin=rating_comment&method=saveRating&format=json', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `item_id=${encodeURIComponent(itemId)}&user_id=${encodeURIComponent(userId)}&rating=${encodeURIComponent(rating.value)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Thank you for your rating!');
            window.location.reload();
        } else {
            alert('Error submitting rating.');
        }
    })
    .catch(() => alert('Error submitting rating.'));
}

function submitComment() {
    const itemId = document.querySelector('#comment-form input[name="item_id"]').value;
    const comment = document.querySelector('#comment-form textarea[name="comment"]').value;

    // Check if guest comment fields exist
    let name = '';
    let email = '';
    const nameInput = document.querySelector('#comment-form input[name="name"]');
    const emailInput = document.querySelector('#comment-form input[name="email"]');
    if (nameInput) name = nameInput.value;
    if (emailInput) email = emailInput.value;

    if (!comment.trim()) {
        alert('Please enter a comment.');
        return;
    }

    let body = `item_id=${encodeURIComponent(itemId)}&comment=${encodeURIComponent(comment)}`;
    if (name) body += `&name=${encodeURIComponent(name)}`;
    if (email) body += `&email=${encodeURIComponent(email)}`;

    fetch('index.php?option=com_ajax&plugin=rating_comment&method=saveComment&format=json', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Thank you for your comment!');
            window.location.reload();
        } else {
            alert('Error submitting comment.');
        }
    })
    .catch(() => alert('Error submitting comment.'));
}
