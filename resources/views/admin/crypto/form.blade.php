<div class="form-group mb-3">
    <div class="flex">
        <div class="mr-2">
            <label for="name" class="form-label">Название</label>
            <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
            required value="{{$crypto->name ?? null}}">
        </div>
        <div class="mr-2">
            <label for="ticker" class="form-label">Тикер</label>
            <input id="ticker" name="ticker"  class="form-control ticker-input" type="text" placeholder="Тикер"
            required value="{{$crypto->ticker ?? null}}">
        </div>
    </div>
</div>

<div class="form-group">
    <div class="flex">
        <div class="mr-2">
            <label for="price" class="form-label">Стоимость</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01" min="0"
            required value="{{$crypto->price ?? null}}">
        </div>
        <div class="mr-2">
            <label for="lots" class="form-label">Количество лотов</label>
            <input id="lots"  name="lots" class="form-control" type="number" step="0.00001" min="0"
            required value="{{$crypto->lots ?? null}}">
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>
