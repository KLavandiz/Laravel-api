<?php

namespace App\Http\Requests;

use App\Filters\V1\InvoiceFilters;
use App\Http\Resources\V1\InvoiceCollection;
use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class InvoiceApiRequest extends FormRequest
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
        $filter = new InvoiceFilters();
        
        $queryItems = $filter->transform($request); //['column','operator','value']
        

        if(count($queryItems)==0){
            return new InvoiceCollection(Invoice::paginate());
        }else{
            return new InvoiceCollection(Invoice::where($queryItems)->paginate());
        }
    }
}
