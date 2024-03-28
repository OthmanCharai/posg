<?php

namespace App\Http\Resources;

use App\src\Models\Supplier\Supplier;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public static function staticToArray($supplier): array
    {
        // Assuming $supplier is an instance of Supplier
        return [
            Supplier::ID_COLUMN             => $supplier->getId(),
            Supplier::EMAIL_COLUMN          => $supplier->getEmail(),
            Supplier::PHONE_NUMBER_COLUMN   => $supplier->getPhoneNumber(),
            Supplier::FIRST_NAME_COLUMN     => $supplier->getFirstName(),
            Supplier::LAST_NAME_COLUMN      => $supplier->getLastName(),
            Supplier::ACCOUNT_NUMBER_COLUMN => $supplier->getAccountNumber(),
            Supplier::VAT_NUMBER_COLUMN     => $supplier->getVatNumber(),
            Supplier::COMPANY_NAME_COLUMN   => $supplier->getCompanyName(),
            Supplier::ADDRESS_COLUMN        => $supplier->getAddress(),
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return self::staticToArray($this->resource);
    }
}
