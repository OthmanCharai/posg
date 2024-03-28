<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\src\Models\BankAccount\BankAccount;
use App\src\Services\BankAccount\BankAccountServiceInterface;

class DeleteBankAccountController extends Controller
{
    public function __construct(private readonly BankAccountServiceInterface $bankAccountService)
    {
        parent::__construct();
    }

    public function __invoke(BankAccount $bankAccount): \Illuminate\Http\JsonResponse
    {
        $this->bankAccountService->delete($bankAccount);

        return $this->response->withSuccess('bank account deleted with success');
    }
}
