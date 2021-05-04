<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class IndexArticles extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $team = $this->route('team');
        return $this->user()->can('view', $team);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => 'string',
        ];
    }
}
