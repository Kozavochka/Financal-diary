<div class="form-group mb-3">
    <div class="mb-1">
        <label for="bank_id" class="form-label">Банк</label>
        <select class="form-select text-input" aria-label="Default select example" id="bank_id" name="bank_id" required>
           @if(isset($deposit))
                <option value="{{$deposit->bank->id}}">{{$deposit->bank->name}}</option>
           @endif
            @foreach($banks as $bank)
                <option value="{{$bank->id}}">{{$bank->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="type" class="form-label">Тип</label>
        <select class="form-select text-input" aria-label="Default select example" id="type" name="type" required>
            @if(isset($deposit))
                <option value="{{$deposit->type}}">{{\App\Enums\DepositTypeEnum::getTranslate($deposit->type)}}</option>
            @endif
            @foreach(\App\Enums\DepositTypeEnum::toArray() as $label => $value)
                <option value="{{$value}}">{{$label}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="flex">
        <div class="mr-2">
            <label for="price" class="form-label">Сумма</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01"
                   required  value="{{$deposit->price ?? null}}">
        </div>
        <div class="mr-2">
            <label for="percent" class="form-label">Процент годовых</label>
            <input id="percent"  name="percent" class="form-control numeric-input" type="number" step="0.01"
                   required  value="{{$deposit->percent ?? null}}">
        </div>
        <div class="mr-2">
            <div>
                <label for="expiration_date">Дата окончания</label>
                <input id="expiration_date"  name="expiration_date" class="form-control date-input" type="date" placeholder="Введите дату"
                       required value="{{$deposit->expiration_date ?? null}}">
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>
