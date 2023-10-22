<div class="form-group">
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название" >
    </div>
</div>
<div class="form-group">
    <div class="mb-3">
        <label for="ticker" class="form-label">Тикер</label>
        <input id="ticker" name="ticker"  class="form-control" type="text" placeholder="Введите название" >
    </div>
</div>

<div class="form-group">
    <div class="mb-3">
        <label for="price" class="form-label">Цена</label>
        <input id="price"  name="price" class="form-control" type="number" step="0.01" placeholder="Введите число" value="1000">
    </div>
</div>
<div class="form-group">
    <div class="mb-3">
        <label for="coupon" class="form-label">Купон</label>
        <input id="coupon"  name="coupon" class="form-control" type="number"  step="0.01" placeholder="Введите число">
    </div>
</div>
<div class="form-group">
    <div class="mb-3">
        <label for="profit_percent" class="form-label">%</label>
        <input id="profit_percent"  name="profit_percent" class="form-control" type="number"  step="0.01" placeholder="Введите число">
    </div>
</div>

<div class="form-group">
    <div class="mb-3">
        <label for="expiration_date" class="form-label">Дата окончания</label>
        <input id="expiration_date"  name="expiration_date" class="form-control" type="date" placeholder="Введите дату">
    </div>
</div>
<div class="form-group">
    <div class="mb-3">
        <label for="direction_id" class="form-label">Выбор направления</label>
        <select class="form-select" aria-label="Default select example" id="industry_id" name="direction_id">
            @foreach($directions as $direction)
                <option value="{{$direction->id}}">{{$direction->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>


