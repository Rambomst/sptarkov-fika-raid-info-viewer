<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$config->get('ui.title', 'SPTarkov Fika Match List')}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
  </head>

  <body>
    <section class="hero is-primary">
      <div class="hero-body">
        <p class="title">{$config->get('ui.title', 'SPTarkov Fika Match List')}</p>
        <p class="subtitle">Current Matches</p>
      </div>
    </section>
    {if $error_messages}
      <section class="section">
        <div class="notification is-danger">
          <ul>
            {foreach $error_messages as $error_message}
              <li>{$error_message}</li>
            {/foreach}
          </ul>
        </div>
      </section>
    {/if}