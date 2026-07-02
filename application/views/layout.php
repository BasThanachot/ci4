<!doctype html>
<html class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title ?? 'GLIN') ?> - GLIN</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="icon" href="<?= base_url('assets/images/66-1.png') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="h-full bg-gray-100">
<div class="flex h-screen overflow-hidden">

  <?php include(APPPATH . 'views/partials/sidebar.php'); ?>

  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white shadow-sm px-6 py-3 flex items-center justify-between flex-shrink-0">
      <h1 class="text-gray-700 font-semibold text-lg"><?= htmlspecialchars($page_title ?? '') ?></h1>
      <span class="text-sm text-gray-400"><?= date('d/m/') . (date('Y') + 543) ?></span>
    </header>
    <main class="flex-1 overflow-y-auto p-6">
      <?= $content ?>
    </main>
  </div>

</div>
</body>
</html>
