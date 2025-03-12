const init = () => {
  const mobileMenuButton = document.querySelector('[data-header-toggle-menu]');
  const mobileMenu = document.querySelector('[data-header-mobile-menu]');
  const subMenus = document.querySelectorAll('[data-header-submenu]');
  const mobileUserMenuButton = document.querySelector('[data-header-toggle-user-menu]');
  const mobileUserMenu = document.querySelector('[data-header-user-menu]');
  const sculappHeader = document.querySelector('[data-sculapp-header]');
  
  [...subMenus].forEach(subMenu => {
    const subMenuChild = subMenu.querySelector('div');
    if (subMenuChild) {
      subMenu.querySelector('a').addEventListener('click', (e) => {
        e.stopPropagation();
        e.preventDefault();
        subMenuChild.classList.toggle('hidden');
      });
    }
  });
  
  const closeMobileMenu = () => {
    if (mobileMenu) {
      mobileMenu.classList.add('hidden');
    }
  }

  const closeUserMenu = () => {
    if (mobileUserMenu) {
      mobileUserMenu.classList.add('invisible');
    }
  }

  const clickOutside = (e) => {
    if (mobileUserMenu && !mobileUserMenu.contains(e.target)) {
      closeUserMenu();
      window.removeEventListener('click', clickOutside);
    } 
    
    if(mobileMenu && !mobileMenu.contains(e.target)) {
      closeMobileMenu();
      window.removeEventListener('click', clickOutside);
    }
  };

  if (mobileMenuButton) {
    mobileMenuButton.addEventListener('click', (e) => {
      if (mobileMenu) {
        mobileMenu.classList.toggle('hidden');
        closeUserMenu();
        if (!mobileMenu.classList.contains('hidden')) {
          e.stopPropagation();
          window.addEventListener('click', clickOutside);
        }
      }
    });
  }

  if (mobileUserMenuButton) {
    mobileUserMenuButton.addEventListener('click', (e) => {
      if (mobileUserMenu) {
        closeMobileMenu();
        mobileUserMenu.classList.toggle('invisible');
        if (!mobileUserMenu.classList.contains('invisible')) {
          e.stopPropagation();
          window.addEventListener('click', clickOutside);
        }
      }
    });
  }

  if (sculappHeader) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 0) {
        sculappHeader.classList.add('shadow-md');
      } else {
        sculappHeader.classList.remove('shadow-md');
      }
    });
  }
  if (subMenus.length > 0) {
    window.addEventListener('resize', () => {
      [...subMenus].forEach(subMenu => {
        const subMenuChild = subMenu.querySelector('div');
        if (subMenuChild) {
          subMenuChild.classList.add('hidden');
        }
      });
    });
  }
}

export default {
  init: init
};