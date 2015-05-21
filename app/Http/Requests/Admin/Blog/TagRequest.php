<?php namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\Request;

class TagRequest extends Request
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
        $id = $this->get('id') !== null ? ',' . $this->get('id'): '';

        return [
            'name' => 'required|max:256|unique:tags,name' . $id,
            'slug' => 'required|max:128|regex:/^[a-z0-9\-]+$/|unique:tags,slug' . $id,
        ];
    }

}
