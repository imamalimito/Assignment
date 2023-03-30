<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>Create Teacher</h3>
        <form action="">
            <div class="form-group">
                <label for="">Division</label>
                <select name="division" id="division" class="form-control">
                    <option value="">SELECT DIVISION</option>
                    @foreach($divisions as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">District</label>
                <select name="district" id="district" class="form-control">
                    <option value="">SELECT DISTRICT</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#division").change(function(){
                var division_id = $(this).val();
                $("#district").empty();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/districts/'+division_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        var districts = response.districts;
                        var len = districts.length;
                        str = ' <option value="">SELECT DISTRICT</option>';
                        for(var i=0; i<len; i++){
                            str += '<option value="'+districts[i].id+'">'+districts[i].name+'</option>'
                            
                        }
                        $("#district").append(str);
                    }
                });
            });
            $("#submitBtn").click(function(evt){
                evt.preventDefault();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/store-teacher',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        teacher_division: $("#division").val(),
                        teacher_district: $("#district").val(),
                        teacher_name: $("#name").val()
                    },
                    success: function(response){
                        console.log(response.msg)
                    }
                });
            });
        });
    </script>
</body>
</html>