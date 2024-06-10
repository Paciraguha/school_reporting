@extends('layouts.teacherlayout')

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

    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between p-4 md:p-5  dark:border-gray-600">
                    <h3  id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                      Mark students as an absent to class attendance
                    </h3>
                    <button type="button"  onclick="closeModal()" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
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
                        <label for="sector-options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teacher Comments</label>
                        <textarea type="text" name="comments"  id="teacher-Comment" rows="5" cols="5" max="255"
                           class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white text-left" 
                        >
                        </textarea>
                    </div>
                </form>
                </div>
            </div class="w-full flex" >
                <div class="p-4 border-t text-left">
                <button type="button" id="studentsAbsent-button"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mark Absent</button>
                </div>
            </div>
            <div>
        
        </div>
    </div>

    <div class="w-full flex flex-col justify-center items-center mt-[50px] overflow-x-auto" >
       
        <h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
         {{ __("Student list in class") }}
        </h3>

       
                        <table class="table" id="student-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td> School Code</td>
                                <td> Student Code</td>
                                <td> Class Level</td>
                                <td>FirstName</td>
                                <td>LastName</td>
                                <td>Gender</td>
                                <td colspan="2">Attendance</td>
                            </tr>
                        </table>
            </div>
        </div>
    </div>
    <!-- submit button ----------------------------------------- -->
</div>

<script>

const token=localStorage.getItem('auth_token');
 $(document).ready(function() {
    getAllStudent()
    $("#studentsAbsent-button").click(function(){
        absentStudent()
    })

    $("#sector-options").change(function(){
        getAllSchool()
    })

    $("#school-options").change(function(){
        getAllSchoolClasses()
    })
    

        function getAllSchoolClasses(){
        const classes= document.getElementById("class-options");
        const school = document.getElementById("school-options").value;
        //const url = `/api/schools/${sector}`;
        const url=`/api/schoolClasses/${school}`;
        const myNode = document.getElementById("class-options");
        while (myNode.firstChild) {
            myNode.removeChild(myNode.lastChild);
        }
        const options=`
            <Option>select school in this sector</Option>
            `
        classes.insertAdjacentHTML("beforeend",options);

        //console.log(sector)
        $.ajax({
            type: 'GET',
            url:url,
            headers: {
            'Authorization': 'Bearer ' + token
             },

            dataType: 'json',
            success: function(response) {
                const data=response;
                console.log(data)
                let i=0;
                data.forEach((response)=>{
                i++
                const options=`<Option value="${response.id}">${response.SchoolClass}</Option> `
                classes.insertAdjacentHTML("beforeend",options);
            })
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
        }
        function formValue(){
        // alert("testttt")
        let SectorCode=document.getElementById("sector-options").value
        let SchoolCode=document.getElementById("school-options").value
        let ClassLevel=document.getElementById("class-options").value
        let Gender=document.getElementById("gender-options").value
        let FirstName=document.getElementById("firstName").value
        let LastName=document.getElementById("lastName").value
 

        const data={
        SchoolCode,
        ClassLevel,
        Gender,
        FirstName,
        LastName,
        }
        return data
        }

        function addNewHeadTeacher(){
                const formData =formValue();
              //  console.log(formData)
                   
                    //window.location.reload()
                }
        })

function getAllStudent(){
    const schools=document.getElementById("student-section-table")
   
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllStudent') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {

            const data=response;
            console.log("----------------------------------------",response)
            let i=0;
            data.forEach((response)=>{
           
           i++
            const table1=`
            <tr>
                <td id="report-expected-men-nusery">${i}</td>
                <td id="report-expected-men-nusery">${response.SchoolCode}</td>
                <td id="report-expected-men-nusery">${response.StudentCode}</td>
                <td id="report-expected-men-nusery">${response.SchoolClass}</td>
                <td id="report-expected-women-nusery">${response.FirstName}</td>
                <td id="report-expected-women-nusery">${response.LastName}</td>
                <td id="report-expected-women-nusery">${response.Gender}</td>
                <td id="report-expected-total-nusery"><button class="btn btn-primary" id="present${response.id}"  onclick="attendedStudent(${response.id})">Present</button></td>
                <td id="report-attended-men-nusery"><button class="btn btn-danger" id="absent${response.id}" onclick="openModal(${response.id})">Absent</button></td>
            </tr>
            `

           schools.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}


function todayDate(){
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate
}



function attendedStudent(id){
    $(`#present${id}`).attr('disabled','disabled');
    $(`#absent${id}`).removeAttr('disabled');

    const formData={
        StudentCode:id,
        comment:'present',
        Status:'Present',
        attendedDay:todayDate()
    }
    console.log("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh",formData)
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
            //  window.location.reload()
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}

function absentStudent(){
    let id=document.getElementById("userId").value
    let comment=document.getElementById("teacher-Comment").value
    $(`#absent${id}`).attr('disabled','disabled');
    $(`#present${id}`).removeAttr('disabled');
    const formData={
        StudentCode:document.getElementById("userId").value,
        comment:comment.trim(),
        Status:'Absent',
        attendedDay:todayDate()
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
        input.value=`${user}`;
        input.id="userId";
        input.hidden="readonly";
        form_container.appendChild(input);

    document.getElementById('modal-title').innerText = 'Mark students as an absent to class attendance'
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endsection


