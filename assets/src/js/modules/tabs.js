// =============================================================================
// タブ切り替え
// =============================================================================
// フェーズ1：jQuery置換済み

// タブコンテナ単位で初期化（複数タブ対応）
const initializedContainers = new Set();

/**
 * data属性の値を安全に取得（ハイフン/アンダースコア両対応）
 * - data-tab-target / data-tab_target のどちらでもOK
 */
function getDataValue(el, kebabName, underscoreName) {
  if (!el) return '';
  // 1) getAttribute で直接（最も確実）
  const v1 = el.getAttribute(kebabName);
  if (v1 && String(v1).trim() !== '') return String(v1).trim();
  const v2 = el.getAttribute(underscoreName);
  if (v2 && String(v2).trim() !== '') return String(v2).trim();

  // 2) dataset（念のため）
  // data-tab-target => dataset.tabTarget
  if (el.dataset && el.dataset.tabTarget && String(el.dataset.tabTarget).trim() !== '') {
    return String(el.dataset.tabTarget).trim();
  }
  // data-tab_target => dataset.tab_target（ブラウザによってはここに入る）
  if (el.dataset && el.dataset.tab_target && String(el.dataset.tab_target).trim() !== '') {
    return String(el.dataset.tab_target).trim();
  }

  return '';
}

function getTabKey(tabEl) {
  return getDataValue(tabEl, 'data-tab-target', 'data-tab_target');
}

function getPanelKey(panelEl) {
  return getDataValue(panelEl, 'data-tab-panel', 'data-tab_panel');
}

/**
 * タブコンテナを初期化
 * @param {HTMLElement} root - タブコンテナのルート要素
 */
function initTabContainer(root) {
  if (!root) return;

  // 既に初期化済みのコンテナはスキップ
  if (initializedContainers.has(root)) return;
  initializedContainers.add(root);

  const tabs = Array.from(root.querySelectorAll('[data-tab_target], [data-tab-target]'));
  const panels = Array.from(root.querySelectorAll('[data-tab_panel], [data-tab-panel]'));

  if (tabs.length === 0 || panels.length === 0) return;

  // 有効なタブ/パネルのみ抽出（キーが空のものは除外）
  const validTabs = tabs.filter(t => getTabKey(t));
  const validPanels = panels.filter(p => getPanelKey(p));

  // data属性が全滅ならここで止める（原因が即わかる）
  if (validTabs.length === 0 || validPanels.length === 0) {
    console.warn('[Tabs] 有効なdata属性が見つかりません。HTMLのdata属性名を確認してください。', {
      container: root,
      tabs: tabs.map(t => ({ el: t, tabKey: getTabKey(t) })),
      panels: panels.map(p => ({ el: p, panelKey: getPanelKey(p) })),
    });
    return;
  }

  // ✅ 初期アクティブ候補を「リセット前」に確保
  const preActiveTab =
    validTabs.find(t => t.classList.contains('is_active')) ||
    validTabs.find(t => t.getAttribute('aria-selected') === 'true') ||
    null;

  // 初期状態：タブ/パネルを全部リセット
  tabs.forEach(tab => {
    tab.classList.remove('is_active');
    tab.setAttribute('aria-selected', 'false');
  });

  panels.forEach(panel => {
    panel.classList.remove('is_active');
    panel.setAttribute('hidden', 'hidden');
  });

  // タブ切り替え処理
  function switchTab(tabElement) {
    const targetKey = getTabKey(tabElement);

    if (!targetKey) {
      console.warn('[Tabs] クリックされたタブのキーが取得できません（data-tab-target / data-tab_target を確認）', {
        element: tabElement,
        container: root
      });
      return;
    }

    // タブ切替
    tabs.forEach(tab => {
      tab.classList.remove('is_active');
      tab.setAttribute('aria-selected', 'false');
    });

    tabElement.classList.add('is_active');
    tabElement.setAttribute('aria-selected', 'true');

    // パネル切替（一致するキーだけ表示）
    panels.forEach(panel => {
      const panelKey = getPanelKey(panel);
      if (!panelKey) return;

      if (panelKey === targetKey) {
        panel.classList.add('is_active');
        panel.removeAttribute('hidden');
      } else {
        panel.classList.remove('is_active');
        panel.setAttribute('hidden', 'hidden');
      }
    });
  }

  // ✅ 初期表示：preActiveがあればそれ、なければ先頭タブ
  switchTab(preActiveTab || validTabs[0]);

  // イベント登録（有効タブのみ）
  validTabs.forEach(tab => {
    tab.addEventListener(
      'touchstart',
      function (ev) {
        if (ev.cancelable) ev.preventDefault();
        switchTab(this);
      },
      { passive: false }
    );

    tab.addEventListener('click', function (ev) {
      ev.preventDefault();
      switchTab(this);
    });
  });
}

export function initTabs() {
  const containers = document.querySelectorAll('[data-site_tabs], [data-site-tabs]');
  if (containers.length === 0) return;

  containers.forEach(container => initTabContainer(container));
}
