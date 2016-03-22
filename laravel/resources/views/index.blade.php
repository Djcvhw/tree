<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
    <h1>Генеалогическое древо</h1>
    <div>
        <h3>Создать семью</h3>
        <p><label for=""><input type="text" name="family" class="js__family--name"></label></p>
        <p><label for=""><input type="submit" class="js__family--create" value="Добавить"></label></p>
    </div>
    <div>
        <h3>Создать человека</h3>
        <p><label for="">Выбрать семью
                <select name="family" id="" class="js__family--select">
                    <option value="0">Выберите семью</option>
                    @foreach ($families as $family)
                    <option value="{{$family->id}}">{{$family->name}}</option>
                    @endforeach
                </select>
            </label>
        </p>
        <p><label for="">Имя<input type="text" name="name" class="js__unit--name"></label></p>
        <p><label for="">Основатель?<input type="checkbox" name="patriarch" class="js__patriarch"></label></p>
        <p><label for="">Родитель 1
                <select name="parent_1" id="" class="js__parent_1">
                    <option value="0">Выберите человека</option>
                    @foreach ($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endforeach
                </select>
            </label>
        </p>
        <p><label for="">Родитель 2
                <select name="parent_2" id="" class="js__parent_2">
                    <option value="0">Выберите человека</option>
                    @foreach ($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endforeach
                </select>
            </label>
        </p>
        <p><label for=""><input type="submit" class="js__unit--create" value="Добавить человека"></label></p>
    </div>
    <div>
        <h3>Показать древо</h3>
        <p><label for="">Выбрать человека
            <select name="unit" id="" class="js__get-tree">
                <option value="0">Выберите человека</option>
                @foreach ($units as $unit)
                <option value="{{$unit->id}}">{{$unit->name}}</option>
                @endforeach
            </select>
            </label>
        </p>
        <p><label for=""><input type="submit" class="js__unit--show" value="Показать древо"></label></p>
    </div>
    <div class="js__tree">
        
    </div>
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="{{asset('js/jquery-2.2.2.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>