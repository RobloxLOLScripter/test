{{-- Velion - Page transition animations --}}
<style>
  @if(isset($n_animations) && $n_animations == "fadeup")
  @keyframes velionFadeUp {
    from {
      opacity: 0;
      transform: translateY(12px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  div[id="app"] > div,
  div[class*="ContentContainer"],
  div[class*="content-wrapper"] {
    animation: velionFadeUp 0.3s ease-out;
  }
  @endif

  @if(isset($n_animations) && $n_animations == "fade")
  @keyframes velionFade {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  div[id="app"] > div {
    animation: velionFade 0.25s ease;
  }
  @endif

  /* Smooth sidebar transitions */
  .sidebarButton {
    transition: background-color 0.15s ease, transform 0.1s ease, border-color 0.15s ease;
  }
  .sidebarButton:active {
    transform: scale(0.97);
  }
</style>
