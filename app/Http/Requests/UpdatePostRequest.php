<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->post->user_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required' ,
                'max:256' ,
                Rule::unique('posts' , 'title')->ignore($this->post->id)
            ] ,
            'content' => ['required' , 'min:10' , Rule::unique('posts', 'title')->ignore($this->post->id)]
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->session()->flash('post_id', $this->post->id);
        });
    }

    public function messages()
    {
        return [
            'title.unique' => 'Same Title is used in another post' ,
        ];
    }

}
