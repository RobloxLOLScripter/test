<?php
  require __DIR__ . '/../../../../../vendor/autoload.php';
  $app = require_once __DIR__.'/../../../../../bootstrap/app.php';
  $app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::capture());

  use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Client\BlueprintClientLibrary as BlueprintExtensionLibrary;
  $settings = app()->make('Pterodactyl\Contracts\Repository\SettingsRepositoryInterface');
  $blueprint = app()->make(BlueprintExtensionLibrary::class, ['settings' => $settings]);

  $userId = Auth::id(); // fetch authenticated user's ID
  $user = Auth::user(); // fetch authenticated user
  if($user == false) { echo('401 Neoprávněný přístup'); return; }
  if($user->root_admin != 1) { echo('403 Přístup zamítnut'); return; }
?>
<head>
  <link rel="stylesheet" href="./assets/base.css">
  <link rel="stylesheet" href="./assets/css/modes/tinypreview.css">
  <script src="./assets/js/navigation.js"></script>
  <script src="./assets/js/editor.js"></script>
  <!-- popperjs --> <script src="https://unpkg.com/@popperjs/core@2"></script>
  <!-- tippy.js --> <script src="https://unpkg.com/tippy.js@6"></script>
  <!-- tippy.js --> <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/shift-away.css">
  <style>.match-dashboard-bg {background-color: <?php echo $blueprint->dbGet("velion", "palette_dashboard_7"); ?> !important;} .match-auth-bg {background-color: <?php echo $blueprint->dbGet("velion", "palette_auth_1"); ?> !important;}</style>
  <title>Velion Návrhář</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="/extensions/velion/editor/assets/favicon.ico">
  <?php if($blueprint->dbGet("velion", "plausible_tracking") == 1) { echo('<script defer="" data-domain="demo.velion.style" src="https://plausible.prpl.wtf/js/script.js"></script>'); } ?>
</head>

<html style="background-color: #111318">
  <body>
    <div class="container">
      <div class="navigation">
        <button onclick="navigationAction('admin')" to="admin" class="return-button"><i class="bi bi-arrow-90deg-left"></i></button>
        <div style="height: 80px;"></div>
        <button onclick="navigationAction('general')" to="general" class="navigation-button active"><i class="bi bi-sliders2"></i></button>
        <button onclick="navigationAction('palette')" to="palette" class="navigation-button"><i class="bi bi-palette2"></i></button>
        <button onclick="navigationAction('sidebar')" to="sidebar" class="navigation-button"><i class="bi bi-layout-sidebar-inset"></i></button>
        <button onclick="navigationAction('dashboard')" to="dashboard" class="navigation-button"><i class="bi bi-grid-1x2"></i></button>
        <button onclick="navigationAction('authentication')" to="authentication" class="navigation-button"><i class="bi bi-box-arrow-in-right"></i></button>
        <button onclick="navigationAction('more')" to="more" class="navigation-button"><i class="bi bi-nut"></i></button>
        <div class="save-padding"></div>
        <button onclick="saveAction()" class="save-button"><i class="bi bi-floppy-fill"></i></button>
      </div>
      <div class="editor fade">
        <form action="/admin/extensions/velion" method="POST" id="editor-form" autocomplete="off">
          <div class="editor-container">
            <h2 class="editor-title">Obecné</h2>
            <p class="editor-description">Konfigurace obecných nastavení.</p>

            <!-- Website links -->
            <div class="option">
              <button class="modal-open" onclick="modal('#weblinks-modal')" type="button" style="float: left"><i class="bi bi-plus-lg"></i></button>
              <p class="option-title with-button">Odkazy na web</p>
              <!-- Enabled -->
              <input type="radio" id="websitelinks-on" name="website_links" value="1" class="hidden" <?php if($blueprint->dbGet("velion", "website_links") == "1") { echo("checked=''"); } ?>>
              <label for="websitelinks-on" class="option-radio" onclick="event.preventDefault();modal('#weblinks-modal');">
                <img src="./assets/images/general/websitelinks/on.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <!-- Disabled -->
              <input type="radio" id="websitelinks-off" name="website_links" value="0" class="hidden" <?php if($blueprint->dbGet("velion", "website_links") == "0") { echo("checked=''"); } ?>>
              <label for="websitelinks-off" class="option-radio" onclick="clearWeblinks()">
                <img src="./assets/images/general/websitelinks/off.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <p class="option-footer">Tlačítka s odkazy na externí stránky vašeho Pterodactyl panelu.</p>
            </div>

            <!-- Alert -->
            <div class="option">
              <button class="modal-open" onclick="modal('#alert-modal')" type="button" style="float: left"><i class="bi bi-plus-lg"></i></button>
              <p class="option-title with-button">Upozornění</p>
              <!-- Enabled -->
              <input type="radio" id="alert-on" name="alert" value="1" class="hidden" <?php if($blueprint->dbGet("velion", "alert") == "1") { echo("checked=''"); } ?>>
              <label for="alert-on" class="option-radio" onclick="event.preventDefault();modal('#alert-modal');">
                <img src="./assets/images/general/alert/on.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <!-- Disabled -->
              <input type="radio" id="alert-off" name="alert" value="0" class="hidden" <?php if($blueprint->dbGet("velion", "alert") == "0") { echo("checked=''"); } ?>>
              <label for="alert-off" class="option-radio">
                <img src="./assets/images/general/alert/off.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <p class="option-footer">Zobrazení vlastního, konfigurovatelného upozornění na vašem panelu.</p>
            </div>
          </div>

          <!-- Weblinks modal -->
          <div class="editor-modal" id="weblinks-modal">
            <button class="modal-close" onclick="closeModal('#weblinks-modal')" type="button" style="float: left"><i class="bi bi-chevron-left"></i></button>
            <h2 class="editor-title with-button">Odkazy na web</h2>
            <p class="editor-description">Tlačítka s odkazy na externí stránky na vaší přihlašovací stránce i v Pterodactyl panelu, viditelné pro uživatele na tabletech a počítačích.</p>

            <!-- Websites -->
            <div class="option">
              <p class="option-title">Webové stránky</p>
              <!-- Support Page -->
              <div class="option-container with-margin">
                <span class="option-icon"><i class="bi bi-life-preserver"></i></span>
                <input type="text" id="weblink-support" name="weblink_support" class="option-input with-icon" placeholder="https://support.velion.style" value="<?php echo $blueprint->dbGet("velion", "weblink_support"); ?>">
                <script> tippy('.option-container:has(.option-icon + #weblink-support)', { content: "Stránka podpory", arrow: false, animation: 'shift-away' }); </script>
              </div>
              <!-- Billing Panel -->
              <div class="option-container with-margin">
                <span class="option-icon"><i class="bi bi-cash-coin"></i></span>
                <input type="text" id="weblink-billing" name="weblink_billing" class="option-input with-icon" placeholder="https://billing.velion.style" value="<?php echo $blueprint->dbGet("velion", "weblink_billing"); ?>">
                <script> tippy('.option-container:has(.option-icon + #weblink-billing)', { content: "Fakturační panel", arrow: false, animation: 'shift-away' }); </script>
              </div>
              <!-- Status Page -->
              <div class="option-container with-margin">
                <span class="option-icon"><i class="bi bi-bar-chart-fill"></i></span>
                <input type="text" id="weblink-status" name="weblink_status" class="option-input with-icon" placeholder="https://status.velion.style" value="<?php echo $blueprint->dbGet("velion", "weblink_status"); ?>">
                <script> tippy('.option-container:has(.option-icon + #weblink-status)', { content: "Stránka stavu", arrow: false, animation: 'shift-away' }); </script>
              </div>
              <p class="option-footer">Odkazy na webové stránky související s vaším Pterodactyl panelem.</p>
            </div>

            <!-- Social links -->
            <div class="option">
              <p class="option-title">Sociální sítě</p>
              <!-- Discord Guild -->
              <div class="option-container with-margin">
                <span class="option-icon"><i class="bi bi-discord"></i></span>
                <input type="text" id="weblink-social-discord" name="weblink_social_discord" class="option-input with-icon" placeholder="CUwHwv6xRe" value="<?php echo $blueprint->dbGet("velion", "weblink_social_discord"); ?>">
                <script> tippy('.option-container:has(.option-icon + #weblink-social-discord)', { content: "Discord server", arrow: false, animation: 'shift-away' }); </script>
              </div>
              <!-- GitHub Profile/Repository -->
              <div class="option-container with-margin">
                <span class="option-icon"><i class="bi bi-github"></i></span>
                <input type="text" id="weblink-social-github" name="weblink_social_github" class="option-input with-icon" placeholder="prplwtf" value="<?php echo $blueprint->dbGet("velion", "weblink_social_github"); ?>">
                <script> tippy('.option-container:has(.option-icon + #weblink-social-github)', { content: "GitHub profil/repozitář", arrow: false, animation: 'shift-away' }); </script>
              </div>
              <p class="option-footer">Pozvánky nebo uživatelská jména na různé sociální platformy.</p>
            </div>

            <!-- Alignment -->
            <div class="option">
              <p class="option-title">Zarovnání</p>
              <!-- Left -->
              <input type="radio" id="linkalign-left" name="website_links_align" value="0" class="hidden" <?php if($blueprint->dbGet("velion", "website_links_align") == "0") { echo("checked=''"); } ?>>
              <label for="linkalign-left" class="option-radio sm aspect-square">
                <img src="./assets/images/general/linkalign/left.png"/>
              </label>
              <!-- Right -->
              <input type="radio" id="linkalign-right" name="website_links_align" value="1" class="hidden" <?php if($blueprint->dbGet("velion", "website_links_align") == "1") { echo("checked=''"); } ?>>
              <label for="linkalign-right" class="option-radio sm aspect-square">
                <img src="./assets/images/general/linkalign/right.png"/>
              </label>
              <p class="option-footer">Zvolte, kam zarovnat odkazy. Sociální odkazy se zarovnají na opačnou stranu.</p>
            </div>
          </div>

          <!-- Alert modal -->
          <div class="editor-modal" id="alert-modal">
            <button class="modal-close" onclick="closeModal('#alert-modal')" type="button" style="float: left"><i class="bi bi-chevron-left"></i></button>
            <h2 class="editor-title with-button">Upozornění</h2>
            <p class="editor-description">Zobrazte vlastní, konfigurovatelné upozornění/oznámení na vašem panelu.</p>

            <!-- Content -->
            <div class="option">
              <p class="option-title">Obsah</p>
              <textarea id="alertcontent" name="alert_text" class="option-textarea" rows="4" placeholder="Začněte psát..."><?php echo $blueprint->dbGet("velion", "alert_text") ?></textarea>
              <p class="option-footer">Napište něco, čím informujete uživatele. Pro formátování je podporována syntaxe <a href="https://daringfireball.net/projects/markdown/" target="_blank">Markdown</a>.</p>
            </div>

            <!-- Icon -->
            <div class="option">
              <p class="option-title">Ikona</p>
              <!-- Disabled -->
              <input type="radio" id="alerticon-disabled" name="alert_icon" value="megaphone-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "megaphone-fill") { echo("checked=''"); } ?>/>
              <!-- Megaphone -->
              <input type="radio" id="alerticon-megaphone" name="alert_icon" value="megaphone-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "megaphone-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-megaphone" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/megaphone.png"/>
              </label>
              <!-- Warning -->
              <input type="radio" id="alerticon-warning" name="alert_icon" value="exclamation-triangle-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "exclamation-triangle-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-warning" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/warning.png"/>
              </label>
              <!-- Success -->
              <input type="radio" id="alerticon-success" name="alert_icon" value="check-circle-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "check-circle-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-success" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/success.png"/>
              </label>
              <!-- Database -->
              <input type="radio" id="alerticon-database" name="alert_icon" value="database-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "database-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-database" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/database.png"/>
              </label>
              <!-- Message -->
              <input type="radio" id="alerticon-message" name="alert_icon" value="chat-square-text-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "chat-square-text-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-message" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/message.png"/>
              </label>
              <!-- Gear -->
              <input type="radio" id="alerticon-gear" name="alert_icon" value="gear-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "gear-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-gear" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/gear.png"/>
              </label>
              <!-- Rocket -->
              <input type="radio" id="alerticon-rocket" name="alert_icon" value="rocket-takeoff-fill" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "rocket-takeoff-fill") { echo("checked=''"); } ?>/>
              <label for="alerticon-rocket" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/rocket.png"/>
              </label>
              <!-- Reception -->
              <input type="radio" id="alerticon-reception" name="alert_icon" value="reception-4" class="hidden" <?php if($blueprint->dbGet("velion", "alert_icon") == "reception-4") { echo("checked=''"); } ?>/>
              <label for="alerticon-reception" class="option-radio sm aspect-square" onclick="alertDepend(event)">
                <img src="./assets/images/general/alerticon/reception.png"/>
              </label>
              <p class="option-footer">Vyberte ikonu pro upozornění, která se zobrazí před zprávou.</p>
            </div>

            <!-- Position -->
            <div class="option">
              <p class="option-title">Pozice</p>
              <!-- Disabled -->
              <input type="radio" id="alertposition-disabled" name="alert_position" value="sticky" class="hidden"/>
              <!-- Sticky -->
              <input type="radio" id="alertposition-sticky" name="alert_position" value="sticky" class="hidden" <?php if($blueprint->dbGet("velion", "alert_position") == "sticky") { echo("checked=''"); } ?>>
              <label for="alertposition-sticky" class="option-radio" onclick="alertDepend(event)">
                <img src="./assets/images/general/alertposition/sticky.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <!-- Static -->
              <input type="radio" id="alertposition-static" name="alert_position" value="static" class="hidden" <?php if($blueprint->dbGet("velion", "alert_position") == "static") { echo("checked=''"); } ?>>
              <label for="alertposition-static" class="option-radio" onclick="alertDepend(event)">
                <img src="./assets/images/general/alertposition/static.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <p class="option-footer">Zvolte, zda má upozornění zůstat v zobrazené oblasti nebo na začátku stránky.</p>
            </div>

            <!-- Dismissable -->
            <div class="option">
              <p class="option-title">Možnost zavřít</p>
              <!-- Disabled -->
              <input type="radio" id="alertdismiss-disabled" name="alert_dismiss" value="0" class="hidden"/>
              <!-- Enabled -->
              <input type="radio" id="alertdismiss-on" name="alert_dismiss" value="1" class="hidden" <?php if($blueprint->dbGet("velion", "alert_dismiss") == "1") { echo("checked=''"); } ?>>
              <label for="alertdismiss-on" class="option-radio" onclick="alertDepend(event)">
                <img src="./assets/images/general/alertdismiss/on.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <!-- Disabled -->
              <input type="radio" id="alertdismiss-off" name="alert_dismiss" value="0" class="hidden" <?php if($blueprint->dbGet("velion", "alert_dismiss") == "0") { echo("checked=''"); } ?>>
              <label for="alertdismiss-off" class="option-radio" onclick="alertDepend(event)">
                <img src="./assets/images/general/alertdismiss/off.png" loading="lazy" class="aspect-16:9"/>
              </label>
              <p class="option-footer">Povolte nebo zakažte uživatelům skrýt/zavřít upozornění.</p>
            </div>
          </div>

          <div id="editor-submit">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="_endpoint" value="/extensions/velion/editor/editor.php">
            <input type="hidden" name="_method" value="PATCH">
            <button type="submit" class="hidden" id="submit"></button>
          </div>
        </form>
      </div>
      <div class="preview fade">
        <iframe
          title="Preview"
          class="preview-frame mobile-xs"
          src="/extensions/velion/preview/placeholder.php"
          style="--scale: 1; --size: 100%;"
          loading="lazy">
        </iframe>
      </div>
      <div id="notif-unsaved" class="notif">
        <div class="notif-hitbox"></div>
        <div class="notif-container">
          <h2 class="notif-title">
            <i class="bi bi-exclamation-triangle-fill" style="margin-right: 4px;"></i>
            Neuložené změny!
          </h2>
          <p class="notif-text">Provedli jste změny, které ještě nebyly uloženy. Chcete je uložit?</p>
          <button class="notif-button notif-primary" id="unsaved-save" onclick="saveUnsaved()" type="button">Uložit</button>
          <button class="notif-button" id="unsaved-discard" onclick="discardUnsaved()" type="button">Zahodit</button>
          <button class="button-close notif-button align-right" id="unsaved-cancel" type="button">Zrušit</button>
        </div>
      </div>
    </div>
  </body>
</html>

<script>
  document.addEventListener("DOMContentLoaded", function (event) {
    element("#editor-form").addEventListener("change", function () {
      if(
        element("#weblink-support").value == "" &&
        element("#weblink-billing").value == "" &&
        element("#weblink-status").value == "" &&
        element("#weblink-social-discord").value == "" &&
        element("#weblink-social-github").value == ""
      ){
        element("#websitelinks-off").checked = true
      } else {
        element("#websitelinks-on").checked = true
      }
    });

    if(
      element("#weblink-support").value == "" &&
      element("#weblink-billing").value == "" &&
      element("#weblink-status").value == "" &&
      element("#weblink-social-discord").value == "" &&
      element("#weblink-social-github").value == ""
    ){
      element("#websitelinks-off").checked = true
    }
  });
  function clearWeblinks() {
    element("#weblink-support").value = ""
    element("#weblink-billing").value = ""
    element("#weblink-status").value = ""
    element("#weblink-social-discord").value = ""
    element("#weblink-social-github").value = ""
  }
</script>

<script>
  document.addEventListener("DOMContentLoaded", function (event) {
    element("#alert-off").addEventListener("click", function () {
      element("#alertcontent").value = null;
      element("#alerticon-disabled").click()
      element("#alertposition-disabled").click()
      element("#alertdismiss-disabled").click()
    });
    element("#alertcontent").addEventListener("change", function () {
      if(element("#alertcontent").value == "") {
        element("#alerticon-disabled").checked = true
        element("#alertposition-disabled").checked = true
        element("#alertdismiss-disabled").checked = true
        element("#alert-off").checked = true
      } else {
        element("#alert-on").click()
        if(element("#alerticon-disabled").checked) {
          element("#alerticon-megaphone").checked = true
        }
        if(element("#alertposition-disabled").checked) {
          element("#alertposition-sticky").checked = true
        }
        if(element("#alertdismiss-disabled").checked) {
          element("#alertdismiss-off").checked = true
        }
      }
    });

    if(element("#alertcontent").value == "") {
      element("#alert-off").checked = true
      element("#alerticon-disabled").checked = true
      element("#alertposition-disabled").checked = true
      element("#alertdismiss-disabled").checked = true
    }
  });
  function alertDepend(event) {
    if(element("#alertcontent").value == '') {
      event.preventDefault()
      element("#alertcontent").focus()
    }
  }
</script>