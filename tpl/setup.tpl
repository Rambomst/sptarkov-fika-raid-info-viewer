<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web UI config</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        .content-box {
            width: 40vw;
            min-height: 50vh;
            background-color: #14161a;
            color: #000;
            margin: 10px auto;
            -webkit-box-shadow: 10px 10px 15px -10px rgba(255, 255, 255, 0.24);
            -moz-box-shadow: 10px 10px 15px -10px rgba(255, 255, 255, 0.24);
            box-shadow: 10px 10px 15px -10px rgba(255, 255, 255, 0.24);
            -webkit-box-shadow: -3px 0px 15px -9px rgba(255, 255, 255, 0.24);
            -moz-box-shadow: -3px 0px 15px -9px rgba(255, 255, 255, 0.24);
            box-shadow: -3px 0px 15px -9px rgba(255, 255, 255, 0.24);
            padding: 0;
            border-radius: 14px;
        }

        .setup-title {
            width: 40vw;
            margin: 10px auto;
            background-color: #00d1b2;
            padding: 40px;
        }

        .setup-title span {
            margin-left: 20px;
        }

        span.title {
            font-size: 32px;
            font-weight: bold;
            color: #001f1a;
            display: block;
        }

        span.sub-title {
            color: #001f1a;
            display: block;
            font-size: 22px;
        }

        .clients-textarea {
            width:100%;
            resize: none;
            height:8rem;
        }

        table.config {
            width:100%;
            padding:20px;
        }

        .config td.required {
            color:tomato;
            font-size:20px;
            padding:8px;
        }

        .config td.optional {
            color:darkgoldenrod;
            font-size:20px;
            padding:8px;
        }

        .config td, .config th {
            padding:8px;
        }

        .config button {
            color:#FFF;
            background-color: #000;
            padding:15px;
            border:solid 1px #ccc;
            border-radius:8px;
        }

        .config button:hover {
            background-color: #00d1b2;
            color:#000;
        }

        .config input {
            padding:8px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }        
    </style>
</head>

<body>
    <div class="setup-title">
        <span class="title">Configure server connection</span>
        <span class="sub-title">Create config file</span>
    </div>
    <div class="content-box">
        <form action="/setup.php" method="post">
            <table class="config">
                <tr>
                    <td colspan="2" class="required">Required</td>
                </tr>
                <tr>
                    <th>Server name</th>
                    <td><input type="text" name="ui[title]" id="title" placeholder="give your server a name" required></td>
                </tr>
                <tr>
                    <th>Host IP</th>
                    <td><input type="text" name="tarkov[host]" pattern="^(?>(\d|[1-9]\d{2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?1)$" placeholder="127.0.0.1" required></td>
                </tr>
                <tr>
                    <th>Host Port</th>
                    <td><input type="number" min="1" max="99999" name="tarkov[port]" placeholder="6969" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="optional">Optional</td>
                </tr>
                <tr>
                    <th colspan="2">Dedicated Clients (comma separated)</th>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="tarkov[dedicated_clients]" class="clients-textarea"></textarea></td>
                </tr>
                <tr>
                    <td class="right-align">
                        <button type="submit">SAVE CONFIG</button>
                    </td>
                </tr>
                <tr>
                    <td class="required">Make sure your web server has write access to the root directory of this web app.</td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>