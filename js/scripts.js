/*!
 * Start Bootstrap - Stylish Portfolio v6.0.6 (https://startbootstrap.com/theme/stylish-portfolio)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-stylish-portfolio/blob/master/LICENSE)
 */
window.addEventListener('DOMContentLoaded', () => {
  const sidebarWrapper = document.getElementById('sidebar-wrapper');
  const menuToggle = document.querySelector('.menu-toggle');

  // sidebar와 버튼이 존재할 때만 실행
  if (sidebarWrapper && menuToggle) {
    menuToggle.addEventListener('click', (e) => {
      e.preventDefault();
      sidebarWrapper.classList.toggle('active');
      menuToggle.classList.toggle('active');
      _toggleMenuIcon();
    });

    // sidebar 내부에서 .js-scroll-trigger 클릭 시 sidebar 닫기
    const scrollTriggers =
      sidebarWrapper.querySelectorAll('.js-scroll-trigger');
    scrollTriggers.forEach((trigger) => {
      trigger.addEventListener('click', () => {
        sidebarWrapper.classList.remove('active');
        menuToggle.classList.remove('active');
        _toggleMenuIcon();
      });
    });
  }

  function _toggleMenuIcon() {
    if (!menuToggle) return;
    const icon = menuToggle.querySelector('i');
    if (!icon) return;
    if (icon.classList.contains('fa-bars')) {
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-xmark');
    } else {
      icon.classList.remove('fa-xmark');
      icon.classList.add('fa-bars');
    }
  }

  // 스크롤 투 탑 버튼
  let scrollToTopVisible = false;
  const scrollToTop = document.querySelector('.scroll-to-top');
  if (scrollToTop) {
    document.addEventListener('scroll', () => {
      if (document.documentElement.scrollTop > 100) {
        if (!scrollToTopVisible) {
          fadeIn(scrollToTop);
          scrollToTopVisible = true;
        }
      } else {
        if (scrollToTopVisible) {
          fadeOut(scrollToTop);
          scrollToTopVisible = false;
        }
      }
    });
  }

  function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
      if ((el.style.opacity -= 0.1) < 0) {
        el.style.display = 'none';
      } else {
        requestAnimationFrame(fade);
      }
    })();
  }
  function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || 'block';
    (function fade() {
      var val = parseFloat(el.style.opacity);
      if (!((val += 0.1) > 1)) {
        el.style.opacity = val;
        requestAnimationFrame(fade);
      }
    })();
  }
});
