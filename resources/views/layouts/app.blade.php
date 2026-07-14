<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Tecnoelectrónica SURL</title>

    <meta name="description" content="Tu tienda todo en uno: desde desarrollo de software a la medida hasta electrodomésticos y productos alimenticios. Soluciones globales para tu hogar y negocio.">

    <link rel="icon" href="/favicon.ico" sizes="any" />
    <link rel="icon" href="/favicon-16x16.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="/favicon-32x32.png" sizes="32x32" type="image/png" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;900&family=Space+Grotesk:wght@400..700&family=JetBrains+Mono:wght@400..700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="/build/assets/app-B9iMALHm.css" />
    <script type="module" src="/build/assets/app-BvRk9kiK.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Tecnoelectrónica SURL",
      "url": "https://www.tecnoelectronicasurl.com"
    }
    </script>
</head>
<body class="font-sans antialiased">
    <x-header />

    <main>
        @yield('content')
    </main>

    <x-footer />
    @stack('scripts')
</body>
</html>