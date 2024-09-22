{include file='common/header.tpl'}
<section class="hero is-fullheight is-danger">
  <div class="hero-body">
    <div class="container has-text-centered">
      <h1 class="title">
        An Error has Occured
      </h1>
      <div class="box">
        <ul>
          {foreach $error_messages as $error_message}
            <li>{$error_message}</li>
          {/foreach}
        </ul>
      </div>
      <div class="buttons is-centered mt-5">
        <a href="/" class="button is-link is-medium">Back to Home</a>
        <a href="/setup" class="button is-warning is-medium">Back to Setup</a>
      </div>
    </div>
  </div>
</section>
{include file='common/footer.tpl'}