<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\velion;

use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;
use Illuminate\Http\RedirectResponse;

use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Admin\BlueprintAdminLibrary as BlueprintExtensionLibrary;

class velionExtensionController extends Controller
{
  public function __construct(
    private ViewFactory $view,
    private BlueprintExtensionLibrary $blueprint,
    private ConfigRepository $config,
    private SettingsRepositoryInterface $settings,
  ) {}

  public function index()
  {
    return $this->view->make('admin.extensions.velion.index', [
        'blueprint' => $this->blueprint,
    ]);
  }

  public function update(VelionSettingsFormRequest $request): RedirectResponse
  {
    foreach ($request->normalize() as $key => $value) {
      $this->settings->set('velion::' . $key, $value);
    }
    return redirect()->route('admin.extensions.velion.index');
  }
}

class VelionSettingsFormRequest extends AdminFormRequest
{
  public function rules(): array
  {
    return [
      'sidebar_home' => 'string|nullable|url:http,https',
      'sidebar_admin' => 'string|nullable|url:http,https',
      'sidebar_account' => 'string|nullable|url:http,https',
      'sidebar_logout' => 'string|nullable|url:http,https',
      'sidebar_server_terminal' => 'string|nullable|url:http,https',
      'sidebar_server_files' => 'string|nullable|url:http,https',
      'sidebar_server_databases' => 'string|nullable|url:http,https',
      'sidebar_server_schedules' => 'string|nullable|url:http,https',
      'sidebar_server_users' => 'string|nullable|url:http,https',
      'sidebar_server_backups' => 'string|nullable|url:http,https',
      'sidebar_server_network' => 'string|nullable|url:http,https',
      'sidebar_server_startup' => 'string|nullable|url:http,https',
      'sidebar_server_settings' => 'string|nullable|url:http,https',
      'sidebar_server_activity' => 'string|nullable|url:http,https',
      'sidebar_server_more' => 'string|nullable|url:http,https',
      'sidebar_account_account' => 'string|nullable|url:http,https',
      'sidebar_account_api' => 'string|nullable|url:http,https',
      'sidebar_account_ssh' => 'string|nullable|url:http,https',
      'sidebar_account_activity' => 'string|nullable|url:http,https',
      'sidebar_account_more' => 'string|nullable|url:http,https',
      'icon_scale' => 'numeric|lte:1|gte:0.10',
      'watermark' => 'boolean',
      'background_image' => 'string|nullable|url:http,https',
      'sidebar_background' => 'string|in:default,blurred',
      'background_appearance' => 'string|decimal:0|lte:2|gte:0',
      'background_magic' => 'string|nullable|in:tiles,cubes,rotated-squares,l-shape,zig-zag,wavy-checkerboard,chevrons,houndstooth,quarter-circles,diagonal-rectangles,alternating-arc,rotated-rectangles,concentric-arrows,outline-triangles,moon,polka',
      'background_magicsize' => 'numeric|decimal:0|lte:500|gte:50',
      'auth_background_image' => 'string|nullable|url:http,https',
      'auth_background_appearance' => 'string|decimal:0|lte:2|gte:0',
      'auth_background_magic' => 'string|nullable|in:tiles,cubes,rotated-squares,l-shape,zig-zag,wavy-checkerboard,chevrons,houndstooth,quarter-circles,diagonal-rectangles,alternating-arc,rotated-rectangles,concentric-arrows,outline-triangles,moon,polka',
      'auth_background_magicsize' => 'numeric|decimal:0|lte:500|gte:50',
      'palette_dashboard_1' => 'starts_with:#|string|size:7',
      'palette_dashboard_2' => 'starts_with:#|string|size:7',
      'palette_dashboard_3' => 'starts_with:#|string|size:7',
      'palette_dashboard_4' => 'starts_with:#|string|size:7',
      'palette_dashboard_5' => 'starts_with:#|string|size:7',
      'palette_dashboard_6' => 'starts_with:#|string|size:7',
      'palette_dashboard_7' => 'starts_with:#|string|size:7',
      'palette_dashboard_8' => 'starts_with:#|string|size:7',
      'palette_dashboard_9' => 'starts_with:#|string|size:7',
      'palette_sidebar_1' => 'starts_with:#|string|size:7',
      'palette_sidebar_2' => 'starts_with:#|string|size:7',
      'palette_sidebar_3' => 'starts_with:#|string|size:7',
      'palette_sidebar_4' => 'starts_with:#|string|size:7',
      'palette_sidebar_5' => 'starts_with:#|string|size:7',
      'palette_sidebar_6' => 'starts_with:#|string|size:7',
      'palette_sidebar_7' => 'starts_with:#|string|size:7',
      'palette_sidebar_8' => 'starts_with:#|string|size:7',
      'palette_auth_1' => 'starts_with:#|string|size:7',
      'palette_auth_2' => 'starts_with:#|string|size:7',
      'palette_auth_3' => 'starts_with:#|string|size:7',
      'palette_auth_4' => 'starts_with:#|string|size:7',
      'palette_auth_5' => 'starts_with:#|string|size:7',
      'palette_auth_6' => 'starts_with:#|string|size:7',
      'palette_auth_7' => 'starts_with:#|string|size:7',
      'palette_auth_8' => 'starts_with:#|string|size:7',
      'keyboard_shortcuts' => 'boolean',
      'keybind_icons' => 'boolean',
      'sidebar_hover_tooltip' => 'numeric|decimal:0|lte:2|gte:0',
      'server_overview_graphs' => 'boolean',
      'server_colored_power' => 'boolean',
      'sidebar_always_visible_buttons' => 'boolean',
      'icon_fallback' => 'string|in:bootstrap,feather,lucide,material,material-light,fontawesome,eva-outline,eva-solid,remix-outline,remix-solid,tabler,octicons,akar-icons,hugeicons-solid,hugeicons-stroke',
      'dashboard_transparency' => 'numeric|decimal:0|lte:3|gte:0',
      'page_indexing' => 'boolean',
      'website_links' => 'boolean',
      'weblink_support' => 'string|nullable|url:http,https',
      'weblink_billing' => 'string|nullable|url:http,https',
      'weblink_status' => 'string|nullable|url:http,https',
      'weblink_social_discord' => 'string|nullable',
      'weblink_social_github' => 'string|nullable',
      'website_links_align' => 'boolean',
      'alert' => 'boolean',
      'alert_text' => 'string|nullable',
      'alert_icon' => 'string|in:megaphone-fill,exclamation-triangle-fill,check-circle-fill,database-fill,chat-square-text-fill,gear-fill,rocket-takeoff-fill,reception-4',
      'watermark_auth' => 'boolean',
      'server_list' => 'string|in:cards,list',
      'reset' => 'boolean',
      'border_radius' => 'numeric|decimal:0|lte:20|gte:0',
      'sidebar_full' => 'boolean',
      'sidebar_buttonstyle' => 'numeric|decimal:0|lte:2|gte:0',
      'sidebar_customlogo' => 'string|nullable|url:http,https',
      'auth_customlogo' => 'string|nullable|url:http,https',
      'alert_position' => 'string|in:sticky,static',
      'sidebar_border_radius' => 'numeric|decimal:0|lte:20|gte:0',
      'alert_dismiss' => 'boolean',
      'palette_status_offline' => 'starts_with:#|string|size:7',
      'palette_status_error' => 'starts_with:#|string|size:7',
      'palette_status_starting' => 'starts_with:#|string|size:7',
      'palette_status_online' => 'starts_with:#|string|size:7',
      'statusgradient_style' => 'string|in:default,flat',
      'sidebar_hover' => 'string|in:disabled,popout,expand',
      'animations' => 'string|in:fadeup,zoomout,fadein,disabled',
      'sidebar_separators' => 'boolean',
    ];
  }
}