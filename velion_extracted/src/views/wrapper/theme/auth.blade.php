{{-- Velion - Auth page theming (Hexado-style) --}}
<style id="velion-auth-theme">
  /* Auth wallpaper */
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
    font-family: var(--font);
  }
  .velion-watermark a { text-decoration: none; color: rgba(255,255,255,0.4); }
  .watermark-highlight { color: var(--authAccent); font-weight: 600; }

  /* Auth form container */
  @if(!Auth::check())
  body, body.bg-neutral-800 {
    background-color: var(--authBackground) !important;
    padding-left: 0 !important;
  }

  /* Center login form */
  div[id="app"] {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 100vh !important;
    padding: 20px !important;
  }

  /* Login card */
  div[class*="LoginFormContainer"],
  div[class*="LoginContainer"],
  form[class*="LoginContainer"],
  div[class*="ForgotPasswordContainer"],
  div[class*="ResetPasswordContainer"],
  div.LoginFormContainer___StyledDiv-sc-jv4m0y-0 {
    background-color: var(--authPrimary) !important;
    border: 1px solid var(--authSecondary) !important;
    border-radius: 16px !important;
    padding: 40px !important;
    box-shadow: 0 24px 64px rgba(0,0,0,0.6), var(--orangeGlow) !important;
    color: var(--authText) !important;
    font-family: var(--font) !important;
    max-width: 420px;
    width: 100%;
    margin: auto !important;
    position: relative !important;
    z-index: 10;
  }

  /* Auth inputs */
  div[class*="LoginFormContainer"] input,
  form[class*="LoginContainer"] input {
    background-color: var(--authSecondary) !important;
    border: 1px solid var(--authTertiary) !important;
    border-radius: 10px !important;
    color: var(--authText) !important;
    padding: 12px 16px !important;
    font-family: var(--font) !important;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  div[class*="LoginFormContainer"] input:focus,
  form[class*="LoginContainer"] input:focus {
    border-color: var(--authAccent) !important;
    box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.15) !important;
  }

  /* Auth button */
  div[class*="LoginFormContainer"] button[type="submit"],
  form[class*="LoginContainer"] button[type="submit"] {
    background: var(--orangeGradient) !important;
    border: none !important;
    border-radius: 10px !important;
    color: white !important;
    font-weight: 700 !important;
    padding: 14px !important;
    font-family: var(--font) !important;
    transition: all 0.2s ease;
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 14px rgba(255, 122, 0, 0.3) !important;
  }
  div[class*="LoginFormContainer"] button[type="submit"]:hover,
  form[class*="LoginContainer"] button[type="submit"]:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(255, 122, 0, 0.5) !important;
  }

  /* Auth labels */
  div[class*="LoginFormContainer"] label,
  form[class*="LoginContainer"] label {
    color: var(--authText) !important;
    font-family: var(--font) !important;
    font-weight: 500;
  }

  /* Auth links */
  div[class*="LoginFormContainer"] a,
  form[class*="LoginContainer"] a {
    color: var(--authAccent) !important;
  }

  /* Error messages */
  div[class*="LoginFormContainer"] div[class*="error"],
  div[class*="LoginFormContainer"] div[class*="alert"] {
    background-color: rgba(239, 68, 68, 0.1) !important;
    border: 1px solid rgba(239, 68, 68, 0.2) !important;
    border-radius: 10px !important;
    color: var(--authError) !important;
  }

  @if($n_auth_customlogo != "")
  div[class*="LoginFormContainer"] img,
  form[class*="LoginContainer"] img {
    content: url('{{ $n_auth_customlogo }}') !important;
    max-height: 64px;
  }
  @endif
  @endif

  /* reCAPTCHA notification */
  .notification {
    position: fixed;
    bottom: 20px;
    left: 24px;
    z-index: 5;
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: var(--authSecondary);
    border-radius: 12px;
    padding: 12px 18px;
    max-width: 260px;
    border: 1px solid var(--authTertiary);
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
  }
  .notificationBar {
    width: 3px;
    height: 30px;
    background-color: var(--authAccent);
    border-radius: 2px;
    flex-shrink: 0;
  }
  .notificationIcon { display: none; }
  .notificationText {
    color: var(--authText);
    font-size: 12px;
    margin: 0;
    line-height: 1.4;
    font-family: var(--font);
  }
</style>
