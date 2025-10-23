<?php

namespace App\Http\Requests;

use App\Data\ContactData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class ContactEditRequest extends FormRequest
{
    /**
     * @return array<string, string[]>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'position' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'zip' => ['required', 'min:5'],
            'email' => ['required', 'email', 'max:254'],
            'phone' => ['required', 'min:7', 'max:50'],
            'company' => ['nullable', 'max:100'],
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function toDto(): ContactData
    {
        $data = $this->toArray();
        $data['id'] = null;

        return ContactData::from($data);
    }
}
