<div class="form-group mb-3">
    <div class="row justify-content-start">
        <div class="col-2">
            <label for="name" class="form-label text-input">Название</label>
            <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название"
            value="{{$bond->name ?? null}}" required>
        </div>
        <div class="col-2">
            <label for="ticker" class="form-label ticker-input">Тикер</label>
            <input id="ticker" name="ticker"  class="form-control" type="text" placeholder="Тикер"
            value="{{$bond->ticker ?? null}}" required>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="flex">
        <div class="mr-2">
            <label for="price" class="form-label">Цена</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01" min="0"
           value="{{$bond->price ?? null}}" required>
        </div>
        <div class="mr-2">
            <label for="lots" class="form-label">Количество</label>
            <input id="lots"  name="lots" class="form-control numeric-input" type="number" step="1" min="0"
            value="{{$bond->lots ?? null}}" required>
        </div>
        <div class="mr-2">
            <label for="profit_percent" class="form-label">Доходность, %</label>
            <input id="profit_percent"  name="profit_percent" class="form-control numeric-input" type="number" step="0.01"
                   value="{{$bond->profit_percent ?? null}}" min="0">
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="flex">
        <div class="mr-2">
            <label for="coupon_percent" class="form-label">Купон, % годовых</label>
            <input id="coupon_percent"  name="coupon_percent" class="form-control numeric-input" type="number" step="0.01"
                   value="{{$bond->coupon_percent ?? null}}" min="0">
        </div>
        <div class="mr-2">
            <label for="coupon_day_period" class="form-label">Купонный период, дни</label>
            <input id="coupon_day_period"  name="coupon_day_period" class="form-control numeric-input" type="number" step="1"
                   value="{{$bond->coupon_day_period ?? null}}" min="0">
        </div>
        <div class="mr-2">
            <label for="expiration_date" class="form-label">Дата окончания</label>
            <input id="expiration_date"  name="expiration_date" class="form-control date-input" type="date"
                   placeholder="Введите дату"  value="{{$bond->expiration_date ?? null}}">
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
</form>
