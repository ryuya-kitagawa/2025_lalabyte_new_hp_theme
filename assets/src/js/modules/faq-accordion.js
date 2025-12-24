// =============================================================================
// FAQアコーディオン
// =============================================================================
// フェーズ1：jQuery置換済み（CSS transitionでslideToggleを再現）

let isInitialized = false;

export function initFaqAccordion() {
  // 二重実行防止
  if (isInitialized) {
    return;
  }
  isInitialized = true;

  const questions = document.querySelectorAll('.c-faq__question');
  
  questions.forEach(question => {
    question.addEventListener('click', function () {
      const answer = this.nextElementSibling;
      if (!answer || !answer.classList.contains('c-faq__answer')) {
        return;
      }

      // 開閉状態をトグル
      const isOpen = this.classList.toggle('is-open');
      
      // アニメーション用のクラスを追加
      answer.classList.add('c-faq__answer--animating');
      
      if (isOpen) {
        // 開く：高さを取得してアニメーション
        answer.style.height = '0';
        answer.style.overflow = 'hidden';
        answer.style.display = 'block';
        const height = answer.scrollHeight;
        answer.style.height = height + 'px';
        
        // アニメーション完了後に高さをautoに
        setTimeout(() => {
          answer.style.height = 'auto';
          answer.style.overflow = '';
          answer.classList.remove('c-faq__answer--animating');
        }, 250);
      } else {
        // 閉じる：現在の高さから0へ
        answer.style.height = answer.scrollHeight + 'px';
        // リフローを強制
        answer.offsetHeight;
        answer.style.height = '0';
        
        setTimeout(() => {
          answer.style.display = 'none';
          answer.style.height = '';
          answer.classList.remove('c-faq__answer--animating');
        }, 250);
      }
    });
  });
}

