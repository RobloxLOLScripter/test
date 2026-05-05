{{-- Velion - Import resources (no Nebula dependencies) --}}

{{-- Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

{{-- Bootstrap Icons (primary icon set) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- Remix Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">

{{-- Tabler Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.3.0/dist/tabler-icons.min.css">

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

{{-- Material Design Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

{{-- Lucide Icons (via CSS) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide-static@0.378.0/font/lucide.min.css">

{{-- Eva Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eva-icons@1.1.3/style/eva-icons.css">

{{-- Feather Icons (inline SVG fallback via CSS) --}}
<style>
  @font-face {
    font-family: 'feather';
    src: url('https://cdn.jsdelivr.net/npm/feather-icons@4.29.2/dist/feather-sprite.svg');
  }
  .ff { font-family: 'feather', sans-serif; font-style: normal; }
</style>

@if(isset($n_page_indexing) && $n_page_indexing == "0")
<meta name="robots" content="noindex, nofollow">
@endif
