<div class="openbtn4"><span></span><span></span><span></span></div>

<nav class="l-spnav">
    <ul class="lists">
        <li class="items">
            <a href="/" class="link">
                <p class="en">Home</p>
                <p class="ja">TOPへ</p>
            </a>
        </li>
        <li class="items">
            <a href="/about/" class="link">
                <p class="en">About</p>
                <p class="ja">Lalabyteについて</p>
            </a>
        </li>
        <li class="items has-children">
            <a href="/service/" class="link">
                <p class="en">Service</p>
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
                <p class="en">Work</p>
                <p class="ja">制作実績</p>
            </a>
        </li>
        <!-- <li class="items">
            <a href="/voice/" class="link">
                <p class="en">Voice</p>
                <p class="ja">お客様の声</p>
            </a>
        </li> -->
        <li class="items">
            <a href="/column/" class="link">
                <p class="en">Column</p>
                <p class="ja">コラム</p>
            </a>
        </li>
        <li class="items">
            <a href="/news/" class="link">
                <p class="en">News</p>
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

<nav class="l-nav <?= (!is_front_page() || !is_home()) ? '_white' : '' ?> __pc">
</nav>