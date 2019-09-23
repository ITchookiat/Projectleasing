<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legiscourt extends Model
{
  protected $table = 'legislations';
  protected $fillable = ['fillingdate_court','law_court','bnumber_court','rnumber_court','capital_court','indictment_court','pricelawyer_court','examiday_court',
                        'fuzzy_court','examinote_court','orderday_court','ordersend_court','checkday_court','checksend_court','buyer_court','support_court',
                        'social_flag','setoffice_court','sendoffice_court','checkresults_court','sendcheckresults_court','received_flag','noreceived_flag',
                        'telresults_court','dayresults_court','sequester_court','sendsequester_court'];
}
