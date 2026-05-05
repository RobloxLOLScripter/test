{{-- Velion - File editor styling --}}
<style>
  /* Code editor/file viewer */
  div[class*="AceEditor"],
  div[class*="ace_editor"],
  .ace_editor {
    border-radius: var(--borderRadius) !important;
    font-family: 'JetBrains Mono', 'Fira Code', 'Cascadia Code', Consolas, monospace !important;
  }

  /* File manager table */
  div[class*="FileManager"],
  div[class*="file-manager"] {
    background-color: var(--dashboardPrimary) !important;
    border-radius: var(--borderRadius) !important;
    border: 1px solid var(--dashboardSecondary) !important;
  }

  /* File rows */
  div[class*="FileObjectRow"],
  a[class*="FileRow"] {
    border-color: var(--dashboardSecondary) !important;
    transition: background-color 0.1s;
  }
  div[class*="FileObjectRow"]:hover,
  a[class*="FileRow"]:hover {
    background-color: var(--dashboardSecondary) !important;
  }
</style>
