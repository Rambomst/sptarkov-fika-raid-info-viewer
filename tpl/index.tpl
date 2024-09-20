<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$config->ui['title']}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

    <style type="text/css">
      .tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
      }

      .tooltip::after {
        content: attr(data-tooltip);
        position: absolute;
        white-space: nowrap;
        background-color: #363636;
        color: #fff;
        padding: 0.5em;
        border-radius: 0.25em;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        pointer-events: none;
      }

      .is-tooltip-bottom-left::after {
        top: 100%;
        left: 0;
        transform: translateY(10px);
      }

      .tooltip:hover::after {
        opacity: 1;
        transform: translateY(0);
      }
    </style>
  </head>
  <body>
  <section class="hero is-primary">
  <div class="hero-body">
    <p class="title">{$config->ui['title']}</p>
    <p class="subtitle">Current Matches</p>
  </div>
</section>
  <section class="section">
    <div class="container">
      <div class="columns">
        {foreach $raids as $raid}
          <div class="column is-one-third">
            <div class="card">
              <div class="card-image">
                <figure class="image is-relative">
                  <img src="/assets/images/maps/{$raid->getMapImage()}">
                  {if $raid->dedicated}
                    <span class="icon tooltip is-tooltip-bottom" data-tooltip="Dedicated Server" style="position:absolute; top: 10px; left: 10px;cursor: pointer;"><img src="/assets/images/icons/server.svg" style="border-radius: 0;"></span>
                  {/if}
                  <span class="tag is-success" style="position:absolute; top: 10px; right: 10px;">Players:&nbsp;{$raid->player_count}</span>
                </figure>
              </div>
              <div class="card-content columns is-multiline">
                <div class="column is-half">
                  <p class="title is-4">{$raid->getReadableMapName()}</p>
                  <p class="subtitle is-6">
                    {if $raid->status === 'IN_GAME'}
                      Raid Active
                    {else}
                      Raid Loading...
                    {/if}
                  </p>
                </div>

                <div class="column is-half">
                  <ul class="is-pulled-right">
                    <li class="has-text-right">Players:</li>
                    {foreach $raid->players as $player}
                      {$profile = \Tarkov\Profile::fetchPlayer($player)}
                      <li class="is-size-7">{$profile->nickname}</li>
                    {/foreach}
                  </ul>
                </div>
              </div>
            </div>
          </div>
        {foreachelse}
          <div class="notification is-info">No live matches detected.</div>
        {/foreach}
      </div>
    </div>
  </section>
  </body>
</html>