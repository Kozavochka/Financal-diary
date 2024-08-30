<div class="form-group">
    <label for="company_id" class="form-label">Юр лицо</label>
    <select class="form-select text-input" aria-label="Default select example" id="company_id" name="company_id" required>
        @if(isset($loan))
            <option value="{{$loan->company_id}}">{{$loan->company->name}}</option>
        @endif
        @foreach($companies as $company)
            <option value="{{$company->id}}">{{$company->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <div class="flex">
        <div class="mr-2">
            <label for="price" class="form-label">Цена</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01" min="0"
            >
        </div>
        <div class="mr-2">
            <label for="percent" class="form-label">Процент годовых</label>
            <input id="percent"  name="percent" class="form-control numeric-input" type="number" step="0.01" min="0"
            >
        </div>
    </div>
</div>
<div class="form-group">
    <div>
        <label for="repayment_schedule_type" class="form-label">Тип погашения</label>
        <select class="form-select text-input" aria-label="Default select example" id="repayment_schedule_type"
                name="repayment_schedule_type" >
            @if(isset($loan))
                <option value="{{$loan->repayment_schedule_type}}">
                    {{\App\Enums\LoanRepaymentScheduleTypeEnum::getTranslate($loan->repayment_schedule_type)}}
                </option>
            @endif
            @foreach(\App\Enums\LoanRepaymentScheduleTypeEnum::toArray() as $label => $value)
                <option value="{{$value}}">{{$label}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="payment_type" class="form-label">Тип платежа</label>
        <select class="form-select text-input" aria-label="Default select example" id="payment_type"
                name="payment_type">
            @if(isset($loan))
                <option value="{{$loan->payment_type}}">
                    {{\App\Enums\LoanPaymentTypeEnum::getTranslate($loan->payment_type)}}
                </option>
            @endif
            @foreach(\App\Enums\LoanPaymentTypeEnum::toArray() as $label => $value)
                <option value="{{$value}}">{{$label}}</option>
            @endforeach
        </select>
    </div>

    <div class="flex">
        <div class="mr-2">
            <label for="payment_day" class="form-label">День оплаты</label>
            <input id="payment_day"  name="payment_day" class="form-control numeric-input" type="number" step="1" min="1" value="1">
        </div>
        <div class="mr-2">
            <label for="expiration_date">Дата окончания</label>
            <input id="expiration_date"  name="expiration_date" class="form-control date-input" type="date"
                   >
        </div>
    </div>

</div>

<button type="submit" class="btn btn-primary">Сохранить</button>
