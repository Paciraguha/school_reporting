@extends('layouts.doslayout')

@section('content')
<style>
  
    .count-input{
        background:yellow;
        display:flex;
        flex-direction:row;
        align-content:center;
        justify-content:space-around
    }
    .count-input div{
        width:100px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:space-around
    }
</style>
<div class="container"  style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">


<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between p-4 md:p-5  dark:border-gray-600">
                    <h3 id="modal-title" class=" w-[80%] text-xl font-semibold text-gray-900 dark:text-white">
                        Please provide a comment to why teacher is missing
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
                            <textarea type="text" name="comments" id="dos-Comment" rows="5" cols="5" max="255"
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


    <div class="w-full flex flex-col justify-center items-center mt-[10px] overflow-x-auto">
    <div class="flex w-2/3 py-5 rounded-sm mb-3  mx-auto items-center">
        
        <label class="w-1/2 font-bold text-[18px] text-right">check on specific date:</label><input type="date" name="toDate" id="toDate" class="w-1/3 mx-3 rounded-lg " />
        <button type="button" class="w-[170px] text-[#ffff] text-1xl font-medium bg-blue-900 h-10" id="check_date"> check</button>
    </div>
            <h3 class="py-2 border-b-2 border-red-900 my-4 w-full text-[24px]" id="table-title">
                {{ __("Teachers daily attendance on ") }}  <span id="currentdate">here<span>
            </h3>    
            
           

                        <table class="table" id="teacher-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td> Name</td>
                                <td>email</td>
                                <td>telephone</td>
                                <td>SchoolName</td>
                                <td>Class</td>
                                <td>new class<td>
                                <td>Actions</td>
                            </tr>
                        </table>
    </div>
    <!-- submit button ----------------------------------------- -->
</div>

<script>

$(document).ready(function() {
    teacherAttendanceList()
    $("#studentsAbsent-button").click(function() {
        absentStudent()
    })
    
    $("#check_date").click(async function(){
        alert("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh")
        await teacherAttendanceList()
    })


})
const token = localStorage.getItem('auth_token');
function removeAllRows() {
        const nuseryReport = document.getElementById("teacher-section-table")
        
        while (nuseryReport.firstChild) {
            nuseryReport.removeChild(nuseryReport.firstChild);
        }
    }



async function teacherAttendanceList() {
    document.getElementById("currentdate").innerText=' on '+todayDate()
    const schoolTeachers=document.getElementById("teacher-section-table")
    const urlParams = new URLSearchParams(window.location.search);
    removeAllRows()
    // const dates = urlParams.get('attendance');
    try {
        const response = await $.ajax({
            type: 'GET',
            url: '{!! route('teacherAttendanceList') !!}',
            headers: {
                'Authorization': 'Bearer ' + token,
                "Content-Type": "application/json"
            },
            dataType: 'json'
        });


        const data = response;
        let i = 0;

        for (const teachers of data) {
            i++;
            const formData = {
                teacherId: teachers.id,
                attendedDay: todayDate()
            };

            const attendanceResponse = await $.ajax({
                type: 'POST',
                url: '{!! route('checksteachersInAttendance') !!}',
                headers: {
                    'Authorization': 'Bearer ' + token,
                },
                data: formData,
                dataType: 'json'
            });
            
            const userdata = attendanceResponse.teacherId;
            const currentDate= checkToday()
            if(currentDate===todayDate()){
             
                const table=`
            <tr>
                <td class="teacher-list-${teachers.id}" >${i}</td>
                <td class="teacher-list-${teachers.id}">${teachers.firstName} ${teachers.lastName}</td>
                <td class="teacher-list-${teachers.id}">${teachers.email}</td>
                <td class="teacher-list-${teachers.id}">${teachers.Telephone}</td>
                <td class="teacher-list-${teachers.id}">${teachers.SchoolName}</td>
                <td class="teacher-list-${teachers.id}">${teachers.SchoolClass}</td>
                
                 <td id="status${teachers.id}">
                        ${teachers.id == userdata && teachers.status == 'Present' ?
                            ('<svg class="h-8 w-8 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>') :
                        teachers.id == userdata && teachers.status == 'Absent' ?
                            ('<svg class="h-7 w-7 text-red-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>')
                            :"<i class='text-[#FF0000]'>not marked</i>"
                        }
                </td>
                
                 <td class="teacher-list-${teachers.id}">
                    <button id="present${teachers.id}" class="btn btn-outline-primary" ${teachers.id == userdata && teachers.status == 'Present'?"disabled":""}  onclick="attendedStudent(${teachers.id})">Present</button>
                </td>
                <td class="teacher-list-${teachers.id}">
                    <button id="absent${teachers.id}" class="btn btn-outline-danger" ${teachers.id == userdata && teachers.status == 'Absent'?"disabled":""} onclick="openModal(${teachers.id})">Absent</button>
                </td>
                </>
                 <td class="teacher-list-${teachers.id}">
                    <button id="save_${teachers.id}" class="btn btn-success" onclick="assignClaasToTeacher(${teachers.id})">statistic</button>
                </td>
            </tr>`
            schoolTeachers.insertAdjacentHTML("beforeend",table);
        }else{
            console.log("-----------------------------------------------", teachers.firstName)
            const table=`
            <tr>
                <td class="teacher-list-${teachers.id}" >${i}</td>
                <td class="teacher-list-${teachers.id}">${teachers.firstName} ${teachers.lastName}</td>
                <td class="teacher-list-${teachers.id}">${teachers.email}</td>
                <td class="teacher-list-${teachers.id}">${teachers.Telephone}</td>
                <td class="teacher-list-${teachers.id}">${teachers.SchoolName}</td>
                <td class="teacher-list-${teachers.id}">${teachers.SchoolClass}</td>
                
                 <td id="status${teachers.id}">
                        ${teachers.id == userdata && teachers.status == 'Present' ?
                            ('<svg class="h-8 w-8 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>') :
                        teachers.id == userdata && teachers.status == 'Absent' ?
                            ('<svg class="h-7 w-7 text-red-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>')
                            :"<i class='text-[#FF0000]'>not marked</i>"
                        }
                </td>
                
                 <td class="teacher-list-${teachers.id}">
                    <button id="present${teachers.id}" class="btn btn-outline-primary" disabled>Present</button>
                </td>
                <td class="teacher-list-${teachers.id}">
                    <button id="absent${teachers.id}" class="btn btn-outline-danger"  disabled>Absent</button>
                </td>
                </>
                 <td class="teacher-list-${teachers.id}">
                    <button id="save_${teachers.id}" class="btn btn-success" onclick="assignClaasToTeacher(${teachers.id})">statistic</button>
                </td>
            </tr>`
            schoolTeachers.insertAdjacentHTML("beforeend",table);
           
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
}



















function attendedStudent(id) {
    $(`#present${id}`).attr('disabled', 'disabled');
    $(`#absent${id}`).removeAttr('disabled');

    const formData = {
        teacherId: id,
        comment: 'present',
        Status: 'Present',
        attendedDay: todayDate()
    }

    
    $.ajax({
        type: 'POST',
        url: '{!! route('newTeacherAttendance') !!}',
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
    let comment = document.getElementById("dos-Comment").value
    $(`#absent${id}`).attr('disabled', 'disabled');
    $(`#present${id}`).removeAttr('disabled');
    const formData = {
        teacherId: document.getElementById("userId").value,
        comment: comment.trim(),
        Status: 'Absent',
        attendedDay: todayDate()
    }

    console.log("------------------------------------------------------",formData)
    $.ajax({
        type: 'POST',
        url: '{!! route('newTeacherAttendance') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log(response)
            closeModal()

           // teacherAttendanceList()
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

    document.getElementById('modal-title').innerText = 'Mark teacher as an absent to class attendance and Please provide a comment to why teacher is missing'
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}


function todayDate() {
    //const urlParams = new URLSearchParams(window.location.search);
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


function checkToday(){
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); 
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;

    return formattedDate
}
</script>
@endsection


