<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;

class WorkersListRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'department_id' => 'int|exists:' . Department::class . ',id',
            'query' => 'string',
            'position_id' => 'int|exists:' . Position::class . ',id',
        ];
    }
}
