// =====================================================
// THEME V4 - PREMIUM INTERACTIVE EXPERIENCE
// Next-Generation JavaScript Enhancements
// =====================================================

(function() {
  'use strict';

  // ============ COUNTER ANIMATION ============
  function initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    const observerOptions = {
      threshold: 0.5,
      rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
          animateCounter(entry.target);
          entry.target.classList.add('counted');
        }
      });
    }, observerOptions);

    counters.forEach(counter => observer.observe(counter));
  }

  function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'), 10);
    const duration = 2500;
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        element.textContent = target.toLocaleString();
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(current).toLocaleString();
      }
    }, 16);
  }

  // ============ SMOOTH SCROLL ============
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
          e.preventDefault();
          const target = document.querySelector(href);
          const offsetTop = target.offsetTop - 100;
          
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  // ============ LAZY LOADING ============
  function initLazyLoading() {
    if ('IntersectionObserver' in window) {
      const images = document.querySelectorAll('img[data-src]');
      const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.getAttribute('data-src');
            img.removeAttribute('data-src');
            img.classList.add('loaded');
            imageObserver.unobserve(img);
          }
        });
      }, {
        rootMargin: '50px 0px'
      });

      images.forEach(img => imageObserver.observe(img));
    }
  }

  // ============ SCROLL ANIMATIONS ============
  function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('[data-animation], [data-delay]');
    
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    animatedElements.forEach(element => {
      observer.observe(element);
    });
  }

  // ============ NAVBAR SCROLL EFFECT ============
  function initNavbarScroll() {
    const navbar = document.querySelector('.header-area, .header-area-three');
    let lastScrollTop = 0;

    if (navbar) {
      window.addEventListener('scroll', function() {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (scrollTop > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
      }, { passive: true });
    }
  }

  // ============ ACTIVE LINK HIGHLIGHTING ============
  function initActiveLinks() {
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll('nav a');

    menuItems.forEach(item => {
      if (item.getAttribute('href') === currentLocation) {
        item.classList.add('active');
      }
    });
  }

  // ============ FORM VALIDATION ============
  function initFormValidation() {
    const forms = document.querySelectorAll('form:not(.subscriptionForm)');

    forms.forEach(form => {
      form.addEventListener('submit', function(e) {
        const inputs = this.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
          if (!input.value.trim()) {
            input.classList.add('error');
            isValid = false;
          } else {
            input.classList.remove('error');
          }
        });

        if (!isValid) {
          e.preventDefault();
          showNotification('Please fill out all required fields', 'error');
        }
      });
    });
  }

  // ============ SEARCH FORM ENHANCEMENT ============
  function initSearchForm() {
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
      const inputs = searchForm.querySelectorAll('input, select');
      
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
          if (!this.value) {
            this.parentElement.classList.remove('focused');
          }
        });
      });

      // Add smooth transitions
      inputs.forEach(input => {
        input.addEventListener('change', function() {
          this.style.borderColor = 'var(--primary)';
        });
      });
    }
  }

  // ============ BACK TO TOP BUTTON ============
  function initBackToTop() {
    const backToTopBtn = document.querySelector('.back-to-top a');
    
    if (backToTopBtn) {
      window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
          backToTopBtn.parentElement.style.display = 'flex';
        } else {
          backToTopBtn.parentElement.style.display = 'none';
        }
      }, { passive: true });

      backToTopBtn.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }
  }

  // ============ CARD HOVER EFFECTS ============
  function initCardHoverEffects() {
    const cards = document.querySelectorAll('.course-card, .blog-card, .instructor-card, .category-card');
    
    cards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.zIndex = '10';
      });

      card.addEventListener('mouseleave', function() {
        this.style.zIndex = '1';
      });
    });
  }

  // ============ NEWSLETTER FORM SUBMISSION ============
  function initNewsletterForm() {
    const form = document.querySelector('.subscriptionForm');
    if (form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[name="email"]');
        const submitBtn = this.querySelector('button[type="submit"]');
        
        if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
          showNotification('Please enter a valid email address', 'error');
          return;
        }

        // Show loading state
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Subscribing...';
        submitBtn.disabled = true;

        const formData = new FormData(this);
        
        fetch(this.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showNotification('✓ Thank you for subscribing!', 'success');
            email.value = '';
          } else {
            showNotification(data.message || 'An error occurred', 'error');
          }
        })
        .catch(error => {
          showNotification('An error occurred. Please try again.', 'error');
        })
        .finally(() => {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        });
      });
    }
  }

  // ============ NOTIFICATION SYSTEM ============
  function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
      <div class="notification-content">
        <span>${message}</span>
        <button class="notification-close">&times;</button>
      </div>
    `;

    document.body.appendChild(notification);

    // Add styles if not already present
    if (!document.querySelector('style[data-notification-styles]')) {
      const style = document.createElement('style');
      style.setAttribute('data-notification-styles', 'true');
      style.textContent = `
        .notification {
          position: fixed;
          top: 20px;
          right: 20px;
          min-width: 320px;
          padding: 16px 20px;
          border-radius: 12px;
          box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
          z-index: 9999;
          animation: slideInRight 0.3s ease;
          font-weight: 500;
        }
        .notification-success {
          background: linear-gradient(135deg, #10b981 0%, #059669 100%);
          color: white;
          border-left: 4px solid #10b981;
        }
        .notification-error {
          background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
          color: white;
          border-left: 4px solid #ef4444;
        }
        .notification-info {
          background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
          color: white;
          border-left: 4px solid #3b82f6;
        }
        .notification-content {
          display: flex;
          justify-content: space-between;
          align-items: center;
          gap: 16px;
        }
        .notification-close {
          background: none;
          border: none;
          color: white;
          cursor: pointer;
          font-size: 1.5rem;
          padding: 0;
          opacity: 0.8;
          transition: opacity 0.2s;
        }
        .notification-close:hover {
          opacity: 1;
        }
        @keyframes slideInRight {
          from {
            transform: translateX(400px);
            opacity: 0;
          }
          to {
            transform: translateX(0);
            opacity: 1;
          }
        }
        @media (max-width: 640px) {
          .notification {
            min-width: auto;
            width: calc(100% - 40px);
            left: 20px;
            right: 20px;
          }
        }
      `;
      document.head.appendChild(style);
    }

    const closeBtn = notification.querySelector('.notification-close');
    const closeNotification = () => {
      notification.style.animation = 'slideInRight 0.3s ease reverse';
      setTimeout(() => notification.remove(), 300);
    };

    closeBtn.addEventListener('click', closeNotification);
    setTimeout(closeNotification, 5000);
  }

  // ============ PARALLAX SCROLL EFFECT ============
  function initParallax() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    if (parallaxElements.length > 0) {
      window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        
        parallaxElements.forEach(element => {
          const speed = parseFloat(element.getAttribute('data-parallax')) || 0.5;
          element.style.transform = `translateY(${scrollY * speed}px)`;
        });
      }, { passive: true });
    }
  }

  // ============ INTERACTIVE BUTTON EFFECTS ============
  function initButtonEffects() {
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
      button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        ripple.style.position = 'absolute';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.width = '20px';
        ripple.style.height = '20px';
        ripple.style.background = 'rgba(255, 255, 255, 0.5)';
        ripple.style.borderRadius = '50%';
        ripple.style.pointerEvents = 'none';
        ripple.style.animation = 'ripple 0.6s ease-out';
        
        this.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
      });
    });

    // Add ripple animation if not present
    if (!document.querySelector('style[data-ripple-styles]')) {
      const style = document.createElement('style');
      style.setAttribute('data-ripple-styles', 'true');
      style.textContent = `
        .btn {
          position: relative;
          overflow: hidden;
        }
        @keyframes ripple {
          to {
            transform: scale(4);
            opacity: 0;
          }
        }
      `;
      document.head.appendChild(style);
    }
  }

  // ============ IMAGE LOADING ANIMATION ============
  function initImageLoadAnimation() {
    const images = document.querySelectorAll('img');
    
    images.forEach(img => {
      img.addEventListener('load', function() {
        this.classList.add('loaded');
      });

      if (img.complete) {
        img.classList.add('loaded');
      }
    });

    // Add image loading styles
    if (!document.querySelector('style[data-image-load-styles]')) {
      const style = document.createElement('style');
      style.setAttribute('data-image-load-styles', 'true');
      style.textContent = `
        img {
          opacity: 0;
          transition: opacity 0.4s ease;
        }
        img.loaded {
          opacity: 1;
        }
      `;
      document.head.appendChild(style);
    }
  }

  // ============ PERFORMANCE: DEBOUNCE FUNCTION ============
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  // ============ RESPONSIVE BEHAVIOR ============
  function initResponsiveBehavior() {
    const handleResize = debounce(() => {
      // Handle responsive changes
      const isMobile = window.innerWidth < 768;
      document.body.classList.toggle('is-mobile', isMobile);
    }, 250);

    window.addEventListener('resize', handleResize, { passive: true });
    handleResize();
  }

  // ============ PRELOADER ============
  function initPreloader() {
    const preloader = document.getElementById('preloader-v4');
    const legacyPreloader = document.getElementById('preloader');
    
    const hidePreloader = function() {
      if (preloader) {
        setTimeout(() => {
          preloader.classList.add('fade-out');
          setTimeout(() => {
            preloader.style.display = 'none';
          }, 600);
        }, 500);
      }
      
      if (legacyPreloader) {
        legacyPreloader.style.display = 'none';
      }
    };

    if (document.readyState === 'complete') {
      hidePreloader();
    } else {
      window.addEventListener('load', hidePreloader);
    }
  }

  // ============ INITIALIZE ALL FEATURES ============
  document.addEventListener('DOMContentLoaded', function() {
    // Core functionality
    initPreloader();
    initCounters();
    initSmoothScroll();
    initLazyLoading();
    initScrollAnimations();
    initNavbarScroll();
    initActiveLinks();
    initFormValidation();
    initSearchForm();
    initBackToTop();
    
    // Interactive enhancements
    initCardHoverEffects();
    initNewsletterForm();
    initParallax();
    initButtonEffects();
    initImageLoadAnimation();
    initResponsiveBehavior();

    console.log('✨ Theme V4 Premium Edition Initialized Successfully!');
  });

  // ============ EXPOSE UTILITIES ============
  window.ThemeV4 = {
    showNotification: showNotification,
    animateCounter: animateCounter,
    debounce: debounce
  };

})();
