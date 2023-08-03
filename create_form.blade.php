<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;

        }

        #formsContainer {
            display: grid;
            grid-gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            max-width: 1200px;
            margin: 0 auto;

        }

        form {
            padding: 10px 10px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .subject-field {
            display: flex;
            align-items: center;
        }

        .subject-field input[type="text"] {

            flex-grow: 1;
            margin-right: 10px;
            margin-left: 4px;
        }

        .subject-field .input-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 740px;
            Set the width of the "input-group" container
        }

        .subject-field button {
            flex-shrink: 0;
        }

        .subject-field .input-group-append {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"] {
            width: 100%;
            padding: 5px;
            margin: 5px -3px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        a {
            display: inline-block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
        }


        a:hover {
            text-decoration: underline;
        }

        form input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #3ab63c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        form input[type="submit"]:hover {
            background-color: #2b832c;
        }

        .horiFileds {
            display: flex;
            justify-content: space-between;
            justify-items: center;
            gap: 24px;
            align-items: center;
        }
    </style>
</head>

<body>

    <div>
        <h2 style="margin-top: 15px;">Add new entries</h2>
        <div style="margin-bottom: 10px">

            <a href="#" onclick="addNewForm()">Add New Entry</a>
        </div>

        <div id="formsContainer"></div>
        @if($errors->any())
        <div class="text-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    

    <script>
        let numberOfForms = 0;
        const formsContainer = document.getElementById('formsContainer');
    
        function addNewForm() {
            numberOfForms++;
            const formHtml = `
            <form name="createForm${numberOfForms}" method="post" action="{{ route('students.store') }}">
            @csrf
                   
                    <div>
                        <label>Standard</label>
                        <input type="text" name="standard" placeholder="Enter standard" />
                        @error('standard')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label>Capacity</label>
                        <input type="text" name="capacity" placeholder="Enter capacity" />
                        @error('capacity')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    
                    <div id="subjectFieldsContainer">
                    <label>Subjects</label>
                   <div class="horiFileds">
                    <input type="text" name="subjects[]" class="form-control" placeholder="Enter subject" >
                    <div class="input-group-append">
                    <button type="button" class="btn btn-success" onclick="addNewSubjectField()">+</button>
                </div>
                     </div>
                     @error('subjects.*')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                        <label>Class teacher</label>
                        <input type="text" name="teacher" placeholder="Enter class teacher's name" />
                        @error('teacher')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                   
                    <div>
                        <input type="submit" value="Create" />
                    </div>
                </form>
                
            `;
    
            formsContainer.insertAdjacentHTML('beforeend', formHtml);
        }
    
        function addNewSubjectField() {
            const subjectFieldsContainer = document.getElementById('subjectFieldsContainer');
            const newSubjectField = document.createElement('div');
            newSubjectField.className = 'subject-field form-group';
            newSubjectField.innerHTML = `
        <label for="subjects">Subjects</label>
        <div class="input-group">
            <input type="text" name="subjects[]" class="form-control" >
            <div class="input-group-append">
                <button type="button" class="btn btn-danger" onclick="removeSubjectField(this)">-</button>
            </div>
        </div>
    `;
            subjectFieldsContainer.appendChild(newSubjectField);
        }
    
        function removeSubjectField(button) {
            const subjectField = button.parentElement.parentElement.parentElement;
            subjectField.remove();
        }
    </script>
    

</body>

</html>
