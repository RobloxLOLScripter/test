{{-- Velion - Auth page theming (Nuclear Reset) --}}
<style id="velion-auth-theme">
  /* 1. Reset Pterodactyl Layout */
  @if(!Auth::check())
    #app {
      background-color: var(--authBackground) !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      min-height: 100vh !important;
      width: 100vw !important;
      margin: 0 !important;
      padding: 20px !important;
      overflow: hidden !important;
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

    /* 2. Style the actual LoginFormContainer */
    div[class*="LoginFormContainer"],
    div[class*="LoginContainer"],
    form[class*="LoginContainer"] {
      display: block !important;
      background-color: var(--authPrimary) !important;
      border: 1px solid var(--authSecondary) !important;
      border-radius: 16px !important;
      padding: 40px !important;
      box-shadow: 0 24px 64px rgba(0,0,0,0.8), var(--orangeGlow) !important;
      width: 100% !important;
      max-width: 400px !important;
      margin: auto !important;
      z-index: 100 !important;
      box-sizing: border-box !important;
    }

    /* 3. Handle Header/Mascot */
    div[class*="LoginFormContainer"] > div:first-child,
    div[class*="LoginContainer"] > div:first-child {
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      margin-bottom: 24px !important;
    }

    h2, h1, [class*="header"] {
      color: white !important;
      font-size: 24px !important;
      font-weight: 700 !important;
      text-align: center !important;
      margin: 10px 0 !important;
    }

    img[class*="Mascot"] {
      max-height: 100px !important;
      width: auto !important;
      margin-bottom: 10px !important;
    }

    /* 4. Fix Inputs & Labels */
    div[class*="LoginFormContainer"] label,
    form[class*="LoginContainer"] label {
      display: block !important;
      color: #888 !important;
      font-size: 12px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      margin-bottom: 8px !important;
      margin-top: 16px !important;
    }

    div[class*="LoginFormContainer"] input,
    form[class*="LoginContainer"] input {
      background-color: var(--authSecondary) !important;
      border: 1px solid var(--authTertiary) !important;
      border-radius: 8px !important;
      color: white !important;
      padding: 12px 16px !important;
      width: 100% !important;
      box-sizing: border-box !important;
      transition: border-color 0.2s;
    }

    div[class*="LoginFormContainer"] input:focus,
    form[class*="LoginContainer"] input:focus {
      border-color: var(--authAccent) !important;
      outline: none !important;
    }

    /* 5. Fix Button */
    div[class*="LoginFormContainer"] button[type="submit"],
    form[class*="LoginContainer"] button[type="submit"] {
      background: var(--orangeGradient) !important;
      border: none !important;
      border-radius: 8px !important;
      color: white !important;
      font-weight: 700 !important;
      padding: 14px !important;
      width: 100% !important;
      margin-top: 24px !important;
      cursor: pointer !important;
      text-transform: uppercase !important;
      letter-spacing: 1px !important;
      box-shadow: 0 4px 12px rgba(255, 122, 0, 0.3) !important;
      transition: transform 0.2s;
    }

    div[class*="LoginFormContainer"] button[type="submit"]:hover,
    form[class*="LoginContainer"] button[type="submit"]:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(255, 122, 0, 0.5) !important;
    }

    /* 6. Fix Links */
    div[class*="LoginFormContainer"] a,
    form[class*="LoginContainer"] a {
      color: var(--authAccent) !important;
      text-decoration: none !important;
      font-size: 13px !important;
      display: inline-block !important;
      margin-top: 12px !important;
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
    background-color: rgba(0,0,0,0.5);
    @elseif($n_auth_background_appearance == "2")
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
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
