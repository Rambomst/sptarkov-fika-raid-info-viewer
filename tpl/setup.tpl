{include file='common/header.tpl'}
<section class="section">
    <div class="container">
        <div class="card">
            <span class="title">Set up</span>
            <div class="card-content columns is-multiline">
                <form METHOD="POST" ACTION="/save_config">
                    <table class="table">
                        <tr>
                            <th>Server Name</th>
                            <td><input type="text" name="title" placeholder="server name" value="{$config->ui['title']}"></td>
                        </tr>
                        <tr>
                            <th>Server Host (IP Address or FQDN)</th>
                            <td><input type="text" name="host" placeholder="server ip or fqdn" value="{$config->tarkov['host']}" required></td>
                            <td><input type="number" min="1" max="999999" name="port" placeholder="port" value="{$config->tarkov['port']}" required></td>
                        </tr>
                        <tr>
                            <th colspan="3">List of dedicated clients (comma separated)</th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <textarea class="textarea" name="dedicated_clients" id="">{foreach $config->tarkov['dedicated_clients'] as $client}{$client}{if !$client@last},{/if}{/foreach}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="submit" class="button">Save config</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>
{include file='common/footer.tpl'}