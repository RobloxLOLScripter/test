{{-- Velion - Auth page theming (Modern Minimalist) --}}
<style id="velion-auth-theme">
  /* 1. Root & Centering */
  @if(!Auth::check())
    #app {
      background-color: #050505 !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      min-height: 100vh !important;
      width: 100vw !important;
      margin: 0 !important;
      padding: 20px !important;
      font-family: 'Inter', sans-serif !important;
    }

    /* Kill Pterodactyl wrappers to allow root centering */
    #app > div,
    #app > div > div,
    #app > div > div > div {
      display: contents !important;
    }

    /* 2. Login Card Container */
    div[class*="LoginFormContainer"],
    div[class*="LoginContainer"],
    form[class*="LoginContainer"] {
      display: block !important;
      background-color: #0a0a0a !important;
      border: 1px solid #1a1a1a !important;
      border-radius: 12px !important;
      padding: 40px !important;
      box-shadow: 0 10px 25px rgba(0,0,0,0.5) !important;
      width: 100% !important;
      max-width: 400px !important;
      box-sizing: border-box !important;
      transition: box-shadow 0.3s ease;
    }

    /* 3. Branding (Minimalist) */
    div[class*="LoginFormContainer"]::before,
    div[class*="LoginContainer"]::before,
    form[class*="LoginContainer"]::before {
      content: "VELION";
      display: block;
      width: 100%;
      text-align: center;
      font-size: 24px;
      font-weight: 800;
      letter-spacing: 2px;
      color: #ff8c00;
      margin-bottom: 30px;
    }

    /* Hide redundant Pterodactyl headers */
    #app h2, #app h1 {
      display: none !important;
    }

    /* 4. Labels & Inputs */
    div[class*="LoginFormContainer"] label,
    form[class*="LoginContainer"] label {
      display: block !important;
      color: #94a3b8 !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      margin-bottom: 8px !important;
      margin-top: 20px !important;
    }

    div[class*="LoginFormContainer"] input,
    form[class*="LoginContainer"] input {
      background-color: #111111 !important;
      border: 1px solid #1a1a1a !important;
      border-radius: 8px !important;
      color: #ffffff !important;
      padding: 12px 16px !important;
      width: 100% !important;
      box-sizing: border-box !important;
      font-size: 14px !important;
      transition: all 0.2s ease;
    }

    div[class*="LoginFormContainer"] input:focus,
    form[class*="LoginContainer"] input:focus {
      border-color: #ff8c00 !important;
      background-color: #161616 !important;
      outline: none !important;
      box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.15) !important;
    }

    /* 5. Submit Button */
    div[class*="LoginFormContainer"] button[type="submit"],
    form[class*="LoginContainer"] button[type="submit"] {
      background-color: #ff8c00 !important;
      background-image: none !important;
      border: none !important;
      border-radius: 8px !important;
      color: #ffffff !important;
      font-weight: 700 !important;
      padding: 14px !important;
      width: 100% !important;
      margin-top: 30px !important;
      cursor: pointer !important;
      font-size: 14px !important;
      transition: all 0.2s ease;
    }

    div[class*="LoginFormContainer"] button[type="submit"]:hover,
    form[class*="LoginContainer"] button[type="submit"]:hover {
      background-color: #ffa500 !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3) !important;
    }

    /* 6. Links (Forgot Password) */
    div[class*="LoginFormContainer"] a,
    form[class*="LoginContainer"] a {
      color: #ff8c00 !important;
      text-decoration: none !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      display: inline-block !important;
      margin-top: 15px !important;
      text-align: center !important;
      width: 100% !important;
    }

    div[class*="LoginFormContainer"] a:hover,
    form[class*="LoginContainer"] a:hover {
      text-decoration: underline !important;
    }

    /* Remove Pterodactyl mascot if visible */
    img[class*="Mascot"] {
      display: none !important;
    }
  @endif

  /* Background Wallpaper */
  .velion-auth-wallpaper {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -2;
    background-color: #050505;
  }
</style>
