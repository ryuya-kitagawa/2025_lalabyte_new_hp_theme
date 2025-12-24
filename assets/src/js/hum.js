// =============================================================================
// hum.js - ハンバーガーメニュー
// =============================================================================

import { initHamburgerMenu } from './modules/hamburger-menu.js';

// 【重要】グローバルスコープへの変数漏洩を防ぐため、IIFEで包む
(() => {
  'use strict';

  // 初期化関数（複数回試行可能、最大5回まで）
  // 【重要】ビルド時の変数名圧縮による衝突を防ぐため、hamburger-menu.js の変数名と異なる名前にする
  let humInitAttempts = 0;
  const humMaxAttempts = 5;

  function humTryInit() {
    humInitAttempts++;
    const humOpenBtn = document.querySelector('.openbtn4');
    const humSpNav = document.querySelector('.l-spnav');
    
    if (humOpenBtn && humSpNav) {
      console.log('[Hamburger Menu] 要素が見つかりました。初期化を実行します。');
      initHamburgerMenu();
    } else if (humInitAttempts < humMaxAttempts) {
      console.warn(`[Hamburger Menu] 要素が見つかりません（試行 ${humInitAttempts}/${humMaxAttempts}）。再試行します...`, { openBtn: humOpenBtn, spNav: humSpNav });
      // 要素が見つからない場合、少し待ってから再試行
      setTimeout(humTryInit, 200);
    } else {
      console.error('[Hamburger Menu] 要素が見つかりませんでした。初期化を中止します。', { openBtn: humOpenBtn, spNav: humSpNav });
    }
  }

  // iOS Safari対応：確実に初期化
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', humTryInit);
  } else if (document.readyState === 'interactive' || document.readyState === 'complete') {
    // 既に読み込み済みの場合（iOS Safari対応のため少し遅延）
    // DOMContentLoadedが既に発火している可能性があるため、少し待ってから実行
    setTimeout(humTryInit, 50);
  } else {
    // その他の場合はDOMContentLoadedを待つ
    document.addEventListener('DOMContentLoaded', humTryInit);
  }
})();
