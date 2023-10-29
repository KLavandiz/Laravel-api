<?php

namespace App\Http\Requests;

use App\Filters\V1\CustomerFilters;
use App\Http\Resources\V1\CustomerCollection;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomerApiRequest extends FormRequest
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
        return [
            //
        ];
    }


    public function checkQuery(Request $request){
        $filter = new CustomerFilters();
        
        $queryItems = $filter->transform($request); //['column','operator','value']
        

        if(count($queryItems)==0){
            return new CustomerCollection(Customer::paginate());
        }else{
            return new CustomerCollection(Customer::where($queryItems)->paginate());
        }
    }

    
}
