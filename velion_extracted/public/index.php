<html>
  <head>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap&version=598015');
      @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    </style>
    <script src="{webroot/public}/libraries/errorHandler.js"></script>
  </head>
  <body>
    <div id="app"></div>
    <script>
      HandleVelionError(`
        <code>${window.location.hostname}</code>
        využívá Velion pro optimální uživatelský zážitek.
        Tato stránka obsahuje informace, které mohou být užitečné
        pro ladění problémů, se kterými se administrátoři mohou
        setkat u rozšíření jako je Velion.

        <div style="
          background-color: #1a1d24;
          border-radius: 12px;
          padding: 10px;
          width: max-content;
        ">
          <p style="margin: 0">
            <code>
              !{identifier} {identifier} <br>
              !{name} {name} <br>
              !{author} {author} <br>
              !{version} {version} <br>
              !{random} {random} <br>
              !{timestamp} {timestamp} <br>
              !{mode} {mode} <br>
              !{target} {target} <br>
              !{root} {root}
            </code>
          </p>
        </div>
      `, ` `)
    </script>
  </body>
</html>
