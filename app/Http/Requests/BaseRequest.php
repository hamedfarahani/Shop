<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class BaseRequest extends FormRequest
{

    /**
     * @var array $dates Dates.
     */
    protected array $dates = [
        'birthdate',
        'start_date',
        'expire_date',
        'from_birthdate',
        'to_birthdate',
        'created_at',
        'from_created_at',
        'to_created_at',
        'updated_at',
        'from_updated_at',
        'to_updated_at',
        'from_verified_at',
        'to_verified_at',
        'from_rejected_at',
        'to_rejected_at',
        'from_date',
        'to_date',
        'date'
    ];

    /**
     * @return string[]
     */
    public function rules()
    {
        return [];
    }

    /**
     * failed validation
     *
     * @param Validator $validator Validator.
     *
     * @return void
     * @throws HttpResponseException Http Response Exception.
     */
    protected function failedValidation(Validator $validator)
    {

        $result = collect($validator->errors())->mapToGroups(function ($messageBag, $key) {
            if (Str::contains($key, '.'))
                $key = Str::before($key, '.');
            return [
                [
                    'fieldName' => $key,
                    'message'   => $messageBag[0]
                ]
            ];
        });

        throw new HttpResponseException(response()->json([
            'errors' => [
                'validations' => $result->first()
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
