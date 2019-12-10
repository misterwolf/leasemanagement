<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  public function start(){
    $rentPlan = RentPlan::find($rentPlan->id);

    $this->beginTransaction();

    try {
      $this->mockedWithdrawal($rentPlan->conductorBankAccountId);
      $this->mockedCharge($rentPlan->conductorBankAccountId);
    }
    catch (Exception $e) {
      $this->rollBack();

      $this->success = false;
      $this->gateway_response = $e;
      $this->save;

      return false;
    }
    return true;
  }

  private function mockedWithdrawal($conductorBankAccountId){
    $bankAccount = BankAccount::find($conductorBankAccountId);
    // .....
    return true;
  }

  private function mockedCharge($lesseeBankAccountId){
    $bankAccount = BankAccount::find($lesseeBankAccountId);
    // .....
    return true;
  }
}
