<?php

   // Codigo bajado de Pusher

  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'mt1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '404d396c5a7f93789be7',
    'd25b4d6fc65e9a300f3f',
    '1142657',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
?>