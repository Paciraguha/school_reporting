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
<div class="container" style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">

    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between p-4 md:p-5  dark:border-gray-600">
                    <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                        Mark students as an absent to class attendance
                    </h3>
                    <button type="button" onclick="closeModal()"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <p id="modal-content">
                </p>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="#" id="assignSchoolForm">
                        <div id="userId-sesction"></div>
                        <div>
                            <label for="sector-options"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teacher
                                Comments</label>
                            <textarea type="text" name="comments" id="teacher-Comment" rows="5" cols="5" max="255"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white text-left">
                        </textarea>
                        </div>
                    </form>
                </div>
            </div class="w-full flex">
            <div class="p-4 border-t text-left">
                <button type="button" id="studentsAbsent-button"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mark
                    Absent</button>
            </div>
        </div>
        <div>

        </div>
    </div>

    <div class="w-full flex flex-col justify-center items-center mt-[50px] overflow-x-auto">

        <h3 class="py-2 border-b-2 border-red-900 my-4 w-full text-[24px]" id="table-title">
            {{ __("Student attended class") }}  <span id="currentdate">here<span>
        </h3>
        <div class="flex w-2/3 py-5 rounded-sm mb-3  mx-auto items-center">
        
         <label class="w-1/2 font-bold text-[18px] text-right">check on specific date:</label><input type="date" name="toDate" id="toDate" class="w-1/3 mx-3 rounded-lg " />
         <button type="button" class="w-[170px] text-[#ffff] text-1xl font-medium bg-blue-900 h-10" id="check_date"> check</button>
      </div>

        <table class="table" >
            <theady>
                <tr class='w-full font-semibold'>
                    <td rowspan="2">No</td>
                    <td> Student Code</td>
                    <td> Class Level</td>
                    <td>FirstName</td>
                    <td>LastName</td>
                    <td>Gender</td>
                    <td>status</td>
                    <td colspan="2">Attendance</td>
                </tr>
            </theady>
            <tbody id="student-section-table">

            </tbody >
           
        </table>
    </div>
</div>
</div>
<!-- submit button ----------------------------------------- -->
</div>

<script>
const token = localStorage.getItem('auth_token');
$(document).ready(function() {
    getAllStudent()
    $("#studentsAbsent-button").click(function() {
        absentStudent()
    })

    $("#sector-options").change(function() {
        getAllSchool()
    })


    $("#check_date").click(async function(){
        await getAllStudent()
    })


   
})

function removeAllRows() {
        const nuseryReport = document.getElementById("student-section-table")
        
        while (nuseryReport.firstChild) {
            nuseryReport.removeChild(nuseryReport.firstChild);
        }
    }


async function getAllStudent() {
    removeAllRows()
    const schools = document.getElementById("student-section-table");
    const urlParams = new URLSearchParams(window.location.search);
     const ClassId = urlParams.get('studentsClass');
    try {
        const response = await $.ajax({
            type: 'GET',
            url: '{!! route('getAllStudent') !!}',
            headers: {
                'Authorization': 'Bearer ' + token,
                "Content-Type": "application/json"
            },
            data:{
             ClassId
            },
            dataType: 'json'
        });

        const data = response;
        let i = 0;

        for (const student of data) {
            i++;
            const formData = {
                studentCode: student.id,
                attendedDay: todayDate()
            };

            const attendanceResponse = await $.ajax({
                type: 'GET',
                url: '{!! route('checkstudentsInAttendance') !!}',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    "Content-Type": "application/json"
                },
                data: formData,
                dataType: 'json'
            });
            
            const userdata = attendanceResponse.StudentCode;
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); 
            const day = String(today.getDate()).padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;




            if(formattedDate===todayDate()){
             
            const tableRow = `
                <tr>
                    <td id="report-expected-men-nusery">${i}</td>
                    <td id="report-expected-men-nusery">${student.StudentCode}</td>
                    <td id="report-expected-men-nusery">${student.SchoolClass}</td>
                    <td id="report-expected-women-nusery">${student.FirstName}</td>
                    <td id="report-expected-women-nusery">${student.LastName}</td>
                    <td id="report-expected-women-nusery">${student.Gender}</td>
                    <td id="status${student.id}">
                        ${student.id == userdata && attendanceResponse.Status == 'Present' ?
                            ('<svg class="h-8 w-8 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>') :
                        student.id == userdata && attendanceResponse.Status == 'Absent' ?
                            ('<svg class="h-7 w-7 text-red-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>')
                            :"<i class='text-[#FF0000]'>not marked</i>"
                        }
                    </td>
                   <td id="report-expected-total-nusery"><button class="btn btn-primary" id="present${student.id}" onclick="attendedStudent(${student.id})" ${student.id == userdata && attendanceResponse.Status == 'Present'?"disabled":""}>Present</button></td>
                   <td id="report-attended-men-nusery"><button class="btn btn-danger" id="absent${student.id}" onclick="openModal(${student.id})" ${student.id == userdata && attendanceResponse.Status == 'Absent'?"disabled":""}>Absent</button></td>
                </tr>
            `;
            schools.insertAdjacentHTML("beforeend", tableRow);
        }else{

            const tableRow = `
                <tr>
                    <td id="report-expected-men-nusery">${i}</td>
                    <td id="report-expected-men-nusery">${student.StudentCode}</td>
                    <td id="report-expected-men-nusery">${student.SchoolClass}</td>
                    <td id="report-expected-women-nusery">${student.FirstName}</td>
                    <td id="report-expected-women-nusery">${student.LastName}</td>
                    <td id="report-expected-women-nusery">${student.Gender}</td>
                    <td id="status${student.id}">
                        ${student.id == userdata && attendanceResponse.Status == 'Present' ?
                            ('<svg class="h-8 w-8 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>') :
                        student.id == userdata && attendanceResponse.Status == 'Absent' ?
                            ('<svg class="h-7 w-7 text-red-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>')
                            :"<i class='text-[#FF0000]'>not marked</i>"
                        }
                    </td>
                    <td id="report-expected-total-nusery"><button class="btn btn-primary" disabled>Present</button></td>
                    <td id="report-attended-men-nusery"><button class="btn btn-danger" disabled></button></td>
                </tr>
            `;
            schools.insertAdjacentHTML("beforeend", tableRow);
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
}



function todayDate() {
    const urlParams = new URLSearchParams(window.location.search);
    const checkDate=document.getElementById("toDate").value;
    if(checkDate){
       
        return checkDate
    }else{

    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); 
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;

    return formattedDate
    }
}

document.getElementById("currentdate").innerText=' on '+todayDate()

function attendedStudent(id) {
    $(`#present${id}`).attr('disabled', 'disabled');
    $(`#absent${id}`).removeAttr('disabled');

    const formData = {
        StudentCode: id,
        comment: 'present',
        Status: 'Present',
        attendedDay: todayDate()
    }
    $.ajax({
        type: 'POST',
        url: '{!! route('studentsAttendance') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        data: formData,
        dataType: 'json',
        success: function(response) {
            document.getElementById("status"+id).innerHTML=`<svg class="h-8 w-8 text-indigo-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`
            //  window.location.reload()
        },
        error: function(xhr, status, error) {
        }
    });
}

function absentStudent() {
    let id = document.getElementById("userId").value
    let comment = document.getElementById("teacher-Comment").value
    $(`#absent${id}`).attr('disabled', 'disabled');
    $(`#present${id}`).removeAttr('disabled');
    const formData = {
        StudentCode: document.getElementById("userId").value,
        comment: comment.trim(),
        Status: 'Absent',
        attendedDay: todayDate()
    }

    $.ajax({
        type: 'POST',
        url: '{!! route('studentsAttendance') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log(response)
            closeModal()
            document.getElementById("userId").remove();
            document.getElementById("status"+id).innerHTML=`<svg class="h-7 w-7 text-red-600"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>`
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.log(error);
        }
    });
}

function openModal(user) {
    var form_container = document.getElementById("userId-sesction");
    var input = document.createElement("input");
    input.type = "text";
    input.name = "userId";
    input.value = `${user}`;
    input.id = "userId";
    input.hidden = "readonly";
    form_container.appendChild(input);

    document.getElementById('modal-title').innerText = 'Mark students as an absent to class attendance'
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endsection