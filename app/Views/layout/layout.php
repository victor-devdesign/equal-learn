<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{seo_title_page}</title>
  <!-- Optimization -->
  <link rel="dns-prefetch" href="{base_url}">
  <!-- Open Graph -->
  <meta property="og:title" content="{og_title}">
  <meta property="og:type" content="{og_type}">
  <meta property="og:url" content="{og_url}">
  <meta property="og:image" content="{og_image}">
  <!-- SEO -->
  <meta name="description" content="{seo_description}">
  <!-- APP -->
  <meta name="apple-mobile-web-app-title" content="{seo_title_page}">
  <meta name="apple-mobile-web-app-status-bar-style" content="{theme_color}">
  <link rel="apple-touch-icon" href="{favicon_url}">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="{favicon_url}">
  <meta name="theme-color" content="{theme_color}">
  <link rel="manifest" href="{base_url}portal.webmanifest">
  <link rel="shortcut icon" href="{favicon_url}" type="image/png">
  <!-- DEPENDENCIES -->
  <script {csp-script-nonce}>
    var BASEURL = '{base_url}';
  </script>
  <link rel="stylesheet" href="{base_url}assets/css/3rdparty.min.css?v={cache_version}">
  <link rel="stylesheet" href="{base_url}libs/bootstrap5/bootstrap.min.css">
  <link rel="stylesheet" href="{base_url}assets/css/admin.min.css?v={cache_version}">
  <script src="{base_url}libs/jquery/jquery.min.js"></script>
  <script src="{base_url}libs/jquery/jquery-ui.min.js"></script>
  <script src="{base_url}libs/bootstrap5/bootstrap.bundle.min.js"></script>
  <script src="{base_url}libs/moment/moment-with-locales.min.js"></script>
  <script src="{base_url}assets/js/common.min.js?v={cache_version}"></script>
  <script src="{base_url}assets/js/3rdparty.min.js?v={cache_version}"></script>

  <!-- REACT -->
  <script src="{base_url}libs/react/umd/react.production.min.js"></script>
  <script src="{base_url}libs/react/umd/react-dom.production.min.js"></script>
  <script src="{base_url}libs/react/umd/react-router-dom.min.js"></script>
  <script src="{base_url}libs/react/dist/purify.min.js"></script>
  <script src="{base_url}libs/react/dist/html-react-parser.min.js"></script>

  <!-- REACT APP -->
  <script src="http://localhost/equal-learn/public/assets/js/bundle/app.js" type="module"></script>

  {layout_scripts_before}

  <style type="text/css">
    .active {
      color: red;
    }

    a {
      padding-right: 5px;
    }
  </style>

</head>

<body>

  <div id="root"></div>

</body>

</html>