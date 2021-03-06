<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        'name' => 'bail|required|min:2|max:255'
    ];
}
    /**
 * Получить сообщения об ошибках для определённых правил проверки.
 *
 * @return array
 */
    public function messages()
    {
      return [
        'name.required' => 'Название ввели не корректно!'
    ];
}
}
