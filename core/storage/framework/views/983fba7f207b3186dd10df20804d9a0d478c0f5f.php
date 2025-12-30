<div id="preloader-v4" class="preloader-v4">
  <div class="preloader-v4-container">
    <div class="preloader-v4-logo">
      <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="45" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
        <circle cx="50" cy="50" r="45" fill="none" stroke="url(#gradient-v4)" stroke-width="2" stroke-dasharray="140" stroke-dashoffset="0" class="preloader-ring"/>
      </svg>
    </div>
    <div class="preloader-v4-text">
      <span class="preloader-letter">L</span>
      <span class="preloader-letter">O</span>
      <span class="preloader-letter">A</span>
      <span class="preloader-letter">D</span>
      <span class="preloader-letter">I</span>
      <span class="preloader-letter">N</span>
      <span class="preloader-letter">G</span>
    </div>
    <div class="preloader-v4-dots">
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
  </div>
</div>

<style>
#preloader-v4 {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(24, 102, 212, 0.98) 0%, rgba(88, 12, 227, 0.98) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  opacity: 1;
  visibility: visible;
  transition: opacity 0.6s ease, visibility 0.6s ease;
}

#preloader-v4.fade-out {
  opacity: 0;
  visibility: hidden;
}

.preloader-v4-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
}

.preloader-v4-logo {
  position: relative;
  width: 120px;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.preloader-v4-logo svg {
  width: 100%;
  height: 100%;
  filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.3));
}

.preloader-ring {
  stroke-linecap: round;
  animation: spin-v4-ring 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
  transform-origin: 50% 50%;
}

@keyframes  spin-v4-ring {
  0% {
    stroke-dashoffset: 0;
    transform: rotate(0deg);
  }
  50% {
    stroke-dashoffset: 70;
  }
  100% {
    stroke-dashoffset: 140;
    transform: rotate(360deg);
  }
}

.preloader-v4-text {
  display: flex;
  gap: 4px;
  font-size: 18px;
  font-weight: 700;
  letter-spacing: 2px;
  color: white;
}

.preloader-letter {
  animation: bounce-v4 0.8s cubic-bezier(0.4, 0, 0.2, 1) infinite;
  display: inline-block;
}

.preloader-letter:nth-child(1) { animation-delay: 0s; }
.preloader-letter:nth-child(2) { animation-delay: 0.1s; }
.preloader-letter:nth-child(3) { animation-delay: 0.2s; }
.preloader-letter:nth-child(4) { animation-delay: 0.3s; }
.preloader-letter:nth-child(5) { animation-delay: 0.4s; }
.preloader-letter:nth-child(6) { animation-delay: 0.5s; }
.preloader-letter:nth-child(7) { animation-delay: 0.6s; }

@keyframes  bounce-v4 {
  0%, 100% {
    transform: translateY(0);
    opacity: 1;
  }
  50% {
    transform: translateY(-20px);
    opacity: 0.7;
  }
}

.preloader-v4-dots {
  display: flex;
  gap: 8px;
}

.preloader-v4-dots .dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
  animation: pulse-v4 1.4s ease-in-out infinite;
}

.preloader-v4-dots .dot:nth-child(1) { animation-delay: 0s; }
.preloader-v4-dots .dot:nth-child(2) { animation-delay: 0.2s; }
.preloader-v4-dots .dot:nth-child(3) { animation-delay: 0.4s; }

@keyframes  pulse-v4 {
  0%, 100% {
    transform: scale(0.8);
    opacity: 0.5;
  }
  50% {
    transform: scale(1.2);
    opacity: 1;
  }
}

svg {
  fill: none;
  stroke-width: 2;
}

defs {
  display: none;
}
</style>

<svg style="display: none;">
  <defs>
    <linearGradient id="gradient-v4" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color: #ff6b35; stop-opacity: 1"/>
      <stop offset="50%" style="stop-color: #ffb700; stop-opacity: 1"/>
      <stop offset="100%" style="stop-color: #1866d4; stop-opacity: 1"/>
    </linearGradient>
  </defs>
</svg>
<?php /**PATH C:\xampp\htdocs\addawwaamuun\core\resources\views/frontend/partials/preloader-v4.blade.php ENDPATH**/ ?>