<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBankAccountRequest;
use App\src\Models\BankAccount\BankAccount;
use App\src\Services\BankAccount\BankAccountServiceInterface;

class UpdateBankAccountController extends Controller
{
    public function __construct(private readonly BankAccountServiceInterface $bankAccountService)
    {
        parent::__construct();
    }

    public function __invoke(BankAccount $bankAccount, UpdateBankAccountRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->bankAccountService->update($bankAccount, $request->validated());

        return $this->response->withArray($this->bankAccountService->find($bankAccount->getId())?->toArray());
    }
}