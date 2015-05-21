<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class WorkRequest extends Request
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
        $id = $this->get('id') !== null ? ',' . $this->get('id') : '';

        return [
            'slug' => 'required|max:128|regex:/^[a-z0-9\-]+$/|unique:works,slug' . $id,
            'type' => 'required|max:256',
            'name' => 'required|max:256|unique:works,name' . $id,
            'image' => 'max:256|url|unique:works,url' . $id,
            'message' => 'required',
            'text' => 'required',
        ];
    }

}
