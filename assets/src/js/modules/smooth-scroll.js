// =============================================================================
// スムーススクロール
// =============================================================================
// フェーズ1：jQuery置換済み

let isInitialized = false;

export function initSmoothScroll() {
  // 二重実行防止
  if (isInitialized) {
    return;
  }
  isInitialized = true;

  const offset = 100; // 上に空けたい余白(px)

  document.addEventListener('click', function (e) {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;

    const href = link.getAttribute('href');
    const targetId = href === '#' || href === '' ? 'html' : href;
    const target = document.querySelector(targetId);

    if (target) {
      e.preventDefault();
      const position = target.getBoundingClientRect().top + window.pageYOffset - offset;

      window.scrollTo({
        top: position,
        behavior: 'smooth'
      });
    }
  });
}

