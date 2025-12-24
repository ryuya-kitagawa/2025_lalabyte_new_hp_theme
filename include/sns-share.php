<?php

/**
 * SNSシェアボタン
 */
$url = urlencode(get_permalink());
$title = urlencode(get_the_title());
?>
<div class="c-sns-share">
    <ul class="c-sns-share__list">
        <li class="c-sns-share__item --x">
            <a href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank" rel="nofollow noopener">X (Twitter)</a>
        </li>
        <li class="c-sns-share__item --fb">
            <a href="https://www.facebook.com/share.php?u=<?php echo $url; ?>" target="_blank" rel="nofollow noopener">Facebook</a>
        </li>
        <li class="c-sns-share__item --line">
            <a href="https://line.me/R/msg/text/?<?php echo $title; ?>%0A<?php echo $url; ?>" target="_blank" rel="nofollow noopener">LINE</a>
        </li>
    </ul>
</div>