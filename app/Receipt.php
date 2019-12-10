<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{

  public function send($send_to, $template, $opts){
    if ($opts['for_conductor'])
      $mailer = new Mailer($send_to, 'receipt_for_conductor_template');
    } else {
      $mailer = new Mailer($send_to, 'receipt_for_lesee_template');
    }

    $send = $mailer->send(true);

    if ($send) {
      $this->sent = $send;
      $this->save;
    }
  }
}
