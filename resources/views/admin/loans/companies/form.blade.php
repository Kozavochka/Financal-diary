<div class="form-group mb-3">
    <div class="row">
        <div class="col-2">
            <label for="name" class="form-label">Название</label>
            <input id="name" name="name"  class="form-control text-input" type="text" placeholder="Введите название"
                   value="{{$company->name ?? null}}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="inn" class="form-label">ИНН</label>
            <input id="inn" name="inn"  class="form-control text-input" type="text"
                   value="{{$company->inn ?? null}}">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <label for="ogrn" class="form-label">ОГРН</label>
            <input id="ogrn" name="ogrn"  class="form-control text-input" type="text"
                   value="{{$company->ogrn ?? null}}">
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Сохранить</button>
