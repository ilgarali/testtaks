<?php

namespace App\Http\Requests;

use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $bond = Bond::findOrFail($this->id);
        return [
            'order_date'             => 'required|date|after:'. $bond->date_of_issue .'|before:'. $bond->last_circulation_date,
            'number_of_bonds_bought' => 'required|integer'
        ];
    }

    public function getOrderDate(): string
    {
        return Carbon::parse($this->order_date)->format('Y-m-d');
    }

    public function getNumberOfBondsBought(): int
    {
        return  (int)$this->number_of_bonds_bought;
    }

    public function getId(): int
    {
        return (int)$this->id;
    }
}
