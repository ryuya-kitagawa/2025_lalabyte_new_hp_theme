<nav class="l-nav <?= (!is_front_page() || !is_home()) ? '_white' : '' ?> __pc">
    <ul class="lists">
        <li class="items">
            <a href="/about/" class="link">
                <?php if (is_front_page() || is_home()) { ?><p class="en">About</p><?php } ?>
                <p class="ja">Lalabyteについて</p>
            </a>
        </li>
        <li class="items has-children">
            <a href="/service/" class="link">
                <?php if (is_front_page() || is_home()) { ?><p class="en">Service</p><?php } ?>
                <p class="ja">サービス一覧</p>
            </a>
            <ul class="child_lists">
                <li class="child_item">
                    <a href="/service/homepage/" class="link">
                        <p class="en">Homepage</p>
                        <p class="ja">ホームページ制作</p>
                    </a>
                </li>
                <li class="child_item">
                    <a href="/service/marketing/" class="link">
                        <p class="en">Marketing</p>
                        <p class="ja">マーケティング支援</p>
                    </a>
                </li>
                <li class="child_item">
                    <a href="/service/teaching/" class="link">
                        <p class="en">Teaching</p>
                        <p class="ja">プログラミング教室</p>
                    </a>
                </li>
                <li class="child_item">
                    <a href="/service/consulting/" class="link">
                        <p class="en">Consulting</p>
                        <p class="ja">DX支援・コンサル</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="items">
            <a href="/work/" class="link">
                <?php if (is_front_page() || is_home()) { ?><p class="en">Work</p><?php } ?>
                <p class="ja">制作実績</p>
            </a>
        </li>
        <!-- <li class="items">
            <a href="/voice/" class="link">
                <?php if (is_front_page() || is_home()) { ?><p class="en">Voice</p><?php } ?>
                <p class="ja">お客様の声</p>
            </a>
        </li> -->
        <li class="items">
            <a href="/column/" class="link">
                <?php if (is_front_page() || is_home()) { ?><p class="en">Column</p><?php } ?>
                <p class="ja">コラム</p>
            </a>
        </li>
        <li class="items">
            <a href="/news/" class="link">
                <?php if (is_front_page() || is_home()) { ?><p class="en">News</p><?php } ?>
                <p class="ja">お知らせ</p>
            </a>
        </li>
        <li class="items __cta">
            <a href="/contact/" class="link cta_btn">
                <i class="fa-solid fa-envelope"></i>
                <p class="ja">お問い合わせ</p>
            </a>
        </li>
    </ul>
</nav>