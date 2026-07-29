{{-- Velion - Minimal styling for default Pterodactyl Login Page --}}
<style id="velion-auth-theme">
  body {
    background-color: var(--trueBlack) !important;
  }

  /* Default Pterodactyl Login Card */
  div[class*="LoginFormContainer"],
  div.bg-neutral-900.shadow-xl,
  div.bg-neutral-800.shadow-xl {
    background-color: var(--deepBlack) !important;
    border: 1px solid var(--surfaceBlack) !important;
    border-radius: 12px !important;
  }

  /* Inputs */
  input {
    background-color: var(--surfaceBlack) !important;
    border: 1px solid #1a1a1a !important;
    color: white !important;
  }
  input:focus {
    border-color: var(--accentOrange) !important;
  }

  /* Button */
  button[type="submit"],
  button.bg-blue-600 {
    background: var(--orangeGradient) !important;
    border: none !important;
    color: white !important;
    font-weight: 600 !important;
  }
  button[type="submit"]:hover {
    filter: brightness(1.1);
  }

  /* Labels and text */
  label, p, span, a {
    color: #e2e8f0 !important;
  }
  a:hover {
    color: var(--accentOrange) !important;
  }
</style>
