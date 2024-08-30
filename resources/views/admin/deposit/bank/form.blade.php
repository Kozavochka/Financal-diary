<div class="form-group mb-3">
    <div class="row">
        <div class="col-2">
            <label for="name" class="form-label">Название</label>
            <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                   value="{{$bank->name ?? null}}" required>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
