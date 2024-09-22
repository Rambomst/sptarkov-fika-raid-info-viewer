{include file='common/header.tpl'}
<section class="section">
  <div class="container">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          Server Setup
        </p>
      </header>
      <div class="card-content">
        <form method="POST" action="/setup/save">
          <div class="field">
            <label class="label">Server Name</label>
            <div class="control">
              <input class="input" type="text" name="title" placeholder="Enter server name" value="{$config->get('ui.title')}">
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-body">
              <div class="field">
                <label class="label">Server Host (IP Address or FQDN)</label>
                <div class="control">
                  <input class="input" type="text" name="host" placeholder="Enter server IP or FQDN" value="{$config->get('tarkov.host')}" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Port</label>
                <div class="control">
                  <input class="input" type="number" min="0" max="65545" name="port" placeholder="Port number" value="{$config->get('tarkov.port')}" required>
                </div>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Dedicated Clients (comma-separated)</label>
            <div class="control">
              <textarea class="textarea" name="dedicated_clients" placeholder="List of dedicated clients">{foreach $config->get('tarkov.dedicated_clients') as $client}{$client}{if !$client@last},{/if}{/foreach}</textarea>
            </div>
          </div>

          <div class="field">
            <div class="control">
              <button type="submit" class="button is-primary">Save Configuration</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
{include file='common/footer.tpl'}