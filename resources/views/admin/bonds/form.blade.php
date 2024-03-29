<div class="form-group mb-3">
    <div class="row justify-content-start">
        <div class="col-2">
            <label for="name" class="form-label text-input">Название</label>
            <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название">
        </div>
        <div class="col-2">
            <label for="ticker" class="form-label ticker-input">Тикер</label>
            <input id="ticker" name="ticker"  class="form-control" type="text" placeholder="Тикер">
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="flex">
        <div class="mr-2">
            <label for="price" class="form-label">Цена</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01">
        </div>
        <div class="mr-2">
            <label for="coupon" class="form-label">Купон</label>
            <input id="coupon"  name="coupon" class="form-control numeric-input" type="number"  step="0.01">
        </div>
        <div class="mr-2">
            <label for="profit_percent" class="form-label">%</label>
            <input id="profit_percent"  name="profit_percent" class="form-control numeric-input" type="number"  step="0.01">
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div>
        <label for="expiration_date" class="form-label">Дата окончания</label>
        <input id="expiration_date"  name="expiration_date" class="form-control date-input" type="date" placeholder="Введите дату">
    </div>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
</form>
