<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentPlan extends Model
{
  public static function check_daily_rent_plan() { # better batching here
    $numerbOfToday = Carbon::now()->format('d');

    if ($numerbOfToday > 28){
      return null;
    }

    $rentPlansToBeRenewed = RentPlan::where('renewal_day', $numerbOfToday, 'active', true)->get();

    @foreach ($rentPlansToBeRenewed as $rentPlan) {
      if ($rentPlan->monthlyPayments.size < 13) {
        $montlyPayment = new MonthlyPayment($rentPlan);

        $montlyPayment.save
      } else {
        $rentPlan->active = false;
        $rentPlan->save;
      }
    }
  }

  public function monthlyPayments() {
      return $this->hasMany('App\MonthlyPayment');
  }
}
