@extends('layouts.doslayout')

@section('content')
<style>
.count-input {
    background: yellow;
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-around
}

.count-input div {
    width: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around
}
</style>
<div class="flex flex-col w-full md:w-[100%]  border border-amber-300 px-5 py-8 mt-12">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <a href="{{route('teacherDailyAttendance')}}"
            class="w-[250px] float-end text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Teachers daily attendance list
        </a>
        <div class="inline-block min-w-full  sm:px-6 lg:px-8">

            <h3 class="py-2 border-b-2 border-red-900 my-4 w-full text-2xl" id="table-title">
                {{ __("All teachers of school") }}
            </h3>
            <div class="overflow-hidden mx-auto">
                <table class="table" >
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th class="px-2 py-2"> Name</th>
                            <th class="px-2 py-2">email</th>
                            <th class="px-2 py-2">telephone</th>
                            <th class="px-2 py-2">School Name</th>
                            <th class="px-2 py-2">Class</th>
                            <th class="px-2 py-2">Assign new class</th>
                            <th class="px-2 py-2">Actions</th>
                        </tr>
                    </thead>
                   <tbody id="teacher-section-table"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- submit button ----------------------------------------- -->
</div>

<script>
const token = localStorage.getItem('auth_token');
async function testButton() {
    let dropdownList = [];
    let classDropDown = "";
    const schoolTeachers = document.getElementById("teacher-section-table")
    const response = await fetch(`{!! route('apiGetSchoolClass') !!}`, {
        headers: {
            'Authorization': 'Bearer ' + token
        },
    });
    const schoolClasses = await response.json();
    let i = 0;
    schoolClasses.forEach((elem) => {
        i++
        options = `<Option value="${elem.id}">${elem.SchoolClass}</Option> `
        dropdownList.push(options)
    })


    const response1 = await fetch(`{!! route('apiGetAllSchoolTeachers') !!}`, {
        headers: {
            'Authorization': 'Bearer ' + token
        },
    });

    const teachers = await response1.json();
    console.log(teachers)
    let b = 0;
    teachers.forEach((elem) => {
        b++
        const table = `
            <tr>
                <td class="teacher-list-${elem.id}" >${b}</td>
                <td class="teacher-list-${elem.id}">${elem.firstName} ${elem.lastName}</td>
                <td class="teacher-list-${elem.id}">${elem.email}</td>
                <td class="teacher-list-${elem.id}">${elem.Telephone}</td>
                <td class="teacher-list-${elem.id}">${elem.SchoolName}</td>
                <td class="teacher-list-${elem.id}">${elem.SchoolClass}</td>
                <td class="teacher-list-${elem.id}"><select class=" btn btn-outline-info" onChange="assignClaasToTeacher(${elem.id})" id="${elem.id}">
                <option readonly>new class</option>${dropdownList}</select></td>
                 <td class="teacher-list-${elem.id}">
                    <a href=""  id="save_${elem.id}" class="btn btn-success">Attendance</a>
                </td>
            </tr>`
        schoolTeachers.insertAdjacentHTML("beforeend", table);
    })

}


testButton();

function assignClaasToTeacher(id) {
    const el = document.getElementById(id)
    const classes = el.options[el.selectedIndex].value;
    const data = {
        TeacherId: id,
        ClassId: classes
    }
    console.log(data)
    const saveData = fetch(`{!! route('apiAssignClassToTeacher') !!}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },

            method: 'post',
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
            window.location.reload()
        })
}
</script>
@endsection