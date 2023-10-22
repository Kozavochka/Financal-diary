<div class="form-group">
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input id="name" name="name"  class="form-control" type="text" placeholder="Введите название" >
    </div>
</div>

<div class="form-group">
    <div class="mb-3">
        <label for="price" class="form-label">Цена</label>
        <input id="price"  name="price" class="form-control" type="number" step="0.01" placeholder="Введите число">
    </div>
</div>

<div class="form-group">
    <div class="mb-3">
        <label for="count_bus" class="form-label">Количество компаний</label>
        <input id="count_bus"  name="count_bus" class="form-control" type="number" step="0.01" placeholder="Введите число">
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


