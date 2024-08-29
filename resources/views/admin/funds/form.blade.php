<div class="form-group mb-3">
    <div class="flex">
        <div class="mr-2">
            <label for="name" class="form-label">Название</label>
            <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название"
            required value="{{$fund->name ?? null}}">
        </div>
        <div class="mr-2">
            <label for="ticker" class="form-label">Тикер</label>
            <input id="ticker" name="ticker"  class="form-control ticker-input" type="text" placeholder="Тикер"
            required value="{{$fund->ticker ?? null}}">
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="flex">
        <div class="mr-2">
            <label for="price" class="form-label">Цена</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01"
                  required  placeholder="Введите число" value="{{$fund->price ?? null}}" min="0">
        </div>
        <div>
            <label for="lots" class="form-label">Количество</label>
            <input id="lots"  name="lots" class="form-control numeric-input" type="number" step="0.01"
                  required placeholder="Введите число" value="{{$fund->lots ?? null}}" min="0">
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>


