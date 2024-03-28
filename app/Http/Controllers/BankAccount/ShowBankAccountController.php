<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\src\Models\BankAccount\BankAccount;

class ShowBankAccountController extends Controller
{
    public function __invoke(BankAccount $bankAccount): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray($bankAccount->toArray());
    }
}
