{{-- Velion - Auth page theming (Normal/Default Layout) --}}
<style id="velion-auth-theme">
  @if(!Auth::check())
    /* Keep Pterodactyl's default layout, just change colors */
    body {
      background-color: #050505 !important;
    }

    #app {
      background-color: transparent !important;
    }

    /* Style the default card */
    div[class*="LoginFormContainer"],
    div[class*="LoginContainer"],
    form[class*="LoginContainer"] {
      background-color: #0a0a0a !important;
      border: 1px solid #1a1a1a !important;
      border-radius: 12px !important;
      padding: 32px !important;
      box-shadow: 0 8px 32px rgba(0,0,0,0.4) !important;
    }

    /* Input styling */
    input {
      background-color: #111111 !important;
      border: 1px solid #1a1a1a !important;
      color: #ffffff !important;
    }
    input:focus {
      border-color: #ff8c00 !important;
      box-shadow: 0 0 0 2px rgba(255, 140, 0, 0.2) !important;
    }

    /* Button styling */
    button[type="submit"] {
      background-color: #ff8c00 !important;
      border: none !important;
      color: #ffffff !important;
      font-weight: 600 !important;
    }
    button[type="submit"]:hover {
      background-color: #ffa500 !important;
    }

    /* Link styling */
    a {
      color: #ff8c00 !important;
    }
  @endif
</style>
