{{-- Velion - Auth page theming (Nuclear Reset v2) --}}
<style id="velion-auth-theme">
  /* 1. Reset Pterodactyl Layout */
  @if(!Auth::check())
    #app {
      background-color: var(--authBackground) !important;
      display: flex !important;
      flex-direction: column !important; /* Stack vertically to prevent side-by-side squashing */
      align-items: center !important;
      justify-content: center !important;
      min-height: 100vh !important;
      width: 100vw !important;
      margin: 0 !important;
      padding: 20px !important;
      overflow-x: hidden !important;
    }

    /* Kill all Pterodactyl wrapper divs that might have styles */
    #app > div,
    #app > div > div,
    #app > div > div > div {
      display: contents !important;
      background: none !important;
      border: none !important;
      box-shadow: none !important;
    }

    /* Hide the default "Login to Continue" text */
    #app h2, #app h1:not(.velion-brand) {
      display: none !important;
    }

    /* 2. Style the actual LoginFormContainer */
    div[class*="LoginFormContainer"],
    div[class*="LoginContainer"],
    form[class*="LoginContainer"] {
      display: flex !important;
      flex-direction: column !important;
      background-color: var(--authPrimary) !important;
      border: 1px solid var(--authSecondary) !important;
      border-radius: 16px !important;
      padding: 40px !important;
      box-shadow: 0 24px 64px rgba(0,0,0,0.8), var(--orangeGlow) !important;
      width: 400px !important; /* Fixed width */
      max-width: 90vw !important;
      min-width: 320px !important; /* Prevent squashing */
      margin: 0 auto !important;
      z-index: 100 !important;
      box-sizing: border-box !important;
      flex-shrink: 0 !important;
    }

    /* Add VELION Brand */
    div[class*="LoginFormContainer"]::before,
    div[class*="LoginContainer"]::before,
    form[class*="LoginContainer"]::before {
      content: "VELION";
      display: block;
      width: 100%;
      text-align: center;
      font-size: 32px;
      font-weight: 900;
      letter-spacing: 4px;
      background: var(--orangeGradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 10px;
      filter: drop-shadow(0 0 10px rgba(255, 122, 0, 0.3));
    }

    /* 3. Handle Header/Mascot */
    div[class*="LoginFormContainer"] > div:first-child,
    div[class*="LoginContainer"] > div:first-child {
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      margin-bottom: 24px !important;
    }

    img[class*="Mascot"] {
      max-height: 80px !important;
      width: auto !important;
      margin-bottom: 0 !important;
    }

    /* 4. Fix Inputs & Labels */
    div[class*="LoginFormContainer"] label,
    form[class*="LoginContainer"] label {
      display: block !important;
      color: #888 !important;
      font-size: 11px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      margin-bottom: 8px !important;
      margin-top: 16px !important;
      letter-spacing: 0.5px;
    }

    div[class*="LoginFormContainer"] input,
    form[class*="LoginContainer"] input {
      background-color: var(--authSecondary) !important;
      border: 1px solid var(--authTertiary) !important;
      border-radius: 8px !important;
      color: white !important;
      padding: 14px 16px !important;
      width: 100% !important;
      box-sizing: border-box !important;
      transition: all 0.2s;
    }

    div[class*="LoginFormContainer"] input:focus,
    form[class*="LoginContainer"] input:focus {
      border-color: var(--authAccent) !important;
      background-color: var(--authTertiary) !important;
      outline: none !important;
      box-shadow: 0 0 0 2px rgba(255, 122, 0, 0.2) !important;
    }

    /* 5. Fix Button */
    div[class*="LoginFormContainer"] button[type="submit"],
    form[class*="LoginContainer"] button[type="submit"] {
      background: var(--orangeGradient) !important;
      border: none !important;
      border-radius: 8px !important;
      color: white !important;
      font-weight: 800 !important;
      padding: 16px !important;
      width: 100% !important;
      margin-top: 30px !important;
      cursor: pointer !important;
      text-transform: uppercase !important;
      letter-spacing: 2px !important;
      box-shadow: 0 8px 20px rgba(255, 122, 0, 0.3) !important;
      transition: all 0.3s ease;
    }

    div[class*="LoginFormContainer"] button[type="submit"]:hover,
    form[class*="LoginContainer"] button[type="submit"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 25px rgba(255, 122, 0, 0.5) !important;
    }

    /* 6. Fix Links */
    div[class*="LoginFormContainer"] a,
    form[class*="LoginContainer"] a {
      color: var(--authAccent) !important;
      text-decoration: none !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      display: inline-block !important;
      margin-top: 15px !important;
      text-align: center !important;
      width: 100% !important;
    }
  @endif

  /* Wallpaper & Backdrop */
  .velion-auth-wallpaper {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -2;
    background-color: var(--authBackground);
    @if($n_auth_background_image != "")
    background-image: url('{{ $n_auth_background_image }}');
    background-size: cover;
    background-position: center;
    @endif
  }

  .velion-auth-backdrop {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -1;
    @if($n_auth_background_appearance == "1")
    background-color: rgba(0,0,0,0.7);
    @elseif($n_auth_background_appearance == "2")
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    background-color: rgba(0,0,0,0.4);
    @endif
  }

  /* Watermark */
  .velion-watermark {
    position: fixed;
    bottom: 20px;
    right: 24px;
    z-index: 5;
    font-size: 13px;
    color: rgba(255,255,255,0.3);
  }
  .velion-watermark a { text-decoration: none; color: rgba(255,255,255,0.4); }
  .watermark-highlight { color: var(--authAccent); font-weight: 600; }
</style>
