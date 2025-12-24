// =============================================================================
// slider.js - 無限スクロールスライダー
// =============================================================================
// フェーズ3：jQuery置換完了（DOM API版）

(function () {
	'use strict';

	// 二重初期化防止フラグ
	let isInitialized = false;

	window.addEventListener('load', function () {
		const sliderList = document.querySelector('.slider-list');
		
		// sliderが存在しないページでは何もしない
		if (!sliderList) {
			return;
		}

		// 既に初期化済みの場合は何もしない
		if (isInitialized) {
			return;
		}
		isInitialized = true;

		// prefers-reduced-motion を尊重
		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (prefersReducedMotion) {
			return;
		}

		const duration = 20000; // 20秒

		// HTMLを複製（無限ループ用）
		sliderList.insertAdjacentHTML('beforeend', sliderList.innerHTML);

		/**
		 * リストの総幅を計算
		 * @returns {number} 総幅（px）
		 */
		function calculateListWidth() {
			let totalWidth = 0;
			const items = sliderList.querySelectorAll('li');
			
			items.forEach(function (item) {
				const rect = item.getBoundingClientRect();
				const style = window.getComputedStyle(item);
				const marginLeft = parseFloat(style.marginLeft) || 0;
				const marginRight = parseFloat(style.marginRight) || 0;
				totalWidth += rect.width + marginLeft + marginRight;
			});

			sliderList.style.width = totalWidth + 'px';
			return totalWidth;
		}

		const totalWidth = calculateListWidth();
		const originalWidth = totalWidth / 2;

		// アニメーション制御用の変数
		let animationId = null;

		/**
		 * margin-leftを設定
		 */
		function setMarginLeft(value) {
			sliderList.style.marginLeft = value + 'px';
		}

		/**
		 * 現在のmargin-leftを取得
		 */
		function getCurrentMargin() {
			const style = window.getComputedStyle(sliderList);
			return parseFloat(style.marginLeft) || 0;
		}

		/**
		 * アニメーションを停止
		 */
		function stopAnimation() {
			if (animationId !== null) {
				cancelAnimationFrame(animationId);
				animationId = null;
			}
		}

		/**
		 * スクロールアニメーション開始
		 * @param {number} startMarginValue - 開始位置（省略時は現在位置）
		 * @param {number} targetMarginValue - 目標位置（省略時は-originalWidth）
		 * @param {number} durationMs - アニメーション時間（省略時はduration）
		 */
		function startScrolling(startMarginValue, targetMarginValue, durationMs) {
			stopAnimation();

			const startMargin = startMarginValue !== undefined ? startMarginValue : getCurrentMargin();
			const targetMargin = targetMarginValue !== undefined ? targetMarginValue : -originalWidth;
			const animDuration = durationMs !== undefined ? durationMs : duration;
			const startTime = performance.now();

			function animate(currentTime) {
				const elapsed = currentTime - startTime;
				const progress = Math.min(elapsed / animDuration, 1);
				
				const currentMargin = startMargin + (targetMargin - startMargin) * progress;
				setMarginLeft(currentMargin);

				if (progress < 1) {
					animationId = requestAnimationFrame(animate);
				} else {
					// アニメーション完了：リセットして再開
					setMarginLeft(0);
					startScrolling();
				}
			}

			animationId = requestAnimationFrame(animate);
		}

		// マウスホバー時の制御
		sliderList.addEventListener('mouseenter', function () {
			// 停止（jQueryのstop(true)に相当）
			stopAnimation();
		});

		sliderList.addEventListener('mouseleave', function () {
			// 現在位置から残りの距離を計算して再開
			const currentMargin = getCurrentMargin();
			const remainingDistance = -originalWidth - currentMargin;
			const remainingDuration = duration * (remainingDistance / -originalWidth);

			// 残り時間でアニメーション再開
			startScrolling(currentMargin, -originalWidth, remainingDuration);
		});

		// 初期アニメーション開始
		startScrolling(0, -originalWidth, duration);
	});
})();
