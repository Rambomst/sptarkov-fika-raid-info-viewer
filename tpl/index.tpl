{include file='common/header.tpl'}
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
{include file='common/footer.tpl'}