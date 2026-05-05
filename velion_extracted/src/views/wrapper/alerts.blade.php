{{-- Velion - Alert/announcement banner --}}
@if(isset($n_alert) && $n_alert == "1" && $n_alert_text != "")
<div class="velion-alert" id="velion-alert" style="
  @if($n_alert_position == 'sticky') position: sticky; top: 0; z-index: 30; @endif
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 20px;
  background-color: var(--dashboardSecondary);
  border-bottom: 1px solid var(--dashboardTertiary);
  font-family: var(--font);
  font-size: 13px;
  color: var(--dashboardText);
">
  <i class="bi bi-{{ $n_alert_icon }}" style="font-size: 18px; color: var(--dashboardAccent);"></i>
  <span style="flex: 1;">{{ $n_alert_text }}</span>
  @if(isset($n_alert_dismiss) && $n_alert_dismiss == "1")
  <button onclick="this.parentElement.style.display='none'" style="
    background: none; border: none; cursor: pointer;
    color: var(--dashboardText); opacity: 0.5; font-size: 16px;
  "><i class="bi bi-x"></i></button>
  @endif
</div>
@endif
