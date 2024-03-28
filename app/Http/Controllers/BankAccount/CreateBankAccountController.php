<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankAccountRequest;
use App\src\Services\BankAccount\BankAccountServiceInterface;
use Illuminate\Http\JsonResponse;

class CreateBankAccountController extends Controller
{
    public function __construct(private readonly BankAccountServiceInterface $bankAccountService)
    {
        parent::__construct();
    }

    public function __invoke(StoreBankAccountRequest $request): JsonResponse
    {
        $bankAccount = $this->bankAccountService->create($request->validated());

        return $this->response->withArray($bankAccount->toArray());
    }
}
