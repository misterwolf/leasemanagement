<?php

namespace App;

use App\Jobs\TryANewTransaction;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    public static function boot()
    {
      parent::boot();

      self::created(function($model){
        $model->createTransaction();
      });
    }

    public function createTransaction(){
      $rentPlan = RentPlan::find($this->rent_plan_id);

      $transaction = new Transaction(
        'rent_plan_id' => $rentPlan->id,
      );

      $transaction.save
      $result = $transaction.start();

      if ($result) {
        // attempt, if any, will remain unchanged
        $this->success = true;
        $this->save

        $job = (new TryANewTransaction($this))->delay($when);
        $this->dispatch($job);

        // implement background job ------------------------------------------------
        $receipt = new Receipt(
          'montlhy_payements_id' => $this->id,
          'pdf_file_path' => "files/receipts/" + $this->$montlyPayment->id + "/receipt_" + $rentPlan->id + ".pdf";
        );

        $receipt.save();

        $job = (new SendReceipt($receipt, $rentPlan))->delay(1);
        $this->dispatch($job);
        // -------------------------------------------------------------------------
      } else {
        $this->success = false;
        $this->message = "transaction id: " + $transaction->id + "failed";
        $this->save;

        // implement background job: understand what to do in case today is 28.
        // we must assure that it can be delayed of days and not maximum 15 minutes
        // in case limit is 15 minutes, we should find another solution for delay.
        // one can be introduce another automated job thats fetches and restart all the MonthlyPayment OR Transaction failed.
        $when = Carbon::now()->addDays(5);

        $job = (new TryANewTransaction($this))->delay($when);
        $this->dispatch($job);
      }
    }
}
