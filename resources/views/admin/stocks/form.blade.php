<div class="form-group mb-3">
    <div class="row">
        <div class="col-2">
            <label for="name" class="form-label">Название</label>
            <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                   value="{{$stock->name ?? null}}" required>
        </div>
        <div class="col-1">
            <label for="ticker" class="form-label">Тикер</label>
            <input id="ticker" name="ticker"  class="form-control ticker-input" type="text" placeholder="Тикер"
                   value="{{$stock->ticker ?? null}}" required>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="row">
        <div class="col-1">
            <label for="price" class="form-label">Цена за лот</label>
            <input id="price"  name="price" class="form-control numeric-input" type="number" step="0.01"
                   min="0"
                   value="{{$stock->price ?? null}}" required>
        </div>
        <div class="col-2">
            <label for="lots" class="form-label">Количество лотов</label>
            <input id="lots"  name="lots" class="form-control numeric-input" type="number"
                   min="0"
                   value="{{ $stock->lots ?? null }}" required>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="mb-3">
        <label for="industry_id" class="form-label">Выбор отрасли</label>
        <select class="form-select text-input" aria-label="Default select example" id="industry_id" name="industry_id" required>
            <option value="{{ old('industry_id', $stock?->industry_id ?? null) }}">{{$stock?->industry->name ?? null}}</option>
            @foreach($industries as $industry)
                <option value="{{$industry->id}}">{{$industry->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>


