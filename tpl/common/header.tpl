<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{$config->ui['title']}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
  <section class="hero is-primary">
    <div class="hero-body">
      <p class="title">{$config->ui['title']}</p>
      <p class="subtitle">Current Matches</p>
    </div>
  </section>
  {if $config->error}
  <section class="error">
    <span class="error-message">{$config->error}</span>
  </section>
  {/if}