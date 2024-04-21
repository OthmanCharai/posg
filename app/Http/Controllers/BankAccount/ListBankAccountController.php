<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\Controller;
use App\src\Models\BankAccount\BankAccount;
use App\src\Services\BankAccount\BankAccountServiceInterface;
use Illuminate\Http\Request;
use YouCanShop\QueryOption\QueryOptionFactory;

class ListBankAccountController extends Controller
{
    public function __construct(private readonly BankAccountServiceInterface $bankAccountService)
    {
        parent::__construct();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->response->withArray(
            [
                BankAccount::TABLE_NAME => $this->bankAccountService
                    ->getPaginated(
                        QueryOptionFactory::createFromIlluminateRequest($request)
                    ),
            ]
        );
    }
}
